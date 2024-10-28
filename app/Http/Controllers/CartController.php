<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductStock;
use App\Models\ProductVariationValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function viewCart()
    {
        $cartId = Session::get('cart_id', 1);
        $cartItems = CartItem::where('cart_id', $cartId)->get();
        $totalPrice = 0;
        $shippingFee = 30000;

        foreach ($cartItems as $cartItem) {
            $productStock = ProductStock::find($cartItem->product_stock_id);

            if ($productStock) {
                $retailPrice = $productStock->retail_price;
                $cartItem->price = $retailPrice * $cartItem->quantity; // Cập nhật giá của giỏ hàng
                $cartItem->productStock = $productStock;
                $totalPrice += $cartItem->price; // Tổng giá của tất cả sản phẩm
            } else {
                $cartItem->price = 0;
            }

            // Lấy thông tin biến thể của sản phẩm
            $variations = ProductAttribute::select('product_variations.variation_name as variation_name', 'product_variation_values.variation_value_name as variation_value')
                ->join('product_variations', 'product_attributes.variation_id', '=', 'product_variations.id')
                ->join('product_variation_values', 'product_attributes.product_variation_value_id', '=', 'product_variation_values.id')
                ->where('product_attributes.product_stock_id', $cartItem->product_stock_id)
                ->get();

            $cartItem->product = Product::find($cartItem->product_id);
            $cartItem->variations = $variations;
        }

        $totalPayment = $totalPrice + $shippingFee;
        // Lưu totalPayment và shippingFee vào session
        Session::put('total_payment', $totalPayment);
        Session::put('shipping_fee', $shippingFee);

        // Tạo mã đơn hàng ngẫu nhiên
        $orderCode = 'ORD-' . uniqid();

        return view('layouts.cart', compact('cartItems', 'totalPrice', 'shippingFee', 'totalPayment', 'orderCode',));
    }


    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'variations' => 'required|array',
            'product_image' => 'required|string',
            'quantity' => 'sometimes|integer|min=1',
        ]);

        $productId = $validated['product_id'];
        $variations = $validated['variations'];
        $productImage = $validated['product_image'];
        $quantity = $validated['quantity'] ?? 1;

        $product = Product::findOrFail($productId);
        $productPrice = $product->sale_price;

        $cartId = Session::get('cart_id', 1);
        $shopId = 1;

        $matchedStockIds = $this->getMatchedStockIds($variations);

        foreach ($matchedStockIds as $stockId => $count) {
            if ($count == count($variations)) {
                $productStock = ProductStock::find($stockId);

                if ($productStock) {
                    $cartItem = CartItem::where('product_id', $productId)
                        ->where('product_stock_id', $productStock->id)
                        ->where('cart_id', $cartId)
                        ->first();

                    if ($cartItem) {
                        $cartItem->quantity += $quantity;
                        $this->updateCartItemMedia($cartItem); // Cập nhật media
                        $cartItem->save();
                    } else {
                        $cartItem = CartItem::create([
                            'product_id' => $productId,
                            'price' => $productPrice,
                            'quantity' => $quantity,
                            'product_stock_id' => $productStock->id,
                            'media' => $productImage,
                            'shop_id' => $shopId,
                            'cart_id' => $cartId,
                            'variations' => json_encode($variations)
                        ]);

                        $this->updateCartItemMedia($cartItem); // Cập nhật media
                    }
                    // Cập nhật session với cartItems
                    $cartItems = CartItem::where('cart_id', $cartId)->get()->toArray();
                    Session::put('cartItems', $cartItems);

                    return redirect()->route('cart.view')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
                }
            }
        }

        return redirect()->back()->with('error', 'Không tìm thấy sản phẩm biến thể.');
    }

    private function getMatchedStockIds($variations)
    {
        $matchedStockIds = [];

        foreach ($variations as $variationId => $variation) {
            $variationValueId = ProductVariationValue::where('variation_value_name', $variation['value'])->value('id');

            if (!$variationValueId) {
                // Trả về mảng rỗng nếu không tìm thấy giá trị biến thể
                return [];
            }

            $productAttributes = ProductAttribute::where('variation_id', $variationId)
                ->where('product_variation_value_id', $variationValueId)
                ->get();

            foreach ($productAttributes as $productAttribute) {
                $stockId = $productAttribute->product_stock_id;

                if (!isset($matchedStockIds[$stockId])) {
                    $matchedStockIds[$stockId] = 0;
                }

                $matchedStockIds[$stockId]++;
            }
        }

        return $matchedStockIds;
    }

    public function getRetailPrice(Request $request)
    {
        $validated = $request->validate([
            'selectedVariations' => 'required|array',
        ]);

        $selectedVariations = $validated['selectedVariations'];

        if (count($selectedVariations) == 0) {
            return response()->json(['error' => 'Cần chọn ít nhất một biến thể.'], 400);
        }

        $matchedStockIds = $this->getMatchedStockIds($selectedVariations);

        foreach ($matchedStockIds as $stockId => $count) {
            if ($count == count($selectedVariations)) {
                $productStock = ProductStock::find($stockId);

                if ($productStock) {
                    $retailPriceFormatted = number_format($productStock->retail_price, 0, ',', '.');
                    $media = $productStock->media;

                    return response()->json([
                        'retailPriceFormatted' => $retailPriceFormatted,
                        'media' => $media,
                    ]);
                }
            }
        }

        return response()->json(['error' => 'Không tìm thấy giá và hình ảnh cho biến thể sản phẩm này.'], 404);
    }

    public function updateCartItemMedia(CartItem $cartItem)
    {
        $productStock = ProductStock::find($cartItem->product_stock_id);

        if ($productStock) {
            $cartItem->media = $productStock->media;
            $cartItem->save();
        }
    }


    public function updateQuantity(Request $request, $cartItemId)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $quantity = $validated['quantity'];
        $cartItem = CartItem::findOrFail($cartItemId);
        $cartItem->quantity = $quantity;
        $cartItem->save();

        $productStock = ProductStock::find($cartItem->product_stock_id);

        if ($productStock) {
            $itemPrice = $productStock->retail_price * $cartItem->quantity;

            // Cập nhật tổng giá và tổng thanh toán
            $cartItems = CartItem::where('cart_id', Session::get('cart_id', 1))->get();
            $totalPrice = 0;
            $shippingFee = 30000;

            foreach ($cartItems as $item) {
                $productStock = ProductStock::find($item->product_stock_id);
                if ($productStock) {
                    $totalPrice += $productStock->retail_price * $item->quantity;
                }
            }

            $totalPayment = $totalPrice + $shippingFee;

            return response()->json([
                'success' => true,
                'totalPrice' => $totalPrice,
                'totalPayment' => $totalPayment,
                'itemPrice' => $itemPrice,
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Product stock not found.']);
    }


    public function updateSelectedItems(Request $request)
    {
        $selectedItems = $request->input('selectedItems', []);

        // Lấy tất cả các item trong giỏ hàng
        $cartItems = CartItem::where('cart_id', Session::get('cart_id', 1))->get();

        $totalQuantity = 0;
        $totalPrice = 0;

        foreach ($cartItems as $cartItem) {
            if (in_array($cartItem->id, $selectedItems)) {
                $totalQuantity += $cartItem->quantity;
                $totalPrice += $cartItem->price * $cartItem->quantity;
            }
        }

        return response()->json([
            'totalQuantity' => $totalQuantity,
            'totalPrice' => $totalPrice,
        ]);
    }

    public function remove(Request $request, $cartItemId)
    {
        $cartItem = CartItem::findOrFail($cartItemId);

        if ($cartItem) {
            $cartItem->delete();
            // Optionally, update session or perform other necessary actions

            return redirect()->route('cart.view')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
        }

        return redirect()->back()->with('error', 'Không tìm thấy sản phẩm trong giỏ hàng.');
    }

}

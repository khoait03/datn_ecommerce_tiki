<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductStock;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class VNPayController extends Controller
{
    public function create(Request $request)
    {
//        session(['total_payment' => $request->total_payment]);
//        session(['shipping_fee' => $request->shipping_fee]);
        session(['cost_id' => $request->id]);
        session(['url_prev' => url()->previous()]);

        $vnp_TmnCode = "93QX4E2D";
        $vnp_HashSecret = "ZPKCTSJQALKCIQZQQQQBQHWMLKTWUQGY";
        $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";

        $vnp_Returnurl = route('vnpay.return');
        $vnp_TxnRef = uniqid(); // Tạo mã đơn hàng ngẫu nhiên
        $vnp_OrderInfo = "Thanh toán hóa đơn phí dịch vụ";
        $vnp_OrderType = 'billpayment';

        // Lấy totalPayment và shippingFee từ session và chuyển đổi sang đơn vị VNĐ
        $totalPayment = session('total_payment', 0);
        $shippingFee = session('shipping_fee', 0);
        $vnp_Amount = ($totalPayment + $shippingFee) * 100;

        $vnp_Locale = 'vn';
        $vnp_IpAddr = $request->ip(); // Lấy địa chỉ IP của yêu cầu

        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if ($request->has('vnp_BankCode') && $request->input('vnp_BankCode') != "") {
            $inputData['vnp_BankCode'] = $request->input('vnp_BankCode');
        }

        // Sắp xếp các tham số theo thứ tự bảng chữ cái
        ksort($inputData);

        $hashdata = "";
        $query = "";
        $i = 0;
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . rtrim($query, '&');

        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= '&vnp_SecureHashType=SHA512&vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect($vnp_Url);
    }

    public function processPayment(Request $request)
    {
        $vnp_Amount = $request->input('vnp_Amount');
        $vnp_ResponseCode = $request->input('vnp_ResponseCode');

        if ($vnp_ResponseCode === '00') {
            $userId = auth()->id();
            $defaultAddress = UserAddress::where('user_id', $userId)
                ->where('is_default', 1)
                ->first();

            if (!$defaultAddress) {
                return redirect()->back()->with('error', 'Không tìm thấy địa chỉ mặc định.');
            }

            // Tạo đơn hàng mới
            $order = Order::create([
                'user_address_id' => $defaultAddress->id,
                'delivery_date' => now()->addDays(3),
                'total_price' => $vnp_Amount / 100,
                'shipping_unit' => 'Standard',
                'user_id' => Auth::id(),
                'voucher_id' => $request->voucher_id ?? null,
                'status' => OrderStatus::Processing,
                'code' => uniqid('order_'),
                'payment_method_id' => $request->payment_method_id ?? 1,
                'created_at' => now(),
                'updated_at' => now(),
                'shop_id' => $request->shop_id,
                'cancel_reason' => null,
                'on_hold' => false,
                'is_paid' => true,
                'day_paid' => now()
            ]);

            if (!$order) {
                return redirect()->back()->with('error', 'Không thể tạo đơn hàng.');
            }

            // Lấy thông tin giỏ hàng từ session
            $cartItems = Session::get('cartItems', []);
            \Log::info('Cart Items:', $cartItems);
            if (empty($cartItems)) {
                return redirect()->back()->with('error', 'Giỏ hàng trống.');
            }


            // Lưu chi tiết đơn hàng
            foreach ($cartItems as $cartItem) {
                $productStock = ProductStock::find($cartItem['product_stock_id']);

                if ($productStock) {
                    try {
                        $orderDetail = OrderDetail::create([
                            'order_id' => $order->id,
                            'shop_id' => $request->shop_id,
                            'product_image' => $cartItem['media'],
                            'product_price' => $productStock->retail_price,
                            'product_id' => $cartItem['product_id'],
                            'product_quantity' => $cartItem['quantity'],
                        ]);

                        // Debug thông tin OrderDetail đã lưu
                        \Log::info('Order Detail Created:', $orderDetail->toArray());
                    } catch (\Exception $e) {
                        \Log::error('Error saving order detail: ' . $e->getMessage());
                        return redirect()->back()->with('error', 'Không thể lưu chi tiết đơn hàng: ' . $e->getMessage());
                    }
                } else {
                    return redirect()->back()->with('error', 'Không tìm thấy thông tin sản phẩm.');
                }
            }

            // Xóa giỏ hàng sau khi thanh toán thành công
            Session::forget('cartItems');

            return view('layouts.success');
        } else {
            return view('layouts.failure', ['message' => 'Thanh toán không thành công']);
        }
    }

}

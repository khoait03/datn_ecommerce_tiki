<?php

namespace App\Http\Controllers\Gmail;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Mail\OrderOnHoldMail;
use App\Mail\OrderPaidMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCancelledMail;
use App\Mail\OrderNewMail;
use App\Mail\OrderDeliveredMail;
use App\Mail\OrderProcessingMail;
use App\Mail\OrderShippedMail;
use App\Models\Order;
class OrderController extends Controller
{
    public function updateStatus(Request $request, $orderId)
    {
        $order = Order::find($orderId);
        $newStatus = $request->input('status');
        $cancelReason = $request->input('cancel_reason');

        switch ($newStatus) {
            case 'new':
                Mail::to($order->user->email)->send(new OrderNewMail($order));
                break;
            case 'processing':
                Mail::to($order->user->email)->send(new OrderProcessingMail($order));
                break;
            case 'shipped':
                Mail::to($order->user->email)->send(new OrderShippedMail($order));
                break;
            case 'delivered':
                Mail::to($order->user->email)->send(new OrderDeliveredMail($order));
                break;
            case 'cancelled':
                Mail::to($order->user->email)->send(new OrderCancelledMail($order, $cancelReason));
                break;
            default:
                return redirect()->back()->with('404', 'Error');
        }
//        $newPaid = $request->input('is_paid');
        if ($order->is_paid === false) {
            $order->on_hold = true;
            Mail::to($order->user->email)->send(new OrderPaidMail($order));
        } else {
            $order->on_hold = false;
            Mail::to($order->user->email)->send(new OrderOnHoldMail($order));
        }

        // Cập nhật trạng thái đơn hàng
        $order->status = $newStatus;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully');
    }
}

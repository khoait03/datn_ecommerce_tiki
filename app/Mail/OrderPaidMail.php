<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderPaidMail extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order;


    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        $orderDetails = $this->order->OrderDetail; // Giả sử 'details' là mối quan hệ giữa Order và OrderDetail
        return $this->subject('Đơn hàng đã thanh toán')
            ->markdown('emails.order_paid', [
                'order' => $this->order,
                'orderDetails' => $orderDetails,
            ]);
    }
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Đơn hàng đã thanh toán',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.order_paid',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

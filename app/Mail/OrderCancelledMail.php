<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class OrderCancelledMail extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order;
    public string $cancelReason;

    public function __construct(Order $order, string $cancelReason)
    {
        $this->order = $order;
        $this->cancelReason = $cancelReason;
    }

    public function build()
    {
        return $this->subject('Đơn hàng đã bị hủy')
            ->markdown('emails.order_cancelled', [
                'order' => $this->order,
                'cancelReason' => $this->cancelReason,
            ]);
    }
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Đơn hàng đã bị hủy',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.order_cancelled',
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

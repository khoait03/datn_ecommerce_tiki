<?php

namespace App\Mail;

use App\Models\Shop;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StopShopMail extends Mailable
{
    use Queueable, SerializesModels;

    public Shop $shop;
    /**
     * Create a new message instance.
     */
    public function __construct($shop)
    {
        $this->shop = $shop;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->view('emails.stop_shop')
            ->with(['shop' => $this->shop])
            ->subject('Shop của bạn đã bị tạm dừng');
    }
    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.stop_shop',
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

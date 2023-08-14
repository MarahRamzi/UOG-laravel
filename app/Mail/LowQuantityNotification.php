<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LowQuantityNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected $item;

    public function __construct($item)
    {
        $this->item = $item;
    }

    // public function build()
    // {
    //     return $this->view('emails.low_quantity')
    //         ->with(['item' => $this->item])
    //         ->subject('Low Quantity Alert');
    // }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Low Quantity Notification',
        );
    } 

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // return $this->view('emails.low_quantity')
        // ->with(['item' => $this->item]);
        return new Content(
            view: 'emails.low_quantity',
            with:['item' => $this->item],
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
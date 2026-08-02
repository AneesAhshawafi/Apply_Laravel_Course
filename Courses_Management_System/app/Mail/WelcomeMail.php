<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Headers;

class WelcomeMail extends Mailable
{

    use Queueable, SerializesModels;
    public  $name;
    public $active;
    /**
     * Create a new message instance.
     */
    public function __construct($name, $active)
    {
        $this->name = $name;
        $this->active = $active == 1 ? "active" : "unactive";
    }


    /**
     * Get the message headers.
     */
    public function headers(): Headers
    {
        return new Headers(
            messageId: 'codyvex-message-id@example.com',
            references: ['codyvex-previous-message@example.com'],
            text: [
                'X-Custom-Header' => 'Custom Value',
            ],
        );
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            // because $name and active are public, they will be sent automaticly with the view below, we dont need to send them explicity in the view
            view: 'mails.welcome',
            // with: [
            //     "name" => $this->name,
            //     "status" => $this->active,
            // ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromPath(public_path("images/students/Anees CV.pdf"))
                ->as('name.pdf')
                ->withMime('application/pdf'),
        ];
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;

class PdfMergedMail extends Mailable
{
    use Queueable, SerializesModels;
    public $pdfContent;
    /**
     * Create a new message instance.
     */
    public function __construct($pdfContent)
    {
        $this->pdfContent = $pdfContent;
    }

    /**
     * Get the message envelope.
     */


    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function build()
    {
        return $this->view('apply')
            ->attachData($this->pdfContent, 'merged_pdf.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}

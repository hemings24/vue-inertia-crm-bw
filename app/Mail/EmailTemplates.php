<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailTemplates extends Mailable
{
   use Queueable,SerializesModels;

   /**
   *Create a new message instance
   */
   public function __construct(Object $customer, Object $email)
   {
      $this->customer = $customer;
      $this->email = $email;
   }

   /**
   *Get the message envelope
   */
   public function envelope(): Envelope
   {
      return new Envelope(
         to: $this->customer->email,
         subject: $this->email->subject
         //from,to,cc,bcc,replyTo,subject,tags,metadata.....
      );
   }

   /**
   *Get the message content definition
   */
   public function content(): Content
   {
      return new Content(
         view: 'mail.email-body',
         with: ['email_body' => $this->email->content]
      );
   }

   /**
   *Get the attachments for the message.
   *
   *@return array<int, \Illuminate\Mail\Mailables\Attachment>
   */
   public function attachments(): array
   {
      return [];
   }
}
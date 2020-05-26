<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
    */
    public function build()
    {        
        $img_url = env('APP_URL')."./images/main-pictures/jslogo.png";
        return $this->markdown('emails.contact.contact-form', [
            'img_url' => $img_url
        ]);
    }
}

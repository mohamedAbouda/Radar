<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvitationEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $name, $promoCode;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $promoCode)
    {
        $this->name = $name;
        $this->promoCode = $promoCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.invite')->with('name', $this->name)->with('promoCode', $this->promoCode);
    }
}

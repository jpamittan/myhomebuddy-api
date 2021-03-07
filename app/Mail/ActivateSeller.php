<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivateSeller extends Mailable
{
    use Queueable, SerializesModels;

    public $firstName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Seller account activated')
            ->view('emails.activatedSellerAccount');
    }
}

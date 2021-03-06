<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivateAccount extends Mailable
{
    use Queueable, SerializesModels;

    public $firstName;
    public $userId;
    public $hash;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $firstName, string $userId, string $hash)
    {
        $this->firstName = $firstName;
        $this->userId = $userId;
        $this->hash = $hash;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): ActivateAccount
    {
        return $this->subject('Activate account')
            ->view('emails.activateAccount');
    }
}

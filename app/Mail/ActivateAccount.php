<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivateAccount extends Mailable
{
    use Queueable, SerializesModels;

    public $type;
    public $firstName;
    public $userId;
    public $hash;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        string $type, 
        string $firstName, 
        string $userId, 
        string $hash
    )
    {
        $this->type = $type;
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
        $view = 'emails.activateConsumerAccount';
        if ($this->type == "Seller") {
            $view = 'emails.activateSellerAccount';
        }

        return $this->subject('Activate account')
            ->view($view);
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnterpriseConfirmRegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Enterprise's confirmation code
     * 
     * @var String
     */
    protected $confirmationCode;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($confirmationCode)
    {
        $this->confirmationCode = $confirmationCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.enterprise.confirm')
                    ->with([
                        'confirmationCode' => $this->confirmationCode                        
                    ]);
    }
}

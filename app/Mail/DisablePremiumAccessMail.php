<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DisablePremiumAccessMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Enterprise's name
     * 
     * @var String
     */
    protected $enterprise;

    /**
     * Create a new message instance.
     *
     * @param String $email
     * @param String $message
     *
     * @return void
     */
    public function __construct($enterprise)
    {
        $this->enterprise = $enterprise;     
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {        
        return $this->view('emails.admin.disable-premium-access')
                    ->with([
                        'enterprise' => $this->enterprise,
                    ]);
    }
}

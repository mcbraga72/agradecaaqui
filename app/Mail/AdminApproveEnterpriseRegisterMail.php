<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminApproveEnterpriseRegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * User's name
     * 
     * @var String
     */
    protected $name;

    /**
     * Create a new message instance.
     *
     * @param String $email
     * @param String $message
     *
     * @return void
     */
    public function __construct($name)
    {
        $this->name = $name;     
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {        
        return $this->view('emails.admin.approve-enterprise-register')
                    ->with([
                        'name' => $this->name,                        
                    ]);
    }        
}

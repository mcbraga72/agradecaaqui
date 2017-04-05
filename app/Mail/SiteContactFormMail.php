<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SiteContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * User's name
     * 
     * @var String
     */
    protected $name;

    /**
     * User's email
     * 
     * @var String
     */
    protected $email;

    /**
     * User's message
     * 
     * @var String
     */
    protected $message;
  
    /**
     * Create a new message instance.
     *
     * @param String $email
     * @param String $message
     *
     * @return void
     */
    public function __construct($name, $email, $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {        
        return $this->view('emails.site.send')
                    ->with([
                        'userName' => $this->name,
                        'userEmail' => $this->email,
                        'userMessage' => $this->message
                    ]);
    }        
}

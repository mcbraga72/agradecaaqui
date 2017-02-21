<?php

namespace App\Mail;

use App\Models\EnterpriseThanks;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnterpriseThanks extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The user that create the enterprise thanks
     * 
     * @var User
     */
    protected $user;

    /**
     * The enterprise thanks
     * 
     * @var EnterpriseThanks
     */
    protected $enterpriseThanks;
  
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, EnterpriseThanks $enterpriseThanks)
    {
        $this->user = $user;
        $this->enterpriseThanks = $enterpriseThanks;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.enterprise-thanks.send')
                    ->with([
                        'userName' => $this->user->name,
                        'userEmail' => $this->user->email,
                        'content' => $this->enterpriseThanks->content                        
                    ]);
    }
}

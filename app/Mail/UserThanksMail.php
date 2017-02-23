<?php

namespace App\Mail;

use App\Models\User;
use App\Models\UserThanks;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserThanksMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The user that create the enterprise thanks
     * 
     * @var User
     */
    protected $user;

    /**
     * The user thanks
     * 
     * @var UserThanks
     */
    protected $userThanks;
  
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, UserThanks $userThanks)
    {
        $this->user = $user;
        $this->userThanks = $userThanks;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.user-thanks.send')
                    ->with([
                        'userName' => $this->user->name,
                        'userEmail' => $this->user->email,
                        'content' => $this->userThanks->content                        
                    ]);
    }
}

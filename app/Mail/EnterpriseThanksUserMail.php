<?php

namespace App\Mail;

use App\Models\EnterpriseThanks;
use App\Models\Enterprise;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnterpriseThanksUserMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The subject of the message.
     *
     * @var string
     */
    public $subject;

    /**
     * The enterprise that answered the enterprise thanks
     * 
     * @var Enterprise
     */
    protected $enterprise;

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
    public function __construct(Enterprise $enterprise, EnterpriseThanks $enterpriseThanks)
    {
        $this->enterprise = $enterprise;
        $this->enterpriseThanks = $enterpriseThanks;
        $this->subject = 'Agradeça Aqui - Seu agradecimento foi respondido pela empresa';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.enterprise-thanks-user.send')
                    ->with([
                        'enterpriseName' => $this->enterprise->name,
                        'enterpriseEmail' => $this->enterprise->email,
                        'content' => $this->enterpriseThanks->content,
                        'replica' => $this->enterpriseThanks->replica,
                        'hash' => $this->enterpriseThanks->hash
                    ]);
    }
}

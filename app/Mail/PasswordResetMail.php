<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sellerName;

    public $newPassword;


    public function __construct($sellerName,$newPassword)
    {
        
        $this -> sellerName = $sellerName;

        $this -> newPassword = $newPassword;
    }

 
    public function build()
    {
        // return $this->view('view.name');

        return $this->subject('Your New Admin Password')
                    ->view ('emails.password_send')
                    ->with ([
                        'sellerName' => $this -> sellerName,
                        'newPassword' => $this-> newPassword,
                    ]);
    }
}

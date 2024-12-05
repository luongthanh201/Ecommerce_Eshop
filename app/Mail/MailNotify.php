<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;
    private $data = [];
    /**
     * Create a new message instance.
     * 
     */
    
    public function __construct($data)
    {
        $this->data = $data;
    }
     /**
     * Build the msessage
     *  
     */
    public function build()
    {
        return $this->from("nguyenluongthanh201@gmail.com","test")
        ->subject('Thông tin giỏ hàng của bạn')
        ->view("emails.index")->with("data", $this->data);
    }
  
}

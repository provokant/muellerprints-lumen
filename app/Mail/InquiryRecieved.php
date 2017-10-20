<?php

namespace App\Mail;

use App\Inquiry;
use Illuminate\Mail\Mailable;

class InquiryRecieved extends Mailable
{
  public $inquiry;

  public function __construct(Inquiry $inquiry)
  {
    $this->inquiry = $inquiry;
  }

  public function build()
  {
    return $this->view('mails.inquiry');
  }
}
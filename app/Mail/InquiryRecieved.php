<?php

namespace App\Mail;

use App\Inquiry;
use Carbon\Carbon;
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
    setlocale(LC_ALL, config('app.locale'));

    // dd($this->inquiry);
    return $this->view('mails.inquiry', [
      'inquiry' => $this->inquiry,
      'date' => Carbon::now()->formatLocalized('%A, %d.%m.%Y um %H:%M Uhr')
    ]);
  }
}
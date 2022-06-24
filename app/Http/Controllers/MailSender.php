<?php

namespace App\Http\Controllers;

use App\Jobs\MailJob;
use Illuminate\Http\Request;

class MailSender extends Controller
{
    public function send_bulkmail($mail_list)
    {
        $details = [
            'subject' => 'CakeFactory'
        ];
        $job = (new MailJob($details,$mail_list));
        dispatch($job);

    }
}



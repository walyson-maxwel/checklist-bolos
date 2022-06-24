<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;


class MailJob implements ShouldQueue
{
    protected $details;
    protected $mail_list;
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details,$mail_list)
    {
        $this->details = $details;
        $this->mail_list = $mail_list;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $input['subject'] = $this->details['subject'];
        foreach ($this->mail_list as $mail) {
            Mail::send('mail', [], function ($message) use ($input,$mail) {
                $message->to($mail, $mail)
                    ->subject($input['subject']);
            });
        }
    }
}

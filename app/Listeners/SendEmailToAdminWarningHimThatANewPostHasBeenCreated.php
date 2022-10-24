<?php

namespace App\Listeners;

use App\Event\PostCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailToAdminWarningHimThatANewPostHasBeenCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Event\PostCreated  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        Mail::to('emmanuelle@vo.be')
            ->queue(new \App\Mail\PostCreated($event->post));
    }
}

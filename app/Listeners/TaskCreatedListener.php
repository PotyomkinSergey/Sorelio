<?php
declare(strict_types=1);
namespace App\Listeners;

use App\Mail\AfterTaskCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class TaskCreatedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {}

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        Mail::to('admin@example.com')
            ->queue(new AfterTaskCreated($event->task));
    }
}

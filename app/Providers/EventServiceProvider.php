<?php
declare(strict_types=1);
namespace App\Providers;

use App\Listeners\TaskCreatedListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
//use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \App\Events\TaskCreatedEvent::class => [
            TaskCreatedListener::class,
        ],
    ];
}

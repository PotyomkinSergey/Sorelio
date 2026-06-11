<?php
declare(strict_types=1);
namespace App\Observers;

use App\Events\TaskCreatedEvent;
use App\Models\Task;

final class TaskCreatedObserver
{
    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void
    {
        event(new TaskCreatedEvent($task));
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(Task $task): void
    {
        event(new TaskCreatedEvent($task));
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {
    }

    /**
     * Handle the Task "restored" event.
     */
    public function restored(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "force deleted" event.
     */
    public function forceDeleted(Task $task): void
    {

    }
}

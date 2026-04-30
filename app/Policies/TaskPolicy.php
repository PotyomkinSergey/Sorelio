<?php
declare(strict_types=1);
namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Task $task): bool
    {
        return $user->id === $task->user_id;
    }
}

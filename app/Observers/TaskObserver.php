<?php

namespace App\Observers;

use App\Models\Task;

class TaskObserver
{
    /**
     * Handle the Task "updated" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function updated(Task $task)
    {

        if ($task->isDirty('status')) {
            $task->withoutEvents(fn () =>
            $task->update([
                'last_status_update_at' => now(),
            ]));
        }
    }
}

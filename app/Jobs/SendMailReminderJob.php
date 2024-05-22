<?php

namespace App\Jobs;

use App\Enums\TaskStatusEnum;
use App\Mail\SendMailReminder;
use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendMailReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $tasks = Task::with(['subTasks.assignee', 'assignee'])->where('status', TaskStatusEnum::IN_PROGRESS)
            ->where('last_status_update_at', '<=', now()->subDays(1)->format('Y-m-d H:i:s'))
            ->get();

        foreach($tasks as $task) {
            Log::debug('Task to be processed: ', ['$task' => $task]);
            $assignee = $task['assignee'] ?? null;
            if (!empty($assignee)) {
                Mail::to($assignee['email'])->send(new SendMailReminder($task));
            }
        }
    }
}

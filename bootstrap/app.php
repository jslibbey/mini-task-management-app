<?php

use App\Jobs\SendMailReminderJob;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->statefulApi();

        $middleware->group('web', [
            \Illuminate\Session\Middleware\StartSession::class,
        ]);

        $middleware->group('api', [
            \Illuminate\Session\Middleware\StartSession::class,
        ]);
    })
    ->withSchedule(function (Schedule $schedule) {
        $schedule->job(SendMailReminderJob::class)->everyMinute();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

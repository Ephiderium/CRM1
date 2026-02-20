<?php

namespace App\Providers;

use App\Events\ChangeAssigned;
use App\Events\DealStage;
use App\Events\TaskStatus;
use App\Events\UserRegisteredEvent;
use App\Listeners\AuditChangeAssigned;
use App\Listeners\AuditDealStages;
use App\Listeners\AuditTaskStatus;
use App\Listeners\SendUserRegisteredNotification;
use App\Repository\Eloquent\Interfaces\UserRepositoryInterface;
use App\Repository\Eloquent\UserRepository;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $path = app_path('Repository/Eloquent');

        if (File::exists($path)) {
            $repositories = File::files($path);

            foreach ($repositories as $file) {

                $string = $file->getFilenameWithoutExtension();
                $result = preg_replace('/Repository$/', '', $string);
                $nameInterface = 'App\\Repository\\Eloquent\\Interfaces\\' . $result . 'RepositoryInterface';
                $nameRepository = 'App\\Repository\\Eloquent\\' . $result . 'Repository';
                $this->app->bind(
                    $nameInterface,
                    $nameRepository,
                );
            }
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            DealStage::class,
            AuditDealStages::class,
        );
        Event::listen(
            ChangeAssigned::class,
            AuditChangeAssigned::class,
        );
        Event::listen(
            TaskStatus::class,
            AuditTaskStatus::class,
        );
        Event::listen(
            UserRegisteredEvent::class,
            SendUserRegisteredNotification::class,
        );
    }
}

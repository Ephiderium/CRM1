<?php

namespace App\Providers;

use App\Events\DealStage;
use App\Listeners\AuditDealStages;
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
    }
}

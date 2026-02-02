<?php

namespace App\Providers;

use App\Repository\Eloquent\Interfaces\UserRepositoryInterface;
use App\Repository\Eloquent\UserRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $path = app_path('Repositories');

        if (File::exists($path)) {
            $repositories = File::files($path);

            foreach ($repositories as $file) {

                $string = $file->getFilenameWithoutExtension();
                $result = preg_replace('/Repository$/', '', $string);
                $nameInterface = 'App\\Repositories\\Interfaces\\' . $result . 'RepositoryInterface';
                $nameRepository = 'App\\Repositories\\' . $result . 'Repository';

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

    }
}

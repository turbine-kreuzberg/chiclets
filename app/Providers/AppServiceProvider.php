<?php

namespace App\Providers;

use App\Services\GitLab\Config\ChicletsConfig;
use App\Services\GitLab\GitLabService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            GitLabService::class,
            function (Application $app) {
                return new GitLabService($app->make(ChicletsConfig::class));
            },
        );

        $this->app->bind(
            ChicletsConfig::class,
            function () {
                return new ChicletsConfig();
            },
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

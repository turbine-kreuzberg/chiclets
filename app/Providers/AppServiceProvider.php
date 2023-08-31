<?php

namespace App\Providers;

use App\Services\Cache\CacheProxyInterface;
use App\Services\Cache\CacheService;
use App\Services\Cache\Memory\MemoryCache;
use App\Services\Config\ChicletsConfig;
use App\Services\Config\ConfigInterface;
use App\Services\VCS\GitLab\Connection\GitConnectionInterface;
use App\Services\VCS\GitLab\Connection\GitLabConnection;
use App\Services\VCS\GitLab\GitLabService;
use App\Services\VCS\GitServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Psr\Cache\CacheItemPoolInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            GitServiceInterface::class,
            function (Application $app): GitServiceInterface {
                return new GitLabService(
                    $app->make(GitConnectionInterface::class),
                    $app->make(CacheProxyInterface::class),
                );
            },
        );

        $this->app->singleton(
            GitConnectionInterface::class,
            function (Application $app): GitConnectionInterface {
                return new GitLabConnection($app->make(ChicletsConfig::class));
            },
        );

        $this->app->singleton(
            ConfigInterface::class,
            function (): ConfigInterface {
                return new ChicletsConfig();
            },
        );

        $this->app->singleton(
            CacheItemPoolInterface::class,
            function (): CacheItemPoolInterface {
                return new MemoryCache();
            },
        );

        $this->app->singleton(
            CacheProxyInterface::class,
            function (Application $app): CacheProxyInterface {
                return new CacheService(
                    $app->make(CacheItemPoolInterface::class),
                    $app->make(ConfigInterface::class),
                );
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

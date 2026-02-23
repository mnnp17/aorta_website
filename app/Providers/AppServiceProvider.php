<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Pagination\Paginator;
use App\Contracts\Interfaces\BaseInterface;
use App\Contracts\Repositories\BaseRepository;
use App\Contracts\Repositories\ArticleRepository;
use App\Contracts\Repositories\ProjectRepository;
use App\Contracts\Interfaces\ProjectInterface;
use App\Contracts\Interfaces\ArticleInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BaseInterface::class, BaseRepository::class);
        $this->app->bind(ArticleInterface::class, ArticleRepository::class);
        $this->app->bind(ProjectInterface::class, ProjectRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}

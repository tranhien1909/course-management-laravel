<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{

    protected $serviceBindings = [
        'App\Services\Interfaces\CourseServiceInterface' => 
        'App\Services\CourseService',

        'App\Repositories\Interfaces\CourseRepositoryInterface' => 
        'App\Repositories\CourseRepository',
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach($this->serviceBindings as $key => $val) {
            $this->app->bind($key, $val);
        }

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(255);
    }
}

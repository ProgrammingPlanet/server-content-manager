<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use DB,Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(config('extra.log_sql')) //for logging sql queries
        {
            DB::listen(function($query){
                Log::channel('sql')->debug($query->sql,$query->bindings,$query->time);
            });
        }
    }
}

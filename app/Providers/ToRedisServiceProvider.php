<?php

namespace App\Providers;

use App\Models\Drug;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\ServiceProvider;

class ToRedisServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Drug $drug)
    {
    if(!Redis::get('drugs')){
        $drugs = Drug::all()->pluck('name')->toArray();
        Redis::set('drugs', json_encode($drugs));
    }
    }
}

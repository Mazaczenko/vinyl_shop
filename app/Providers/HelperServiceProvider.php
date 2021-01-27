<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App;
class HelperServiceProvider extends ServiceProvider {

    public function boot()
    {
        //
    }

    public function register()
    {
        App::bind('test',function()
        {
            return new \App\Helpers\FacadeCart;
        });

    }
}

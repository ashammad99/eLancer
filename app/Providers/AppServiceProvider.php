<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;


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
        //not working here, request and session runs after provider
//        $locale = request('lang',Session::get('lang','en'));
//        Session::put('locale',$locale);
//        App::setLocale($locale);
        /*
//         dd(config::get('app.debug'));

        //all the 4 cases handles the config objects using the config object
        //that exist in service container
        if(config('app.env') == 'production'){
            config([
                'app.debug' => false,
            ]);
       }
        if(config()->get('app.env') == 'production') {
            config()->set('app.debug',false);
        }

        //or using Config Facade
        if(Config::get('app.env') == 'production') {
            Config::set('app.debug',false);
        }
        //or using App Facade
        if (App::environment('local')) {
            Config::set('app.debug',false);
        }
        */
        Validator::extend('filter',function ($attribute,$value) {
            if($value == 'god') {
                return false;
            }
            return true;
        },'Invalid Word for :attribute field');
        Paginator::useBootstrap();

//        Paginator::defaultView('vendor.pagination.bootstrap-4');


    }
}

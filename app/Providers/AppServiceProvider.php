<?php

namespace App\Providers;

use App\Models\Notificacion;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

            View::composer('*',function($view){
               if (request()->user()){
                   $user=request()->user();
                   $count=Notificacion::where('rl_vista','=',false)
                       ->where('fk_id_usuario','=',$user->pk_id_usuario)
                       ->count();
                   $view->with('ntf',$count);
               }

            });



    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

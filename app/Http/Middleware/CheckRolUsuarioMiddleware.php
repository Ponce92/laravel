<?php

namespace App\Http\Middleware;
use Illuminate\Contracts\Auth\Guard;
use Session;
use Closure;

class CheckRolUsuarioMiddleware
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth=$auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($this->auth->user()->fk_id_rol !=0){
            Session::flash('message-error','No tiene permisos para ingresar');
            return redirect('dashboard');
        }

        return $next($request);
    }
}

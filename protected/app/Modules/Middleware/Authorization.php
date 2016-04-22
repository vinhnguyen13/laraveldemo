<?php namespace App\Modules\Middleware;

use Auth;
use Closure;
use Config;

use Illuminate\Contracts\Auth\Guard;


class Authorization{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct()
    {
        $this->auth = \Auth::admin();
        
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

        if($request->is('admin') || $request->is('admin/*')){
        
            //POST and GET admin/login
            if($request->is(Config::get('auth.authentication_url.admin.login'))){
                return $next($request);    
            }

            if ($this->auth->guest()) {
                if ($request->ajax()) {
                    return response()->json(['error'=>"Unauthorized."], 401);
                } else {
                    return redirect()->guest(Config::get('auth.authentication_url.admin.login'));
                }
            }

            return $next($request);
        }
        /*else{
            $this->auth = \Auth::user();
            //POST and GET admin/login
            if($request->is(Config::get('auth.authentication_url.user.login'))){
                return $next($request);    
            }
            
            if ($this->auth->guest()) {
                if ($request->ajax()) {
                    return response()->json(['error'=>"Unauthorized."], 401);
                } else {
                    return redirect()->guest(Config::get('auth.authentication_url.user.login'));
                }
            }
        }*/
        
        return $next($request);
    }
}
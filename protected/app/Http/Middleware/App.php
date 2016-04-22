<?php
/**
 * Created by PhpStorm.
 * User: vinhnguyen
 * Date: 4/19/2016
 * Time: 11:24 AM
 */
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

class App {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /**
         * set language
         */
        if(!\Session::has('locale'))
        {
            \Session::put('locale', \Config::get('app.locale'));
        }
        if (in_array($request->segment(1), Config::get('app.alt_langs'))) {
            \Session::put('locale', $request->segment(1));
        }

        app()->setLocale(\Session::get('locale'));
        return $next($request);
    }

}
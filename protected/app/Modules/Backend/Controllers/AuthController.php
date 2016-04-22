<?php namespace App\Modules\Backend\Controllers;


use Config;
//use Request;
use Illuminate\Http\Request;
use App\Libs\Utils\Vii;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends BaseController{

    public function postLogin(Request $request){

        $credentials = [
            'email' => trim($request->input('email')),
            'password' => $request->input('password')
        ];

        $remember_me = false;
        if($request->has('remember_me') && $request->input('remember_me') == 1)
            $remember_me = true;

//        if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
//            return $this->handleUserWasAuthenticated($request, $throttles);
//        }

        if(Auth::attempt([
            'email' => 'quangvinhit2007@gmail.com',
            'password' => 'abc123ABC'
        ], true)){
            return redirect('admin');
        } else {
            return Response::make("Invalid login credentials, please try again.", 401);
        }


        return redirect()->route('admin.login')->with('message-error', 'The credentials is not found.');

    }

    public function getLogin(Request $request){
        $Session = new Session();
        echo "<pre>";
        print_r(Session::getId());
        echo "</pre>";
        exit;
        if(Auth::guard('admin')->attempt([
            'email' => 'quangvinhit2007@gmail.com',
            'password' => 'abc123ABC'
        ], true)){

            return redirect('admin');
        }
         return view(
            'auth.login',[]
        );
    }

    public function getLogout(){
        Auth::admin()->logout();
        return redirect()->guest('admin/login');
    }
}

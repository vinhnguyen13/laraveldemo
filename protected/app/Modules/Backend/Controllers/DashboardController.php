<?php namespace App\Modules\Backend\Controllers;

use Auth;

use Config;
use App\Models\User;
use App\Libs\Utils\Vii;

class DashboardController extends BaseController{

    
    public function __construct(){
        parent::__construct();
    }
    
    public function getIndex(){
        return view(
            'welcome',
            [
                'user' => 'Hello Lancaster' 
            ]
        );
    }
    
    /*
    public function getSetting(){
         return view(
            'backend::hello.index',
            [
                'user' => 'Setting Content'
            ]
        );
        
    }
    */
}
<?php namespace App\Modules\Backend\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Config;

class BaseController extends Controller{
    
    use DispatchesJobs, ValidatesRequests, SidebarMenuTrait;
    
    protected $sidebarMenu;

    public function __construct(){

        $this->init();
//        view()->share('assets', Config::get('assets'));
//        view()->share('sidebar_menu', $this->sidebarMenu);
    }

    protected function init(){
//        $this->sidebarMenu = $this->createMenu();
        //Vii::pr($this->sidebarMenu);
    }
}

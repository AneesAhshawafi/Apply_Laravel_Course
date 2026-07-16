<?php

namespace App\Http\Controllers;

use App\Services\HelperService;
use Illuminate\Support\Facades\App;
use App\Facades\Helper;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    protected $helper;
    public function __construct(HelperService $helper)
    {
        $this->helper = $helper;
    }

    public function index()
    {
        // $helper = App::make('Samhon');
        return $this->helper->greet("Anees");
    }

    public function myCustomFacade()
    {
        return Helper::greet("Anees Facade");
    }

    public function getMyrouteInfo($userNmae)
    {
        $name = Route::currentRouteName();
        $action = Route::currentRouteAction();
        $param = Route::current()->parameters();
        return "Route name:{$name} Route Action:{$action} Route paramter: " . json_encode($param);
    }
}

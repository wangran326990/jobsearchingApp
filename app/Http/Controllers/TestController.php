<?php

namespace App\Http\Controllers;

use App\Services\IndeedApiService\IndeedService;
use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller
{
    //
    public function __construct()
    {

    }

    public function index(){
        $indeed = new IndeedService("6094775235612455");

        //$indeed->jobSearching("php","mississauga, ON",40);
        $indeed->jobDetails("7a99e3ce26a2c99e");
    }
}

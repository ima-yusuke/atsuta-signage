<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    //

    public function ShowPage()
    {
        return view('main');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    //
    public $testArray =[
      ["id"=>"1","name"=>"卒業生","img"=>"pic-01.jpg","data"=>[["id"=>"1","name"=>"卒業生","img"=>"pic-01.jpg"],["id"=>"2","name"=>"在校生","img"=>"pic-02.jpg"],["id"=>"3","name"=>"教職員","img"=>"pic-03.jpg"],["id"=>"4","name"=>"その他","img"=>"pic-04.jpg"],["id"=>"5","name"=>"その他","img"=>"pic-03.jpg"]]],
      ["id"=>"2","name"=>"在校生","img"=>"pic-02.jpg","data"=>[["id"=>"1","name"=>"いか","img"=>"pic-01.jpg"],["id"=>"2","name"=>"たこ","img"=>"pic-03.jpg"],["id"=>"3","name"=>"教職員","img"=>"pic-03.jpg"],["id"=>"4","name"=>"その他","img"=>"pic-04.jpg"]]],
      ["id"=>"3","name"=>"教職員","img"=>"pic-03.jpg","data"=>[["id"=>"1","name"=>"1年生","img"=>"pic-04.jpg"],["id"=>"2","name"=>"2年生","img"=>"pic-02.jpg"],]],
      ["id"=>"4","name"=>"その他","img"=>"pic-04.jpg","data"=>[]],
    ];

    public function ShowPage()
    {
        $testArray = $this->testArray;
        return view('main',compact('testArray'));
    }
}

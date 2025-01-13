<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    //
    public $testArray =[
      ["id"=>"1","name"=>"卒業生","img"=>"pic-01.jpg","data"=>[["id"=>"1","name"=>"卒業生","url"=>"6ibo2m7xtEo"],["id"=>"2","name"=>"在校生","url"=>"JstmCvvTyRE"],["id"=>"3","name"=>"教職員","url"=>"Jp-G5M3Rjuw"],["id"=>"4","name"=>"その他","url"=>"yJ35AFj04iY"],["id"=>"5","name"=>"その他","url"=>"bkvUB5SxRPU"]]],
      ["id"=>"2","name"=>"在校生","img"=>"pic-02.jpg","data"=>[["id"=>"1","name"=>"いか","url"=>"6lJ6zhQaZG8"],["id"=>"2","name"=>"たこ","url"=>"nsktB9TwaVU"],["id"=>"3","name"=>"教職員","url"=>"zVCPzEru3BQ"],["id"=>"4","name"=>"その他","url"=>"sZ31ZXzEPw0"]]],
      ["id"=>"3","name"=>"教職員","img"=>"pic-03.jpg","data"=>[["id"=>"1","name"=>"1年生","url"=>"Tad10qzlrlk"],["id"=>"2","name"=>"2年生","url"=>"nCdxaDWmTJU"],]],
      ["id"=>"4","name"=>"その他","img"=>"pic-04.jpg","data"=>[]],
    ];

    public function ShowPage()
    {
        $testArray = $this->testArray;
        return view('main',compact('testArray'));
    }
}

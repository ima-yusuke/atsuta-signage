<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    //
    public $testArray =[
        ["id"=>"1","name"=>"熱田空襲を知る","img"=>"pic-01.jpg","data"=>[["id"=>"1","name"=>"卒業生","url"=>"SrR3DlLTHlg","img"=>"pic-01-01.jpg"],["id"=>"2","name"=>"在校生","url"=>"sQuobfrhMPQ","img"=>"pic-01-02.jpg"],["id"=>"3","name"=>"教職員","url"=>"XNp6zgE21ag","img"=>"pic-01-03.jpg"],["id"=>"4","name"=>"その他","url"=>"OmRZT31R2IA","img"=>"pic-01-04.jpg"],["id"=>"5","name"=>"その他","url"=>"lQBktFFBakM","img"=>"pic-01-05.jpg"],["id"=>"6","name"=>"その他","url"=>"OCV1M7G81b4","img"=>"pic-01-06.jpg"],["id"=>"7","name"=>"その他","url"=>"kWtYnka1a5E","img"=>"pic-01-07.jpg"],["id"=>"8","name"=>"その他","url"=>"C7ftsCQMwXY","img"=>"pic-01-08.jpg"]]],

        ["id"=>"2","name"=>"卒業生インタビュー","img"=>"pic-02.jpg","data"=>[["id"=>"1","name"=>"いか","url"=>"CbxXOlkv6Ps","img"=>"pic-02-01.jpg"],["id"=>"2","name"=>"たこ","url"=>"uN0B7u51RpM","img"=>"pic-02-02.jpg"],["id"=>"3","name"=>"教職員","url"=>"n-eGjdDK3uQ","img"=>"pic-02-03.jpg"],["id"=>"4","name"=>"その他","url"=>"bVS_qm1W8YU","img"=>"pic-02-04.jpg"]]],

        ["id"=>"3","name"=>"同窓会役員インタビュー","img"=>"pic-03.jpg","data"=>[["id"=>"1","name"=>"1年生","url"=>"TXzrcBG2XZM","img"=>"pic-03-01.jpg"],["id"=>"2","name"=>"2年生","url"=>"fykjQmIWa_o","img"=>"pic-03-02.jpg"],["id"=>"3","name"=>"2年生","url"=>"QaRr0iL5XJ8","img"=>"pic-03-03.jpg"]]],

        ["id"=>"4","name"=>"現在の教員・在校生インタビュー","img"=>"pic-04.jpg","data"=>[]],

        ["id"=>"5","name"=>"恩師インタビュー","img"=>"pic-05.jpg","data"=>[]],

        ["id"=>"6","name"=>"ドローンで母校を巡る","img"=>"pic-06.jpg","data"=>[]],
    ];

    public function ShowPage()
    {
        $testArray = $this->testArray;
        return view('main',compact('testArray'));
    }
}

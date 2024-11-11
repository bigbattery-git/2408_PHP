<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestContoller extends Controller
{
    public function index(){
        $result = '홍길동';

        return view('test')->with('name', $result);
    }
}

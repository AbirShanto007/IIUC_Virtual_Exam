<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        // return "Hellow World"; 
        $shanto = 'IIUC';
        return view('abir',compact('shanto'));
    }
    
    public function shanto()
    {
        return "Hellow World"; 
        // return view('abir');
    }

}

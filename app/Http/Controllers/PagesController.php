<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    // landing page controller 

    public function index(){
        return view('pages.index');
    }

    public function about(){
        return view('pages.about');
    }
















}

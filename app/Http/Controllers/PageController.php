<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function contact()
    {
        return view('contact');
    }

    public function learningPath()
    {
        return view('learning-path');
    }
}

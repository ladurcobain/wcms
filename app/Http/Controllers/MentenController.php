<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class MentenController extends Controller
{
    public function index()
    {
        return view('menten');
    }
}

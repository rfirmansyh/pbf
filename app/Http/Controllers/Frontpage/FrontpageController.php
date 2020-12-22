<?php

namespace App\Http\Controllers\Frontpage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontpageController extends Controller
{
    public function home() 
    {
        return view('frontpage.modules.index');
    }
}

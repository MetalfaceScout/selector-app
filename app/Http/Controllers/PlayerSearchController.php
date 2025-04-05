<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlayerSearchController extends Controller
{
    public function search(Request $request) {
        
        return view('selector', []);

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TargetWeightController extends Controller
{
    public function set()
    {
        return view('target_weight.set');
    }
}

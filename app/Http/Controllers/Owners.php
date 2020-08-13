<?php

namespace App\Http\Controllers;

use App\Owner;

class Owners extends Controller
{
    public function index()
    {
        return view("owners", [
            // pass in all the owners
            "owners" => Owner::all(),
        ]);
    }
}

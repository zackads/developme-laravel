<?php

namespace App\Http\Controllers;

use App\Owner;

class Owners extends Controller
{
    public function index()
    {
        return view("owners", [
            "owners" => Owner::all(),
        ]);
    }

    public function show(Owner $owner)
    {
        return view("owner", [
            "owner" => $owner,
        ]);
    }
}

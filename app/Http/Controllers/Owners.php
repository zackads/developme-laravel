<?php

namespace App\Http\Controllers;

use App\Owner;
use Illuminate\Http\Request;

class Owners extends Controller
{
    public function index()
    {
        return view("owners", [
            "owners" => Owner::paginate(5),
        ]);
    }

    public function show(Owner $owner)
    {
        return view("owner", [
            "owner" => $owner,
        ]);
    }

    public function create()
    {
        return view("form");
    }

    public function createOwner(Request $request)
    {
        // accept the Request object
        // this gives us access to the submitted data public function createOwner(Request $request) {
        // get all of the submitted data
        $data = $request->all();
        // create a new article, passing in the submitted data
        $article = Owner::create($data);
        // redirect the browser to the new article
        return redirect("/owners/{$article->id}");
    }
}

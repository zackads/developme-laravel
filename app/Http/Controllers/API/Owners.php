<?php

namespace App\Http\Controllers\API;

use App\Animal;
use App\Http\Controllers\Controller;
use App\Owner;
use Illuminate\Http\Request;

class Owners extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Owner::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        return Owner::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Owner $owner)
    {
        return $owner;
    }

    public function showAnimals(Owner $owner)
    {
        return $owner->animals;
    }

    public function storeAnimal(Request $request, Owner $owner)
    {
        $data = $request->all();
        $data['owner_id'] = $owner->id;

        // return gettype($data);
        return Animal::create($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Owner $owner)
    {
        $data = $request->all();

        $owner->fill($data)->save();

        return $owner;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Owner $owner)
    {
        $owner->delete();

        return response(null, 204);
    }
}

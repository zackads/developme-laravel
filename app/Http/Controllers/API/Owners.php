<?php

namespace App\Http\Controllers\API;

use App\Animal;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\OwnerRequest;
use App\Http\Resources\API\OwnerListResource;
use App\Http\Resources\API\OwnerResource;
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
        return OwnerListResource::collection(Owner::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OwnerRequest $request)
    {
        $data = $request->all();

        $owner = Owner::create($data);

        return new OwnerResource($article);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Owner $owner)
    {
        return new OwnerResource($owner);
    }

    public function showAnimals(Owner $owner)
    {
        return $owner->animals;
    }

    public function storeAnimal(OwnerRequest $request, Owner $owner)
    {
        $animal = new Animal($request->all());

        $owner->animals()->save($animal);

        return redirect("/animals/{$owner->id}");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OwnerRequest $request, Owner $owner)
    {
        $owner = Owner::find($id);

        $data = $request->all();
        $owner->fill($data)->save();

        return new OwnerResource($owner);
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

<?php

namespace App\Http\Controllers\API;

use App\Animal;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\AnimalListResource;
use App\Http\Resources\API\AnimalResource;
use App\Http\Requests\API\AnimalRequest;

class Animals extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AnimalListResource::collection(Animal::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnimalRequest $request)
    {
        $data = $request->only(["id", "name", "type", "dob", "weight", "height", "biteyness", "owner_id"]);

        $animal = Animal::create($data)->setTreatments(["Veda-Sorb Bolus", "Keto-Gel", "QuickDerm Wound Ointment"]);

        return new AnimalResource($animal);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Animal $animal)
    {
        return new AnimalResource($animal);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AnimalRequest $request, Animal $animal)
    {
        $data = $request->only(["id", "name", "address", "dob", "weight", "height", "biteyness"]);

        $animal->fill($data)->save();

        $animal->setTreatments($request->get("treatments"));

        return new AnimalResource($animal);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Animal $animal)
    {
        $animal->delete();

        return response(null, 204);
    }
}

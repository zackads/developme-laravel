<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $fillable = ["name", "type", "dob", "weight", "height", "biteyness", "owner_id"];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function treatments()
    {
        return $this->belongsToMany(Treatment::class);
    }

    public function dangerous()
    {
        return $this->biteyness >= 3;
    }

    public function setTreatments(array $treatments): Animal
    {
        $treatments = Treatment::fromStrings($treatments);

        $this->treatments()->sync($treatments->pluck("id"));

        return $this;
    }

    public function getTreatments()
    {
        return $this->treatments->pluck("name")->all();
    }
}

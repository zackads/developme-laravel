<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Treatment extends Model
{
    public $timestamps = false;
    protected $fillable = ["name"];

    public function animals()
    {
        return $this->belongsToMany(Animal::class);
    }

    static function fromStrings(array $treatments): Collection
    {
        return collect($treatments)->map([Treatment::class, "fromString"]);
    }

    static function fromString(string $treatment): Treatment
    {
        $trimmed_treatment = trim($treatment);
        $existing_treatment = Treatment::where("name", $trimmed_treatment)->first();

        return $existing_treatment ? $existing_treatment : Treatment::create(["name" => $trimmed_treatment]);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    public function fullName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}

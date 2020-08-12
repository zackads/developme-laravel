<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    public static function checkOwnerExists($email)
    {
        return Owner::where('email', '=', $email)->get('email')->exists();
    }

    public function fullName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function fullAddress(): string
    {
        return $this->address_2 ?
        join(", ", [$this->address_1, $this->address_2, $this->town, $this->postcode]) :
        join(", ", [$this->address_1, $this->town, $this->postcode]);
    }
}

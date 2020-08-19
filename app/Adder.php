<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adder extends Model
{
    public function add($a, $b)
    {
        return $a + $b;
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FizzBuzz extends Model
{
    public function forNumber($num)
    {
        $return_string = "";

        $dictionary = [
            3 => "Fizz",
            5 => "Buzz",
            7 => "Rarr",
        ];

        foreach ($dictionary as $key => $value) {
            if ($num % $key === 0) {
                $return_string .= $value;
            }
        }

        return $return_string ? $return_string : strval($num);
    }
}

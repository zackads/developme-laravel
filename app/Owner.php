<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    public static function haveWeBananas($number)
    {
        if ($number === 0) {
            return "No we have no bananas";
        } else if ($number === 1) {
            return "Yes we have 1 banana";
        }
        return "Yes we have {$number} bananas";
    }

    public function fullName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'telephone', 'address_1', 'address_2', 'town', 'postcode'];

    public static function checkOwnerExists($email)
    {
        return Owner::where('email', $email)->exists();
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

    public function validPhoneNumber(): bool
    {
        if (gettype($this->telephone) !== "string") {
            return false;
        }

        if (strlen($this->telephone) > 14 || strlen($this->telephone) < 7) {
            return false;
        }

        if (!preg_match('/^\d*$/m', $this->telephone)) {
            return false;
        }

        return true;
    }

    public function formattedPhoneNumber(): string
    {
        return substr($this->telephone, 0, 4) . " " . substr($this->telephone, 4, 3) . " " . substr($this->telephone, 7, 4);
    }

    public function animals()
    {
        return $this->hasMany(Animal::class);
    }
}

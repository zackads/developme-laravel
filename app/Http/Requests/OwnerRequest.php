<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OwnerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // always return true
        // unless you add user logins
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "first_name" => ["required", "string", "max:100"],
            "last_name" => ["required", "string", "max:100"],
            "telephone" => ["required", "string", "max:14"],
            "email" => ["required", "email:rfc,dns", "max:100"],
            "address_1" => ["string", "max:100"],
            "address_2" => ["string", "max:100"],
            "town" => ["string", "max:100"],
            "postcode" => ["string", "max:100"],
        ];
    }
}

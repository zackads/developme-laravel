<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('owners')->insert([
            'first_name' => Str::random(10),
            'last_name' => Str::random(10),
            'email' => Str::random(10) . 'hotmale.com',
            'telephone' => Str::random(7),
        ]);
    }
}

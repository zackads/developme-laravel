<?php

use Illuminate\Database\Seeder;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Owner::class, 50)->create()->each(function ($owner) {
            $owner->animals()->save(factory(App\Animal::class)->make());
        });
    }
}

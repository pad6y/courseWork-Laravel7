<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // factory('App\User', 10)->create();
        \App\Models\User::factory(100)->has(\App\Models\Post::factory()->count(1))->create();
    }
}

<?php

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
        factory(App\Project::class, 5)->create();
        factory(App\Library::class, 5)->create();
        factory(App\Finish::class, 5)->create();
        factory(App\User::class, 1)->create();
    }

}

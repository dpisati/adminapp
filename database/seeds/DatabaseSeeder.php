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
        factory(App\Project::class, 10)->create();
        factory(App\Library::class, 10)->create();
        factory(App\Finish::class, 10)->create();
    }

}

<?php

namespace ModuleMyTraining\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->command->call('module:migrate', ['module' => 'MyTraining']);
        
        $this->call(MyTrainingBaseSeeder::class);
        $this->call(MyTrainingDataSeeder::class);
        $this->call(MyTrainingUserSeeder::class);
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
   		DB::table('professions')->delete();
      	$professions = [
       		['profession' => 'doctor'],
       		['profession' => 'designer'],
       		['profession' => 'developer'],
       		['profession' => 'teacher'],
       		['profession' => 'lawyer'],
       		['profession' => 'driver'],
       		['profession' => 'photographer'],
    	];

    	DB::table('professions')->insert($professions);
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

	    DB::table('questions')->delete();
	    $questions = [
	   	  	[
		        'profession_id' => 1,
		        'question' => "Why did you become a doctor?",
	    	],
	    	[
		        'profession_id' => 1,
		        'question' => "Doctor question 1?",
	    	],
	    	[
		        'profession_id' => 1,
		        'question' => "Doctor question 2?",
	    	],
	    	[
		        'profession_id' => 1,
		        'question' => "Doctor question 3?",
	    	],
	    	[
		        'profession_id' => 1,
		        'question' => "Doctor question 4?",
	    	],
	    	[
		        'profession_id' => 2,
		        'question' => "What about your design background?",
	    	],
	    	[
		        'profession_id' => 2,
		        'question' => "Why did you become a designer?",
	    	],
	    	[
		        'profession_id' => 2,
		        'question' => "What is your design approach?",
	    	],
	    	[
		        'profession_id' => 2,
		        'question' => "How would you describe your design research?",
	    	],
	    	[
		        'profession_id' => 2,
		        'question' => "What software do you use, and when?",
	    	],
	    	[
		        'profession_id' => 2,
		        'question' => "What field, industry, type of work do you prefer?",
	    	],
	    	[
		        'profession_id' => 2,
		        'question' => "What areas of your work or personal development are you hoping to explore further?",
	    	],
	    	[
		        'profession_id' => 2,
		        'question' => "What is the meaning of color and color theory in visual design?",
	    	],
	    	[
		        'profession_id' => 2,
		        'question' => "What makes a great app in terms of visual design?",
	    	],
	    	[
		        'profession_id' => 3,
		        'question' => "Why did you become a developer?",
	    	],
	    	[
		        'profession_id' => 3,
		        'question' => "Developer question 1?",
	    	],
	    	[
		        'profession_id' => 3,
		        'question' => "Developer question 2?",
	    	],
	    	[
		        'profession_id' => 3,
		        'question' => "Developer question 3?",
	    	],
	    	[
		        'profession_id' => 3,
		        'question' => "Developer question 4?",
	    	],
	    	[
		        'profession_id' => 4,
		        'question' => "Why did you become a teacher?",
	    	],
	    	[
		        'profession_id' => 4,
		        'question' => "Teacher question 1?",
	    	],
	    	[
		        'profession_id' => 4,
		        'question' => "Teacher question 2?",
	    	],
	    	[
		        'profession_id' => 4,
		        'question' => "Teacher question 3?",
	    	],
	    	[
		        'profession_id' => 4,
		        'question' => "Teacher question 4?",
	    	],
	    	[
		        'profession_id' => 5,
		        'question' => "Why did you become a lawyer?",
	    	],
	    	[
		        'profession_id' => 5,
		        'question' => "Lawyer question 1?",
	    	],
	    	[
		        'profession_id' => 5,
		        'question' => "Lawyer question 2?",
	    	],
	    	[
		        'profession_id' => 5,
		        'question' => "Lawyer question 3?",
	    	],
	    	[
		        'profession_id' => 5,
		        'question' => "Lawyer question 4?",
	    	],
	    	[
		        'profession_id' => 5,
		        'question' => "Lawyer question 5?",
	    	],
	    	[
		        'profession_id' => 6,
		        'question' => "Why did you become a driver?",
	    	],
	    	[
		        'profession_id' => 6,
		        'question' => "Driver question 1?",
	    	],
	    	[
		        'profession_id' => 6,
		        'question' => "Driver question 2?",
	    	],
	    	[
		        'profession_id' => 6,
		        'question' => "Driver question 3?",
	    	],
	    	[
		        'profession_id' => 6,
		        'question' => "Driver question 4?",
	    	],
	    	[
		        'profession_id' => 6,
		        'question' => "Driver question 5?",
	    	],
	    	[
		        'profession_id' => 7,
		        'question' => "Why did you become a photographer?",
	    	],
	    	[
		        'profession_id' => 7,
		        'question' => "Photographer question 1?",
	    	],
	    	[
		        'profession_id' => 7,
		        'question' => "Photographer question 2?",
	    	],
	    	[
		        'profession_id' => 7,
		        'question' => "Photographer question 3?",
	    	],
	    	[
		        'profession_id' => 7,
		        'question' => "Photographer question 4?",
	    	],
	    	[
		        'profession_id' => 7,
		        'question' => "Photographer question 5?",
	    	],
	    ];
	    DB::table('questions')->insert($questions);
    }
}

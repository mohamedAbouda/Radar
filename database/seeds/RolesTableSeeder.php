<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
		    [
	    		'name' 			=> 'admin',
	    		'display_name' 	=> 'Admin',
		    ],
		    [
	    		'name' 			=> 'customer',
	    		'display_name' 	=> 'Customer',
		    ],
		    [
	    		'name' 			=> 'cook',
	    		'display_name' 	=> 'Cook',
		    ],
		]);
    }
}

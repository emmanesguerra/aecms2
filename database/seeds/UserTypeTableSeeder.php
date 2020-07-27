<?php

use Illuminate\Database\Seeder;

use Core\Model\UserType;

class UserTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->insert([
            'type' => 'Developers',
            'description' => 'AE Developers',
            'created_by' => 1,
        ]);
        
        DB::table('user_types')->insert([
            'type' => 'Admin',
            'description' => 'Admin Users',
            'created_by' => 1,
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class MolduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('modules')->insert([
            'module_name' => 'Contents',
            'description' => 'Manage the contents of the website',
            'route_index_url' => 'maincontents.index',
            'icon' => 'fa-book',
            'created_by' => 1,
            'created_at' => \Carbon\Carbon::now(),
        ]);
        
        DB::table('modules')->insert([
            'module_name' => 'Uploaded Files',
            'description' => 'Manage the uploaded files on the website (except files uploaded thru different modules)',
            'route_index_url' => 'files.index',
            'icon' => 'fa-archive',
            'created_by' => 1,
            'created_at' => \Carbon\Carbon::now(),
        ]);
        
        DB::table('modules')->insert([
            'module_name' => 'Contact Us',
            'description' => 'Manage the settings in the Contact Us page',
            'route_index_url' => 'contactus.index',
            'icon' => 'fa-phone-square',
            'created_by' => 1,
            'created_at' => \Carbon\Carbon::now(),
        ]);
        
        
        $settings = [
            'maincontents' => [
                'maincontents-list',
                'maincontents-create',
                'maincontents-edit',
                'maincontents-delete',
            ],
            'panels' => [
                'panels-list',
                'panels-create',
                'panels-edit',
                'panels-delete',
            ],
            'files' => [
                'files-list',
                'files-create',
                'files-edit',
                'files-delete',
            ],
            'contact' => [
                'contact-list',
                'contact-create',
                'contact-edit',
                'contact-delete',
            ],
        ];

        foreach ($settings as $modules => $permissions) {
            foreach ($permissions as $permission) {
                Permission::create(['name' => $permission, 'module' => $modules]);
            }
        }
    }
}

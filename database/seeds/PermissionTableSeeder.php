<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $settings = [
           'settings' => [
               'settings-list',
               'settings-edit',
           ],
           'users' => [
               'users-list',
               'users-create',
               'users-edit',
               'users-delete',
           ],
           'roles' => [
               'roles-list',
               'roles-create',
               'roles-edit',
               'roles-delete',
           ],
           'modules' => [
               'modules-list',
               'modules-create',
               'modules-edit',
               'modules-delete',
           ],
           'pages' => [
               'pages-list',
               'pages-create',
               'pages-edit',
               'pages-delete',
           ]
        ];


        foreach ($settings as $modules => $permissions) {
            foreach ($permissions as $permission) {
                Permission::create(['name' => $permission, 'module' => $modules]);
            }
        }
    }
}

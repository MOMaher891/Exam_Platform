<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'name'=>'show_roles',
                'display_name'=>'Show Roles',
            ],
            [
                'name'=>'add_roles',
                'display_name'=>'Add Roles',
            ],
            [
                'name'=>'edit_roles',
                'display_name'=>'Edit Roles',
            ],
            [
                'name'=>'delete_roles',
                'display_name'=>'Delete Roles',
            ],


            [
                'name'=>'show_permissions',
                'display_name'=>'Show Permissions',
            ],
            [
                'name'=>'edit_permissions',
                'display_name'=>'Edit Permissions',
            ],


            // todo
        ];


        foreach($data as $d)
        {
            Permission::create($d);
        }
    }
}

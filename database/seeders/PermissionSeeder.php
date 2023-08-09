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
            //Start Roles Permission
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
            //End Roles Permission

            //Start Permission

            [
                'name'=>'show_permissions',
                'display_name'=>'Show Permissions',
            ],
            [
                'name'=>'edit_permissions',
                'display_name'=>'Edit Permissions',
            ],
            //End Permission

            //Start Staff Permission

            [
                'name'=>'show_staff',
                'display_name'=>'Show Staff',
            ],
            [
                'name'=>'add_staff',
                'display_name'=>'Add Staff',
            ],
            [
                'name'=>'edit_staff',
                'display_name'=>'Edit Staff',
            ],
            [
                'name'=>'delete_staff',
                'display_name'=>'Delete Staff',
            ],
            // End staff permission

            //Start Exam Permission
            [
                'name'=>'show_exam',
                'display_name'=>'Show exam',
            ],
            [
                'name'=>'add_exam',
                'display_name'=>'Add exam',
            ],
            [
                'name'=>'edit_exam',
                'display_name'=>'Edit exam',
            ],
            [
                'name'=>'delete_exam',
                'display_name'=>'Delete exam',
            ],

            //End Exam Permission

            //Start Category Permission
            [
                'name'=>'show_category',
                'display_name'=>'Show category',
            ],
            [
                'name'=>'add_category',
                'display_name'=>'Add category',
            ],
            [
                'name'=>'edit_category',
                'display_name'=>'Edit category',
            ],
            [
                'name'=>'delete_category',
                'display_name'=>'Delete category',
            ],

            //End Category Permission


            // todo
        ];


        foreach($data as $d)
        {
            Permission::firstOrCreate($d);
        }
    }
}

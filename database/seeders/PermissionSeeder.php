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
                'name' => 'show_roles',
                'display_name' => 'Show Roles',
            ],
            [
                'name' => 'add_roles',
                'display_name' => 'Add Roles',
            ],
            [
                'name' => 'edit_roles',
                'display_name' => 'Edit Roles',
            ],
            [
                'name' => 'delete_roles',
                'display_name' => 'Delete Roles',
            ],
            //End Roles Permission

            //Start Permission

            [
                'name' => 'show_permissions',
                'display_name' => 'Show Permissions',
            ],
            [
                'name' => 'edit_permissions',
                'display_name' => 'Edit Permissions',
            ],
            //End Permission

            //Start Staff Permission

            [
                'name' => 'show_staff',
                'display_name' => 'Show Staff',
            ],
            [
                'name' => 'add_staff',
                'display_name' => 'Add Staff',
            ],
            [
                'name' => 'edit_staff',
                'display_name' => 'Edit Staff',
            ],
            [
                'name' => 'delete_staff',
                'display_name' => 'Delete Staff',
            ],
            // End staff permission

            //Start Exam Permission
            [
                'name' => 'show_exam',
                'display_name' => 'Show exam',
            ],
            [
                'name' => 'add_exam',
                'display_name' => 'Add exam',
            ],
            [
                'name' => 'edit_exam',
                'display_name' => 'Edit exam',
            ],
            [
                'name' => 'delete_exam',
                'display_name' => 'Delete exam',
            ],

            //End Exam Permission

            //Start Category Permission
            [
                'name' => 'show_category',
                'display_name' => 'Show category',
            ],
            [
                'name' => 'add_category',
                'display_name' => 'Add category',
            ],
            [
                'name' => 'edit_category',
                'display_name' => 'Edit category',
            ],
            [
                'name' => 'delete_category',
                'display_name' => 'Delete category',
            ],

            //End Category Permission

            //Start Inspector Permission
            [
                'name' => 'show_inspector',
                'display_name' => 'Show inspector',
            ],
            [
                'name' => 'add_inspector',
                'display_name' => 'Add inspector',
            ],
            [
                'name' => 'edit_inspector',
                'display_name' => 'Edit inspector',
            ],
            [
                'name' => 'delete_inspector',
                'display_name' => 'Delete inspector',
            ],
            [
                'name' => 'accept_inspector',
                'display_name' => 'Accept inspector',
            ],
            [
                'name' => 'reject_inspector',
                'display_name' => 'Reject inspector',
            ],

            //End Inspector Permission

            [
                'name' => 'show_center',
                'display_name' => 'Show Centers',
            ],
            [
                'name' => 'add_center',
                'display_name' => 'Add Centers',
            ],
            [
                'name' => 'edit_center',
                'display_name' => 'Edit Centers',
            ],
            [
                'name' => 'delete_center',
                'display_name' => 'Delete Centers',
            ],

            [
                'name' => 'show_exam_times',
                'display_name' => 'Show Apply Exam',
            ],
            [
                'name' => 'add_exam_times',
                'display_name' => 'Add Apply Exam',
            ],
            [
                'name' => 'edit_exam_times',
                'display_name' => 'Edit Apply Exam',
            ],
            [
                'name' => 'delete_exam_times',
                'display_name' => 'Delete Apply Exam',
            ],


            // Apply in Exams
            [
                'name' => 'show_inspector_exams',
                'display_name' => 'Show Inspector Exams',
            ],
            [
                'name' => 'apply_inspector_exams',
                'display_name' => 'Apply in Exams',
            ],


            //Inspector Exams Profile
            [
                'name' => 'show_inspector_exams_profile',
                'display_name' => 'Show Exams Profile',
            ],

            [
                'name' => 'block_inspector',
                'display_name' => 'Block inspector',
            ],


        ];


        foreach ($data as $d) {
            Permission::firstOrCreate($d);
        }
    }
}

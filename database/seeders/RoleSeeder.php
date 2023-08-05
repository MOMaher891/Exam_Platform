<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
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
                'name'=>'superadmin',
                'display_name'=>'Super Admin',
                'description'=>'Has All Access'
            ],
            [
                'name'=>'admin',
                'display_name'=>'Admin',
                'description'=>'Has Center Access'
            ],
            [
                'name'=>'analyst',
                'display_name'=>'Analyst',
                'description'=>'Has Finicial Access'
            ],
        ];
        // Role::create($data);
        foreach($data as $d)
        {
            Role::create($d);
        }
    }
}

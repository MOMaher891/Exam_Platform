<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = User::create([
            'name'=>'superadmin',
            'email'=>'superadmin@admin.com',
            'password'=>'$2y$10$YR1lKIXnjGDgkoDp2AQsBuBkio5Z6eoilLWok/cM2Bietc724w8Te',
        ]);
        $data->attachRole('superadmin');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Roles;
use App\Models\Years;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         //\App\Models\User::factory(10)->create();

        Roles::create([
            'name' => 'Admin',
            'guard_name' => 'web'
        ]);

        Roles::create([
            'name' => 'Teacher',
            'guard_name' => 'web'
        ]);

         Roles::create([
            'name' => 'Student',
            'guard_name' => 'web'
        ]);

        Roles::create([
            'name' => 'Parent',
            'guard_name' => 'web'
        ]);

        Years::create([
            'years' => 'KS1',

        ]);
        Years::create([
            'years' => 'KS2',

        ]);

        $user = User::create([
            'name'          => 'Admin',
            'email'         => 'admin@iteach.com',
            'password'      => bcrypt('12345678'),
            'created_at'    => date("Y-m-d H:i:s")
        ]);

        $user->assignRole('Admin');



    }
}

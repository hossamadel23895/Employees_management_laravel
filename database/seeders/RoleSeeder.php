<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => __('roles.admin') ]);
        Role::create(['name' => __('roles.leader_1') ]);
        Role::create(['name' => __('roles.leader_2') ]);
        Role::create(['name' => __('roles.employee')]);
    }
}

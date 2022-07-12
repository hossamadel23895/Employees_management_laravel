<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class TypeSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Type::query()->insert(['name' => 'paid', 'color' => 'green', 'created_by' => 1, 'updated_by' => 1,]);
        Type::query()->insert(['name' => 'family', 'color' => 'blue', 'created_by' => 1, 'updated_by' => 1,]);
        Type::query()->insert(['name' => 'emergency', 'color' => 'red', 'created_by' => 1, 'updated_by' => 1,]);
        Type::query()->insert(['name' => 'non_paid', 'color' => 'yellow', 'created_by' => 1, 'updated_by' => 1,]);
    }
}

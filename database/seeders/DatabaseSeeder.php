<?php

namespace Database\Seeders;

use App\Enums\UserTypes;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\UserType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        UserType::factory()->createMany([
            ['name'=>'administrator'],
            ['name'=>'client'],
        ]);

        User::factory()->create([
            'name' => 'Vlad',
            'email' => 'vlad_admin@test.com',
            'user_type_id' => UserTypes::Admin->value,
            'password' => bcrypt('1234')
        ]);

        Product::factory(15)->create();
    }
}

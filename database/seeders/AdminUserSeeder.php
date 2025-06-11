<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'pricehubx@gmail.com'],
            [
                'name' => 'José Price',
                'password' => Hash::make('chunChula76$'),
            ]
        );
    }
}

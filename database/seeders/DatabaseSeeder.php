<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\user_roles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        user_roles::updateOrCreate(['id' => 1], ['roles' => 'Admin', 'is_deleted' => 1]);
        user_roles::updateOrCreate(['id' => 2], ['roles' => 'User', 'is_deleted' => 1]);

        if (config('admin.email') && config('admin.password')) {
            User::updateOrCreate(
                ['email' => config('admin.email')],
                [
                    'name' => config('admin.name'),
                    'username' => config('admin.username'),
                    'password' => Hash::make(config('admin.password')),
                    'picture' => User::DEFAULT_PICTURE,
                    'role_id' => 1,
                    'is_deleted' => 1,
                ]
            );
        }

        if (app()->environment('local')) {
            $this->call(DemoMarketplaceSeeder::class);
        }
    }
}

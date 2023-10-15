<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::query()
            ->firstOrCreate([
                'name' => User::SYSADMIN_ROLE
            ]);
        Role::query()
            ->firstOrCreate([
                'name' => User::USER_ROLE
            ]);

        $user = User::query()
            ->firstOrCreate(
                [
                    'name' => 'Tóth Gergő',
                    'email' => config('app.default_user_email_for_import')
                ],
                [
                    'password' => Str::password()
                ]
            );

        $user->assignRole(User::SYSADMIN_ROLE);
    }
}

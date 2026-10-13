<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrNew(['email' => 'admin@example.com']);
        if ($admin->exists) {
            $admin->forceFill(['is_admin' => true])->save();

            return;
        }
        $password = Str::password(20);
        $admin->forceFill([
            'name' => 'Admin',
            'password' => $password,
            'is_admin' => true,
            'email_verified_at' => now(),
        ])->save();
        $this->command?->info('Admin email: '.$admin->email);
        $this->command?->info('Admin password: '.$password);
    }
}

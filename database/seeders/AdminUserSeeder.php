<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Buat/perbarui akun admin default.
     * Email & password bisa diatur lewat .env (ADMIN_EMAIL, ADMIN_PASSWORD),
     * jika tidak diatur akan memakai nilai default di bawah ini.
     */
    public function run(): void
    {
        $email = env('ADMIN_EMAIL', 'admin@ecoclayart.com');
        $password = env('ADMIN_PASSWORD', 'admin123');

        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => 'Admin',
                'password' => Hash::make($password),
                'email_verified_at' => now(),
            ]
        );
    }
}

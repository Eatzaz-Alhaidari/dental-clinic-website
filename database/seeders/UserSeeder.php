<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Super Admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@dentalclinic.com'],
            [
                'name' => 'المدير العام (Super Admin)',
                'password' => Hash::make('password'),
                'branch_id' => null, // Super admin oversees all branches
                'email_verified_at' => now(),
            ]
        );
        $admin->syncRoles(['super_admin']);

        // 2. Receptionist for Branch 1 (Sana'a)
        $receptionSanaa = User::updateOrCreate(
            ['email' => 'reception.sanaa@dentalclinic.com'],
            [
                'name' => 'استقبال فرع صنعاء',
                'password' => Hash::make('password'),
                'branch_id' => 1,
                'email_verified_at' => now(),
            ]
        );
        $receptionSanaa->syncRoles(['receptionist']);

        // 3. Receptionist for Branch 2 (Ibb)
        $receptionIbb = User::updateOrCreate(
            ['email' => 'reception.ibb@dentalclinic.com'],
            [
                'name' => 'استقبال فرع إب',
                'password' => Hash::make('password'),
                'branch_id' => 2,
                'email_verified_at' => now(),
            ]
        );
        $receptionIbb->syncRoles(['receptionist']);
    }
}

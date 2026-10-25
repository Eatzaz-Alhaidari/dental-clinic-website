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

        // 2. Receptionist for Branch 1 (Riyadh)
        $receptionRiyadh = User::updateOrCreate(
            ['email' => 'reception.riyadh@dentalclinic.com'],
            [
                'name' => 'استقبال فرع الرياض',
                'password' => Hash::make('password'),
                'branch_id' => 1,
                'email_verified_at' => now(),
            ]
        );
        $receptionRiyadh->syncRoles(['receptionist']);

        // 3. Receptionist for Branch 2 (Jeddah)
        $receptionJeddah = User::updateOrCreate(
            ['email' => 'reception.jeddah@dentalclinic.com'],
            [
                'name' => 'استقبال فرع جدة',
                'password' => Hash::make('password'),
                'branch_id' => 2,
                'email_verified_at' => now(),
            ]
        );
        $receptionJeddah->syncRoles(['receptionist']);

        // 4. Receptionist for Branch 3 (Taif)
        $receptionTaif = User::updateOrCreate(
            ['email' => 'reception.taif@dentalclinic.com'],
            [
                'name' => 'استقبال فرع الطائف',
                'password' => Hash::make('password'),
                'branch_id' => 3,
                'email_verified_at' => now(),
            ]
        );
        $receptionTaif->syncRoles(['receptionist']);
    }
}

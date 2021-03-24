<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolePetugas = Role::create(['name' => 'petugas']);
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleUser = Role::create(['name' => 'user']);
        
        
        $admin = User::create([
            'nik'           => '1234512637482856',
            'nama'          => 'Admin',
            'email'         => 'admin@gmail.com',
            'email_verified_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'password'      => Hash::make('admin'),
            'telp'          => '1273890415239',
        ]);
        $admin->assignRole([$roleAdmin]);

        $petugas = User::create([
            'nik'           => '1234512637482946',
            'nama'          => 'Petugas',
            'email'         => 'petugas@gmail.com',
            'email_verified_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'password'      => Hash::make('petugas'),
            'telp'          => '1273890415239',
        ]);
        $petugas->assignRole([$rolePetugas]);

        $user = User::create([
            'nik'           => '1234512638502946',
            'nama'          => 'User',
            'email'         => 'user@gmail.com',
            'email_verified_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'password'      => Hash::make('user'),
            'telp'          => '1273890415239',
        ]);
        $user->assignRole([$roleUser]);
    }
}

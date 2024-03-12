<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        TaskStatus::insert([
            [
                'name' => 'Не в работе'
            ], [
                'name' => 'В работе'
            ], [
                'name' => 'Завершено'
            ]
        ]);
        Role::insert([
            [
                'name' => 'user',
                'guard_name' => 'user'
            ], [
                'name' => 'admin',
                'guard_name' => 'admin'
            ]
        ]);
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('12345678'),
        ]);
        $admin->roles()->attach(2);
    }
}

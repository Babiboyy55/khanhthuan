<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'editor']);

        $admin = User::query()->firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('123456'),
            ]
        );

        if (method_exists($admin, 'assignRole')) {
            $admin->assignRole($adminRole);
        }

        User::query()->firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
            ]
        );

        $this->call([
                // Phải tạo danh mục trước
            CategorySeeder::class,
                // Sau đó mới tạo bài viết (vì bài viết cần ID của danh mục)
            PostSeeder::class,
            ProjectSeeder::class,
            ServiceSeeder::class,
        ]);
    }
}

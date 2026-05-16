<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Category::create(['name' => 'Tin tức chuyên ngành', 'slug' => 'tin-tuc-chuyen-nganh']);
        \App\Models\Category::create(['name' => 'Thông báo', 'slug' => 'thong-bao']);
    }
}

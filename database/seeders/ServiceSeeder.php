<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => 'Giam sat va tu van xay dung',
                'summary' => 'Giam sat chat luong, tien do va an toan lao dong trong thi cong.',
                'image' => '/images/card-image1.jpg',
            ],
            [
                'title' => 'Thi nghiem va kiem dinh vat lieu xay dung',
                'summary' => 'Thu nghiem vat lieu, danh gia chi tieu co ly va hoa hoc.',
                'image' => '/images/card-image2.jpg',
            ],
            [
                'title' => 'Khao sat dia chat - dia hinh',
                'summary' => 'Danh gia dieu kien nen mong, dia chat cong trinh.',
                'image' => '/images/card-image3.jpg',
            ],
        ];

        foreach ($items as $index => $item) {
            $slug = Str::slug($item['title']);

            Service::query()->updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => $item['title'],
                    'slug' => $slug,
                    'summary' => $item['summary'],
                    'description' => $item['summary'] . "\n\nNoi dung chi tiet se duoc cap nhat sau.",
                    'featured_image' => $item['image'],
                    'sort_order' => $index + 1,
                    'status' => 'published',
                ]
            );
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => 'Kiem dinh vat lieu xay dung la gi',
                'excerpt' => 'Tong quan ve quy trinh kiem dinh vat lieu trong xay dung.',
                'image' => '/images/post-item1.jpg',
            ],
            [
                'title' => 'Vai tro cua khao sat dia chat trong xay dung',
                'excerpt' => 'Vi sao khao sat dia chat la buoc then chot cua moi du an.',
                'image' => '/images/post-item2.jpg',
            ],
            [
                'title' => 'Cac tieu chuan thi nghiem vat lieu xay dung',
                'excerpt' => 'Tong hop quy trinh va tieu chuan thu nghiem vat lieu.',
                'image' => '/images/post-item3.jpg',
            ],
            [
                'title' => 'Quy trinh kiem dinh chat luong cong trinh',
                'excerpt' => 'Cac buoc lap ke hoach va kiem dinh chat luong cong trinh.',
                'image' => '/images/post-item4.jpg',
            ],
        ];

        foreach ($items as $item) {
            Post::query()->updateOrCreate(
                ['slug' => Str::slug($item['title'])],
                [
                    'category_id' => 1,
                    'author_id' => 1,
                    'title' => $item['title'],
                    'slug' => Str::slug($item['title']),
                    'excerpt' => $item['excerpt'],
                    'content' => $item['excerpt'] . "\n\nNoi dung chi tiet se duoc cap nhat sau.",
                    'featured_image' => $item['image'],
                    'views' => 0,
                    'status' => 'published',
                ]
            );
        }
    }
}

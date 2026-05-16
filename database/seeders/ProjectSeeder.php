<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        // Xóa dữ liệu cũ để tránh trùng lặp
        Project::truncate();

        $projects = [
            // Cầu / Đường cao tốc
            ['title' => 'Cầu sông Hương', 'category' => 'bridge', 'location' => 'Ninh Thuận', 'year' => 2024, 'image' => 'Picture6.png'],
            ['title' => 'Cầu Kim Liên', 'category' => 'bridge', 'location' => 'Ninh Thuận', 'year' => 2024, 'image' => 'Picture1.png'],
            ['title' => 'Địa chất công trình cầu', 'category' => 'bridge', 'location' => 'Ninh Thuận', 'year' => 2024, 'image' => 'Picture5.png'],
            ['title' => 'Trung tâm hành chính', 'category' => 'bridge', 'location' => 'Ninh Thuận', 'year' => 2024, 'image' => 'Picture8.png'],

            // Nhà máy công nghiệp
            ['title' => 'Nhà máy Up Shine Lighting', 'category' => 'factory', 'location' => 'Bình Thuận', 'year' => 2023, 'image' => 'Picture9.png'],
            ['title' => 'Nhà máy CDC LEASING', 'category' => 'factory', 'location' => 'Bình Thuận', 'year' => 2023, 'image' => 'Picture10.png'],
            ['title' => 'Dự án pin TOPCON BOVIET', 'category' => 'factory', 'location' => 'Bình Thuận', 'year' => 2023, 'image' => 'Picture11.png'],
            ['title' => 'Hạ tầng khu công nghiệp', 'category' => 'factory', 'location' => 'Bình Thuận', 'year' => 2023, 'image' => 'Picture4.png'],

            // Khu đô thị - dân cư
            ['title' => 'Trường THCS Nhân Huệ', 'category' => 'urban', 'location' => 'Phú Yên', 'year' => 2021, 'image' => 'Picture2.png'],
            ['title' => 'Khu dân cư mở rộng', 'category' => 'urban', 'location' => 'Phú Yên', 'year' => 2021, 'image' => 'Picture3.png'],
            ['title' => 'Hạ tầng khu đô thị mới', 'category' => 'urban', 'location' => 'Phú Yên', 'year' => 2021, 'image' => 'Picture4.png'],
            ['title' => 'Khu nghỉ dưỡng sinh thái', 'category' => 'urban', 'location' => 'Phú Yên', 'year' => 2021, 'image' => 'Picture7.png'],
        ];

        foreach ($projects as $item) {
            Project::create([
                'title' => $item['title'],
                'slug' => Str::slug($item['title']),
                'category' => $item['category'],
                'location' => $item['location'],
                'year' => $item['year'],
                'image' => $item['image'],
                'summary' => 'Thông tin mô tả ngắn về phạm vi tư vấn, giám sát và kiểm định.',
                'description' => 'Nội dung chi tiết đang được cập nhật...',
                'status' => 'published'
            ]);
        }
    }
}
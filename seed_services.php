<?php
require "vendor/autoload.php";
$app = require_once __DIR__."/bootstrap/app.php";
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Service;
use Illuminate\Support\Str;

$coreServices = [
    [
        "title" => "Thi Công Xây D?ng & H? T?ng",
        "summary" => "Chuyên thi công các công trình du?ng s?t, du?ng b?, công trình công nghi?p, công ích và nhà ? các lo?i.",
        "icon" => "fa-building-shield",
        "image" => "thicong.avif"
    ],
    [
        "title" => "Co Ði?n & Hoàn Thi?n",
        "summary" => "L?p d?t h? th?ng di?n, c?p thoát nu?c, di?u hòa không khí và hoàn thi?n toàn b? công trình xây d?ng.",
        "icon" => "fa-bolt",
        "image" => "anh3.png"
    ],
    [
        "title" => "V?t Tu & Thi?t B? Co Gi?i",
        "summary" => "Khai thác, buôn bán v?t li?u xây d?ng (dá, cát, s?i). Mua bán và cho thuê máy móc, thi?t b? khai khoáng, thi công.",
        "icon" => "fa-truck-monster",
        "image" => "maymuc.png"
    ],
    [
        "title" => "Thí Nghi?m & Ki?m Ð?nh",
        "summary" => "Thí nghi?m v?t li?u, ki?m d?nh các ch? tiêu n?n móng, k?t c?u m?t du?ng công trình giao thông, xây d?ng.",
        "icon" => "fa-microscope",
        "image" => "anh4.png"
    ]
];

foreach ($coreServices as $index => $item) {
    Service::updateOrCreate(
        ["title" => $item["title"]],
        [
            "slug" => Str::slug($item["title"]),
            "summary" => $item["summary"],
            "description" => "<p>" . $item["summary"] . "</p>",
            "icon" => $item["icon"],
            "image" => $item["image"],
            "status" => "published",
            "sort_order" => $index + 1
        ]
    );
}

echo "Seeded 4 core services successfully.";

<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;

Route::get('/', function () {
    $latestPosts = Post::query()
        ->orderByDesc('created_at')
        ->limit(3)
        ->get();

    $servicesHome = Service::query()
        ->where('status', 'published')
        ->orderBy('sort_order')
        ->limit(3)
        ->get();

    $projectsHome = Project::query()
        ->where('status', 'published')
        ->orderByDesc('year')
        ->orderByDesc('created_at')
        ->limit(10)
        ->get();

    return view('home', [
        'latestPosts' => $latestPosts,
        'servicesHome' => $servicesHome,
        'projectsHome' => $projectsHome,
    ]);
})->name('home');

Route::view('/gioi-thieu', 'about')->name('about');
Route::view('/ve-chung-toi', 'about');
Route::get('/dich-vu', [ServiceController::class, 'index'])->name('services');
Route::get('/dich-vu/{slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/du-an', [ProjectController::class, 'index'])->name('projects');
Route::get('/du-an/{id}', [ProjectController::class, 'show'])->name('projects.show');
Route::view('/doi-tac-khach-hang', 'partners')->name('partners');
Route::view('/chung-chi', 'certificates')->name('certificates');
Route::get('/tin-tuc', [PostController::class, 'index'])->name('news');
Route::get('/tin-tuc/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/lien-he', function () {
    return view('contact');
})->name('contact');
Route::post('/lien-he', [\App\Http\Controllers\Admin\ContactController::class, 'store'])->name('contact.store');
Route::view('/chinh-sach-bao-mat', 'privacy')->name('privacy');

Route::get('/giam-sat-va-tu-van-xay-dung', function () {
    return app(ServiceController::class)->showLegacy('giam-sat-va-tu-van-xay-dung');
});
Route::get('/thi-nghiem-kiem-dinh-vat-lieu-xay-dung', function () {
    return app(ServiceController::class)->showLegacy('thi-nghiem-va-kiem-dinh-vat-lieu-xay-dung');
});
Route::get('/khao-sat-dia-chat-dia-hinh', function () {
    return app(ServiceController::class)->showLegacy('khao-sat-dia-chat-dia-hinh');
});

Route::get('/danh-muc-thiet-bi', function () {
    return view('news-category', [
        'title' => 'Danh muc thiet bi',
    ]);
});

Route::get('/danh-muc-phep-thu', function () {
    return view('news-category', [
        'title' => 'Danh muc phep thu',
    ]);
});

Route::middleware(['auth', 'role:admin|editor'])->prefix('admin')->name('admin.')->group(function () {
    Route::redirect('/', '/admin/dashboard');

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::post('posts/upload', [\App\Http\Controllers\Admin\PostController::class, 'uploadImage'])
        ->name('posts.upload');
    Route::delete('posts/bulk-delete', [\App\Http\Controllers\Admin\PostController::class, 'bulkDestroy'])
        ->name('posts.bulk-destroy');
    Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);
    Route::delete('services/bulk-delete', [\App\Http\Controllers\Admin\ServiceController::class, 'bulkDestroy'])
        ->name('services.bulk-destroy');
    Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);

    Route::delete('projects/bulk-delete', [\App\Http\Controllers\Admin\ProjectController::class, 'bulkDestroy'])
        ->name('projects.bulk-destroy');
    Route::resource('projects', \App\Http\Controllers\Admin\ProjectController::class);

    // Bọc route users lại để chỉ ADMIN mới có quyền thêm/sửa/xóa user
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    });

    Route::resource('document-categories', \App\Http\Controllers\Admin\DocumentCategoryController::class)->except(['show']);

    Route::resource('contacts', \App\Http\Controllers\Admin\ContactController::class)->only(['index', 'destroy']);

    Route::post('/contacts/{id}/status', [\App\Http\Controllers\Admin\ContactController::class, 'updateStatus'])->name('contacts.updateStatus');

    // Danh sách tài liệu
    Route::get('thu-vien', [DocumentController::class, 'adminIndex'])->name('documents.index');

    // Trang hiển thị Form Upload
    Route::get('thu-vien/them-moi', [DocumentController::class, 'create'])->name('documents.create');

    // Xử lý dữ liệu khi bấm nút "Tải lên"
    Route::post('thu-vien/luu', [DocumentController::class, 'store'])->name('documents.store');

    // Trang sửa tài liệu
    Route::get('thu-vien/{document}/sua', [DocumentController::class, 'edit'])->name('documents.edit');

    // Cập nhật tài liệu
    Route::put('thu-vien/{document}', [DocumentController::class, 'update'])->name('documents.update');

    // Xóa tài liệu hàng loạt
    Route::delete('thu-vien/bulk-delete', [DocumentController::class, 'bulkDestroy'])->name('documents.bulk-destroy');

    // Xóa tài liệu
    Route::delete('thu-vien/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Trang chi tiết tài liệu (Xem PDF trực tiếp) - phải đặt TRƯỚC route {category}
Route::get('/thu-vien/chi-tiet/{id}', [DocumentController::class, 'show'])->name('documents.show');

// Xử lý nút Tải về - phải đặt TRƯỚC route {category}
Route::get('/thu-vien/download/{id}', [DocumentController::class, 'download'])->name('document.download');

// Trang chính Thư viện
Route::get('/thu-vien', [DocumentController::class, 'mainIndex'])->name('library.index');

// Hiển thị danh sách tài liệu theo danh mục (wildcard - phải đặt SAU các route cụ thể)
Route::get('/thu-vien/{category}', [DocumentController::class, 'index']);

require __DIR__ . '/auth.php';

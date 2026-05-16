<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Tên tài liệu hiển thị
            $table->string('category'); // Phân loại: 'tieu-chuan-thi-cong', 'excel-ung-dung'...
            $table->string('file_path'); // Đường dẫn file lưu trong storage
            $table->string('file_extension')->nullable(); // Đuôi file (pdf, docx, xlsx)
            $table->string('file_size')->nullable(); // Dung lượng (ví dụ: 2.5 MB)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};

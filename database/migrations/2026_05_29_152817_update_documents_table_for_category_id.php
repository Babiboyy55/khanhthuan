<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            // Thêm cột khóa ngoại mới
            if (!Schema::hasColumn('documents', 'document_category_id')) {
                $table->unsignedBigInteger('document_category_id')->nullable()->after('title');
            }
            
            // Xóa bỏ cột category dạng chữ cũ (để tránh gây lỗi hệ thống)
            if (Schema::hasColumn('documents', 'category')) {
                $table->dropColumn('category');
            }
        });
    }

    public function down()
    {
        Schema::table('documents', function (Blueprint $table) {
            if (Schema::hasColumn('documents', 'category')) {
                $table->string('category')->nullable();
            }
            if (Schema::hasColumn('documents', 'document_category_id')) {
                $table->dropColumn('document_category_id');
            }
        });
    }
};
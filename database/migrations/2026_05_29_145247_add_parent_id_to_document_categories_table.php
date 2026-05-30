<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('document_categories', function (Blueprint $table) {
            // Kiểm tra và thêm cột parent_id nếu chưa có
            if (!Schema::hasColumn('document_categories', 'parent_id')) {
                $table->unsignedBigInteger('parent_id')->nullable()->after('id');
            }
            
            // Kiểm tra và thêm cột type (vì trong Model mới cũng có dùng)
            if (!Schema::hasColumn('document_categories', 'type')) {
                $table->string('type')->nullable()->after('slug');
            }
        });
    }

    public function down()
    {
        Schema::table('document_categories', function (Blueprint $table) {
            if (Schema::hasColumn('document_categories', 'parent_id')) {
                $table->dropColumn('parent_id');
            }
            if (Schema::hasColumn('document_categories', 'type')) {
                $table->dropColumn('type');
            }
        });
    }
};
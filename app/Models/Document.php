<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    // Khai báo các cột được phép thêm dữ liệu
    protected $fillable = [
        'title',
        'document_category_id', // Đã đổi từ 'category' sang 'document_category_id'
        'file_path',
        'file_extension',
        'file_size'
    ];

    // Khai báo mối quan hệ với bảng DocumentCategory
    public function category()
    {
        return $this->belongsTo(DocumentCategory::class, 'document_category_id');
    }
}
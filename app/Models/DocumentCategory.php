<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentCategory extends Model
{
    use HasFactory;

    // Cập nhật lại các trường cho khớp với Migration mới
    protected $fillable = ['name', 'slug', 'type', 'parent_id'];

    // 1. Liên kết lấy các thư mục con
    public function children() 
    { 
        return $this->hasMany(DocumentCategory::class, 'parent_id'); 
    }

    // 2. Liên kết lấy thư mục cha (Sửa lỗi undefined method parent)
    public function parent() 
    { 
        return $this->belongsTo(DocumentCategory::class, 'parent_id'); 
    }

    // 3. Liên kết lấy các tài liệu thuộc thư mục này
    public function documents() 
    { 
        return $this->hasMany(Document::class, 'document_category_id'); 
    }
}
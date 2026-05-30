<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    // ==========================================
    // CÁC HÀM DÀNH CHO KHÁCH TRUY CẬP (CLIENT)
    // ==========================================

    public function mainIndex()
    {
        // Lấy các thư mục gốc để hiển thị ngoài trang chủ thư viện
        $categories = DocumentCategory::whereNull('parent_id')->with('children')->get();
        return view('library.main', compact('categories'));
    }

    public function index(Request $request, string $slug)
    {
        // 1. Lấy trực tiếp slug trên URL để tìm thư mục (Bỏ qua mảng phiên dịch)
        $currentCategory = \App\Models\DocumentCategory::where('slug', $slug)->firstOrFail();

        // 2. Lấy danh sách tài liệu
        $subSlug = $request->query('sub');
        $query = \App\Models\Document::with('category');

        if ($subSlug) {
            $subCategory = \App\Models\DocumentCategory::where('slug', $subSlug)->firstOrFail();
            $query->where('document_category_id', $subCategory->id);
        } else {
            $categoryIds = $currentCategory->children()->pluck('id')->push($currentCategory->id);
            $query->whereIn('document_category_id', $categoryIds);
        }

        $documents = $query->latest()->get();

        // 3. Tự động lấy tên thư mục làm tiêu đề trang
        $title = $currentCategory->name;
        $subFolders = $currentCategory->children;

        return view('library.index', compact('documents', 'title', 'subFolders', 'currentCategory'));
    }

    public function show($id)
    {
        $document = Document::with('category')->findOrFail($id);
        
        $otherDocuments = Document::where('document_category_id', $document->document_category_id)
            ->where('id', '!=', $id)
            ->latest()
            ->limit(10)
            ->get();

        return view('library.show', compact('document', 'otherDocuments'));
    }

    public function download(int $id)
    {
        $document = Document::findOrFail($id);
        
        // Sử dụng storage_path và response()->download để VS Code nhận diện chuẩn 100%
        $fullPath = storage_path('app/public/' . $document->file_path);

        if ($document->file_path && file_exists($fullPath)) {
            return response()->download($fullPath, $document->title . '.' . $document->file_extension);
        }

        return back()->with('error', 'File không tồn tại trên hệ thống!');
    }

    // ==========================================
    // CÁC HÀM DÀNH CHO QUẢN TRỊ VIÊN (ADMIN)
    // ==========================================

    public function adminIndex(Request $request)
    {
        $categoryId = $request->query('category');
        $group = $request->query('group', 'library');
        $sort = $request->query('sort', 'newest');

        $query = Document::with('category');

        if ($categoryId) {
            $query->where('document_category_id', $categoryId);
        } else {
            // TỰ ĐỘNG LẤY TẤT CẢ THƯ MỤC (VÀ THƯ MỤC CON) THUỘC NHÓM LIBRARY HOẶC COMPETENCY
            $validCategoryIds = DocumentCategory::where('type', $group)
                ->orWhereHas('parent', function ($q) use ($group) {
                    $q->where('type', $group);
                })
                ->pluck('id');
                
            $query->whereIn('document_category_id', $validCategoryIds);
        }

        if ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $documents = $query->paginate(15)->withQueryString();

        // Cập nhật bộ lọc Dropdown: Chỉ hiển thị các thư mục thuộc Group hiện tại
        $categoriesDropdown = DocumentCategory::whereNull('parent_id')
            ->where('type', $group)
            ->with('children')
            ->get();

        return view('admin.documents.index', compact('documents', 'categoryId', 'sort', 'group', 'categoriesDropdown'));
    }

    public function create(Request $request)
    {
        $group = $request->query('group', 'library');
        
        // Khi thêm tài liệu mới ở trang nào, chỉ xổ ra danh sách thư mục của trang đó
        $categories = DocumentCategory::whereNull('parent_id')
            ->where('type', $group)
            ->with('children')
            ->get();
            
        return view('admin.documents.create', compact('categories', 'group'));
    }

    public function edit(Document $document)
    {
        $group = $document->category->type ?? 'library';
        $categories = DocumentCategory::whereNull('parent_id')
            ->where('type', $group)
            ->with('children')
            ->get();
        return view('admin.documents.edit', compact('document', 'categories'));
    }

    public function store(Request $request)
    {
        $categoryId = $request->input('document_category_id');
        $category = DocumentCategory::find($categoryId);
        
        $maxSize = 51200; 
        if ($category && ($category->slug === 'ho-so-nang-luc-chung' || $category->slug === 'cong-bo-nang-luc' || in_array($category->slug, ['giay-dang-ky-kinh-doanh', 'giay-chung-nhan-du-dk-hoat-dong-tn', 'giay-chung-nhan-hieu-chuan-thiet-bi', 'danh-muc-may-moc-thiet-bi-ptn', 'danh-sach-can-bo-phong-thi-nghiem']))) {
            $maxSize = 102400; 
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'document_category_id' => 'required|exists:document_categories,id', // Update từ category sang document_category_id
            'file' => "required|mimes:pdf,doc,docx,xls,xlsx,xlsm|max:$maxSize",
        ], [
            'file.mimes' => 'Chỉ hỗ trợ file PDF, Word, Excel.',
            'file.max' => 'Dung lượng file vượt quá giới hạn cho phép (' . ($maxSize/1024) . 'MB).',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $sizeInBytes = $file->getSize();
            $size = $sizeInBytes > 1048576 ? round($sizeInBytes / 1048576, 2) . ' MB' : round($sizeInBytes / 1024, 2) . ' KB';
            
            $path = $file->store('documents', 'public');

            Document::create([
                'title' => $request->title,
                'document_category_id' => $request->document_category_id,
                'file_path' => $path,
                'file_extension' => $extension,
                'file_size' => $size,
            ]);

            return back()->with('success', 'Đã tải tài liệu lên thành công!');
        }

        return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
    }

    public function update(Request $request, Document $document)
    {
        $categoryId = $request->input('document_category_id');
        $category = DocumentCategory::find($categoryId);
        
        $maxSize = 51200; 
        if ($category && ($category->slug === 'ho-so-nang-luc-chung' || $category->slug === 'cong-bo-nang-luc' || in_array($category->slug, ['giay-dang-ky-kinh-doanh', 'giay-chung-nhan-du-dk-hoat-dong-tn', 'giay-chung-nhan-hieu-chuan-thiet-bi', 'danh-muc-may-moc-thiet-bi-ptn', 'danh-sach-can-bo-phong-thi-nghiem']))) {
            $maxSize = 102400; 
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'document_category_id' => 'required|exists:document_categories,id',
            'file' => "nullable|mimes:pdf,doc,docx,xls,xlsx,xlsm|max:$maxSize",
        ], [
            'file.mimes' => 'Chỉ hỗ trợ file PDF, Word, Excel.',
            'file.max' => 'Dung lượng file vượt quá giới hạn cho phép (' . ($maxSize/1024) . 'MB).',
        ]);

        $data = [
            'title' => $request->title,
            'document_category_id' => $request->document_category_id
        ];

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }

            $extension = $file->getClientOriginalExtension();
            $sizeInBytes = $file->getSize();
            $size = $sizeInBytes > 1048576 ? round($sizeInBytes / 1048576, 2) . ' MB' : round($sizeInBytes / 1024, 2) . ' KB';
            $path = $file->store('documents', 'public');

            $data['file_path'] = $path;
            $data['file_extension'] = $extension;
            $data['file_size'] = $size;
        }

        $document->update($data);

        return redirect()->route('admin.documents.index')->with('success', 'Cập nhật tài liệu thành công!');
    }

    public function destroy(Document $document)
    {
        if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return back()->with('success', 'Đã xóa tài liệu.');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return back()->with('error', 'Vui lòng chọn ít nhất một tài liệu để xóa.');
        }

        $documents = Document::whereIn('id', $ids)->get();
        foreach ($documents as $document) {
            if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }
            $document->delete();
        }

        return back()->with('success', 'Đã xóa ' . count($ids) . ' tài liệu thành công.');
    }
}
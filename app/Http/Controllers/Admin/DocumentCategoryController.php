<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentCategoryController extends Controller
{
    public function index()
    {
        $categories = \App\Models\DocumentCategory::orderBy('id', 'asc')->paginate(15);
        return view('admin.document_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.document_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:document_categories',
            'icon' => 'required|string|max:255',
            'color' => 'required|string|max:255',
        ]);

        \App\Models\DocumentCategory::create($request->all());

        return redirect()->route('admin.document-categories.index')->with('success', 'Thêm danh mục thành công!');
    }

    public function edit(\App\Models\DocumentCategory $documentCategory)
    {
        return view('admin.document_categories.edit', compact('documentCategory'));
    }

    public function update(Request $request, \App\Models\DocumentCategory $documentCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:document_categories,slug,' . $documentCategory->id,
            'icon' => 'required|string|max:255',
            'color' => 'required|string|max:255',
        ]);

        $documentCategory->update($request->all());

        return redirect()->route('admin.document-categories.index')->with('success', 'Cập nhật danh mục thành công!');
    }

    public function destroy(\App\Models\DocumentCategory $documentCategory)
    {
        // Prevent deleting if documents exist (optional, simple delete for now)
        $documentCategory->delete();
        return back()->with('success', 'Xóa danh mục thành công!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project; // Đảm bảo bạn đã tạo Model Project
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::query();

        // Lọc theo category nếu có
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Sắp xếp
        $sort = $request->input('sort', 'desc');
        $query->orderBy('created_at', $sort === 'asc' ? 'asc' : 'desc');

        $projects = $query->get();

        // Lấy danh sách category để render filter
        $categories = [
            'bridge' => 'Cầu / Đường',
            'factory' => 'Nhà máy',
            'urban' => 'Đô thị',
        ];

        return view('admin.projects.index', compact('projects', 'categories'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        // 1. Validate dữ liệu
        $request->validate([
            'title' => 'required|max:255',
            'category' => 'required|in:bridge,factory,urban',
            'location' => 'nullable|string',
            'year' => 'nullable|integer|min:1900|max:2099',
            'summary' => 'nullable|string',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:10240',
            // 'status' => 'required|in:active,completed' <-- Bỏ dòng này nếu Form không có ô chọn status
        ]);

        // 2. Khởi tạo đối tượng
        $project = new Project();
        $project->title = $request->title;
        $project->slug = \Illuminate\Support\Str::slug($request->title);
        $project->category = $request->category;
        $project->location = $request->location;
        $project->year = $request->year;
        $project->summary = $request->summary;
        $project->description = $request->description;

        // Gán mặc định là published để khớp với Seeder và logic hiển thị
        $project->status = $request->status ?? 'published';

        // 3. Xử lý lưu ảnh
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('project-featured', $filename, 'public');
            $project->image = $path;
        }

        $project->save();

        // 4. Chuyển hướng về trang danh sách
        return redirect()->route('admin.projects.index')->with('success', 'Thêm dự án thành công!');
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        // 1. Tìm dự án cần sửa
        $project = Project::findOrFail($id);

        // 2. Validate dữ liệu (Tương tự store nhưng image không bắt buộc)
        $request->validate([
            'title' => 'required|max:255',
            'category' => 'required|in:bridge,factory,urban',
            'location' => 'nullable|string',
            'year' => 'nullable|integer|min:1900|max:2099',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:10240',
        ]);

        // 3. Cập nhật các trường thông tin
        $project->title = $request->title;
        $project->slug = \Illuminate\Support\Str::slug($request->title);
        $project->category = $request->category;
        $project->location = $request->location;
        $project->year = $request->year;
        $project->summary = $request->summary;
        $project->description = $request->description;

        // Gán status mặc định nếu form không có
        $project->status = $request->status ?? 'published';

        // 4. Xử lý ảnh (Chỉ cập nhật nếu người dùng chọn file mới)
        if ($request->hasFile('image')) {
            if ($project->image && str_starts_with($project->image, 'project-featured/')) {
                Storage::disk('public')->delete($project->image);
            }

            $file = $request->file('image');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('project-featured', $filename, 'public');
            $project->image = $path;
        }

        $project->save();

        return redirect()->route('admin.projects.index')->with('success', 'Cập nhật dự án thành công!');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        if ($project->image && str_starts_with($project->image, 'project-featured/')) {
            Storage::disk('public')->delete($project->image);
        }
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Đã xóa dự án!');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return back()->with('error', 'Vui lòng chọn ít nhất một dự án để xóa.');
        }

        $projects = Project::whereIn('id', $ids)->get();
        foreach ($projects as $project) {
            if ($project->image && str_starts_with($project->image, 'project-featured/')) {
                Storage::disk('public')->delete($project->image);
            }
            $project->delete();
        }

        return redirect()->route('admin.projects.index')->with('success', 'Đã xóa ' . count($ids) . ' dự án thành công.');
    }
}

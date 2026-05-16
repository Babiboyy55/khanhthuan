<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query();

        // Sắp xếp
        $sort = $request->input('sort', 'desc');
        $query->orderBy('created_at', $sort === 'asc' ? 'asc' : 'desc');

        $services = $query->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        // 1. Lưu thông tin cơ bản và gán vào biến $service
        $service = Service::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'summary' => $request->summary,
            'description' => $request->description,
            'status' => $request->status ?? 'published',
        ]);

        // 2. Xử lý ảnh và CẬP NHẬT vào database
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('service-featured', $filename, 'public');

            // PHẢI CÓ DÒNG NÀY ĐỂ LƯU VÀO DB
            $service->update(['image' => $path]);
        }

        return redirect()->route('admin.services.index')->with('success', 'Thêm dịch vụ thành công!');
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $request->validate([
            'title' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        $service->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'summary' => $request->summary,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu lưu trong storage
            if ($service->image && str_starts_with($service->image, 'service-featured/')) {
                Storage::disk('public')->delete($service->image);
            }

            $file = $request->file('image');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('service-featured', $filename, 'public');

            // CẬP NHẬT TÊN ẢNH MỚI VÀO DB
            $service->update(['image' => $path]);
        }

        return redirect()->route('admin.services.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        if ($service->image && str_starts_with($service->image, 'service-featured/')) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Đã xóa dịch vụ.');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return back()->with('error', 'Vui lòng chọn ít nhất một dịch vụ để xóa.');
        }

        $services = Service::whereIn('id', $ids)->get();
        foreach ($services as $service) {
            if ($service->image && str_starts_with($service->image, 'service-featured/')) {
                Storage::disk('public')->delete($service->image);
            }
            $service->delete();
        }

        return redirect()->route('admin.services.index')->with('success', 'Đã xóa ' . count($ids) . ' dịch vụ thành công.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with('category');

        // Lọc theo category nếu có
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Sắp xếp
        $sort = $request->input('sort', 'desc');
        $query->orderBy('created_at', $sort === 'asc' ? 'asc' : 'desc');

        $posts = $query->paginate(10)->appends($request->all());

        // Lấy danh sách category để render filter
        $categories = \App\Models\Category::all();

        return view('admin.posts.index', compact('posts', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // 1. Validate dữ liệu
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240'
        ], [
            'category_id.required' => 'Vui lòng chọn danh mục bài viết.',
            'category_id.exists' => 'Danh mục không hợp lệ.'
        ]);

        // 2. Tạo bài viết mới (Lúc này chưa có ảnh)
        $post = Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->input('content'),
            'category_id' => $request->category_id,
            'status' => $request->status ?? 'published',
            'author_id' => auth()->id(),
        ]);

        // 3. Xử lý upload ảnh và CẬP NHẬT tên file vào Database
        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');

            // Làm sạch tên file để tránh lỗi trên server thực tế
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();

            // Lưu vào storage/public/post-featured
            $path = $file->storeAs('post-featured', $filename, 'public');

            // LƯU ĐƯỜNG DẪN FILE VÀO DATABASE
            $post->update(['featured_image' => $path]);
        }

        return redirect()->route('admin.posts.index')->with('success', 'Thêm bài viết mới thành công!');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,webp,gif,avif|max:10240',
        ]);

        $path = $request->file('upload')->store('post-content', 'public');

        return response()->json([
            'url' => asset('storage/' . $path),
        ]);
    }

    public function edit($id)
    {
        // Tìm bài viết theo ID, nếu không thấy sẽ hiện lỗi 404
        $post = Post::findOrFail($id);

        // Lấy danh sách danh mục để hiện ở ô Select
        $categories = Category::all();

        // Trả về view sửa bài viết và truyền dữ liệu sang
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        // Cập nhật thông tin cơ bản
        $post->title = $request->input('title');
        $post->slug = Str::slug($request->input('title'));
        $post->content = $request->input('content');
        $post->category_id = $request->input('category_id');

        // QUAN TRỌNG: Kiểm tra trạng thái có bị đổi thành draft không
        $post->status = $request->input('status', 'published');

        if ($request->hasFile('featured_image')) {
            try {
                $file = $request->file('featured_image');
                $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();

                // Lưu ảnh mới vào storage/public/post-featured
                $path = $file->storeAs('post-featured', $filename, 'public');

                // Xóa ảnh cũ nếu là ảnh do hệ thống lưu trong storage
                if ($post->featured_image && str_starts_with($post->featured_image, 'post-featured/')) {
                    Storage::disk('public')->delete($post->featured_image);
                }

                $post->featured_image = $path;
            } catch (\Exception $e) {
                // Nếu lỗi upload, vẫn quay lại trang edit và báo lỗi cụ thể
                return back()->withErrors(['featured_image' => 'Lỗi upload ảnh: ' . $e->getMessage()])->withInput();
            }
        }

        // Lưu tất cả thay đổi vào Database
        $post->save();

        // CHỈ KHI LƯU THÀNH CÔNG MỚI REDIRECT
        return redirect()->route('admin.posts.index')->with('success', 'Cập nhật bài viết thành công!');
    }

    public function show($id)
    {
        return redirect()->route('admin.posts.edit', $id);
    }

    public function destroy($id)
    {
        // 1. Tìm bài viết cần xóa
        $post = Post::findOrFail($id);

        // 2. Xóa ảnh đính kèm trong thư mục public/images (nếu có)
        if ($post->featured_image) {
            if (str_starts_with($post->featured_image, 'post-featured/')) {
                Storage::disk('public')->delete($post->featured_image);
            }
        }

        // 3. Thực hiện xóa trong Database
        $post->delete();

        // 4. Quay về trang danh sách với thông báo thành công
        return redirect()->route('admin.posts.index')->with('success', 'Đã xóa bài viết thành công!');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return back()->with('error', 'Vui lòng chọn ít nhất một bài viết để xóa.');
        }

        $posts = Post::whereIn('id', $ids)->get();
        foreach ($posts as $post) {
            if ($post->featured_image && str_starts_with($post->featured_image, 'post-featured/')) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $post->delete();
        }

        return redirect()->route('admin.posts.index')->with('success', 'Đã xóa ' . count($ids) . ' bài viết thành công.');
    }
}

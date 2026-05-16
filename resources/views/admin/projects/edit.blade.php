@extends('layouts.admin')

@section('content')
    <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); max-width: 1200px; margin: 0 auto;">
        <div style="border-bottom: 2px solid #f1f5f9; padding-bottom: 15px; margin-bottom: 25px; display: flex; align-items: center; justify-content: space-between;">
            <h2 style="margin: 0; font-family: 'Segoe UI', sans-serif; color: #1e293b;">
                <i class="fa-solid fa-pen-to-square" style="margin-right: 10px; color: #4f46e5;"></i> Chỉnh sửa dự án
            </h2>
            <a href="{{ route('admin.projects.index') }}" style="color: #64748b; text-decoration: none; font-size: 14px;">
                <i class="fa-solid fa-arrow-left"></i> Quay lại
            </a>
        </div>

        <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @if ($errors->any())
                <div style="background: #fee2e2; color: #b91c1c; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @csrf
            @method('PUT')
            
            <div style="display: grid; grid-template-columns: 3fr 1fr; gap: 30px; align-items: start;">
                <!-- Cột trái: Nội dung chính -->
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <div>
                        <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #475569;">Tên dự án <span style="color: red;">*</span></label>
                        <input type="text" name="title" value="{{ $project->title }}" required
                            style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 15px; box-sizing: border-box;">
                    </div>

                    <div>
                        <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #475569;">Mô tả ngắn (Hiển thị ở danh sách)</label>
                        <textarea name="summary" rows="3"
                            style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 15px; box-sizing: border-box; resize: vertical;">{{ $project->summary }}</textarea>
                    </div>

                    <div>
                        <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #475569;">Chi tiết hồ sơ công trình</label>
                        <textarea id="editor" name="description" style="width: 100%; min-height: 400px; box-sizing: border-box;">{{ $project->description }}</textarea>
                    </div>
                </div>

                <!-- Cột phải: Thông tin & Ảnh -->
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <div style="background: #f8fafc; padding: 20px; border-radius: 10px; border: 1px solid #e2e8f0;">
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #475569;">Phân loại <span style="color: red;">*</span></label>
                            <select name="category" required
                                style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box; background: white;">
                                <option value="bridge" {{ $project->category == 'bridge' ? 'selected' : '' }}>Cầu / Đường cao tốc</option>
                                <option value="factory" {{ $project->category == 'factory' ? 'selected' : '' }}>Nhà máy công nghiệp</option>
                                <option value="urban" {{ $project->category == 'urban' ? 'selected' : '' }}>Khu đô thị - dân cư</option>
                            </select>
                        </div>

                        <div style="margin-bottom: 15px;">
                            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #475569;">Địa điểm</label>
                            <input type="text" name="location" value="{{ $project->location }}"
                                style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box;">
                        </div>

                        <div style="margin-bottom: 0;">
                            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #475569;">Năm thực hiện</label>
                            <input type="number" name="year" value="{{ $project->year }}"
                                style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box;">
                        </div>
                    </div>

                    <div style="background: #f8fafc; padding: 20px; border-radius: 10px; border: 1px solid #e2e8f0;">
                        <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #475569;">Ảnh dự án</label>
                        @php
                            $img = $project->image;
                            if ($img) {
                                if (str_starts_with($img, 'http')) {
                                    $src = $img;
                                } elseif (str_contains($img, 'storage/') || str_contains($img, 'images/')) {
                                    $src = asset($img);
                                } elseif (str_starts_with($img, 'project-featured/')) {
                                    $src = asset('storage/' . $img);
                                } else {
                                    $src = asset('images/' . $img);
                                }
                            } else {
                                $src = asset('images/logo.jpg');
                            }
                        @endphp
                        <img src="{{ $src }}"
                            onerror="this.onerror=null;this.src='{{ asset('images/logo.jpg') }}';"
                            style="width: 100%; border-radius: 8px; margin-bottom: 10px; border: 1px solid #eee;">
                        <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #475569; font-size: 13px;">Thay đổi ảnh</label>
                        <input type="file" name="image" accept="image/*" style="width: 100%; font-size: 13px; box-sizing: border-box;">
                        <p style="margin-top: 8px; font-size: 11px; color: #94a3b8;">Định dạng: JPG, PNG, WebP. Tối đa 2MB.</p>
                    </div>

                    <button type="submit"
                        style="width: 100%; background: #4f46e5; color: white; padding: 14px; border: none; border-radius: 8px; font-weight: 700; cursor: pointer; transition: 0.3s; font-size: 15px; box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2);">
                        <i class="fa-solid fa-floppy-disk" style="margin-right: 5px;"></i> CẬP NHẬT
                    </button>
                </div>
            </div>
        </form>
    </div>

<script>
    const uploadUrl = window.KHANHTHUAN_CKEDITOR?.uploadUrl || '';
    const csrfToken = window.KHANHTHUAN_CKEDITOR?.csrfToken || '';

    class UploadAdapter {
        constructor(loader, url, token) {
            this.loader = loader;
            this.url = url;
            this.token = token;
            this.abortController = new AbortController();
        }

        upload() {
            return this.loader.file.then((file) => {
                const data = new FormData();
                data.append('upload', file);

                return fetch(this.url, {
                    method: 'POST',
                    body: data,
                    headers: {
                        'X-CSRF-TOKEN': this.token
                    },
                    credentials: 'same-origin',
                    signal: this.abortController.signal
                })
                    .then((response) => {
                        if (!response.ok) {
                            return response.text().then((text) => {
                                throw new Error(text || 'Upload failed');
                            });
                        }
                        return response.json();
                    })
                    .then((result) => ({
                        default: result.url
                    }));
            });
        }

        abort() {
            this.abortController.abort();
        }
    }

    function CustomUploadAdapterPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
            return new UploadAdapter(loader, uploadUrl, csrfToken);
        };
    }

    const editorConfig = {
        toolbar: {
            items: [
                'heading', '|',
                'fontFamily', 'fontSize', 'fontColor', 'fontBackgroundColor', '|',
                'bold', 'italic', 'underline', 'strikethrough', 'link', '|',
                'bulletedList', 'numberedList', 'alignment', '|',
                'imageUpload', 'mediaEmbed', 'blockQuote', 'insertTable', '|',
                'undo', 'redo'
            ]
        },
        mediaEmbed: {
            previewsInData: true
        },
        extraPlugins: [CustomUploadAdapterPlugin],
        fontFamily: {
            options: [
                'default',
                'Arial, Helvetica, sans-serif',
                'Georgia, serif',
                'Tahoma, Geneva, sans-serif',
                'Times New Roman, Times, serif',
                'Trebuchet MS, Helvetica, sans-serif',
                'Verdana, Geneva, sans-serif'
            ],
            supportAllValues: false
        },
        fontSize: {
            options: [10, 12, 14, 16, 18, 20, 22, 24, 28, 32],
            supportAllValues: false
        },
        removePlugins: [
            'DocumentOutline',
            'AIAssistant',
            'AI',
            'Base64UploadAdapter',
            'MultiLevelList',
            'TableOfContents',
            'FormatPainter',
            'Template',
            'SlashCommand',
            'PasteFromOfficeEnhanced',
            'CaseChange',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            'MathType'
        ]
    };

    function initEditor() {
        if (window.CKEDITOR && window.CKEDITOR.ClassicEditor) {
            window.CKEDITOR.ClassicEditor.create(document.querySelector('#editor'), editorConfig)
                .catch(error => { console.error(error); });
        } else {
            setTimeout(initEditor, 100);
        }
    }

    initEditor();
</script>
@endsection


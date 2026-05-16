@extends('layouts.admin')

@section('content')
    <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); max-width: 1200px; margin: 0 auto;">
        <div style="border-bottom: 2px solid #f1f5f9; padding-bottom: 15px; margin-bottom: 25px; display: flex; align-items: center; justify-content: space-between;">
            <h2 style="margin: 0; font-family: 'Segoe UI', sans-serif; color: #1e293b;">
                <i class="fa-solid fa-pen-to-square" style="margin-right: 10px; color: #4f46e5;"></i> Chỉnh sửa dịch vụ
            </h2>
            <a href="{{ route('admin.services.index') }}" style="color: #64748b; text-decoration: none; font-size: 14px;">
                <i class="fa-solid fa-arrow-left"></i> Quay lại
            </a>
        </div>

        <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div style="display: grid; grid-template-columns: 3fr 1fr; gap: 30px; align-items: start;">
                <!-- Cột trái: Nội dung chính -->
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <div>
                        <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #475569;">Tên dịch vụ <span style="color: red;">*</span></label>
                        <input type="text" name="title" value="{{ $service->title }}" required
                            style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 15px; box-sizing: border-box;">
                    </div>

                    <div>
                        <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #475569;">Mô tả ngắn</label>
                        <textarea name="summary" rows="3"
                            style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 15px; box-sizing: border-box; resize: vertical;">{{ $service->summary }}</textarea>
                    </div>

                    <div>
                        <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #475569;">Nội dung chi tiết</label>
                        <textarea id="editor" name="description"
                            style="width: 100%; min-height: 250px; box-sizing: border-box;">{{ $service->description }}</textarea>
                    </div>
                </div>

                <!-- Cột phải: Thông tin & Ảnh -->
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <div style="background: #f8fafc; padding: 20px; border-radius: 10px; border: 1px solid #e2e8f0;">
                        <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #475569;">Icon hiện tại: <i
                                class="fa-solid {{ $service->icon }}"></i></label>
                        <input type="text" name="icon" value="{{ $service->icon }}" placeholder="fa-helmet-safety"
                            style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box;">
                    </div>

                    <div style="background: #f8fafc; padding: 20px; border-radius: 10px; border: 1px solid #e2e8f0;">
                        <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #475569;">Hình ảnh dịch vụ</label>

                        @if($service->image)
                            @php
                                $img = $service->image;
                                if (str_starts_with($img, 'http')) {
                                    $src = $img;
                                } elseif (str_contains($img, 'storage/') || str_contains($img, 'images/')) {
                                    $src = asset($img);
                                } elseif (str_starts_with($img, 'service-featured/')) {
                                    $src = asset('storage/' . $img);
                                } else {
                                    $src = asset('images/' . $img);
                                }
                            @endphp
                            <div style="margin-bottom: 10px;">
                                <img src="{{ $src }}"
                                    style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1;">
                                <p style="font-size: 11px; color: #64748b; margin-top: 5px;">Ảnh hiện tại</p>
                            </div>
                        @endif

                        <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #475569; font-size: 13px;">Thay đổi ảnh</label>
                        <input type="file" name="image" accept="image/*" style="width: 100%; font-size: 13px; box-sizing: border-box;">
                        <p style="margin-top: 8px; font-size: 11px; color: #94a3b8;">Định dạng: JPG, PNG, WebP. Tối đa 2MB.</p>
                    </div>

                    <div style="background: #f8fafc; padding: 20px; border-radius: 10px; border: 1px solid #e2e8f0;">
                        <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #475569;">Trạng thái</label>
                        <select name="status"
                            style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box; background: white;">
                            <option value="published" {{ $service->status == 'published' ? 'selected' : '' }}>Xuất bản
                            </option>
                            <option value="draft" {{ $service->status == 'draft' ? 'selected' : '' }}>Bản nháp</option>
                        </select>
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


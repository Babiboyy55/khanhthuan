@extends('layouts.admin')

@section('content')
<div style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
    <div style="margin-bottom: 25px; border-bottom: 1px solid #eee; padding-bottom: 15px;">
        <h2 style="margin: 0; color: #2d3748; display: flex; align-items: center;">
            <i class="fa fa-envelope" style="margin-right: 12px; color: #e74c3c;"></i> Danh sách liên hệ
        </h2>
    </div>

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                <th style="padding: 15px; text-align: left; color: #64748b; font-size: 13px; text-transform: uppercase;">Khách hàng</th>
                <th style="padding: 15px; text-align: left; color: #64748b; font-size: 13px; text-transform: uppercase;">Thông tin liên hệ</th>
                <th style="padding: 15px; text-align: left; color: #64748b; font-size: 13px; text-transform: uppercase;">Nội dung</th>
                <th style="padding: 15px; text-align: center; color: #64748b; font-size: 13px; text-transform: uppercase;">Trạng thái</th>
                <th style="padding: 15px; text-align: center; color: #64748b; font-size: 13px; text-transform: uppercase;">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr style="border-bottom: 1px solid #f1f5f9;">
                <td style="padding: 15px;">
                    <div style="font-weight: 600; color: #1e293b;">{{ $contact->name }}</div>
                    <div style="font-size: 11px; color: #94a3b8;">{{ $contact->created_at->format('d/m/Y H:i') }}</div>
                </td>
                <td style="padding: 15px;">
                    <div style="font-size: 13px;"><i class="fa fa-phone" style="width: 15px;"></i> {{ $contact->phone }}</div>
                    <div style="font-size: 13px;"><i class="fa fa-envelope" style="width: 15px;"></i> {{ $contact->email }}</div>
                </td>
                <td style="padding: 15px; max-width: 300px;">
                    <div style="font-size: 13px; color: #475569; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        {{ $contact->message }}
                    </div>
                </td>
                <td style="padding: 15px; text-align: center;">
                    @if($contact->status == 'new')
                        <span style="background: #fee2e2; color: #ef4444; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: bold;">Mới</span>
                    @else
                        <span style="background: #dcfce7; color: #15803d; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: bold;">Đã xử lý</span>
                    @endif
                </td>
                <td style="padding: 15px; text-align: center;">
                    <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Xóa liên hệ này?')">
                        @csrf @method('DELETE')
                        <button type="submit" style="background: none; border: none; color: #94a3b8; cursor: pointer;">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $contacts->links() }}
    </div>
</div>
@endsection

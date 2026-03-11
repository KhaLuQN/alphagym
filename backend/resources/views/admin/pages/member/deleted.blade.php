@extends('admin.layouts.master')
@section('page_title', 'Danh sách hội viên đã xóa')

@section('breadcrumbs')
    <li><a href="{{ route('home') }}" class="link link-hover">Admin</a></li>
    <li><a href="{{ route('admin.members.index') }}" class="link link-hover">Tất cả hội viên</a></li>
    <li><a href="#" class="link link-hover">Hội viên đã xóa</a></li>
@endsection

@section('content')
    <div class="p-6">
        <div class="card bg-base-200 shadow-xl">
            <div class="card-body">
                <!-- Header -->
                <div class="card-title flex justify-between items-center mb-6">
                    <div>
                        <h4 class="text-3xl font-bold text-primary">Danh sách hội viên đã xóa</h4>
                        <p class="text-base-content/70 mt-1">Quản lý thông tin các thành viên đã bị xóa mềm</p>
                    </div>
                    <a href="{{ route('admin.members.index') }}"
                        class="btn btn-primary btn-lg gap-2 shadow-lg hover:shadow-xl transition-all">
                        <i class="ri-arrow-left-line text-lg"></i>
                        Quay lại danh sách hội viên
                    </a>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto bg-base-100 rounded-lg shadow-inner">
                    <table class="p-4 table table-zebra datatable w-full" data-order='[[0,"asc"]]'>
                        <thead>
                            <tr class="bg-base-300 text-base-content">
                                <th class="font-bold text-center">
                                    <i class="ri-hashtag mr-1"></i>ID
                                </th>
                                <th class="font-bold text-center">
                                    <i class="ri-image-line mr-1"></i>Ảnh
                                </th>
                                <th class="font-bold">
                                    <i class="ri-user-line mr-1"></i>Họ tên
                                </th>
                                <th class="font-bold">
                                    <i class="ri-phone-line mr-1"></i>SĐT
                                </th>
                                <th class="font-bold">
                                    <i class="ri-mail-line mr-1"></i>Email
                                </th>
                                <th class="font-bold text-center">
                                    <i class="ri-bank-card-line mr-1"></i>Mã thẻ
                                </th>
                                <th class="font-bold text-center">
                                    <i class="ri-signal-tower-line mr-1"></i>Trạng thái
                                </th>
                                <th class="font-bold text-center">
                                    <i class="ri-settings-line mr-1"></i>Thao tác
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $member)
                                <tr data-status="{{ $member->status }}" class="hover:bg-base-200/50 transition-colors">
                                    <td class="text-center font-medium">
                                        <span class="badge badge-outline">{{ $member->member_id }}</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="avatar">
                                            <div
                                                class="w-12 h-12 rounded-full ring ring-primary ring-offset-2 ring-offset-base-100">
                                                <img src="{{ $member->img ? asset($member->img) : asset('images/default.png') }}"
                                                    alt="Avatar của {{ $member->full_name }}" class="object-cover">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex items-center space-x-3">
                                            <div>
                                                <a href="{{ route('admin.members.show', $member->member_id) }}"
                                                    class="font-bold text-base-content hover:text-primary transition-colors">
                                                    {{ $member->full_name }}
                                                </a>
                                                @if ($member->notes)
                                                    <div class="text-sm text-base-content/60 mt-1">
                                                        <i
                                                            class="ri-information-line mr-1"></i>{{ Str::limit($member->notes, 30) }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex items-center">
                                            <i class="ri-phone-line mr-2 text-base-content/60"></i>
                                            <span class="font-medium">{{ $member->phone }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex items-center">
                                            <i class="ri-mail-line mr-2 text-base-content/60"></i>
                                            <span class="font-medium">{{ $member->email }}</span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if ($member->rfid_card_id)
                                            <span
                                                class="badge badge-accent badge-lg font-mono">{{ $member->rfid_card_id }}</span>
                                        @else
                                            <span class="badge badge-ghost">Chưa có</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="badge badge-error gap-1 font-medium">
                                            <i class="ri-delete-bin-line text-sm"></i>
                                            Đã xóa
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex items-center justify-center space-x-2">
                                            <!-- Nút khôi phục -->
                                            <div class="tooltip" data-tip="Khôi phục hội viên">
                                                <form action="{{ route('admin.members.restore', $member->member_id) }}"
                                                    method="POST" id="restore-member-form-{{ $member->member_id }}"
                                                    class="inline-block">
                                                    @csrf
                                                    <button type="button"
                                                        class="btn btn-sm btn-circle btn-outline btn-success confirm-action-btn hover:scale-110 transition-transform"
                                                        data-form-id="restore-member-form-{{ $member->member_id }}"
                                                        data-swal-title="Xác nhận khôi phục?"
                                                        data-swal-text="Bạn có chắc chắn muốn khôi phục hội viên này không?"
                                                        data-swal-icon="question"
                                                        data-swal-confirm-text="Khôi phục">
                                                        <i class="ri-refresh-line text-base"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Empty state -->
                @if ($members->isEmpty())
                    <div class="text-center py-12">
                        <div class="mb-4">
                            <i class="ri-user-line text-6xl text-base-content/20"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-base-content/70 mb-2">Chưa có hội viên nào bị xóa</h3>
                        <p class="text-base-content/50 mb-4">Không có hội viên nào trong thùng rác</p>
                        <a href="{{ route('admin.members.index') }}" class="btn btn-primary">
                            <i class="ri-arrow-left-line mr-2"></i>
                            Quay lại danh sách hội viên
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

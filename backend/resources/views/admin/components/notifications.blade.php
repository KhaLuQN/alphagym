<!-- Notifications -->
<div class="dropdown dropdown-end">
    <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
        <div class="indicator">
            <i class="ri-mail-line text-lg"></i>
            <span class="badge badge-sm badge-error indicator-item">
                {{ $contactNotifications->count() }}
            </span>

        </div>
    </div>
    <div tabindex="0" class="dropdown-content z-[1] card card-compact w-80 p-2 shadow-xl bg-base-100">
        <div class="card-body">
            <h3 class="card-title">Tin nhắn</h3>
            <div class="space-y-3">
                <div class="space-y-3">
                    @forelse ($contactNotifications as $contact)
                        @php
                            // Mapping type -> config
                            $configs = [
                                'complain' => [
                                    'color' => '#f87171', // đỏ
                                    'icon' => 'ri-error-warning-line',
                                    'title' => 'Khiếu nại',
                                ],
                                'support' => [
                                    'color' => '#60a5fa', // xanh dương
                                    'icon' => 'ri-customer-service-2-line',
                                    'title' => 'Yêu cầu hỗ trợ',
                                ],
                                'contact' => [
                                    'color' => '#34d399', // xanh lá
                                    'icon' => 'ri-mail-line',
                                    'title' => 'Liên hệ',
                                ],
                                'default' => [
                                    'color' => '#9ca3af', // xám
                                    'icon' => 'ri-notification-2-line',
                                    'title' => 'Thông báo khác',
                                ],
                            ];

                            // Lấy config theo type
                            $cfg = $configs[$contact->type] ?? $configs['default'];
                        @endphp

                        <div class="alert"
                            style="background-color: {{ $cfg['color'] }}20; color: {{ $cfg['color'] }};">
                            <i class="{{ $cfg['icon'] }}"></i>
                            <div>
                                <div class="font-bold">{{ $cfg['title'] }}</div>
                                <div class="text-xs">
                                    {{ $contact->full_name }} đã gửi lúc
                                    {{ \Carbon\Carbon::parse($contact->submitted_at)->format('H:i d/m') }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-sm text-gray-500">Không có liên hệ mới</div>
                    @endforelse
                </div>


            </div>
            <div class="card-actions">
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-block"> xem tất cả</a>
            </div>
        </div>
    </div>
</div>

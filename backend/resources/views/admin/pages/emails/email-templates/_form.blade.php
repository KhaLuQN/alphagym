@csrf

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Template Info Card -->
        <div class="card bg-base-100 shadow-lg">
            <div class="card-header border-b border-base-300">
                <div class="card-body pb-4">
                    <h2 class="card-title text-xl flex items-center gap-2">
                        <i class="ri-information-line text-info"></i>
                        Thông Tin Mẫu
                    </h2>
                </div>
            </div>
            <div class="card-body space-y-4">
                <!-- Template Name -->
                <div class="form-control">
                    <label class="label" for="name">
                        <span class="label-text font-semibold flex items-center gap-2">
                            <i class="ri-price-tag-3-line text-primary"></i>
                            Tên Mẫu
                        </span>
                        <span class="label-text-alt text-error">*</span>
                    </label>
                    <input type="text" name="name" id="name"
                        value="{{ old('name', $template->name ?? '') }}"
                        placeholder="Nhập tên mẫu để dễ nhận biết..." required
                        class="input input-bordered w-full @error('name') input-error @enderror focus:input-primary">
                    @error('name')
                        <label class="label">
                            <span class="label-text-alt text-error flex items-center gap-1">
                                <i class="ri-error-warning-line"></i>
                                {{ $message }}
                            </span>
                        </label>
                    @enderror
                </div>

                <!-- Email Subject -->
                <div class="form-control">
                    <label class="label" for="subject">
                        <span class="label-text font-semibold flex items-center gap-2">
                            <i class="ri-mail-line text-primary"></i>
                            Tiêu Đề Email
                        </span>
                        <span class="label-text-alt text-error">*</span>
                    </label>
                    <input type="text" name="subject" id="subject"
                        value="{{ old('subject', $template->subject ?? '') }}"
                        placeholder="Tiêu đề sẽ hiển thị trong hộp thư..." required
                        class="input input-bordered w-full @error('subject') input-error @enderror focus:input-primary">
                    @error('subject')
                        <label class="label">
                            <span class="label-text-alt text-error flex items-center gap-1">
                                <i class="ri-error-warning-line"></i>
                                {{ $message }}
                            </span>
                        </label>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Email Content Card -->
        <div class="card bg-base-100 shadow-lg">
            <div class="card-header border-b border-base-300">
                <div class="card-body pb-4">
                    <h2 class="card-title text-xl flex items-center gap-2">
                        <i class="ri-file-text-line text-warning"></i>
                        Nội Dung Email
                    </h2>
                </div>
            </div>
            <div class="card-body">
                <div class="form-control">
                    <label class="label" for="body">
                        <span class="label-text font-semibold">Soạn nội dung email của bạn</span>
                        <span class="label-text-alt text-error">*</span>
                    </label>
                    <textarea name="body" id="body" class="hidden">{{ old('body', isset($template) ? $template->body : '') }}</textarea>
                    @error('body')
                        <label class="label">
                            <span class="label-text-alt text-error flex items-center gap-1">
                                <i class="ri-error-warning-line"></i>
                                {{ $message }}
                            </span>
                        </label>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Quick Actions -->
        <div class="card bg-base-100 shadow-lg">
            <div class="card-body">
                <h3 class="card-title text-lg flex items-center gap-2 mb-4">
                    <i class="ri-settings-3-line text-primary"></i>
                    Thao Tác
                </h3>
                <div class="space-y-3">
                    <button type="submit" class="btn btn-primary w-full gap-2" id="saveBtn">
                        <i class="ri-save-line"></i>
                        {{ isset($template) ? 'Cập Nhật Mẫu' : 'Lưu Mẫu Mới' }}
                    </button>
                    <a href="{{ route('admin.email-templates.index') }}" class="btn btn-ghost w-full gap-2">
                        <i class="ri-arrow-left-line"></i>
                        Quay Lại
                    </a>
                </div>
            </div>
        </div>

        <!-- Variables Guide -->
        <div class="card bg-gradient-to-br from-info/10 to-info/5 border border-info/20 shadow-lg">
            <div class="card-body">
                <h3 class="card-title text-lg flex items-center gap-2 mb-4 text-info">
                    <i class="ri-code-s-slash-line"></i>
                    Biến Có Sẵn
                </h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-2 bg-base-100 rounded-lg border">
                        <code class="text-sm font-mono text-primary">[TEN_HOI_VIEN]</code>
                        <button type="button" class="btn btn-xs btn-ghost"
                            onclick="insertVariable('[TEN_HOI_VIEN]')" title="Chèn vào nội dung">
                            <i class="ri-add-line"></i>
                        </button>
                    </div>
                    <div class="flex items-center justify-between p-2 bg-base-100 rounded-lg border">
                        <code class="text-sm font-mono text-primary">[NGAY_THAM_GIA]</code>
                        <button type="button" class="btn btn-xs btn-ghost"
                            onclick="insertVariable('[NGAY_THAM_GIA]')" title="Chèn vào nội dung">
                            <i class="ri-add-line"></i>
                        </button>
                    </div>
                </div>
                <div class="alert alert-info mt-4">
                    <i class="ri-information-line"></i>
                    <span class="text-sm">Nhấp vào nút + để chèn biến vào nội dung email</span>
                </div>
            </div>
        </div>

        <!-- Preview -->
        <div class="card bg-base-100 shadow-lg">
            <div class="card-body">
                <h3 class="card-title text-lg flex items-center gap-2 mb-4">
                    <i class="ri-eye-line text-success"></i>
                    Xem Trước
                </h3>
                <button type="button" class="btn btn-outline btn-success w-full gap-2"
                    onclick="previewEmail()">
                    <i class="ri-mail-open-line"></i>
                    Xem Trước Email
                </button>
            </div>
        </div>

        <!-- Tips -->
        <div class="card bg-gradient-to-br from-warning/10 to-warning/5 border border-warning/20">
            <div class="card-body">
                <h3 class="card-title text-lg flex items-center gap-2 mb-4 text-warning">
                    <i class="ri-lightbulb-line"></i>
                    Mẹo Hay
                </h3>
                <ul class="space-y-2 text-sm">
                    <li class="flex items-start gap-2">
                        <i class="ri-check-line text-success mt-0.5 flex-shrink-0"></i>
                        <span>Sử dụng tiêu đề ngắn gọn, hấp dẫn</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="ri-check-line text-success mt-0.5 flex-shrink-0"></i>
                        <span>Nội dung rõ ràng, dễ đọc</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="ri-check-line text-success mt-0.5 flex-shrink-0"></i>
                        <span>Kiểm tra trước khi lưu</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

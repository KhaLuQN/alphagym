@extends('admin.layouts.master')

@section('content')
    <div class="min-h-screen bg-base-200 p-6">
        <div class="max-w-5xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-4">
                    <i class="ri-edit-line text-3xl text-primary"></i>
                    <h1 class="text-4xl font-bold text-base-content">Chỉnh Sửa Mẫu Email</h1>
                </div>
                <div class="breadcrumbs text-sm">
                    <ul>
                        <li><a href="{{ route('admin.email-templates.index') }}"
                                class="text-primary hover:text-primary-focus">Mẫu Email</a></li>
                        <li class="text-base-content/70">Chỉnh sửa: {{ $template->name }}</li>
                    </ul>
                </div>
            </div>

            <form action="{{ route('admin.email-templates.update', $template->template_id) }}" method="POST"
                id="emailTemplateForm">
                @method('PUT')
                @include('admin.pages.emails.email-templates._form')
            </form>
        </div>
    </div>

    <!-- Preview Modal -->
    <dialog id="previewModal" class="modal">
        <div class="modal-box w-11/12 max-w-4xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-lg flex items-center gap-2">
                    <i class="ri-mail-open-line text-primary"></i>
                    Xem Trước Email
                </h3>
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost">
                        <i class="ri-close-line"></i>
                    </button>
                </form>
            </div>

            <div class="border rounded-lg overflow-hidden">
                <!-- Email Header -->
                <div class="bg-base-200 p-4 border-b">
                    <div class="flex items-center gap-2 text-sm">
                        <span class="font-semibold">Tiêu đề:</span>
                        <span id="previewSubject" class="text-base-content/70"></span>
                    </div>
                </div>

                <!-- Email Content -->
                <div class="p-6 bg-white min-h-[400px]">
                    <div id="previewContent" class="prose max-w-none"></div>
                </div>
            </div>

            <div class="modal-action">
                <form method="dialog">
                    <button class="btn">Đóng</button>
                </form>
            </div>
        </div>
    </dialog>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center">
        <div class="bg-base-100 p-6 rounded-lg shadow-xl">
            <div class="flex items-center gap-3">
                <span class="loading loading-spinner loading-md"></span>
                <span>Đang xử lý...</span>
            </div>
        </div>
    </div>
@endsection

@push('customjs')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

    <script>
        let editor;

        // Initialize CKEditor
        ClassicEditor
            .create(document.querySelector('#body'), {
                toolbar: {
                    items: [
                        'heading', '|',
                        'bold', 'italic', 'underline', '|',
                        'link', 'bulletedList', 'numberedList', '|',
                        'outdent', 'indent', '|',
                        'blockQuote', 'insertTable', '|',
                        'fontColor', 'fontBackgroundColor', '|',
                        'alignment', '|',
                        'undo', 'redo'
                    ]
                },
                language: 'vi',
                placeholder: 'Nhập nội dung email của bạn tại đây...\n\nBạn có thể sử dụng các biến như [TEN_HOI_VIEN], [NGAY_THAM_GIA] để cá nhân hóa email.',
                height: '400px'
            })
            .then(newEditor => {
                editor = newEditor;

                // Auto-save draft every 30 seconds
                setInterval(() => {
                    const content = editor.getData();
                    if (content.trim()) {
                        localStorage.setItem('email_template_draft', JSON.stringify({
                            name: document.getElementById('name').value,
                            subject: document.getElementById('subject').value,
                            body: content,
                            timestamp: new Date().toISOString()
                        }));
                    }
                }, 30000);

                // Load draft if exists
                const draft = localStorage.getItem('email_template_draft');
                if (draft && !@json(isset($template))) {
                    const draftData = JSON.parse(draft);
                    if (confirm('Bạn có muốn khôi phục bản nháp đã lưu không?')) {
                        document.getElementById('name').value = draftData.name || '';
                        document.getElementById('subject').value = draftData.subject || '';
                        editor.setData(draftData.body || '');
                    }
                }
            })
            .catch(error => {
                console.error('Error initializing CKEditor:', error);
                // Fallback to regular textarea if CKEditor fails
                document.getElementById('body').classList.remove('hidden');
                document.getElementById('body').setAttribute('rows', '15');
                document.getElementById('body').classList.add('textarea', 'textarea-bordered');
            });

        // Insert variable into editor
        function insertVariable(variable) {
            if (editor) {
                const viewFragment = editor.data.processor.toView(variable);
                const modelFragment = editor.data.toModel(viewFragment);
                editor.model.insertContent(modelFragment);
                editor.editing.view.focus();
            }
        }

        // Preview email function
        function previewEmail() {
            const subject = document.getElementById('subject').value || 'Không có tiêu đề';
            const content = editor ? editor.getData() : document.getElementById('body').value;

            document.getElementById('previewSubject').textContent = subject;
            document.getElementById('previewContent').innerHTML = content ||
                '<p class="text-base-content/50 italic">Chưa có nội dung</p>';

            document.getElementById('previewModal').showModal();
        }

        // Form submission handling
        document.getElementById('emailTemplateForm').addEventListener('submit', function(e) {
            // Show loading
            document.getElementById('loadingOverlay').classList.remove('hidden');

            // Update textarea with editor content
            if (editor) {
                document.getElementById('body').value = editor.getData();
            }

            // Clear draft after successful save
            setTimeout(() => {
                localStorage.removeItem('email_template_draft');
            }, 1000);
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl+S to save
            if (e.ctrlKey && e.key === 's') {
                e.preventDefault();
                document.getElementById('saveBtn').click();
            }

            // Ctrl+P to preview
            if (e.ctrlKey && e.key === 'p') {
                e.preventDefault();
                previewEmail();
            }
        });

        // Auto-resize and improve UX
        document.addEventListener('DOMContentLoaded', function() {
            // Add loading states to buttons
            const buttons = document.querySelectorAll('button[type="submit"]');
            buttons.forEach(btn => {
                btn.addEventListener('click', function() {
                    this.classList.add('loading');
                    setTimeout(() => {
                        this.classList.remove('loading');
                    }, 5000);
                });
            });

            // Character count for subject
            const subjectInput = document.getElementById('subject');
            const maxLength = 100;

            function updateCharCount() {
                const current = subjectInput.value.length;
                const remaining = maxLength - current;

                let countElement = document.getElementById('subjectCharCount');
                if (!countElement) {
                    countElement = document.createElement('span');
                    countElement.id = 'subjectCharCount';
                    countElement.className = 'label-text-alt';
                    subjectInput.parentNode.querySelector('.label').appendChild(countElement);
                }

                countElement.textContent = `${current}/${maxLength}`;
                countElement.className = remaining < 20 ? 'label-text-alt text-warning' :
                    'label-text-alt text-base-content/50';
            }

            subjectInput.addEventListener('input', updateCharCount);
            updateCharCount();
        });

        // Warn before leaving if there are unsaved changes
        let hasUnsavedChanges = false;

        ['input', 'change'].forEach(event => {
            document.addEventListener(event, function() {
                hasUnsavedChanges = true;
            });
        });

        document.getElementById('emailTemplateForm').addEventListener('submit', function() {
            hasUnsavedChanges = false;
        });

        window.addEventListener('beforeunload', function(e) {
            if (hasUnsavedChanges) {
                e.preventDefault();
                e.returnValue = '';
            }
        });
    </script>
@endpush

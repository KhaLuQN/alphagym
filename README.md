# GymTech - Hệ thống Quản lý Phòng Gym & Website SEO

Dự án GymTech là một hệ thống quản lý phòng tập Gym toàn diện, bao gồm Backend API mạnh mẽ (Laravel) và Frontend hiện đại (Nuxt 3) được tối ưu hóa cho SEO.

## 🏗️ Cấu trúc Dự án (Monorepo)

Dự án được tổ chức theo cấu trúc Monorepo để dễ dàng quản lý và triển khai:

```text
alphagym/
├── backend/          # Laravel API & Admin Panel
├── frontend/         # Nuxt 3 Website (Client-side)
└── README.md         # File này
```

## 🚀 Công nghệ sử dụng

### Backend (Laravel)
- **Framework**: Laravel 10+
- **Language**: PHP 8.2+
- **Database**: MySQL
- **Authentication**: Sanctum / Magic Link
- **Payment Integration**: VNPAY, MoMo
- **Admin UI**: Custom Blade Templates + Tailwind CSS

### Frontend (Nuxt 3)
- **Framework**: Nuxt 3
- **Language**: TypeScript
- **Styling**: Tailwind CSS
- **State Management**: Pinia
- **SEO**: Nuxt SEO Module, Custom Meta Tags

## 📦 Cài đặt & Chạy Dự án

### Yêu cầu hệ thống
- Node.js v18+
- PHP 8.2+
- Composer
- MySQL 8.0+

### 1. Clone dự án
```bash
git clone https://github.com/KhaLuQN/alphagym.git
cd alphagym
```

### 2. Cài đặt Backend
```bash
cd backend
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
npm install
npm run build
php artisan serve
```

Backend sẽ chạy tại: `http://localhost:8000`

### 3. Cài đặt Frontend
(Mở một terminal mới)
```bash
cd frontend
npm install
cp .env.example .env
npm run dev
```

Frontend sẽ chạy tại: `http://localhost:3000`

## 🎯 Tính năng chính

### Quản lý Admin
- Quản lý hội viên (Member)
- Quản lý gói tập (Membership Plans)
- Quản lý huấn luyện viên (Trainers)
- Quản lý thiết bị (Equipment)
- Quản lý thanh toán (Payments)
- Báo cáo doanh thu & hoạt động (Reports)
- Gửi email chiến dịch (Email Campaigns)

### Website Client
- Đăng ký gói tập online
- Tra cứu thông tin hội viên
- Xem danh sách huấn luyện viên
- Đọc bài viết chuyên môn (Blog)
- Tư vấn trực tuyến (Consultation)

## 👨‍💻 Tác giả
**Kha Lu** - Fullstack Developer (PHP, Laravel, Nuxt 3)

## 📄 Giấy phép
Dự án này được phát triển cho mục đích thương mại.
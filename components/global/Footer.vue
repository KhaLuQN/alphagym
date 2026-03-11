<template>
  <footer class="bg-black border-t border-red-600/30">
    <div class="container mx-auto px-4 py-12">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
          <h3 class="text-2xl font-bold text-gradient mb-4">
            <i class="fas fa-dumbbell mr-2"></i> GymTech
          </h3>
          <p class="text-gray-300 mb-4">
            Phòng tập gym hàng đầu với thiết bị hiện đại và đội ngũ huấn luyện
            viên chuyên nghiệp.
          </p>
          <div class="flex space-x-4">
            <a href="#" class="text-red-500 hover:text-red-400 text-xl">
              <i class="fab fa-facebook"></i>
            </a>
            <a href="#" class="text-red-500 hover:text-red-400 text-xl">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="#" class="text-red-500 hover:text-red-400 text-xl">
              <i class="fab fa-youtube"></i>
            </a>
            <a href="#" class="text-red-500 hover:text-red-400 text-xl">
              <i class="fab fa-tiktok"></i>
            </a>
          </div>
        </div>
        <div>
          <h4 class="text-lg font-bold text-white mb-4">Dịch vụ</h4>
          <ul class="space-y-2 text-gray-300">
            <li><a href="#" class="hover:text-red-400">Tập gym</a></li>
            <li>
              <a href="#" class="hover:text-red-400">Personal Training</a>
            </li>
            <li><a href="#" class="hover:text-red-400">Yoga</a></li>
            <li><a href="#" class="hover:text-red-400">Cardio</a></li>
            <li><a href="#" class="hover:text-red-400">Massage</a></li>
          </ul>
        </div>
        <div>
          <h4 class="text-lg font-bold text-white mb-4">Thông tin</h4>
          <ul class="space-y-2 text-gray-300">
            <li>
              <nuxt-link class="hover:text-red-400" to="/gioi-thieu"
                >Về chúng tôi</nuxt-link
              >
            </li>
            <li>
              <nuxt-link to="dieu-khoan-su-dung" class="hover:text-red-400"
                >Điều khoản</nuxt-link
              >
            </li>
            <li>
              <nuxt-link to="chinh-sach-bao-mat" class="hover:text-red-400"
                >Chính sách bảo mật</nuxt-link
              >
            </li>
            <li>
              <nuxt-link to="lien-he" class="hover:text-red-400"
                >Liên hệ</nuxt-link
              >
            </li>
            <li>
              <nuxt-link class="hover:text-red-400">Tuyển dụng</nuxt-link>
            </li>
          </ul>
        </div>
        <div>
          <h4 class="text-lg font-bold text-white mb-4">Giờ hoạt động</h4>
          <div class="space-y-2 text-gray-300">
            <div class="flex justify-between">
              <span>Thứ 2 - Thứ 6:</span>
              <span class="text-red-400">5:00 - 23:00</span>
            </div>
            <div class="flex justify-between">
              <span>Thứ 7 - Chủ nhật:</span>
              <span class="text-red-400">6:00 - 22:00</span>
            </div>
            <div
              class="mt-4 p-3 bg-red-600/20 rounded-lg border border-red-600/30"
            >
              <p class="text-red-300 font-semibold text-sm">
                🔥 Đặc biệt: Mở cửa 24/7 cho thành viên VIP
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>

<template>
  <!-- Newsletter Subscription -->
    <div
      class="bg-gradient-to-r from-red-900/30 to-red-800/30 border-t border-red-600/30"
    >
      <div class="container mx-auto px-4 py-16">
        <div class="max-w-2xl mx-auto text-center">
          <h2 class="text-4xl font-extrabold mb-6 text-red-400 custom-text-shadow">
            <i class="fas fa-bell mr-3"></i>Nhận thông báo mới
          </h2>
          <p class="text-gray-300 mb-8">
            Đăng ký để nhận những bài viết mới nhất về thể hình và sức khỏe
          </p>
          <div class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
            <input
              type="email"
              placeholder="Nhập email của bạn"
              class="input input-bordered flex-1 bg-black/50 text-white border-red-600/50 focus:border-red-500"
            />
            <button class="btn btn-primary bg-red-600 hover:bg-red-700 border-red-600 hover:border-red-700 text-white font-bold text-lg px-8 py-4 rounded-full shadow-lg transform transition-transform duration-200 hover:scale-105 pulse-red">
              <i class="fas fa-paper-plane mr-2"></i>Đăng ký
            </button>
          </div>
        </div>
      </div>
    </div>
</template>


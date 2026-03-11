//pages/dang-ky-goi-tap/index.vue
<template>
  <div
    class="relative py-24 md:py-32 bg-gradient-to-br from-gray-950 via-red-950 to-black overflow-hidden"
  >
    <!-- Hero Section -->
    <div class="relative overflow-hidden">
      <div class="absolute inset-0 bg-black opacity-50"></div>
      <div class="relative max-w-7xl mx-auto px-4 py-16">
        <div class="text-center">
          <h1 class="text-5xl md:text-6xl font-bold text-white mb-4">
            <span
              class="bg-gradient-to-r from-red-500 to-red-700 bg-clip-text text-transparent"
            >
              ĐĂNG KÝ
            </span>
            <span class="text-white">GÓI TẬP</span>
          </h1>
          <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
            Chọn gói tập phù hợp và bắt đầu hành trình chinh phục bản thân cùng
            chúng tôi
          </p>
          <div class="flex items-center justify-center space-x-4 text-red-400">
            <i class="fas fa-dumbbell text-2xl"></i>
            <span class="text-lg font-medium">TRANSFORM YOUR BODY</span>
            <i class="fas fa-fire text-2xl"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 pb-16">
      <!-- Tabs -->
      <div class="card bg-gray-900 shadow-2xl border border-red-900/20">
        <div class="card-body p-0">
          <!-- Tab Headers -->
          <div
            class="tabs tabs-boxed bg-gray-800 rounded-t-2xl p-2 border-b border-red-900/30"
          >
            <button
              class="tab tab-lg flex-1 text-white hover:bg-red-600 transition-all duration-300"
              :class="{
                'tab-active bg-gradient-to-r from-red-600 to-red-700 text-white shadow-lg':
                  activeTab === 'new',
              }"
              @click="activeTab = 'new'"
            >
              <i class="fas fa-user-plus mr-2"></i>
              <span class="text-white font-semibold">Khách Hàng Mới</span>
            </button>
            <button
              class="tab tab-lg flex-1 text-white hover:bg-red-600 transition-all duration-300"
              :class="{
                'tab-active bg-gradient-to-r from-red-600 to-red-700 text-white shadow-lg':
                  activeTab === 'renew',
              }"
              @click="activeTab = 'renew'"
            >
              <i class="fas fa-redo-alt mr-2"></i>
              <span class="text-white ont-semibold">Gia Hạn Gói Tập</span>
            </button>
          </div>

          <!-- Tab Content -->
          <div class="p-8">
            <!-- New Customer Form -->
            <div v-show="activeTab === 'new'" class="animate-fade-in">
              <div class="text-center mb-8">
                <div
                  class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-red-600 to-red-700 rounded-full mb-4"
                >
                  <i class="fas fa-user-plus text-white text-xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-white mb-2">
                  Đăng Ký Thành Viên Mới
                </h2>
                <p class="text-gray-400">
                  Bắt đầu hành trình fitness của bạn ngay hôm nay
                </p>
              </div>
              <RegisterPackageNewCustomerForm />
            </div>

            <!-- Renew Form -->
            <div v-show="activeTab === 'renew'" class="animate-fade-in">
              <div class="text-center mb-8">
                <div
                  class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-red-600 to-red-700 rounded-full mb-4"
                >
                  <i class="fas fa-redo-alt text-white text-xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-white mb-2">
                  Gia Hạn Gói Tập
                </h2>
                <p class="text-gray-400">Tiếp tục hành trình fitness của bạn</p>
              </div>
              <RegisterPackageRenewForm />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";

const activeTab = ref("new");

onMounted(() => {
  // Add fade-in animation CSS if not exists
  if (!document.querySelector("#fade-in-styles")) {
    const style = document.createElement("style");
    style.id = "fade-in-styles";
    style.textContent = `
      .animate-fade-in {
        animation: fadeIn 0.5s ease-in-out;
      }
      @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
      }
    `;
    document.head.appendChild(style);
  }
});
</script>

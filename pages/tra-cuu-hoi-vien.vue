<template>
  <!-- Header -->
  <div
    class="relative py-24 md:py-32 bg-gradient-to-br from-gray-950 via-red-950 to-black overflow-hidden"
  >
    <div class="container mx-auto px-6 relative z-10">
      <div class="max-w-4xl mx-auto text-center">
        <h1
          class="text-5xl md:text-7xl font-extrabold mb-6 text-red-500 custom-hero-text-shadow leading-tight"
        >
          <i class="fas fa-newspaper mr-4 text-red-600"></i>Tra cứu Hội Viên
        </h1>
        <p class="text-xl md:text-2xl text-gray-300 mb-10 max-w-xl mx-auto">
          nhapaj email của bạn để nhận link truy cập thông tin cá nhân
        </p>
      </div>
    </div>
  </div>
  <div
    class="min-h-screen bg-gradient-to-br from-gray-900 via-red-950 to-black py-12 px-4"
  >
    <div class="max-w-md mx-auto">
      <!-- Main Card -->
      <div class="card bg-white shadow-2xl border border-gray-200">
        <div class="card-body">
          <!-- Success Alert -->
          <div
            v-if="showSuccess"
            class="alert bg-green-50 border-green-200 text-green-800 mb-6 animate-bounce-in"
          >
            <i class="fas fa-check-circle text-xl text-green-600"></i>
            <div>
              <h3 class="font-bold">Gửi email thành công!</h3>
              <div class="text-xs">
                Link thông tin cá nhân đã được gửi đến {{ email }}
              </div>
            </div>
          </div>

          <!-- Error Alert -->
          <div
            v-if="showError"
            class="alert bg-red-50 border-red-200 text-red-800 mb-6 animate-shake"
          >
            <i class="fas fa-exclamation-triangle text-xl text-red-600"></i>
            <div>
              <h3 class="font-bold">Có lỗi xảy ra!</h3>
              <div class="text-xs">{{ errorMessage }}</div>
            </div>
          </div>

          <!-- Form -->
          <form @submit.prevent="handleSubmit" class="space-y-6">
            <div class="form-control">
              <label class="label">
                <span class="label-text font-semibold text-gray-800">
                  <i class="fas fa-envelope mr-2 text-red-600"></i>
                  Địa chỉ email
                </span>
              </label>
              <div class="relative">
                <input
                  v-model="email"
                  type="email"
                  placeholder="Nhập email của bạn"
                  class="input input-bordered w-full pr-10 border-gray-300 focus:border-red-500 focus:ring-red-500 transition-all duration-200"
                  :class="{ 'border-red-500 bg-red-50': emailError }"
                  :disabled="isLoading"
                />
                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                  <i class="fas fa-at text-gray-400"></i>
                </div>
              </div>
              <label v-if="emailError" class="label">
                <span class="label-text-alt text-red-600">
                  <i class="fas fa-exclamation-circle mr-1"></i>
                  {{ emailError }}
                </span>
              </label>
            </div>

            <!-- Submit Button -->
            <div class="form-control mt-8">
              <button
                type="submit"
                class="btn bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white border-none btn-lg w-full relative overflow-hidden group"
                :disabled="isLoading || !email"
                :class="{ loading: isLoading }"
              >
                <!-- Loading State -->
                <template v-if="isLoading">
                  <span class="loading loading-spinner loading-sm mr-2"></span>
                  Đang gửi email...
                </template>

                <!-- Normal State -->
                <template v-else>
                  <i
                    class="fas fa-paper-plane mr-2 group-hover:translate-x-1 transition-transform duration-200"
                  ></i>
                  Gửi Link Thông Tin
                </template>

                <!-- Button Animation -->
                <div
                  class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-200"
                ></div>
              </button>
            </div>
          </form>

          <!-- Info Card -->
          <div class="mt-8 p-4 bg-gray-50 rounded-lg border border-gray-200">
            <div class="flex items-start space-x-3">
              <i class="fas fa-info-circle text-red-600 text-lg mt-0.5"></i>
              <div class="text-sm text-gray-700">
                <p class="font-semibold mb-1">Lưu ý quan trọng:</p>
                <ul class="space-y-1 text-xs text-gray-600">
                  <li>• Link sẽ được gửi đến email bạn đã đăng ký</li>
                  <li>• Kiểm tra cả hộp thư spam nếu không thấy email</li>
                  <li>• Link có hiệu lực trong 24 giờ</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Loading Overlay -->
      <div
        v-if="isLoading"
        class="fixed inset-0 bg-black/20 backdrop-blur-sm z-50 flex items-center justify-center"
      >
        <div
          class="bg-white rounded-2xl p-8 shadow-2xl flex flex-col items-center space-y-4 animate-pulse-scale border border-gray-200"
        >
          <div class="loading loading-ring loading-lg text-red-600"></div>
          <div class="text-center">
            <h3 class="font-bold text-lg text-gray-800">Đang xử lý yêu cầu</h3>
            <p class="text-sm text-gray-600">Vui lòng chờ trong giây lát...</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch } from "vue";

const email = ref("");
const isLoading = ref(false);
const showSuccess = ref(false);
const showError = ref(false);
const emailError = ref("");
const errorMessage = ref("");
const config = useRuntimeConfig();
// Validate email
const validateEmail = (email) => {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
};

// Handle form submission
const handleSubmit = async () => {
  emailError.value = "";
  showError.value = false;
  showSuccess.value = false;

  isLoading.value = true;

  try {
    const response = await $fetch(
      "https://admin.alphagym.site/api/magic-link/send",
      {
        method: "POST",
        body: { email: email.value },
      }
    );

    if (response.success) {
      showSuccess.value = true;
      setTimeout(() => {
        showSuccess.value = false;
        email.value = "";
      }, 5000);
    } else {
      errorMessage.value =
        response.message || "Không tìm thấy thông tin với email này";
      showError.value = true;
      setTimeout(() => {
        showError.value = false;
      }, 4000);
    }
  } catch (error) {
    errorMessage.value = "Không tìm thấy thông tin với email này.";
    showError.value = true;
    setTimeout(() => {
      showError.value = false;
    }, 4000);
  } finally {
    isLoading.value = false;
  }
};

// Watch email for real-time validation
watch(email, (newEmail) => {
  if (emailError.value && newEmail && validateEmail(newEmail)) {
    emailError.value = "";
  }
});
</script>

<style scoped>
@keyframes bounce-in {
  0% {
    transform: scale(0.9) translateY(-10px);
    opacity: 0;
  }
  50% {
    transform: scale(1.05) translateY(0);
  }
  100% {
    transform: scale(1) translateY(0);
    opacity: 1;
  }
}

@keyframes shake {
  0%,
  100% {
    transform: translateX(0);
  }
  25% {
    transform: translateX(-5px);
  }
  75% {
    transform: translateX(5px);
  }
}

@keyframes pulse-scale {
  0%,
  100% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.02);
  }
}

.animate-bounce-in {
  animation: bounce-in 0.6s ease-out;
}

.animate-shake {
  animation: shake 0.5s ease-in-out;
}

.animate-pulse-scale {
  animation: pulse-scale 2s ease-in-out infinite;
}

/* Custom focus styles */
.input:focus {
  box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
  border-color: rgb(220, 38, 38);
}

/* Button hover effects */
.btn:not(:disabled):hover {
  transform: translateY(-1px);
  box-shadow: 0 10px 25px rgba(220, 38, 38, 0.25);
}

/* Loading button styles */
.btn.loading {
  background: linear-gradient(45deg, #dc2626, #991b1b);
}

/* Backdrop blur for better loading overlay */
.backdrop-blur-sm {
  backdrop-filter: blur(4px);
}
</style>

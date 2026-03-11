<template>
  <div class="min-h-screen bg-black text-white py-20 px-6 lg:px-8">
    <div class="container mx-auto">
      <NuxtLink
        to="/huan-luyen-vien"
        class="btn btn-ghost text-red-500 hover:text-red-400 mb-8 text-lg"
      >
        <i class="fas fa-arrow-left mr-2"></i> Quay lại danh sách
      </NuxtLink>

      <!-- No Data State -->
      <div v-if="!trainer" class="text-center py-20">
        <div class="text-7xl mb-4 text-red-500">
          <i class="fas fa-exclamation-triangle"></i>
        </div>
        <h3 class="text-3xl font-bold text-gray-200 mb-3">
          Không tìm thấy huấn luyện viên
        </h3>
        <p class="text-gray-400 text-lg">
          Huấn luyện viên này có thể không tồn tại hoặc đã bị xóa.
        </p>
      </div>

      <!-- Trainer Details -->
      <div
        v-else
        class="bg-gray-900 rounded-2xl shadow-2xl border border-red-800/30 overflow-hidden lg:flex"
      >
        <!-- Trainer Image Section -->
        <div class="lg:w-1/3 relative overflow-hidden">
          <img
            :src="getImageUrl(trainer.photo_url)"
            :alt="trainer.full_name || 'Huấn luyện viên'"
            class="w-full h-96 lg:h-full object-cover transition-transform duration-500 hover:scale-105"
            @error="handleImageError"
          />

          <!-- Specialty Badge -->
          <div class="absolute top-6 left-6">
            <div
              class="badge font-bold text-base px-4 py-2 rounded-full shadow-md"
              :class="getBadgeClass(trainer.badge_class, trainer.specialty)"
            >
              {{ trainer.specialty?.toUpperCase() || "CHUNG" }}
            </div>
          </div>

          <!-- Rating Badge -->
          <div class="absolute bottom-6 left-6">
            <div
              class="bg-black/70 backdrop-blur-sm rounded-full px-4 py-2 flex items-center gap-2"
            >
              <div class="flex items-center">
                <i class="fas fa-star text-yellow-500"></i>
                <span class="text-white font-bold ml-1">{{
                  parseFloat(trainer.average_rating).toFixed(1)
                }}</span>
              </div>
              <span class="text-gray-300 text-sm">/5.0</span>
            </div>
          </div>
        </div>

        <!-- Trainer Details Section -->
        <div class="lg:w-2/3 p-8 md:p-12 flex flex-col justify-center">
          <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-3">
            {{ trainer.full_name || "Đang cập nhật" }}
          </h1>

          <p class="text-red-500 font-semibold text-2xl mb-2">
            {{ trainer.specialty || "Chuyên môn" }}
          </p>

          <p class="text-gray-300 text-lg mb-6">
            {{
              trainer.experience_years
                ? `${trainer.experience_years} năm kinh nghiệm`
                : "Chưa cập nhật kinh nghiệm"
            }}
          </p>

          <!-- Rating Display -->
          <div class="flex items-center gap-3 mb-6">
            <div class="flex items-center gap-1">
              <i
                v-for="star in 5"
                :key="star"
                class="fas fa-star text-lg"
                :class="
                  star <= Math.floor(parseFloat(trainer.average_rating))
                    ? 'text-yellow-500'
                    : 'text-gray-600'
                "
              ></i>
            </div>
            <span class="text-gray-400 text-lg font-medium">
              {{ parseFloat(trainer.average_rating).toFixed(1) }}/5.0
            </span>
          </div>

          <!-- Bio/Description -->
          <div class="mb-8">
            <h3 class="text-xl font-bold text-white mb-3 flex items-center">
              <i class="fas fa-user-circle text-red-500 mr-2"></i>
              Giới thiệu:
            </h3>
            <p class="text-gray-300 leading-relaxed text-base">
              {{
                trainer.bio ||
                "Chưa có thông tin giới thiệu chi tiết cho huấn luyện viên này."
              }}
            </p>
          </div>

          <!-- Certifications -->
          <div class="mb-8">
            <h3 class="text-xl font-bold text-white mb-3 flex items-center">
              <i class="fas fa-certificate text-red-500 mr-2"></i>
              Chứng chỉ:
            </h3>
            <div class="flex flex-wrap gap-3" v-if="trainer.certifications">
              <span
                v-for="certification in getCertificationsArray(
                  trainer.certifications
                )"
                :key="certification"
                class="badge badge-outline border-red-500 text-red-400 hover:bg-red-500 hover:text-white transition-colors duration-200 text-sm px-3 py-2 rounded-full"
              >
                <i class="fas fa-award mr-1"></i>
                {{ certification }}
              </span>
            </div>
            <p v-else class="text-gray-400 text-sm">
              Chưa có chứng chỉ nào được liệt kê.
            </p>
          </div>

          <!-- Social Media Links -->
          <div
            class="mb-8"
            v-if="trainer.facebook_url || trainer.instagram_url"
          >
            <h3 class="text-xl font-bold text-white mb-3 flex items-center">
              <i class="fas fa-share-alt text-red-500 mr-2"></i>
              Mạng xã hội:
            </h3>
            <div class="flex gap-4">
              <a
                v-if="trainer.facebook_url"
                :href="trainer.facebook_url"
                target="_blank"
                class="btn btn-outline btn-primary btn-sm rounded-full hover:scale-105 transition-transform duration-200"
              >
                <i class="fab fa-facebook-f mr-2"></i>
                Facebook
              </a>
              <a
                v-if="trainer.instagram_url"
                :href="trainer.instagram_url"
                target="_blank"
                class="btn btn-outline btn-secondary btn-sm rounded-full hover:scale-105 transition-transform duration-200"
              >
                <i class="fab fa-instagram mr-2"></i>
                Instagram
              </a>
            </div>
          </div>

          <!-- Price and Contact -->
          <div
            class="mt-auto pt-6 border-t border-gray-700/50 flex flex-col md:flex-row justify-between items-center gap-6"
          >
            <div class="flex items-center gap-2">
              <i class="fas fa-money-bill-wave text-red-500 text-2xl"></i>
              <div>
                <div class="text-red-500 font-black text-3xl">
                  {{ formatCurrency(trainer.price_per_session) }}
                </div>
                <div class="text-gray-400 text-sm">per session</div>
              </div>
            </div>

            <div class="flex gap-3">
              <button
                class="btn btn-outline btn-error text-white font-bold text-base px-6 py-3 rounded-full hover:bg-red-600 hover:border-red-600 transition-all duration-200"
              >
                <i class="fas fa-heart mr-2"></i>
                Yêu thích
              </button>
              <button
                class="btn btn-error text-white font-bold text-base px-6 py-3 rounded-full shadow-lg hover:bg-red-700 transform transition-all duration-200 hover:scale-105"
              >
                <i class="fas fa-phone mr-2"></i>
                Liên hệ ngay
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { computed } from "vue";
import { useRoute } from "vue-router";
import { useHead, useFetch, useRuntimeConfig } from "#app";

// Lấy route param
const route = useRoute();
const trainerId = computed(() => {
  const id = Number(route.params.id);
  return isNaN(id) ? null : id;
});

const config = useRuntimeConfig();

// Trạng thái dữ liệu & gọi API
const { data: trainerData, error } = await useFetch(
  () => `trainers/${trainerId.value}`,
  {
    baseURL: config.public.apiBase,
    // Sử dụng key để đảm bảo fetch lại dữ liệu khi id thay đổi
    key: `trainer-${trainerId.value}`,
    // Chỉ fetch khi trainerId có giá trị hợp lệ (không phải null)
    disabled: computed(() => !trainerId.value),
  }
);

const trainer = computed(() => trainerData.value?.data || null);

if (error.value) {
  console.error("Lỗi khi gọi API HLV:", error.value);
}

// -------- Helper functions -------- //

// Định dạng tiền
const formatCurrency = (value) => {
  if (!value || isNaN(value)) return "Liên hệ";
  return new Intl.NumberFormat("vi-VN", {
    style: "currency",
    currency: "VND",
    minimumFractionDigits: 0,
  }).format(value);
};

// Lấy URL ảnh
const getImageUrl = (url) => {
  return url || "/images/placeholder.svg";
};

// Fallback khi ảnh lỗi
const handleImageError = (event) => {
  event.target.src = "/images/placeholder.svg";
};

// Chuyển chuỗi chứng chỉ thành mảng
const getCertificationsArray = (str) => {
  return (
    str
      ?.split(",")
      .map((s) => s.trim())
      .filter(Boolean) || []
  );
};

// Gán class huy hiệu
const getBadgeClass = (badge, specialty) => {
  const predefined = {
    primary: "bg-blue-600 text-white border-blue-600",
    secondary: "bg-purple-600 text-white border-purple-600",
    success: "bg-green-600 text-white border-green-600",
    warning: "bg-yellow-600 text-black border-yellow-600",
    error: "bg-red-600 text-white border-red-600",
    info: "bg-cyan-600 text-white border-cyan-600",
  };

  const specialtyMap = {
    Yoga: "bg-green-600 text-white border-green-600",
    Fitness: "bg-red-600 text-white border-red-600",
    Boxing: "bg-orange-600 text-white border-orange-600",
    Cardio: "bg-blue-600 text-white border-blue-600",
    Pilates: "bg-purple-600 text-white border-purple-600",
    Crossfit: "bg-gray-600 text-white border-gray-600",
  };

  return (
    predefined[badge] ||
    specialtyMap[specialty] ||
    "bg-red-600 text-white border-red-600"
  );
};

// -------- SEO metadata -------- //
useHead({
  title: computed(() =>
    trainer.value
      ? `HLV ${trainer.value.full_name} | GymTech`
      : "Chi tiết Huấn luyện viên | GymTech"
  ),
  meta: [
    {
      name: "description",
      content: computed(() =>
        trainer.value?.bio
          ? trainer.value.bio
          : `Thông tin chi tiết về huấn luyện viên ${
              trainer.value?.full_name || ""
            } chuyên về ${trainer.value?.specialty || ""} tại GymTech.`
      ),
    },
  ],
});
</script>

<style scoped>
/* Custom animations */
.btn:hover {
  transform: translateY(-2px);
}

.badge {
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Star rating animation */
.fa-star {
  transition: all 0.2s ease;
}

/* Social media button animations */
.btn-outline:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}
</style>

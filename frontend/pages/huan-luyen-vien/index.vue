<template>
  <div class="min-h-screen bg-black text-white">
    <!-- Hero Section -->
    <section
      class="relative py-24 md:py-32 bg-gradient-to-br from-gray-950 via-red-950 to-black overflow-hidden"
    >
      <div class="relative z-10 container mx-auto px-4 text-center">
        <h1
          class="text-5xl md:text-7xl font-extrabold mb-6 text-red-500 custom-hero-text-shadow leading-tight"
        >
          <span class="text-white">Đội Ngũ</span>
          <span class="text-red-500"> Huấn Luyện Viên</span>
        </h1>
        <p class="text-xl md:text-2xl text-gray-300 mb-10 max-w-xl mx-auto">
          Gặp gỡ đội ngũ chuyên nghiệp, sẵn sàng đồng hành cùng bạn
        </p>
      </div>
    </section>

    <!-- Advanced Filter Section -->
    <section
      class="py-8 bg-gray-900 border-y border-red-700/50 shadow-inner shadow-red-900/20"
    >
      <div class="container mx-auto px-4">
        <div class="mb-6">
          <div class="relative max-w-md mx-auto">
            <input
              v-model="searchQuery"
              type="text"
              placeholder="Tìm kiếm huấn luyện viên..."
              class="w-full px-4 py-3 pl-12 bg-gray-800 border border-red-700/50 rounded-full text-white placeholder-gray-400 focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-500/20"
            />
            <i
              class="ri-search-line absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"
            ></i>
          </div>
        </div>

        <div class="flex flex-wrap gap-3 justify-center mb-6">
          <button
            v-for="specialty in specialties"
            :key="specialty.value"
            @click="selectedSpecialty = specialty.value"
            :class="
              selectedSpecialty === specialty.value
                ? 'btn-error'
                : 'btn-outline btn-error'
            "
            class="btn btn-sm"
          >
            {{ specialty.label }}
          </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 max-w-4xl mx-auto">
          <div>
            <label class="block text-red-400 font-semibold mb-2"
              >Kinh nghiệm</label
            >
            <select
              v-model="selectedExperience"
              class="select select-bordered w-full bg-gray-800"
            >
              <option value="all">Tất cả</option>
              <option value="0-2">0-2 năm</option>
              <option value="3-5">3-5 năm</option>
              <option value="6-10">6-10 năm</option>
              <option value="10+">10+ năm</option>
            </select>
          </div>
          <div>
            <label class="block text-red-400 font-semibold mb-2"
              >Đánh giá tối thiểu</label
            >
            <select
              v-model="selectedRating"
              class="select select-bordered w-full bg-gray-800"
            >
              <option value="0">Tất cả</option>
              <option value="3">3+ sao</option>
              <option value="4">4+ sao</option>
            </select>
          </div>
          <div>
            <label class="block text-red-400 font-semibold mb-2"
              >Sắp xếp theo</label
            >
            <select
              v-model="sortBy"
              class="select select-bordered w-full bg-gray-800"
            >
              <option value="name">Tên A-Z</option>
              <option value="rating">Đánh giá cao nhất</option>
              <option value="experience">Kinh nghiệm nhiều nhất</option>
            </select>
          </div>
        </div>
      </div>
    </section>

    <!-- Trainers Grid -->
    <section class="py-16">
      <div class="container mx-auto px-4">
        <div v-if="pending" class="text-center py-16">
          <span class="loading loading-spinner loading-lg"></span>
        </div>
        <div v-else-if="error" class="text-center py-16 text-red-400">
          Có lỗi xảy ra khi tải dữ liệu.
        </div>
        <div v-else-if="!filteredTrainers.length" class="text-center py-16">
          <h3 class="text-3xl font-bold text-gray-200 mb-4">
            Không tìm thấy huấn luyện viên nào
          </h3>
          <p class="text-gray-400 text-lg mb-6">
            Thử điều chỉnh bộ lọc hoặc từ khóa tìm kiếm
          </p>
          <button @click="resetFilters" class="btn btn-error">
            Đặt lại bộ lọc
          </button>
        </div>
        <div
          v-else
          class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6"
        >
          <div
            v-for="trainer in displayedTrainers"
            :key="trainer.id"
            class="bg-gray-900 rounded-xl border border-red-800/30 overflow-hidden group hover:border-red-600/50 transition-all duration-300 hover:shadow-xl hover:shadow-red-900/30 hover:-translate-y-2"
          >
            <!-- Trainer Image -->
            <div class="relative overflow-hidden aspect-[3/4]">
              <img
                :src="getImageUrl(trainer.photo_url)"
                :alt="trainer.full_name || 'Huấn luyện viên'"
                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110"
                @error="handleImageError"
              />

              <!-- Specialty Badge -->
              <div class="absolute top-3 left-3">
                <span
                  class="bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg"
                >
                  {{ trainer.specialty?.toUpperCase() || "CHUNG" }}
                </span>
              </div>

              <!-- Rating Badge -->
              <div
                class="absolute top-3 right-3 bg-black/70 rounded-full px-2 py-1"
              >
                <div class="flex items-center gap-1 text-yellow-400">
                  <i class="fas fa-star text-xs"></i>
                  <span class="text-white text-xs font-bold">
                    {{ trainer.average_rating?.toFixed(1) || "N/A" }}
                  </span>
                </div>
              </div>

              <!-- Overlay -->
              <div
                class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"
              ></div>
            </div>

            <!-- Trainer Info -->
            <div class="p-4">
              <h3 class="text-lg font-bold text-white mb-1 truncate">
                {{ trainer.full_name || "Đang cập nhật" }}
              </h3>

              <p class="text-red-400 text-sm font-medium mb-2">
                {{ trainer.specialty || "Chuyên môn chung" }}
              </p>

              <!-- Experience -->
              <div class="flex items-center gap-2 mb-3 text-gray-400 text-sm">
                <i class="fas fa-medal"></i>
                <span>
                  {{
                    trainer.experience_years
                      ? `${trainer.experience_years} năm`
                      : "Chưa cập nhật"
                  }}
                </span>
              </div>

              <!-- Certifications -->
              <div class="mb-3">
                <div class="flex flex-wrap gap-1">
                  <span
                    v-for="cert in getCertificationsArray(
                      trainer.certifications
                    ).slice(0, 2)"
                    :key="cert"
                    class="text-xs bg-red-600/20 text-red-400 px-2 py-1 rounded border border-red-600/30"
                  >
                    {{ cert }}
                  </span>
                  <span
                    v-if="
                      getCertificationsArray(trainer.certifications).length > 2
                    "
                    class="text-xs bg-gray-700 text-gray-300 px-2 py-1 rounded"
                  >
                    +{{
                      getCertificationsArray(trainer.certifications).length - 2
                    }}
                  </span>
                </div>
              </div>

              <!-- Price and Action -->
              <div class="flex items-center justify-between">
                <div class="text-red-500 font-bold">
                  {{
                    trainer.price_per_session
                      ? formatCurrency(trainer.price_per_session)
                      : "Liên hệ"
                  }}
                  <div class="text-xs text-gray-400 font-normal">/ buổi</div>
                </div>
                <NuxtLink
                  :to="`/huan-luyen-vien/${trainer.id}`"
                  class="bg-red-600 hover:bg-red-700 text-white text-sm font-bold px-4 py-2 rounded-full transition-colors duration-200"
                >
                  Chi tiết
                </NuxtLink>
              </div>
            </div>
          </div>
        </div>

        <div class="text-center mt-12" v-if="hasMore">
          <button @click="loadMore" class="btn btn-error btn-outline">
            Xem Thêm
          </button>
        </div>
      </div>
    </section>
  </div>
</template>
<script setup>
import { ref, computed, watch } from "vue";
import { useHead } from "#app";
import { useCustomSeoMeta } from "~/composables/useCustomSeoMeta";

useCustomSeoMeta({
  title: "Huấn Luyện Viên | GymTech",
  description:
    "Gặp gỡ đội ngũ huấn luyện viên chuyên nghiệp tại GymTech – những người đồng hành trong hành trình thay đổi của bạn.",
  image: "https://gymtech.vn/images/trainers.jpg",
  url: "https://gymtech.vn/huan-luyen-vien",
  keywords:
    "huấn luyện viên gym, PT cá nhân, GymTech trainer, huấn luyện viên thể hình",
});

const {
  data: trainersResponse,
  pending,
  error,
} = await useApiFetch("/trainers");

const allTrainers = ref([]);

watch(
  trainersResponse,
  (newResponseData) => {
    if (newResponseData && newResponseData.data) {
      // Lặp qua dữ liệu gốc và tạo một mảng mới đã được "làm sạch"
      allTrainers.value = newResponseData.data.map((trainer) => ({
        ...trainer,
        // Đảm bảo average_rating luôn là một con số.
        // Gán giá trị mặc định là 5.0 nếu API không trả về.
        average_rating: parseFloat(trainer.average_rating) || 5.0,
      }));
    }
  },
  { immediate: true }
); // immediate: true để nó chạy ngay lần đầu tiên

// --- 3. STATE MANAGEMENT (QUẢN LÝ TRẠNG THÁI) ---
const selectedSpecialty = ref("all");
const displayCount = ref(9);
const hasMore = ref(true);
const searchQuery = ref("");
const selectedExperience = ref("all");
const selectedRating = ref(0);
const sortBy = ref("name");

// Danh sách các chuyên môn để lọc (tự động tạo từ dữ liệu API)
const specialties = computed(() => {
  const uniqueSpecialties = [
    ...new Set(allTrainers.value.map((t) => t.specialty).filter(Boolean)),
  ];
  return [
    { value: "all", label: "Tất cả" },
    ...uniqueSpecialties.map((s) => ({ value: s, label: s })),
  ];
});

// --- 4. COMPUTED PROPERTIES (DỮ LIỆU TÍNH TOÁN) ---

// Lọc danh sách HLV dựa trên các bộ lọc
const filteredTrainers = computed(() => {
  let filtered = [...allTrainers.value];

  // Lọc theo từ khóa tìm kiếm
  if (searchQuery.value.trim()) {
    const query = searchQuery.value.toLowerCase().trim();
    filtered = filtered.filter(
      (trainer) =>
        trainer.full_name?.toLowerCase().includes(query) ||
        trainer.specialty?.toLowerCase().includes(query)
    );
  }

  // Lọc theo chuyên môn
  if (selectedSpecialty.value !== "all") {
    filtered = filtered.filter(
      (trainer) => trainer.specialty === selectedSpecialty.value
    );
  }

  // Lọc theo kinh nghiệm
  if (selectedExperience.value !== "all") {
    filtered = filtered.filter((trainer) => {
      const years = trainer.experience_years || 0;
      switch (selectedExperience.value) {
        case "0-2":
          return years <= 2;
        case "3-5":
          return years >= 3 && years <= 5;
        case "6-10":
          return years >= 6 && years <= 10;
        case "10+":
          return years > 10;
        default:
          return true;
      }
    });
  }

  // Lọc theo đánh giá
  if (selectedRating.value > 0) {
    filtered = filtered.filter(
      (trainer) => trainer.average_rating >= selectedRating.value
    );
  }

  // Sắp xếp
  filtered.sort((a, b) => {
    switch (sortBy.value) {
      case "name":
        return (a.full_name || "").localeCompare(b.full_name || "");
      case "rating":
        return b.average_rating - a.average_rating;
      case "experience":
        return (b.experience_years || 0) - (a.experience_years || 0);
      default:
        return 0;
    }
  });

  return filtered;
});

// Lấy ra danh sách HLV để hiển thị dựa trên số lượng `displayCount`
const displayedTrainers = computed(() => {
  return filteredTrainers.value.slice(0, displayCount.value);
});

// --- 5. WATCHERS (THEO DÕI THAY ĐỔI) ---

// Tự động cập nhật lại biến `hasMore`
watch(
  [filteredTrainers, displayCount],
  () => {
    hasMore.value = filteredTrainers.value.length > displayCount.value;
  },
  { immediate: true }
);

// Reset lại số lượng hiển thị khi bộ lọc thay đổi
watch(
  [selectedSpecialty, selectedExperience, selectedRating, searchQuery],
  () => {
    displayCount.value = 9;
  }
);

// --- 6. METHODS (CÁC HÀM XỬ LÝ) ---

const loadMore = () => {
  displayCount.value += 6;
};

const resetFilters = () => {
  selectedSpecialty.value = "all";
  selectedExperience.value = "all";
  selectedRating.value = 0;
  searchQuery.value = "";
  sortBy.value = "name";
  displayCount.value = 9;
};

const handleImageError = (event) => {
  event.target.src = "https://placehold.co/600x800/1f2937/FFF?text=GymTech";
};

const getImageUrl = (url) => {
  return url || "https://placehold.co/600x800/1f2937/FFF?text=GymTech";
};

const getCertificationsArray = (certificationsString) => {
  if (!certificationsString) return [];
  return certificationsString
    .split(",")
    .map((s) => s.trim())
    .filter(Boolean);
};

const formatCurrency = (number) => {
  if (typeof number !== "number") return "Liên hệ";
  return new Intl.NumberFormat("vi-VN", {
    style: "currency",
    currency: "VND",
  }).format(number);
};
</script>

<style scoped>
.custom-hero-text-shadow {
  text-shadow: 0 0 25px rgba(239, 68, 68, 0.9), 0 0 40px rgba(239, 68, 68, 0.7);
}

.pulse-red {
  animation: pulse-red-effect 2s infinite;
}

@keyframes pulse-red-effect {
  0% {
    box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
  }
  70% {
    box-shadow: 0 0 0 15px rgba(239, 68, 68, 0);
  }
  100% {
    box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
  }
}

/* Custom scrollbar */
::-webkit-scrollbar {
  width: 8px;
}

::-webkit-scrollbar-track {
  background: #1f2937;
}

::-webkit-scrollbar-thumb {
  background: #dc2626;
  border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
  background: #b91c1c;
}
</style>

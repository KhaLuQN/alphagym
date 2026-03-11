<template>
  <div class="min-h-screen bg-black text-white">
    <!-- Hero Section -->
    <section class="relative py-24 md:py-32 bg-gradient-to-br from-gray-950 via-red-950 to-black overflow-hidden">
      <div class="relative z-10 container mx-auto px-4">
        <div class="text-center">
          <h1 class="text-5xl md:text-7xl font-extrabold mb-6 text-red-500 custom-hero-text-shadow leading-tight">
            <i class="fas fa-cogs mr-4 text-red-600"></i>
            <span class="text-white">Thiết Bị</span>
            <span class="text-red-500"> Tập Luyện</span>
          </h1>
          <p class="text-xl md:text-2xl text-gray-300 mb-10 max-w-xl mx-auto">
            Khám phá hệ thống máy móc và dụng cụ tập luyện hiện đại nhất tại GymTech
          </p>
        </div>
      </div>
    </section>

    <!-- Filters and Search Section -->
    <section class="py-8 bg-gray-900 border-b border-red-700/50 shadow-inner shadow-red-900/20">
      <div class="container mx-auto px-4">
        <div class="flex flex-wrap gap-4 justify-center mb-6">
          <button
            v-for="category in categories"
            :key="category.slug"
            @click="selectedCategory = category.slug"
            :class="selectedCategory === category.slug ? 'bg-red-700 border-red-700' : ''"
            class="btn bg-red-600 hover:bg-red-700 border-red-600 text-white font-bold text-lg px-6 py-3 rounded-full shadow-lg transform transition-transform duration-200 hover:scale-105"
          >
            {{ category.name }}
          </button>
        </div>

        <div class="relative max-w-full mx-auto mb-8">
          <input
            type="text"
            v-model="searchTerm"
            @input="filterEquipment"
            placeholder="Tìm kiếm thiết bị..."
            class="input input-bordered input-lg w-full bg-black/50 text-white border-red-600/50 focus:border-red-500 pr-16"
          />
          <button
            class="absolute right-2 top-1/2 transform -translate-y-1/2 btn btn-error btn-sm"
          >
            <i class="fas fa-search"></i>
          </button>
        </div>

        <!-- View Controls (Sort & View Mode) -->
        <div class="flex flex-wrap items-center justify-end gap-4">
          <!-- Sort -->
          <div class="dropdown dropdown-end">
            <label
              tabindex="0"
              class="btn btn-outline btn-sm border-red-600/50 text-red-400 hover:bg-red-600 hover:text-white"
            >
              <i class="fas fa-sort mr-2"></i>{{ getSortLabel() }}
            </label>
            <ul
              tabindex="0"
              class="dropdown-content z-[1] menu p-2 shadow bg-gray-800 rounded-box w-52"
            >
              <li>
                <a
                  @click="sortEquipment('name-asc')"
                  class="text-white hover:text-red-400"
                  >Tên A-Z</a
                >
              </li>
              <li>
                <a
                  @click="sortEquipment('name-desc')"
                  class="text-white hover:text-red-400"
                  >Tên Z-A</a
                >
              </li>
              <li>
                <a
                  @click="sortEquipment('maintenance-newest')"
                  class="text-white hover:text-red-400"
                  >Bảo trì gần nhất</a
                >
              </li>
              <li>
                <a
                  @click="sortEquipment('maintenance-oldest')"
                  class="text-white hover:text-red-400"
                  >Bảo trì cũ nhất</a
                >
              </li>
            </ul>
          </div>

          <!-- View Mode -->
          <div class="btn-group">
            <button
              :class="[
                'btn btn-sm',
                viewMode === 'grid'
                  ? 'btn-error'
                  : 'btn-outline border-red-600/50 text-red-400 hover:bg-red-600 hover:text-white',
              ]"
              @click="viewMode = 'grid'"
            >
              <i class="fas fa-th"></i>
            </button>
            <button
              :class="[
                'btn btn-sm',
                viewMode === 'list'
                  ? 'btn-error'
                  : 'btn-outline border-red-600/50 text-red-400 hover:bg-red-600 hover:text-white',
              ]"
              @click="viewMode = 'list'"
            >
              <i class="fas fa-list"></i>
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- Equipment Grid/List Section -->
    <section class="py-16">
      <div class="container mx-auto px-4">
        <!-- Loading State -->
        <div v-if="isLoading" class="flex justify-center items-center py-20">
          <div class="loading loading-spinner loading-lg text-red-500"></div>
        </div>

        <!-- Empty State -->
        <div v-else-if="currentEquipment.length === 0" class="text-center py-20">
          <div class="text-6xl mb-4">
            <i class="fas fa-search text-red-400"></i>
          </div>
          <h3 class="text-2xl font-bold text-gray-300 mb-2">
            Không tìm thấy thiết bị nào
          </h3>
          <p class="text-gray-500">Thử thay đổi từ khóa tìm kiếm hoặc bộ lọc</p>
        </div>

        <!-- Grid View -->
        <div
          v-else-if="viewMode === 'grid'"
          class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
        >
          <div
            v-for="item in currentEquipment"
            :key="item.id"
            class="card bg-gray-900 rounded-xl shadow-xl border border-red-800/30 p-6 text-center transform transition-all duration-300 hover:scale-[1.02] hover:shadow-2xl hover:shadow-red-900/50 cursor-pointer group"
            @click="navigateToEquipmentDetail(item.slug)"
          >
            <figure class="relative overflow-hidden mb-6">
              <img
                :src="getImageUrl(item.image_url)"
                :alt="item.name"
                class="w-full h-56 object-cover rounded-lg transition-transform duration-300 group-hover:scale-110"
                @error="handleImageError"
              />
              <div class="absolute top-4 left-4">
                <div class="badge bg-red-600 text-white border-red-600 font-bold">
                  {{ item.category }}
                </div>
              </div>
              <div v-if="item.status === 'maintenance'" class="absolute top-4 right-4">
                <div class="badge badge-warning text-black font-bold">
                  <i class="fas fa-tools mr-1"></i>Bảo trì
                </div>
              </div>
            </figure>

            <div class="card-body p-0">
              <h3 class="card-title text-2xl font-extrabold text-white mb-2 line-clamp-2 group-hover:text-red-400 transition-colors">
                {{ item.name }}
              </h3>
              <p class="text-gray-400 text-base mb-4 line-clamp-3">
                {{ item.description }}
              </p>

              <div class="flex items-center justify-between text-gray-500 text-sm mb-4">
                <div class="flex items-center">
                  <i class="fas fa-calendar-alt mr-2"></i>
                  <span>Bảo trì: {{ formatDate(item.last_maintenance_date) }}</span>
                </div>
              </div>

              <div class="card-actions justify-end">
                <button
                  class="btn btn-error text-white font-bold px-6 py-3 rounded-full shadow-lg hover:bg-red-700 transform transition-transform duration-200 hover:scale-105"
                >
                  Xem Chi Tiết
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- List View -->
        <div v-else class="space-y-6">
          <div
            v-for="item in currentEquipment"
            :key="item.id"
            class="card lg:card-side bg-gray-900 rounded-xl shadow-xl border border-red-800/30 overflow-hidden transform transition-all duration-300 hover:scale-[1.01] hover:shadow-2xl hover:shadow-red-900/50 cursor-pointer group"
            @click="navigateToEquipmentDetail(item.slug)"
          >
            <figure class="lg:w-80 relative overflow-hidden">
              <img
                :src="getImageUrl(item.image_url)"
                :alt="item.name"
                class="w-full h-48 lg:h-full object-cover transition-transform duration-300 group-hover:scale-105"
                @error="handleImageError"
              />
              <div class="absolute top-4 left-4">
                <div class="badge bg-red-600 text-white font-bold">
                  {{ item.category }}
                </div>
              </div>
              <div v-if="item.status === 'maintenance'" class="absolute top-4 right-4">
                <div class="badge badge-warning text-black font-bold">
                  <i class="fas fa-tools mr-1"></i>Bảo trì
                </div>
              </div>
            </figure>
            <div class="card-body p-6">
              <h3 class="card-title text-xl font-extrabold text-white mb-2 group-hover:text-red-400 transition-colors">
                {{ item.name }}
              </h3>
              <p class="text-gray-400 text-base line-clamp-3 mb-4">
                {{ item.description }}
              </p>
              <div class="flex items-center justify-between text-gray-500 text-sm mb-4">
                <div class="flex items-center">
                  <i class="fas fa-calendar-alt mr-2"></i>
                  <span>Bảo trì gần nhất: {{ formatDate(item.last_maintenance_date) }}</span>
                </div>
              </div>
              <div class="card-actions justify-end">
                <button
                  class="btn btn-error text-white font-bold px-6 py-3 rounded-full shadow-lg hover:bg-red-700 transform transition-transform duration-200 hover:scale-105"
                >
                  Xem Chi Tiết
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="text-center mt-12" v-if="hasMore">
          <button
            @click="loadMore"
            class="btn btn-primary bg-red-600 hover:bg-red-700 border-red-600 hover:border-red-700 text-white font-bold text-lg px-8 py-4 rounded-full shadow-lg transform transition-transform duration-200 hover:scale-105 pulse-red"
          >
            Xem Thêm Thiết Bị
          </button>
        </div>
      </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-16 bg-gray-900 border-t border-red-700/50 shadow-inner shadow-red-900/20">
      <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
          <div class="text-center">
            <div class="text-5xl font-extrabold text-red-500 mb-3">{{ totalEquipmentCount }}+</div>
            <div class="text-gray-300 text-lg">Tổng số thiết bị</div>
          </div>
          <div class="text-center">
            <div class="text-5xl font-extrabold text-red-500 mb-3">{{ availableEquipmentCount }}+</div>
            <div class="text-gray-300 text-lg">Thiết bị sẵn sàng</div>
          </div>
          <div class="text-center">
            <div class="text-5xl font-extrabold text-red-500 mb-3">{{ newEquipmentCount }}+</div>
            <div class="text-gray-300 text-lg">Thiết bị mới</div>
          </div>
          <div class="text-center">
            <div class="text-5xl font-extrabold text-red-500 mb-3">24/7</div>
            <div class="text-gray-300 text-lg">Hỗ trợ kỹ thuật</div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, computed, watch, onMounted } from "vue";
import { useHead } from '#app';
import { navigateTo } from '#app';

// Mock data for gym equipment
const allEquipment = ref([
  {
    id: 1,
    name: "Máy chạy bộ điện đa năng",
    slug: "may-chay-bo-dien-da-nang",
    description: "Máy chạy bộ hiện đại với nhiều chế độ tập luyện, màn hình cảm ứng và kết nối ứng dụng, phù hợp cho mọi cấp độ người dùng.",
    image_url: "https://images.unsplash.com/photo-1534438327276-14873cb4eafb?w=1200&h=800&fit=crop&q=80",
    category: "Cardio",
    status: "available",
    last_maintenance_date: "2025-06-15",
    is_new: false,
  },
  {
    id: 2,
    name: "Ghế tập tạ đa năng",
    slug: "ghe-tap-ta-da-nang",
    description: "Ghế tập tạ điều chỉnh đa năng, hỗ trợ nhiều bài tập cơ bắp khác nhau như đẩy ngực, tập vai, tập tay.",
    image_url: "https://images.unsplash.com/photo-1594381837591-82977329611a?w=1200&h=800&fit=crop&q=80",
    category: "Strength",
    status: "available",
    last_maintenance_date: "2025-07-01",
    is_new: true,
  },
  {
    id: 3,
    name: "Bộ tạ đơn cao cấp",
    slug: "bo-ta-don-cao-cap",
    description: "Bộ tạ đơn từ 2kg đến 30kg, bọc cao su chống trượt, an toàn và thoải mái khi sử dụng, lý tưởng cho các bài tập cá nhân.",
    image_url: "https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=1200&h=800&fit=crop&q=80",
    category: "Free Weights",
    status: "available",
    last_maintenance_date: "2025-06-20",
    is_new: false,
  },
  {
    id: 4,
    name: "Xe đạp tập thể dục",
    slug: "xe-dap-tap-the-duc",
    description: "Xe đạp tập thể dục trong nhà, có thể điều chỉnh kháng lực, màn hình hiển thị calo, quãng đường, nhịp tim.",
    image_url: "https://images.unsplash.com/photo-1584829184622-d7e0724c779f?w=1200&h=800&fit=crop&q=80",
    category: "Cardio",
    status: "available",
    last_maintenance_date: "2025-06-25",
    is_new: false,
  },
  {
    id: 5,
    name: "Máy tập cơ bụng",
    slug: "may-tap-co-bung",
    description: "Thiết bị chuyên dụng giúp tập luyện cơ bụng hiệu quả, giảm mỡ thừa vùng eo và tăng cường sức mạnh cốt lõi.",
    image_url: "https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=1200&h=800&fit=crop&q=80",
    category: "Strength",
    status: "available",
    last_maintenance_date: "2025-07-05",
    is_new: true,
  },
  {
    id: 6,
    name: "Khung gánh tạ Squat Rack",
    slug: "khung-ganh-ta-squat-rack",
    description: "Khung gánh tạ chắc chắn, an toàn cho các bài tập Squat, Bench Press, và các bài tập sức mạnh khác.",
    image_url: "https://images.unsplash.com/photo-1534438327276-14873cb4eafb?w=1200&h=800&fit=crop&q=80",
    category: "Strength",
    status: "available",
    last_maintenance_date: "2025-06-10",
    is_new: false,
  },
  {
    id: 7,
    name: "Máy tập chèo thuyền",
    slug: "may-tap-cheo-thuyen",
    description: "Máy tập toàn thân hiệu quả, mô phỏng động tác chèo thuyền, tăng cường sức bền và đốt cháy calo.",
    image_url: "https://images.unsplash.com/photo-1552674605-db6ffd4ed524?w=1200&h=800&fit=crop&q=80",
    category: "Cardio",
    status: "available",
    last_maintenance_date: "2025-07-03",
    is_new: false,
  },
  {
    id: 8,
    name: "Băng ghế tập bụng",
    slug: "bang-ghe-tap-bung",
    description: "Băng ghế chuyên dụng cho các bài tập cơ bụng và lưng dưới, giúp định hình vóc dáng.",
    image_url: "https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=1200&h=800&fit=crop&q=80",
    category: "Strength",
    status: "available",
    last_maintenance_date: "2025-06-28",
    is_new: false,
  },
  {
    id: 9,
    name: "Máy tập đa năng Smith Machine",
    slug: "may-tap-da-nang-smith-machine",
    description: "Máy Smith đa năng, an toàn cho các bài tập phức hợp, có thể điều chỉnh độ cao và tải trọng.",
    image_url: "https://images.unsplash.com/photo-1534438327276-14873cb4eafb?w=1200&h=800&fit=crop&q=80",
    category: "Strength",
    status: "available",
    last_maintenance_date: "2025-07-08",
    is_new: true,
  },
  {
    id: 10,
    name: "Bóng tập Yoga",
    slug: "bong-tap-yoga",
    description: "Bóng tập Yoga chất liệu cao cấp, chống nổ, hỗ trợ các bài tập thăng bằng, linh hoạt và phục hồi.",
    image_url: "https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=1200&h=800&fit=crop&q=80",
    category: "Accessories",
    status: "available",
    last_maintenance_date: "2025-07-01",
    is_new: false,
  },
  {
    id: 11,
    name: "Dây kháng lực",
    slug: "day-khang-luc",
    description: "Bộ dây kháng lực đa dạng cấp độ, lý tưởng cho các bài tập khởi động, phục hồi và tăng cường sức mạnh.",
    image_url: "https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=1200&h=800&fit=crop&q=80",
    category: "Accessories",
    status: "available",
    last_maintenance_date: "2025-06-22",
    is_new: true,
  },
  {
    id: 12,
    name: "Máy tập cơ vai",
    slug: "may-tap-co-vai",
    description: "Máy tập chuyên biệt cho cơ vai, giúp phát triển cơ vai săn chắc và khỏe mạnh.",
    image_url: "https://images.unsplash.com/photo-1534438327276-14873cb4eafb?w=1200&h=800&fit=crop&q=80",
    category: "Strength",
    status: "available",
    last_maintenance_date: "2025-07-07",
    is_new: false,
  },
]);

// Reactive data
const equipment = ref([]);
const searchTerm = ref("");
const selectedCategory = ref("all");
const viewMode = ref("grid");
const sortBy = ref("name-asc");
const displayCount = ref(9);
const isLoading = ref(true);

// Categories for filtering
const categories = computed(() => {
  const uniqueCategories = [...new Set(allEquipment.value.map(item => item.category))];
  return [{ name: 'Tất cả', slug: 'all' }, ...uniqueCategories.map(cat => ({ name: cat, slug: cat }))];
});

// Computed properties for filtering and sorting
const filteredEquipment = computed(() => {
  let filtered = allEquipment.value;

  // Filter by search term
  if (searchTerm.value) {
    filtered = filtered.filter(
      (item) =>
        item.name.toLowerCase().includes(searchTerm.value.toLowerCase()) ||
        item.description.toLowerCase().includes(searchTerm.value.toLowerCase())
    );
  }

  // Filter by category
  if (selectedCategory.value !== "all") {
    filtered = filtered.filter(
      (item) => item.category === selectedCategory.value
    );
  }

  // Sort equipment
  switch (sortBy.value) {
    case "name-asc":
      filtered.sort((a, b) => a.name.localeCompare(b.name));
      break;
    case "name-desc":
      filtered.sort((a, b) => b.name.localeCompare(a.name));
      break;
    case "maintenance-newest":
      filtered.sort(
        (a, b) => new Date(b.last_maintenance_date) - new Date(a.last_maintenance_date)
      );
      break;
    case "maintenance-oldest":
      filtered.sort(
        (a, b) => new Date(a.last_maintenance_date) - new Date(b.last_maintenance_date)
      );
      break;
  }

  return filtered;
});

const currentEquipment = computed(() => {
  return filteredEquipment.value.slice(0, displayCount.value);
});

const hasMore = computed(() => {
  return filteredEquipment.value.length > displayCount.value;
});

// Statistics
const totalEquipmentCount = computed(() => allEquipment.value.length);
const availableEquipmentCount = computed(() => allEquipment.value.filter(item => item.status === 'available').length);
const newEquipmentCount = computed(() => allEquipment.value.filter(item => item.is_new).length);


// Methods
const filterEquipment = () => {
  displayCount.value = 9; // Reset display count when filters change
};

const sortEquipment = (sortType) => {
  sortBy.value = sortType;
  displayCount.value = 9; // Reset display count when sorting changes
};

const loadMore = () => {
  displayCount.value += 6; // Load 6 more items
};

const getImageUrl = (imageUrl) => {
  if (!imageUrl) {
    return '/placeholder.svg?height=800&width=1200&text=Thiết+bị+tập'; // Placeholder for landscape images
  }
  return imageUrl;
};

const handleImageError = (event) => {
  event.target.src = '/placeholder.svg?height=800&width=1200&text=Lỗi+ảnh';
};

const formatDate = (dateString) => {
  if (!dateString) return "Chưa cập nhật";
  const date = new Date(dateString);
  return date.toLocaleDateString("vi-VN", {
    year: "numeric",
    month: "long",
    day: "numeric",
  });
};

const getSortLabel = () => {
  switch (sortBy.value) {
    case "name-asc":
      return "Tên A-Z";
    case "name-desc":
      return "Tên Z-A";
    case "maintenance-newest":
      return "Bảo trì gần nhất";
    case "maintenance-oldest":
      return "Bảo trì cũ nhất";
    default:
      return "Sắp xếp";
  }
};

const navigateToEquipmentDetail = (slug) => {
  // This would navigate to a detail page like /thiet-bi-tap/[slug]
  // For now, it just logs to console. You'd need to create this page.
  console.log(`Navigate to equipment detail: /thiet-bi-tap/${slug}`);
  // navigateTo(`/thiet-bi-tap/${slug}`); // Uncomment if you create the detail page
  alert(`Chức năng xem chi tiết thiết bị '${slug}' sẽ được phát triển sau!`);
};

// Lifecycle
onMounted(() => {
  // Simulate API call
  setTimeout(() => {
    equipment.value = allEquipment.value; // Assign all mock data
    isLoading.value = false;
  }, 1000);
});

// SEO
useHead({
  title: "Thiết Bị Tập Luyện | GymTech",
  meta: [
    {
      name: "description",
      content:
        "Khám phá hệ thống máy móc và dụng cụ tập luyện hiện đại nhất tại GymTech. Đảm bảo trải nghiệm tập luyện tốt nhất cho mọi hội viên.",
    },
    {
      name: "keywords",
      content:
        "thiết bị gym, máy tập gym, dụng cụ tập luyện, thiết bị hiện đại, phòng gym, GymTech",
    },
  ],
});
</script>

<style scoped>
/* Custom text shadow for hero heading */
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

.custom-text-shadow {
  text-shadow: 0 0 20px rgba(239, 68, 68, 0.8), 0 0 30px rgba(239, 68, 68, 0.6);
}

.card-hover:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 20px rgba(239, 68, 68, 0.3);
}

.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>

<template>
  <section
    id="news"
    class="py-20 bg-gradient-to-br from-gray-950 to-black text-white"
  >
    <div class="container mx-auto px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2
          class="text-5xl lg:text-6xl font-extrabold mb-4 text-red-500 custom-text-shadow"
        >
          TIN TỨC & BÀI VIẾT
        </h2>
        <p class="text-xl text-gray-300 max-w-2xl mx-auto">
          Cập nhật thông tin mới nhất về fitness, dinh dưỡng và sức khỏe từ
          GymTech
        </p>
      </div>

      <!-- Tabs -->
      <div
        class="tabs tabs-boxed bg-gray-800 rounded-lg p-1 shadow-md w-fit mx-auto mb-12"
      >
        <button
          style="color: white"
          v-for="cat in categories"
          :key="cat"
          @click="
            () => {
              activeCategory = cat;
              visibleCount = 3;
            }
          "
          :class="[
            'tab font-medium px-4 py-2 rounded-md transition-all duration-300',
            activeCategory === cat
              ? 'bg-red-600 text-white shadow-inner shadow-red-900/50'
              : 'text-gray-200 bg-gray-800 hover:text-white hover:bg-gray-700',
          ]"
        >
          {{ cat }}
        </button>
      </div>

      <!-- Loading State -->
      <div v-if="isLoading" class="flex justify-center items-center py-20">
        <div class="loading loading-spinner loading-lg text-red-500"></div>
        <p class="ml-4 text-lg text-gray-400">Đang tải bài viết...</p>
      </div>

      <!-- No Articles Found State -->
      <div v-else-if="displayedArticles.length === 0" class="text-center py-20">
        <div class="text-7xl mb-4 text-red-500">
          <i class="fas fa-box-open"></i>
        </div>
        <h3 class="text-3xl font-bold text-gray-200 mb-3">
          Không tìm thấy bài viết nào
        </h3>
        <p class="text-gray-400 text-lg">
          Vui lòng thử danh mục khác hoặc quay lại sau.
        </p>
      </div>

      <!-- Article Cards -->
      <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <article
          v-for="article in displayedArticles"
          :key="article.id"
          class="card bg-gray-900 rounded-xl shadow-lg border border-red-800/30 overflow-hidden transform transition-all duration-300 hover:scale-[1.02] hover:-translate-y-1 hover:shadow-xl hover:shadow-red-900/50 cursor-pointer group"
        >
          <figure class="relative overflow-hidden h-52">
            <img
              :src="
                article.image ||
                'https://placehold.co/600x400/333333/EFEFEF?text=No+Image'
              "
              :alt="article.title"
              class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
            />
          </figure>
          <div class="card-body p-6">
            <div
              class="badge text-white font-bold text-sm px-3 py-2 rounded-full shadow-md mb-3"
              :class="badgeClass(article.category_name)"
            >
              {{ (article.category_name || "").toUpperCase() }}
            </div>
            <NuxtLink
              :to="`/bai-viet/${article.slug}`"
              class="card-title text-white text-xl font-bold mb-2 line-clamp-2 group-hover:text-red-400 transition-colors duration-300 block"
            >
              {{ article.title }}
            </NuxtLink>

            <div
              class="text-gray-400 text-sm line-clamp-3 mb-4"
              v-html="article.excerpt"
            ></div>

            <div
              class="flex justify-between items-center mt-auto pt-4 border-t border-gray-700/50"
            >
              <span class="text-white-700 text-xs flex items-center">
                <i class="fas fa-calendar-alt mr-1 text-red-600"></i>
                {{ timeAgo(article.publishedDate) }}
              </span>

              <NuxtLink
                :to="`/bai-viet/${article.slug}`"
                class="text-red-400 hover:text-red-300 font-semibold text-sm transition-colors duration-200 hover:bg-red-900/20 px-2 py-1 rounded"
              >
                Đọc thêm <i class="fas fa-arrow-right ml-1"></i>
              </NuxtLink>
            </div>
          </div>
        </article>
      </div>

      <!-- Load More Button -->
      <div v-if="canLoadMore && !isLoading" class="text-center mt-12">
        <button
          @click="visibleCount += 3"
          class="btn btn-outline border-red-600 text-red-400 hover:bg-red-600 hover:text-white text-base font-semibold px-8 py-3 rounded-full shadow-md transition-all duration-300"
        >
          Xem thêm bài viết <i class="fas fa-chevron-down ml-2"></i>
        </button>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, computed } from "vue";

const activeCategory = ref("Tất cả");
const visibleCount = ref(3);

// Dùng useAsyncData để SSR + client fetch đồng bộ
const {
  data: response,
  pending,
  error,
} = await useAsyncData("home-articles", async () => {
  const res = await useApiFetch("/articles/home");
  const raw = res.data?.value; // ⚠️ lấy `.value` vì res.data là Ref
  return raw?.data || []; // ⚠️ giả sử API trả về { data: [...] }
});

// Các computed dựa vào dữ liệu từ useAsyncData
const articles = computed(() => response.value || []);
const isLoading = computed(() => pending.value);

// Category tabs
const categories = computed(() => {
  if (!articles.value || articles.value.length === 0) {
    return ["Tất cả"];
  }
  const list = new Set(articles.value.map((a) => a.category_name));
  return ["Tất cả", ...list];
});

// Filter theo danh mục
const filteredArticles = computed(() => {
  if (activeCategory.value === "Tất cả") return articles.value;
  return articles.value.filter((a) => a.category_name === activeCategory.value);
});

// Số lượng bài hiển thị
const displayedArticles = computed(() =>
  filteredArticles.value.slice(0, visibleCount.value)
);

// Có còn bài để load tiếp không
const canLoadMore = computed(
  () => visibleCount.value < filteredArticles.value.length
);

// Gán class cho badge
const badgeClass = (category) => {
  if (typeof category !== "string") return "badge-neutral";
  if (category.toLowerCase().includes("fitness")) return "badge-error";
  if (category.toLowerCase().includes("dinh dưỡng")) return "badge-success";
  if (category.toLowerCase().includes("sức khỏe")) return "badge-info";
  if (
    category.toLowerCase().includes("kiến thức") ||
    category.toLowerCase().includes("tim mạch")
  )
    return "badge-info";
  return "badge-neutral";
};

// Hiển thị thời gian tương đối
const timeAgo = (isoDate) => {
  if (!isoDate) return "Không rõ";
  const date = new Date(isoDate);
  const now = new Date();
  const diff = (now - date) / 1000;

  if (diff < 60) return "Vừa xong";
  if (diff < 3600) return `${Math.floor(diff / 60)} phút trước`;
  if (diff < 86400) return `${Math.floor(diff / 3600)} giờ trước`;
  if (diff < 604800) return `${Math.floor(diff / 86400)} ngày trước`;
  return date.toLocaleDateString("vi-VN");
};
</script>

<style scoped>
/* Custom text shadow for heading */
.custom-text-shadow {
  text-shadow: 0 0 20px rgba(239, 68, 68, 0.8), 0 0 30px rgba(239, 68, 68, 0.6);
}
</style>

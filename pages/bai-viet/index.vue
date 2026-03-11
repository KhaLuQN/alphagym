<template>
  <div class="min-h-screen bg-black text-white">
    <div
      class="relative py-24 md:py-32 bg-gradient-to-br from-gray-950 via-red-950 to-black overflow-hidden"
    >
      <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
          <h1
            class="text-5xl md:text-7xl font-extrabold mb-6 text-red-500 custom-hero-text-shadow leading-tight"
          >
            <i class="fas fa-newspaper mr-4 text-red-600"></i>Tin Tức & Bài Viết
          </h1>
          <p class="text-xl md:text-2xl text-gray-300 mb-10 max-w-xl mx-auto">
            Cập nhật những thông tin mới nhất về thể hình, dinh dưỡng và sức
            khỏe
          </p>
        </div>
      </div>
    </div>

    <div
      class="container mx-auto px-4 py-16 grid grid-cols-1 lg:grid-cols-4 gap-8"
    >
      <aside
        class="lg:col-span-1 bg-gray-900/50 rounded-xl p-6 border border-red-600/30 h-fit lg:sticky lg:top-28"
      >
        <h3 class="text-xl font-bold text-red-400 mb-4">Danh mục bài viết</h3>
        <div class="flex flex-col gap-2">
          <button
            v-for="category in categories"
            :key="category.slug"
            :class="[
              'btn btn-block justify-start text-base font-medium px-4 py-2 rounded-lg transition-all duration-300',
              selectedCategory === category.slug
                ? 'btn-error bg-red-600 text-white shadow-inner shadow-red-900/50'
                : 'btn-ghost text-gray-300 hover:bg-gray-800 hover:text-red-400',
            ]"
            @click="filterByCategory(category.slug)"
          >
            {{ category.name }}
          </button>
        </div>
      </aside>

      <main class="lg:col-span-3">
        <div class="relative max-w-full mx-auto mb-8">
          <input
            type="text"
            v-model="searchTerm"
            @input="filterArticles"
            placeholder="Tìm kiếm bài viết..."
            class="input input-bordered input-lg w-full bg-black/50 text-white border-red-600/50 focus:border-red-500 pr-16"
          />
          <button
            class="absolute right-2 top-1/2 transform -translate-y-1/2 btn btn-error btn-sm"
          >
            <i class="fas fa-search"></i>
          </button>
        </div>

        <div class="flex flex-wrap items-center justify-end gap-4 mb-8">
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
                  @click="sortArticles('newest')"
                  class="text-white hover:text-red-400"
                  >Mới nhất</a
                >
              </li>
              <li>
                <a
                  @click="sortArticles('oldest')"
                  class="text-white hover:text-red-400"
                  >Cũ nhất</a
                >
              </li>
              <li>
                <a
                  @click="sortArticles('popular')"
                  class="text-white hover:text-red-400"
                  >Phổ biến</a
                >
              </li>
              <li>
                <a
                  @click="sortArticles('title')"
                  class="text-white hover:text-red-400"
                  >Tên A-Z</a
                >
              </li>
            </ul>
          </div>

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

        <div>
          <div v-if="isLoading" class="flex justify-center items-center py-20">
            <div class="loading loading-spinner loading-lg text-red-500"></div>
          </div>

          <div
            v-else-if="currentArticles.length === 0"
            class="text-center py-20"
          >
            <div class="text-6xl mb-4">
              <i class="fas fa-search text-red-400"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-300 mb-2">
              Không tìm thấy bài viết
            </h3>
            <p class="text-gray-500">
              Thử thay đổi từ khóa tìm kiếm hoặc bộ lọc
            </p>
          </div>

          <div
            v-else-if="viewMode === 'grid'"
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
          >
            <div
              v-for="article in currentArticles"
              :key="article.slug"
              class="card bg-gray-800/50 border border-red-600/20 card-hover cursor-pointer group"
              @click="navigateToArticle(article.slug)"
            >
              <figure class="relative overflow-hidden">
                <img
                  :src="getImageUrl(article.featured_image_url)"
                  :alt="article.title"
                  class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-110"
                  @error="handleImageError"
                />
                <div class="absolute top-4 left-4">
                  <div class="badge badge-error text-white font-bold">
                    {{ getCategoryLabel(article) }}
                  </div>
                </div>
                <div
                  v-if="article.type === 'event'"
                  class="absolute top-4 right-4"
                >
                  <div class="badge badge-warning text-black font-bold">
                    <i class="fas fa-calendar mr-1"></i>Sự kiện
                  </div>
                </div>
              </figure>

              <div class="card-body">
                <h2
                  class="card-title text-white text-lg line-clamp-2 group-hover:text-red-400 transition-colors"
                >
                  {{ article.title }}
                </h2>
                <div
                  class="text-gray-400 line-clamp-3 mb-4"
                  v-html="article.excerpt"
                ></div>

                <div
                  class="flex items-center justify-between text-gray-500 text-sm mb-4"
                >
                  <div class="flex items-center space-x-4">
                    <div class="flex items-center">
                      <i class="fas fa-user mr-1"></i>
                      <span>{{ getAuthorName(article) }}</span>
                    </div>
                  </div>
                  <div class="flex items-center">
                    <i class="fas fa-calendar mr-1"></i>
                    <span>{{ formatDate(article.published_at) }}</span>
                  </div>
                </div>

                <div class="card-actions justify-end">
                  <button
                    class="btn btn-error btn-sm text-white group-hover:btn-outline group-hover:border-red-500 group-hover:text-red-400"
                  >
                    Xem thêm
                    <i class="fas fa-arrow-right ml-2"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <div v-else class="space-y-6">
            <div
              v-for="article in currentArticles"
              :key="article.slug"
              class="card lg:card-side bg-gray-800/50 border border-red-600/20 card-hover cursor-pointer group"
              @click="navigateToArticle(article.slug)"
            >
              <figure class="lg:w-80">
                <img
                  :src="getImageUrl(article.featured_image_url)"
                  :alt="article.title"
                  class="w-full h-48 lg:h-full object-cover transition-transform duration-300 group-hover:scale-105"
                  @error="handleImageError"
                />
              </figure>
              <div class="card-body">
                <div class="flex flex-wrap items-center gap-2 mb-2">
                  <div class="badge badge-error text-white font-bold">
                    {{ getCategoryLabel(article) }}
                  </div>
                  <div
                    v-if="article.type === 'event'"
                    class="badge badge-warning text-black font-bold"
                  >
                    <i class="fas fa-calendar mr-1"></i>Sự kiện
                  </div>
                </div>

                <h2
                  class="card-title text-white text-xl mb-3 group-hover:text-red-400 transition-colors"
                >
                  {{ article.title }}
                </h2>

                <div
                  class="text-gray-400 line-clamp-3 mb-4"
                  v-html="article.excerpt"
                ></div>

                <div
                  class="flex items-center justify-between text-gray-500 text-sm mb-4"
                >
                  <div class="flex items-center space-x-6">
                    <div class="flex items-center">
                      <i class="fas fa-user mr-2"></i>
                      <span>{{ getAuthorName(article) }}</span>
                    </div>

                    <div class="flex items-center">
                      <i class="fas fa-calendar mr-2"></i>
                      <span>{{ formatDate(article.published_at) }}</span>
                    </div>
                  </div>
                </div>

                <div class="card-actions justify-end">
                  <button
                    class="btn btn-error text-white group-hover:btn-outline group-hover:border-red-500 group-hover:text-red-400"
                  >
                    Đọc tiếp
                    <i class="fas fa-arrow-right ml-2"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="flex justify-center mt-12" v-if="totalPages > 1">
          <div class="btn-group">
            <button
              :disabled="currentPage === 1"
              @click="changePage(currentPage - 1)"
              class="btn btn-outline border-red-600/50 text-red-400 hover:bg-red-600 hover:text-white"
            >
              <i class="fas fa-chevron-left"></i>
            </button>

            <button
              v-for="page in visiblePages"
              :key="page"
              :class="[
                'btn',
                page === currentPage
                  ? 'btn-error'
                  : 'btn-outline border-red-600/50 text-red-400 hover:bg-red-600 hover:text-white',
              ]"
              @click="changePage(page)"
            >
              {{ page }}
            </button>

            <button
              :disabled="currentPage === totalPages"
              @click="changePage(currentPage + 1)"
              class="btn btn-outline border-red-600/50 text-red-400 hover:bg-red-600 hover:text-white"
            >
              <i class="fas fa-chevron-right"></i>
            </button>
          </div>
        </div>
      </main>
    </div>
    <Newsletter />
  </div>
</template>

<script setup>
import { useCustomSeoMeta } from "~/composables/useCustomSeoMeta";
import { ref, computed } from "vue";
import { navigateTo, useAsyncData, useRuntimeConfig, createError } from "#app";
import Newsletter from "~/components/articles/Newsletter.vue";

// --- State Management ---
const searchTerm = ref("");
const selectedCategory = ref("all");
const viewMode = ref("grid");
const sortBy = ref("newest");
const currentPage = ref(1);
const articlesPerPage = 9;
const errorMessage = ref("");

// --- Data Fetching ---
// Fetch articles and categories in parallel using useAsyncData
const {
  data,
  pending: isLoading,
  error,
} = await useAsyncData("articles-page-data", async () => {
  const config = useRuntimeConfig();
  try {
    const [articlesRes, categoriesRes] = await Promise.all([
      $fetch(`${config.public.apiBase}articles`),
      $fetch(`${config.public.apiBase}article-categories`),
    ]);
    return {
      articles: articlesRes?.data || [],
      categories: categoriesRes?.data || [],
    };
  } catch (e) {
    console.error("Lỗi khi tải dữ liệu API:", e);
    // This will be caught by the `error` ref from useAsyncData
    throw createError({
      statusCode: 500,
      statusMessage: "Không thể tải dữ liệu từ máy chủ. Vui lòng thử lại sau.",
      fatal: true,
    });
  }
});

// Handle error state
if (error.value) {
  errorMessage.value = "Không thể tải bài viết. Vui lòng thử lại sau.";
  console.error("Lỗi khi tải dữ liệu trang bài viết:", error.value);
}

// --- Reactive Data Refs ---
const articles = ref(data.value?.articles || []);
const categories = ref([
  { category_id: "all", name: "Tất cả", slug: "all" },
  ...(data.value?.categories || []),
]);

// --- Computed Properties ---
const filteredArticles = computed(() => {
  // Make sure we have articles to filter
  if (!articles.value) return [];

  let filtered = articles.value.filter(
    (article) => article.status === "published"
  );

  if (searchTerm.value) {
    const lowerCaseSearch = searchTerm.value.toLowerCase();
    filtered = filtered.filter(
      (article) =>
        article.title.toLowerCase().includes(lowerCaseSearch) ||
        (article.excerpt &&
          article.excerpt.toLowerCase().includes(lowerCaseSearch))
    );
  }

  if (selectedCategory.value !== "all") {
    filtered = filtered.filter(
      (article) =>
        article.category?.slug === selectedCategory.value ||
        article.type === selectedCategory.value
    );
  }

  // Create a new array for sorting to avoid mutating the original computed ref source
  const sorted = [...filtered];

  // Sort articles
  switch (sortBy.value) {
    case "newest":
      sorted.sort(
        (a, b) => new Date(b.published_at) - new Date(a.published_at)
      );
      break;
    case "oldest":
      sorted.sort(
        (a, b) => new Date(a.published_at) - new Date(b.published_at)
      );
      break;
    case "popular":
      sorted.sort((a, b) => b.view_count - a.view_count);
      break;
    case "title":
      sorted.sort((a, b) => a.title.localeCompare(b.title));
      break;
  }

  return sorted;
});

const totalPages = computed(() =>
  Math.ceil(filteredArticles.value.length / articlesPerPage)
);

const currentArticles = computed(() => {
  const start = (currentPage.value - 1) * articlesPerPage;
  const end = start + articlesPerPage;
  return filteredArticles.value.slice(start, end);
});

const visiblePages = computed(() => {
  const pages = [];
  const total = totalPages.value;
  const current = currentPage.value;

  if (total <= 7) {
    for (let i = 1; i <= total; i++) pages.push(i);
  } else {
    if (current <= 4) {
      pages.push(1, 2, 3, 4, 5, "...", total);
    } else if (current >= total - 3) {
      pages.push(1, "...", total - 4, total - 3, total - 2, total - 1, total);
    } else {
      pages.push(1, "...", current - 1, current, current + 1, "...", total);
    }
  }
  return pages;
});

// --- Methods ---
const resetToFirstPage = () => {
  currentPage.value = 1;
};

const filterArticles = () => {
  resetToFirstPage();
};

const filterByCategory = (categorySlug) => {
  selectedCategory.value = categorySlug;
  resetToFirstPage();
};

const sortArticles = (sortType) => {
  sortBy.value = sortType;
  resetToFirstPage();
};

const changePage = (page) => {
  if (page !== "..." && page >= 1 && page <= totalPages.value) {
    currentPage.value = page;
    if (process.client) {
      window.scrollTo({ top: 0, behavior: "smooth" });
    }
  }
};

const navigateToArticle = (slug) => {
  navigateTo(`/bai-viet/${slug}`);
};

// --- Helper Functions ---
const formatDate = (dateString) => {
  if (!dateString) return "Chưa cập nhật";
  const date = new Date(dateString);
  const now = new Date();
  const diffTime = Math.abs(now - date);
  const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

  if (diffDays === 1) return "Hôm qua";
  if (diffDays <= 7) return `${diffDays} ngày trước`;
  if (diffDays <= 30) return `${Math.floor(diffDays / 7)} tuần trước`;

  return date.toLocaleDateString("vi-VN", {
    year: "numeric",
    month: "long",
    day: "numeric",
  });
};

const formatViewCount = (count) => {
  if (!count) return "0";
  if (count < 1000) return count.toString();
  if (count < 1000000) return `${(count / 1000).toFixed(1)}K`;
  return `${(count / 1000000).toFixed(1)}M`;
};

const getSortLabel = () => {
  const labels = {
    newest: "Mới nhất",
    oldest: "Cũ nhất",
    popular: "Phổ biến",
    title: "Tên A-Z",
  };
  return labels[sortBy.value] || "Sắp xếp";
};

const getCategoryLabel = (article) => {
  if (!article) return "Khác";
  if (article.category?.name) return article.category.name;
  if (article.article_category_id && categories.value.length > 1) {
    const category = categories.value.find(
      (cat) => cat.category_id === article.article_category_id
    );
    if (category) return category.name;
  }
  const typeMap = {
    news: "Tin tức",
    event: "Sự kiện",
    blog: "Blog",
    promotion: "Khuyến mãi",
  };
  return typeMap[article.type] || "Khác";
};

const getAuthorName = (article) => {
  return article?.user?.full_name || "GymTech Team";
};

const getImageUrl = (imageUrl) => {
  if (!imageUrl) {
    return "/images/placeholder.svg";
  }
  if (!imageUrl.startsWith("http")) {
    const config = useRuntimeConfig();
    return `${config.public.apiBase}${imageUrl}`;
  }
  return imageUrl;
};

const handleImageError = (event) => {
  event.target.src = "/images/placeholder.svg";
};

// --- SEO ---
useCustomSeoMeta({
  title: "Blog - Chia Sẻ Kinh Nghiệm Tập Luyện",
  description:
    "Tổng hợp bài viết, mẹo tập luyện, dinh dưỡng, và kiến thức thể hình từ chuyên gia GymTech.",
  image: "https://gymtech.vn/images/blog.jpg",
  url: "https://gymtech.vn/bai-viet",
  keywords: "blog gym, kiến thức thể hình, mẹo tập luyện, dinh dưỡng gym",
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
</style>

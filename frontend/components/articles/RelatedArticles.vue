<template>
  <div
    class="bg-gray-950 py-16 border-t border-red-700/50 shadow-inner shadow-red-900/20"
  >
    <div class="container mx-auto px-6">
      <div class="max-w-6xl mx-auto">
        <h2
          class="text-3xl md:text-4xl font-extrabold text-center mb-12 text-red-400 custom-text-shadow"
        >
          <i class="fas fa-newspaper mr-3"></i>Bài viết liên quan
        </h2>

        <div v-if="articles.length === 0" class="text-center py-10">
          <p class="text-gray-400">Không có bài viết liên quan.</p>
        </div>
        <div
          v-else
          class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
        >
          <div
            v-for="relatedArticle in articles"
            :key="relatedArticle.slug"
            class="card bg-gray-900 rounded-xl shadow-lg border border-red-800/30 overflow-hidden transform transition-all duration-300 hover:scale-[1.02] hover:shadow-xl hover:shadow-red-900/50 cursor-pointer group"
            @click="navigateToArticle(relatedArticle.slug)"
          >
            <figure class="relative overflow-hidden h-48">
              <img
                :src="getImageUrl(relatedArticle.image)"
                :alt="relatedArticle.title"
                class="w-full h-48 object-cover group-hover:opacity-80 transition-opacity"
                @error="handleImageError"
              />
            </figure>
            <div class="card-body p-6">
              <h3
                class="card-title text-white text-xl font-bold mb-2 line-clamp-2 group-hover:text-red-400 transition-colors duration-300"
              >
                {{ relatedArticle.title }}
              </h3>
              <p class="text-gray-400 text-sm line-clamp-3 mb-4">
                {{ relatedArticle.excerpt || "Không có mô tả" }}
              </p>
              <div
                class="flex items-center justify-between mt-auto pt-4 border-t border-gray-700/50"
              >
                <div class="flex items-center text-gray-500 text-xs">
                  <i class="fas fa-calendar mr-1 text-red-400"></i>
                  <span>{{ formatDate(relatedArticle.published_at) }}</span>
                </div>
                <div class="flex items-center text-gray-500 text-xs">
                  <i class="fas fa-eye mr-1 text-red-400"></i>
                  <span>{{ relatedArticle.view_count || 0 }}</span>
                </div>
              </div>
              <div class="card-actions justify-end mt-4">
                <nuxt-link
                  :to="`/bai-viet/${relatedArticle.slug}`"
                  class="btn btn-error btn-sm text-white font-semibold px-4 py-2 rounded-full shadow-md transition-all duration-300 group-hover:bg-transparent group-hover:border-red-500 group-hover:text-red-400 group-hover:shadow-lg"
                >
                  Xem thêm
                  <i class="fas fa-arrow-right ml-2"></i>
                </nuxt-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from "vue";
import { navigateTo } from "#app"; // Import navigateTo for internal navigation

const props = defineProps({
  articles: {
    type: Array,
    default: () => [],
  },
  formatDate: {
    type: Function,
    required: true,
  },
  getImageUrl: {
    type: Function,
    required: true,
  },
  handleImageError: {
    type: Function,
    required: true,
  },
});

const navigateToArticle = (slug) => {
  navigateTo(`/bai-viet/${slug}`);
};
</script>

<style scoped>
.custom-text-shadow {
  text-shadow: 0 0 20px rgba(239, 68, 68, 0.8), 0 0 30px rgba(239, 68, 68, 0.6);
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

<template>
  <div class="min-h-screen bg-black text-white">
    <!-- Hero Section -->
    <section class="hero-gradient py-16 md:py-24 relative overflow-hidden">
      <div class="absolute inset-0 bg-black/20"></div>
      <div class="relative z-10 container mx-auto px-4 text-center">
        <div class="mb-6">
          <i class="fas fa-dumbbell text-red-500 text-6xl mb-4"></i>
        </div>
        <h1
          class="text-5xl md:text-7xl font-extrabold mb-6 text-transparent bg-clip-text bg-gradient-to-r from-white to-red-500"
        >
          Phản hồi từ khách hàng
        </h1>
        <p class="text-xl md:text-2xl text-gray-300 mb-8 max-w-2xl mx-auto">
          Khách hàng của chúng tôi chia sẻ những trải nghiệm tuyệt vời tại Alpha
          Gym
        </p>
      </div>
    </section>

    <!-- Testimonials Section -->
    <section
      class="py-16 md:py-24 bg-gradient-to-b from-black via-gray-900 to-black"
    >
      <div class="container mx-auto px-4">
        <!-- Loading State -->
        <div v-if="loading" class="flex justify-center items-center py-20">
          <div class="loading loading-spinner loading-lg text-red-500"></div>
        </div>

        <!-- Error State -->
        <div v-else-if="error" class="text-center py-20">
          <div
            class="alert alert-error max-w-md mx-auto bg-red-900/20 border border-red-500/30"
          >
            <i class="fas fa-exclamation-triangle text-red-500"></i>
            <span class="text-red-300"
              >Không thể tải đánh giá từ khách hàng</span
            >
          </div>
        </div>

        <!-- Testimonials Grid -->
        <div
          v-else
          class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
        >
          <div
            v-for="testimonial in testimonials"
            :key="testimonial.id"
            class="card bg-gradient-to-br from-gray-900 to-black border border-red-500/20 hover:border-red-500/40 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-red-500/20"
          >
            <div class="card-body p-6">
              <!-- Customer Image -->
              <div class="flex justify-center mb-4">
                <div class="avatar">
                  <div
                    class="w-16 h-16 rounded-full ring ring-red-500 ring-offset-base-100 ring-offset-2"
                  >
                    <img
                      :src="testimonial.image_url"
                      :alt="testimonial.customer_name"
                      class="object-cover"
                      @error="handleImageError"
                    />
                  </div>
                </div>
              </div>

              <!-- Customer Name -->
              <div class="text-center mb-4">
                <h3
                  class="card-title text-xl font-bold text-white justify-center"
                >
                  <i class="fas fa-user-circle text-red-500 mr-2"></i>
                  {{ testimonial.customer_name }}
                </h3>
              </div>

              <!-- Rating Stars -->
              <div class="flex justify-center mb-4 relative z-[50]">
                <div class="rating rating-sm relative z-[50]">
                  <template v-for="star in 5" :key="star">
                    <i
                      :class="[
                        'fas fa-star text-lg mx-1 relative z-[50]',
                        star <= testimonial.rating
                          ? 'text-yellow-500'
                          : 'text-gray-600',
                      ]"
                    ></i>
                  </template>
                </div>
              </div>

              <!-- Testimonial Content -->
              <div class="mb-4">
                <div class="relative">
                  <i
                    class="fas fa-quote-left text-red-500/50 text-3xl absolute -top-2 -left-2"
                  ></i>
                  <p class="text-gray-300 leading-relaxed pl-6 pr-2 italic">
                    {{ testimonial.content }}
                  </p>
                  <i
                    class="fas fa-quote-right text-red-500/50 text-3xl absolute -bottom-2 -right-2"
                  ></i>
                </div>
              </div>

              <!-- Submit Date -->
              <div class="card-actions justify-end">
                <div class="flex items-center text-sm text-gray-500">
                  <i class="fas fa-calendar-alt mr-2 text-red-500"></i>
                  {{ testimonial.submitted_at }}
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center mt-16" v-if="testimonials.length > 0">
          <div
            class="bg-gradient-to-r from-red-600 to-red-700 rounded-lg p-8 max-w-2xl mx-auto"
          >
            <i class="fas fa-heart text-4xl text-white mb-4"></i>
            <h3 class="text-2xl font-bold text-white mb-4">
              Bạn cũng muốn chia sẻ trải nghiệm?
            </h3>
            <p class="text-red-100 mb-6">
              Hãy để lại đánh giá của bạn và giúp chúng tôi phục vụ tốt hơn
            </p>
            <nuxt-link
              to="/danh-gia"
              class="btn btn-outline btn-white hover:bg-white hover:text-red-600 border-2"
            >
              <i class="fas fa-pen mr-2"></i>
              Viết đánh giá
            </nuxt-link>
          </div>
        </div>

        <!-- Statistics -->
        <div
          class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8"
          v-if="testimonials.length > 0"
        >
          <div
            class="stat bg-gradient-to-br from-gray-900 to-black rounded-lg border border-red-500/20 p-6"
          >
            <div class="stat-figure text-red-500">
              <i class="fas fa-users text-3xl"></i>
            </div>
            <div class="stat-title text-gray-400">Tổng đánh giá</div>
            <div class="stat-value text-white">{{ testimonials.length }}</div>
          </div>

          <div
            class="stat bg-gradient-to-br from-gray-900 to-black rounded-lg border border-red-500/20 p-6"
          >
            <div class="stat-figure text-red-500">
              <i class="fas fa-star text-3xl"></i>
            </div>
            <div class="stat-title text-gray-400">Điểm trung bình</div>
            <div class="stat-value text-white">
              {{ averageRating.toFixed(1) }}
            </div>
          </div>

          <div
            class="stat bg-gradient-to-br from-gray-900 to-black rounded-lg border border-red-500/20 p-6"
          >
            <div class="stat-figure text-red-500">
              <i class="fas fa-thumbs-up text-3xl"></i>
            </div>
            <div class="stat-title text-gray-400">Khách hài lòng</div>
            <div class="stat-value text-white">{{ satisfiedCustomers }}%</div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, computed } from "vue";

const {
  data: testimonials,
  pending: loading,
  error,
} = await useAsyncData(
  "testimonials",
  async () => {
    const response = await useApiFetch("/testimonials");
    return response.data.value?.data || [];
  },
  {
    default: () => [],
  }
);

// Computed properties
const averageRating = computed(() => {
  if (!testimonials.value || testimonials.value.length === 0) return 0;
  const sum = testimonials.value.reduce(
    (acc, testimonial) => acc + testimonial.rating,
    0
  );
  return sum / testimonials.value.length;
});

const satisfiedCustomers = computed(() => {
  if (!testimonials.value || testimonials.value.length === 0) return 0;
  const satisfied = testimonials.value.filter(
    (testimonial) => testimonial.rating >= 4
  ).length;
  return Math.round((satisfied / testimonials.value.length) * 100);
});

const handleImageError = (event) => {
  event.target.src =
    "https://static.vecteezy.com/system/resources/previews/024/983/914/non_2x/simple-user-default-icon-free-png.png"; // Fallback image
};
</script>

<style scoped>
.card {
  background-color: #1a1a1a;
  border-radius: 0.75rem;
  overflow: hidden;
  transition: all 0.3s ease;
}

.card-body {
  padding: 1.5rem;
}

.card-actions {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.stat {
  background-color: #111;
  border-radius: 0.75rem;
}

.stat-title {
  font-size: 0.875rem;
  color: #a0aec0;
  margin-top: 0.5rem;
}

.stat-value {
  font-size: 2rem;
  font-weight: bold;
}

.stat-figure {
  margin-bottom: 0.5rem;
}

.btn {
  padding: 0.5rem 1.25rem;
  border-radius: 9999px;
  font-weight: 600;
  border: 1px solid white;
  transition: all 0.3s;
}

.btn-white {
  background-color: transparent;
  color: white;
}

.btn-white:hover {
  background-color: white;
  color: #dc2626;
}
</style>

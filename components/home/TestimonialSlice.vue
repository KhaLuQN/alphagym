<script setup>
import { Swiper, SwiperSlide } from "swiper/vue";
import { Navigation, Autoplay } from "swiper/modules";
import "swiper/css";
import "swiper/css/navigation";

defineProps({
  testimonials: {
    type: Array,
    default: () => [],
  },
});

function handleImageError(event) {
  event.target.src = "/images/placeholder.svg";
}
</script>

<template>
  <section class="py-12 bg-black text-white">
    <div class="container mx-auto px-4">
      <!-- Tiêu đề -->
      <div class="text-center mb-10">
        <h2 class="text-3xl font-bold text-red-500">Khách hàng nói gì?</h2>
        <p class="text-gray-400">
          Những đánh giá chân thật từ hội viên của chúng tôi
        </p>
      </div>

      <!-- Swiper Slider -->
      <Swiper
        :modules="[Navigation, Autoplay]"
        :slides-per-view="1"
        :space-between="20"
        :navigation="true"
        :autoplay="{ delay: 4000, disableOnInteraction: false }"
        :breakpoints="{
          768: { slidesPerView: 2 },
          1024: { slidesPerView: 3 },
        }"
        class="pb-10"
      >
        <SwiperSlide
          v-for="testimonial in testimonials"
          :key="testimonial.id"
          class="h-auto"
        >
          <div
            class="card bg-gradient-to-br from-gray-900 to-black border border-red-500/20 hover:border-red-500/40 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-red-500/20 h-full"
          >
            <div class="card-body p-6 flex flex-col justify-between">
              <!-- Customer Image -->
              <div>
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
                  <div class="rating rating-sm">
                    <input
                      v-for="star in 5"
                      :key="star"
                      type="radio"
                      :value="star"
                      :checked="testimonial.rating === star"
                      class="mask mask-star bg-yellow-400"
                      disabled
                    />
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
              </div>

              <!-- Submit Date -->
              <div class="card-actions justify-end mt-4">
                <div class="flex items-center text-sm text-gray-500">
                  <i class="fas fa-calendar-alt mr-2 text-red-500"></i>
                  {{ testimonial.submitted_at }}
                </div>
              </div>
            </div>
          </div>
        </SwiperSlide>
      </Swiper>

      <!-- Nút xem tất cả -->
      <div class="text-center mt-6">
        <NuxtLink
          to="/danh-gia-tu-khach-hang"
          class="inline-block px-6 py-3 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-lg transition-all duration-300"
        >
          Xem tất cả
        </NuxtLink>
      </div>
    </div>
  </section>
</template>

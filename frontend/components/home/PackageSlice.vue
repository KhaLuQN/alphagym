<template>
  <section id="packages" class="py-20 bg-gray-950 text-white">
    <div class="container mx-auto px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2
          class="text-5xl lg:text-6xl font-extrabold mb-4 text-red-500 custom-text-shadow"
        >
          GÓI TẬP GYMTECH
        </h2>
        <p class="text-xl text-gray-300 max-w-2xl mx-auto">
          Lựa chọn gói tập phù hợp với nhu cầu và mục tiêu của bạn
        </p>
      </div>

      <!-- Wrapper cho Swiper Slider -->
      <div class="relative">
        <swiper
          :modules="[Navigation, Autoplay]"
          :slides-per-view="1"
          :space-between="30"
          :loop="true"
          :centered-slides="true"
          :autoplay="{
            delay: 4000,
            disableOnInteraction: false,
          }"
          :navigation="{
            nextEl: '.plan-swiper-button-next',
            prevEl: '.plan-swiper-button-prev',
          }"
          :breakpoints="{
            '640': {
              slidesPerView: 1,
              spaceBetween: 20,
              centeredSlides: true,
            },
            '768': {
              slidesPerView: 2,
              spaceBetween: 30,
              centeredSlides: false,
            },
            '1024': {
              slidesPerView: 3,
              spaceBetween: 30,
              centeredSlides: false,
            },
          }"
          class="pb-16"
        >
          <swiper-slide v-for="plan in plans" :key="plan.id" class="h-auto">
            <div
              class="bg-gray-900 pt-6 rounded-2xl shadow-2xl border border-gray-800 overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-red-900/30 h-full flex flex-col"
              :class="{
                'ring-2 ring-red-500 bg-gradient-to-br from-gray-900 via-gray-800 to-red-900/20':
                  isPopularPlan(plan),
              }"
            >
              <!-- Header với badge -->
              <div
                class="relative bg-gradient-to-r from-red-600 to-red-700 p-6 text-center"
              >
                <div
                  v-if="getBadgeText(plan)"
                  class="absolute -top-3 left-1/2 transform -translate-x-1/2 bg-yellow-400 text-black font-bold px-4 py-1 rounded-full text-sm shadow-lg"
                >
                  {{ getBadgeText(plan) }}
                </div>

                <h3 class="text-2xl font-extrabold text-white mb-2 mt-2">
                  {{ plan.name }}
                </h3>

                <!-- Duration -->
                <div class="flex items-center justify-center mb-3">
                  <i class="fas fa-calendar-alt text-white/80 mr-2"></i>
                  <span class="text-3xl font-black text-white">
                    {{ plan.duration_days }} ngày
                  </span>
                </div>
              </div>

              <!-- Body -->
              <div class="p-6 flex-1 flex flex-col">
                <!-- Pricing -->
                <div class="text-center mb-6">
                  <div
                    v-if="hasDiscount(plan)"
                    class="text-gray-400 line-through text-lg mb-1"
                  >
                    {{ formatCurrency(parseFloat(plan.price)) }}
                  </div>
                  <div class="text-4xl font-black text-red-500 mb-2">
                    {{ formatCurrency(getActualPrice(plan)) }}
                  </div>
                  <div
                    v-if="hasDiscount(plan)"
                    class="text-green-400 font-semibold text-sm"
                  >
                    Tiết kiệm {{ parseFloat(plan.discount_percent) }}%
                  </div>
                </div>

                <!-- Description -->
                <p
                  class="text-gray-300 text-sm leading-relaxed mb-6 text-center"
                >
                  {{ plan.description }}
                </p>

                <!-- Features -->
                <div class="flex-1 mb-6">
                  <h4 class="text-white font-bold mb-4 text-center">
                    <i class="fas fa-star text-yellow-500 mr-2"></i>
                    Tính năng bao gồm
                  </h4>
                  <ul class="space-y-3">
                    <li
                      v-for="(feature, index) in plan.features"
                      :key="index"
                      class="flex items-start text-gray-300"
                    >
                      <i
                        class="fas fa-check-circle text-green-500 mr-3 mt-0.5 flex-shrink-0"
                      ></i>
                      <div class="flex-1">
                        <span class="text-white font-medium">{{
                          feature.name
                        }}</span>
                        <span
                          v-if="feature.value"
                          class="block text-red-400 text-sm mt-1"
                        >
                          {{ feature.value }}
                        </span>
                      </div>
                    </li>
                  </ul>
                </div>

                <!-- CTA Button -->
                <div class="mt-auto">
                  <NuxtLink
                    to="/dang-ky-goi-tap"
                    class="btn btn-block bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 border-none text-white font-bold text-lg py-4 rounded-xl shadow-lg transform transition-all duration-200 hover:scale-105 hover:shadow-red-500/50"
                  >
                    <i class="fas fa-rocket mr-2"></i>
                    ĐĂNG KÝ NGAY
                  </NuxtLink>
                </div>
              </div>

              <!-- Popular Plan Glow Effect -->
              <div
                v-if="isPopularPlan(plan)"
                class="absolute inset-0 rounded-2xl bg-gradient-to-r from-red-500/10 to-red-600/10 pointer-events-none"
              ></div>
            </div>
          </swiper-slide>
        </swiper>

        <!-- Custom Navigation Buttons -->
        <div class="plan-swiper-button-prev swiper-button-custom">
          <i class="fas fa-chevron-left"></i>
        </div>
        <div class="plan-swiper-button-next swiper-button-custom">
          <i class="fas fa-chevron-right"></i>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { Swiper, SwiperSlide } from "swiper/vue";
import { Navigation, Autoplay } from "swiper/modules";

import "swiper/css";
import "swiper/css/navigation";

const props = defineProps({
  plans: {
    type: Array,
    required: true,
    default: () => [],
  },
});

// Helper functions
const formatCurrency = (value) => {
  if (value === 0) return "Miễn phí";
  return new Intl.NumberFormat("vi-VN", {
    style: "currency",
    currency: "VND",
  }).format(value);
};

const getActualPrice = (plan) => {
  const price = parseFloat(plan.price);
  const discount = parseFloat(plan.discount_percent);
  return price * (1 - discount / 100);
};

const hasDiscount = (plan) => {
  const discount = parseFloat(plan.discount_percent);
  const price = parseFloat(plan.price);
  return discount > 0 && price > 0;
};

const getBadgeText = (plan) => {
  const price = parseFloat(plan.price);
  const discount = parseFloat(plan.discount_percent);

  if (price === 0 || discount === 100) return "MIỄN PHÍ";
  if (discount > 0) return `GIẢM ${discount}%`;
  if (isPopularPlan(plan)) return "PHỔ BIẾN";
  return null;
};

const isPopularPlan = (plan) => {
  // Có thể customize logic này dựa vào tên hoặc ID
  return (
    plan.name.toLowerCase().includes("plus") ||
    plan.duration_days === 30 ||
    plan.id === 2
  ); // Ví dụ: gói 1 tháng là phổ biến
};
</script>

<style scoped>
.custom-text-shadow {
  text-shadow: 0 0 20px rgba(239, 68, 68, 0.8), 0 0 30px rgba(239, 68, 68, 0.6),
    0 4px 8px rgba(0, 0, 0, 0.3);
}

.swiper-button-custom {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  width: 50px;
  height: 50px;
  background: linear-gradient(
    135deg,
    rgba(220, 38, 38, 0.9),
    rgba(185, 28, 28, 0.9)
  );
  backdrop-filter: blur(10px);
  border-radius: 50%;
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s ease;
  z-index: 10;
  border: 2px solid rgba(255, 255, 255, 0.2);
  box-shadow: 0 4px 15px rgba(220, 38, 38, 0.4);
}

.swiper-button-custom:hover {
  background: linear-gradient(
    135deg,
    rgba(185, 28, 28, 1),
    rgba(153, 27, 27, 1)
  );
  transform: translateY(-50%) scale(1.1);
  box-shadow: 0 6px 20px rgba(220, 38, 38, 0.6);
}

.plan-swiper-button-prev {
  left: -25px;
}

.plan-swiper-button-next {
  right: -25px;
}

/* Responsive adjustments */
@media (max-width: 1024px) {
  .plan-swiper-button-prev {
    left: -15px;
  }

  .plan-swiper-button-next {
    right: -15px;
  }
}

@media (max-width: 768px) {
  .swiper-button-custom {
    display: none;
  }
}

/* Card hover effects */
.swiper-slide:hover .btn {
  transform: translateY(-2px);
  box-shadow: 0 10px 25px rgba(220, 38, 38, 0.4);
}

/* Smooth card height */
.swiper-slide {
  height: auto;
  display: flex;
}

.swiper-slide > div {
  width: 100%;
  min-height: 600px;
}
</style>

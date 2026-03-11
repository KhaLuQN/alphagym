<template>
  <section
    id="packages"
    class="relative py-24 md:py-32 bg-gradient-to-br from-gray-950 via-red-950 to-black overflow-hidden text-white"
  >
    <div class="relative z-10 container mx-auto px-4">
      <div class="text-center mb-16">
        <h1
          class="text-5xl md:text-7xl font-extrabold mb-6 text-red-500 custom-hero-text-shadow leading-tight"
        >
          <i class="fas fa-dumbbell mr-4 text-red-600"></i>
          <span class="text-white">Gói Tập</span>
          <span class="text-red-500"> GymTech</span>
        </h1>
        <p class="text-xl md:text-2xl text-gray-300 mb-10 max-w-xl mx-auto">
          Lựa chọn gói tập phù hợp với nhu cầu và mục tiêu của bạn
        </p>
      </div>

      <div v-if="isLoading" class="flex justify-center items-center py-20">
        <div
          class="animate-spin rounded-full h-12 w-12 border-b-2 border-red-500"
        ></div>
        <p class="ml-4 text-lg text-gray-400">Đang tải gói tập...</p>
      </div>

      <div v-else-if="apiError" class="text-center py-20">
        <div class="text-7xl mb-4 text-red-500">⚠️</div>
        <h3 class="text-3xl font-bold text-gray-200 mb-3">Có lỗi xảy ra</h3>
        <p class="text-gray-400 text-lg">
          Không thể tải gói tập. Vui lòng thử lại sau.
        </p>
        <button
          @click="refreshData"
          class="mt-4 bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg transition-colors"
        >
          Thử lại
        </button>
      </div>

      <div v-else-if="!plans || plans.length === 0" class="text-center py-20">
        <div class="text-7xl mb-4 text-red-500">📦</div>
        <h3 class="text-3xl font-bold text-gray-200 mb-3">
          Không tìm thấy gói tập nào
        </h3>
        <p class="text-gray-400 text-lg">
          Hiện tại chưa có gói tập nào được cung cấp.
        </p>
      </div>

      <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div
          v-for="plan in sortedPlans"
          :key="`plan-${plan.plan_id}`"
          class="relative bg-gray-900 rounded-2xl shadow-xl border border-red-800/30 overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-red-900/50"
          :class="{
            'bg-gradient-to-br from-red-700 to-red-900 border-2 border-red-400':
              plan.is_popular,
          }"
        >
          <div
            v-if="plan.is_popular"
            class="absolute -top-0 left-1/2 transform -translate-x-1/2 z-10"
          >
            <div
              class="bg-yellow-400 text-black font-bold text-sm px-4 py-2 rounded-full shadow-lg"
            >
              ⭐ PHỔ BIẾN
            </div>
          </div>

          <div
            v-else-if="plan.discount_percent > 0"
            class="absolute -top-0 left-1/2 transform -translate-x-1/2 z-10"
          >
            <div
              class="bg-red-500 text-white font-bold text-sm px-4 py-2 rounded-full shadow-lg"
            >
              🏷️ GIẢM {{ plan.discount_percent }}%
            </div>
          </div>

          <div
            class="p-8 text-center"
            :class="{ 'pt-12': plan.is_popular || plan.discount_percent > 0 }"
          >
            <h3 class="text-3xl font-extrabold text-white mb-4">
              {{ plan.plan_name }}
            </h3>

            <div class="text-center mb-6">
              <div
                class="text-5xl font-black mb-2"
                :class="plan.is_popular ? 'text-white' : 'text-red-500'"
              >
                {{ formatDuration(plan.duration_days) }}
              </div>
              <div class="text-sm text-gray-400">
                {{ getDurationText(plan.duration_days) }}
              </div>
            </div>

            <div class="mb-8">
              <div
                v-if="plan.discount_percent > 0"
                class="text-lg text-gray-400 line-through mb-1"
              >
                {{ formatCurrency(plan.price) }}
              </div>
              <div class="text-4xl font-black text-white mb-2">
                {{ formatCurrency(getActualPrice(plan)) }}
              </div>
              <div
                v-if="plan.discount_percent > 0"
                class="text-sm font-semibold"
                :class="plan.is_popular ? 'text-yellow-300' : 'text-red-400'"
              >
                Tiết kiệm {{ formatCurrency(getSavingAmount(plan)) }}
              </div>
            </div>

            <ul
              class="text-left space-y-3 mb-8"
              :class="plan.is_popular ? 'text-red-100' : 'text-gray-300'"
            >
              <li
                v-for="(feature, index) in plan.features"
                :key="index"
                class="flex items-center"
              >
                <span
                  class="text-lg mr-3"
                  :class="plan.is_popular ? 'text-white' : 'text-red-500'"
                >
                  <i class="fas fa-check text-green-500 mr-3 text-lg"></i>
                </span>
                <span
                  >{{ feature.name }}
                  <strong v-if="feature.value" class="text-white"
                    >({{ feature.value }})</strong
                  ></span
                >
              </li>
            </ul>

            <div
              v-if="plan.description"
              class="text-sm text-gray-400 mb-6 text-center"
            >
              {{ plan.description }}
            </div>

            <NuxtLink
              to="/dang-ky-goi-tap"
              class="w-full font-bold text-lg py-3 rounded-full shadow-lg transform transition-all duration-200 hover:scale-105"
              :class="
                plan.is_popular
                  ? 'bg-yellow-400 text-black hover:bg-yellow-500'
                  : 'bg-red-500 text-white hover:bg-red-600'
              "
            >
              🏋️ ĐĂNG KÝ NGAY
            </NuxtLink>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { NuxtLink } from "#components";
import { ref, computed } from "vue";
import { useFetch, useRuntimeConfig, useHead } from "#app";

// Call API directly for SSR
const config = useRuntimeConfig();
const { 
  data: plansData, 
  pending: isLoading, 
  error: apiError, 
  refresh: refreshData 
} = await useFetch(
  () => "/membership-plans",
  {
    baseURL: config.public.apiBase,
    key: 'membership-plans'
  }
);

const plans = computed(() => plansData.value?.data || []);

// Computed properties
const sortedPlans = computed(() => {
  if (!plans.value) return [];
  const processedPlans = plans.value.map((plan, index) => ({
    ...plan,
    is_popular: index === 1, // Mark the second plan as popular
  }));

  return [...processedPlans].sort((a, b) => {
    if (a.is_popular && !b.is_popular) return -1;
    if (!a.is_popular && b.is_popular) return 1;
    return a.duration_days - b.duration_days;
  });
});

// Methods
const formatCurrency = (value) => {
  if (!value || isNaN(value)) return "0 ₫";
  return new Intl.NumberFormat("vi-VN", {
    style: "currency",
    currency: "VND",
    minimumFractionDigits: 0,
    maximumFractionDigits: 0,
  }).format(value);
};

const formatDuration = (days) => {
  if (!days || isNaN(days)) return "0 NGÀY";
  if (days >= 365) return `${Math.floor(days / 365)} NĂM`;
  if (days >= 30) return `${Math.floor(days / 30)} THÁNG`;
  return `${days} NGÀY`;
};

const getDurationText = (days) => {
  if (!days || isNaN(days)) return "0 ngày";
  if (days >= 365) {
    const years = Math.floor(days / 365);
    return `${years} năm`;
  }
  if (days >= 30) {
    const months = Math.floor(days / 30);
    return `${months} tháng`;
  }
  return `${days} ngày`;
};

const getActualPrice = (plan) => {
  if (!plan || !plan.price) return 0;
  if (plan.discount_percent > 0) {
    return plan.price * (1 - plan.discount_percent / 100);
  }
  return plan.price;
};

const getSavingAmount = (plan) => {
  if (!plan || !plan.price || !plan.discount_percent) return 0;
  return (plan.price * plan.discount_percent) / 100;
};
// SEO
useHead({
  title: "Gói tập gym - Bảng giá ưu đãi | GymTech",
  meta: [
    {
      name: "description",
      content:
        "Khám phá các gói tập gym với mức giá ưu đãi tại GymTech. Đa dạng gói tập phù hợp với mọi nhu cầu và ngân sách.",
    },
    {
      name: "keywords",
      content:
        "gói tập gym, bảng giá gym, membership gym, phòng tập gym, ưu đãi gym",
    },
  ],
});
</script>

<style scoped>
.custom-hero-text-shadow {
  text-shadow: 0 0 25px rgba(239, 68, 68, 0.9), 0 0 40px rgba(239, 68, 68, 0.7);
}
</style>

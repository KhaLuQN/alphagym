<script setup>
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";

const props = defineProps({
  trainers: {
    type: Array,
    required: true,
  },
});
</script>

<template>
  <section id="trainers" class="py-20 bg-gray-900">
    <div class="container mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-5xl font-black p-4 text-gradient">HUẤN LUYỆN VIÊN</h2>
        <p class="text-xl text-gray-300">
          Đội ngũ HLV chuyên nghiệp với nhiều năm kinh nghiệm
        </p>
      </div>

      <Swiper
        :slides-per-view="1"
        :breakpoints="{
          640: { slidesPerView: 1 },
          768: { slidesPerView: 2 },
          1024: { slidesPerView: 3 },
        }"
        space-between="20"
        grabCursor
        loop
        class="trainer-swiper"
      >
        <SwiperSlide v-for="trainer in trainers" :key="trainer.id">
          <div class="trainer-card">
            <div class="card-inner">
              <!-- FRONT SIDE -->
              <div
                class="card-front bg-black border border-red-600/30 p-6 flex flex-col items-center justify-center"
              >
                <div class="avatar mb-4">
                  <div
                    class="w-32 h-32 rounded-full ring ring-red-500 ring-offset-base-100 ring-offset-2"
                  >
                    <img
                      :src="trainer.photo_url"
                      :alt="trainer.full_name"
                      class="w-full h-full object-cover rounded-full"
                    />
                  </div>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">
                  {{ trainer.full_name }}
                </h3>
                <div
                  :class="[
                    'specialty-badge',
                    trainer.badge_class || 'specialty-default',
                  ]"
                >
                  {{ trainer.specialty }}
                </div>
                <div class="badge-expert specialty-badge text-xs mt-2">
                  {{ trainer.experience_years }} năm kinh nghiệm
                </div>
                <div class="flex justify-center space-x-1 mt-4">
                  <i
                    class="fas fa-star text-yellow-400"
                    v-for="n in 5"
                    :key="n"
                  />
                </div>
                <p class="text-gray-400 text-sm mt-2">Hover để xem chi tiết</p>
              </div>

              <!-- BACK SIDE -->
              <div
                class="card-back bg-gradient-to-br from-red-900/20 to-black border border-red-600/30 p-6 flex flex-col justify-between"
              >
                <div>
                  <h3 class="text-xl font-bold text-white mb-3">
                    {{ trainer.full_name }}
                  </h3>
                  <p class="text-gray-300 text-sm mb-4 leading-relaxed">
                    {{ trainer.bio }}
                  </p>

                  <div class="mb-4">
                    <h4 class="text-red-400 font-semibold mb-2">Chứng chỉ:</h4>
                    <p class="text-gray-300 text-xs">
                      {{ trainer.certifications }}
                    </p>
                  </div>

                  <div class="flex justify-center space-x-4 mb-4">
                    <a
                      :href="trainer.facebook_url"
                      target="_blank"
                      class="social-icon text-blue-500 hover:text-blue-400"
                    >
                      <i class="fab fa-facebook text-xl" />
                    </a>
                    <a
                      :href="trainer.instagram_url"
                      target="_blank"
                      class="social-icon text-pink-500 hover:text-pink-400"
                    >
                      <i class="fab fa-instagram text-xl" />
                    </a>
                  </div>
                </div>

                <div class="mt-auto">
                  <nuxt-link
                    :to="`/huan-luyen-vien/${trainer.id}`"
                    class="btn w-full bg-red-600 hover:bg-red-700 text-white border-none"
                    >Xem chi tiết</nuxt-link
                  >
                </div>
              </div>
            </div>
          </div>
        </SwiperSlide>
      </Swiper>
      <div class="text-center mt-8">
        <NuxtLink
          to="/huan-luyen-vien"
          class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2 rounded-lg transition-all duration-300"
        >
          Xem tất cả huấn luyện viên
        </NuxtLink>
      </div>
    </div>
  </section>
</template>

<style scoped>
.text-gradient {
  background: linear-gradient(135deg, #ef4444, #dc2626);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.card-hover {
  transition: all 0.3s ease;
  transform: translateY(0);
}

.card-hover:hover {
  transform: translateY(-10px);
  box-shadow: 0 20px 40px rgba(239, 68, 68, 0.3);
}

.trainer-card {
  perspective: 1000px;
  height: 400px;
}

.card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.6s;
  transform-style: preserve-3d;
}

.trainer-card:hover .card-inner {
  transform: rotateY(180deg);
}

.card-front,
.card-back {
  position: absolute;
  width: 100%;
  height: 100%;
  backface-visibility: hidden;
  border-radius: 1rem;
  overflow: hidden;
}

.card-back {
  transform: rotateY(180deg);
}

.specialty-badge {
  display: inline-block;
  padding: 0.25rem 0.75rem;
  border-radius: 9999px;
  font-size: 0.875rem;
  font-weight: 600;
  margin-bottom: 0.5rem;
}

.specialty-tang-co {
  background: linear-gradient(135deg, #ef4444, #dc2626);
  color: white;
}

.specialty-giam-can {
  background: linear-gradient(135deg, #10b981, #059669);
  color: white;
}

.specialty-yoga {
  background: linear-gradient(135deg, #8b5cf6, #7c3aed);
  color: white;
}

.specialty-cardio {
  background: linear-gradient(135deg, #f59e0b, #d97706);
  color: white;
}

.specialty-default {
  background: linear-gradient(135deg, #6b7280, #4b5563);
  color: white;
}

.badge-expert {
  background: linear-gradient(135deg, #fbbf24, #f59e0b);
  color: #1f2937;
}

.badge-master {
  background: linear-gradient(135deg, #a855f7, #9333ea);
  color: white;
}

.badge-premium {
  background: linear-gradient(135deg, #ef4444, #dc2626);
  color: white;
}

.social-icon {
  transition: all 0.3s ease;
}

.social-icon:hover {
  transform: scale(1.1);
}
</style>

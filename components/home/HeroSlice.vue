<template>
  <section id="home" class="hero min-h-screen relative overflow-hidden">
    <div
      class="absolute inset-0 from-gray-900 via-black to-gray-800 opacity-80"
    ></div>

    <!-- Video nền (tùy chọn, làm tăng tính chuyên nghiệp) -->
    <video
      autoplay
      loop
      muted
      playsinline
      class="absolute w-full h-full object-cover z-0"
    >
      <source
        src="https://media.istockphoto.com/id/2150058039/vi/video/m%C3%A1y-ch%E1%BA%A1y-b%E1%BB%99-ph%E1%BB%A5-n%E1%BB%AF-v%C3%A0-ch%E1%BA%A1y-v%E1%BB%9Bi-n%C4%83m-cao-v%C3%A0-tim-m%E1%BA%A1ch-trong-m%E1%BB%99t-ph%C3%B2ng-t%E1%BA%ADp-th%E1%BB%83-d%E1%BB%A5c-s%E1%BB%A9c-kh%E1%BB%8Fe-ch%C4%83m.mp4?s=mp4-640x640-is&k=20&c=vH93aBljykL2BymQhyWwxWbzufzhoGU-vrIvw7Iif30="
        type="video/mp4"
      />
      Your browser does not support the video tag.
    </video>

    <!-- Component Swiper -->
    <swiper
      :modules="[Autoplay, EffectFade, Navigation]"
      :slides-per-view="1"
      :space-between="0"
      :loop="true"
      :effect="'fade'"
      :fade-effect="{ crossFade: true }"
      :autoplay="{
        delay: 5000,
        disableOnInteraction: false,
      }"
      :navigation="{
        nextEl: '.swiper-button-next-custom',
        prevEl: '.swiper-button-prev-custom',
      }"
      class="w-full h-full"
    >
      <!-- Lặp qua dữ liệu slides để tạo ra các SwiperSlide -->
      <swiper-slide v-for="(slide, index) in slides" :key="index">
        <div
          class="hero-content text-center text-neutral-content flex items-center justify-center h-full"
        >
          <div class="max-w-4xl z-20">
            <h1
              class="text-6xl md:text-8xl font-display mb-6 text-white drop-shadow-2xl animate-fade-in-down"
            >
              {{ slide.title }}
            </h1>
            <p
              class="text-2xl md:text-3xl font-display mb-4 text-red-400 animate-fade-in-up"
              style="animation-delay: 0.3s"
            >
              {{ slide.subtitle }}
            </p>
            <p
              class="text-lg md:text-xl mb-8 text-gray-200 max-w-2xl mx-auto animate-fade-in-up"
              style="animation-delay: 0.6s"
            >
              {{ slide.description }}
            </p>
            <div
              class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in-up"
              style="animation-delay: 0.9s"
            >
              <NuxtLink
                to="/goi-tap"
                class="btn btn-error btn-lg text-white font-bold px-8 hover:scale-105 transition-transform"
              >
                <i class="fas fa-fire mr-2"></i>XEM GÓI TẬP
              </NuxtLink>
              <NuxtLink
                to="/huan-luyen-vien"
                class="btn btn-outline btn-lg text-white border-white hover:bg-white hover:text-black font-bold px-8"
              >
                <i class="fas fa-users mr-2"></i>HUẤN LUYỆN VIÊN
              </NuxtLink>
            </div>
          </div>
        </div>
      </swiper-slide>
    </swiper>

    <!-- Nút điều hướng tùy chỉnh -->
    <div class="swiper-button-prev-custom">
      <i class="fa-solid fa-arrow-left"></i>
    </div>
    <div class="swiper-button-next-custom">
      <i class="fa-solid fa-arrow-right"></i>
    </div>
  </section>
</template>

<script setup>
// Import các thành phần cần thiết từ Swiper
import { Swiper, SwiperSlide } from "swiper/vue";
import { Navigation, Autoplay, EffectFade } from "swiper/modules";
import { ref } from "vue";

// Import CSS của Swiper
import "swiper/css";
import "swiper/css/effect-fade";
import "swiper/css/navigation";

// Dữ liệu giả cho các slide
const slides = ref([
  {
    title: "GymTech",
    subtitle: "NÂNG TẦM SỨC MẠNH - VƯỢT QUA GIỚI HẠN",
    description:
      "Phòng tập gym hàng đầu với thiết bị hiện đại, huấn luyện viên chuyên nghiệp và chương trình tập luyện cá nhân hóa.",
  },
  {
    title: "Bắt Đầu Hành Trình",
    subtitle: "KHÔNG BAO GIỜ LÀ QUÁ TRỄ ĐỂ THAY ĐỔI",
    description:
      "Tham gia cộng đồng của chúng tôi và nhận được sự hỗ trợ bạn cần để đạt được mục tiêu sức khỏe và thể hình.",
  },
  {
    title: "Trải Nghiệm Đẳng Cấp",
    subtitle: "CƠ SỞ VẬT CHẤT TIÊU CHUẨN QUỐC TẾ",
    description:
      "Tận hưởng không gian tập luyện rộng rãi, sạch sẽ và đầy đủ các loại máy móc tiên tiến nhất.",
  },
]);
</script>

<style scoped>
.hero {
  background-color: #111;
}

.swiper-button-prev-custom,
.swiper-button-next-custom {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  z-index: 20;
  cursor: pointer;

  display: flex;
  align-items: center;
  justify-content: center;

  width: 50px;
  height: 50px;
  background-color: rgba(255, 255, 255, 0.1);
  color: white;
  border-radius: 50%;
  border: 1px solid rgba(255, 255, 255, 0.2);
  backdrop-filter: blur(5px);
  transition: all 0.3s ease;
}

.swiper-button-prev-custom:hover,
.swiper-button-next-custom:hover {
  background-color: rgba(220, 38, 38, 0.8); /* Màu đỏ khi hover */
  border-color: transparent;
}

.swiper-button-prev-custom {
  left: 2rem;
}

.swiper-button-next-custom {
  right: 2rem;
}

.swiper-button-prev-custom i,
.swiper-button-next-custom i {
  font-size: 2rem;
}

/* Hiệu ứng animation cho text */
@keyframes fade-in-down {
  from {
    opacity: 0;
    transform: translateY(-20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
@keyframes fade-in-up {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
.animate-fade-in-down {
  animation: fade-in-down 0.8s ease-out forwards;
}
.animate-fade-in-up {
  animation: fade-in-up 0.8s ease-out forwards;
}
</style>

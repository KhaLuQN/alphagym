<template>
  <div>
    <ContactFrom />
    <div class="py-16 bg-gradient-to-br from-gray-950 to-red-950">
      <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-12">
          <h2
            class="text-5xl lg:text-6xl font-extrabold mb-4 text-red-400 custom-text-shadow"
          >
            Địa chỉ liên hệ
          </h2>
          <p class="text-xl text-gray-300 max-w-2xl mx-auto">
            Sẵn sàng bắt đầu hành trình của bạn?
          </p>
        </div>

        <!-- Contact Info Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
          <!-- Contact Information -->
          <div class="space-y-6">
            <div class="card bg-gray-900/50 shadow-xl border border-red-900/30">
              <div class="card-body">
                <h3 class="card-title text-red-400 text-2xl mb-6">
                  <i class="fas fa-info-circle mr-2"></i>
                  Thông tin liên hệ
                </h3>

                <!-- Address -->
                <div
                  class="flex items-start space-x-4 mb-4 p-3 rounded-lg bg-gray-800/30 hover:bg-gray-800/50 transition-all duration-300"
                >
                  <div class="flex-shrink-0">
                    <div
                      class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center"
                    >
                      <i class="fas fa-map-marker-alt text-white text-lg"></i>
                    </div>
                  </div>
                  <div>
                    <h4 class="text-red-300 font-semibold mb-1">Địa chỉ</h4>
                    <p class="text-gray-300">
                      Nguyễn Huy Tưởng, Hòa Minh, Liên Chiểu, Đà Nẵng
                    </p>
                  </div>
                </div>

                <!-- Phone -->
                <div
                  class="flex items-start space-x-4 mb-4 p-3 rounded-lg bg-gray-800/30 hover:bg-gray-800/50 transition-all duration-300"
                >
                  <div class="flex-shrink-0">
                    <div
                      class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center"
                    >
                      <i class="fas fa-phone text-white text-lg"></i>
                    </div>
                  </div>
                  <div>
                    <h4 class="text-red-300 font-semibold mb-1">Điện thoại</h4>
                    <p class="text-gray-300">0386550651</p>
                  </div>
                </div>

                <!-- Email -->
                <div
                  class="flex items-start space-x-4 mb-4 p-3 rounded-lg bg-gray-800/30 hover:bg-gray-800/50 transition-all duration-300"
                >
                  <div class="flex-shrink-0">
                    <div
                      class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center"
                    >
                      <i class="fas fa-envelope text-white text-lg"></i>
                    </div>
                  </div>
                  <div>
                    <h4 class="text-red-300 font-semibold mb-1">Email</h4>
                    <p class="text-gray-300">contact@gymtech.vn</p>
                  </div>
                </div>

                <!-- Working Hours -->
                <div
                  class="flex items-start space-x-4 p-3 rounded-lg bg-gray-800/30 hover:bg-gray-800/50 transition-all duration-300"
                >
                  <div class="flex-shrink-0">
                    <div
                      class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center"
                    >
                      <i class="fas fa-clock text-white text-lg"></i>
                    </div>
                  </div>
                  <div>
                    <h4 class="text-red-300 font-semibold mb-1">
                      Giờ hoạt động
                    </h4>
                    <p class="text-gray-300">
                      Thứ 2 - Thứ 6: 5:00 - 22:00<br />
                      Thứ 7 - CN: 6:00 - 20:00
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-2 gap-4">
              <a
                href="tel:0386550651"
                class="btn btn-outline btn-error hover:btn-error text-white"
              >
                <i class="fas fa-phone mr-2"></i>
                Gọi ngay
              </a>
              <a
                href="mailto:khappp4@gmail.com"
                class="btn btn-outline btn-error hover:btn-error text-white"
              >
                <i class="fas fa-envelope mr-2"></i>
                Gửi email
              </a>
            </div>
          </div>

          <!-- Map -->
          <div class="order-first lg:order-last">
            <div
              class="card bg-gray-900/50 shadow-xl border border-red-900/30 h-full"
            >
              <div class="card-body p-4">
                <h3 class="card-title text-red-400 text-2xl mb-4">
                  <i class="fas fa-map text-red-400 mr-2"></i>
                  Bản đồ
                </h3>
                <div
                  id="ban-do"
                  class="w-full h-96 lg:h-full min-h-[300px] rounded-lg overflow-hidden"
                >
                  <iframe
                    class="w-full h-full"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1442.3313681471902!2d108.16774589360053!3d16.052154954374437!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31421915a6c92fab%3A0xc894d3afcc1567a8!2zTmd1eeG7hW4gSHV5IFTGsOG7n25nLCBIw7JhIE1pbmgsIExpw6puIENoaeG7g3UsIMSQw6AgTuG6tW5nIDU1MDAwMCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1755130927694!5m2!1svi!2s"
                    style="border: 0"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                  ></iframe>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Additional Info -->
        <div class="text-center">
          <div class="alert bg-red-950/30 border-red-800 max-w-2xl mx-auto">
            <i class="fas fa-info-circle text-red-400 text-lg"></i>
            <span class="text-gray-300">
              Ghé thăm chúng tôi để trải nghiệm không gian tập luyện hiện đại và
              được tư vấn gói tập phù hợp nhất!
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
useCustomSeoMeta({
  title: "Liên Hệ GymTech",
  description:
    "Liên hệ chúng tôi để được tư vấn các gói tập, huấn luyện viên cá nhân, hoặc bất kỳ hỗ trợ nào.",
  image: "https://gymtech.vn/images/contact.jpg",
  url: "https://gymtech.vn/lien-he",
  keywords:
    "liên hệ phòng gym, tư vấn gói tập, GymTech support, thông tin liên hệ",
});
</script>

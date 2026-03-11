<template>
  <section
    id="contact"
    class="py-24 md:py-32 bg-gradient-to-br from-gray-950 to-red-950 text-white"
  >
    <div class="container mx-auto px-10 lg:px-8">
      <div class="text-center mb-12">
        <h2
          class="text-5xl lg:text-6xl font-extrabold mb-4 text-red-400 custom-text-shadow"
        >
          LIÊN HỆ
        </h2>
        <p class="text-xl text-gray-300 max-w-2xl mx-auto">
          Sẵn sàng bắt đầu hành trình của bạn?
        </p>
      </div>
      <div
        class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-20 items-center"
      >
        <!-- Contact Information Section -->
        <div class="space-y-8">
          <div class="flex items-start space-x-4">
            <div
              class="w-14 h-14 bg-red-600 rounded-full flex items-center justify-center flex-shrink-0 shadow-lg"
            >
              <i class="fas fa-map-marker-alt text-white text-2xl"></i>
            </div>
            <div>
              <h3 class="font-bold text-white text-xl mb-1">Địa chỉ</h3>
              <p class="text-red-100 text-lg">
                Nguyễn Huy Tưởng, Hòa Minh, Liên Chiểu, Đà Nẵng
              </p>
            </div>
          </div>
          <div class="flex items-start space-x-4">
            <div
              class="w-14 h-14 bg-red-600 rounded-full flex items-center justify-center flex-shrink-0 shadow-lg"
            >
              <i class="fas fa-phone text-white text-2xl"></i>
            </div>
            <div>
              <h3 class="font-bold text-white text-xl mb-1">Điện thoại</h3>
              <p class="text-red-100 text-lg">0386550651</p>
            </div>
          </div>
          <div class="flex items-start space-x-4">
            <div
              class="w-14 h-14 bg-red-600 rounded-full flex items-center justify-center flex-shrink-0 shadow-lg"
            >
              <i class="fas fa-envelope text-white text-2xl"></i>
            </div>
            <div>
              <h3 class="font-bold text-white text-xl mb-1">Email</h3>
              <p class="text-red-100 text-lg">info@gymtech.vn</p>
            </div>
          </div>
        </div>

        <!-- Contact Form Section -->
        <!-- Contact Form Section -->
        <div
          class="card bg-gray-900 rounded-2xl shadow-2xl border border-red-800/30 p-8"
        >
          <div class="card-body p-0">
            <form id="contactForm" ref="contactForm" class="space-y-6">
              <div class="form-control">
                <input
                  type="text"
                  name="full_name"
                  placeholder="Họ tên"
                  required
                  class="input input-bordered input-lg w-full bg-gray-800 text-white placeholder-gray-400 border-red-700 focus:border-red-500 focus:ring-2 focus:ring-red-500/50 transition-all duration-300"
                />
              </div>
              <div class="form-control">
                <input
                  type="email"
                  name="email"
                  placeholder="Email"
                  required
                  class="input input-bordered input-lg w-full bg-gray-800 text-white placeholder-gray-400 border-red-700 focus:border-red-500 focus:ring-2 focus:ring-red-500/50 transition-all duration-300"
                />
              </div>
              <div class="form-control">
                <input
                  type="tel"
                  name="phone"
                  placeholder="Số điện thoại"
                  required
                  class="input input-bordered input-lg w-full bg-gray-800 text-white placeholder-gray-400 border-red-700 focus:border-red-500 focus:ring-2 focus:ring-red-500/50 transition-all duration-300"
                />
              </div>
              <div class="form-control">
                <label
                  for="contact-type"
                  class="block text-sm font-medium text-white mb-2"
                >
                  Mục đích liên hệ
                </label>
                <select
                  id="contact-type"
                  name="type"
                  required
                  class="select select-bordered select-lg w-full bg-gray-800 text-white border-red-700 focus:border-red-500 focus:ring-2 focus:ring-red-500/50 transition-all duration-300"
                >
                  <option value="" disabled selected>
                    Chọn mục đích liên hệ
                  </option>
                  <option value="contact">Liên hệ chung</option>
                  <option value="support">Hỗ trợ</option>
                  <option value="complain">Khiếu nại</option>
                  <option value="advice">Góp ý</option>
                </select>
              </div>
              <div class="form-control">
                <textarea
                  name="message"
                  placeholder="Tin nhắn"
                  required
                  class="textarea textarea-bordered textarea-lg w-full bg-gray-800 text-white placeholder-gray-400 border-red-700 focus:border-red-500 focus:ring-2 focus:ring-red-500/50 h-32 transition-all duration-300"
                ></textarea>
              </div>
              <button
                type="submit"
                class="btn btn-error btn-block font-bold text-white text-lg py-3 rounded-full shadow-lg hover:bg-red-700 transform transition-transform duration-200 hover:scale-105"
              >
                <i class="fas fa-paper-plane mr-3"></i>GỬI TIN NHẮN
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
/* Custom text shadow for heading */
.custom-text-shadow {
  text-shadow: 0 0 20px rgba(239, 68, 68, 0.8), 0 0 30px rgba(239, 68, 68, 0.6);
}
</style>
<script setup>
import showNotification from "@/utils/showNotification";

import { ref, onMounted } from "vue";

const contactForm = ref(null);

onMounted(() => {
  const form = contactForm.value;
  const submitButton = form.querySelector('button[type="submit"]');
  const originalButtonText = submitButton.innerHTML;

  form.addEventListener("submit", async function (e) {
    e.preventDefault();

    submitButton.disabled = true;
    submitButton.innerHTML =
      '<i class="fas fa-spinner fa-spin mr-3"></i>ĐANG GỬI...';

    try {
      const formData = new FormData(form);

      const payload = {
        full_name: formData.get("full_name"),
        email: formData.get("email"),
        phone: formData.get("phone"),
        type: formData.get("type"),
        message: formData.get("message"),
        created_at: new Date().toISOString(),
      };

      const { data, error } = await useApiFetch("/contacts", {
        method: "POST",
        body: payload,
      });

      if (error.value) {
        showNotification(
          error.value.data?.message || "Lỗi server. Vui lòng thử lại.",
          "error"
        );
      } else {
        showNotification(
          data.value?.message || "Cảm ơn bạn đã liên hệ!",
          "success"
        );
        form.reset();
      }
    } catch (err) {
      console.error(err);
      showNotification("Có lỗi xảy ra. Vui lòng thử lại.", "error");
    } finally {
      submitButton.disabled = false;
      submitButton.innerHTML = originalButtonText;
    }
  });
});

// Notification system
</script>

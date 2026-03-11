<template>
  <!-- Hero Section -->
  <div
    class="relative py-16 md:py-24 bg-gradient-to-br from-gray-950 via-red-950 to-black overflow-hidden"
  >
    <div class="container mx-auto px-4 relative z-10">
      <div class="max-w-4xl mx-auto text-center">
        <h1
          class="text-4xl md:text-6xl font-extrabold mb-4 text-red-500 leading-tight"
        >
          <i class="fas fa-star mr-3 text-red-400"></i>Đánh giá
        </h1>
        <p
          class="text-lg md:text-xl text-gray-300 mb-8 max-w-2xl mx-auto leading-relaxed"
        >
          Ý kiến của bạn rất quan trọng với chúng tôi. Hãy chia sẻ trải nghiệm
          để giúp chúng tôi phục vụ bạn tốt hơn.
        </p>
      </div>
    </div>
  </div>

  <!-- Form Section -->
  <div class="min-h-screen bg-gradient-to-b from-gray-900 to-black py-8 px-4">
    <div class="max-w-md mx-auto">
      <!-- Form Card -->
      <div
        class="bg-gray-800 rounded-2xl shadow-2xl border border-gray-700 overflow-hidden"
      >
        <!-- Header -->
        <div class="bg-gradient-to-r from-red-600 to-red-700 p-6 text-center">
          <i class="fas fa-edit text-3xl text-white mb-2"></i>
          <h2 class="text-xl font-bold text-white">Gửi đánh giá của bạn</h2>
        </div>

        <!-- Form Body -->
        <form @submit.prevent="submit" class="p-6 space-y-6">
          <!-- Name Field -->
          <div class="form-control">
            <label class="label">
              <span
                class="label-text text-gray-300 font-medium flex items-center"
              >
                <i class="fas fa-user mr-2 text-red-400"></i>
                Họ và tên
              </span>
            </label>
            <input
              v-model="form.customer_name"
              type="text"
              placeholder="Nhập họ tên của bạn"
              class="input input-bordered bg-gray-700 border-gray-600 text-white placeholder-gray-400 focus:border-red-500 focus:ring-1 focus:ring-red-500 w-full"
              required
            />
          </div>

          <!-- Phone Field -->
          <div class="form-control">
            <label class="label">
              <span
                class="label-text text-gray-300 font-medium flex items-center"
              >
                <i class="fas fa-phone mr-2 text-red-400"></i>
                Số điện thoại
              </span>
            </label>
            <input
              v-model="form.phone"
              type="tel"
              placeholder="Nhập số điện thoại"
              class="input input-bordered bg-gray-700 border-gray-600 text-white placeholder-gray-400 focus:border-red-500 focus:ring-1 focus:ring-red-500 w-full"
              required
            />
          </div>

          <!-- Rating Field -->
          <div class="form-control">
            <label class="label">
              <span
                class="label-text text-gray-300 font-medium flex items-center"
              >
                <i class="fas fa-star mr-2 text-red-400"></i>
                Đánh giá của bạn
              </span>
            </label>
            <div class="flex justify-center space-x-2 py-2">
              <button
                v-for="star in 5"
                :key="star"
                type="button"
                @click="form.rating = star"
                class="text-3xl transition-all duration-200 hover:scale-110"
                :class="
                  star <= form.rating
                    ? 'text-yellow-400'
                    : 'text-gray-600 hover:text-yellow-300'
                "
              >
                <i class="fas fa-star"></i>
              </button>
            </div>
            <div class="text-center text-sm text-gray-400 mt-1">
              {{ form.rating ? `${form.rating} sao` : "Chọn số sao đánh giá" }}
            </div>
          </div>

          <!-- Content Field -->
          <div class="form-control">
            <label class="label">
              <span
                class="label-text text-gray-300 font-medium flex items-center"
              >
                <i class="fas fa-comment mr-2 text-red-400"></i>
                Nội dung đánh giá
              </span>
            </label>
            <textarea
              v-model="form.content"
              placeholder="Chia sẻ trải nghiệm của bạn về sản phẩm/dịch vụ..."
              class="textarea textarea-bordered bg-gray-700 border-gray-600 text-white placeholder-gray-400 focus:border-red-500 focus:ring-1 focus:ring-red-500 w-full h-24 resize-none"
              required
            ></textarea>
          </div>

          <!-- Image Upload Field (Optional) -->
          <div class="form-control">
            <label class="label">
              <span
                class="label-text text-gray-300 font-medium flex items-center"
              >
                <i class="fas fa-image mr-2 text-red-400"></i>
                Ảnh minh họa
                <span class="text-xs text-gray-500 ml-2">(không bắt buộc)</span>
              </span>
            </label>

            <!-- Custom File Upload -->
            <div class="relative">
              <input
                ref="fileInput"
                type="file"
                accept="image/*"
                @change="handleFileUpload"
                class="hidden"
              />

              <!-- Upload Button -->
              <button
                type="button"
                @click="$refs.fileInput.click()"
                class="w-full flex items-center justify-center px-4 py-3 border-2 border-dashed border-gray-600 hover:border-red-500 bg-gray-700 hover:bg-gray-600 rounded-lg transition-all duration-300"
              >
                <i class="fas fa-upload mr-2 text-red-400"></i>
                <span class="text-gray-300">
                  {{ selectedFileName || "Chọn ảnh từ thiết bị" }}
                </span>
              </button>

              <!-- Preview Image -->
              <div v-if="imagePreview" class="mt-3">
                <div class="relative inline-block">
                  <img
                    :src="imagePreview"
                    alt="Preview"
                    class="w-20 h-20 object-cover rounded-lg border border-gray-600"
                  />
                  <button
                    type="button"
                    @click="removeImage"
                    class="absolute -top-2 -right-2 w-6 h-6 bg-red-600 hover:bg-red-700 text-white rounded-full flex items-center justify-center text-xs transition-colors"
                  >
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Submit Button -->
          <div class="form-control mt-8">
            <button
              type="submit"
              :disabled="isSubmitting"
              class="btn bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 border-none text-white font-semibold py-3 text-lg transition-all duration-300 hover:shadow-lg disabled:opacity-50"
              :class="{ loading: isSubmitting }"
            >
              <i v-if="!isSubmitting" class="fas fa-paper-plane mr-2"></i>
              {{ isSubmitting ? "Đang gửi..." : "Gửi đánh giá" }}
            </button>
          </div>

          <!-- Messages -->
          <div
            v-if="message"
            class="alert alert-success bg-green-800 border-green-600 text-green-100"
          >
            <i class="fas fa-check-circle"></i>
            <span>{{ message }}</span>
          </div>

          <div
            v-if="error"
            class="alert alert-error bg-red-800 border-red-600 text-red-100"
          >
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ error }}</span>
          </div>
        </form>
      </div>

      <!-- Bottom Text -->
      <div class="text-center mt-6 text-gray-400 text-sm">
        <i class="fas fa-shield-alt mr-1"></i>
        Thông tin của bạn được bảo mật tuyệt đối
      </div>
    </div>
  </div>
</template>

<script setup>
import showNotification from "@/utils/showNotification";

const form = reactive({
  phone: "",
  customer_name: "",
  content: "",
  rating: null,
  image_file: null,
});

const message = ref("");
const error = ref("");
const isSubmitting = ref(false);
const selectedFileName = ref("");
const imagePreview = ref("");

const handleFileUpload = (event) => {
  const file = event.target.files[0];
  if (file) {
    // Validate file type
    if (!file.type.startsWith("image/")) {
      showNotification("Vui lòng chọn file ảnh hợp lệ", "error");
      return;
    }

    // Validate file size (max 5MB)
    if (file.size > 5 * 1024 * 1024) {
      showNotification("Kích thước ảnh không được vượt quá 5MB", "error");
      return;
    }

    form.image_file = file;
    selectedFileName.value = file.name;

    // Create preview
    const reader = new FileReader();
    reader.onload = (e) => {
      imagePreview.value = e.target.result;
    };
    reader.readAsDataURL(file);
  }
};

const removeImage = () => {
  form.image_file = null;
  selectedFileName.value = "";
  imagePreview.value = "";
  // Reset file input
  if (document.querySelector('input[type="file"]')) {
    document.querySelector('input[type="file"]').value = "";
  }
};

const submit = async () => {
  message.value = "";
  error.value = "";
  isSubmitting.value = true;

  try {
    // Create FormData for file upload
    const formData = new FormData();
    formData.append("phone", form.phone);
    formData.append("customer_name", form.customer_name);
    formData.append("content", form.content);
    formData.append("rating", form.rating);

    if (form.image_file) {
      formData.append("image", form.image_file);
    }

    const { data, error: err } = await useApiFetch("testimonials", {
      method: "POST",
      body: formData,
    });

    if (err.value) {
      error.value =
        err.value?.data?.message || "Có lỗi xảy ra khi gửi đánh giá.";
      showNotification(error.value, "error");
    } else {
      message.value = data.value?.message || "Đã gửi đánh giá thành công!";
      showNotification(message.value, "success");
      // Reset form
      Object.keys(form).forEach((k) => {
        if (k === "rating") {
          form[k] = null;
        } else if (k === "image_file") {
          form[k] = null;
        } else {
          form[k] = "";
        }
      });
      // Reset image states
      selectedFileName.value = "";
      imagePreview.value = "";
      if (document.querySelector('input[type="file"]')) {
        document.querySelector('input[type="file"]').value = "";
      }
    }
  } catch (e) {
    error.value = "Không thể kết nối tới API.";
    showNotification(error.value, "error");
  } finally {
    isSubmitting.value = false;
  }
};
</script>

<style scoped>
/* Custom focus styles */
.input:focus,
.textarea:focus {
  box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.2);
}

/* Custom star hover effect */
.fas.fa-star {
  filter: drop-shadow(0 0 2px currentColor);
}

/* Loading animation */
.loading {
  position: relative;
}

.loading::after {
  content: "";
  position: absolute;
  width: 16px;
  height: 16px;
  margin: auto;
  border: 2px solid transparent;
  border-top-color: #ffffff;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

/* Mobile optimizations */
@media (max-width: 768px) {
  .container {
    padding-left: 1rem;
    padding-right: 1rem;
  }

  .fas.fa-star {
    font-size: 2rem;
  }
}
</style>

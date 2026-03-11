<template>
  <div class="min-h-screen flex items-center justify-center bg-white">
    <div
      class="text-center p-6 max-w-md bg-white rounded-2xl shadow-md border border-gray-200"
    >
      <div
        v-if="status === 'success'"
        class="flex flex-col items-center space-y-4"
      >
        <div class="text-green-500 text-6xl">
          <i class="fas fa-circle-check"></i>
        </div>
        <h2 class="text-2xl font-bold text-green-700">
          Thanh toán thành công!
        </h2>
        <p class="text-gray-600 text-lg">
          Cảm ơn bạn đã đăng ký. Đang chuyển về trang chủ...
        </p>
        <LoadingSpinner />
      </div>

      <div
        v-else-if="status === 'fail'"
        class="flex flex-col items-center space-y-4"
      >
        <div class="text-red-500 text-6xl">
          <i class="fas fa-circle-xmark"></i>
        </div>
        <h2 class="text-2xl font-bold text-red-700">Thanh toán thất bại!</h2>
        <p class="text-gray-600 text-lg">
          Đã có lỗi xảy ra. Đang chuyển về trang chủ...
        </p>
        <LoadingSpinner />
      </div>

      <div v-else class="flex flex-col items-center space-y-4">
        <div class="text-gray-400 text-6xl">
          <i class="fas fa-spinner animate-spin"></i>
        </div>
        <h2 class="text-2xl font-bold text-gray-700">
          Đang kiểm tra trạng thái thanh toán...
        </h2>
        <LoadingSpinner />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";

const route = useRoute();
const router = useRouter();

const status = ref(null);

onMounted(() => {
  status.value = route.query.status || null;

  setTimeout(() => {
    router.push("/");
  }, 4000);
});
</script>

<!-- Spinner component inline -->
<script>
export default {
  components: {
    LoadingSpinner: {
      template: `
        <div class="mt-4 flex justify-center">
          <div class="w-6 h-6 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
        </div>
      `,
    },
  },
};
</script>

<style scoped>
/* Optional: smooth transition */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>

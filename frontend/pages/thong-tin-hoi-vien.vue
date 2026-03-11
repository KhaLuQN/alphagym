<template>
  <div
    class="min-h-screen py-16 md:py-24 bg-gradient-to-br from-gray-900 via-red-950 to-black p-4"
  >
    <div class="max-w-4xl mx-auto">
      <!-- Loading State -->
      <div
        v-if="loading"
        class="flex justify-center items-center min-h-[400px]"
      >
        <div class="flex flex-col items-center">
          <span class="loading loading-spinner loading-lg text-red-500"></span>
          <p class="text-gray-300 mt-4">Đang tải thông tin hội viên...</p>
        </div>
      </div>

      <!-- Error State -->
      <div v-else-if="error" class="alert alert-error shadow-lg">
        <div>
          <i class="fas fa-exclamation-circle text-lg"></i>
          <span>{{ error }}</span>
        </div>
      </div>

      <!-- Member Information -->
      <div v-else-if="member" class="space-y-6">
        <!-- Header Section -->
        <div class="card bg-gradient-to-r from-red-900 to-red-800 shadow-xl">
          <div class="card-body">
            <div class="flex flex-col md:flex-row items-center gap-6">
              <!-- Avatar -->
              <div class="avatar">
                <div
                  class="w-32 h-32 rounded-full ring ring-red-500 ring-offset-base-100 ring-offset-2"
                >
                  <img
                    v-if="member.member.img"
                    :src="`${storageBase}/${member.member.img}`"
                    :alt="member.member.full_name"
                    class="object-cover w-full h-full rounded-full"
                  />
                  <div
                    v-else
                    class="bg-gray-700 flex items-center justify-center w-full h-full rounded-full"
                  >
                    <i class="fas fa-user text-4xl text-gray-400"></i>
                  </div>
                </div>
              </div>

              <!-- Member Basic Info -->
              <div class="text-center md:text-left flex-1">
                <h1 class="text-3xl font-bold text-white mb-2">
                  {{ member.member.full_name }}
                </h1>
                <div
                  class="flex flex-wrap gap-4 justify-center md:justify-start"
                >
                  <div
                    class="badge badge-lg"
                    :class="getStatusBadgeClass(member.member.status)"
                  >
                    <i class="fas fa-circle text-xs mr-2"></i>
                    {{ getStatusText(member.member.status) }}
                  </div>
                  <div class="badge badge-outline badge-lg text-white">
                    <i class="fas fa-calendar mr-2"></i>
                    Tham gia: {{ formatDate(member.member.join_date) }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
          <!-- Contact Information -->
          <div class="card bg-gray-800 shadow-xl">
            <div class="card-body">
              <h2 class="card-title text-red-400">
                <i class="fas fa-address-book"></i>
                Thông tin liên hệ
              </h2>
              <div class="space-y-3">
                <div class="flex items-center gap-3">
                  <i class="fas fa-phone text-red-500 w-5"></i>
                  <span class="text-gray-300">{{ member.member.phone }}</span>
                </div>
                <div class="flex items-center gap-3">
                  <i class="fas fa-envelope text-red-500 w-5"></i>
                  <span class="text-gray-300">{{ member.member.email }}</span>
                </div>
                <div
                  class="flex items-center gap-3"
                  v-if="member.member.rfid_card_id"
                >
                  <i class="fas fa-id-card text-red-500 w-5"></i>
                  <span class="text-gray-300">{{
                    member.member.rfid_card_id
                  }}</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Activity Stats -->
          <div class="card bg-gray-800 shadow-xl">
            <div class="card-body">
              <h2 class="card-title text-red-400">
                <i class="fas fa-chart-line"></i>
                Hoạt động
              </h2>
              <div class="space-y-4">
                <div class="stat">
                  <div class="stat-title text-gray-400">Tổng lần check-in</div>
                  <div class="stat-value text-red-400">
                    {{ member.totalCheckins }}
                  </div>
                </div>
                <div class="stat">
                  <div class="stat-title text-gray-400">Tháng trước</div>
                  <div class="stat-value text-red-400">
                    {{ member.lastMonthCheckins }}
                  </div>
                </div>
                <div class="stat">
                  <div class="stat-title text-gray-400">
                    Thời gian trung bình
                  </div>
                  <div class="stat-value text-red-400">
                    {{ member.avgSessionTime.hours }}h
                    {{ member.avgSessionTime.minutes }}m
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Current Subscriptions -->
          <div class="card bg-gray-800 shadow-xl">
            <div class="card-body">
              <h2 class="card-title text-red-400">
                <i class="fas fa-credit-card"></i>
                Gói hiện tại
              </h2>
              <div class="space-y-2">
                <template
                  v-for="sub in getCurrentSubscriptions()"
                  :key="sub.subscription_id"
                >
                  <div class="bg-gray-700 p-3 rounded-lg">
                    <div class="flex justify-between items-center mb-2">
                      <span class="font-medium text-white"
                        >Gói {{ sub.plan_id }}</span
                      >
                      <span class="text-red-400 font-bold">{{
                        formatPrice(sub.actual_price)
                      }}</span>
                    </div>
                    <div class="text-sm text-gray-400">
                      {{ formatDate(sub.start_date) }} -
                      {{ formatDate(sub.end_date) }}
                    </div>
                  </div>
                </template>
                <div
                  v-if="getCurrentSubscriptions().length === 0"
                  class="text-gray-400 text-center py-4"
                >
                  Không có gói đang hoạt động
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Recent Check-ins -->
        <div class="card bg-gray-800 shadow-xl">
          <div class="card-body">
            <h2 class="card-title text-red-400 mb-4">
              <i class="fas fa-history"></i>
              Lịch sử check-in gần đây
            </h2>
            <div class="overflow-x-auto">
              <table class="table bg-gray-800">
                <thead>
                  <tr class="text-red-400">
                    <th>Ngày</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Thời gian</th>
                    <th>RFID</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="checkin in member.member.checkins.slice(0, 8)"
                    :key="checkin.checkin_id"
                    class="text-gray-300"
                  >
                    <td>{{ formatDate(checkin.checkin_time) }}</td>
                    <td>{{ formatTime(checkin.checkin_time) }}</td>
                    <td>
                      {{
                        checkin.checkout_time
                          ? formatTime(checkin.checkout_time)
                          : "-"
                      }}
                    </td>
                    <td>
                      <span
                        v-if="checkin.checkout_time"
                        class="badge badge-success"
                      >
                        {{
                          calculateDuration(
                            checkin.checkin_time,
                            checkin.checkout_time
                          )
                        }}
                      </span>
                      <span v-else class="badge badge-warning">Đang tập</span>
                    </td>
                    <td class="font-mono text-xs">
                      {{ checkin.rfid_card_id }}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- All Subscriptions History -->
        <div class="card bg-gray-800 shadow-xl">
          <div class="card-body">
            <h2 class="card-title text-red-400 mb-4">
              <i class="fas fa-list"></i>
              Lịch sử đăng ký gói
            </h2>
            <div class="overflow-x-auto">
              <table class="table bg-gray-800">
                <thead>
                  <tr class="text-red-400">
                    <th>Gói</th>
                    <th>Bắt đầu</th>
                    <th>Kết thúc</th>
                    <th>Giá tiền</th>
                    <th>Trạng thái</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="sub in member.subscriptions"
                    :key="sub.subscription_id"
                    class="text-gray-300"
                  >
                    <td>Gói {{ sub.plan_id }}</td>
                    <td>{{ formatDate(sub.start_date) }}</td>
                    <td>{{ formatDate(sub.end_date) }}</td>
                    <td class="font-bold text-red-400">
                      {{ formatPrice(sub.actual_price) }}
                    </td>
                    <td>
                      <span
                        class="badge"
                        :class="getSubscriptionStatusClass(sub)"
                      >
                        {{ getSubscriptionStatus(sub) }}
                      </span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- No Member Found -->
      <div v-else class="text-center py-12">
        <i class="fas fa-user-slash text-6xl text-gray-600 mb-4"></i>
        <p class="text-gray-400 text-lg">Không tìm thấy thông tin hội viên</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import { useRoute } from "vue-router";

const apiBase = useRuntimeConfig().public.apiBase;
const storageBase = useRuntimeConfig().public.storageBase;
const route = useRoute();
const token = ref(route.query.token);

const member = ref(null);
const loading = ref(true);
const error = ref(null);

// Utility functions
const formatDate = (dateString) => {
  return new Date(dateString).toLocaleDateString("vi-VN");
};

const formatTime = (dateString) => {
  return new Date(dateString).toLocaleTimeString("vi-VN", {
    hour: "2-digit",
    minute: "2-digit",
  });
};

const formatPrice = (price) => {
  return new Intl.NumberFormat("vi-VN", {
    style: "currency",
    currency: "VND",
  }).format(price);
};

const calculateDuration = (checkin, checkout) => {
  const start = new Date(checkin);
  const end = new Date(checkout);
  const diff = end - start;
  const hours = Math.floor(diff / (1000 * 60 * 60));
  const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
  return `${hours}h ${minutes}m`;
};

const getStatusBadgeClass = (status) => {
  switch (status) {
    case "active":
      return "badge-success";
    case "expired":
      return "badge-error";
    default:
      return "badge-warning";
  }
};

const getStatusText = (status) => {
  switch (status) {
    case "active":
      return "Đang hoạt động";
    case "expired":
      return "Đã hết hạn";
    default:
      return "Chưa xác định";
  }
};

const getCurrentSubscriptions = () => {
  if (!member.value?.subscriptions) return [];
  const now = new Date();
  return member.value.subscriptions.filter((sub) => {
    const start = new Date(sub.start_date);
    const end = new Date(sub.end_date);
    return start <= now && end >= now;
  });
};

const getSubscriptionStatus = (subscription) => {
  const now = new Date();
  const start = new Date(subscription.start_date);
  const end = new Date(subscription.end_date);

  if (now < start) return "Chưa bắt đầu";
  if (now > end) return "Đã kết thúc";
  return "Đang hoạt động";
};

const getSubscriptionStatusClass = (subscription) => {
  const status = getSubscriptionStatus(subscription);
  switch (status) {
    case "Đang hoạt động":
      return "badge-success";
    case "Đã kết thúc":
      return "badge-error";
    default:
      return "badge-warning";
  }
};

onMounted(async () => {
  if (!token.value) {
    error.value = "Thiếu token đăng nhập.";
    loading.value = false;
    return;
  }

  try {
    const data = await $fetch(`${apiBase}magic-login`, {
      method: "POST",
      body: { token: token.value },
    });
    console.log("Dữ liệu trả về từ API:", data);
    member.value = data.member;
  } catch (err) {
    error.value =
      err?.data?.message || err?.message || "Lỗi kết nối đến máy chủ.";
  } finally {
    loading.value = false;
  }
});
</script>

<template>
  <div class="min-h-screen bg-gray-900 text-white">
    <!-- Hero Section -->
    <section class="hero-gradient py-16 md:py-24 relative overflow-hidden">
      <div class="absolute inset-0 bg-black/30"></div>

      <!-- Floating particles effect -->
      <div class="absolute inset-0 overflow-hidden">
        <div
          class="absolute top-20 left-10 w-2 h-2 bg-red-500 rounded-full pulse-red"
        ></div>
        <div
          class="absolute top-40 right-20 w-3 h-3 bg-red-300 rounded-full pulse-red"
          style="animation-delay: 1s"
        ></div>
        <div
          class="absolute bottom-32 left-1/4 w-2 h-2 bg-red-400 rounded-full pulse-red"
          style="animation-delay: 2s"
        ></div>
      </div>

      <div class="relative z-10 container mx-auto px-4 text-center">
        <div class="mb-8 float-animation">
          <div
            class="inline-block p-6 bg-gradient-to-br from-red-500/20 to-red-700/20 rounded-full backdrop-blur-sm border border-red-500/30"
          >
            <i class="fas fa-dumbbell text-red-500 text-6xl"></i>
          </div>
        </div>

        <h1
          class="text-4xl md:text-6xl lg:text-7xl font-extrabold mb-6 text-transparent bg-clip-text bg-gradient-to-r from-white via-red-200 to-red-500 leading-tight"
        >
          AI Tư vấn
        </h1>

        <p
          class="text-lg md:text-xl text-gray-300 mb-12 max-w-3xl mx-auto leading-relaxed"
        >
          Công nghệ AI thông minh giúp bạn đạt mục tiêu thể hình nhanh chóng và
          hiệu quả với kế hoạch cá nhân hóa
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
          <div
            class="bg-white/5 backdrop-blur-sm rounded-xl p-6 border border-white/10 hover:border-red-500/50 transition-all duration-300"
          >
            <i class="fas fa-check-circle text-green-400 text-2xl mb-3"></i>
            <h3 class="font-semibold text-white mb-2">Tư vấn cá nhân hóa</h3>
            <p class="text-gray-400 text-sm">
              Phân tích dựa trên thông tin cá nhân
            </p>
          </div>
          <div
            class="bg-white/5 backdrop-blur-sm rounded-xl p-6 border border-white/10 hover:border-red-500/50 transition-all duration-300"
          >
            <i class="fas fa-chart-line text-blue-400 text-2xl mb-3"></i>
            <h3 class="font-semibold text-white mb-2">Kế hoạch khoa học</h3>
            <p class="text-gray-400 text-sm">Dựa trên nghiên cứu và dữ liệu</p>
          </div>
          <div
            class="bg-white/5 backdrop-blur-sm rounded-xl p-6 border border-white/10 hover:border-red-500/50 transition-all duration-300"
          >
            <i class="fas fa-users text-purple-400 text-2xl mb-3"></i>
            <h3 class="font-semibold text-white mb-2">Hỗ trợ 24/7</h3>
            <p class="text-gray-400 text-sm">AI luôn sẵn sàng tư vấn</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Form Section -->
    <section class="py-16 px-4 bg-gray-900">
      <div class="container mx-auto max-w-5xl">
        <div
          class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl shadow-2xl border border-gray-700 overflow-hidden"
        >
          <div class="bg-gradient-to-r from-red-600 to-red-700 p-6">
            <h2
              class="text-2xl md:text-3xl font-bold text-center text-white flex items-center justify-center gap-3"
            >
              <i class="fas fa-clipboard-list"></i>
              Thông tin của bạn
            </h2>
            <p class="text-center text-red-100 mt-2">
              Vui lòng điền đầy đủ thông tin để AI có thể tư vấn chính xác nhất
            </p>
          </div>

          <div class="p-8">
            <form @submit="handleSubmit" class="space-y-8">
              <!-- Personal Info Row -->
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="form-control">
                  <label class="label">
                    <span
                      class="label-text text-gray-300 font-semibold flex items-center gap-2"
                    >
                      <i class="fas fa-user text-red-500"></i>
                      Họ và tên
                    </span>
                  </label>
                  <input
                    v-model="formData.name"
                    type="text"
                    placeholder="Nhập họ tên của bạn"
                    class="input input-bordered bg-gray-800 border-gray-600 text-white placeholder-gray-400 focus:border-red-500 focus:ring-1 focus:ring-red-500"
                    required
                  />
                </div>

                <div class="form-control">
                  <label class="label">
                    <span
                      class="label-text text-gray-300 font-semibold flex items-center gap-2"
                    >
                      <i class="fas fa-venus-mars text-red-500"></i>
                      Giới tính
                    </span>
                  </label>
                  <select
                    v-model="formData.gender"
                    class="select select-bordered bg-gray-800 border-gray-600 text-white focus:border-red-500 focus:ring-1 focus:ring-red-500"
                    required
                  >
                    <option value="" disabled>Chọn giới tính</option>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                  </select>
                </div>

                <div class="form-control">
                  <label class="label">
                    <span
                      class="label-text text-gray-300 font-semibold flex items-center gap-2"
                    >
                      <i class="fas fa-birthday-cake text-red-500"></i>
                      Tuổi
                    </span>
                  </label>
                  <input
                    v-model="formData.age"
                    type="number"
                    placeholder="Nhập tuổi"
                    class="input input-bordered bg-gray-800 border-gray-600 text-white placeholder-gray-400 focus:border-red-500 focus:ring-1 focus:ring-red-500"
                    min="1"
                    max="100"
                    required
                  />
                </div>
              </div>

              <!-- Physical Info Row -->
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="form-control">
                  <label class="label">
                    <span
                      class="label-text text-gray-300 font-semibold flex items-center gap-2"
                    >
                      <i class="fas fa-ruler-vertical text-red-500"></i>
                      Chiều cao (cm)
                    </span>
                  </label>
                  <input
                    v-model="formData.height"
                    type="number"
                    placeholder="Ví dụ: 170"
                    class="input input-bordered bg-gray-800 border-gray-600 text-white placeholder-gray-400 focus:border-red-500 focus:ring-1 focus:ring-red-500"
                    min="100"
                    max="250"
                    required
                  />
                </div>

                <div class="form-control">
                  <label class="label">
                    <span
                      class="label-text text-gray-300 font-semibold flex items-center gap-2"
                    >
                      <i class="fas fa-weight text-red-500"></i>
                      Cân nặng (kg)
                    </span>
                  </label>
                  <input
                    v-model="formData.weight"
                    type="number"
                    placeholder="Ví dụ: 65"
                    class="input input-bordered bg-gray-800 border-gray-600 text-white placeholder-gray-400 focus:border-red-500 focus:ring-1 focus:ring-red-500"
                    min="30"
                    max="200"
                    required
                  />
                </div>

                <div class="form-control">
                  <label class="label">
                    <span
                      class="label-text text-gray-300 font-semibold flex items-center gap-2"
                    >
                      <i class="fas fa-calendar-week text-red-500"></i>
                      Số buổi tập/tuần
                    </span>
                  </label>
                  <input
                    v-model="formData.weekly_sessions"
                    type="number"
                    placeholder="Ví dụ: 3"
                    class="input input-bordered bg-gray-800 border-gray-600 text-white placeholder-gray-400 focus:border-red-500 focus:ring-1 focus:ring-red-500"
                    min="1"
                    max="7"
                    required
                  />
                </div>
              </div>

              <!-- Goals and Activity Row -->
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="form-control">
                  <label class="label">
                    <span
                      class="label-text text-gray-300 font-semibold flex items-center gap-2"
                    >
                      <i class="fas fa-clock text-red-500"></i>
                      Thời gian mong muốn
                    </span>
                  </label>
                  <input
                    v-model="formData.goal_time"
                    type="text"
                    placeholder="Ví dụ: 3 tháng, 6 tháng..."
                    class="input input-bordered bg-gray-800 border-gray-600 text-white placeholder-gray-400 focus:border-red-500 focus:ring-1 focus:ring-red-500"
                    required
                  />
                </div>

                <div class="form-control">
                  <label class="label">
                    <span
                      class="label-text text-gray-300 font-semibold flex items-center gap-2"
                    >
                      <i class="fas fa-activity text-red-500"></i>
                      Mức độ vận động
                    </span>
                  </label>
                  <select
                    v-model="formData.activity_level"
                    class="select select-bordered bg-gray-800 border-gray-600 text-white focus:border-red-500 focus:ring-1 focus:ring-red-500"
                    required
                  >
                    <option value="" disabled>Chọn mức độ vận động</option>
                    <option value="Thấp">Thấp - Ít vận động</option>
                    <option value="Trung bình">
                      Trung bình - Vận động đều đặn
                    </option>
                    <option value="Cao">Cao - Vận động nhiều</option>
                  </select>
                </div>
              </div>

              <!-- Goal Input -->
              <div class="form-control">
                <label class="label">
                  <span
                    class="label-text text-gray-300 font-semibold flex items-center gap-2"
                  >
                    <i class="fas fa-target text-red-500"></i>
                    Mục tiêu tập luyện
                  </span>
                </label>
                <textarea
                  v-model="formData.goal"
                  placeholder="Ví dụ: Giảm mỡ bụng, tăng cơ toàn thân, cải thiện sức khỏe..."
                  class="textarea textarea-bordered bg-gray-800 border-gray-600 text-white placeholder-gray-400 focus:border-red-500 focus:ring-1 focus:ring-red-500 h-24 resize-none"
                  required
                ></textarea>
              </div>

              <!-- Submit Button -->
              <div class="text-center pt-4">
                <button
                  type="submit"
                  :disabled="isLoading"
                  class="btn btn-lg bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 border-none text-white font-bold px-12 py-4 rounded-xl shadow-lg transform transition-all duration-200 hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed"
                  :class="{ 'pulse-red': !isLoading }"
                >
                  <span v-if="!isLoading" class="flex items-center gap-3">
                    <i class="fas fa-brain text-xl"></i>
                    Nhận tư vấn từ AI
                  </span>
                  <span v-else class="flex items-center gap-3">
                    <div class="loading loading-spinner loading-sm"></div>
                    AI đang phân tích...
                  </span>
                </button>
              </div>
            </form>
          </div>
        </div>

        <!-- Results Section -->
        <div v-if="showResults" class="mt-12 slide-in">
          <div
            class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl shadow-2xl border border-green-500/30 overflow-hidden"
          >
            <div class="bg-gradient-to-r from-green-600 to-green-700 p-6">
              <h2
                class="text-2xl md:text-3xl font-bold text-center text-white flex items-center justify-center gap-3"
              >
                <i class="fas fa-check-circle"></i>
                Kết quả tư vấn
              </h2>
              <p class="text-center text-green-100 mt-2">
                Kế hoạch được AI phân tích và tối ưu hóa riêng cho bạn
              </p>
            </div>

            <div class="p-8">
              <div class="space-y-6">
                <div
                  v-for="(section, index) in resultSections"
                  :key="index"
                  class="bg-gradient-to-r from-gray-700/50 to-gray-800/50 rounded-xl p-6 border border-gray-600 hover:border-red-500/50 transition-all duration-300"
                >
                  <div class="flex items-start gap-4">
                    <div
                      class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-full flex items-center justify-center"
                    >
                      <i
                        :class="getSectionIcon(index)"
                        class="text-white text-lg"
                      ></i>
                    </div>
                    <div class="flex-1 min-w-0">
                      <h3 class="text-xl font-bold mb-3 text-white">
                        {{ section.title }}
                      </h3>
                      <div
                        class="text-gray-300 leading-relaxed"
                        v-html="section.content"
                      ></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: "TuVanAI",
  data() {
    return {
      isLoading: false,
      showResults: false,
      formData: {
        name: "",
        gender: "",
        age: "",
        height: "",
        weight: "",
        weekly_sessions: "",
        goal_time: "",
        activity_level: "",
        goal: "",
      },
      resultSections: [],
    };
  },
  methods: {
    async handleSubmit(e) {
      e.preventDefault();

      this.isLoading = true;
      this.showResults = false;

      try {
        const response = await fetch("/api/consult", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(this.formData),
        });

        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }

        const result = await response.json();
        this.displayResults(result.message);
      } catch (error) {
        console.error("Error calling API:", error);

        // Hiển thị thông báo lỗi cho người dùng
        this.displayResults(`**❌ LỖI KẾT NỐI:**
Xin lỗi, hiện tại hệ thống AI đang gặp sự cố. Vui lòng thử lại sau hoặc liên hệ hỗ trợ.

**📞 THÔNG TIN LIÊN HỆ:**
- Hotline: 0123.456.789
- Email: support@fitness-ai.com

**💡 GỢI Ý TẠMO THỜI:**
Dựa trên thông tin bạn cung cấp:
- BMI ước tính: ${this.calculateBMI()} (${this.getBMICategory()})
- Mục tiêu: ${this.formData.goal}
- Hãy tăng cường hoạt động thể chất từ từ
- Duy trì chế độ ăn cân bằng
- Nghỉ ngơi đủ giấc và uống đủ nước`);
      } finally {
        this.isLoading = false;
      }
    },

    displayResults(resultText) {
      this.resultSections = this.parseResultSections(resultText);
      this.showResults = true;

      // Scroll to results
      this.$nextTick(() => {
        const resultsElement = document.querySelector(".slide-in");
        if (resultsElement) {
          resultsElement.scrollIntoView({ behavior: "smooth", block: "start" });
        }
      });
    },

    parseResultSections(text) {
      const sections = [];
      const lines = text.split("\n");
      let currentSection = null;

      for (const line of lines) {
        if (line.includes("**") && line.includes(":")) {
          if (currentSection) {
            sections.push(currentSection);
          }
          currentSection = {
            title: line.replace(/\*\*/g, "").trim(),
            content: "",
          };
        } else if (currentSection && line.trim()) {
          currentSection.content += line.trim() + "<br>";
        }
      }

      if (currentSection) {
        sections.push(currentSection);
      }

      return sections;
    },

    getSectionIcon(index) {
      const icons = [
        "fas fa-heartbeat",
        "fas fa-bullseye",
        "fas fa-calendar-alt",
        "fas fa-apple-alt",
        "fas fa-star",
        "fas fa-gift",
      ];
      return icons[index] || "fas fa-info-circle";
    },

    calculateBMI() {
      if (this.formData.height && this.formData.weight) {
        const heightInM = this.formData.height / 100;
        return (this.formData.weight / (heightInM * heightInM)).toFixed(1);
      }
      return "22.5";
    },

    getBMICategory() {
      const bmi = parseFloat(this.calculateBMI());
      if (bmi < 18.5) return "Thiếu cân";
      if (bmi < 25) return "Bình thường";
      if (bmi < 30) return "Thừa cân";
      return "Béo phì";
    },

    calculateCalories() {
      if (
        this.formData.weight &&
        this.formData.height &&
        this.formData.age &&
        this.formData.gender
      ) {
        let bmr;
        if (this.formData.gender === "Nam") {
          bmr =
            88.362 +
            13.397 * this.formData.weight +
            4.799 * this.formData.height -
            5.677 * this.formData.age;
        } else {
          bmr =
            447.593 +
            9.247 * this.formData.weight +
            3.098 * this.formData.height -
            4.33 * this.formData.age;
        }

        const activityMultiplier = {
          Thấp: 1.2,
          "Trung bình": 1.55,
          Cao: 1.9,
        };

        return Math.round(
          bmr * (activityMultiplier[this.formData.activity_level] || 1.55)
        );
      }
      return "2000";
    },
  },
};
</script>

<style scoped>
@keyframes pulse-red {
  0%,
  100% {
    box-shadow: 0 0 0 0 rgba(220, 38, 38, 0.7);
  }
  50% {
    box-shadow: 0 0 0 20px rgba(220, 38, 38, 0);
  }
}

@keyframes float {
  0%,
  100% {
    transform: translateY(0px);
  }
  50% {
    transform: translateY(-10px);
  }
}

@keyframes slideInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.pulse-red {
  animation: pulse-red 2s infinite;
}

.float-animation {
  animation: float 3s ease-in-out infinite;
}

.slide-in {
  animation: slideInUp 0.6s ease-out;
}

.hero-gradient {
  background: linear-gradient(
    135deg,
    #0f1419 0%,
    #1a1a2e 25%,
    #16213e 50%,
    #0f3460 75%,
    #533a71 100%
  );
  position: relative;
}

.hero-gradient::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: radial-gradient(
      circle at 30% 50%,
      rgba(220, 38, 38, 0.1) 0%,
      transparent 50%
    ),
    radial-gradient(
      circle at 70% 80%,
      rgba(220, 38, 38, 0.08) 0%,
      transparent 50%
    );
  pointer-events: none;
}

/* Custom scrollbar */
::-webkit-scrollbar {
  width: 8px;
}

::-webkit-scrollbar-track {
  background: #1f2937;
}

::-webkit-scrollbar-thumb {
  background: linear-gradient(to bottom, #dc2626, #991b1b);
  border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
  background: linear-gradient(to bottom, #ef4444, #dc2626);
}

/* Focus states for better accessibility */
.input:focus,
.select:focus,
.textarea:focus {
  outline: none;
  box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
}

/* Custom button hover effects */
.btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 25px rgba(220, 38, 38, 0.3);
}

/* Results animation stagger */
.slide-in > div > div > div:nth-child(1) {
  animation-delay: 0.1s;
}
.slide-in > div > div > div:nth-child(2) {
  animation-delay: 0.2s;
}
.slide-in > div > div > div:nth-child(3) {
  animation-delay: 0.3s;
}
.slide-in > div > div > div:nth-child(4) {
  animation-delay: 0.4s;
}
.slide-in > div > div > div:nth-child(5) {
  animation-delay: 0.5s;
}
.slide-in > div > div > div:nth-child(6) {
  animation-delay: 0.6s;
}

/* Glassmorphism effect for cards */
.backdrop-blur-sm {
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
}

/* Loading animation for button */
.loading-spinner {
  border: 3px solid transparent;
  border-top: 3px solid currentColor;
  border-radius: 50%;
  width: 20px;
  height: 20px;
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
  .hero-gradient {
    padding: 3rem 0;
  }

  .container {
    padding-left: 1rem;
    padding-right: 1rem;
  }

  .text-4xl {
    font-size: 2.5rem;
  }

  .text-6xl {
    font-size: 3rem;
  }
}
</style>

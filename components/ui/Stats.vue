<template>
  <section class="py-20 bg-gradient-to-br from-gray-900 to-red-900 text-white overflow-hidden">
    <div class="container mx-auto px-6 lg:px-8 max-w-7xl">
      <h2 class="text-4xl lg:text-5xl font-extrabold text-center mb-16 text-red-400 custom-text-shadow relative z-10">
        Những con số ấn tượng
      </h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12 text-center">
        <!-- Stat 1: Members -->
        <div class="stat p-10 bg-gray-900 rounded-2xl shadow-inner shadow-red-900/30 border border-red-700/50 transform transition-all duration-500 hover:scale-105 hover:-translate-y-2 hover:bg-gray-800 hover:shadow-xl hover:shadow-red-500/40 relative overflow-hidden group">
          <div class="stat-value text-red-400 text-6xl font-black mb-2 animate-pulse">1000+</div>
          <div class="stat-title text-red-200 font-bold text-xl uppercase tracking-wide">Thành viên</div>
          <!-- Optional: Add a subtle red glow effect on hover -->
          <div class="absolute inset-0 bg-red-500 opacity-0 group-hover:opacity-10 transition-opacity duration-500 rounded-2xl pointer-events-none"></div>
        </div>

        <!-- Stat 2: Trainers -->
        <div class="stat p-10 bg-gray-900 rounded-2xl shadow-inner shadow-red-900/30 border border-red-700/50 transform transition-all duration-500 hover:scale-105 hover:-translate-y-2 hover:bg-gray-800 hover:shadow-xl hover:shadow-red-500/40 relative overflow-hidden group">
          <div class="stat-value text-red-400 text-6xl font-black mb-2 animate-pulse">50+</div>
          <div class="stat-title text-red-200 font-bold text-xl uppercase tracking-wide">
            Huấn luyện viên
          </div>
          <div class="absolute inset-0 bg-red-500 opacity-0 group-hover:opacity-10 transition-opacity duration-500 rounded-2xl pointer-events-none"></div>
        </div>

        <!-- Stat 3: Operation Hours -->
        <div class="stat p-10 bg-gray-900 rounded-2xl shadow-inner shadow-red-900/30 border border-red-700/50 transform transition-all duration-500 hover:scale-105 hover:-translate-y-2 hover:bg-gray-800 hover:shadow-xl hover:shadow-red-500/40 relative overflow-hidden group">
          <div class="stat-value text-red-400 text-6xl font-black mb-2 animate-pulse">24/7</div>
          <div class="stat-title text-red-200 font-bold text-xl uppercase tracking-wide">Hoạt động</div>
          <div class="absolute inset-0 bg-red-500 opacity-0 group-hover:opacity-10 transition-opacity duration-500 rounded-2xl pointer-events-none"></div>
        </div>

        <!-- Stat 4: Experience -->
        <div class="stat p-10 bg-gray-900 rounded-2xl shadow-inner shadow-red-900/30 border border-red-700/50 transform transition-all duration-500 hover:scale-105 hover:-translate-y-2 hover:bg-gray-800 hover:shadow-xl hover:shadow-red-500/40 relative overflow-hidden group">
          <div class="stat-value text-red-400 text-6xl font-black mb-2 animate-pulse">5+</div>
          <div class="stat-title text-red-200 font-bold text-xl uppercase tracking-wide">
            Năm kinh nghiệm
          </div>
          <div class="absolute inset-0 bg-red-500 opacity-0 group-hover:opacity-10 transition-opacity duration-500 rounded-2xl pointer-events-none"></div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
/* Define pulse animation for stat values */
@keyframes pulse {
  0%, 100% {
    opacity: 1;
  }
  50% {
    opacity: 0.7;
  }
}

.animate-pulse {
  animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

/* Custom text shadow for heading to give a red glow effect */
.custom-text-shadow {
  text-shadow: 0 0 20px rgba(239, 68, 68, 0.8), 0 0 30px rgba(239, 68, 68, 0.6); /* More pronounced red glow */
}
</style>

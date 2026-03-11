<template>
  <nav
    class="navbar bg-black/95 fixed top-0 z-50 border-b border-red-600/30 py-3"
  >
    <div
      class="container mx-auto px-4 flex justify-between items-center w-full"
    >
      <div class="navbar-start flex items-center">
        <!-- Dropdown menu for mobile (hamburger icon) -->
        <div class="dropdown lg:hidden">
          <label
            tabindex="0"
            class="btn btn-ghost text-red-500 hover:bg-red-600/20 rounded-lg p-2"
          >
            <i class="fas fa-bars text-xl"></i>
          </label>
          <ul
            tabindex="0"
            class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow-lg bg-black/95 rounded-box w-52 border border-red-700/50"
          >
            <!-- Mobile navigation links -->
            <li>
              <NuxtLink to="/" class="nav-link-mobile"> Trang chủ </NuxtLink>
            </li>
            <li>
              <NuxtLink to="/gioi-thieu" class="nav-link-mobile">
                Giới thiệu
              </NuxtLink>
            </li>
            <li>
              <NuxtLink to="/dang-ky-goi-tap" class="nav-link-mobile">
                Đăng ký gói tập
              </NuxtLink>
            </li>

            <li>
              <NuxtLink to="/bai-viet" class="nav-link-mobile">
                Bài viết
              </NuxtLink>
            </li>
            <li>
              <NuxtLink to="/goi-tap" class="nav-link-mobile">
                Gói tập
              </NuxtLink>
            </li>
            <li>
              <NuxtLink to="/huan-luyen-vien" class="nav-link-mobile">
                Huấn luyện viên
              </NuxtLink>
            </li>
            <li>
              <NuxtLink to="/tu-van" class="nav-link-mobile">
                Tư vấn AI
              </NuxtLink>
            </li>
            <li>
              <NuxtLink to="/tra-cuu-hoi-vien" class="nav-link-mobile">
                Tra cứu hội viên
              </NuxtLink>
            </li>
            <li>
              <NuxtLink to="/lien-he" class="nav-link-mobile">
                Liên hệ
              </NuxtLink>
            </li>
          </ul>
        </div>

        <!-- Logo -->
        <NuxtLink
          to="/"
          class="btn btn-ghost normal-case text-3xl font-extrabold text-gradient ml-2 lg:ml-0"
        >
          <i class="fas fa-dumbbell mr-2 text-red-500"></i>GymTech
        </NuxtLink>
      </div>

      <!-- Center section: Desktop navigation menu -->
      <div class="navbar-center hidden lg:flex flex-grow">
        <ul class="menu menu-horizontal px-1 space-x-4">
          <!-- Trang chủ -->

          <li>
            <NuxtLink to="/" class="group nav-link-desktop">
              <i
                class="fas fa-home mr-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200"
              ></i>
              Trang chủ
            </NuxtLink>
          </li>
          <!-- Giới thiệu -->
          <li>
            <NuxtLink to="/gioi-thieu" class="group nav-link-desktop">
              <i
                class="fas fa-dumbbell mr-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200"
              ></i>
              Giới thiệu
            </NuxtLink>
          </li>

          <!-- gói tập -->
          <li>
            <NuxtLink to="/dang-ky-goi-tap" class="group nav-link-desktop">
              <i
                class="fas fa-users mr-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200"
              ></i>
              Đăng ký gói tập
            </NuxtLink>
          </li>

          <!-- Tin tức -->
          <li>
            <NuxtLink to="/bai-viet" class="group nav-link-desktop">
              <i
                class="fas fa-newspaper mr-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200"
              ></i>
              Bài Viết
            </NuxtLink>
          </li>
          <li>
            <NuxtLink to="/tu-van" class="group nav-link-desktop">
              <i
                class="fas fa-robot mr-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200"
              ></i>
              Tư vấn AI
            </NuxtLink>
          </li>
          <li>
            <NuxtLink to="/tra-cuu-hoi-vien" class="group nav-link-desktop">
              <i
                class="fas fa-search mr-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200"
              ></i>
              Tra cứu Hội Viên
            </NuxtLink>
          </li>
          <li>
            <NuxtLink
              to="/lien-he"
              class="group nav-link-desktop btn btn-primary bg-red-600 hover:bg-red-700 border-red-600 hover:border-red-700 text-white font-bold text-lg rounded-full shadow-lg transform transition-transform duration-200 hover:scale-105"
            >
              Liên hệ
            </NuxtLink>
          </li>
          <!-- Liên hệ -->
        </ul>
      </div>

      <!-- End section: Register button -->
      <div class="navbar-end ml-auto"></div>
    </div>
  </nav>
</template>

<style scoped>
/* Gradient text for the logo */
.text-gradient {
  background: linear-gradient(to right, #ff0000, #ff7f00); /* Red to Orange */
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

/* Base styles for desktop navigation links */
.nav-link-desktop {
  @apply text-white font-semibold text-lg py-2 px-4 rounded-md transition-colors duration-200 flex items-center;
}

/* Base styles for mobile navigation links */
.nav-link-mobile {
  @apply text-white py-2 px-4 block rounded-md transition-colors duration-200;
}

/* Styles for active navigation links (both desktop and mobile) */
.router-link-exact-active.nav-link-desktop,
.router-link-exact-active.nav-link-mobile {
  @apply text-red-500; /* Set text color to red for the active link */
}

/* Hover styles for non-active links */
/* This ensures that when you hover over a link that is NOT the active page, it still turns red */
.nav-link-desktop:not(.router-link-exact-active):hover,
.nav-link-mobile:not(.router-link-exact-active):hover {
  @apply text-red-500; /* Red color on hover for non-active links */
}
</style>

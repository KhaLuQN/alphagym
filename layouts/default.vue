<template>
  <div>
    <client-only>
      <Navbar />
    </client-only>

    <slot />

    <Floating />
  </div>
  <Footer />
</template>
<script setup>
import Navbar from "~/components/global/Navbar.vue";
import Footer from "~/components/global/Footer.vue";
import Floating from "~/components/ui/Floating.vue";
</script>
<style setup>
.hero-gradient {
  background: linear-gradient(135deg, #dc2626 0%, #7f1d1d 50%, #000000 100%);
}
.text-gradient {
  background: linear-gradient(135deg, #dc2626, #ef4444);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
.card-hover {
  transition: all 0.3s ease;
}
.card-hover:hover {
  transform: translateY(-10px);
  box-shadow: 0 20px 40px rgba(220, 38, 38, 0.3);
}
.pulse-red {
  animation: pulse-red 2s infinite;
}
@keyframes pulse-red {
  0%,
  100% {
    box-shadow: 0 0 0 0 rgba(220, 38, 38, 0.7);
  }
  50% {
    box-shadow: 0 0 0 20px rgba(220, 38, 38, 0);
  }
}
.bg-pattern {
  background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23dc2626' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='4'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}
</style>

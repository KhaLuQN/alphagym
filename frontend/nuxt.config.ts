export default defineNuxtConfig({
  ssr: true,
  compatibilityDate: "2025-05-15",
  devtools: { enabled: true },
  modules: ["@nuxtjs/tailwindcss"],
  css: [
    "~/assets/css/main.css",
    "swiper/css",
    "swiper/css/navigation",
    "swiper/css/pagination",
  ],
  runtimeConfig: {
    public: {
      apiBase: process.env.NUXT_PUBLIC_API_BASE || "http://127.0.0.1:8000/api/",
      storageBase:
        process.env.NUXT_PUBLIC_STORAGE_BASE || "http://127.0.0.1:8000",
    },
  },
  app: {
    head: {
      title: "FitPhysique - Gym & Fitness",
      charset: "utf-8",
      htmlAttrs: {
        lang: "vi",
      },
      viewport: "width=device-width, initial-scale=1",

      link: [
        {
          href: "/images/logo.png",
          rel: "icon",
          type: "image/png",
        },
        { rel: "preconnect", href: "https://fonts.googleapis.com" },
        {
          rel: "preconnect",
          href: "https://fonts.gstatic.com",
          crossorigin: "",
        },

        {
          href: "https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Oswald:wght@700&display=swap",
          rel: "stylesheet",
        },
        {
          href: "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css",
          rel: "stylesheet",
        },
      ],

      script: [{}],
    },
  },
});

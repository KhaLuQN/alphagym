import type { Config } from "tailwindcss";
const defaultTheme = require("tailwindcss/defaultTheme");
const config: Config = {
  content: [
    "./components/**/*.{vue,js,ts}",
    "./layouts/**/*.{vue,js,ts}",
    "./pages/**/*.{vue,js,ts}",
    "./app.vue",
  "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ["Inter", ...defaultTheme.fontFamily.sans],

        display: ["Oswald", "sans-serif"],
      },
    },
  },
  plugins: [
    require("daisyui"),
    require('flowbite/plugin')
  ],
};
export default config;

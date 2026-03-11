import { ref } from "vue";

const isPageLoading = ref(false);

export const usePageLoading = () => {
  return {
    isPageLoading,
  };
};

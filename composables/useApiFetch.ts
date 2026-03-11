export const useApiFetch: typeof useFetch = (request, opts?) => {
  const config = useRuntimeConfig();

  return useFetch(request, {
    baseURL: config.public.apiBase,

    headers: {
      Accept: "application/json",
    },

    onResponseError({ request, response, error }) {
      console.error(`[API Fetch Error] on ${request}: ${error}`);
    },

    ...opts,
  });
};

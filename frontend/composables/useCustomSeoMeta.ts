export const useCustomSeoMeta = (options: {
  title?: string;
  description?: string;
  image?: string;
  url?: string;
  keywords?: string;
}) => {
  const siteName = "GymTech";
  const siteUrl = "https://gymtech.vn";
  const defaultTitle = "Trung tâm thể hình hiện đại | GymTech";
  const defaultDescription =
    "Phòng tập Gym chuyên nghiệp với thiết bị hiện đại, huấn luyện viên tận tâm.";
  const defaultImage = "https://gymtech.vn/images/default-og.jpg";

  useSeoMeta({
    title: options.title || defaultTitle,
    description: options.description || defaultDescription,
    keywords:
      options.keywords ||
      "gym, huấn luyện viên, thiết bị tập luyện, thể hình, GymTech",

    ogTitle: options.title || defaultTitle,
    ogDescription: options.description || defaultDescription,
    ogImage: options.image || defaultImage,
    ogUrl: options.url || siteUrl,
    ogType: "website",
    ogSiteName: siteName,

    twitterTitle: options.title || defaultTitle,
    twitterDescription: options.description || defaultDescription,
    twitterImage: options.image || defaultImage,
    twitterCard: "summary_large_image",

    themeColor: "#000000",
    charset: "utf-8",
    viewport: "width=device-width, initial-scale=1.0",
  });
};

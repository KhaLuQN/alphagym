<template>
  <div class="min-h-screen bg-black text-white">
    <!-- Hero Section -->
    <div
      class="relative py-24 md:py-32 bg-gradient-to-br from-gray-950 via-red-950 to-black overflow-hidden"
    >
      <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
          <h1
            class="text-5xl md:text-7xl font-extrabold mb-6 text-red-500 custom-hero-text-shadow leading-tight"
          >
            <i class="fas fa-info-circle mr-4 text-red-600"></i>Về GymTech
          </h1>
          <p class="text-xl md:text-2xl text-gray-300 mb-10 max-w-xl mx-auto">
            Khám phá hành trình, sứ mệnh và giá trị cốt lõi của chúng tôi
          </p>
        </div>
      </div>
    </div>

    <!-- About Us Section -->
    <section
      class="py-16 bg-gray-900 border-b border-red-700/50 shadow-inner shadow-red-900/20"
    >
      <div class="container mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
          <div class="text-center md:text-left">
            <h2
              class="text-4xl font-extrabold text-red-400 mb-6 custom-text-shadow"
            >
              Chúng tôi là ai?
            </h2>
            <p class="text-lg text-gray-300 leading-relaxed mb-4">
              GymTech không chỉ là một phòng gym, mà là một cộng đồng nơi mọi
              người đến để cải thiện bản thân, từ thể chất đến tinh thần. Chúng
              tôi tin rằng một cơ thể khỏe mạnh là nền tảng cho một cuộc sống
              hạnh phúc và trọn vẹn.
            </p>
            <p class="text-lg text-gray-300 leading-relaxed mb-4">
              Với trang thiết bị hiện đại, không gian tập luyện truyền cảm hứng
              và đội ngũ huấn luyện viên chuyên nghiệp, tận tâm, GymTech cam kết
              mang đến trải nghiệm tập luyện tốt nhất cho mọi thành viên, bất kể
              mục tiêu hay trình độ.
            </p>
            <p class="text-lg text-gray-300 leading-relaxed">
              Chúng tôi tự hào là đối tác tin cậy trên hành trình chinh phục sức
              khỏe của bạn, với các chương trình tập luyện đa dạng, phù hợp với
              mọi lứa tuổi và thể trạng. Tại GymTech, bạn sẽ tìm thấy sự hỗ trợ
              và động lực cần thiết để vượt qua mọi giới hạn.
            </p>
          </div>
          <div
            class="relative rounded-xl overflow-hidden shadow-2xl border border-red-800/30"
          >
            <img
              src="https://images.pexels.com/photos/841130/pexels-photo-841130.jpeg"
              alt="About GymTech"
              class="w-full h-auto object-cover transform transition-transform duration-500 hover:scale-105"
            />
            <div class="absolute inset-0 bg-black opacity-30"></div>
          </div>
        </div>
      </div>
    </section>

    <!-- Mission & Vision Section -->
    <section class="py-16 bg-black">
      <div class="container mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
          <div
            class="card bg-gray-900 rounded-xl shadow-xl border border-red-800/30 p-8 text-center transform transition-all duration-300 hover:scale-[1.02] hover:shadow-2xl hover:shadow-red-900/50"
          >
            <i class="fas fa-bullseye text-red-500 text-5xl mb-6"></i>
            <h3 class="text-3xl font-extrabold text-white mb-4">
              Sứ mệnh của chúng tôi
            </h3>
            <p class="text-lg text-gray-300 leading-relaxed mb-4">
              Sứ mệnh của chúng tôi là truyền cảm hứng và trao quyền cho mọi
              người để họ đạt được phiên bản tốt nhất của chính mình thông qua
              thể dục, dinh dưỡng và một lối sống lành mạnh. Chúng tôi nỗ lực
              tạo ra một môi trường hỗ trợ, tích cực và đầy động lực.
            </p>
            <p class="text-lg text-gray-300 leading-relaxed">
              Chúng tôi cam kết cung cấp các giải pháp tập luyện tiên tiến, khoa
              học, giúp mỗi cá nhân khai phá tối đa tiềm năng thể chất và tinh
              thần, từ đó nâng cao chất lượng cuộc sống.
            </p>
          </div>
          <div
            class="card bg-gray-900 rounded-xl shadow-xl border border-red-800/30 p-8 text-center transform transition-all duration-300 hover:scale-[1.02] hover:shadow-2xl hover:shadow-red-900/50"
          >
            <i class="fas fa-eye text-red-500 text-5xl mb-6"></i>
            <h3 class="text-3xl font-extrabold text-white mb-4">
              Tầm nhìn của chúng tôi
            </h3>
            <p class="text-lg text-gray-300 leading-relaxed mb-4">
              Chúng tôi hình dung GymTech là trung tâm thể hình hàng đầu, được
              công nhận về sự xuất sắc trong việc cung cấp các chương trình tập
              luyện cá nhân hóa, đổi mới và tạo ra một tác động tích cực lâu dài
              đến sức khỏe cộng đồng.
            </p>
            <p class="text-lg text-gray-300 leading-relaxed">
              Trở thành biểu tượng của lối sống năng động, khỏe mạnh, nơi mọi
              người tìm thấy niềm vui và sự bền bỉ trong hành trình rèn luyện
              bản thân, góp phần xây dựng một xã hội khỏe mạnh hơn.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- New Section: Facilities and Classes -->
    <section
      class="py-16 bg-gray-900 border-t border-red-700/50 shadow-inner shadow-red-900/20"
    >
      <div class="container mx-auto px-6 lg:px-8">
        <h2
          class="text-4xl font-extrabold text-red-400 text-center mb-12 custom-text-shadow"
        >
          Khám phá thêm về GymTech
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
          <!-- Card: Cơ sở vật chất hiện đại -->
          <div
            class="card bg-gray-800 rounded-xl shadow-lg border border-red-800/30 p-8 text-center transform transition-all duration-300 hover:scale-[1.02] hover:shadow-xl hover:shadow-red-900/50"
          >
            <i class="fas fa-dumbbell text-red-500 text-5xl mb-6"></i>
            <h3 class="text-3xl font-extrabold text-white mb-4">
              Cơ sở vật chất hiện đại
            </h3>
            <p class="text-lg text-gray-300 leading-relaxed">
              Chúng tôi tự hào sở hữu hệ thống máy móc, thiết bị tập luyện tiên
              tiến nhất, được nhập khẩu từ các thương hiệu hàng đầu thế giới,
              đảm bảo an toàn và hiệu quả tối đa cho mọi bài tập. Mỗi khu vực
              đều được thiết kế tối ưu để mang lại trải nghiệm tập luyện thoải
              mái và hiệu quả nhất.
            </p>
          </div>
          <!-- Card: Đa dạng các lớp học -->
          <div
            class="card bg-gray-800 rounded-xl shadow-lg border border-red-800/30 p-8 text-center transform transition-all duration-300 hover:scale-[1.02] hover:shadow-xl hover:shadow-red-900/50"
          >
            <i class="fas fa-running text-red-500 text-5xl mb-6"></i>
            <h3 class="text-3xl font-extrabold text-white mb-4">
              Đa dạng các lớp học
            </h3>
            <p class="text-lg text-gray-300 leading-relaxed">
              Từ Yoga, Zumba, đến HIIT và Boxing, GymTech cung cấp hàng loạt các
              lớp học nhóm sôi động, phù hợp với mọi sở thích và mục tiêu, được
              hướng dẫn bởi các huấn luyện viên giàu kinh nghiệm. Lịch học linh
              hoạt, phù hợp với mọi lịch trình bận rộn.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- New Section: Unique Selling Points / Why Choose Us -->
    <section
      class="py-16 bg-black border-t border-red-700/50 shadow-inner shadow-red-900/20"
    >
      <div class="container mx-auto px-6 lg:px-8">
        <h2
          class="text-4xl font-extrabold text-red-400 text-center mb-12 custom-text-shadow"
        >
          Tại sao chọn GymTech?
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
          <!-- Card 1: Hỗ trợ cá nhân hóa -->
          <div
            class="card bg-gray-900 rounded-xl shadow-xl border border-red-800/30 p-8 text-center transform transition-all duration-300 hover:scale-[1.02] hover:shadow-2xl hover:shadow-red-900/50"
          >
            <i class="fas fa-user-friends text-red-500 text-5xl mb-6"></i>
            <h3 class="text-3xl font-extrabold text-white mb-4">
              Hỗ trợ cá nhân hóa
            </h3>
            <p class="text-lg text-gray-300 leading-relaxed">
              Mỗi hội viên đều nhận được sự quan tâm đặc biệt. Chúng tôi thiết
              kế chương trình tập luyện và dinh dưỡng riêng biệt, đảm bảo phù
              hợp với thể trạng và mục tiêu cá nhân của bạn.
            </p>
          </div>
          <!-- Card 2: Môi trường truyền cảm hứng -->
          <div
            class="card bg-gray-900 rounded-xl shadow-xl border border-red-800/30 p-8 text-center transform transition-all duration-300 hover:scale-[1.02] hover:shadow-2xl hover:shadow-red-900/50"
          >
            <i class="fas fa-fire-alt text-red-500 text-5xl mb-6"></i>
            <h3 class="text-3xl font-extrabold text-white mb-4">
              Môi trường truyền cảm hứng
            </h3>
            <p class="text-lg text-gray-300 leading-relaxed">
              Không gian rộng rãi, thoáng đãng, cùng với âm nhạc sôi động và
              cộng đồng hội viên năng động, tạo nên một môi trường lý tưởng để
              bạn duy trì động lực và vượt qua giới hạn.
            </p>
          </div>
          <!-- Card 3: Tiện ích đa dạng -->
          <div
            class="card bg-gray-900 rounded-xl shadow-xl border border-red-800/30 p-8 text-center transform transition-all duration-300 hover:scale-[1.02] hover:shadow-2xl hover:shadow-red-900/50"
          >
            <i class="fas fa-spa text-red-500 text-5xl mb-6"></i>
            <h3 class="text-3xl font-extrabold text-white mb-4">
              Tiện ích đa dạng
            </h3>
            <p class="text-lg text-gray-300 leading-relaxed">
              Ngoài khu vực tập luyện chính, chúng tôi còn có phòng xông hơi,
              massage thư giãn, quầy bar dinh dưỡng và cửa hàng đồ tập, đáp ứng
              mọi nhu cầu của bạn sau buổi tập.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Values Section -->
    <section
      class="py-16 bg-gray-900 border-t border-red-700/50 shadow-inner shadow-red-900/20"
    >
      <div class="container mx-auto px-6 lg:px-8">
        <h2
          class="text-4xl font-extrabold text-red-400 text-center mb-12 custom-text-shadow"
        >
          Giá trị cốt lõi
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
          <div class="text-center">
            <i class="fas fa-medal text-red-500 text-6xl mb-6"></i>
            <h3 class="text-2xl font-bold text-white mb-3">Chuyên nghiệp</h3>
            <p class="text-md text-gray-400 leading-relaxed">
              Đội ngũ huấn luyện viên được chứng nhận và có kinh nghiệm, luôn
              cập nhật kiến thức mới nhất để mang lại hiệu quả tối ưu.
            </p>
          </div>
          <div class="text-center">
            <i class="fas fa-heart text-red-500 text-6xl mb-6"></i>
            <h3 class="text-2xl font-bold text-white mb-3">Tận tâm</h3>
            <p class="text-md text-gray-400 leading-relaxed">
              Chúng tôi lắng nghe và thấu hiểu nhu cầu của từng thành viên, đồng
              hành cùng bạn trên mọi chặng đường để đạt được mục tiêu.
            </p>
          </div>
          <div class="text-center">
            <i class="fas fa-lightbulb text-red-500 text-6xl mb-6"></i>
            <h3 class="text-2xl font-bold text-white mb-3">Đổi mới</h3>
            <p class="text-md text-gray-400 leading-relaxed">
              Luôn tìm kiếm và áp dụng các phương pháp tập luyện, công nghệ và
              dịch vụ mới nhất để nâng cao trải nghiệm của bạn.
            </p>
          </div>
          <div class="text-center">
            <i class="fas fa-users text-red-500 text-6xl mb-6"></i>
            <h3 class="text-2xl font-bold text-white mb-3">Cộng đồng</h3>
            <p class="text-md text-gray-400 leading-relaxed">
              Xây dựng một môi trường thân thiện, gắn kết, nơi mọi người cùng
              chia sẻ đam mê, hỗ trợ lẫn nhau để cùng tiến bộ.
            </p>
          </div>
          <div class="text-center">
            <i class="fas fa-spa text-red-500 text-6xl mb-6"></i>
            <h3 class="text-2xl font-bold text-white mb-3">Toàn diện</h3>
            <p class="text-md text-gray-400 leading-relaxed">
              Tập trung vào sức khỏe tổng thể, kết hợp hài hòa giữa tập luyện,
              dinh dưỡng và tinh thần để đạt được sự cân bằng hoàn hảo.
            </p>
          </div>
          <div class="text-center">
            <i class="fas fa-shield-alt text-red-500 text-6xl mb-6"></i>
            <h3 class="text-2xl font-bold text-white mb-3">An toàn</h3>
            <p class="text-md text-gray-400 leading-relaxed">
              Đảm bảo môi trường tập luyện an toàn tuyệt đối với thiết bị được
              bảo trì thường xuyên và quy trình phòng ngừa chấn thương nghiêm
              ngặt.
            </p>
          </div>
          <div class="text-center">
            <i class="fas fa-trophy text-red-500 text-6xl mb-6"></i>
            <h3 class="text-2xl font-bold text-white mb-3">Hiệu quả</h3>
            <p class="text-md text-gray-400 leading-relaxed">
              Mọi chương trình và dịch vụ đều được thiết kế dựa trên khoa học,
              nhằm mang lại kết quả rõ rệt và bền vững cho hội viên.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Call to Action Section -->
    <section
      class="py-20 bg-gradient-to-r from-red-950 to-black text-white text-center"
    >
      <div class="container mx-auto px-6">
        <h2 class="text-4xl md:text-5xl font-extrabold mb-6 custom-text-shadow">
          Sẵn sàng bắt đầu hành trình của bạn?
        </h2>
        <p class="text-xl text-gray-300 mb-10 max-w-2xl mx-auto">
          Tham gia GymTech ngay hôm nay để trải nghiệm sự khác biệt và đạt được
          mục tiêu sức khỏe của bạn.
        </p>
        <NuxtLink
          to="/dang-ky-goi-tap"
          class="btn btn-primary bg-red-600 hover:bg-red-700 border-red-600 hover:border-red-700 text-white font-bold text-lg px-8 py-4 rounded-full shadow-lg transform transition-transform duration-200 hover:scale-105 pulse-red"
        >
          Đăng ký ngay
        </NuxtLink>
      </div>
    </section>
  </div>
  <ContactFrom />
</template>

<script setup>
import { useCustomSeoMeta } from "~/composables/useCustomSeoMeta";

useCustomSeoMeta({
  title: "Giới Thiệu Về GymTech",
  description:
    "Tìm hiểu về sứ mệnh, đội ngũ và giá trị mà GymTech mang lại cho hội viên.",
  image: "https://gymtech.vn/images/about.jpg",
  url: "https://gymtech.vn/gioi-thieu",
  keywords:
    "giới thiệu gym, phòng gym GymTech, trung tâm thể hình, giá trị cốt lõi",
});
</script>

<style scoped>
/* Custom text shadow for hero heading */
.custom-hero-text-shadow {
  text-shadow: 0 0 25px rgba(239, 68, 68, 0.9), 0 0 40px rgba(239, 68, 68, 0.7);
}

.pulse-red {
  animation: pulse-red-effect 2s infinite;
}

@keyframes pulse-red-effect {
  0% {
    box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
  }
  70% {
    box-shadow: 0 0 0 15px rgba(239, 68, 68, 0);
  }
  100% {
    box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
  }
}

/* Custom text shadow for general headings */
.custom-text-shadow {
  text-shadow: 0 0 20px rgba(239, 68, 68, 0.8), 0 0 30px rgba(239, 68, 68, 0.6);
}
</style>

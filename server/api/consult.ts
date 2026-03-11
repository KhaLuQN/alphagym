import { GoogleGenerativeAI } from "@google/generative-ai";

const genAI = new GoogleGenerativeAI("AIzaSyAy2W1xSvxXqSjUoX7omxi97HiFC4hglQ0");

const packageList = `
1. Gói Slim Fit (Giảm cân): 3 buổi/tuần, 1 tháng, 1.500.000đ
2. Gói Muscle Up (Tăng cơ): 5 buổi/tuần, 3 tháng, 4.000.000đ
3. Gói Yoga Balance: 2 buổi/tuần, 2 tháng, 2.000.000đ
`;

const trainerList = `
1. PT Huy: Nam, chuyên về tăng cơ, 5 năm kinh nghiệm
2. PT Linh: Nữ, chuyên giảm cân và yoga, nhẹ nhàng, hỗ trợ tâm lý tốt
3. PT Dũng: Nam, chuyên thể hình chuyên sâu, phù hợp người tập nghiêm túc
`;

export default defineEventHandler(async (event) => {
  const body = await readBody(event);

  const {
    name,
    gender,
    age,
    height,
    weight,
    goal,
    weekly_sessions,
    goal_time,
    activity_level,
  } = body;

  const prompt = `
Bạn là một chuyên gia thể hình chuyên nghiệp tại phòng gym.

Khách hàng có thông tin sau:
- Họ tên: ${name}
- Giới tính: ${gender}
- Tuổi: ${age}
- Chiều cao: ${height} cm
- Cân nặng: ${weight} kg
- Mục tiêu tập luyện: ${goal}
- Số buổi có thể tập trong tuần: ${weekly_sessions}
- Mong muốn đạt được mục tiêu trong: ${goal_time} (tuần/tháng)
- Mức độ vận động hiện tại: ${activity_level} (Thấp / Trung bình / Cao)

Dựa vào thông tin trên, hãy trả lời theo đúng các phần sau:

---

**1. Đánh giá thể trạng hiện tại:**  
- Tính toán BMI nếu đủ dữ liệu.  
- Đánh giá mức độ sức khỏe thể chất hiện tại.  

**2. Phân tích mục tiêu và tính khả thi:**  
- Với số buổi tập là ${weekly_sessions} buổi/tuần, khách hàng có thể đạt được mục tiêu trong khoảng bao lâu?  
- Mục tiêu ${goal} có khả thi không nếu chỉ tập được như trên?  

**3. Loại hình luyện tập & gợi ý lịch tập:**  
- Nên chọn loại hình tập luyện nào là chính (cardio, gym, yoga...)?  
- Gợi ý lịch tập mẫu theo tuần (chỉ gợi ý, không ép buộc).  

**4. Gợi ý chế độ dinh dưỡng:**  
- Thực đơn tổng quát.  
- Gợi ý thực phẩm nên ăn và nên tránh.  

**5. Lời khuyên thêm:**  
- Lời động viên hoặc khuyến khích.  
- Nhấn mạnh yếu tố kiên trì, nghỉ ngơi hoặc gặp huấn luyện viên nếu cần. 

Danh sách gói tập hiện có:
${packageList}

Danh sách PT:
${trainerList}

---

Hãy tư vấn:

1. Gói tập phù hợp  với khách hàng và lý do.
2. nếu không thấy gói nào phù hợp thì vẫn tư vấn gói phù hợp như tăng 7kg thì cứ tư vấn gói tăng cơ .
3. Gợi ý huấn luyện viên phù hợp nhất, kèm lý do.
---

Trả lời ngắn gọn, dễ hiểu, chia mục rõ ràng như yêu cầu. Không dùng từ ngữ chuyên môn quá phức tạp. Viết bằng tiếng Việt, tối đa 200-300 từ.
`;

  const model = genAI.getGenerativeModel({ model: "gemini-1.5-flash" });

  const result = await model.generateContent(prompt);
  const response = await result.response;
  const text = await response.text();

  return { message: text };
});

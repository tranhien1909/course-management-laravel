<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    span {
        font-size: 1.2rem;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        background-color: white;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .header {
        text-align: center;
        padding: 20px 0;
        border-bottom: 1px solid #eee;
    }

    .col-md-8 {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    .course-title {
        margin-top: 20px;
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #2c3e50;
    }

    .rating {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 10px;
    }

    .stars {
        color: #f39c12;
        font-size: 18px;
        margin-right: 10px;
    }

    .students {
        color: #7f8c8d;
        font-size: 14px;
    }

    .highlights {
        padding: 20px 0;
        border-bottom: 1px solid #eee;
        justify-items: start;
    }

    .highlight-item {
        margin-bottom: 10px;
        padding-left: 20px;
        position: relative;
        text-align: left;
    }

    .course-sidebar {
        position: absolute;
        z-index: 9;
        right: 0;
        top: 60px;
        /* Khoảng cách từ top khi bám dính */
        background-color: white;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .tabs {
        display: flex;
        justify-content: space-around;
        padding: 15px 0;
        border-bottom: 1px solid #eee;
    }

    .tab {
        cursor: pointer;
        font-weight: 500;
    }

    .tab:hover {
        color: #e74c3c;
    }

    .outcomes {
        padding: 20px 0;
        border-bottom: 1px solid #eee;
    }

    .outcome-title {
        font-weight: bold;
        margin-bottom: 15px;
        color: #2c3e50;
    }

    .outcome-item {
        margin-bottom: 10px;
        padding-left: 20px;
        position: relative;
    }

    .outcome-item:before {
        content: "✓";
        position: absolute;
        left: 0;
        color: #27ae60;
        font-weight: bold;
    }

    .brand img {
        object-fit: cover;
        width: 100%;
        height: auto;

    }

    .price-section {
        text-align: center;
        padding: 20px 0;
        background-color: #f8f9fa;
        margin: 20px 0;
        border-radius: 5px;
    }

    .price-section h3 {
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: .5rem;
        line-height: 1.4;
    }

    .sale-price {
        font-size: 28px;
        font-weight: bold;
        color: #e74c3c;
    }

    .original-price {
        text-decoration: line-through;
        color: #7f8c8d;
        font-size: 1rem;
    }

    .discount {
        color: #27ae60;
        font-weight: bold;
        font-size: 1rem;
    }

    .cta-button {
        display: block;
        background-color: #2b91da;
        color: white;
        text-align: center;
        padding: 15px;
        font-weight: bold;
        border-radius: 5px;
        text-decoration: none;
        margin: 20px 0;
        transition: background-color 0.3s;
    }

    .cta-button:hover {
        background-color: #c0392b;
    }

    .free-trial {
        text-align: center;
        color: #7f8c8d;
        margin-bottom: 20px;
    }

    .stats .row {
        margin-bottom: 10px;
        align-items: center;
        margin-left: 20px;
    }


    .stats i {
        font-size: 1.5rem;
        color: rgb(28, 77, 224);
    }

    .note {
        padding: 15px 20px;
        font-size: 14px;
        color: #666;
        border-bottom: 1px solid #eee;
    }

    .form-section {
        padding: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
    }

    label.required:after {
        content: "*";
        color: #e74c3c;
        margin-left: 3px;
    }

    input {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
    }

    /* CSS cho form container */
    .form-container {
        /* Thêm thanh cuộn */
        max-height: 90vh;
        /* Giới hạn chiều cao tối đa */

        overflow-y: auto;
        /* Tự động hiển thị thanh cuộn khi cần */
        scrollbar-width: thin;
        /* Cho Firefox */
        scrollbar-color: #171ad8 #f5f5f5;
        /* Màu thanh cuộn */
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 90%;
        max-width: 600px;
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        z-index: 1000;
    }

    /* Tùy chỉnh thanh cuộn cho Chrome/Safari/Edge */
    #pay::-webkit-scrollbar {
        width: 8px;
    }

    /* Overlay làm mờ nền */
    .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }

    /* Nút đóng */
    .closebtn {
        position: absolute;
        top: 10px;
        right: 10px;
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
        color: #666;
    }

    .closebtn:hover {
        color: #e74c3c;
    }

    /* Hiệu ứng khi form hiển thị */
    .form-container.active,
    .overlay.active {
        display: block;
    }
</style>
<div class="overlay"></div>

<div class="container">
    <div class="header">
        <div class="row">
            <div class="overlay" id="overlay" onclick="toggleForm()"></div>
            <div class="col-12 col-md-8">
                <div class="course-title">{{ $course->course_name }} [Mã khoá học: {{ $course->id }}]</div>
                <div class="rating">
                    <div class="stars">5.0 ★★★★★</div>
                    <div class="students">(260 Đánh giá) 36,603 Học viên</div>
                </div>
                <div class="highlights">
                    <div class="highlight-item" style="white-space: pre-line;">{{ $course->description }}</div>
                    {{-- <div class="highlight-item">✅ Bộ 1200 từ vựng TOEIC 99% sẽ xuất hiện trong bài thi TOEIC và 17 chủ
                        đề ngữ pháp
                        quan trọng nhất</div>
                    <div class="highlight-item">✅ Bài giảng ngữ pháp và phương pháp làm tất cả các dạng câu hỏi TOEIC
                        Reading và
                        Listening</div>
                    <div class="highlight-item">✅ Hơn 20.000 câu hỏi thác nghiệm chuẩn format thi thật TOEIC form
                        2024, có giải
                        thích chi tiết</div>
                    <div class="highlight-item">✅ Giải quyết triệt để các vấn đề thường gặp khi nghe bằng phương pháp
                        nghe chép
                        chính tả</div>
                    <div class="highlight-item"> ✅ Tặng kèm khoá Luyện nghe nói tiếng Anh cùng Ted Talks trị giá 599k
                    </div> --}}
                </div>
            </div>

            <div class="col-12 col-md-4">
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-12 col-md-8">
            <div class="tabs">
                <div class="tab">Mục tiêu khoá học</div>
                <div class="tab">Thông tin khoá học</div>
                <div class="tab">Đánh giá</div>
            </div>
        </div>

        <div class="col-12 col-md-4">
        </div>
    </div>


    <div class="row">
        <div class="col-12 col-md-8">
            <div class="outcomes">
                <div class="outcome-title">Bạn sẽ đạt được gì sau khoá học?</div>
                <div class="outcome-item">Có nền tảng ngữ pháp vững chắc và xây dựng vốn từ vựng 99% sẽ xuất hiện
                    trong bài
                    thi TOEIC</div>
                <div class="outcome-item">Cải thiện kỹ năng nghe, khắc phục các vấn đề khi nghe như miss thông tin,
                    âm nối,
                    tốc độ nói nhanh</div>
                <div class="outcome-item">Nắm vững cách làm tất cả các dạng câu hỏi trong bài thi TOEIC Listening và
                    Reading
                </div>
            </div>

            <div class="content">

            </div>
        </div>

        <div class="col-12 col-md-4 course-sidebar">
            <div class="brand">
                <img src="{{ asset('storage/' . $course->image) }}" class='course-img' alt='Ảnh khóa học'>
            </div>

            <div class="price-section">
                <h3>Ưu đãi đặc biệt tháng {{ now()->format('m/Y') }}:</h3>
                <div class="row" style="margin: 10px 0;">
                    <div class="col-md-7 text-success" style="font-size: 2.1rem; font-weight: 600;">
                        {{ number_format($course->price, 0, ',', '.') }} đ</div>
                    <div class="col-md-5">
                        <span class="original-price row">{{ number_format($course->price, 0, ',', '.') }}
                            đ</span>
                        <span class="discount row text-danger">Tiết kiệm: 0.000đ (- 0%)</span>
                    </div>
                </div>

            </div>

            <a href="#" class="cta-button">ĐĂNG KÝ HỌC NGAY</a>

            <div class="stats">
                <div class="row">
                    <div class="col-md-1"><i class="fa-solid fa-users"></i></div>
                    <div class="col-md-11">36.603 học viên đã đăng ký</div>
                </div>

                <div class="row">
                    <div class="col-md-1"><i class="fa-solid fa-circle-play"></i></div>
                    <div class="col-md-11">50.0 giờ bài học</div>
                </div>

                <div class="row">
                    <div class="col-md-1"><i class="fa-solid fa-book-open"></i></div>
                    <div class="col-md-11">10 chủ đề: 188 bài học</div>
                </div>

                <div class="row">
                    <div class="col-md-1"><i class="fa-solid fa-pencil"></i></div>
                    <div class="col-md-11">51.4 bài tập thực hành</div>
                </div>

            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-8">
            <div class="highlights">
                <div class="outcome-title">Chương trình học được biên soạn và giảng dạy bởi:</div>
                <div class="highlight-item">✅ Ms. Phuong Nguyen, Macalester College, USA. TOEFL 114, IELTS 8.0, SAT
                    2280, GRE Verbal 165/170</div>
                <div class="highlight-item">✅ Ms. Phuong Le, HANU, IELTS 8.0 (Listening 8.5, Reading 8.5)</div>
                <div class="highlight-item">✅ Ms. Uyen Tran, FTU. IELTS 8.0 (Listening 8.5, Reading 8.5)</div>

            </div>

        </div>

        <div class="col-12 col-md-4">
        </div>
    </div>

    <div class="form-container" id="pay">
        <button class="closebtn" onclick="toggleForm()">X</button>
        <h2 class="text-center" style="font-weight:bold;">Mua Khoá Học {{ $course->course_name }} [Mã khoá học:
            {{ $course->id }}]</h2>
        <div class="promo-section">
            <div class=" text-center text-success" style="font-size: 1.8rem; font-weight:400;">Ưu đãi đặc biệt tháng
                {{ now()->format('m/Y') }}:</div>

            <div class="text-danger text-center" style="font-size: 1.8rem; font-weight:400;">699.000đ</div>

        </div>
        {{-- Hiển thị thông báo thành công --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('course.store') }}" enctype="multipart/form-data" id="courseForm">
            @csrf
            <div class="note">
                Vui lòng kiểm tra kỹ số điện thoại để có thể nhận mã kích hoạt gửi về SMS.
            </div>

            <div class="form-section">
                <div class="form-group">
                    <label for="fullname" class="required">Họ tên</label>
                    <input type="text" name="fullname" id="fullname" placeholder="Nhập họ và tên">
                </div>

                <div class="form-group">
                    <label for="phone" class="required">Số điện thoại</label>
                    <input type="tel" name="phone" id="phone" placeholder="Nhập số điện thoại">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Nhập email (nếu có)">
                </div>

                <button class="cta-button" style="width: 100%;">ĐÃ THANH TOÁN</button>

            </div>
        </form>
        <div class="bank-transfer-section" style="margin-top: 20px; border-top: 1px dashed #ddd; padding-top: 20px;">
            <h4 style="color: #e74c3c; margin-bottom: 15px;">THÔNG TIN CHUYỂN KHOẢN NGÂN HÀNG</h4>

            <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 15px;">
                <div style="display: flex; align-items: center; margin-bottom: 10px;">
                    <img src="https://inkythuatso.com/uploads/thumbnails/800/2021/11/mb-bank-logo-inkythuatso-01-10-09-02-50.jpg"
                        alt="MB Logo" style="height: 30px; margin-right: 10px;">
                    <h5 style="margin: 0;">Ngân hàng MB - Ngân hàng TMCP Quân Đội</h5>
                </div>

                <div style="margin-left: 40px;">
                    <p><strong>Chủ TK:</strong> Trần Thị Thanh Hiền</p>
                    <p><strong>Số TK:</strong> 039 575 1903</p>
                    <p><strong>Nội dung CK:</strong>
                        <span id="transferContent" style="color: #e74c3c; font-weight: bold;">[Tên] + [SĐT] + [Email]
                            + [Mã Khoá Học]</span>
                    </p>
                </div>

                <div style="text-align: center; margin: 15px 0;">
                    <p style="margin-bottom: 10px;">Hoặc quét mã QR sau:</p>
                    <img src="{{ asset('backend/img/qrthanhtoan.png') }}" alt="QR Code ACB"
                        style="max-width: 200px; border: 1px solid #ddd;">
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    // Hàm toggle hiển thị form
    function toggleForm() {
        const form = document.getElementById('pay');
        const overlay = document.querySelector('.overlay');

        form.classList.toggle('active');
        overlay.classList.toggle('active');
    }

    // Thêm overlay vào body
    document.body.insertAdjacentHTML('beforeend', '<div class="overlay" onclick="toggleForm()"></div>');

    // Gán sự kiện click cho nút đăng ký
    document.querySelector('.cta-button').addEventListener('click', function(e) {
        e.preventDefault();
        toggleForm();
    });
</script>

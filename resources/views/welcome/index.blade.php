@include('welcome.banner')
<div class="overlay" id="overlay" onclick="toggleForm()"></div>

<!-- about section starts -->
<section class="about" id="about">
    <h1 class="heading"><span>about</span> us</h1>
    <div class="row">
        <div class="video-container">
            <video src="backend/img/why.mp4" loop autoplay muted></video>
            <h3>best English center</h3>
        </div>

        <div class="content">
            <h3>why choose us?</h3>
            <p><strong style="font-size: 1.4rem; color:black;">Chương trình học đa dạng:</strong> SMART cung cấp các
                khóa
                học phù hợp với mọi trình độ, từ cơ
                bản đến nâng cao,
                bao gồm tiếng Anh giao tiếp, luyện thi IELTS/TOEIC, tiếng Anh cho trẻ em và doanh nghiệp.</p>
            <p><strong style="font-size: 1.4rem; color:black;">Phương pháp giảng dạy tương tác:</strong> Ứng dụng công
                nghệ AI, học qua dự án (Project-based
                Learning) và mô hình
                lớp học "Blended Learning" giúp học viên tiếp thu kiến thức một cách chủ động.</p>
            <p><strong style="font-size: 1.4rem; color:black;">Cam kết đầu ra:</strong> Hỗ trợ học lại miễn phí nếu
                không đạt mục tiêu, cùng các buổi thi thử và
                đánh giá định
                kỳ.</p>

        </div>
    </div>
</section>
<!-- about section ends -->

<!-- icons section starts -->
<section class="icons-container">
    <div class="icons">
        <i class="fa-solid fa-earth-americas"></i>
        <div class="info">
            <h3>Learn Anytime, Anywhere</h3>
            <span>Access the course from any device, anytime.</span>
        </div>
    </div>

    <div class="icons">
        <i class="fa-solid fa-route"></i>
        <div class="info">
            <h3>Personalized Pathway</h3>
            <span>The curriculum is tailored to your level and goals.</span>
        </div>
    </div>

    <div class="icons">
        <i class="fa-solid fa-graduation-cap"></i>
        <div class="info">
            <h3>Professional Instructors</h3>
            <span>A team of teachers with international certificates and many years of experience.</span>
        </div>
    </div>

    <div class="icons">
        <i class="fa-solid fa-school"></i>
        <div class="info">
            <h3>Free Study Materials</h3>
            <span>Provide free textbooks and exercises for students.</span>
        </div>
    </div>
</section>
<!-- icons section ends -->

<!-- products sections starts -->
<section class="products" id="products">
    <h1 class="heading"><span>courses</span></h1>
    <div class="box-container">
        @foreach ($courses as $course)
            <a href="{{ route('chitiet', $course->id) }}" class="box">
                <div>
                    <span class="discount text-danger">
                        - {{ $course->discount ?? '0' }}%
                    </span>
                    <div class="image">
                        <img src="{{ asset('storage/' . $course->image) ?? asset('backend/img/course_1.jpg') }}"
                            alt="Ảnh khoá học">
                    </div>

                    <div class="content">
                        <h3>{{ $course->course_name ?? 'Courses' }}</h3>
                        <div class="stars">★★★★★</div>
                        <div class="price">{{ number_format($course->price, 0, ',', '.') }}
                            <span>{{ number_format($course->price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    {{-- Nút xem thêm --}}
    <div class="box-container" style="justify-content: center; margin-top: 20px;">
        <a href="{{ route('cackhoahoc') }}" class="see-more-link">
            <i class="fas fa-arrow-right text-danger" style="font-size: 2rem"></i>
            <span class="text-danger" style="font-size: 2rem">Xem thêm</span>
        </a>
    </div>
</section>
<!-- products sections ends -->

<!-- review section starts -->
<section class="review" id="review">
    <h1 class="heading">student's <span>review</span></h1>
    <div class="box-container">
        <div class="box">
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <p>"Mình đã tăng 1.5 điểm IELTS chỉ sau 3 tháng nhờ lộ trình cá nhân hóa và sự hỗ trợ tận tình từ giáo viên
                tại SMART!"</p>
            <div class="user">
                <img src="https://images2.thanhnien.vn/zoom/686_429/528068263637045248/2023/2/6/edit-nguoi-dep-nguyen-thanh-ha-1675680175765990410434-90-0-1157-1707-crop-16756801988141842918415.png"
                    alt="">
                <div class="user-info">
                    <h3>Chị Nguyễn Thị Hà</h3>
                    <span>Học viên lớp IELTS</span>
                </div>
            </div>
            <span class="fas fa-quote-right"></span>
        </div>

        <div class="box">
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <p>"Các thầy cô rất vui tính, dạy dễ hiểu. Lớp học ít người nên mình được sửa lỗi chi tiết, tự tin nói tiếng
                Anh hơn hẳn."</p>
            <div class="user">
                <img src="https://kenh14cdn.com/203336854389633024/2021/9/30/photo-1-1632993460966307206405.png"
                    alt="">
                <div class="user-info">
                    <h3>Bạn Trần Minh Anh</h3>
                    <span>Học sinh cấp 3</span>
                </div>
            </div>
            <span class="fas fa-quote-right"></span>
        </div>

        <div class="box">
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <p>"I appreciate SMART’s professional approach. The business English course helped me improve my
                presentation skills significantly."</p>
            <div class="user">
                <img src="https://images.ctfassets.net/szez98lehkfm/10ecAFHwV8TykSpRliVwTC/047fb99405f70941eb07b5edd5d27e5e/MyIC_Inline_28632?fm=webp&w=500"
                    alt="">
                <div class="user-info">
                    <h3>Anh John Smith</h3>
                    <span>Khoá Toeic</span>
                </div>
            </div>
            <span class="fas fa-quote-right"></span>
        </div>
    </div>
</section>
<!-- review section ends -->

<!-- contact section starts -->
<section class="contact" id="contact">
    <h1 class="heading"><span>contact</span> us</h1>
    <div class="row">
        <form action="{{ route('consultations.store') }}" method="POST">
            @csrf
            <input type="text" name="fullname" id="" placeholder="Họ tên" class="box">
            <input type="email" name="email" id="" placeholder="Email" class="box">
            <input type="number" name="phone" id="" placeholder="Số điện thoại" class="box">
            <select name="course_interested" id="course_interested" class="box" required>
                <option value="" disabled selected>--Chọn khoá học cần tư vấn--</option>
                @foreach ($tuvans as $tuvan)
                    <option value="{{ $tuvan->id }}" {{ old('course_interested') == $tuvan->id ? 'selected' : '' }}>
                        {{ $tuvan->course_name }}</option>
                @endforeach
            </select>
            <textarea name="message" id="" placeholder="Nội dung tư vấn" cols="30" rows="10"
                class="box"></textarea>
            <input type="submit" value="send message" class="btn btn-success" style="font-size: 13px;">
        </form>

        <div class="image">
            <img src="backend/img/contact.jpg" alt="">
        </div>
    </div>
</section>
<!-- contact section ends -->

<script>
    document.querySelector('form').addEventListener('submit', function(e) {
        const phoneInput = document.getElementById('phone');
        const phoneRegex = /(84|0[3|5|7|8|9])+([0-9]{8})\b/;

        if (!phoneRegex.test(phoneInput.value)) {
            e.preventDefault();
            alert('Vui lòng nhập số điện thoại hợp lệ');
            phoneInput.focus();
        }
    });
</script>

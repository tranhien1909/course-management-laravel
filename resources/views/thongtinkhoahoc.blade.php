<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luận văn</title>

    <!-- Font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="backend/css/style-introduce.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Roboto", Tahoma, sans-serif;
            outline: none;
            border: none;
            text-decoration: none;
            text-transform: capitalize;
            transition: .2s linear;
            font-size: 14px;
        }

        a {
            text-decoration: none !important;
            color: black;
        }

        #home {
            margin-top: 100px
        }
    </style>

    <!-- header section starts -->
    <header>

        <input type="checkbox" name="toggle" id="toggle">
        <label for="toggle" class="fas fa-bars"></label>

        <a href="#" class="logo"><img src="{{ asset('backend/img/smart_logo_color.png') }}" alt=""
                style="width: 100px;"></a>
        <nav class="navbar">
            <a href="#home">home</a>
            <a href="#about">about</a>
            <a href="#products">courses</a>
            <a href="#review">review</a>
            <a href="#contact">contact</a>
        </nav>

        <div class="icons">
            <a href="{{ route('auth.admin') }}" class="fas fa-user"></a>

        </div>
    </header>
    <!-- header section ends -->

    <!-- home section starts -->
    <section class="home" id="home">
        <div class="container mt-5">
            <div class="row">
                <h3 class="fw-bold mb-3">KHOÁ HỌC: TOEIC MẤT GỐC</h3>
                <hr />

            </div>

            <div class="row mt-4">
                <!-- Cột trái: Video + mô tả -->
                <div class="col-md-8">
                    <div class="video-container mb-3">
                        <iframe width="100%" height="400" src="https://www.youtube.com/embed/dQw4w9WgXcQ"
                            title="Video bài giảng" frameborder="0" allowfullscreen>
                        </iframe>
                    </div>
                </div>

                <!-- Cột phải: Thông tin khóa học -->
                <div class="col-md-4">
                    <div class="card p-3 shadow-sm">
                        <h5 class="text-primary">Học trọn gói với</h5>
                        <h2 class="fw-bold text-danger">1.190.000 đ</h2>

                        <button class="btn btn-primary w-100">ĐĂNG KÝ NGAY</button>

                        <hr>

                        <h6><strong>Khóa học bao gồm:</strong></h6>
                        <ul>
                            <li>Bài giảng video chất lượng cao.</li>
                            <li>Bài tập thực hành theo từng chuyên đề.</li>
                            <li>Hỗ trợ giải đáp thắc mắc từ giáo viên.</li>
                        </ul>

                        <p class="text-muted"><strong>Thời gian học:</strong> Đến hết 31/07/2025</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <p>Gia tăng vốn từ vựng, nắm vững các kiến thức trọng tâm trong chương trình Tiếng Anh THPT với thầy
                    Nguyễn Trung Nguyên.</p>
                <p><strong>Giáo viên:</strong> <a href="#">Nguyễn Trung Nguyên</a></p>

                <h5><strong>Nội dung khóa học:</strong></h5>
                <ul>
                    <li>Nắm vững toàn bộ kiến thức cần thiết cho kỳ thi THPT.</li>
                    <li>Hệ thống bài giảng dễ hiểu, phù hợp với mọi trình độ.</li>
                    <li>Cung cấp bài tập thực hành kèm lời giải chi tiết.</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- home sections ends -->

    <!-- footer section starts -->
    <section class="footer" id="footer">
        <div class="container">
            <hr class="mt-3 mb-5">
            <div class="row">
                <!-- Cột 1: Dịch vụ khách hàng -->
                <div class="col-md-3">
                    <h4 class="fw-bold mb-5">VỀ SMART</h4>
                    <ul class="list-unstyled">
                        <li class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom"><a
                                href="#">Trang chủ</a></li>
                        <li class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom"><a
                                href="#">Giới thiệu</a></li>
                        <li class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom"><a
                                href="#">Khoá học</a></li>
                        <li class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom"><a
                                href="#">Review</a></li>
                        <li class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom"><a
                                href="#">Chính Sách Bảo Hành</a></li>
                    </ul>
                </div>

                <!-- Cột 2: Shopee Việt Nam -->
                <div class="col-md-3">
                    <h4 class="fw-bold mb-5">SHOPEE VIỆT NAM</h4>
                    <ul class="list-unstyled">
                        <li class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom"><a
                                href="#">Điều Khoản SMART</a></li>
                        <li class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom"><a
                                href="#">Chính Sách Bảo Mật</a></li>
                        <li class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom"><a
                                href="#">Tiếp Thị Liên Kết</a></li>
                        <li class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom"><a
                                href="#">Liên Hệ Truyền Thông</a></li>
                    </ul>
                </div>

                <!-- Cột 3: Thanh toán & Vận chuyển -->
                <div class="col-md-3">
                    <h4 class="fw-bold mb-5">THANH TOÁN</h4>
                    <ul class="list-unstyled">
                        <li class="d-flex justify-content-center justify-content-lg-between mb-3">
                            <div class="border shadow p-2">
                                <img src="https://down-vn.img.susercontent.com/file/d4bbea4570b93bfd5fc652ca82a262a8"
                                    alt="Visa">
                            </div>
                        </li>
                        <li class="d-flex justify-content-center justify-content-lg-between mb-3">
                            <div class="border shadow p-2">
                                <img src="https://down-vn.img.susercontent.com/file/a0a9062ebe19b45c1ae0506f16af5c16"
                                    alt="MasterCard">
                            </div>

                        </li>
                        <li class="d-flex justify-content-center justify-content-lg-between mb-3">
                            <div class="border shadow p-2">
                                <img src="https://down-vn.img.susercontent.com/file/38fd98e55806c3b2e4535c4e4a6c4c08"
                                    alt="JCB">
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Cột 4: Theo dõi & Tải ứng dụng -->
                <div class="col-md-3">
                    <h4 class="fw-bold mb-5">HỖ TRỢ KHÁCH HÀNG</h4>
                    <ul class="list-unstyled">
                        <li class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
                            <!-- Section: Social media -->
                            <!-- Facebook -->
                            <a data-mdb-ripple-init class="btn btn-outline btn-floating m-1" href="#!"
                                role="button"><i class="fab fa-facebook-f"></i></a>

                            <!-- Twitter -->
                            <a data-mdb-ripple-init class="btn btn-outline btn-floating m-1" href="#!"
                                role="button"><i class="fab fa-twitter"></i></a>

                            <!-- Google -->
                            <a data-mdb-ripple-init class="btn btn-outline btn-floating m-1" href="#!"
                                role="button"><i class="fab fa-google"></i></a>

                            <!-- Instagram -->
                            <a data-mdb-ripple-init class="btn btn-outline btn-floating m-1" href="#!"
                                role="button"><i class="fab fa-instagram"></i></a>

                            <!-- Linkedin -->
                            <a data-mdb-ripple-init class="btn btn-outline btn-floating m-1" href="#!"
                                role="button"><i class="fab fa-linkedin-in"></i></a>
                            <!-- Section: Social media -->
                        </li>
                        <li class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
                            <p>Địa chỉ: Lĩnh Nam, Hoàng Mai, Hà Nội</p>
                        </li>
                        <li class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
                            <p>SĐT: 039 575 1903</p>
                        </li>
                        <li class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
                            <p>Email: dhmt15a2hn@gmail.com</p>
                        </li>
                    </ul>

                </div>
            </div>
        </div>

        @include('backend.dashboard.component.footer')
    </section>
    <!-- footer section ends -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>

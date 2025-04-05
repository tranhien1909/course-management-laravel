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
        a {
            text-decoration: none;
            color: black;
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
    <section class="home" id="home"
        style="background: url('{{ asset('backend/img/banner.png') }}') no-repeat; background-size: cover; background-position: center; min-height: 100vh; display: flex; align-items: center;">
        <div class="content">
            <h3>smart english</h3>
            <span>uy tín & chất lượng</span>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt optio, placeat corporis ex nesciunt
                culpa repellendus necessitatibus cum laborum aliquid asperiores qui vel officia porro doloribus neque
                sint mollitia. Laborum.</p>
            <a href="#" class="btn">Đăng kí ngay</a>
        </div>
    </section>
    <!-- home sections ends -->

    <!-- about section starts -->
    <section class="about" id="about">
        <h1 class="heading"><span>about</span> us</h1>
        <div class="row">
            <div class="video-container">
                <video src="backend/img/why.mp4" loop autoplay muted></video>
                <h3>best sellers</h3>
            </div>

            <div class="content">
                <h3>why choose us?</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde fugiat, quas odio laborum neque nemo
                    sit ducimus molestiae enim. Ratione quidem assumenda provident quaerat ullam doloribus perspiciatis
                    numquam cupiditate ipsam.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis assumenda culpa magni quam nisi
                    nostrum neque laborum, natus consequuntur quasi. Fuga harum et eaque quia nesciunt aliquid ratione
                    eligendi veniam!</p>
                <a href="#" class="btn">learn more</a>

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
        <h1 class="heading">latest <span>products</span></h1>
        <div class="box-container">
            <div class="box">
                <span class="discount">
                    -10%
                </span>
                <div class="image">
                    <img src="backend/img/course_1.jpg" alt="">
                    <div class="icons">
                        <a href="#" class="fas fa-heart"></a>
                        <a href="#" class="cart-btn">Đăng ký ngay!</a>
                        <a href="#" class="fas fa-share"></a>
                    </div>
                </div>

                <div class="content">
                    <h3>courses</h3>
                    <div class="price">$12.99 <span>$15.99</span></div>
                </div>
            </div>

            <div class="box">
                <span class="discount">
                    -15%
                </span>
                <div class="image">
                    <img src="backend/img/course_1.jpg" alt="">
                    <div class="icons">
                        <a href="#" class="fas fa-heart"></a>
                        <a href="#" class="cart-btn">Đăng ký ngay!</a>
                        <a href="#" class="fas fa-share"></a>
                    </div>
                </div>

                <div class="content">
                    <h3>courses</h3>
                    <div class="price">$12.99 <span>$15.99</span></div>
                </div>
            </div>

            <div class="box">
                <span class="discount">
                    -5%
                </span>
                <div class="image">
                    <img src="backend/img/course_1.jpg" alt="">
                    <div class="icons">
                        <a href="#" class="fas fa-heart"></a>
                        <a href="#" class="cart-btn">Đăng ký ngay!</a>
                        <a href="#" class="fas fa-share"></a>
                    </div>
                </div>

                <div class="content">
                    <h3>courses</h3>
                    <div class="price">$12.99 <span>$15.99</span></div>
                </div>
            </div>

            <div class="box">
                <span class="discount">
                    -20%
                </span>
                <div class="image">
                    <img src="backend/img/course_1.jpg" alt="">
                    <div class="icons">
                        <a href="#" class="fas fa-heart"></a>
                        <a href="#" class="cart-btn">Đăng ký ngay!</a>
                        <a href="#" class="fas fa-share"></a>
                    </div>
                </div>

                <div class="content">
                    <h3>courses</h3>
                    <div class="price">$12.99 <span>$15.99</span></div>
                </div>
            </div>

            <div class="box">
                <span class="discount">
                    -25%
                </span>
                <div class="image">
                    <img src="backend/img/course_1.jpg" alt="">
                    <div class="icons">
                        <a href="#" class="fas fa-heart"></a>
                        <a href="#" class="cart-btn">Đăng ký ngay!</a>
                        <a href="#" class="fas fa-share"></a>
                    </div>
                </div>

                <div class="content">
                    <h3>courses</h3>
                    <div class="price">$12.99 <span>$15.99</span></div>
                </div>
            </div>

            <div class="box">
                <span class="discount">
                    -15%
                </span>
                <div class="image">
                    <img src="backend/img/course_1.jpg" alt="">
                    <div class="icons">
                        <a href="#" class="fas fa-heart"></a>
                        <a href="#" class="cart-btn">Đăng ký ngay!</a>
                        <a href="#" class="fas fa-share"></a>
                    </div>
                </div>

                <div class="content">
                    <h3>courses</h3>
                    <div class="price">$12.99 <span>$15.99</span></div>
                </div>
            </div>

            <div class="box">
                <span class="discount">
                    -15%
                </span>
                <div class="image">
                    <img src="backend/img/course_1.jpg" alt="">
                    <div class="icons">
                        <a href="#" class="fas fa-heart"></a>
                        <a href="#" class="cart-btn">Đăng ký ngay!</a>
                        <a href="#" class="fas fa-share"></a>
                    </div>
                </div>

                <div class="content">
                    <h3>courses</h3>
                    <div class="price">$12.99 <span>$15.99</span></div>
                </div>
            </div>

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
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam saepe velit sunt, iste placeat
                    omnis, beatae ipsa veniam eligendi dolores fugiat ea itaque voluptate. Voluptate cupiditate ipsa
                    quod enim atque!</p>
                <div class="user">
                    <img src="https://images2.thanhnien.vn/zoom/686_429/528068263637045248/2023/2/6/edit-nguoi-dep-nguyen-thanh-ha-1675680175765990410434-90-0-1157-1707-crop-16756801988141842918415.png"
                        alt="">
                    <div class="user-info">
                        <h3>Pham Mai</h3>
                        <span>Happy student</span>
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
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam saepe velit sunt, iste placeat
                    omnis, beatae ipsa veniam eligendi dolores fugiat ea itaque voluptate. Voluptate cupiditate ipsa
                    quod enim atque!</p>
                <div class="user">
                    <img src="https://images2.thanhnien.vn/zoom/686_429/528068263637045248/2023/2/6/edit-nguoi-dep-nguyen-thanh-ha-1675680175765990410434-90-0-1157-1707-crop-16756801988141842918415.png"
                        alt="">
                    <div class="user-info">
                        <h3>Pham Mai</h3>
                        <span>Happy student</span>
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
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam saepe velit sunt, iste placeat
                    omnis, beatae ipsa veniam eligendi dolores fugiat ea itaque voluptate. Voluptate cupiditate ipsa
                    quod enim atque!</p>
                <div class="user">
                    <img src="https://images2.thanhnien.vn/zoom/686_429/528068263637045248/2023/2/6/edit-nguoi-dep-nguyen-thanh-ha-1675680175765990410434-90-0-1157-1707-crop-16756801988141842918415.png"
                        alt="">
                    <div class="user-info">
                        <h3>Pham Mai</h3>
                        <span>Happy student</span>
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
            <form action="">
                <input type="text" name="" id="" placeholder="name" class="box">
                <input type="email" name="" id="" placeholder="email" class="box">
                <input type="number" name="" id="" placeholder="number" class="box">
                <textarea name="" id="" placeholder="message" cols="30" rows="10" class="box"></textarea>
                <input type="submit" value="send message" class="btn">
            </form>

            <div class="image">
                <img src="backend/img/contact.jpg" alt="">
            </div>
        </div>
    </section>
    <!-- contact section ends -->

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


</body>

</html>

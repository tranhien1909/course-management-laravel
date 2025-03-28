<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luận văn</title>

    <!-- Font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="backend/css/style-introduce.css">
</head>

<body>

    <!-- header section starts -->
    <header>

        <input type="checkbox" name="toggle" id="toggle">
        <label for="toggle" class="fas fa-bars"></label>

        <a href="#" class="logo">Smart <span>.</span></a>
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
                <h3>free delivery</h3>
                <span>on all orders</span>
            </div>
        </div>

        <div class="icons">
            <i class="fa-solid fa-graduation-cap"></i>
            <div class="info">
                <h3>10 days returns</h3>
                <span>on all orders</span>
            </div>
        </div>

        <div class="icons">
            <i class="fa-solid fa-microphone-lines"></i>
            <div class="info">
                <h3>free delivery</h3>
                <span>on all orders</span>
            </div>
        </div>

        <div class="icons">
            <i class="fa-solid fa-school"></i>
            <div class="info">
                <h3>free delivery</h3>
                <span>on all orders</span>
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
                        <a href="#" class="cart-btn">Tham gia ngay!</a>
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
                        <a href="#" class="cart-btn">Tham gia ngay!</a>
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
                        <a href="#" class="cart-btn">Tham gia ngay!</a>
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
                        <a href="#" class="cart-btn">Tham gia ngay!</a>
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
                        <a href="#" class="cart-btn">Tham gia ngay!</a>
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
                        <a href="#" class="cart-btn">Tham gia ngay!</a>
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
                        <a href="#" class="cart-btn">Tham gia ngay!</a>
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
        <h1 class="heading">customer's <span>review</span></h1>
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
        <div class="box-container">
            <div class="box">
                <h3>quick link</h3>
                <a href="#">home</a>
                <a href="#">about</a>
                <a href="#">courses</a>
                <a href="#">review</a>
                <a href="#">contact</a>
            </div>

            <div class="box">
                <h3>extra link</h3>
                <a href="#">my account</a>
                <a href="#">my order</a>
                <a href="#">courses</a>
                <a href="#">review</a>
                <a href="#">contact</a>
            </div>

            <div class="box">
                <h3>contact us</h3>
                <a href="#">address: Lĩnh Nam, Hoàng Mai, Hà Nội</a>
                <a href="#">phone number: 039 575 1903</a>
                <a href="#">email: dhmt15a2hn@gmail.com</a>
            </div>

            <div class="box">
                <h3>extra link</h3>
                <a href="#">my account</a>
                <a href="#">my order</a>
                <a href="#">courses</a>
                <a href="#">review</a>
                <a href="#">contact</a>
            </div>

        </div>
        <div class="credit">created by <span> smart english</span> | all right resever</div>
    </section>
    <!-- footer section ends -->


</body>

</html>

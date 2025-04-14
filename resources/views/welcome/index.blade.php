@include('welcome.banner')
<div class="overlay" id="overlay" onclick="toggleForm()"></div>

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
        @foreach ($courses as $course)
            <a href="{{ route('chitiet', $course->id) }}" class="box">
                <div>
                    <span class="discount text-danger">
                        - {{ $course->discount ?? '0' }}%
                    </span>
                    <div class="image">
                        <img src="{{ $course->image ?? asset('backend/img/course_1.jpg') }}" alt="Ảnh khoá học">
                    </div>

                    <div class="content">
                        <h3>{{ $course->course_name ?? 'Courses' }}</h3>
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

    <!-- products sections starts -->
    <section class="products" id="products">
        <div class="overlay" id="overlay" onclick="toggleForm()"></div>
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
    </section>
    <!-- products sections ends -->

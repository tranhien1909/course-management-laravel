@include('backend.dashboard.home.style-table')
<style>
    .card {
        margin-bottom: 20px;
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        justify-content: center;
    }

    .card-header {
        text-transform: uppercase;
        text-align: center;
        text-size: 30px;
        font-weight: bold;
        color: #0056b3;
    }
</style>

<div class="wrapper wrapper-content">
    <div class="row">

        <div class="ibox-content card">
            <div class="profile-image">
                <img src="{{ Auth::check() ? Auth::user()->avatar : 'Khách' }}" class="img-circle circle-border m-b-md"
                    alt="profile">
            </div>

            <div class="sidebar-sticky">
                <h2 class="mt-3"><strong>Hello, {{ Auth::check() ? Auth::user()->fullname : 'Khách' }} </strong>
                    <img src="https://www.svgrepo.com/show/433961/waving-hand.svg"
                        style="width: 35px; padding-bottom: 15px;" alt="">
                </h2>
                <p>Nice to have you back, what an exciting day!</p>
                <p>Get ready and continue your lesson today.</p>
            </div>
        </div>


        <div class="ibox-content card">
            <h2 class="card-header">
                Frofile
            </h2>
            <div class="col-12">
                <div class="card-body">
                    <p>Họ tên: <strong>{{ Auth::check() ? Auth::user()->fullname : 'N/A' }}</strong></p>
                    <p>Ngày sinh: <strong>{{ Auth::check() ? Auth::user()->birthday : 'N/A' }}</strong></p>
                    <p>Email: <strong>{{ Auth::check() ? Auth::user()->email : 'N/A' }}</strong></p>
                    <p>Phone: <strong>{{ Auth::check() ? Auth::user()->phone : 'N/A' }}</strong></p>
                </div>
            </div>
        </div>

        <a href="#">
            <div class="my-class" style="border-radius: 100px">
                <div class="ibox-content card">
                    <h2 class="card-header">
                        Công Nợ
                    </h2>
                    <div class="col-12">
                        <div class="ibox-content">
                            <div id="ct-chart6" class="ct-perfect-fourth"></div>
                        </div>
                    </div>
                </div>
            </div>
        </a>

    </div>


</div>

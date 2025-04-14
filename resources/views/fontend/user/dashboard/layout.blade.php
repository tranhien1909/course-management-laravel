<!DOCTYPE html>
<html>

<head>
    @include('backend.dashboard.component.head')
</head>

<body>
    <div id="wrapper">
        @include('fontend.user.dashboard.component.sidebar')

        <div id="page-wrapper" class="gray-bg">
            @include('fontend.user.dashboard.component.nav')

            @include($template)
            {{-- @include('backend.dashboard.home.qlgiangvien') --}}


            @include('backend.dashboard.component.footer')

        </div>
    </div>

    @include('fontend.user.dashboard.component.script')
</body>

</html>

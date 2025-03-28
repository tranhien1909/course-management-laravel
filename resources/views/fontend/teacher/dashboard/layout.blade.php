<!DOCTYPE html>
<html>

<head>
    @include('backend.dashboard.component.head')
</head>

<body>
    <div id="wrapper">
        @include('fontend.teacher.dashboard.component.sidebar')

        <div id="page-wrapper" class="gray-bg">
            @include('fontend.teacher.dashboard.component.nav')

            {{-- @include($template) --}}
            @include('backend.dashboard.home.qlgiangvien')

            @include('backend.dashboard.component.footer')

        </div>
    </div>

    @include('fontend.teacher.dashboard.component.script')
</body>

</html>

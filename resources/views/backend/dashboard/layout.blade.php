<!DOCTYPE html>
<html>

<head>
    @include('backend.dashboard.component.head')
</head>

<body>
    <div id="wrapper">
        @include('backend.dashboard.component.sidebar')
        {{-- @include('fontend.user.dashboard.component.sidebar') --}}
        {{-- @include('fontend.teacher.dashboard.component.sidebar') --}}


        <div id="page-wrapper" class="gray-bg">
            @include('backend.dashboard.component.nav')

            @include($template)
            {{-- @include('fontend.user.dashboard.home.index') --}}
            {{-- @include('fontend.teacher.dashboard.home.index') --}}
            {{-- @include('backend.dashboard.home.qlkhoahoc') --}}


            {{-- @include('backend.dashboard.home.qllophoc') --}}

            @include('backend.dashboard.component.footer')

        </div>
    </div>

    @include('backend.dashboard.component.script')
</body>

</html>

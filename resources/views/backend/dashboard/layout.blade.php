<!DOCTYPE html>
<html>

<head>
    @include('backend.dashboard.component.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

    <div id="wrapper">
        @include('backend.dashboard.component.sidebar')


        <div id="page-wrapper" class="gray-bg">
            @include('backend.dashboard.component.nav')

            @include($template)


            @include('backend.dashboard.component.footer')

        </div>
    </div>
    @flasher_render

    @include('backend.dashboard.component.script')

</body>

</html>

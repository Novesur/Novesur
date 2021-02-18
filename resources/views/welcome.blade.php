<!DOCTYPE html>
<html>
    @include('sections.head')
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper" id="app">

            @if (Auth::check())
            <App :usuario="{{Auth::user()}}"></App>
            @else
            <Auth></Auth>
            @endif

        </div>

        @include('sections.script')
    </body>
</html>

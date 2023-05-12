<!DOCTYPE html>
<html lang="en">
@include('frontend.layouts.header')
{{-- @include('frontend.layouts.firstsection') --}}
@include('frontend.layouts.leftsidebar')
@yield('content')
@include('frontend.layouts.rightsidebar')
@include('frontend.layouts.footer')
@yield('script')
</body>

</html>

<!DOCTYPE html>
<html lang="en">
    @include('user.human_resource.head')
<body>
    <!-- Back to top button -->
    <div class="back-to-top"></div>
    {{-- navbar section --}}
    @include('user.human_resource.header')
    <!-- .page-section -->
    @yield('page')
    <!-- .page-section -->

    <!-- .banner-footer -->
    @include('user.footer')
    
</body>
</html>

    {{-- Generic Script --}}
    @include('user.human_resource.script')

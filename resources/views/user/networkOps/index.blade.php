<!DOCTYPE html>
<html lang="en">
@include('user.networkOps.includes.head')

<body>
    @include('sweetalert::alert')

    <!-- Top header start -->
    {{-- @include('front.includes.top-header') --}}
    <!-- Top header end -->
    @include('user.networkOps.includes.header')


    <!-- content start -->
    @yield('content')
    <!-- content end -->

    <!-- Footer start -->
    {{-- @include('user.networkOps.includes.footer') --}}
    <!-- Footer end -->

    <script src="http://10.0.0.244:8081/js/app.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="{{ asset('../assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('../assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('../assets/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('../assets/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('../assets/js/theme.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <!-- Beginning  of required script for Modal -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <!-- Beginning of required script for Modal -->
    <!-- /// Add to Carepage  -->

</body>

</html>

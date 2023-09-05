<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Meta token --}}
    @yield('meta')

    {{-- Title --}}
    @yield('title')

    <!-- link css -->
    <link href="{{ asset('home/css/style.css') }}" rel="stylesheet">

    <!-- link font icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- link font google -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- link bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <script type="text/javascript" src="{{ asset('home/js/googlemap.js') }}"></script>

    <!-- Sweet alert cdn -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>

    @include('components.header')
    @yield('content')
    @include('components.footer')

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDloBT6ba_jvl5PEkU-Uu12MtnA1aM_Rxw&callback=loadMap"></script>

    <script src="{{ asset('home/js/images.js') }}"></script>
    <script src="{{ asset('home/js/captcha.js') }}"></script>

    {{-- <script type="text/javascript" src="https://cdn.fchat.vn/assets/embed/webchat.js?id=6451b1a0caf5664b492b1ff9" async="async"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
</body>

</html>

<!-- AIzaSyDloBT6ba_jvl5PEkU-Uu12MtnA1aM_Rxw -->
<!-- AIzaSyBS517GvRegtsE5gWMPICt2aGAkpJDc4T0 -->

<!DOCTYPE html>
<html class="no-js" lang="zxx">


<!-- Mirrored from demo.graygrids.com/themes/shopgrids/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 01 Jul 2024 09:06:36 GMT -->
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>@yield('namepage') - Bootstrap 5 eCommerce HTML Template.</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.svg" />

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/LineIcons.3.0.css" />
    <link rel="stylesheet" href="/css/tiny-slider.css" />
    <link rel="stylesheet" href="/css/glightbox.min.css" />
    <link rel="stylesheet" href="/css/main.css" />

</head>

<body>
    <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- /End Preloader -->
    @include('../partial/header')
        @yield('maincontent')
    
    @include('../partial/footer')
</body>
</html>

<!DOCTYPE html>
<html lang="fa" itemscope="itemscope" itemtype="http://schema.org/WebPage">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $options['site_name'] }} @isset($page_title) | {{$page_title}} @endisset</title>

        @foreach ([
            'assets/css/bootstrap.min.css',
            'assets/css/bootstrap-rtl.min.css',
            'assets/css/font-awesome.min.css',
            'assets/css/animate.min.css',
            'assets/css/font-electro.css',
            'assets/css/owl-carousel.css',
            'assets/css/style.css',
            'assets/css/rtl.min.css',
            'assets/css/colors/red.min.css',
            'assets/css/font.css',
        ] as $item)
            <link rel="stylesheet" type="text/css" href="{{ asset($item) }}" media="all" />
        @endforeach

        @yield('style')

        
        <style>
            .alert.alert-success {
                background: linear-gradient(to bottom right, #5cb85c, #17ac17);
                color: #f9fff7;
            }
            .alert.alert-danger {
                background: linear-gradient(to bottom right, #ea1b25, #cb434a);
                color: #ffefef;
            }
        </style>

        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,700italic,800,800italic,600italic,400italic,300italic' rel='stylesheet' type='text/css'>

        <link rel="shortcut icon" href="assets/images/fav-icon.png">
    </head>

    <body class="@yield('body-class')">
        <div id="page" class="hfeed site">
            <a class="skip-link screen-reader-text" href="#site-navigation">Skip to navigation</a>
            <a class="skip-link screen-reader-text" href="#content">Skip to content</a>

            @include('store.layout.header')

            @yield('content')

            @include('store.layout.footer')

        </div><!-- #page -->

        @foreach ([
            'assets/js/jquery.min.js',
            'assets/js/tether.min.js',
            'assets/js/bootstrap.min.js',
            'assets/js/bootstrap-hover-dropdown.min.js',
            'assets/js/owl.carousel.min.js',
            'assets/js/echo.min.js',
            'assets/js/wow.min.js',
            'assets/js/jquery.easing.min.js',
            'assets/js/jquery.waypoints.min.js',
            'assets/js/electro.js',
            'js/numeral.min.js', // js numeral formatter
        ] as $item)
            <script type="text/javascript" src="{{ asset($item) }}"></script>
        @endforeach
	
        <script>
            var nums = document.getElementsByClassName('num-comma');

            for (num in nums) {
                nums[num].innerHTML = numeral(nums[num].innerHTML).format('0,0');
            }
        </script>

        @yield('script')
    </body>
</html>
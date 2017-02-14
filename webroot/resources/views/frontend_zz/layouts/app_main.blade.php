<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    @if(\Illuminate\Support\Facades\Request::segment(1) == 'failz')
    <meta property="og:title" content="@yield('meta_title')"/>
    <meta property="og:description" content="@yield('meta_description')" />
    <meta property="og:image" content="@yield('meta_image')" />

    <meta name="twitter:title" content="@yield('meta_title')">
    <meta name="twitter:description" content="@yield('meta_description')">
    <meta name="twitter:image:src" content="@yield('meta_image')">
    @endif

    <link rel="icon" href="{{ asset('img/icons/favicon.png') }}">

    <script src="https://use.typekit.net/lhg8zxz.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>

    <!--[if lt IE 9]><script>document.createElement('video');</script><![endif]-->

    <link href="{{ asset('css/lib.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.min.css') }}?x=2" rel="stylesheet">
    @yield('css')

    <!-- Hotjar Tracking Code for http://zugarznap.com -->
    <script>
    (function(h,o,t,j,a,r){
    h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
    h._hjSettings={hjid:119140,hjsv:5};
    a=o.getElementsByTagName('head')[0];
    r=o.createElement('script');r.async=1;
    r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
    a.appendChild(r);
    })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
    </script>
    <!-- End Hotjar Tracking Code for http://zugarznap.com -->

</head>

<body data-spy="scroll" data-target="#stickynav">

    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-81223079-1', 'auto');
    ga('send', 'pageview');
    </script>

    <!-- Google Tag Manager -->
    <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-KH757R"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KH757R');</script>
    <!-- End Google Tag Manager -->

    <div class="alt-grid">
        <div class="container-fluid">
            @yield('app-header')
            <div class="container container-1024">
                @yield('main')
            </div>
            @yield('app-footer')
        </div>
    </div>

    <script src="{{ asset("js/public/lib.min.js") }}"></script>
    <script src="{{ asset("js/public/app.min.js") }}"></script>
    <!-- TrustBox script -->
    <script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.sync.bootstrap.min.js" async></script>
    <!-- End Trustbox script -->

    @yield('js')

</body>

</html>

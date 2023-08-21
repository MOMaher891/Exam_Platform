<!DOCTYPE html>
<html data-wf-domain="greatminds.training" data-wf-page="611a73051b6429830862c5d4"
    data-wf-site="60fff0c2ee17fc46c9f078db">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta content="Mental health courses designed to help your business grow." name="description" />
    <meta content="Exam Platform" property="og:title" />
    <meta content="Mental health courses designed to help your business grow." property="og:description" />
    <meta content="Exam Platform" property="twitter:title" />
    <meta content="Mental health courses designed to help your business grow." property="twitter:description" />
    <meta property="og:type" content="website" />
    <meta content="summary_large_image" name="twitter:card" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Webflow" name="generator" />


<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{asset('assets/website/css/bootstrap.min.css')}}">

<!-- External Css -->
<link rel="stylesheet" href="{{asset('assets/website/css/line-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/website/css/owl.carousel.min.css')}}" />

<!-- Custom Css -->
<link rel="stylesheet" type="text/css" href="{{asset('assets/website/css/main.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/website/css/contact-2.css')}}">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet">

<!-- Favicon -->
<link rel="icon" href="{{asset('assets/website/images/favicon.png')}}">
<link rel="apple-touch-icon" href="{{asset('assets/website/images/apple-touch-icon.png')}}">
<link rel="apple-touch-icon" sizes="72x72" href="{{asset('assets/website/images/icon-72x72.png')}}">
<link rel="apple-touch-icon" sizes="114x114" href="{{asset('assets/website/images/icon-114x114.png')}}">


    <script
        type="text/javascript">!function (o, c) { var n = c.documentElement, t = " w-mod-"; n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch") }(window, document);</script>

    <link href="{{asset('assets/website/images/627a14ec5c52390ed0ad3f7a_greatminds-apple.png')}}"
        rel="apple-touch-icon" />
    <link href="index.html" rel="canonical" />
    <style>
        [glass="1"],
        .cp-feature-hint-wrapper::after {
            -webkit-backdrop-filter: blur(12px);
            backdrop-filter: blur(12px)
        }

        @media screen and (max-width:991px) {
            [glass="2"] {
                -webkit-backdrop-filter: saturate(200%)blur(12px);
                backdrop-filter: saturate(200%)blur(12px)
            }
        }
        .iti{
            width:100% !important;
        }
        .form-group{
            margin-right:45px !important;
        }

        body {
            -moz-osx-font-smoothing: grayscale
        }

        .faux-heading::after,
        h2::after {
            content: '';
            display: block;
            height: 6px;
            width: 80px;
            background-color: #5AA1CB;
            margin: 20px 0 20px
        }

        section:nth-child(2) h2::after {
            background-color: #A8DAE6
        }

        footer h2::after {
            background-color: #E87DAF
        }

        .navbar a div {
            position: relative;
            display: inline-block;
            outline: none;
            padding-bottom: 4px;
            text-decoration: none
        }

        .navbar a div::after {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: #2A406A;
            content: '';
            opacity: 0;
            transition: opacity .4s, transform .4s;
            transform: translateY(7px)
        }

        .navbar a div:hover::after {
            opacity: 1;
            transform: translateY(0)
        }

        .organic {
            border-radius: 57% 47% 45% 56%/43% 56% 50% 62%;
        }

        .organic-foreground {
            border-radius: 54% 46% 30% 70%/45% 26% 74% 55%;
        }

        .organic-background {
            border-radius: 60% 40% 30% 70%/60% 30% 70% 40%;
        }

        .organic-foreground.tips {
            border-radius: 57% 88% 90% 73%/66% 77% 73% 52%;
        }

        .organic-background.tips {
            border-radius: 57% 50% 80% 56%/34% 40% 73% 72%;
        }
    </style>
        <link href="{{asset('assets/website/css/greatmindstraining.webflow.5f5653863.min.css')}}"
        rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{asset('assets/phoneNumber/css/demo.css')}}">
        <link rel="stylesheet" href="{{asset('assets/phoneNumber/css/intlTelInput.css')}}">
        <link rel="stylesheet" href="{{asset('assets/phoneNumber/css/intlTelInput.min.css')}}">
    {{-- Toster --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script> --}}

</head>

<body style="margin:0 !important">

    @include('layouts.website.navbar')
    @yield('content')
    @include('layouts.website.footer')
        <script src="{{asset('assets/website/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/website/js/webflow.3aec52bcb.js')}}"
        type="text/javascript"></script>

    <script src="{{asset('assets/phoneNumber/js/data.min.js')}}"></script>
    <script src="{{asset('assets/phoneNumber/js/intlTelInput-jquery.min.js')}}"></script>
    <script src="{{asset('assets/phoneNumber/js/intlTelInput.min.js')}}"></script>
    <script src="{{asset('assets/phoneNumber/js/utils.js')}}"></script>

    @yield('script')
        {{-- Toster --}}
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}

        @if (Session::has('success'))
            <script>
                toastr.success('{{ Session::get('success') }}', 'success');
            </script>
        @endif

        @if (Session::has('error'))
            <script>
                toastr.error('{{ Session::get('error') }}', 'error');
            </script>
        @endif
</body>

</html>

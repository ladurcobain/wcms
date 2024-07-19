<head>
    <meta charset="utf-8" />
    <meta name="robots" content="index, follow">
    <title>{{ str_replace("-", " ", Session::get('meta_title')) }}</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
    
    <meta name="author" content="{{ config('app.name') }}" />
    <Meta Name="keywords" content="{{ Session::get('meta_keyword') }}" />
    <meta name="description" content="{{ Session::get('meta_description') }}" />

    <meta property = "og:type" content="website" />
    <meta property = "og: image" content = "{{ ((Session::get('meta_image') == '' ? URL::asset('assets/img//kejaksaan-logo.jpg') : Session::get('meta_image'))) }}" />
    <meta property = "og: url" content = "{{ Session::get('meta_url') }}" />
    <meta property = "og: title" content = "{{ Session::get('meta_keyword') }}" />
    <meta property = "og:description" content="{{ Session::get('meta_description') }}" />

    <!-- App favicon -->
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('assets/img/kejaksaan-logo.jpg') }}">
    <link rel="apple-touch-icon" type="image/x-icon" href="{{ URL::asset('assets/img/kejaksaan-logo.jpg') }}">

    <!-- Web Fonts  -->
    <link id="googleFonts" href="{{ asset('assets/css/google_font.css') }}" rel="stylesheet" type="text/css">
    <script>var base_url = "{{ URL::to('/') }}/"</script> 
    <script>
        window.speechSynthesis.cancel();

        const myTimeout = setTimeout(myGreeting, 300000);
        function myGreeting() {
            modal_default();
        }

        function modal_default() {
            $('#defaultModal').modal('show');
        }
    </script>
    @include('layouts.styles')

    <style>
    .dark-mode {
        background-color: black;
        color: white;
    }

    .light-mode {
        background-color: white;
        color: black;
    }
    </style>
</head>
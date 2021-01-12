<!DOCTYPE html>
<html>
<head>
<title>News</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="canonical" href="{{$link_comment}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('frontend/template/css/bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/template/css/font-awesome.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/template/css/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/template/css/slick.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/template/css/theme.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/template/css/style.css')}}">
</head>
<body>
<div id="preloader">
  <div id="status">&nbsp;</div>
</div>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
<div class="container">
    @include('layouts.template.header')
    @yield('content')
</div>
@include('layouts.template.footer')

<script src="{{asset('frontend/template/js/jquery.min.js')}}"></script> 
<script src="{{asset('frontend/template/js/bootstrap.min.js')}}"></script> 
<script src="{{asset('frontend/template/js/wow.min.js')}}"></script> 
<script src="{{asset('frontend/template/js/slick.min.js')}}"></script> 
<script src="{{asset('frontend/template/js/custom.js')}}"></script>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v9.0" nonce="PGyICZzJ"></script>
</body>
</html>
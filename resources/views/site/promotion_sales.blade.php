<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" data-vue-meta="true">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta http-equiv="Content-Language" content="vi-VN"/>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />

    <meta name="robots" content="index,follow" />
    <meta name="revisit-after" content="1 days" />
    <meta name="copyright" content="nguyencongpc.vn" />
    <link rel="canonical" href="{{str_replace('http://', 'https://', url()->full())}}" />
    <title>{{isset($page_title) ? $page_title : 'Mua máy tính đồ họa chuyên nghiệp, laptop gaming, PC workstation đến Nguyễn Công | nguyencongpc.vn'}}</title>
    <meta property="og:title" content="{{isset($page_title) ? $page_title : 'Mua máy tính đồ họa chuyên nghiệp, laptop gaming, PC workstation đến Nguyễn Công | nguyencongpc.vn'}}">
    <meta property="og:description" content="{{isset($page_description) ? $page_description : 'Mua máy tính đồ họa, laptop gaming, PC workstation, linh kiện máy tính, card đồ họa cấu hình cao tại Nguyễn Công với hàng ngàn sản phẩm, giá rẻ và siêu khuyến mãi...'}}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{str_replace('http://', 'https://', url()->full())}}">
    <meta property="og:sitename" content="Máy tính Nguyễn Công">

    @if(isset($page_image))
        <meta property="og:image" content="{{asset($page_image)}}" />
        <meta property="og:image:secure_url" content="{{asset($page_image)}}" />
    @endif

    <meta property="fb:app_id" content="444804666164940">
    <meta name="title" content="{{isset($page_title) ? $page_title : 'Mua máy tính đồ họa chuyên nghiệp, laptop gaming, PC workstation đến Nguyễn Công | nguyencongpc.vn'}}">
    <meta name="description" content="{{isset($page_description) ? $page_description : 'Mua máy tính đồ họa, laptop gaming, PC workstation, linh kiện máy tính, card đồ họa cấu hình cao tại Nguyễn Công với hàng ngàn sản phẩm, giá rẻ và siêu khuyến mãi...'}}">
    <meta name="keywords" content="{{isset($page_keywords) ? $page_keywords : 'mua server, may tinh dong bo, may tinh do hoa, may tinh choi game, pc workstation, render, xay dung pc do hoa, build pc gamer, nguyencong, nc computer, pc gaming cau hinh cao'}}">
    <link rel="favicon" href="/favicon.ico">
    <link href="{{url('/images/logo-1.png')}}" rel="shortcut icon" type="png" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/css/fontawesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="/css/space.css" />
    <link rel="stylesheet" type="text/css" href="/css/main.css?v=5.15" />
    <link rel="stylesheet" type="text/css" href="/css/responsive.css?v=4.9" />
    <link rel="stylesheet" type="text/css" href="/css/jquery.toast.min.css" />
    <link rel="stylesheet" href="/css/owlcarousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="/css/owlcarousel/dist/assets/owl.theme.default.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="/js/mobile-detect.min.js"></script>
    <script src="/js/ajax.js?v=2.1"></script>
    <script src="/js/scripts.js?v=2.10"></script>
    <script src="/js/jquery.raty.js"></script>
    <script src="/css/owlcarousel/dist/owl.carousel.js"></script>
    <script src="/js/jquery.slimscroll.min.js"></script>
    <script data-ad-client="ca-pub-5040930097086206" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

    @stack('head')
</head>
<body id="{{isset($bodyClass) ? $bodyClass : ''}}">
@include('layout.header')

{!! Helper::getOption('promotion_sales') !!}

@include('layout.footer')
@stack('bottom')

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-115615186-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-115615186-1');
</script>

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '218191566160280');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=218191566160280&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

</body>
</html>

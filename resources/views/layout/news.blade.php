<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" data-vue-meta="true">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
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


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/css/fontawesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="/css/news/main.css?v=2.16" />
    <link rel="stylesheet" type="text/css" href="/css/news/responsive.css?v=1.3" />
    <link rel="stylesheet" href="/css/owlcarousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="/css/owlcarousel/dist/assets/owl.theme.default.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="/css/owlcarousel/dist/owl.carousel.js"></script>
@stack('head')
</head>
<body class="">

<div id="header">
    <div class="container">
        <div class="btn-humber only-mobile">
            <i class="fa fa-bars"></i>
        </div>
        <div class="logo left">
            <a href="/">
                <img src="/images/logo.png?v=1" alt="" title="">
            </a>
        </div>
        <div id="bg-overlay"></div>
        <div id="menu" class="nav-left left">
            <ul>
                <?php $url = url()->current();
                $explode = explode('category/',$url);
                $uri = isset($explode[1]) ? $explode[1] : '';
                ?>
                <li class="menu-item <?php echo ($uri == '') ? 'active' : ''?>"><a href="/tin-tuc">Trang chủ</a></li>
                <li class="menu-item <?php echo ($uri == 'tin-tuc') ? 'active' : ''?>"><a href="/category/tin-tuc">Công nghệ</a></li>
                <li class="menu-item <?php echo ($uri == 'tin-tuc-review') ? 'active' : ''?>"><a href="/category/tin-tuc-review">Review</a></li>
                <li class="menu-item  dropdown-guide
 <?php echo ($uri == 'tin-tuc-huong-dan') ? 'active' : ''?>">
                    <!-- <a href="/category/tin-tuc-huong-dan">Hướng dẫn</a> -->
                    <a class="dropdown-toggle" onclick="dropdownFunction()" href="#">Hướng dẫn</a>
                    <div id="dropdownContent" class="dropdown-menu">
                        <a href="/category/kien-thuc-may-tinh">Kiến thức máy tính</a>
                        <a href="/category/phan-mem-do-hoa">Phần mềm đồ họa</a>
                        <a href="/category/phan-mem-van-phong">Phần mềm văn phòng</a>
                    </div>
                </li>

            </ul>
            <div class="menu-bottom only-mobile">
                <a class="" target="_blank">
                    <i class="fa fa-facebook-f"></i>
                </a>
                <a class="" target="_blank">
                    <i class="fa fa-youtube-play"></i>
                </a>
                <p>© {{date('Y')}} nguyencongpc.vn</p>
            </div>
        </div>

        <div class="nav-right right">
            <ul>
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                <li><a href="javascript:void(0)" id="btn-search"><i class="fa fa-search"></i></a></li>
            </ul>
        </div>

        <div class="box-search visible hidden">
            <div class="form-search">
                <form action="{{route('newsSearch')}}" method="get">
                    <input type="text" name="q" id="keyword" value="" placeholder="Nhập từ khóa">
                    <button type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
            <div class="result-search visible hidden" id="suggest-search">

            </div>
        </div>
    </div>
</div>
@yield('content')
<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 footer-column">
                <div class="heading">
                    <p>CÔNG TY TNHH MÁY TÍNH NGUYỄN CÔNG</p>
                </div>
                <div class="content">
					{!! Helper::getOption('footer_news_text') !!}
                </div>
            </div>
            <div class="col-md-4 footer-column">
                <div class="heading">
                    <p>Danh mục bài viết</p>
                </div>
                <div class="content">
                    <ul class="list-cate">
                        <li class="item <?php echo ($uri == '') ? 'active' : ''?>"><a href="/tin-tuc">Trang chủ</a></li>
                        <li class="item <?php echo ($uri == 'tin-tuc') ? 'active' : ''?>"><a href="/category/tin-tuc">Công nghệ</a></li>
                        <li class="item <?php echo ($uri == 'tin-tuc-review') ? 'active' : ''?>"><a href="/category/tin-tuc-review">Review</a></li>
                        <li class="item <?php echo ($uri == 'tin-tuc-huong-dan') ? 'active' : ''?>"><a href="/category/tin-tuc-huong-dan">Hướng dẫn</a></li>
                    </ul>
                    <div class="emailsign"> 
                        <form id="email-form" method="POST" action="">
                           <input class="time-txt" type="hidden" name="timenow" placeholder="Thời gian" value="<?php date_default_timezone_set('Asia/Ho_Chi_Minh'); echo date("d-m-yy H:i:s ");?>" />
                           <input type="text" class="email-txt" name="email" placeholder="Email nhận thông báo" style="width: 70%;height: 35px;"/>
                           <button type="submit"id="submit-email" style="background: #ffc107;border: 1px solid;height: 35px;">Gửi</button>
                        </form>
                       <span class="errornotify"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 footer-column">
                <div class="heading">
                    <p>Từ khóa</p>
                </div>
                <div class="content">
                    <div class="tagcloud">
						@foreach(Helper::getNewsSearchTeams() as $teamItem)
							<a href="{{route('newsSearch')}}/?q={{urlencode($teamItem)}}">{{$teamItem}}</a>
						@endforeach
                    </div>
                </div>
            </div>

        </div>
        <div class="row copyright">
            <div class="col-md-12">
                <p>© <?=date('Y')?><span> NGUYENCONGPC.VN</span></p>
            </div>
        </div>
    </div>
</body>
<script>
    function toggleMenu(){
        $body = $('body');
        if($body.hasClass('show-menu')){
            $body.removeClass('show-menu');
        }else{
            $body.addClass('show-menu');
        }
    }

    $(document).ready(function(){
        $("#news-hot").owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            dots:false,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 3
                }
            },
            autoplay:true,
            autoplayTimeout:3000,
        });

        $(".btn-humber").click(function () {
            toggleMenu();
        });
        $('#bg-overlay').click(function () {
            toggleMenu();
        });
        $("#btn-search").click(function(){
           $(".box-search").toggleClass('hidden');
           $(this).toggleClass('btn-close');
        });

        $("#keyword").keyup(function(){
            $(".result-search").removeClass('hidden');
        });
        var searchRequest = null;
        $('#keyword').keyup(function (e) {
            if(e.keyCode == 38 || e.keyCode == 40 || e.keyCode == 13) {
                if ($('#suggest-search').css('display') != 'block')
                    return;
                var allItem = $('#suggest-search li');
                var activeItem = $('#suggest-search li.active');
                var totalItem = allItem.size();
                var firstItem = allItem.eq(0);
                var lastItem = allItem.eq(totalItem - 1);
                var idx = allItem.index(activeItem);

                if (!totalItem) {
                    return;
                }
                switch (e.keyCode) {
                    case 38:
                        if (idx == -1) {
                            lastItem.addClass('active');
                        } else {
                            var prevItem = allItem.eq(idx - 1);
                            activeItem.removeClass('active');
                            prevItem.addClass('active');
                        }
                        break;
                    case 40:
                        if (idx == -1) {
                            firstItem.addClass('active');
                        } else if (idx == (totalItem - 1)) {
                            // Item cuoi cung
                            activeItem.removeClass('active');
                            firstItem.addClass('active');
                        } else {
                            var nextItem = allItem.eq(idx + 1);
                            activeItem.removeClass('active');
                            nextItem.addClass('active');
                        }

                        break;
                    case 13:
                        if (idx >= 0 && activeItem.find('a').attr('href') != "") {
                            $(location).attr('href', activeItem.find('a').attr('href'));
                        } else {
                            return true;
                        }
                }
                return false;
            } else {
                var keyword = $("#keyword").val();
                if (keyword.trim().length > 2) {
                    if(searchRequest && searchRequest.readyState != 4){
                        searchRequest.abort();
                    }
                    searchRequest = $.ajax({
                        url: '/tin-tuc/tim-kiem-suggest',
                        type: 'GET',
                        data: {
                            q: keyword
                        },
                        success: function (data) {
                            if (data) {
                                $('#suggest-search').removeClass('hidden');
                                $('#suggest-search').html(data);
                            } else {
                                $('#suggest-search').addClass('hidden');
                            }
                        }
                    })
                } else {
                    $('#suggest-search').addClass('hidden');
                }
            }

        });

        $('#keyword').blur(function (event) {
            setTimeout("$('#suggest-search').addClass('hidden');", 300);
        });

        $("#submit-email").click(function(e)
            {
                e.preventDefault();
                var datetime = $('.time-txt').val();
                var email = $('.email-txt').val();
                var url = "https://script.google.com/macros/s/AKfycbzPsRGmlsXZk8KA-ArQ4zEspH-gHwhslKZsMaojLqQo9tPgyqM/exec?email="+email+"&datetime="+datetime;
                if( email == "" ) {
                    $('.errornotify').text("Vui lòng nhập Email nhận thông tin.").show().fadeOut(3000);
                    
                }else {
                    alert("Đăng ký thành công. Cám ơn bạn đã đăng ký nhận thông báo từ Máy Tính Nguyễn Công");
                    window.location.href = url;
                }
                return false;
            });
    })
</script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v4.0&appId=862038067474115&autoLogAppEvents=1"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-115615186-1"></script>
<script>

/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function dropdownFunction() {
    document.getElementById("dropdownContent").classList.toggle("show");
  
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropdown-toggle')) {
    var dropdowns = document.getElementsByClassName("dropdown-menu");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }


  }
}

</script>

<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-115615186-1');
</script>

</html>
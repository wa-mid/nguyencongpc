<div id="header">
    <div class="top-header for-pc">
        <div class="container">
            <div class="left">
                <div class="showroom">
                    <i class="fa fa-building-o" aria-hidden="true"></i>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-showroom">Hệ thống showroom</a>
                    
                </div>
            </div>
            <div class="right">
               <!--  <div class="header-item hotline">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <a href="tel:19003339"><span>1900 3339</span></a>
                </div> -->
                <div class="header-item support">
                    <div class="dropdown">
                        <a data-toggle="modal" data-target="#modal-contact" href="javascript:void(0)"><i class="fa fa-support" aria-hidden="true"></i> {!! Helper::getOption('support_label') !!}</a>
                    </div>
                </div>
                <div class="header-item">
                    <div class="menu">
                        <ul>
                            <li><a href="/tin-tuc">Tin tức</a></li>
                            @if(Auth::check())
                                <li><a href="/thong-tin-ca-nhan">{{ Auth::user()->name ? Auth::user()->name : Auth::user()->email }}</a></li>
                                <li><a href="/logout">Đăng xuất</a></li>
                            @else
                                <li><a href="javascipt:void(0)" id="btn-action-user">Đăng nhập / Đăng ký</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mid-header">
        <div class="container">
            <div class="left" id="main-logo">
                <a href="/">
                    <img class="logo-top" src="/images/logo@2x.png"/>
                    <img class="only-mobile logo-fix hidden" src="/images/logo@1x.png"/>
                </a>
            </div>
            <div class="box-search left">
                <div id="main-search">
                    <form action="{{route('search')}}" method="GET">
                        <div class="input-search">
                            <input type="text" name="q" value="{{isset($term) ? $term : ''}}" id="keyword" autocomplete="off" placeholder="Bạn mua gì hôm nay?" style="background: rgba(255, 255, 255, 0.1);" />
                            <button type="submit" class="icon-search">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </div>
                    </form>
                    <div id="suggest-search" style="display: none">
                    </div>
                </div>
                <div class="tags-suggest left for-pc">
                    @foreach(Helper::getSearchTeams() as $teamItem)
                        <a href="{{route('search')}}/?q={{urlencode($teamItem)}}">{{$teamItem}}</a>
                    @endforeach
                </div>
                <div class="product-viewed right for-pc">
                    <a href="/san-pham-da-xem">Sản phẩm đã xem</a>
                </div>
            </div>

            <div class="cart left for-pc" >
                <a href="/gio-hang">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="count-item" id="order_count"></span>
                    <span class="text for-pc">Giỏ hàng</span>
                </a>
            </div>

            @if(isset($bodyClass) && $bodyClass == 'page-detail_page')
                <div class="filter left only-mobile" >
                    <a href="javascript:void(0)" id="btn-filter">
                        <i class="fa fa-filter">Lọc</i> 
                    </a>
                </div>
            @endif
        
            <div class="buid-config left for-pc">
                <a href="/xay-dung-cau-hinh">
                    <img src="/images/icons/build-conf.svg">
                    <span>Xây dựng cấu hình</span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-user">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header container">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="grid-container">
                    <div class="row">
                        <div class="text-center col-6 btn-action active" data-action="login">
                            <span class="btn font-weight-bold">Đăng nhập</span>
                        </div>
                        <div class="text-center col-6  btn-action" data-action="signup">
                            <span class="btn font-weight-bold" >Đăng ký</span>
                        </div>
                    </div>
                </div>
            </div>
            @if(!Auth::check())
                <div class="modal-body">
                    <div class="box-action">
                        <div class="action-login action">
                            <div class="form">
                                <form action="/login" method="POST" id="loginForm">
                                    @csrf
                                    <div class="error"></div>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                        <input type="text" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    </div>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-lock"></i>
                                            </div>
                                        </div>
                                        <input type="password"  name="password" required autocomplete="current-password" class="form-control" placeholder="Mật khẩu">
                                    </div>
                                    <button type="submit" class="btn btn-block mgy10 btn-danger btn-submit">Đăng nhập</button>
                                    <div class="text-center">
                                        <a href="#" class="btn btn-link">Quên mật khẩu</a>
                                    </div>
                                    <div class="spacer horizon-line">
                                        <span class="text">Hoặc đăng nhập bằng</span>
                                    </div>
                                    <a class="btn btn-block mgy10 btn-fb" href="/login/facebook">
                                        <i class="fa fa-facebook-official"></i>
                                        <span>Facebook</span>
                                    </a>
                                    <a class="btn btn-block mgy10 btn-gg" href="/login/google">
                                        <i class="fa fa-google"></i>
                                        <span>Google</span>
                                    </a>
                                </form>
                            </div>
                        </div>
                        <div class="action-signup action" style="display: none">

                            <div class="form">
                                <form action="/register" method="POST" id="registerForm">
                                    @csrf
                                    <div class="error"></div>
                                    <div class="input-group mb-3">
                                        <input type="text" name="email" class="form-control" placeholder="Email" required autocomplete="email">
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="text" name="phone" class="form-control" placeholder="Số điện thoại">
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required autocomplete="current-password">
                                    </div>
                                    <button type="submit" class="btn btn-block mgy10 btn-danger btn-submit">Đăng ký</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#btn-action-user-mobile").click(function(){
            $("#modal-user").modal();
        });
        $("#btn-action-user").click(function(){
            $("#modal-user").modal();
        });
        $(".btn-action").click(function () {
            $this = $(this);
            $(".btn-action").removeClass('active');
            $this.addClass('active');
            $action = $this.attr('data-action');
            $(".box-action .action").hide();
            $action_new = ".action-"+$action;
            $($action_new).show();
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
                        url: '/search-autocomplete',
                        type: 'GET',
                        data: {
                            q: keyword
                        },
                        success: function (data) {
                            if (data) {
                                $('#suggest-search').show();
                                $('#suggest-search').html(data);
                            } else {
                                $('#suggest-search').hide();
                            }
                        }
                    })
                } else {
                    $('#suggest-search').hide();
                }
            }

        });

        $('#keyword').blur(function (event) {
            setTimeout("$('#suggest-search').fadeOut(50);", 300);
        });
    })
</script>
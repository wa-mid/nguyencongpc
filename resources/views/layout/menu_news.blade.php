<div id="main-menu" class="">
    <div class="head for-pc">
        <i class="fa fa-bars"></i>
        <span>Tin tức</span>
    </div>
    <div class="head only-mobile" id="btn-back-menu">
        <i class="fa fa-arrow-left"></i>
        <span>Quay lại</span>
    </div>
    <div class="user only-mobile">
        <i class="fa fa-user-circle-o"></i>
        <div>
            <a href="">Đăng ký / Đăng nhập</a>
        </div>
    </div>
    <ul>
        @foreach(Helper::getPostCategories() as $item)
            <li>
                <a href="{{$item->getDetailLink()}}">
                    <i class="icon icon-s12"></i>
                    <span>{{$item->name}}</span>
                </a>
            </li>
        @endforeach
    </ul>
</div>
<!-- End Menu -->
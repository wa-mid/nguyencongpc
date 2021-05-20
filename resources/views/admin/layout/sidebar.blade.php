<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{Request::is('admin') ? 'active' : ''}}"><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            @can('category-list')
                <li class="{{Request::is('admin/categories*') ? 'active' : ''}}"><a href="{{route('admin.categories.index')}}"><i class="fa fa-bars"></i> <span>Danh mục</span></a></li>
            @endcan
            @can('brand-list')
                <li class="{{Request::is('admin/brands*') ? 'active' : ''}}"><a href="{{route('admin.brands.index')}}"><i class="fa fa-tags"></i> <span>Nhãn hàng</span></a></li>
            @endcan
            @can('filter-list')
                <li class="{{Request::is('admin/filters*') ? 'active' : ''}}"><a href="{{route('admin.filters.index')}}"><i class="fa fa-filter"></i> <span>Bộ lọc</span></a></li>
            @endcan
            @can('product-list')
                <li class="{{Request::is('admin/products*') ? 'active' : ''}}"><a href="{{route('admin.products.index')}}"><i class="fa fa-product-hunt"></i> <span>Sản phẩm</span></a></li>
            @endcan
            @can('tag-list')
                <li class="{{Request::is('admin/tags*') ? 'active' : ''}}"><a href="{{route('admin.tags.index')}}"><i class="fa fa-tags"></i> <span>Tags</span></a></li>
            @endcan
            @can('postCategory-list')
                <li class="{{Request::is('admin/postCategory*') ? 'active' : ''}}"><a href="{{route('admin.postCategory.index')}}"><i class="fa fa-bars"></i> <span>Chuyên mục tin tức</span></a></li>
            @endcan
            @can('post-list')
                <li class="{{Request::is('admin/posts*') ? 'active' : ''}}"><a href="{{route('admin.posts.index')}}"><i class="fa fa-file-o"></i> <span>Bài viết</span></a></li>
            @endcan
            @can('promotion-list')
                <li class="{{Request::is('admin/promotions*') ? 'active' : ''}}"><a href="{{route('admin.promotions.index')}}"><i class="fa fa-gift"></i> <span>Khuyến mại</span></a></li>
            @endcan
            @can('slide-list')
                <li class="{{Request::is('admin/slide*') ? 'active' : ''}}"><a href="{{route('admin.slide.index')}}"><i class="fa fa-file-image-o"></i> <span>Slide</span></a></li>
            @endcan
            @can('kiotviet-list')
                <li class="{{Request::is('admin/kiotviet*') ? 'active' : ''}}"><a href="{{route('admin.kiotviet.index')}}"><i class="fa fa-cog"></i> <span>Đồng bộ KiotViet</span></a></li>
            @endcan
            @can('orders-list')
                <li class="{{Request::is('admin/orders*') ? 'active' : ''}}"><a href="{{route('admin.orders.index')}}"><i class="fa fa-shopping-cart"></i> <span>Đơn hàng</span> <span style="padding: 5px 10px;border-radius: 50%;background: red;font-size: 16px;margin-left: 20px;">{{ $order_new}}</span></a></li>
            @endcan
            @can('video-list')
                <li class="{{Request::is('admin/video*') ? 'active' : ''}}"><a href="{{route('admin.video.index')}}"><i class="fa fa-youtube"></i> <span>Video</span></a></li>
            @endcan
            @can('option-list')
                <li class="{{Request::is('admin/options*') ? 'active' : ''}}"><a href="{{route('admin.options.index')}}"><i class="fa fa-cog"></i> <span>Cấu hình</span></a></li>
            @endcan
            @can('role-list')
                <li class="{{Request::is('admin/roles*') ? 'active' : ''}}"><a href="{{route('admin.roles.index')}}"><i class="fa fa-lock"></i> <span>Quản lý quyền</span></a></li>
            @endcan
            @can('user-list')
                <li class="{{Request::is('admin/users*') ? 'active' : ''}}"><a href="{{route('admin.users.index')}}"><i class="fa fa-users"></i> <span>Quản lý Người dùng</span></a></li>
            @endcan
            @can('contact-list')
                <li class="{{Request::is('admin/contacts*') ? 'active' : ''}}"><a href="{{route('admin.contacts.index')}}"><i class="fa fa-envelope-o"></i> <span>Quản lý liên hệ</span></a></li>
            @endcan
            @can('redirect-list')
                <li class="{{Request::is('admin/redirect*') ? 'active' : ''}}"><a href="{{route('admin.redirect.index')}}"><i class="fa fa-link"></i> <span>Quản lý Link Redirect</span></a></li>
            @endcan
			@can('kiotviet-order-list')
                <li class="{{Request::is('admin/kiotviet-invoices*') ? 'active' : ''}}"><a href="{{route('admin.kiotvietinvoices.index')}}"><i class="fa fa-money"></i> <span>Quản lý Hóa đơn</span></a></li>
            @endcan
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
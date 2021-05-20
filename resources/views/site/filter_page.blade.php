<div class="row">
    <div class="col-md-4">
        <div class="sort-block float_l" style="padding: 5px 10px;">
            <span>Sắp xếp: </span>
            <select onchange="if(this.value != '') { showProductFilterSort(this.value) }">
                <option value="">Mặc định</option>
                <option {{$sort == 'price-asc' ? 'selected' : ''}} value="price-asc">Giá tăng dần</option>
                <option {{$sort == 'price-desc' ? 'selected' : ''}} value="price-desc">Giá giảm dần</option>
                <option {{$sort == 'rating' ? 'selected' : ''}} value="rating">Đánh giá</option>
                <option {{$sort == 'name' ? 'selected' : ''}} value="name">Tên A-&gt;Z</option>
            </select>
        </div>
    </div>
    <div class="col-md-8">
        {!! $products->onEachSide(1)->links('layout.filter_pagination') !!}
    </div>
</div>




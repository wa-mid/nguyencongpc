@extends('layout.layout')

@section('content')
    <div id="content">
    <div class="container">
        <div class="product-filter product-category">
            <div class="main-content">
                <div class="left-content left">
                    @include('layout.menu')
                    @include('layout.filter')
                </div>
                <div class="right-content">

                    <div class="breadcrumb">
                        <ol itemscope itemtype="http://schema.org/BreadcrumbList">
                            <li itemprop="itemListElement" itemscope itemtype="https://nguyencongpc.vn">
                                <a itemprop="item" href="https://nguyencongpc.vn">
                                    <span itemprop="name">Trang chủ</span></a>
                                <meta itemprop="position" content="1" />
                                <i class="fa fa-angle-double-right"></i>
                            </li>
                            <li itemprop="itemListElement" itemscope itemtype="https://nguyencongpc.vn/san-pham.html">
                                <a itemprop="item" href="https://nguyencongpc.vn/san-pham.html">
                                    <span itemprop="name">Sản phẩm</span></a>
                                <meta itemprop="position" content="2" />
                                <i class="fa fa-angle-double-right"></i>
                            <li itemprop="itemListElement" itemscope itemtype="https://nguyencongpc.vn/san-pham.html">
                                <a itemprop="item" href="https://nguyencongpc.vn/san-pham.html">
                                    <span itemprop="name">PC, WORKSTATION</span></a>
                                <meta itemprop="position" content="3" />
                            </li>
                        </ol>
                    </div>

                    <div class="main-product">
                        <div class="head">
                            <p>PC, WORKSTATION</p>

                            <div class="option">
                                <select>
                                    <option>Mới nhất</option>
                                    <option>Giá tăng dần</option>
                                    <option>Giá giảm dần</option>
                                </select>

                                <div class="display">
                                    <i class="fa fa-th-large active"></i>
                                    <i class="fa fa-th-list"></i>
                                </div>
                            </div>
                        </div>

                        <div class="list-product workstation-product grid-two-on-mobile">
                            <div class="product-item" data-id="12229">
                                <a href="http://localhost:2070/bo-pc-workstation-dual-xeon-e5-2697v3-ram-32gb-vga-gtx-1060-6g">
                                    <div class="image">
                                        <img src="https://nguyencongpc.vn/wp-content/uploads/1-45.jpg">
                                    </div>
                                    <p class="text">
                                        <span class="name">Bộ PC Workstation Dual Xeon E5 2697v3 /Ram 32Gb / VGA GTX 1060 6G</span>
                                        <span class="new-price">39.990.000</span>
                                        <span class="old-price">48.900.000</span>
                                        <span class="sale">-18%</span>
                                    </p>
                                </a>
                                <div id="popup-product-12229" class="popup-hover-product" style="display: none; top: 1388px; left: 907px;">
                                    <div class="top">
                                        <span class="name">Bộ PC Workstation Dual Xeon E5 2697v3 /Ram 32Gb / VGA GTX 1060 6G</span>
                                        <img src="/images/intel.png">
                                    </div>
                                    <div class="body">
                                        <div class="left">
                                            <img src="https://nguyencongpc.vn/wp-content/uploads/1-45.jpg">

                                        </div>
                                        <div class="left">
                                            <p class="price">39.990.000</p>
                                            <p class="old-price">48.900.000</p>
                                            <p class="vat"><strong>VAT:</strong> đã bao gồm</p>
                                            <p class="gua"><strong>Bảo hành:</strong>: <span style="color:#ff0000"></span></p>
                                            <p class="rate"></p>

                                        </div>
                                        <div class="des">
                                            <p class="cap">Mô tả sản phẩm</p>
                                            <div class="content">
                                                1 x Bộ vi xử lý/ CPU Intel Core i5-9400F (9M Cache, up to 4.10GHz) <br>
                                                1 x Bo mạch chính/ Mainboard Msi B360M Mortar<br>
                                                1 x Card màn hình/ VGA MSI RTX 2060 Gaming Z 6GB<br>
                                                1 x Bộ nhớ/ RAM Kingston HyperX Fury Red 8GB DDR4 2666 (HX426C16FR2/8)<br>
                                                1 x Nguồn/ Power CM MWE Bronze 600W V2<br>
                                            </div>
                                        </div>
                                        <div class="promotion">
                                            <p class="cap">Khuyến mại</p>
                                            <div class="content">
                                                – Bảo hành tại nhà trong vòng 1 năm đầu tiên tính từ ngày mua hàng ( Tại nội thành Hà Nội )<br>
                                                – Xử lý bảo hành siêu tốc 1 đổi 1 , thời gian xử lý bảo hành không quá 24H<br>
                                                – Hỗ trợ bảo hành phần mềm trọn đời : 24/7<br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-item" data-id="12019">
                                <a href="http://localhost:2070/bo-pc-intel-core-i9-7980xe-ram-32gb-vga-gtx-1080-8g">
                                    <div class="image">
                                        <img src="https://nguyencongpc.vn/wp-content/uploads/1-49.jpg">
                                    </div>
                                    <p class="text">
                                        <span class="name">BỘ PC INTEL CORE I9 7980XE / RAM 32GB / VGA GTX 1080 8G</span>
                                        <span class="new-price">74.990.000</span>
                                        <span class="old-price">102.990.000</span>
                                        <span class="sale">-27%</span>
                                    </p>
                                </a>
                                <div id="popup-product-12019" class="popup-hover-product" style="display: none; top: 1047px; left: 1043px;">
                                    <div class="top">
                                        <span class="name">BỘ PC INTEL CORE I9 7980XE / RAM 32GB / VGA GTX 1080 8G</span>
                                        <img src="/images/intel.png">
                                    </div>
                                    <div class="body">
                                        <div class="left">
                                            <img src="https://nguyencongpc.vn/wp-content/uploads/1-49.jpg">

                                        </div>
                                        <div class="left">
                                            <p class="price">74.990.000</p>
                                            <p class="old-price">102.990.000</p>
                                            <p class="vat"><strong>VAT:</strong> đã bao gồm</p>
                                            <p class="gua"><strong>Bảo hành:</strong>: <span style="color:#ff0000">36 Tháng </span></p>
                                            <p class="rate"></p>

                                        </div>
                                        <div class="des">
                                            <p class="cap">Mô tả sản phẩm</p>
                                            <div class="content">
                                                1 x Bộ vi xử lý/ CPU Intel Core i5-9400F (9M Cache, up to 4.10GHz) <br>
                                                1 x Bo mạch chính/ Mainboard Msi B360M Mortar<br>
                                                1 x Card màn hình/ VGA MSI RTX 2060 Gaming Z 6GB<br>
                                                1 x Bộ nhớ/ RAM Kingston HyperX Fury Red 8GB DDR4 2666 (HX426C16FR2/8)<br>
                                                1 x Nguồn/ Power CM MWE Bronze 600W V2<br>
                                            </div>
                                        </div>
                                        <div class="promotion">
                                            <p class="cap">Khuyến mại</p>
                                            <div class="content">
                                                – Bảo hành tại nhà trong vòng 1 năm đầu tiên tính từ ngày mua hàng ( Tại nội thành Hà Nội )<br>
                                                – Xử lý bảo hành siêu tốc 1 đổi 1 , thời gian xử lý bảo hành không quá 24H<br>
                                                – Hỗ trợ bảo hành phần mềm trọn đời : 24/7<br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-item" data-id="11874">
                                <a href="http://localhost:2070/11874">
                                    <div class="image">
                                        <img src="https://nguyencongpc.vn/wp-content/uploads/8fbfef59f9e71db944f6.jpg">
                                    </div>
                                    <p class="text">
                                        <span class="name">BỘ PC CORE I9 9900K / RAM 32GB / VGA GTX 1660TI 6G</span>
                                        <span class="new-price">39.990.000</span>
                                        <span class="old-price">42.390.000</span>
                                        <span class="sale">-6%</span>
                                    </p>
                                </a>
                                <div id="popup-product-11874" class="popup-hover-product" style="display: none; top: 1092px; left: 1127px;">
                                    <div class="top">
                                        <span class="name">BỘ PC CORE I9 9900K / RAM 32GB / VGA GTX 1660TI 6G</span>
                                        <img src="/images/intel.png">
                                    </div>
                                    <div class="body">
                                        <div class="left">
                                            <img src="https://nguyencongpc.vn/wp-content/uploads/8fbfef59f9e71db944f6.jpg">

                                        </div>
                                        <div class="left">
                                            <p class="price">39.990.000</p>
                                            <p class="old-price">42.390.000</p>
                                            <p class="vat"><strong>VAT:</strong> đã bao gồm</p>
                                            <p class="gua"><strong>Bảo hành:</strong>: <span style="color:#ff0000">36 THÁNG </span></p>
                                            <p class="rate"></p>

                                        </div>
                                        <div class="des">
                                            <p class="cap">Mô tả sản phẩm</p>
                                            <div class="content">
                                                1 x Bộ vi xử lý/ CPU Intel Core i5-9400F (9M Cache, up to 4.10GHz) <br>
                                                1 x Bo mạch chính/ Mainboard Msi B360M Mortar<br>
                                                1 x Card màn hình/ VGA MSI RTX 2060 Gaming Z 6GB<br>
                                                1 x Bộ nhớ/ RAM Kingston HyperX Fury Red 8GB DDR4 2666 (HX426C16FR2/8)<br>
                                                1 x Nguồn/ Power CM MWE Bronze 600W V2<br>
                                            </div>
                                        </div>
                                        <div class="promotion">
                                            <p class="cap">Khuyến mại</p>
                                            <div class="content">
                                                – Bảo hành tại nhà trong vòng 1 năm đầu tiên tính từ ngày mua hàng ( Tại nội thành Hà Nội )<br>
                                                – Xử lý bảo hành siêu tốc 1 đổi 1 , thời gian xử lý bảo hành không quá 24H<br>
                                                – Hỗ trợ bảo hành phần mềm trọn đời : 24/7<br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-item" data-id="11834">
                                <a href="http://localhost:2070/may-tinh-mini-asus-proart-pa90">
                                    <div class="image">
                                        <img src="https://nguyencongpc.vn/wp-content/uploads/IMG_5564.jpg">
                                    </div>
                                    <p class="text">
                                        <span class="name">Máy tính mini Asus ProArt PA90</span>
                                        <span class="new-price">83.500.000</span>
                                        <span class="old-price">83.500.000</span>
                                        <span class="sale">0%</span>
                                    </p>
                                </a>
                                <div id="popup-product-11834" class="popup-hover-product" style="display: none; top: 1135px; left: 1371px;">
                                    <div class="top">
                                        <span class="name">Máy tính mini Asus ProArt PA90</span>
                                        <img src="/images/intel.png">
                                    </div>
                                    <div class="body">
                                        <div class="left">
                                            <img src="https://nguyencongpc.vn/wp-content/uploads/IMG_5564.jpg">

                                        </div>
                                        <div class="left">
                                            <p class="price">83.500.000</p>
                                            <p class="old-price">83.500.000</p>
                                            <p class="vat"><strong>VAT:</strong> đã bao gồm</p>
                                            <p class="gua"><strong>Bảo hành:</strong>: <span style="color:#ff0000">36 THÁNG </span></p>
                                            <p class="rate"></p>

                                        </div>
                                        <div class="des">
                                            <p class="cap">Mô tả sản phẩm</p>
                                            <div class="content">
                                                1 x Bộ vi xử lý/ CPU Intel Core i5-9400F (9M Cache, up to 4.10GHz) <br>
                                                1 x Bo mạch chính/ Mainboard Msi B360M Mortar<br>
                                                1 x Card màn hình/ VGA MSI RTX 2060 Gaming Z 6GB<br>
                                                1 x Bộ nhớ/ RAM Kingston HyperX Fury Red 8GB DDR4 2666 (HX426C16FR2/8)<br>
                                                1 x Nguồn/ Power CM MWE Bronze 600W V2<br>
                                            </div>
                                        </div>
                                        <div class="promotion">
                                            <p class="cap">Khuyến mại</p>
                                            <div class="content">
                                                – Bảo hành tại nhà trong vòng 1 năm đầu tiên tính từ ngày mua hàng ( Tại nội thành Hà Nội )<br>
                                                – Xử lý bảo hành siêu tốc 1 đổi 1 , thời gian xử lý bảo hành không quá 24H<br>
                                                – Hỗ trợ bảo hành phần mềm trọn đời : 24/7<br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-item" data-id="11201">
                                <a href="http://localhost:2070/bo-pc-amd-ryzen-9-3900x-ram-64gb-rtx-2080ti-11g">
                                    <div class="image">
                                        <img src="https://nguyencongpc.vn/wp-content/uploads/case-cooler-master-h500p-nc.jpg">
                                    </div>
                                    <p class="text">
                                        <span class="name">Bộ PC AMD Ryzen 9 3900X /Ram 64Gb/RTX 2080Ti 11G</span>
                                        <span class="new-price">76.500.000</span>
                                        <span class="old-price">82.500.000</span>
                                        <span class="sale">-7%</span>
                                    </p>
                                </a>
                                <div id="popup-product-11201" class="popup-hover-product" style="display: none; top: 1152px; left: 1523px;">
                                    <div class="top">
                                        <span class="name">Bộ PC AMD Ryzen 9 3900X /Ram 64Gb/RTX 2080Ti 11G</span>
                                        <img src="/images/intel.png">
                                    </div>
                                    <div class="body">
                                        <div class="left">
                                            <img src="https://nguyencongpc.vn/wp-content/uploads/case-cooler-master-h500p-nc.jpg">

                                        </div>
                                        <div class="left">
                                            <p class="price">76.500.000</p>
                                            <p class="old-price">82.500.000</p>
                                            <p class="vat"><strong>VAT:</strong> đã bao gồm</p>
                                            <p class="gua"><strong>Bảo hành:</strong>: <span style="color:#ff0000"></span></p>
                                            <p class="rate"></p>

                                        </div>
                                        <div class="des">
                                            <p class="cap">Mô tả sản phẩm</p>
                                            <div class="content">
                                                1 x Bộ vi xử lý/ CPU Intel Core i5-9400F (9M Cache, up to 4.10GHz) <br>
                                                1 x Bo mạch chính/ Mainboard Msi B360M Mortar<br>
                                                1 x Card màn hình/ VGA MSI RTX 2060 Gaming Z 6GB<br>
                                                1 x Bộ nhớ/ RAM Kingston HyperX Fury Red 8GB DDR4 2666 (HX426C16FR2/8)<br>
                                                1 x Nguồn/ Power CM MWE Bronze 600W V2<br>
                                            </div>
                                        </div>
                                        <div class="promotion">
                                            <p class="cap">Khuyến mại</p>
                                            <div class="content">
                                                – Bảo hành tại nhà trong vòng 1 năm đầu tiên tính từ ngày mua hàng ( Tại nội thành Hà Nội )<br>
                                                – Xử lý bảo hành siêu tốc 1 đổi 1 , thời gian xử lý bảo hành không quá 24H<br>
                                                – Hỗ trợ bảo hành phần mềm trọn đời : 24/7<br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-item" data-id="11162">
                                <a href="http://localhost:2070/bo-pc-amd-ryzen-7-3700x-ram-32gb-rtx-2080ti-11g">
                                    <div class="image">
                                        <img src="https://nguyencongpc.vn/wp-content/uploads/IMG_5862.jpg">
                                    </div>
                                    <p class="text">
                                        <span class="name">BỘ PC AMD RYZEN 7 3700X / RAM 32GB / RTX 2080TI 11G</span>
                                        <span class="new-price">64.500.000</span>
                                        <span class="old-price">72.500.000</span>
                                        <span class="sale">-11%</span>
                                    </p>
                                </a>
                                <div id="popup-product-11162" class="popup-hover-product">
                                    <div class="top">
                                        <span class="name">BỘ PC AMD RYZEN 7 3700X / RAM 32GB / RTX 2080TI 11G</span>
                                        <img src="/images/intel.png">
                                    </div>
                                    <div class="body">
                                        <div class="left">
                                            <img src="https://nguyencongpc.vn/wp-content/uploads/IMG_5862.jpg">

                                        </div>
                                        <div class="left">
                                            <p class="price">64.500.000</p>
                                            <p class="old-price">72.500.000</p>
                                            <p class="vat"><strong>VAT:</strong> đã bao gồm</p>
                                            <p class="gua"><strong>Bảo hành:</strong>: <span style="color:#ff0000">36 THÁNG </span></p>
                                            <p class="rate"></p>

                                        </div>
                                        <div class="des">
                                            <p class="cap">Mô tả sản phẩm</p>
                                            <div class="content">
                                                1 x Bộ vi xử lý/ CPU Intel Core i5-9400F (9M Cache, up to 4.10GHz) <br>
                                                1 x Bo mạch chính/ Mainboard Msi B360M Mortar<br>
                                                1 x Card màn hình/ VGA MSI RTX 2060 Gaming Z 6GB<br>
                                                1 x Bộ nhớ/ RAM Kingston HyperX Fury Red 8GB DDR4 2666 (HX426C16FR2/8)<br>
                                                1 x Nguồn/ Power CM MWE Bronze 600W V2<br>
                                            </div>
                                        </div>
                                        <div class="promotion">
                                            <p class="cap">Khuyến mại</p>
                                            <div class="content">
                                                – Bảo hành tại nhà trong vòng 1 năm đầu tiên tính từ ngày mua hàng ( Tại nội thành Hà Nội )<br>
                                                – Xử lý bảo hành siêu tốc 1 đổi 1 , thời gian xử lý bảo hành không quá 24H<br>
                                                – Hỗ trợ bảo hành phần mềm trọn đời : 24/7<br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-item" data-id="11085">
                                <a href="http://localhost:2070/bo-pc-core-i9-9900k-ram-32gb-vga-rtx-2070-8g-xtreme">
                                    <div class="image">
                                        <img src="https://nguyencongpc.vn/wp-content/uploads/anh-vbia.jpg">
                                    </div>
                                    <p class="text">
                                        <span class="name">BỘ PC CORE I9 9900K /RAM 32GB / VGA RTX 2070 8G XTREME</span>
                                        <span class="new-price">56.500.000</span>
                                        <span class="old-price">56.500.000</span>
                                        <span class="sale">0%</span>
                                    </p>
                                </a>
                                <div id="popup-product-11085" class="popup-hover-product" style="top: 1234px; left: 1031px; display: none;">
                                    <div class="top">
                                        <span class="name">BỘ PC CORE I9 9900K /RAM 32GB / VGA RTX 2070 8G XTREME</span>
                                        <img src="/images/intel.png">
                                    </div>
                                    <div class="body">
                                        <div class="left">
                                            <img src="https://nguyencongpc.vn/wp-content/uploads/anh-vbia.jpg">

                                        </div>
                                        <div class="left">
                                            <p class="price">56.500.000</p>
                                            <p class="old-price">56.500.000</p>
                                            <p class="vat"><strong>VAT:</strong> đã bao gồm</p>
                                            <p class="gua"><strong>Bảo hành:</strong>: <span style="color:#ff0000">36 THÁNG </span></p>
                                            <p class="rate"></p>

                                        </div>
                                        <div class="des">
                                            <p class="cap">Mô tả sản phẩm</p>
                                            <div class="content">
                                                1 x Bộ vi xử lý/ CPU Intel Core i5-9400F (9M Cache, up to 4.10GHz) <br>
                                                1 x Bo mạch chính/ Mainboard Msi B360M Mortar<br>
                                                1 x Card màn hình/ VGA MSI RTX 2060 Gaming Z 6GB<br>
                                                1 x Bộ nhớ/ RAM Kingston HyperX Fury Red 8GB DDR4 2666 (HX426C16FR2/8)<br>
                                                1 x Nguồn/ Power CM MWE Bronze 600W V2<br>
                                            </div>
                                        </div>
                                        <div class="promotion">
                                            <p class="cap">Khuyến mại</p>
                                            <div class="content">
                                                – Bảo hành tại nhà trong vòng 1 năm đầu tiên tính từ ngày mua hàng ( Tại nội thành Hà Nội )<br>
                                                – Xử lý bảo hành siêu tốc 1 đổi 1 , thời gian xử lý bảo hành không quá 24H<br>
                                                – Hỗ trợ bảo hành phần mềm trọn đời : 24/7<br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-item" data-id="11018">
                                <a href="http://localhost:2070/bo-pc-amd-ryzen-5-3600-ram-16gb-vga-gtx-1060-6g">
                                    <div class="image">
                                        <img src="https://nguyencongpc.vn/wp-content/uploads/1-34.jpg">
                                    </div>
                                    <p class="text">
                                        <span class="name">BỘ PC AMD RYZEN 5 3600 / RAM 16GB / VGA GTX 1060 6G</span>
                                        <span class="new-price">16.900.000</span>
                                        <span class="old-price">18.900.000</span>
                                        <span class="sale">-11%</span>
                                    </p>
                                </a>
                                <div id="popup-product-11018" class="popup-hover-product" style="display: none; top: 1283px; left: 1102px;">
                                    <div class="top">
                                        <span class="name">BỘ PC AMD RYZEN 5 3600 / RAM 16GB / VGA GTX 1060 6G</span>
                                        <img src="/images/intel.png">
                                    </div>
                                    <div class="body">
                                        <div class="left">
                                            <img src="https://nguyencongpc.vn/wp-content/uploads/1-34.jpg">

                                        </div>
                                        <div class="left">
                                            <p class="price">16.900.000</p>
                                            <p class="old-price">18.900.000</p>
                                            <p class="vat"><strong>VAT:</strong> đã bao gồm</p>
                                            <p class="gua"><strong>Bảo hành:</strong>: <span style="color:#ff0000">36 THÁNG </span></p>
                                            <p class="rate"></p>

                                        </div>
                                        <div class="des">
                                            <p class="cap">Mô tả sản phẩm</p>
                                            <div class="content">
                                                1 x Bộ vi xử lý/ CPU Intel Core i5-9400F (9M Cache, up to 4.10GHz) <br>
                                                1 x Bo mạch chính/ Mainboard Msi B360M Mortar<br>
                                                1 x Card màn hình/ VGA MSI RTX 2060 Gaming Z 6GB<br>
                                                1 x Bộ nhớ/ RAM Kingston HyperX Fury Red 8GB DDR4 2666 (HX426C16FR2/8)<br>
                                                1 x Nguồn/ Power CM MWE Bronze 600W V2<br>
                                            </div>
                                        </div>
                                        <div class="promotion">
                                            <p class="cap">Khuyến mại</p>
                                            <div class="content">
                                                – Bảo hành tại nhà trong vòng 1 năm đầu tiên tính từ ngày mua hàng ( Tại nội thành Hà Nội )<br>
                                                – Xử lý bảo hành siêu tốc 1 đổi 1 , thời gian xử lý bảo hành không quá 24H<br>
                                                – Hỗ trợ bảo hành phần mềm trọn đời : 24/7<br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-item" data-id="11017">
                                <a href="http://localhost:2070/bo-pc-amd-ryzen-5-3600-ram-16gb-vga-rtx-2080-8g">
                                    <div class="image">
                                        <img src="https://nguyencongpc.vn/wp-content/uploads/2-27.jpg">
                                    </div>
                                    <p class="text">
                                        <span class="name">BỘ PC AMD RYZEN 5 3600 / RAM 16GB / VGA RTX 2080 8G</span>
                                        <span class="new-price">32.900.000</span>
                                        <span class="old-price">32.900.000</span>
                                        <span class="sale">0%</span>
                                    </p>
                                </a>
                                <div id="popup-product-11017" class="popup-hover-product">
                                    <div class="top">
                                        <span class="name">BỘ PC AMD RYZEN 5 3600 / RAM 16GB / VGA RTX 2080 8G</span>
                                        <img src="/images/intel.png">
                                    </div>
                                    <div class="body">
                                        <div class="left">
                                            <img src="https://nguyencongpc.vn/wp-content/uploads/2-27.jpg">

                                        </div>
                                        <div class="left">
                                            <p class="price">32.900.000</p>
                                            <p class="old-price">32.900.000</p>
                                            <p class="vat"><strong>VAT:</strong> đã bao gồm</p>
                                            <p class="gua"><strong>Bảo hành:</strong>: <span style="color:#ff0000">36 THÁNG </span></p>
                                            <p class="rate"></p>

                                        </div>
                                        <div class="des">
                                            <p class="cap">Mô tả sản phẩm</p>
                                            <div class="content">
                                                1 x Bộ vi xử lý/ CPU Intel Core i5-9400F (9M Cache, up to 4.10GHz) <br>
                                                1 x Bo mạch chính/ Mainboard Msi B360M Mortar<br>
                                                1 x Card màn hình/ VGA MSI RTX 2060 Gaming Z 6GB<br>
                                                1 x Bộ nhớ/ RAM Kingston HyperX Fury Red 8GB DDR4 2666 (HX426C16FR2/8)<br>
                                                1 x Nguồn/ Power CM MWE Bronze 600W V2<br>
                                            </div>
                                        </div>
                                        <div class="promotion">
                                            <p class="cap">Khuyến mại</p>
                                            <div class="content">
                                                – Bảo hành tại nhà trong vòng 1 năm đầu tiên tính từ ngày mua hàng ( Tại nội thành Hà Nội )<br>
                                                – Xử lý bảo hành siêu tốc 1 đổi 1 , thời gian xử lý bảo hành không quá 24H<br>
                                                – Hỗ trợ bảo hành phần mềm trọn đời : 24/7<br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-item" data-id="11016">
                                <a href="http://localhost:2070/bo-pc-amd-ryzen-7-3700x-ram-32gb-vga-rtx-2080-8g">
                                    <div class="image">
                                        <img src="https://nguyencongpc.vn/wp-content/uploads/6-14.jpg">
                                    </div>
                                    <p class="text">
                                        <span class="name">BỘ PC AMD Ryzen 7 3700X  / RAM 32GB / VGA RTX 2080 8G</span>
                                        <span class="new-price">43.500.000</span>
                                        <span class="old-price">48.500.000</span>
                                        <span class="sale">-10%</span>
                                    </p>
                                </a>
                                <div id="popup-product-11016" class="popup-hover-product">
                                    <div class="top">
                                        <span class="name">BỘ PC AMD Ryzen 7 3700X  / RAM 32GB / VGA RTX 2080 8G</span>
                                        <img src="/images/intel.png">
                                    </div>
                                    <div class="body">
                                        <div class="left">
                                            <img src="https://nguyencongpc.vn/wp-content/uploads/6-14.jpg">

                                        </div>
                                        <div class="left">
                                            <p class="price">43.500.000</p>
                                            <p class="old-price">48.500.000</p>
                                            <p class="vat"><strong>VAT:</strong> đã bao gồm</p>
                                            <p class="gua"><strong>Bảo hành:</strong>: <span style="color:#ff0000">36 Tháng </span></p>
                                            <p class="rate"></p>

                                        </div>
                                        <div class="des">
                                            <p class="cap">Mô tả sản phẩm</p>
                                            <div class="content">
                                                1 x Bộ vi xử lý/ CPU Intel Core i5-9400F (9M Cache, up to 4.10GHz) <br>
                                                1 x Bo mạch chính/ Mainboard Msi B360M Mortar<br>
                                                1 x Card màn hình/ VGA MSI RTX 2060 Gaming Z 6GB<br>
                                                1 x Bộ nhớ/ RAM Kingston HyperX Fury Red 8GB DDR4 2666 (HX426C16FR2/8)<br>
                                                1 x Nguồn/ Power CM MWE Bronze 600W V2<br>
                                            </div>
                                        </div>
                                        <div class="promotion">
                                            <p class="cap">Khuyến mại</p>
                                            <div class="content">
                                                – Bảo hành tại nhà trong vòng 1 năm đầu tiên tính từ ngày mua hàng ( Tại nội thành Hà Nội )<br>
                                                – Xử lý bảo hành siêu tốc 1 đổi 1 , thời gian xử lý bảo hành không quá 24H<br>
                                                – Hỗ trợ bảo hành phần mềm trọn đời : 24/7<br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-item" data-id="11018">
                                <a href="http://localhost:2070/bo-pc-amd-ryzen-5-3600-ram-16gb-vga-gtx-1060-6g">
                                    <div class="image">
                                        <img src="https://nguyencongpc.vn/wp-content/uploads/1-34.jpg">
                                    </div>
                                    <p class="text">
                                        <span class="name">BỘ PC AMD RYZEN 5 3600 / RAM 16GB / VGA GTX 1060 6G</span>
                                        <span class="new-price">16.900.000</span>
                                        <span class="old-price">18.900.000</span>
                                        <span class="sale">-11%</span>
                                    </p>
                                </a>
                                <div id="popup-product-11018" class="popup-hover-product" style="display: none; top: 1283px; left: 1102px;">
                                    <div class="top">
                                        <span class="name">BỘ PC AMD RYZEN 5 3600 / RAM 16GB / VGA GTX 1060 6G</span>
                                        <img src="/images/intel.png">
                                    </div>
                                    <div class="body">
                                        <div class="left">
                                            <img src="https://nguyencongpc.vn/wp-content/uploads/1-34.jpg">

                                        </div>
                                        <div class="left">
                                            <p class="price">16.900.000</p>
                                            <p class="old-price">18.900.000</p>
                                            <p class="vat"><strong>VAT:</strong> đã bao gồm</p>
                                            <p class="gua"><strong>Bảo hành:</strong>: <span style="color:#ff0000">36 THÁNG </span></p>
                                            <p class="rate"></p>

                                        </div>
                                        <div class="des">
                                            <p class="cap">Mô tả sản phẩm</p>
                                            <div class="content">
                                                1 x Bộ vi xử lý/ CPU Intel Core i5-9400F (9M Cache, up to 4.10GHz) <br>
                                                1 x Bo mạch chính/ Mainboard Msi B360M Mortar<br>
                                                1 x Card màn hình/ VGA MSI RTX 2060 Gaming Z 6GB<br>
                                                1 x Bộ nhớ/ RAM Kingston HyperX Fury Red 8GB DDR4 2666 (HX426C16FR2/8)<br>
                                                1 x Nguồn/ Power CM MWE Bronze 600W V2<br>
                                            </div>
                                        </div>
                                        <div class="promotion">
                                            <p class="cap">Khuyến mại</p>
                                            <div class="content">
                                                – Bảo hành tại nhà trong vòng 1 năm đầu tiên tính từ ngày mua hàng ( Tại nội thành Hà Nội )<br>
                                                – Xử lý bảo hành siêu tốc 1 đổi 1 , thời gian xử lý bảo hành không quá 24H<br>
                                                – Hỗ trợ bảo hành phần mềm trọn đời : 24/7<br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-item" data-id="11017">
                                <a href="http://localhost:2070/bo-pc-amd-ryzen-5-3600-ram-16gb-vga-rtx-2080-8g">
                                    <div class="image">
                                        <img src="https://nguyencongpc.vn/wp-content/uploads/2-27.jpg">
                                    </div>
                                    <p class="text">
                                        <span class="name">BỘ PC AMD RYZEN 5 3600 / RAM 16GB / VGA RTX 2080 8G</span>
                                        <span class="new-price">32.900.000</span>
                                        <span class="old-price">32.900.000</span>
                                        <span class="sale">0%</span>
                                    </p>
                                </a>
                                <div id="popup-product-11017" class="popup-hover-product">
                                    <div class="top">
                                        <span class="name">BỘ PC AMD RYZEN 5 3600 / RAM 16GB / VGA RTX 2080 8G</span>
                                        <img src="/images/intel.png">
                                    </div>
                                    <div class="body">
                                        <div class="left">
                                            <img src="https://nguyencongpc.vn/wp-content/uploads/2-27.jpg">

                                        </div>
                                        <div class="left">
                                            <p class="price">32.900.000</p>
                                            <p class="old-price">32.900.000</p>
                                            <p class="vat"><strong>VAT:</strong> đã bao gồm</p>
                                            <p class="gua"><strong>Bảo hành:</strong>: <span style="color:#ff0000">36 THÁNG </span></p>
                                            <p class="rate"></p>

                                        </div>
                                        <div class="des">
                                            <p class="cap">Mô tả sản phẩm</p>
                                            <div class="content">
                                                1 x Bộ vi xử lý/ CPU Intel Core i5-9400F (9M Cache, up to 4.10GHz) <br>
                                                1 x Bo mạch chính/ Mainboard Msi B360M Mortar<br>
                                                1 x Card màn hình/ VGA MSI RTX 2060 Gaming Z 6GB<br>
                                                1 x Bộ nhớ/ RAM Kingston HyperX Fury Red 8GB DDR4 2666 (HX426C16FR2/8)<br>
                                                1 x Nguồn/ Power CM MWE Bronze 600W V2<br>
                                            </div>
                                        </div>
                                        <div class="promotion">
                                            <p class="cap">Khuyến mại</p>
                                            <div class="content">
                                                – Bảo hành tại nhà trong vòng 1 năm đầu tiên tính từ ngày mua hàng ( Tại nội thành Hà Nội )<br>
                                                – Xử lý bảo hành siêu tốc 1 đổi 1 , thời gian xử lý bảo hành không quá 24H<br>
                                                – Hỗ trợ bảo hành phần mềm trọn đời : 24/7<br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-item" data-id="11016">
                                <a href="http://localhost:2070/bo-pc-amd-ryzen-7-3700x-ram-32gb-vga-rtx-2080-8g">
                                    <div class="image">
                                        <img src="https://nguyencongpc.vn/wp-content/uploads/6-14.jpg">
                                    </div>
                                    <p class="text">
                                        <span class="name">BỘ PC AMD Ryzen 7 3700X  / RAM 32GB / VGA RTX 2080 8G</span>
                                        <span class="new-price">43.500.000</span>
                                        <span class="old-price">48.500.000</span>
                                        <span class="sale">-10%</span>
                                    </p>
                                </a>
                                <div id="popup-product-11016" class="popup-hover-product">
                                    <div class="top">
                                        <span class="name">BỘ PC AMD Ryzen 7 3700X  / RAM 32GB / VGA RTX 2080 8G</span>
                                        <img src="/images/intel.png">
                                    </div>
                                    <div class="body">
                                        <div class="left">
                                            <img src="https://nguyencongpc.vn/wp-content/uploads/6-14.jpg">

                                        </div>
                                        <div class="left">
                                            <p class="price">43.500.000</p>
                                            <p class="old-price">48.500.000</p>
                                            <p class="vat"><strong>VAT:</strong> đã bao gồm</p>
                                            <p class="gua"><strong>Bảo hành:</strong>: <span style="color:#ff0000">36 Tháng </span></p>
                                            <p class="rate"></p>

                                        </div>
                                        <div class="des">
                                            <p class="cap">Mô tả sản phẩm</p>
                                            <div class="content">
                                                1 x Bộ vi xử lý/ CPU Intel Core i5-9400F (9M Cache, up to 4.10GHz) <br>
                                                1 x Bo mạch chính/ Mainboard Msi B360M Mortar<br>
                                                1 x Card màn hình/ VGA MSI RTX 2060 Gaming Z 6GB<br>
                                                1 x Bộ nhớ/ RAM Kingston HyperX Fury Red 8GB DDR4 2666 (HX426C16FR2/8)<br>
                                                1 x Nguồn/ Power CM MWE Bronze 600W V2<br>
                                            </div>
                                        </div>
                                        <div class="promotion">
                                            <p class="cap">Khuyến mại</p>
                                            <div class="content">
                                                – Bảo hành tại nhà trong vòng 1 năm đầu tiên tính từ ngày mua hàng ( Tại nội thành Hà Nội )<br>
                                                – Xử lý bảo hành siêu tốc 1 đổi 1 , thời gian xử lý bảo hành không quá 24H<br>
                                                – Hỗ trợ bảo hành phần mềm trọn đời : 24/7<br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-item" data-id="11016">
                                <a href="http://localhost:2070/bo-pc-amd-ryzen-7-3700x-ram-32gb-vga-rtx-2080-8g">
                                    <div class="image">
                                        <img src="https://nguyencongpc.vn/wp-content/uploads/6-14.jpg">
                                    </div>
                                    <p class="text">
                                        <span class="name">BỘ PC AMD Ryzen 7 3700X  / RAM 32GB / VGA RTX 2080 8G</span>
                                        <span class="new-price">43.500.000</span>
                                        <span class="old-price">48.500.000</span>
                                        <span class="sale">-10%</span>
                                    </p>
                                </a>
                                <div id="popup-product-11016" class="popup-hover-product">
                                    <div class="top">
                                        <span class="name">BỘ PC AMD Ryzen 7 3700X  / RAM 32GB / VGA RTX 2080 8G</span>
                                        <img src="/images/intel.png">
                                    </div>
                                    <div class="body">
                                        <div class="left">
                                            <img src="https://nguyencongpc.vn/wp-content/uploads/6-14.jpg">

                                        </div>
                                        <div class="left">
                                            <p class="price">43.500.000</p>
                                            <p class="old-price">48.500.000</p>
                                            <p class="vat"><strong>VAT:</strong> đã bao gồm</p>
                                            <p class="gua"><strong>Bảo hành:</strong>: <span style="color:#ff0000">36 Tháng </span></p>
                                            <p class="rate"></p>

                                        </div>
                                        <div class="des">
                                            <p class="cap">Mô tả sản phẩm</p>
                                            <div class="content">
                                                1 x Bộ vi xử lý/ CPU Intel Core i5-9400F (9M Cache, up to 4.10GHz) <br>
                                                1 x Bo mạch chính/ Mainboard Msi B360M Mortar<br>
                                                1 x Card màn hình/ VGA MSI RTX 2060 Gaming Z 6GB<br>
                                                1 x Bộ nhớ/ RAM Kingston HyperX Fury Red 8GB DDR4 2666 (HX426C16FR2/8)<br>
                                                1 x Nguồn/ Power CM MWE Bronze 600W V2<br>
                                            </div>
                                        </div>
                                        <div class="promotion">
                                            <p class="cap">Khuyến mại</p>
                                            <div class="content">
                                                – Bảo hành tại nhà trong vòng 1 năm đầu tiên tính từ ngày mua hàng ( Tại nội thành Hà Nội )<br>
                                                – Xử lý bảo hành siêu tốc 1 đổi 1 , thời gian xử lý bảo hành không quá 24H<br>
                                                – Hỗ trợ bảo hành phần mềm trọn đời : 24/7<br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-item" data-id="11016">
                                <a href="http://localhost:2070/bo-pc-amd-ryzen-7-3700x-ram-32gb-vga-rtx-2080-8g">
                                    <div class="image">
                                        <img src="https://nguyencongpc.vn/wp-content/uploads/6-14.jpg">
                                    </div>
                                    <p class="text">
                                        <span class="name">BỘ PC AMD Ryzen 7 3700X  / RAM 32GB / VGA RTX 2080 8G</span>
                                        <span class="new-price">43.500.000</span>
                                        <span class="old-price">48.500.000</span>
                                        <span class="sale">-10%</span>
                                    </p>
                                </a>
                                <div id="popup-product-11016" class="popup-hover-product">
                                    <div class="top">
                                        <span class="name">BỘ PC AMD Ryzen 7 3700X  / RAM 32GB / VGA RTX 2080 8G</span>
                                        <img src="/images/intel.png">
                                    </div>
                                    <div class="body">
                                        <div class="left">
                                            <img src="https://nguyencongpc.vn/wp-content/uploads/6-14.jpg">

                                        </div>
                                        <div class="left">
                                            <p class="price">43.500.000</p>
                                            <p class="old-price">48.500.000</p>
                                            <p class="vat"><strong>VAT:</strong> đã bao gồm</p>
                                            <p class="gua"><strong>Bảo hành:</strong>: <span style="color:#ff0000">36 Tháng </span></p>
                                            <p class="rate"></p>

                                        </div>
                                        <div class="des">
                                            <p class="cap">Mô tả sản phẩm</p>
                                            <div class="content">
                                                1 x Bộ vi xử lý/ CPU Intel Core i5-9400F (9M Cache, up to 4.10GHz) <br>
                                                1 x Bo mạch chính/ Mainboard Msi B360M Mortar<br>
                                                1 x Card màn hình/ VGA MSI RTX 2060 Gaming Z 6GB<br>
                                                1 x Bộ nhớ/ RAM Kingston HyperX Fury Red 8GB DDR4 2666 (HX426C16FR2/8)<br>
                                                1 x Nguồn/ Power CM MWE Bronze 600W V2<br>
                                            </div>
                                        </div>
                                        <div class="promotion">
                                            <p class="cap">Khuyến mại</p>
                                            <div class="content">
                                                – Bảo hành tại nhà trong vòng 1 năm đầu tiên tính từ ngày mua hàng ( Tại nội thành Hà Nội )<br>
                                                – Xử lý bảo hành siêu tốc 1 đổi 1 , thời gian xử lý bảo hành không quá 24H<br>
                                                – Hỗ trợ bảo hành phần mềm trọn đời : 24/7<br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>

    </div>
@endsection

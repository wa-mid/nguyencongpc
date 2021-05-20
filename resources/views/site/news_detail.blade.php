@extends('layout.layout')

@section('content')
    <div id="content">
        <div class="container">
            <div class="news-list">
                <div class="main-content">
                    <div class="left-content">
                        @include('layout.menu_news')
                        <div class="news-special for-pc mgy10">
                            <div class="head">
                                <p>Tin tức nổi bật</p>
                            </div>
                            <div class="list-news">
                                <div class="box-slide">
                                    <div class="owl-carousel owl-theme" id="news-special-slide">
                                        <div class="item">
                                            <div class="news-item">
                                                <a href="http://localhost:2070/hai-gpu-tren-mot-vga-amd-radeon-pro-vega-duo-ii">
                                                    <img src="https://nguyencongpc.vn/wp-content/uploads/AMD-Radeon-Pro-Vega-Duo-II.jpg" alt="Hai GPU Trên Một VGA : AMD Radeon Pro Vega Duo II">
                                                    <div class="text">
                                                        <i class="fa fa-forward"></i>
                                                        <span>Hai GPU Trên Một VGA : AMD Radeon Pro Vega Duo II</span>
                                                        <div class="time">
                                                            <i class="fa fa-calendar-o"></i> 06/06/2019 &nbsp;&nbsp;&nbsp;
                                                            <i class="fa fa-clock-o"></i> 19:55
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="news-item">
                                                <a href="http://localhost:2070/dap-hop-main-asrock-z390-phantom-gaming-7">
                                                    <img src="https://nguyencongpc.vn/wp-content/uploads/1-15.jpg" alt="Đập hộp đánh giá Main  Asrock Z390 Phantom Gaming 7 - Bo mạch chủ phù hợp với cpu i9 9900k">
                                                    <div class="text">
                                                        <i class="fa fa-forward"></i>
                                                        <span>Đập hộp đánh giá Main  Asrock Z390 Phantom Gaming 7 - Bo mạch chủ phù hợp với cpu i9 9900k</span>
                                                        <div class="time">
                                                            <i class="fa fa-calendar-o"></i> 06/06/2019 &nbsp;&nbsp;&nbsp;
                                                            <i class="fa fa-clock-o"></i> 03:03
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="news-item">
                                                <a href="http://localhost:2070/ssd-pcie-4-0-cho-toc-do-len-den-5gb-s">
                                                    <img src="https://nguyencongpc.vn/wp-content/uploads/SSD-PCIe-4.0.jpg" alt="SSD PCIe 4.0 cho tốc độ lên đến 5Gb/s">
                                                    <div class="text">
                                                        <i class="fa fa-forward"></i>
                                                        <span>SSD PCIe 4.0 cho tốc độ lên đến 5Gb/s</span>
                                                        <div class="time">
                                                            <i class="fa fa-calendar-o"></i> 03/06/2019 &nbsp;&nbsp;&nbsp;
                                                            <i class="fa fa-clock-o"></i> 22:35
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="news-item">
                                                <a href="http://localhost:2070/so-sanh-amd-ryzen-7-3800x-vs-intel-i9-9900k">
                                                    <img src="https://nguyencongpc.vn/wp-content/uploads/Ryzen-7-3800x-1.jpg" alt="So sánh Amd Ryzen 7 3800x vs Intel i9 9900k">
                                                    <div class="text">
                                                        <i class="fa fa-forward"></i>
                                                        <span>So sánh Amd Ryzen 7 3800x vs Intel i9 9900k</span>
                                                        <div class="time">
                                                            <i class="fa fa-calendar-o"></i> 02/06/2019 &nbsp;&nbsp;&nbsp;
                                                            <i class="fa fa-clock-o"></i> 18:26
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="news-item">
                                                <a href="http://localhost:2070/so-sanh-intel-i9-9900k-vs-amd-ryzen-9-3900x">
                                                    <img src="https://nguyencongpc.vn/wp-content/uploads/RYZEN-9-3900X-2.jpg" alt="So sánh Intel i9 9900k vs Amd Ryzen 9 3900x">
                                                    <div class="text">
                                                        <i class="fa fa-forward"></i>
                                                        <span>So sánh Intel i9 9900k vs Amd Ryzen 9 3900x</span>
                                                        <div class="time">
                                                            <i class="fa fa-calendar-o"></i> 01/06/2019 &nbsp;&nbsp;&nbsp;
                                                            <i class="fa fa-clock-o"></i> 21:11
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="news-item">
                                                <a href="http://localhost:2070/amd-gioi-thieu-vga-radeon-rx-5700-cho-hieu-nang-hon-rtx-2070-10">
                                                    <img src="https://nguyencongpc.vn/wp-content/uploads/RX-5700-SERIES.jpg" alt="AMD giới thiệu VGA Radeon RX 5700 cho hiệu năng hơn RTX 2070 10%">
                                                    <div class="text">
                                                        <i class="fa fa-forward"></i>
                                                        <span>AMD giới thiệu VGA Radeon RX 5700 cho hiệu năng hơn RTX 2070 10%</span>
                                                        <div class="time">
                                                            <i class="fa fa-calendar-o"></i> 01/06/2019 &nbsp;&nbsp;&nbsp;
                                                            <i class="fa fa-clock-o"></i> 19:55
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="news-item">
                                                <a href="http://localhost:2070/intel-gioi-thieu-loat-cpu-xeon-platinum-9200-series-sieu-khung-56-core-112-luong">
                                                    <img src="https://nguyencongpc.vn/wp-content/uploads/Xeon-Platinum-9200-6.jpg" alt="Intel giới thiệu loạt Cpu Xeon Platinum 9200 series siêu khủng 56 core - 112 luồng">
                                                    <div class="text">
                                                        <i class="fa fa-forward"></i>
                                                        <span>Intel giới thiệu loạt Cpu Xeon Platinum 9200 series siêu khủng 56 core - 112 luồng</span>
                                                        <div class="time">
                                                            <i class="fa fa-calendar-o"></i> 31/05/2019 &nbsp;&nbsp;&nbsp;
                                                            <i class="fa fa-clock-o"></i> 03:41
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="news-item">
                                                <a href="http://localhost:2070/build-pc-i9-9900x-rtx-2080-lam-video-4k-chuyen-nghiep">
                                                    <img src="https://nguyencongpc.vn/wp-content/uploads/3-7.jpg" alt="Build Pc i9 9900X RTX 2080 làm video 4k chuyên nghiệp">
                                                    <div class="text">
                                                        <i class="fa fa-forward"></i>
                                                        <span>Build Pc i9 9900X RTX 2080 làm video 4k chuyên nghiệp</span>
                                                        <div class="time">
                                                            <i class="fa fa-calendar-o"></i> 30/05/2019 &nbsp;&nbsp;&nbsp;
                                                            <i class="fa fa-clock-o"></i> 19:53
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="news-item">
                                                <a href="http://localhost:2070/top-nhung-bo-pc-may-tinh-khung-nhat-doc-nhat-the-gioi-tai-computex-2019">
                                                    <img src="https://nguyencongpc.vn/wp-content/uploads/May-tinh-do-hoa-Computex-2019-10.jpg" alt="TOP những bộ PC máy tính khủng nhất, độc nhất thế giới tại Computex 2019">
                                                    <div class="text">
                                                        <i class="fa fa-forward"></i>
                                                        <span>TOP những bộ PC máy tính khủng nhất, độc nhất thế giới tại Computex 2019</span>
                                                        <div class="time">
                                                            <i class="fa fa-calendar-o"></i> 29/05/2019 &nbsp;&nbsp;&nbsp;
                                                            <i class="fa fa-clock-o"></i> 23:44
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="news-item">
                                                <a href="http://localhost:2070/computex-2019-asrock-show-nhieu-main-x570-main-server-workstation-chat-luong">
                                                    <img src="https://nguyencongpc.vn/wp-content/uploads/32.jpg" alt="Computex 2019 : Asrock show nhiều main X570, main server workstation chất lượng.">
                                                    <div class="text">
                                                        <i class="fa fa-forward"></i>
                                                        <span>Computex 2019 : Asrock show nhiều main X570, main server workstation chất lượng.</span>
                                                        <div class="time">
                                                            <i class="fa fa-calendar-o"></i> 29/05/2019 &nbsp;&nbsp;&nbsp;
                                                            <i class="fa fa-clock-o"></i> 21:03
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="news-item">
                                                <a href="http://localhost:2070/computex-2019">
                                                    <img src="https://nguyencongpc.vn/wp-content/uploads/4BC63A3B-054E-4704-A110-6C88E2892B2E.jpeg" alt="Computex 2019">
                                                    <div class="text">
                                                        <i class="fa fa-forward"></i>
                                                        <span>Computex 2019</span>
                                                        <div class="time">
                                                            <i class="fa fa-calendar-o"></i> 29/05/2019 &nbsp;&nbsp;&nbsp;
                                                            <i class="fa fa-clock-o"></i> 11:30
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="news-item">
                                                <a href="http://localhost:2070/intel-tiet-lo-them-ve-cpu-ice-lake-10nm-va-core-i9-9900ks-chuyen-cho-game-va-tinh-toan-ai">
                                                    <img src="https://nguyencongpc.vn/wp-content/uploads/A97A87F8-9619-458E-BD34-32C266846DA0.jpeg" alt="Intel tiết lộ thêm về Cpu Ice Lake 10nm và core i9-9900ks chuyên cho game và tính toán AI">
                                                    <div class="text">
                                                        <i class="fa fa-forward"></i>
                                                        <span>Intel tiết lộ thêm về Cpu Ice Lake 10nm và core i9-9900ks chuyên cho game và tính toán AI</span>
                                                        <div class="time">
                                                            <i class="fa fa-calendar-o"></i> 28/05/2019 &nbsp;&nbsp;&nbsp;
                                                            <i class="fa fa-clock-o"></i> 15:46
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="view-all">
                                    <a href="/category/tin-tuc-noi-bat/" class="view-all">Xem tất cả</a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="right-content">
                        <div class="breadcrumb for-pc">
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
                                        <span itemprop="name">Bộ máy sử dụng chip AMD</span></a>
                                    <meta itemprop="position" content="3" />
                                    <i class="fa fa-angle-double-right"></i>
                                </li>

                                <li itemprop="itemListElement" itemscope>
                                    <span itemprop="name">Bộ PC AMD Ryzen 7 3700X / Ram 32Gb / GTX 1660 6G</span>
                                    <meta itemprop="position" content="4" />
                                </li>
                            </ol>
                        </div>
                        <h1 class="product-name for-pc">10 Cấu Hình Máy Tính Dựng Phim, Render Biên Tập Video Chuyên Nghiệp</h1>
                        <div class="news-content">
                            <p><span style="font-weight: 400;"><a href="https://nguyencongpc.vn/10-cau-hinh-dung-phim-render-bien-tap-video-chuyen-nghiep/"><strong>10 Cấu hình dựng phim, Render biên tập video chuyên nghiệp 2019</strong></a><br><br>Hiện tại mạng xã hội có thể nói đang phát triển rất nhanh và được nhiều người sử dụng. Đây chính là nơi để mọi người có thể chia sẻ những hình ảnh và video cho mọi người cùng xem. Rất nhiều người đã biết tận dụng nó để tạo ra những video dịch vụ, chất lượng cao phục vụ cho việc quảng cáo hay chia sẻ sở thích cá nhân. Chính vì vậy mà nhu cầu sở hữu những bộ PC đủ mạnh để có thể chỉnh sửa video hiện tại đang rất cao và được nhiều người quan tâm hơn bao giờ hết. Liệu các bạn có biết làm sao để có thể xây dựng một cấu hình đủ mạnh nhưng vẫn phải cân đối chi phí đầu tư. Trong bài viết này Nguyễn Công PC sẽ hướng dẫn và giới thiệu tới các bạn những cấu hình phù hợp nhất cho việc chỉnh sửa và render video.</span></p>
                            <img class="alignnone wp-image-9518 size-full" src="https://nguyencongpc.vn/wp-content/uploads/i9-9900k-3.jpg" alt="" width="2048" height="1319" srcset="https://nguyencongpc.vn/wp-content/uploads/i9-9900k-3.jpg 2048w, https://nguyencongpc.vn/wp-content/uploads/i9-9900k-3-213x137.jpg 213w, https://nguyencongpc.vn/wp-content/uploads/i9-9900k-3-640x412.jpg 640w" sizes="(max-width: 2048px) 100vw, 2048px"><img class="alignnone wp-image-11270 size-full" src="https://nguyencongpc.vn/wp-content/uploads/2-36.jpg" alt="" width="1950" height="1300" srcset="https://nguyencongpc.vn/wp-content/uploads/2-36.jpg 1950w, https://nguyencongpc.vn/wp-content/uploads/2-36-213x142.jpg 213w, https://nguyencongpc.vn/wp-content/uploads/2-36-640x427.jpg 640w" sizes="(max-width: 1950px) 100vw, 1950px"><br>
                            <p><b>DỰNG PHIM CẦN SỬ DỤNG NHỮNG PHẦN MỀM NÀO?&nbsp;</b></p>
                            <p><span style="font-weight: 400;">Hiện tại đang có rất nhiều phần mềm hỗ trợ việc các bạn dựng phim một cách tốt nhất, mỗi phần mềm sẽ có một điểm mạnh riêng mà các bạn có thể tận dụng nó làm điểm mạnh riêng của mình. </span></p>
                            <ul>
                                <li style="font-weight: 400;"><span style="font-weight: 400;"><span style="color: #3366ff;"><strong>Adobe Premiere :</strong></span> Đây có thể nói là phần mềm hỗ trợ dựng phim phổ biến nhất hiện nay vì tính tiện dụng của nó. Khi sử dụng Adobe Premiere, các bạn sẽ có lợi thế rất lớn về hệ sinh thái Adobe có thể hỗ trợ lẫn nhau và các bạn sẽ không bao giờ phải than phiền về việc thiếu tính năng. Tuy nhiên vì nó quá mạnh nên các bạn cũng sẽ mất một khoản phí bản quyền khá lớn cho mỗi năm sử dụng.<br><br></span></li>
                                <li style="font-weight: 400;"><span style="font-weight: 400;"><span style="color: #3366ff;"><strong>Adobe After Effect :</strong></span> Đây là một phần mềm cũng dùng để dựng phim trong hệ sinh thái Adobe nhưng nó được thiết kế để chuyên biệt cho việc tạo hiệu ứng và motion. Các bạn có thể hiểu Adobe Premiere là để cắt ghép và tạo những video lớn thành phẩm, còn After Effect sẽ được sử dụng để tạo ra những đoạn video ngắn có hiệu ứng phức tạp.<br><br></span></li>
                                <li style="font-weight: 400;"><span style="font-weight: 400;"><span style="color: #3366ff;"><strong>Davinci Resolve :</strong></span> Nếu như Adobe phải mất một khoản phí bản quyền hàng năm khá lớn thì các bạn có thể sử dụng một giải pháp rẻ tiền hơn là Davinci Resolve khi chỉ mất 300$ cho phiên bản Studio đầy đủ tính năng. Đối với Davinci Resolve có một điểm mạnh hơn rất nhiều so với Adobe Premiere là khả năng cân chỉnh màu bá đạo mà khó phần mềm nào có thể so bì được.<br><br></span></li>
                                <li style="font-weight: 400;"><span style="font-weight: 400;"><span style="color: #3366ff;"><strong>Camtasia :</strong></span> Đây không phải là một phần mềm mạnh cho việc chỉnh sửa video chuyên nghiệp vì tính năng của nó còn khá sơ sài khi so với những phần mềm khác. Tuy nhiên nó vẫn có một điểm mạnh trong mình là hỗ trợ quay lại video màn hình hình rất tốt.<br><br></span></li>
                                <li style="font-weight: 400;"><span style="font-weight: 400;"><span style="color: #3366ff;"><strong>Sony Vegas :</strong> </span>Nếu như các bạn không thể bỏ tiền ra để mua bản quyền của Davinci Resolve hay Adobe thì đây là một sự thay thế hoàn hảo. Sony Vegas sở hữu tương đối nhiều tính năng, dễ sử dụng và hoàn toàn miễn phí cho các bạn muốn sử dụng. (*Đối với Camtasia và Sony Vegas sẽ yêu cầu cấu hình khá giống với Davinci Resolve)</span></li>
                            </ul>
                            <p><strong> <img class="alignnone wp-image-10193 size-full" src="https://nguyencongpc.vn/wp-content/uploads/Adobe-Premiere.png" alt="" width="2560" height="1440" srcset="https://nguyencongpc.vn/wp-content/uploads/Adobe-Premiere.png 2560w, https://nguyencongpc.vn/wp-content/uploads/Adobe-Premiere-213x120.png 213w, https://nguyencongpc.vn/wp-content/uploads/Adobe-Premiere-640x360.png 640w" sizes="(max-width: 2560px) 100vw, 2560px"></strong></p>
                            <p><span style="color: #000080;"><b>Cấu Hình Cho Những Youtuber Nghiệp Dư, Edit và Render Video FullHD, 2K</b></span></p>
                            <p><span style="font-weight: 400;">Nếu như các bạn đang là một Youtuber nghiệp dư, nhưng Vlogger mới vào nghề thì thường các bạn sẽ không đầu tư được quá nhiều chi phí cho PC vì còn phải đầu tư tiền vào máy ảnh và những thiết bị phụ trợ nữa. Thông thường các bạn sẽ sử dụng những thiết bị quay phim như GoPro Hero 7, Sony A6000, Canon EOS M50,…. Video sau khi được quay ra sẽ có chất lượng FullHD hoặc 2K và sau đó các bạn cũng chỉ render ở độ phân giải FullHD. Trên thực tế nhu cầu này khá nhẹ nhàng, các bạn không cần một cấu hình quá khủng bố để dựng phim hay render.</span></p>
                            <ul>
                                <li style="font-weight: 400;"><span style="font-weight: 400;"><span style="color: #000080;"><strong>CPU :</strong></span> Khi lựa chọn CPU các bạn nên chú ý một &nbsp;chút vào phần mềm mà mình đang sử dụng. Nếu như các bạn đang sử dụng trên hệ sinh thái Adobe thì Intel luôn là sự ưu tiên hàng đầu vì nó có xung nhịp cao phục vụ cho việc dựng hình mượt mà và iGPU hỗ trợ tính năng Intel Quick Sync giúp giảm tới 50% thời gian render. Vì dụ như sử dụng i5 9400 có iGPU là UHD630 hỗ trợ Intel Quick Sync sẽ tốt hơn so với <a href="https://nguyencongpc.vn/cpu-intel-core-i5-9400f-2-90ghz-turbo-up-to-4-10ghz-9mb-6-cores-6-threads-socket-1151-coffee-lake/">i5 9400F</a> hay <a href="https://nguyencongpc.vn/cpu-amd-ryzen-5-2600x/">Ryzen 5 2600X</a> không có tính năng đấy. </span>Còn nếu như các bạn đang sử dụng Davinci resolve thì <a href="https://nguyencongpc.vn/cpu-bo-vi-xu-ly/cpu-amd/">AMD Ryzen</a> lại là sự lựa chọn tốt hơn vì nó có nhiều nhân hơn giúp render nhanh hơn.</li>
                            </ul>
                            <ul>
                                <li style="font-weight: 400;"><span style="font-weight: 400;"><span style="color: #000080;"><strong>VGA :</strong></span> Ở phân khúc này các bạn không cần phải suy nghĩ quá nhiều về việc sử dụng card đồ họa gì vì chỉ cần một chiếc <a href="https://nguyencongpc.vn/?s=vga+gtx+1060&amp;post_type=product">GTX 1060</a> có mức giá vô cùng hợp lý thôi là các bạn đã không cần phải suy nghĩ gì nhiều nữa rồi vì nó quá mượt. Nếu như kinh phí quá thấp thì <a href="https://nguyencongpc.vn/?s=vga+gtx+1050ti&amp;post_type=product">GTX 1050Ti</a> vẫn có thể đáp ứng tốt ở độ phân giải FullHD, nhưng nếu gắng được để lên <a href="https://nguyencongpc.vn/?s=vga+gtx+1060&amp;post_type=product">GTX 1060</a> sẽ là sự lựa chọn tốt nhất.<br><br></span></li>
                                <li style="font-weight: 400;"><span style="font-weight: 400;"><span style="color: #000080;"><strong>RAM :</strong></span> Đối với những video có độ phân giải FullHD hay 2K nó chưa đồi hỏi quá nhiều ở dung lượng RAM của các bạn nhưng 8Gb là hoàn toàn không đủ mà vẫn phải là 16Gb. Vì có một điều chắc chắn là trong quá trình dựng phim các bạn sẽ phải sử dụng đa nhiệm rất nhiều, ví dụ như lướt web để tìm thêm thông tin hay Photoshop, Lightroom để chỉnh sửa một số hình ảnh cho video. Còn Bus RAM thì các bạn có thể tạm gác qua một bên khi chỉ cần <a href="https://nguyencongpc.vn/?s=2666&amp;post_type=product">2666MHz</a> là được vì CPU ở tầm giá này chưa tận dụng được lợi thế hoàn toàn từ Bus <a href="https://nguyencongpc.vn/ram/">RAM</a> cao.<br><br></span></li>
                                <li style="font-weight: 400;"><span style="font-weight: 400;"><span style="color: #000080;"><strong>SSD :</strong></span> <a href="https://nguyencongpc.vn/?s=ssd&amp;post_type=product">SSD</a> có thể nói là linh kiện không thể nào thiếu được nếu như các bạn đang muốn dựng phim hay render phim. Tuy nhiên ở phân khúc này các bạn chỉ cần những ổ cứng giao thức Sata chứ chưa cần đến NVMe vì dung lượng file video không quá lớn và không cần sử dụng đến đa luồng dữ liệu. Tốt nhất các bạn nên sở hữu cho mình một chiếc ổ cứng SSD Sata 3 dung lượng 2400Gb trở lên.</span></li>
                            </ul>
                            <p><span style="font-weight: 400;"><br><img class="alignnone wp-image-8044 size-full" src="https://nguyencongpc.vn/wp-content/uploads/4-2.jpg" alt="" width="2048" height="1365" srcset="https://nguyencongpc.vn/wp-content/uploads/4-2.jpg 2048w, https://nguyencongpc.vn/wp-content/uploads/4-2-213x142.jpg 213w, https://nguyencongpc.vn/wp-content/uploads/4-2-640x427.jpg 640w" sizes="(max-width: 2048px) 100vw, 2048px"></span></p>
                            <p><b>Cấu Hình Cho Những Youtuber Chuyên Nghiệp, Quay Video Dịch Vụ Cao Cấp, Dựng Phim Và Render Video 4K &nbsp;</b></p>
                            <p><span style="font-weight: 400;">Đối với nhu cầu này nó sẽ yêu cầu cấu hình khá phức tạp và phụ thuộc vào phần mềm cũng như máy quay mà bạn đang sử dụng nữa. Bởi vì mỗi phần mềm hay mỗi định dạng video mà các bạn quay ra lại yêu cầu một cấu hình khác nhau. </span></p>
                            <ul>
                                <li style="font-weight: 400;"><span style="font-weight: 400;"><span style="color: #000080;"><strong>CPU :</strong> </span>Nếu như các bạn đang sử dụng những máy ảnh chuyên nghiệp có thể quay phim 4K và cho ra định dạng Log Profile như Sony A7 III, Sony A7 SII, Sony RX100 Mark VI, Panasonic Lumix GH5, Fujifilm XT3, Canon EOS-R,… thì đây có thể nói là đất diễn của vi xử lý Intel Core <a href="https://nguyencongpc.vn/cpu-intel-core-i9-9900k-3-6-ghz-turbo-up-to-5-0-ghz-8-cores-16-threads-16mb-socket-1151-coffee-lake/">i9-9900K</a> và Intel Core<a href="https://nguyencongpc.vn/cpu-intel-core-i7-9700k-3-6-ghz-turbo-up-to-4-9-ghz-8-cores-8-threads-12mb-socket-1151-coffee-lake/"> i7-9700K</a>. Vì nó có một lượng nhân đủ lớn để render nhanh và xung nhịp khủng nhất hiện tại để dựng hình tốt. Hơn hết nó còn còn iGPU là UHD630 để hỗ trợ tính năng Intel Quick Sync làm cho mọi thứ trở nên mượt mà hơn nữa nếu các bạn đang sử dụng ở trên Adobe Premiere. Trên thực tế nếu như các bạn đang xử lý những file video này trên Adobe Premiere thì <a href="https://nguyencongpc.vn/cpu-intel-core-i9-9900k-3-6-ghz-turbo-up-to-5-0-ghz-8-cores-16-threads-16mb-socket-1151-coffee-lake/">i9 9900K</a> còn nhanh hơn cả <a href="https://nguyencongpc.vn/cpu-intel-core-i9-9900x-3-5-ghz-turbo-4-4-ghz-up-to-4-5-ghz-19-25-mb-10-cores-20-threads-socket-2066-no-fan/">i9 9900X</a> có mức giá đắt gấp đôi. Nhưng nếu như các bạn lại đang xử lý video trên Davinci Resolve thì câu chuyện lại hoàn toàn ngược lại. <br></span>Nếu như nhu cầu của các bạn cao hơn nữa là sử dụng những máy quay phim chuyện nghiệp như Blackmagic, RED, Arri ALEXA, Canon C300, Sony FS7,… thì lúc này những vi xử lý Core i tầm trung không còn được mạnh nữa mà lúc này sẽ là đất diễn của dòng vi xử lý Core-X như <a href="https://nguyencongpc.vn/cpu-intel-core-i9-9900x-3-5-ghz-turbo-4-4-ghz-up-to-4-5-ghz-19-25-mb-10-cores-20-threads-socket-2066-no-fan/">i9 9900X</a>, <a href="https://nguyencongpc.vn/cpu-intel-core-i9-9980xe-extreme-edition-3-0-ghz-turbo-4-4-ghz-up-to-4-5-ghz-24-75-mb-18-cores-36-threads-socket-2066/">i9 9980XE</a> hay dòng <a href="https://nguyencongpc.vn/?s=threadripper&amp;post_type=product">Threadripper</a> của <a href="https://nguyencongpc.vn/cpu-bo-vi-xu-ly/cpu-amd/">AMD</a> như Threadripper <a href="https://nguyencongpc.vn/cpu-amd-ryzen-threadripper-2950x/">2950X</a>, <a href="https://nguyencongpc.vn/cpu-amd-ryzen-threadripper-2970wx-3-0-ghz/">2970WX</a>, <a href="https://nguyencongpc.vn/bo-may-tinh-workstation-do-hoa-ryzen-threadripper-2990wx/">2990WX</a>. Đối với Adobe Premiere thì các bạn nên dùng CPU của Intel còn đối với Davinci Resolve thì các bạn nên dùng <a href="https://nguyencongpc.vn/cpu-bo-vi-xu-ly/cpu-amd/">CPU của AMD.</a></li>
                            </ul>
                            <ul>
                                <li style="font-weight: 400;"><span style="font-weight: 400;"><span style="color: #000080;"><strong>VGA :</strong></span> Đối với những phần mềm dựng phim như Adobe Premiere, Davinci Resolve, Sony Vegas,… thì nó sẽ không tiêu tốn vRAM của GPU quá nhiêu nền khi lựa chọn card đồ họa các bạn có thể bỏ qua vấn đề này mà nên lựa chọn một mẫu card đồ họa có nhân GPU thật mạnh. <a href="https://nguyencongpc.vn/?s=RTX+2060&amp;post_type=product">RTX 2060</a> hiện tại có thể nói là mẫu card đồ họa có hiệu năng trên giá thành tốt nhất khi hoàn toàn có thể đánh bại người đàn anh của mình là <a href="https://nguyencongpc.vn/vga-msi-gtx-1070-ti-duke-8g/">GTX 1070Ti.</a> Nếu như các bạn có kinh phí đâu tư hơn một chút thì <a href="https://nguyencongpc.vn/?s=2070&amp;post_type=product">RTX 2070</a> là sự lựa chọn tuyệt vời. Đương nhiên tuyệt vời nhất sẽ là RTX 2080Ti.<br></span>Đối với những bạn làm việc trong môi trường đặc biệt cần đến hệ màu 10bit thì <a href="https://nguyencongpc.vn/vga-nvidia-quadro-p4000-8gb-gddr5/">Quadro P4000</a> sẽ là tối ưu nhất, nhưng các bạn nên nhớ là hiệu năng của nó sẽ không bằng được <a href="https://nguyencongpc.vn/?s=2080&amp;post_type=product">RTX 2080.</a></li>
                            </ul>
                            <ul>
                                <li style="font-weight: 400;"><span style="font-weight: 400;"><span style="color: #000080;"><strong>RAM :</strong> </span>Đối nhu cầu cao như thế này dung lượng <a href="https://nguyencongpc.vn/ram/">RAM</a> càng nhiều sẽ là càng tốt, nhưng tối thiểu phải là 32Gb. Bus <a href="https://nguyencongpc.vn/ram/">RAM</a> &nbsp;tối thiểu là 3000MHz để khả năng trao đổi dữ liệu giữa CPU và các thành phần khác trong PC không bị nghẽn.<br><br></span></li>
                                <li style="font-weight: 400;"><span style="font-weight: 400;"><span style="color: #000080;"><strong>SSD :</strong></span> Đối với nhu cầu này thì dung lượng những file video mà các bạn quay ra sẽ rất lớn, có thể cả chục Gb hay cẩ trăm Gb thế nên tốc độ <a href="https://nguyencongpc.vn/o-cung-hdd-ssd/">SSD</a> sẽ phải nhanh nhất có thể. Thế nên sự lựa chọn SSD NVMe là điều chắc chắn và dung lượng tối thiểu là 500Gb.<br><br></span></li>
                            </ul>
                            <p><strong><span style="color: #333399;"><img class="alignnone wp-image-10225 size-full" src="https://nguyencongpc.vn/wp-content/uploads/i9-9900k-9.jpg" alt="" width="2048" height="1365" srcset="https://nguyencongpc.vn/wp-content/uploads/i9-9900k-9.jpg 2048w, https://nguyencongpc.vn/wp-content/uploads/i9-9900k-9-213x142.jpg 213w, https://nguyencongpc.vn/wp-content/uploads/i9-9900k-9-640x427.jpg 640w" sizes="(max-width: 2048px) 100vw, 2048px"><br><br>➤ Nguyễn Công PC xin giới thiệu đến các bạn 10 Cấu hình dựng phim, Render biên tập video chuyên nghiệp từ bình dân tới cao cấp xu hướng 2019 :&nbsp;</span><br><br><span style="color: #0000ff;">CẤU HÌNH MÁY TÍNH DỰNG PHIM FULL HDD, RENDER EDIT VIDEO 2K :&nbsp;</span></strong></p>
                            <p>&nbsp;<strong>Cấu hình 1 : Sử dụng Cpu i5 9400f – Ram 16Gb – GTX 1050Ti :&nbsp;</strong></p>
                            <em>➽ CPU : <a href="https://nguyencongpc.vn/cpu-intel-core-i5-9400f-2-90ghz-turbo-up-to-4-10ghz-9mb-6-cores-6-threads-socket-1151-coffee-lake/">Core I5 9400F</a> – 2.9Ghz Turbo up 4.1Ghz /9Mb / 6 Cores /6 Threads</em><br><em>➽ TẢN NHIỆT : CoolerMaster T400i</em><br><em>➽ MAIN : Asus ROG Strix B360 G Gaming</em><br><em>➽ RAM : Gskill RipJaws V 16Gb bus 2800 ( 2*8)</em><br><em>➽ SSD : &nbsp;Apacer Panther 240GB</em><br><em>➽ HDD : Seagate 1TB 7200RPM</em><br><em>➽ VGA : Nvidia GTX 1050Ti 4GD5</em><br><em>➽ PSU : Xigmatek Xpower 450</em><br><em>➽ CASE : Xigmatek Venom + 4 Fan LED<br><br><span style="color: #3366ff;">➤ ➤ ➤ GIÁ : 15.900.000đ </span>– New 100% chính hãng bảo hành 3 năm.<br>&nbsp; &nbsp; &nbsp; &nbsp; 🔎 Link sản phẩm :&nbsp; <a href="https://nguyencongpc.vn/bo-pc-intel-core-i5-9400f/">tại đây</a> <br>===================================</em>
                        </div>
                        <div class="fb-comments" data-href="https:nguyencongpc.vn" data-width="100%" data-order-by="reverse_time" data-numposts="5"></div>

                    </div>
                </div>


            </div>

        </div>
    </div>

@endsection

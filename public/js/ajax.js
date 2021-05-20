/*Jquery toast */
"function"!=typeof Object.create&&(Object.create=function(t){function o(){}return o.prototype=t,new o}),function(t,o,i,s){"use strict";var n={_positionClasses:["bottom-left","bottom-right","top-right","top-left","bottom-center","top-center","mid-center"],_defaultIcons:["success","error","info","warning"],init:function(o,i){this.prepareOptions(o,t.toast.options),this.process()},prepareOptions:function(o,i){var s={};"string"==typeof o||o instanceof Array?s.text=o:s=o,this.options=t.extend({},i,s)},process:function(){this.setup(),this.addToDom(),this.position(),this.bindToast(),this.animate()},setup:function(){var o="";if(this._toastEl=this._toastEl||t("<div></div>",{class:"jq-toast-single"}),o+='<span class="jq-toast-loader"></span>',this.options.allowToastClose&&(o+='<span class="close-jq-toast-single">&times;</span>'),this.options.text instanceof Array){this.options.heading&&(o+='<h2 class="jq-toast-heading">'+this.options.heading+"</h2>"),o+='<ul class="jq-toast-ul">';for(var i=0;i<this.options.text.length;i++)o+='<li class="jq-toast-li" id="jq-toast-item-'+i+'">'+this.options.text[i]+"</li>";o+="</ul>"}else this.options.heading&&(o+='<h2 class="jq-toast-heading">'+this.options.heading+"</h2>"),o+=this.options.text;this._toastEl.html(o),!1!==this.options.bgColor&&this._toastEl.css("background-color",this.options.bgColor),!1!==this.options.textColor&&this._toastEl.css("color",this.options.textColor),this.options.textAlign&&this._toastEl.css("text-align",this.options.textAlign),!1!==this.options.icon&&(this._toastEl.addClass("jq-has-icon"),-1!==t.inArray(this.options.icon,this._defaultIcons)&&this._toastEl.addClass("jq-icon-"+this.options.icon)),!1!==this.options.class&&this._toastEl.addClass(this.options.class)},position:function(){"string"==typeof this.options.position&&-1!==t.inArray(this.options.position,this._positionClasses)?"bottom-center"===this.options.position?this._container.css({left:t(o).outerWidth()/2-this._container.outerWidth()/2,bottom:20}):"top-center"===this.options.position?this._container.css({left:t(o).outerWidth()/2-this._container.outerWidth()/2,top:20}):"mid-center"===this.options.position?this._container.css({left:t(o).outerWidth()/2-this._container.outerWidth()/2,top:t(o).outerHeight()/2-this._container.outerHeight()/2}):this._container.addClass(this.options.position):"object"==typeof this.options.position?this._container.css({top:this.options.position.top?this.options.position.top:"auto",bottom:this.options.position.bottom?this.options.position.bottom:"auto",left:this.options.position.left?this.options.position.left:"auto",right:this.options.position.right?this.options.position.right:"auto"}):this._container.addClass("bottom-left")},bindToast:function(){var t=this;this._toastEl.on("afterShown",function(){t.processLoader()}),this._toastEl.find(".close-jq-toast-single").on("click",function(o){o.preventDefault(),"fade"===t.options.showHideTransition?(t._toastEl.trigger("beforeHide"),t._toastEl.fadeOut(function(){t._toastEl.trigger("afterHidden")})):"slide"===t.options.showHideTransition?(t._toastEl.trigger("beforeHide"),t._toastEl.slideUp(function(){t._toastEl.trigger("afterHidden")})):(t._toastEl.trigger("beforeHide"),t._toastEl.hide(function(){t._toastEl.trigger("afterHidden")}))}),"function"==typeof this.options.beforeShow&&this._toastEl.on("beforeShow",function(){t.options.beforeShow(t._toastEl)}),"function"==typeof this.options.afterShown&&this._toastEl.on("afterShown",function(){t.options.afterShown(t._toastEl)}),"function"==typeof this.options.beforeHide&&this._toastEl.on("beforeHide",function(){t.options.beforeHide(t._toastEl)}),"function"==typeof this.options.afterHidden&&this._toastEl.on("afterHidden",function(){t.options.afterHidden(t._toastEl)}),"function"==typeof this.options.onClick&&this._toastEl.on("click",function(){t.options.onClick(t._toastEl)})},addToDom:function(){var o=t(".jq-toast-wrap");if(0===o.length?(o=t("<div></div>",{class:"jq-toast-wrap",role:"alert","aria-live":"polite"}),t("body").append(o)):this.options.stack&&!isNaN(parseInt(this.options.stack,10))||o.empty(),o.find(".jq-toast-single:hidden").remove(),o.append(this._toastEl),this.options.stack&&!isNaN(parseInt(this.options.stack),10)){var i=o.find(".jq-toast-single").length-this.options.stack;i>0&&t(".jq-toast-wrap").find(".jq-toast-single").slice(0,i).remove()}this._container=o},canAutoHide:function(){return!1!==this.options.hideAfter&&!isNaN(parseInt(this.options.hideAfter,10))},processLoader:function(){if(!this.canAutoHide()||!1===this.options.loader)return!1;var t=this._toastEl.find(".jq-toast-loader"),o=(this.options.hideAfter-400)/1e3+"s",i=this.options.loaderBg,s=t.attr("style")||"";s=s.substring(0,s.indexOf("-webkit-transition")),s+="-webkit-transition: width "+o+" ease-in;                       -o-transition: width "+o+" ease-in;                       transition: width "+o+" ease-in;                       background-color: "+i+";",t.attr("style",s).addClass("jq-toast-loaded")},animate:function(){t=this;if(this._toastEl.hide(),this._toastEl.trigger("beforeShow"),"fade"===this.options.showHideTransition.toLowerCase()?this._toastEl.fadeIn(function(){t._toastEl.trigger("afterShown")}):"slide"===this.options.showHideTransition.toLowerCase()?this._toastEl.slideDown(function(){t._toastEl.trigger("afterShown")}):this._toastEl.show(function(){t._toastEl.trigger("afterShown")}),this.canAutoHide()){var t=this;o.setTimeout(function(){"fade"===t.options.showHideTransition.toLowerCase()?(t._toastEl.trigger("beforeHide"),t._toastEl.fadeOut(function(){t._toastEl.trigger("afterHidden")})):"slide"===t.options.showHideTransition.toLowerCase()?(t._toastEl.trigger("beforeHide"),t._toastEl.slideUp(function(){t._toastEl.trigger("afterHidden")})):(t._toastEl.trigger("beforeHide"),t._toastEl.hide(function(){t._toastEl.trigger("afterHidden")}))},this.options.hideAfter)}},reset:function(o){"all"===o?t(".jq-toast-wrap").remove():this._toastEl.remove()},update:function(t){this.prepareOptions(t,this.options),this.setup(),this.bindToast()},close:function(){this._toastEl.find(".close-jq-toast-single").click()}};t.toast=function(t){var o=Object.create(n);return o.init(t,this),{reset:function(t){o.reset(t)},update:function(t){o.update(t)},close:function(){o.close()}}},t.toast.options={text:"",heading:"",showHideTransition:"fade",allowToastClose:!0,hideAfter:3e3,loader:false,loaderBg:"#9EC600",stack:5,position:"top-right",bgColor:!1,textColor:'#fff',textAlign:"left",icon:!1,beforeShow:function(){},afterShown:function(){},beforeHide:function(){},afterHidden:function(){},onClick:function(){}}}(jQuery,window,document);

function showMessage(message, type = "info") {
    switch (type) {
        case "info":
            $.toast({
                text: message,
                bgColor: '#21bf77',              // Background color for toast
            });
            break;
        case "warning":
            $.toast({
                text: message,
                bgColor: '#f39c12',              // Background color for toast
            });
            break;
        case "alert":
            $.toast({
                text: message,
                bgColor: '#f56954',              // Background color for toast
            });
            break;
        default:
            $.toast(message);
    }
}

/*-----
call-22: Class dùng để get content list sản phẩm cho menu lv2
----*/
function handleAjax(url,data,success,type,dataType){
    if(typeof(type) == 'undefined'){
        type = 'POST';
    }
    if(typeof(dataType) == 'undefined'){
        dataType = 'html';
    }

    $.ajax({
        url: url,
        type: type,
        dataType: dataType,
        data: data,
    }).done(success);
}

function checMobile(){
    //var isMobile = {
        if(navigator.userAgent.match(/Android/i)){
            isMobile = 'android';
        }else if(navigator.userAgent.match(/BlackBerry/i)){
            isMobile = 'blackberry';
        }else if(navigator.userAgent.match(/iPhone|iPad|iPod/i)){
            isMobile = 'ios';
        }else if(navigator.userAgent.match(/Opera Mini/i)){
            isMobile = 'opera';
        }else if(navigator.userAgent.match(/IEMobile/i)){
            isMobile = 'windows';
        }else{
            isMobile = 'desktop';
        }

    return isMobile;
}


function toggleMenu(){
    var $menu = $("#main-menu");
    if($menu.hasClass('active')){
        $menu.removeClass('active');
    }else{
        $menu.addClass('active');
    }
}

function toggleSubMenu(_this){
    //var $menu = $("#main-menu>ul>li");
    $parent = _this.parents(".menu-item");
    console.log($parent);
    if($parent.hasClass('active')){
        $parent.removeClass('active');
    }else{
        $(".menu-item").removeClass('active')
        $parent.addClass('active');
    }
}


$(document).ready(function(){
    var md = new MobileDetect(window.navigator.userAgent);
    var succ = function(data){
        $("#list-product-submenu").html(data);
    }
    if(md.mobile() !== null) {

        // Trường hợp là mobile load riêng ảnh khác cho các class có tên là .image-mobile
        $(".image-mobile").each(function() {
            $this = $(this);
            var src_mobile = $this.attr('data-src-mobile');
            $this.attr('src',src_mobile)
        });
    }else{
        //Trường hợp là PC thì fix thẻ body cho min-witdh = 1200px
        $("body").css({"min-width":"1200px","overflow-x":"auto",});
    }


    /*--Fix top menu--*/
    $(window).scroll(function (event) {
        var scroll = $(window).scrollTop();
        //console.log(scroll);
        if(scroll > 120){
            $("#header").addClass('fixtop');
            $(".product-detail .nav-tabs").addClass('show');

        }else{
            $("#header").removeClass('fixtop');
            $(".product-detail .nav-tabs").removeClass('show');
        }

        if(scroll > 900){
            $("#main-menu.menu-home").addClass('fixtop');
            $("#main-menu.menu-home").removeClass('open');
            $("#page-home #boxFilter").addClass('fixtop');
            return false;
        }else{
            $("#main-menu.menu-home").removeClass('fixtop');
            $("#main-menu.menu-home").addClass('open');
            $("#page-home #boxFilter").removeClass('fixtop');
        }
    });

    /*--Slide banner chính--*/
    $("#slide-banner").owlCarousel({
        loop: true,
        nav: true,
        dots:true,
        items:1,
        autoplay:true,
        autoplayTimeout:3000,
        navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
    });



    /*---PRODUCT SALE SLIDE---*/
    /*-Mobile và Desktop sẽ dùng option khác nhau-*/
    var $opt_slide = {};
    if(md.mobile() !== null){ // Trường hợp là mobile
        $opt_slide = {
            loop: true,
            margin: 10,
            nav: false,
            dots:false,
            stagePadding: 30,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            },
            autoplay:true,
            autoplayTimeout:3000,
            navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
        };
    }else{
        $opt_slide = {
            loop: true,
            margin: 10,
            nav: true,
            dots:false,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            },
            autoplay:true,
            autoplayTimeout:3000,
            navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']

        };
    }
    //console.log($opt_slide);
    $('#slide1').owlCarousel({loop: false,items:1});

    $('#news-special-slide').owlCarousel({
        loop: false,
        nav: true,
        dots:false,
        items:1,
        navText:['<i class="fa fa-long-arrow-left"></i>','<i class="fa fa-long-arrow-right"></i>']
    });

    var $opt_slide_2 = {
        loop: false,
        nav: false,
        dots:false,
        items:5,
        margin:10,
        autoplay:true,
        autoplayTimeout:3000,
        navText:['<i class="fa fa-arrow-left"></i>','<i class="fa fa-arrow-right"></i>']
    }
    if(md.mobile() !== null){
        $opt_slide_2 = {
            loop: true,
            margin: 10,
            nav: false,
            dots:false,
            stagePadding: 30,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        };
    }
    $('#slide2').owlCarousel($opt_slide_2);



    $("#btn-menu").click(function(){
        toggleMenu();
    });
    $("#btn-back-menu").click(function(){
        toggleMenu();
    });

    $("#btn-filter").click(function(){
        $(".product-filter").toggleClass("active");
    })
    $(".btn-close-filter").click(function(){
        $(".product-filter").removeClass("active");
    })

    /*-Slide list sản phẩm theo các danh mục trên mobile-*/
    if(md.mobile() !== null){
        $(".list-product.slide-on-mobile").addClass('owl-carousel owl-theme');
        $(".list-product.slide-on-mobile").owlCarousel($opt_slide);
    }

    $(document).on("click",".expand-menu", function () {
        var $this = $(this);
        toggleSubMenu($this);
    });




    /*-Hover sản phẩm -*/
    /*
    $(".product-item .image").mouseover(function(event) {
        var divid = "#popup-product-" + $(this).parents(".product-item").attr("data-id");
        var top = (event.pageY - $(window).scrollTop()) + 10;
        var left = event.pageX+ 10;

        var w_height = $(window).height();
        var p_height = $(divid).height();
        if(p_height > w_height){
            top = 121;
        }

        if((top + p_height ) > w_height){
            top = top - (top + p_height - w_height);
            if(top < 120) {
                top = 120;
            }
        }
        //console.log(event.pageY,top);

        $(divid).css({top: top, left: left}).show();
    });

    */



    $(".product-item").mouseout(function(event) {
        var divid = "#popup-product-" + $(this).attr("data-id");
        $(divid).hide();
    });

    $("#main-menu .head.for-pc").click(function () {
        var $menu_home = $("#main-menu.menu-home");
        var scroll = $(window).scrollTop();
        if(scroll > 600){
            if($menu_home.hasClass("open")){
                $menu_home.removeClass("open");
            }else{
                $menu_home.addClass("open");
                $menu_home.addClass("clicked");
            }
        }
        /*
        var $menu_cate = $("#main-menu.menu-cate");
        if($menu_cate.hasClass("open")){
            $menu_cate.removeClass("open");
        }else{
            $menu_cate.addClass("open");
            $menu_cate.addClass("clicked");
        }

         */

    });
    jQuery('#star').raty({
        half:false,
        noRatedMsg:"Quý khách đã đánh giá sản phẩm này rồi",
        score:function () {
            return jQuery(this).attr('data-score');
        },
        mouseover:function (score, evt) {

        },
        mouseout:function (score, evt) {

        },
        click:function (score, evt) {
            if($('#u_id').val() > 0) {
                var pId = $("#p_id").val();
                jQuery.ajax({
                    'url':'/rate',
                    'type':'POST',
                    'dataType':'JSON',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    'data':{'score':score, 'product_id': pId}
                }).done(function (data) {
                    if (data.success) {
                        $('#star').raty('readOnly', true);
                        showMessage('Cảm ơn quý khách đã đánh giá sản phẩm!')
                    } else {
                        $('#star').raty('readOnly', true);
                        showMessage('Quý khách đã đánh giá sản phẩm này rồi!')
                    }
                });
            } else {
                showMessage('Bạn cần đăng nhập để đánh giá sản phẩm!')
                $("#modal-user").modal('show');
            }
        }
    });

});
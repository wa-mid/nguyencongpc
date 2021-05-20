'use strict'

/**
 * Created with JetBrains PhpStorm.
 * User: baonv
 * Date: 4/11/17
 * Time: 9:30 AM
 */
/*! jquery.cookie v1.4.1 | MIT */
!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):"object"==typeof exports?a(require("jquery")):a(jQuery)}(function(a){function b(a){return h.raw?a:encodeURIComponent(a)}function c(a){return h.raw?a:decodeURIComponent(a)}function d(a){return b(h.json?JSON.stringify(a):String(a))}function e(a){0===a.indexOf('"')&&(a=a.slice(1,-1).replace(/\\"/g,'"').replace(/\\\\/g,"\\"));try{return a=decodeURIComponent(a.replace(g," ")),h.json?JSON.parse(a):a}catch(b){}}function f(b,c){var d=h.raw?b:e(b);return a.isFunction(c)?c(d):d}var g=/\+/g,h=a.cookie=function(e,g,i){if(void 0!==g&&!a.isFunction(g)){if(i=a.extend({},h.defaults,i),"number"==typeof i.expires){var j=i.expires,k=i.expires=new Date;k.setTime(+k+864e5*j)}return document.cookie=[b(e),"=",d(g),i.expires?"; expires="+i.expires.toUTCString():"",i.path?"; path="+i.path:"",i.domain?"; domain="+i.domain:"",i.secure?"; secure":""].join("")}for(var l=e?void 0:{},m=document.cookie?document.cookie.split("; "):[],n=0,o=m.length;o>n;n++){var p=m[n].split("="),q=c(p.shift()),r=p.join("=");if(e&&e===q){l=f(r,g);break}e||void 0===(r=f(r))||(l[q]=r)}return l};h.defaults={},a.removeCookie=function(b,c){return void 0===a.cookie(b)?!1:(a.cookie(b,"",a.extend({},c,{expires:-1})),!a.cookie(b))}});

/*Jquery toast */
"function"!=typeof Object.create&&(Object.create=function(t){function o(){}return o.prototype=t,new o}),function(t,o,i,s){"use strict";var n={_positionClasses:["bottom-left","bottom-right","top-right","top-left","bottom-center","top-center","mid-center"],_defaultIcons:["success","error","info","warning"],init:function(o,i){this.prepareOptions(o,t.toast.options),this.process()},prepareOptions:function(o,i){var s={};"string"==typeof o||o instanceof Array?s.text=o:s=o,this.options=t.extend({},i,s)},process:function(){this.setup(),this.addToDom(),this.position(),this.bindToast(),this.animate()},setup:function(){var o="";if(this._toastEl=this._toastEl||t("<div></div>",{class:"jq-toast-single"}),o+='<span class="jq-toast-loader"></span>',this.options.allowToastClose&&(o+='<span class="close-jq-toast-single">&times;</span>'),this.options.text instanceof Array){this.options.heading&&(o+='<h2 class="jq-toast-heading">'+this.options.heading+"</h2>"),o+='<ul class="jq-toast-ul">';for(var i=0;i<this.options.text.length;i++)o+='<li class="jq-toast-li" id="jq-toast-item-'+i+'">'+this.options.text[i]+"</li>";o+="</ul>"}else this.options.heading&&(o+='<h2 class="jq-toast-heading">'+this.options.heading+"</h2>"),o+=this.options.text;this._toastEl.html(o),!1!==this.options.bgColor&&this._toastEl.css("background-color",this.options.bgColor),!1!==this.options.textColor&&this._toastEl.css("color",this.options.textColor),this.options.textAlign&&this._toastEl.css("text-align",this.options.textAlign),!1!==this.options.icon&&(this._toastEl.addClass("jq-has-icon"),-1!==t.inArray(this.options.icon,this._defaultIcons)&&this._toastEl.addClass("jq-icon-"+this.options.icon)),!1!==this.options.class&&this._toastEl.addClass(this.options.class)},position:function(){"string"==typeof this.options.position&&-1!==t.inArray(this.options.position,this._positionClasses)?"bottom-center"===this.options.position?this._container.css({left:t(o).outerWidth()/2-this._container.outerWidth()/2,bottom:20}):"top-center"===this.options.position?this._container.css({left:t(o).outerWidth()/2-this._container.outerWidth()/2,top:20}):"mid-center"===this.options.position?this._container.css({left:t(o).outerWidth()/2-this._container.outerWidth()/2,top:t(o).outerHeight()/2-this._container.outerHeight()/2}):this._container.addClass(this.options.position):"object"==typeof this.options.position?this._container.css({top:this.options.position.top?this.options.position.top:"auto",bottom:this.options.position.bottom?this.options.position.bottom:"auto",left:this.options.position.left?this.options.position.left:"auto",right:this.options.position.right?this.options.position.right:"auto"}):this._container.addClass("bottom-left")},bindToast:function(){var t=this;this._toastEl.on("afterShown",function(){t.processLoader()}),this._toastEl.find(".close-jq-toast-single").on("click",function(o){o.preventDefault(),"fade"===t.options.showHideTransition?(t._toastEl.trigger("beforeHide"),t._toastEl.fadeOut(function(){t._toastEl.trigger("afterHidden")})):"slide"===t.options.showHideTransition?(t._toastEl.trigger("beforeHide"),t._toastEl.slideUp(function(){t._toastEl.trigger("afterHidden")})):(t._toastEl.trigger("beforeHide"),t._toastEl.hide(function(){t._toastEl.trigger("afterHidden")}))}),"function"==typeof this.options.beforeShow&&this._toastEl.on("beforeShow",function(){t.options.beforeShow(t._toastEl)}),"function"==typeof this.options.afterShown&&this._toastEl.on("afterShown",function(){t.options.afterShown(t._toastEl)}),"function"==typeof this.options.beforeHide&&this._toastEl.on("beforeHide",function(){t.options.beforeHide(t._toastEl)}),"function"==typeof this.options.afterHidden&&this._toastEl.on("afterHidden",function(){t.options.afterHidden(t._toastEl)}),"function"==typeof this.options.onClick&&this._toastEl.on("click",function(){t.options.onClick(t._toastEl)})},addToDom:function(){var o=t(".jq-toast-wrap");if(0===o.length?(o=t("<div></div>",{class:"jq-toast-wrap",role:"alert","aria-live":"polite"}),t("body").append(o)):this.options.stack&&!isNaN(parseInt(this.options.stack,10))||o.empty(),o.find(".jq-toast-single:hidden").remove(),o.append(this._toastEl),this.options.stack&&!isNaN(parseInt(this.options.stack),10)){var i=o.find(".jq-toast-single").length-this.options.stack;i>0&&t(".jq-toast-wrap").find(".jq-toast-single").slice(0,i).remove()}this._container=o},canAutoHide:function(){return!1!==this.options.hideAfter&&!isNaN(parseInt(this.options.hideAfter,10))},processLoader:function(){if(!this.canAutoHide()||!1===this.options.loader)return!1;var t=this._toastEl.find(".jq-toast-loader"),o=(this.options.hideAfter-400)/1e3+"s",i=this.options.loaderBg,s=t.attr("style")||"";s=s.substring(0,s.indexOf("-webkit-transition")),s+="-webkit-transition: width "+o+" ease-in;                       -o-transition: width "+o+" ease-in;                       transition: width "+o+" ease-in;                       background-color: "+i+";",t.attr("style",s).addClass("jq-toast-loaded")},animate:function(){t=this;if(this._toastEl.hide(),this._toastEl.trigger("beforeShow"),"fade"===this.options.showHideTransition.toLowerCase()?this._toastEl.fadeIn(function(){t._toastEl.trigger("afterShown")}):"slide"===this.options.showHideTransition.toLowerCase()?this._toastEl.slideDown(function(){t._toastEl.trigger("afterShown")}):this._toastEl.show(function(){t._toastEl.trigger("afterShown")}),this.canAutoHide()){var t=this;o.setTimeout(function(){"fade"===t.options.showHideTransition.toLowerCase()?(t._toastEl.trigger("beforeHide"),t._toastEl.fadeOut(function(){t._toastEl.trigger("afterHidden")})):"slide"===t.options.showHideTransition.toLowerCase()?(t._toastEl.trigger("beforeHide"),t._toastEl.slideUp(function(){t._toastEl.trigger("afterHidden")})):(t._toastEl.trigger("beforeHide"),t._toastEl.hide(function(){t._toastEl.trigger("afterHidden")}))},this.options.hideAfter)}},reset:function(o){"all"===o?t(".jq-toast-wrap").remove():this._toastEl.remove()},update:function(t){this.prepareOptions(t,this.options),this.setup(),this.bindToast()},close:function(){this._toastEl.find(".close-jq-toast-single").click()}};t.toast=function(t){var o=Object.create(n);return o.init(t,this),{reset:function(t){o.reset(t)},update:function(t){o.update(t)},close:function(){o.close()}}},t.toast.options={text:"",heading:"",showHideTransition:"fade",allowToastClose:!0,hideAfter:3e3,loader:false,loaderBg:"#9EC600",stack:5,position:"top-right",bgColor:!1,textColor:'#fff',textAlign:"left",icon:!1,beforeShow:function(){},afterShown:function(){},beforeHide:function(){},afterHidden:function(){},onClick:function(){}}}(jQuery,window,document);


function formatMoney(num) {
    if (Number.isInteger(num)) {
        return num.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    }
    return "0";
}
function formatNumber(num) {
    if (Number.isInteger(num)) {
        return num.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1 ");
    }
    return "0";
}

function showMessage(message, type = "info") {
    switch (type) {
        case "info":
            $.toast(message);
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
//TuanDA
function stringGen(len)
{
    var text = "";

    var charset = "abcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < len; i++ )
        text += charset.charAt(Math.floor(Math.random() * charset.length));

    return text;
}
function showMessageCustom(message, type = "info") {
  switch (type) {
    case "info":
      $.toast({
        text: message,
        heading: 'Thông báo',
        icon: 'success',
        hideAfter: 3000,
        stack: 5,
        position: 'top-right',
        textAlign: 'left',
      });
      break;
    case "warning":
      $.toast({
        text: message,
        heading: 'Cảnh báo',
        icon: 'warning',
        showHideTransition: 'fade',
        allowToastClose: true,
        hideAfter: 3000,
        stack: 5,
        position: 'top-right',
        textAlign: 'left',
      });
      break;
    case "alert":
      $.toast({
        heading: 'Lỗi',
        icon: 'error',
        text: message,
        showHideTransition: 'fade',
        allowToastClose: true,
        hideAfter: 3000,
        stack: 5,
        position: 'top-right',
        textAlign: 'left',
      });
      break;
    default:
      $.toast(message);
  }
}
function price_to_number(v){
    if(!v){return 0;}
    v=v.split(',').join('');
    // v=v.split('.').join(',');
    return Number(v.replace(/[^0-9.]/g, ""));
}
function number_to_price(v){
    if(v==0){return '0,00';}
    v=parseFloat(v);
    v=v.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    v=v.split('.').join('*').split(',').join('.').split('*').join(',');
    return v;
}
var pad = function (val) {
    val = String(val);
    if (val.length < 2) {
        val = "0" + val;
    }
    return val;
}
function invertColor(hex, bw) {
  if(hex != null)
  {
    if (hex.indexOf('#') === 0) {
        hex = hex.slice(1);
    }
    // convert 3-digit hex to 6-digits.
    if (hex.length === 3) {
        hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
    }
    if (hex.length !== 6) {
        throw new Error('Invalid HEX color.');
    }
    var r = parseInt(hex.slice(0, 2), 16),
        g = parseInt(hex.slice(2, 4), 16),
        b = parseInt(hex.slice(4, 6), 16);
    if (bw) {
    	return (r * 0.299 + g * 0.587 + b * 0.114) > 186
        	? '#000000'
            : '#FFFFFF';
    }
    // invert color components
    r = (255 - r).toString(16);
    g = (255 - g).toString(16);
	  b = (255 - b).toString(16);
    // pad each with zeros and return
    return "#" + padZero(r) + padZero(g) + padZero(b);
  } else {
    return "#ffffff";
  }

}

function padZero(str, len) {
    len = len || 2;
    var zeros = new Array(len).join('0');
    return (zeros + str).slice(-len);
}

function parseDate(input) {
    if(typeof input === 'string' ) {
        var parts = input.match(/(\d+)/g);
        return new Date(parts[0], parts[1]-1, parts[2],parts[3],parts[4]);
    } else {
        return new Date(input);
    }
}

function formatTime(timestamp) {
    let date = parseDate(timestamp);
    var dd = pad(date.getDate()),
        mm = pad(date.getMonth() + 1),
        y = date.getFullYear(),
        H = date.getHours(),
        M = date.getMinutes(),
        MM = pad(M);
    let today = new Date(),
        todayDate = pad(today.getDate()),
        todayMonth = pad(today.getMonth() + 1),
        todayYear = today.getFullYear();
    if (todayYear === y && todayMonth === mm && todayDate === dd) {
        return "Hôm nay, " + H + ":" + MM;
    } else {
        return dd + "/" + mm + "/" + y + ", " + H + ":" + MM;
    }
}

function formatDate(timestamp) {
    let date = parseDate(timestamp);
    var dd = pad(date.getDate()),
        mm = pad(date.getMonth() + 1),
        y = date.getFullYear();
    return dd + "/" + mm + "/" + y;
}

function formatShortTime(timestamp) {
    let date = parseDate(timestamp);
    var dd = pad(date.getDate()),
        mm = pad(date.getMonth() + 1),
        H = date.getHours(),
        M = date.getMinutes(),
        MM = pad(M);
    return dd + "/" + mm + ", " + H + ":" + MM;
}



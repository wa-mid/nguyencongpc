function setCookie(cname, cvalue, exminus) {
  var d = new Date();
  d.setTime(d.getTime() + (exminus*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(unescape(document.cookie));
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

$(document).ready(function() {

    //  open sale popup new site
     $(window).load(function(){   
		var showPopup = getCookie('salePopup');
		if(showPopup !== "true") {
			$('#salePopup').slideUp( 300 ).delay( 3000 ).fadeIn( 400 );
			setCookie('salePopup', "true", 60);
		}
		
        
        $('#salePopup .close').click(function (e) {
            $('#salePopup').hide();
        });
    }); 


    $("#loginForm").on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: $("#loginForm").attr("action"),
            type: "POST",
            data: new FormData(this),
            beforeSend: function () {
                $("#loginForm .btn-submit").prop("disabled", true);
            },
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.status == "OK") {
                    location.reload();
                } else {
                    $("#loginForm .error").text(data.message);
                }
                $("#loginForm .btn-submit").prop("disabled", false);
            },
            error: function() {
                $("#loginForm .error").text('Có lỗi sảy ra, vui lòng thực hiện lại');
                $("#loginForm .btn-submit").prop("disabled", false);
            }
        });
    });
    $("#registerForm").on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: $("#registerForm").attr("action"),
            type: "POST",
            data: new FormData(this),
            beforeSend: function () {
                $("#registerForm .btn-submit").prop("disabled", true);
            },
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.status == "OK") {
                    location.reload();
                } else {
                    $("#registerForm .error").text(data.message);
                }
                $("#registerForm .btn-submit").prop("disabled", false);
            },
            error: function() {
                $("#registerForm .error").text('Có lỗi sảy ra, vui lòng thực hiện lại');
                $("#registerForm .btn-submit").prop("disabled", false);
            }
        });
    });
    var workstationRequest;
    $("#workstationMenu .ajax-menu").click(function (e) {
        e.preventDefault();
        var self = $(this);
        if(!self.hasClass('active')) {
            var link = $(this).attr("href");
            if(workstationRequest && workstationRequest.readyState !== 4){
                workstationRequest.abort();
            }
            workstationRequest = $.ajax({
                url: '/ajax?uri='+link,
                type: "GET",
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data) {
                        $("#workstationMenu .ajax-menu").removeClass('active');
                        self.addClass('active');
                        $("#workstationContent").html(data);
                    } else {
                        window.location = link;
                    }
                },
                error: function() {
                    window.location = link;
                }
            });
        }
    });


    $("#sort-select").change(function () {
        var sort = $(this).val();
        var url = $(this).data('url');
        if(url) {
            window.location = url.indexOf('?') > 0 ? url+'&sort='+sort : url+'?sort='+sort;
        }
    });
    $.ajax({
        type: "POST",
        dataType: "json",
        url: '/gio-hang',
        data: {
            action: "getcount"
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        context: this,
        beforeSend: function() {
        },
        success: function(response) {
            if(response.count > 0) {
                $("#order_count").html(response.count);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('The following error occured: ' + textStatus, errorThrown);
        }
    });
});



 
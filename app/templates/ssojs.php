<script>

$(document).ready(function() {

    attach();

    function attach() {
        var req = $.ajax({
            url: '/app/db/api.php?command=attach',
            crossDomain: true,
            dataType: 'jsonp'
        });
        req.done(function(data, code) {
            if (code && code >= 400) { // jsonp failure
                showError(data.error);
                return;
            }
            loadUserInfo();
        });
        req.fail(function(jqxhr) {
            showError(jqxhr.responseJSON || jqxhr.textResponse)
        });
    }

    function doApiRequest(command, params, callback, appid=null) {
        var req = $.ajax({
            url: '/app/db/api.php?command=' + command,
            method: params ? 'POST' : 'GET',
            data: params,
            dataType: 'json'
        });
        req.done(
			(data) => {
				if (callback == loginInfo) {
					loginInfo(data, appid)	
				} else {
					callback
				}
			}
		);
        req.fail(function(jqxhr) {
            command == 'login' ? showErrorLogin(jqxhr.responseJSON || jqxhr.textResponse) : showError(jqxhr.responseJSON || jqxhr.textResponse);
        });
    }

    function showError(data) {
        var message = typeof data === 'object' && data.error ? data.error : 'Unexpected error';
        console.log(message);
    }

    // error while login
    function showErrorLogin(data) {
        var message = typeof data === 'object' && data.error ? data.error : 'Unexpected error';
        $('.info').html(message);
        setTimeout(function() {
            $('.info').html('Back to previous page, please wait..');
            setTimeout(function() {
                location.replace("/login");
            }, 1000);
        }, 500);
    }

    function loadUserInfo() {
        doApiRequest('getUserinfo', null, showUserInfo);
    }

    function showUserInfo(info) {
        var burl = "<?php echo baseurl; ?>";
        var curls = [burl, burl + 'login', burl + 'daftar', burl + 'activation'];
        var t = _.contains(curls, window.location.href); 
        if (info) { t ? location.replace(burl + "home") : null;
        } else { t ? null : location.replace(burl); }
    }

    function loginInfo(data, appid) {
        if (typeof data === 'object') {
            setTimeout(function() {
                $('.info').html('Berhasil login');
                setTimeout(function() {
                    $('.info').html('Redirecting, please wait..');
                    setTimeout(function() {
						if (appid == null || appid == '') {
							location.replace('/home');
						} else {
							let app_url = getAppUrl(appid);
							app_url = app_url.replace(/\\/g, '');
							app_url = app_url.replace(/"/g, '');
							location.replace(app_url);
						}
                    }, 1000);
                }, 500);
            }, 1000);
        } 
    }

	function getAppUrl(appid) {
		var url;
		$.ajax({
			async: false,
            url: '/app/db/db_data.php',
			type: 'post',
			data: {'action': 'geturl', 'appid': appid},
			success: function(response) {
				url = response;
			}
        });
		return url;
	}

    $('#form-login').on('submit', function(e) {
        e.preventDefault();
        $('.smart-wrap').hide();
		$('.info img, .homex').show();
        var data = {
            username: this.username.value,
            password: this.password.value
        };
		var appid = this.appid.value;
        doApiRequest('login', data, loginInfo, appid);
    });

});

</script>
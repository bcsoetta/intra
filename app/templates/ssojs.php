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

    function doApiRequest(command, params, callback) {
        var req = $.ajax({
            url: '/app/db/api.php?command=' + command,
            method: params ? 'POST' : 'GET',
            data: params,
            dataType: 'json'
        });
        req.done(callback);
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
                location.replace("/user/login");
            }, 1000);
        }, 500);
    }

    function loadUserInfo() {
        doApiRequest('getUserinfo', null, showUserInfo);
    }

    function showUserInfo(info) {
        var burl = "<?php echo baseurl; ?>";
        var curls = [burl, burl + 'user/login', burl + 'user/daftar', burl + 'user/activation'];
        var t = _.contains(curls, window.location.href); 
        if (info) { t ? location.replace(burl + "service/home") : null;
        } else { t ? null : location.replace(burl); }
    }

    function loginInfo(data) {
        if (typeof data === 'object') {
            setTimeout(function() {
                $('.info').html('Berhasil login');
                setTimeout(function() {
                    $('.info').html('Go to home page, please wait..');
                    setTimeout(function() {
                        location.replace("/service/home");
                    }, 1000);
                }, 500);
            }, 1000);
        } 
    }

    $('#form-login').on('submit', function(e) {
        e.preventDefault();
        $('.smart-wrap').hide();
		$('.info img, .homex').show();
        var data = {
            username: this.username.value,
            password: this.password.value
        };
        doApiRequest('login', data, loginInfo);
    });

});

</script>
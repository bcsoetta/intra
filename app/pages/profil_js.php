<link rel="stylesheet" type="text/css" href="<?php echo baseurl; ?>assets/css/airbnb.css">
<link rel="stylesheet" href="<?php echo baseurl; ?>assets/css/flatpickr.min.css">
<script src="<?php echo baseurl; ?>assets/js/flatpickr.min.js"></script>

<script>

$(document).ready(function() {
    
    $("#form-profil").submit(function(e) {
        e.preventDefault();
        $('.smart-wrap').hide();
        $('.infox img, .homex').show();
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            dataType: 'json',
            success: function(data) {
                console.log(data);
                if (data.passwordi) {
                    setTimeout(function() {
                        $('.infox').html(data.passwordi);
                        setTimeout(function() {
                            $('.infox').html('Refreshing the page, please wait..');
                            setTimeout(function() {
                                location.replace("/user/profil");
                            }, 1000);
                        }, 500);
                    }, 1000);
                } else {
                    setTimeout(function() {
                        $('.infox').html('Refreshing the page, please wait..');
                        setTimeout(function() {
                            location.replace("/user/profil");
                        }, 1000);
                    }, 500);
                }
            }
        });
    });
});

</script>

<script>

    $(document).ready(function () {
        $.ajax({
            url: 'modules/profile/code/profile-code.php',
            type: 'post',
            dataType: 'json',
            data: { action: 'fetch-profile-data' },
            success: function (res) {
                if (res) {
                    $('.name').val(res.name);
                    $('.email').val(res.email);
                    $('.phone').val(res.phone);
                    var defaultImage = './assets/img/adslogo.png'; 
                    if (res.profile_pic) {
                        $('.profile-pic').attr('src', res.profile_pic);
                    } else {
                        $('.profile-pic').attr('src', defaultImage);
                    }
                }
            },
            error: function () {
                var defaultImage = './assets/img/adslogo.png';
                $('.profile-pic').attr('src', defaultImage);
            }
        });

    });

    $('#update-profile-form').validate({
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true
            }
        }
    });


    $('.email').keyup(function () {
        $.ajax({
            url: 'modules/profile/code/profile-code.php',
            dataType: 'json',
            type: 'post',
            data: { action: 'check-update-email', value: $(this).val() },
            success: function (res) {
                //alert(res.success);
                if (res.success) {
                    $('#email-msg').text('Email already registred.');
                } else {
                    $('#email-msg').text('');
                }
            }
        });
    });


    $('#update-profile-form').on('submit', function () {
        if ($('#update-profile-form').valid()) {
            if ($('#email-msg').text() == '') {
                $.ajax({
                    url: 'modules/profile/code/profile-code.php',
                    dataType: 'json',
                    type: 'post',
                    processData: false,
                    contentType: false,
                    data: new FormData(this),
                    success: function (res) {
                        //alert(res);
                        if (res.success) {
                            $('#update-msg').attr('style', 'color:green;');
                            $('#update-msg').text('Profile updated successfully.');
                            setTimeout(function () {
                                window.location.reload();
                            }, 3000)
                        } else {
                            $('#email-msg').text(res.error);
                        }
                    }
                });
            }
        }
    });


    $('#password-update-form').validate({
        rules: {
            old_pass: {
                required: true
            },
            new_pass: {
                required: true,
                minlength: 8,
            },
            c_pass: {
                required: true,
                equalTo: "#new_pass",
            }
        }
    });


    $('#password-update-form').on('submit', function () {
        if ($('#password-update-form').valid()) {
            $.ajax({
                url: 'modules/profile/code/profile-code.php',
                dataType: 'json',
                type: 'post',
                processData: false,
                contentType: false,
                data: new FormData(this),
                success: function (res) {
                    //alert(res);
                    if (res.success) {
                        $('#update-p-msg').attr('style', 'color:green;');
                        $('#update-p-msg').text('Password updated successfully.');
                        setTimeout(function () {
                            window.location.reload();
                        }, 3000)
                    } else {
                        $('#update-p-msg').text(res.error);
                    }
                }
            });
        }
    });

</script>
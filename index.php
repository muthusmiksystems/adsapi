<?php
session_start();
if(isset($_SESSION['status'])){
    header('Location:payment.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/login-style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    <style>
        .error{
            color: red;
        }
        .shad{
            box-shadow: 0px 0px 0px 4px #9ac9b4;
            z-index:2;
        }
    </style>
</head>

<body>
<?php //die('mil gaya')?>
    <div class="container-fluid register min-vh-100">
        <div><img src="https://img.icons8.com/sf-ultralight-filled/30/ffffff/new-post.png"/><a href="mailto:support@selfieera.com" style="color:black;text-decoration: none;">support@selfieera.com</a></div>
        <div class="row">
            <div class="col-md-5 register-left">
                <img class="h-25" src="assets/img/adslogo.png" alt="" style="max-width:250px;">
                <div class="h-75 d-flex flex-column flex-wrap align-items-center justify-content-evenly">
                    <p>Selfieera</p>
                    <p>Manage your company growth efficiently.</p>
                    <p>Promote your brand at cheaper cost.</p>
                    <p>Boost your business with us.</p>
                    <p>Your path to success is here.Join us today!</p>
                </div>
            </div>

            <div class="col-md-7 register-right">
                <div class="row">
                    <div class="col-12">
                        <div class="btn-group float-end my-4 mx-5" role="group" aria-label="Basic mixed styles example">
                            <button type="button" class="btn btn-success shad" id="loginBtn">Login</button>
                            <button type="button" class="btn btn-warning " id="registerBtn">Register</button>
                        </div>

                        <!-- <div class="btn-group btn-group-sm float-end my-4 mx-5" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                            <label class="btn btn-outline-primary" for="btnradio1"id="loginBtn" style="background-color: 4dcbff;">Login</label>
                          
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                            <label class="btn btn-outline-primary" for="btnradio3" id="registerBtn" style="background-color: 4dcbff;">Register</label>
                        </div> -->
                    </div>
                    
                    <div class="col-12">
                        <div class="my-5" id="loginForm">
                            <h2 class="register-heading">Login</h2>
                            <form method="POST" id="login-form" class="signup-form" onsubmit="return false;">
                                <div class="row register-form g-3">
                                    <div class="col-12">
                                        <input type="email" name="email" id="email" onchange="checkEmail();" class="form-control" placeholder="Email *" />
                                        <span id="msg" style="color:red;"></span>
                                    </div>
                                    <div class="col-12">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password *" value="" />
                                    </div>
                                    <div class="col-12">
                                        <input type="hidden" class="form-input" name="action" value="login-form">
                                        <button type="submit" name="submit" id="submit" class="form-submit register btn btn-primary d-grid w-100" style="background-color: 4dcbff;">Sign In</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Login Script  -->
                        <script>
                            $(document).ready(function() {
                                $("#login-form").validate({
                                    rules: {
                                        email: {
                                            required: true,
                                            email: true
                                        },
                                        password: {
                                            required: true
                                        }
                                    }
                                });
                            });
                            
                            
                            function checkEmail(){
                                $.ajax({
                                    url:"modules/login-signup/code/login-code.php",
                                    type: "POST",
                                    data:{action:'Check Email',value:$('#email').val()},
                                    success: function(res){
                                        if(res == 'Email not registered'){
                                            $('#msg').text('Email not registered');
                                        }
                                    }
                                });
                            }
                            
                            
                            $('#email').keyup(function(){
                                $('#msg').text('');
                            });
                            
                            
                            
                            $(document).on('submit', '#login-form', function(){
                                if($('#msg').text() == ''){
                                    if($('#login-form').valid()){
                                        $.ajax({
                                            url:"modules/login-signup/code/login-code.php",
                                            type: "POST",
                                            data:$('#login-form').serialize(),
                                            success: function(res){
                                            console.log('response-'.res)
                                                if(res == 'success'){
                                                    window.location.href = 'dashboard.php';
                                                }else{
                                                    alert('Somthing went wrong please try again!')
                                                }
                                            }
                                        });
                                    }
                                }
                            });
                        </script>

                        <div id="registerForm">
                            <h2 class="register-heading">Register</h2>
                            <form method="POST" id="signup-form" class="signup-form" onsubmit="return true;">
                                <div class="row register-form g-3">
                                    <div class="col-12">
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name *" />
                                    </div>
                                    <div class="col-12">
                                        <input type="email" name="email" id="semail" onchange="checkMail();" class="form-control" placeholder="Email *" />
                                        <span id="smsg" style="color:red;"></span>
                                    </div>
                                    <div class="col-12">
                                        <input type="phone" name="phone" id="phone" class="form-control" placeholder="Phone *" />
                                        <span id="msg" style="color:red;"></span>
                                    </div>
                                    <div class="col-12">
                                        <input type="password" name="password" id="spassword" class="form-control" placeholder="Password *" />
                                    </div>
                                    <div class="col-12">
                                        <input type="password" name="re_password" id="re_password" class="form-control" placeholder="Confirm Password *" />
                                    </div>
                                    <div class="flex mt-4 text-sm">
                                        <label class="flex items-center dark:text-gray-400">
                                            <input name="agree_term" id="agree_term" type="checkbox" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
                                            <span class="ml-2">
                                                I agree with the
                                                <a href="trems-condition.php"><span class="underline">terms and conditions</span></a>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-12">
                                        <input type="hidden" class="form-input" name="action" value="signup-form">
                                        <button type="submit" name="submit" id="ssubmit" class="form-submit register btn btn-primary d-grid w-100" style="background-color: 4dcbff;">Register</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        
        <!-- Signup Script -->
        <script>
            $(document).ready(function() {
                $("#signup-form").validate({
                    rules: {
                        name : {
                            required: true,
                        },
                        email: {
                            required: true,
                            email: true
                        },
                        phone: {
                            required: true
                        },
                        password: {
                            required: true
                        },
                        re_password: {
                            required: true,
                            equalTo:"#spassword"
                        },
                        agree_term: {
                            required: true
                        }
                    }
                });
            });
            
            
            function checkMail(){
                if($('#semail').val() != ''){
                    $.ajax({
                        url:"modules/login-signup/code/signup-code.php",
                        type: "POST",
                        data:{action:'Check Email',value:$('#semail').val()},
                        success: function(res){
                            if(res == 'Email already registered'){
                                $('#smsg').text(res);
                            }
                        }
                    });
                }
            }
            
            $('#semail').on('input',function(){
                $('#smsg').text('');
            });
            
            $(document).on('submit', '#signup-form', function(){
                if($('#smsg').text() == ''){
                    if($('#signup-form').valid()){
                        if($('input[type=checkbox]:checked').length == 1){
                            $.ajax({
                                url:"modules/login-signup/code/signup-code.php",
                                type: "POST",
                                data:$('#signup-form').serialize(),
                                success: function(res){
                                    console.log(res);
                                    if(res == 'success'){
                                        window.location.href = 'index.php';
                                    }else{
                                        alert('Somthing went wrong please try again!')
                                    }
                                }
                            });
                            }else{
                                $('.label-agree-term').addClass('error');
                        }
                    }
                }
            });
        </script>
        <script>
            $(document).ready(function () {
                $('#loginForm').show();
                $('#registerForm').hide();
            });
            $('#registerBtn').on('click', function () {
                $('#loginForm').hide();
                $('#registerForm').show();
                $('#registerBtn').attr('class', 'btn btn-success shad');
                $('#loginBtn').attr('class', 'btn btn-warning');
            });
            $('#loginBtn').on('click', function () {
                $('#registerForm').hide();
                $('#loginForm').show();
                $('#loginBtn').attr('class', 'btn btn-success shad');
                $('#registerBtn').attr('class', 'btn btn-warning');
            });
        </script>
        <div style="color:black;">Copyright © 2023-2025 Selfieera Pvt. Ltd.</div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"></script>
</body>

</html>
<script>
var app_type = '';
var budget = 0;
var color = '';

    $(document).ready(function () {
        var back = ["#670fff","#8744fc","#9058d8", "#a042d6", "#3541bf"];
        var color = back[Math.floor(Math.random() * back.length)];
        $('#color-code').attr('value', color);
    });

function selectProject(){
    if($('#project-type').val() == 'Mobile App'){
        $('.placeholder').attr('placeholder', 'https://play.google.com/store/apps/details?id=com.selfieera.app');
        $('.app-type').show();
        $('.project-url').text('App URL');
        $('.click-title').text('How many downloads do you want?');
        $('#app-icon').show();
    }else if($('#project-type').val() == 'Website'){
        $('.placeholder').attr('placeholder', 'https://www.selfieera.com');
        $('.project-url').text('Website URL');
        $('.app-type').hide();
        $('#app-icon').hide();
        budget = 1.5;
    }else if($('#project-type').val() == 'Youtube Views'){
        $('.placeholder').attr('placeholder', 'https://www.youtube.com');
        $('.project-url').text('Youtube URL');
        $('.app-type').hide();
        $('.click-title').text('How many visits do you want?');
        budget = 2;
        $('.click-title').text('How many views do you want?');
        $('#app-icon').hide();
    }else if($('#project-type').val() == 'Instagram Followers'){
        $('.placeholder').attr('placeholder', 'https://www.instagram.com');
        $('.project-url').text('Instagram URL');
        $('.app-type').hide();
        $('.click-title').text('How many followers do you want?');
        budget = 2.5;
    }else if($('#project-type').val() == 'Instagram Likes'){
        $('.placeholder').attr('placeholder', 'https://www.instagram.com');
        $('.project-url').text('Instagram URL');
        $('.app-type').hide();
        $('.click-title').text('How many likes do you want?');
        budget = 3;
    }else if($('#project-type').val() == 'Linkedin Followers'){
        $('.placeholder').attr('placeholder', 'https://www.linkedin.com');
        $('.project-url').text('Linkedin URL');
        $('.app-type').hide();
        $('.click-title').text('How many followers do you want?');
        budget = 3.5;
    }else if($('#project-type').val() == 'Facebook Page Likes'){
        $('.placeholder').attr('placeholder', 'https://www.facebook.com');
        $('.project-url').text('Facebook URL');
        $('.app-type').hide();
        $('.click-title').text('How many likes do you want?');
        budget = 4;
    }else if($('#project-type').val() == 'Facebook Followers'){
        $('.placeholder').attr('placeholder', 'https://www.facebook.com');
        $('.project-url').text('Facebook URL');
        $('.app-type').hide();
        $('.click-title').text('How many followers do you want?');
        budget = 3.25;
    }else if($('#project-type').val() == 'Twitter Followers'){
        $('.placeholder').attr('placeholder', 'https://www.twitter.com');
        $('.project-url').text('Twitter URL');
        $('.app-type').hide();
        $('.click-title').text('How many followers do you want?');
        budget = 3.75;
    }else{
        $('.project-url').text('URL');
        $('.click-title').text('How many clicks do you want?');
    }
}



$(document).on('click', '#app-type', function(){
    app_type = $(this).val();
    if($(this).val() == 'android'){
        $('.placeholder').attr('placeholder', 'https://play.google.com/store/apps/details?id=com.selfieera.app');
        $('.project-url').text('Google Play URL');
        budget = 4.55;
    }else if($(this).val() == 'ios'){
        $('.placeholder').attr('placeholder', 'https://apps.apple.com/in/app/selfieera-app/id1497728209');
        $('.project-url').text('App Store URL');
        budget = 5;
    }
});

$('.click-count').keyup(function(){
    if($('#project-type').val() == ''){
        $('#msg-click').text('Select Project Type');
    }else{
        if($('#project-type').val() != 'Mobile App'){
            if($('.day-count').val() != ''){
                total = $('.click-count').val() * $('.day-count').val() * budget;;
                $('.budget').val('₹'+total);
                $('#msg-click').text('');
            }else{
                $('#msg-click').text('Enter how many day do you want to run');
            }
        }else{
            if(app_type != ''){
                if($('.day-count').val() != ''){
                    total = $('.click-count').val() * $('.day-count').val() * budget;
                    $('.budget').val('₹'+total);
                    $('#msg-click').text('');
                }else{
                    $('#msg-click').text('Enter how many day do you want to run');
                }
            }else{
                $('#msg-click').text('Select App Type');
            }
        }
    }
    
});

$('.day-count').keyup(function(){
    if($('.click-count').val() != '' && budget != 0){
        total = $('.click-count').val() * $(this).val() * budget;
        $('.budget').val('₹'+total);
    }
});

$('.budget').keyup(function(){
    total = 0;
    am = $('.budget').val();
    if(am.charAt(0) == '₹'){
        total = parseInt(am.substring(1,am.length))/budget;
        total = Math.floor(total);
        if(isNaN(total)){
            total = 0;
            $('.click-count').val(total);
        }else{
            $('.click-count').val(total);
        }
    }else{
        total = parseInt(am)/budget;
        total = Math.floor(total);
        if(isNaN(total)){
            total = 0;
            $('.click-count').val(total);
        }else{
            $('.click-count').val(total);
        }
    }
    
});

$(document).ready(function(){
    $('.link').keyup(function(){
        if($('#project-type').val() == 'Mobile App'){
            if(app_type != ''){
                $.ajax({
                    url:'modules/create-ad/code/fetch-app-icon-code.php',
                    type: "POST",
                    data:{action: app_type, app_link: $('.link').val()},
                    success: function(res){
                            if(res != ''){
                                $('.app-icon').attr('src', res);
                                $('#app-icon').show();
                                $('#msg').text('');
                            }else{
                                $('#msg').text('Invalid Url');
                                $('#app-icon').hide();
                        }
                    }
                });
            }else{
                $('#msg').text('Select App Type');
            }
        }else{
            $('#msg').text('');
            $('#app-icon').hide();
        }
    });
});


$('#create-ad-form').validate({
    rules:{
        project_name:{
            required: true
        },
        project_type:{
            required: true
        },
        project_url:{
            required: true
        },
        project_day:{
            required: true
        },
        project_click:{
            required: true
        },
        project_budget:{
            required: true
        },
        project_desc:{
            required: true
        },
        iagree:{
            required: true,
            maxlength: 1
        },
        project_graphic:{
            required: true
        }
        
    },
    
    message:{
        //custom message hare
    }
});


var _URL = window.URL || window.webkitURL;
$(".graphic").change(function (e) {
    var file, img;
    if ((file = this.files[0])) {
        img = new Image();
        img.onload = function () {
        if(this.width == 350 && this.height == 400){
            $('#graphic-msg').text('file size most be 350x400');
        }else{
            $('#graphic-msg').text('');
        }
            
        };

        img.src = _URL.createObjectURL(file);
    }
});


$('#create-ad-form').on('submit', function(){
    if($('#create-ad-form').valid()){
        if($('#graphic-msg').text() == ''){
            $.ajax({
                url: 'modules/create-ad/code/create-ad-code.php',
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success:function(res){
                    if(res =='success'){
                        window.location.href = 'dashboard.php';
                    }else if(res == 'fail'){
                        alert('Please Check Error');
                    }else{
                        $('#graphic-msg').text(res);
                    }
                }
            });
        }
    }
});
</script>

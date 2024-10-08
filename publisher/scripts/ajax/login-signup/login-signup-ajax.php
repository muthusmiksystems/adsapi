<script>

$('#login-form').validate({
    rules:{
        login_email:{
            required: true,
            email: true
        },
        login_password:{
            required:true
        }
    }
});
    
    
    
    
$('#signup-form').validate({
    rules:{
        name:{
            required:true
        },
        email:{
            required: true,
            email: true
        },
        password:{
            minlength: 6,
            maxlength: 16,
            required: true,
        }
    }
});
const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});
</script>
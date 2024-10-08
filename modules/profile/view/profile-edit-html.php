
<main class="h-full pb-16 overflow-y-auto">
	<div class="container px-6 mx-auto grid">
		<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
			Update Profile
		</h2>
		<!-- CTA -->
		<a class="top-line flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100  rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple" href="javascript:void(0);" style="background-color:#43e97b">
			<div class="flex items-center">
				<svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
					<path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
				</svg>
				<span>Star this project</span>
			</div>
			<span>View more &RightArrow;</span>
		</a>
        <style>
            .profile-circel{
                margin-top: 20px;
                height: 60px;
                width: 60px;
                border-radius: 50%;
            }
            .upload-profile{
                margin-bottom: 16px;
                display: flex;
            }
            .profile-pic{
                border-radius: 50%;
                height: 53px;
            }
        </style>
		<!-- General elements -->
		<div class="px-4 py-3 mb-8  rounded-lg shadow-md dark:bg-gray-800" style="background-color:#38f9d7">
		    <div class="profile-circel">
		        <img class="profile-pic" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQD116U9ZCk8bEaanCeB5rSCC2uqY5Ka_2_EA&usqp=CAU" height="55" width="55">
		    </div>
		    <div class="upload-profile">
		        <img src="https://img.icons8.com/fluency/48/camera.png" height="16" width="20">
		        <span>Edit Photo</span>
		    </div>
			<form method="POST" id="update-profile-form" onsubmit="return false;">
			    <input type="file" class="file-upload" name="profile_pic" style="display:none;">
				<label class="block text-sm">
					<span class="text-gray-700 dark:text-gray-400">Name</span>
					<input name="name" class="name block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Name" />
				</label>
				<label class="block mt-4 text-sm">
					<span class="text-gray-700 dark:text-gray-400 project-url">Email</span>
					<input name="email" class="email placeholder block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Email" />
				    <span id="email-msg" style="color:red;"></span>
				</label>

				<label class="block mt-4 text-sm">
					<span class="text-gray-700 dark:text-gray-400">Phone</span>
					<input name="phone" class="phone block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Phone" />
				    <span id="update-msg" style="color:red;"></span>
				</label>
				<input type="hidden" name="action" value="profile-update-form";
				<div class="flex mt-4 text-sm">
					<button class="px-4 py-2 mt-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
					    Update
					</button>
				</div>
                </form>
                <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
			        Change Password
		        </h4>
                <form method="POST" id="password-update-form" onsubmit="return false;" enctype='multipart/form-data'>
				<label class="block mt-4 text-sm">
					<span class="text-gray-700 dark:text-gray-400">Old Password</span>
					<input type="password" name="old_pass" class="old_pass block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Old Password" />
				</label>
				
				<label class="block mt-4 text-sm">
					<span class="text-gray-700 dark:text-gray-400">New Password</span>
					<input type="password" name="new_pass" id="new_pass" class="new_pass block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="New Password" />
				</label>
				
				<label class="block mt-4 text-sm">
					<span class="text-gray-700 dark:text-gray-400">Confirm Password</span>
					<input type="password" name="c_pass" class="c_pass block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Confirm Password" />
				    <span id="update-p-msg" style="color:red;"></span>
				</label>
				
				<input type="hidden" name="action" value="change-password-form">
				<div class="flex mt-6 text-sm">
					<button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
						Change
					</button>
				</div>
			</form>
		</div>
	</div>
</main>
<style>
.error{
    color: red;
}
</style>

<script>
    $(document).ready(function(){
        var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.profile-pic').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $(".file-upload").on('change', function() {
            readURL(this);
        });

        $(".upload-profile").on('click', function() {
            $(".file-upload").click();
        });
    })
</script>
<main class="h-full pb-16 overflow-y-auto">
	<div class="container px-6 mx-auto grid">
		<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
			Make Payment
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

		<!-- General elements -->
		<h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
			Fill Payment Form
		</h4>
		<div class="px-4 py-3 mb-8  rounded-lg shadow-md dark:bg-gray-800" style="background-color:#38f9d7"">
			<form method="POST" id="payment-form" action="payment.php">
				<label class="block text-sm">
					<span class="text-gray-700 dark:text-gray-400">Name</span>
					<input readonly name="user_name" value="<?= $_SESSION['name'] ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Name" />
				</label>

				<label class="block mt-4 text-sm">
					<span class="text-gray-700 dark:text-gray-400 project-url">Email</span>
					<input readonly name="user_email" value="<?= $_SESSION['email'] ?>" class="placeholder block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Email" />
					<span id="msg" style="color:red;"></span>
				</label>

				<label class="block mt-4 text-sm">
					<span class="text-gray-700 dark:text-gray-400 click-title">Phone</span>
					<input readonly name="user_phone" value="<?= $_SESSION['phone'] ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Phone Number" />
					<span id="msg-click" style="color:red;"></span>
				</label>

				<label class="block mt-4 text-sm">
					<span class="text-gray-700 dark:text-gray-400">Amount</span>
					<input name="payment_amount" value="<?php if(isset($_POST['payment_amount'])){ echo $_POST['payment_amount']; } if(!empty($_POST['repay'])){ echo $_POST['amount']; } ?>" class="pay_amount block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="₹100" />
				</label>

				<div class="flex mt-6 text-sm">
					<label class="flex items-center dark:text-gray-400">
						<input name="iagree" type="checkbox" <?php if(isset($_POST['payment_amount'])){ echo 'checked'; } if(!empty($_POST['repay'])){ echo 'checked'; } ?> class="color-d-blue text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
						<span class="ml-2">
							I agree to the
							<span class="underline">privacy policy</span>
						</span>
					</label>
				</div>
				<input type="hidden" name="action" value="create-payment">
				<div class="flex mt-6 text-sm">
					<button style="background:#02024d;" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
						Pay Now
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
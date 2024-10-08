<main class="h-full pb-16 overflow-y-auto">
	<div class="container px-6 mx-auto grid">
		<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
			Create Campaign
		</h2>
		<!-- CTA -->
		<a class="top-line flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100  rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple"
			href="javascript:void(0);" style="background-color:#43e97b">
			<div class="flex items-center">
				<svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
					<path
						d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
					</path>
				</svg>
				<span>Star this project</span>
			</div>
			<span>View more &RightArrow;</span>
		</a>

		<!-- General elements -->
		<h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
			Fill The Form
		</h4>
		<div class="px-4 py-3 mb-8  rounded-lg shadow-md dark:bg-gray-800" style="background-color:#38f9d7">
			<form method="POST" id="create-ad-form" onsubmit="return false;" enctype='multipart/form-data'>
				<label class="block text-sm">
					<span class="text-gray-700 dark:text-gray-400">Campaign Name</span>
					<input name="project_name"
						class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
						placeholder="Selfieera App" />
				</label>
				<label class="block mt-4 text-sm">
					<span class="text-gray-700 dark:text-gray-400">Campaign Type</span>
					<select name="project_type" onchange="selectProject();" id="project-type"
						class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
						<option value="">Select</option>
						<!-- <option value="Mobile App">Mobile App</option>
						<option value="Website">Website</option>
						<option value="Youtube Views">Youtube</option> -->
						<option value="Mobile App Install">Mobile App Install</option>
        				<option value="Website Click">Website Click</option>
        				<option value="YouTube Views Click">YouTube Views Click</option>	
					</select>
				</label>

				<div class="mt-4 text-sm app-type" style="display:none;">
					<span class="text-gray-700 dark:text-gray-400">
						App Type
					</span>
					<div class="mt-2">
						<label class="inline-flex items-center text-gray-600 dark:text-gray-400">
							<input type="radio" id="app-type"
								class="color-d-blue text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
								name="app-type" value="android" />
							<span class="ml-2">Android</span>
						</label>
						<label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
							<input type="radio" id="app-type"
								class="color-d-blue text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
								name="app-type" value="ios" />
							<span class="ml-2">iOS</span>
						</label>
					</div>
				</div>

				<label class="block mt-4 text-sm">
					<span class="text-gray-700 dark:text-gray-400 project-url">URL</span>
					<input name="project_url"
						class="link placeholder block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
						placeholder="https://selfieera.com" />
					<span id="msg" style="color:red;"></span>
				</label>

				<label class="block mt-4 text-sm" style="display:none;" id="app-icon">
					<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block" style="width:3rem; height: 3rem;">
						<img class="app-icon object-cover w-full h-full rounded-full" src="" alt="" loading="lazy">
						<div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
					</div>
				</label>

				<!-- <label class="block mt-4 text-sm">
					<span class="text-gray-700 dark:text-gray-400">Upload Graphic</span>
					<input type="file" name="project_graphic" class="graphic block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Enter Here" />
					<span id="graphic-msg" style="color: red;"></span>
				</label> -->
				<label class="block mt-4 text-sm">
					<span class="text-gray-700 dark:text-gray-400">Upload Graphic or Video</span>
					<input type="file"  name="project_graphic"
						class="graphic block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
						accept="image/*, video/*" placeholder="Enter Here" />
						<span id="graphic-msg" style="color: red;"></span>
				</label>

				


				<!-- Preview Area -->
				<div id="media-preview" class="mt-4"></div>

				<!-- Crop Modal -->
				<div id="crop-modal"
					class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
					<div class="bg-white p-4 rounded-lg shadow-lg">
						<h3 class="text-lg font-semibold mb-4">Crop Image or Video</h3>
						<div id="crop-container"></div>
						<button id="crop-btn" class="mt-4 px-4 py-2 bg-purple-600 text-white rounded">Crop</button>
						<button id="close-crop-modal"
							class="mt-2 px-4 py-2 bg-gray-500 text-white rounded">Close</button>
					</div>
				</div>


				<label class="block mt-4 text-sm">
					<span class="text-gray-700 dark:text-gray-400">How many day do you want run?</span>
					<input name="project_day"
						class="day-count block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
						placeholder="Enter Here" />
				</label>

				<label class="block mt-4 text-sm">
					<span class="text-gray-700 dark:text-gray-400 click-title">How many clicks do you want?</span>
					<input name="project_click"
						class="click-count block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
						placeholder="Enter Here" />
					<span id="msg-click" style="color:red;"></span>
				</label>

				<label class="block mt-4 text-sm">
					<span class="text-gray-700 dark:text-gray-400">Campaign Budget</span>
					<input name="project_budget"
						class="budget block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
						placeholder="₹100" />
				</label>

				<label class="block mt-4 text-sm">
					<span class="text-gray-700 dark:text-gray-400">Campaign Description</span>
					<textarea name="project_desc"
						class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
						rows="3" placeholder="Enter some description of your project"></textarea>
				</label>

				<div class="flex mt-6 text-sm">
					<label class="flex items-center dark:text-gray-400">
						<input name="iagree" type="checkbox"
							class="color-d-blue text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
						<span class="ml-2">
							I agree to the
							<span class="underline">privacy policy</span>
						</span>
					</label>
				</div>
				<input type="hidden" name="action" value="create-ad-form">
				<input type="hidden" name="color-code" id="color-code" value="">
				<div class="flex mt-6 text-sm">
					<button style="background:#02024d;"
						class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
						Submit
					</button>
				</div>
			</form>
		</div>
	</div>
</main>
<style>
	.error {
		color: red;
	}
</style>
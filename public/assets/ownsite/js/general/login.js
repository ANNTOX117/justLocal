$(document).ready(function () {
	
	$("#imageCompany").change(function () {
		// Remove all the contents of the error element
		$("#imageCompany_error").empty();
		// replace "file-input" with the ID of your file input field
		if (this.files && this.files[0]) {
			let reader = new FileReader(); // create a new file reader object
			reader.onload = function (e) {
				// handle the file reader onload event
				$("#image-preview").attr("src", e.target.result); // set the src attribute of the image to the file reader result
			};
			reader.readAsDataURL(this.files[0]); // read the selected file as a data URL
		}
	});
	$("#imageBg").change(function () {
		// Remove all the contents of the error element
		$("#imageBg_error").empty();
		// replace "file-input" with the ID of your file input field
		if (this.files && this.files[0]) {
			let reader = new FileReader(); // create a new file reader object
			reader.onload = function (e) {
				// handle the file reader onload event
				$("#image-previewBg").attr("src", e.target.result); // set the src attribute of the image to the file reader result
			};
			reader.readAsDataURL(this.files[0]); // read the selected file as a data URL
		}
	});

	$('input[type="checkbox"]').change(function() {
		if(this.checked) {
			$('#all_branches_error').empty();
		}
	});
	$('#province').change(function() {
		$('#city_error').empty();
	});

	$("#login_form").submit(function (event) {
		event.preventDefault();
		$('#loggin_error_msg').addClass('d-none');
		$('#loggin_error_msg').empty();
		let email = $("#email").val().trim();
		let password = $("#password").val().trim();
		if (email === "" || password === "") return alert("put data");
		$.ajax({
			url: "/ajax/validate_user/",
			type: "POST",
			data: {
				email,
				password,
			},
			success: function (response) {
				const protocol = window.location.protocol;
				const domain = window.location.host;
				const url_redirect_by_session = protocol+"//"+domain+"/logged";
				console.log(url_redirect_by_session, protocol, domain);
				window.location.href = url_redirect_by_session;
			},
			error: function (xhr, status, error) {
				$('#loggin_error_msg').removeClass('d-none');
				$('#loggin_error_msg').append(`<p>${xhr.responseJSON.msg}</p>`);
			},
		});
	});
	$("#register_company_form").on("submit", function (event) {
		$(".error_input").empty();
		$("#success_insert_company").addClass("d-none");
		event.preventDefault();
		let formData = new FormData($(this)[0]);
		let checkedBranches = $("input[name='branches']:checked").map(function() {
			return $(this).val();
		}).get();
		formData.append("all_branches", checkedBranches);
		$.ajax({
			url: "/ajax/insert_user/",
			type: "POST",
			data: formData,
			processData: false,
			contentType: false,
			success: function (response) {
				console.log(response);
				$("#success_insert_company").removeClass("d-none");
				$("#success_insert_company").append(`<p>${response.success}</p>`);
				$('input').val('');
				$('textarea').val('');
				$('select').val('');
				$('input[type="checkbox"]:checked').prop('checked', false);
				$("#image-preview").attr("src", "");
				$("#image-previewBg").attr("src", "");
				// let data = JSON.parse(response);
				// if (data.status != 200) {
				// 	return alert(data.msg);
				// }
				// var inputs = $("input");
				// inputs.each(function () {
				// 	$(this).val("");
				// 	Swal.fire(
				// 		"User register!",
				// 		"The admin of the system is gonna contact you to give you the access of the system!",
				// 		"success"
				// 	);
				// });
			},
			error: function (xhr, status, error) {
				let all_errors = xhr.responseJSON.error;
				for (const prop in all_errors) {
					if (all_errors.hasOwnProperty(prop)) {
					  //console.log(`${prop}: ${all_errors[prop]}`);
					  	$(`#${prop}_error`).removeClass('d-none');
						$(`#${prop}_error`).append(`<p>${all_errors[prop]}</p>`);
					}
				}
			},
		});
	});

	//let errorElements = $('.error_input');

	// Add an event listener to detect keyup events on all input elements
	$('input').on('keyup', function() {
		// Get the corresponding error element for this input
		let errorElement = $(this).next('.error_input');
		// Remove all the contents of the error element
		errorElement.empty();
	});
	$('textarea').on('keyup', function() {
		// Get the corresponding error element for this input
		let errorElement = $(this).next('.error_input');
		// Remove all the contents of the error element
		errorElement.empty();
	});

	$("#province").change(function () {
		let selectedValue = $(this).val();
		$("#city_select").removeClass("d-none");
		// $('#city_select').empty();
		if (selectedValue === "") {
			$("#city").empty();
			return $("#city_select").addClass("d-none");
		}
		$.ajax({
			type: "GET",
			url: "/ajax/" + "cities_by_provinceId/" + selectedValue,
			success: function (options) {
				$("#city").empty();
				const cities = JSON.parse(options);
				cities.map((e) => {
					let option = $("<option/>", {
						value: e.id,
						text: e.name,
					});
					$("#city").append(option);
				});
			},
		});
	});

	// $("#register_company_form").submit(function (event) {
	// 	// handle the form submit event
	// 	event.preventDefault(); // prevent the default form submission behavior

	// 	// gather the form data
	// 	let formData = $(this).serialize();
	// 	console.log(formData);
	// 	// send the form data using AJAX
	// 	// $.ajax({
	// 	//   url: $(this).attr("action"), // get the form action URL
	// 	//   type: $(this).attr("method"), // get the form method (post/get)
	// 	//   data: formData, // use the serialized form data
	// 	//   success: function(response) {
	// 	//     // handle the successful form submission response
	// 	//   },
	// 	//   error: function(xhr, status, error) {
	// 	//     // handle the form submission error
	// 	//   }
	// 	// });
	// });
});

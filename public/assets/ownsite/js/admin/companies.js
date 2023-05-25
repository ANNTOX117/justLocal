$("#pagination nav").addClass("nav-pagination");
$("#pagination nav li").addClass("page-item");
$("#pagination nav li a").addClass("page-link");

const input = document.getElementById("companyImage");
const input_bg = document.getElementById("companyImageBg");
const preview = document.getElementById("preview");
const img_preview = document.getElementById("image-preview");
const companyForm = document.getElementById("companyForm");

const alertPlaceholder = document.getElementById('liveAlertPlaceholder')
const appendAlert = (message, type) => {
	const wrapper = document.createElement('div')
	wrapper.innerHTML = [
		`<div class="alert alert-${type} alert-dismissible" role="alert">`,
		`   <div>${message}</div>`,
		'   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
		'</div>'
	].join('')
	
	alertPlaceholder.append(wrapper)
}
// add event listener for input change
// preview_bg

var id_company = 0;

const inputs_img = document.querySelectorAll('.input-image');
inputs_img.forEach(img_input => {
	img_input.addEventListener('change', function handleChange(e) {
		var imagePreview = document.getElementById(this.id+'_prev')
		var file = e.target.files[0];
		var reader = new FileReader();
		reader.onload = function(e) {
			imagePreview.src = e.target.result;
		};
		reader.readAsDataURL(file);
	});
});

const company_buttons = document.querySelectorAll('.company-button');
company_buttons.forEach(button_clickable => {
	button_clickable.addEventListener('click', function handleChange(e) {
		id_company = $('#'+this.id).data('id');
		$.ajax({
			type: "GET",
			url:'/admin/get_company/'+id_company,
			success: function(data) {
				var data_json = JSON.parse(data);
				var company = data_json['company'];
				var city = data_json['info'][0];
				console.log(company);
					document.getElementById("companyName").value = company.name;
					document.getElementById("companyDescription").value = company.description;
					document.getElementById("companyCategory").value = company.category_id;
					document.getElementById("companyIndustry").value = company.industry;
					document.getElementById("companyType").value = company.type_company_id;
					document.getElementById("companyWebsite").value = company.website;
					document.getElementById("companyPhone").value = company.phone;
					document.getElementById("companyEmail").value = company.email;
					document.getElementById("companyAddress").value = company.address;
					document.getElementById("companyFacebook").value = company.facebook;
					document.getElementById("companyInstagram").value = company.instagram;
					document.getElementById("companyCities").value = company.city_id;
					document.getElementById("blockCompany").checked = company.block;

					document.getElementById("companyImage_prev").src = window.location.origin+'/uploads/company/'+id_company+'/'+company.profile_img_url;
					document.getElementById("companyImageBg_prev").src = window.location.origin+'/uploads/company/'+id_company+'/'+company.bg_img_url;
					
					$('#companyCategory').val(company.category_id).change();
					$('#companyCountry').val(city.country_id);
						var option = new Option(city.province_name, city.province_id);
						$("#companyProvince").append(option);
					$('#companyProvince').val(city.province_id);
						var option = new Option(city.city_name, city.city_id);
						$("#companyCities").append(option);
					$('#companyCities').val(city.city_id);
					$('#provinces').removeClass("d-none");
					$('#cities').removeClass("d-none");
					// $('#companyProvince').val(company.city_id);
			},
		});
	});
});

function checkImgSize(fuData, inputFile){
	var Extension = inputFile.substring(inputFile.lastIndexOf('.') + 1).toLowerCase();
	if (Extension == "gif" || Extension == "png" || Extension == "bmp" || Extension == "jpeg" || Extension == "jpg") {
			if (fuData.files && fuData.files[0]) {
				var size = fuData.files[0].size;
				if(size > 1000024){
					alert("Maximum file size exceeds");
					return false;
				}else{
					var reader = new FileReader();
					reader.onload = function(e) {
						$('#blah').attr('src', e.target.result);
					}
					reader.readAsDataURL(fuData.files[0]);
					return true;
				}
			}
	} 
}

input.addEventListener("change", function () {
	img_preview.classList.remove("d-none");
	$("#image-preview > img").css({
		"max-width": "50%",
		"max-height": "20%",
	});
	// check if file is an image
	if (this.files && this.files[0]) {
		const file = this.files[0];
		const reader = new FileReader();
		// read file data
		reader.addEventListener("load", function () {
			// set preview image source
			preview.src = reader.result;
		});
		// read file data as URL
		reader.readAsDataURL(file);
	}
});
input_bg.addEventListener("change", function () {
	img_preview.classList.remove("d-none");
	$("#image-preview-bg > img").css({
		"max-width": "50%",
		"max-height": "20%",
	});
	// check if file is an image
	if (this.files && this.files[0]) {
		const file = this.files[0];
		const reader = new FileReader();
		// read file data
		reader.addEventListener("load", function () {
			// set preview image source
			preview.src = reader.result;
		});
		// read file data as URL
		reader.readAsDataURL(file);
	}
});

$("#carousel_form_head").on("submit", function(event) {
	event.preventDefault();
	let title_home = $("#title_home").val();
	let description_home = $("#description_home").val();
	if (title_home === "") return alert_user("add the title","the title is empty","error");
	if (description_home === "") return alert_user("add the description","the description is empty","error");

	var fuData = document.getElementById('image_principal');
	let inputFile = $("#image_principal").val();
	var check = checkImgSize(fuData, inputFile);
	if(inputFile !== '' && !check){
		return alert_user("Error","Select a image to continue 1.","error");
	}
	// if (inputFile === '') return alert_user("Error","Select a image to continue.","error");

	var fuData = document.getElementById('image_deco1');
	let inputFile1 = $("#image_deco1").val();
	var check = checkImgSize(fuData, inputFile1);
	if(inputFile1 !== '' && !check){
		return alert_user("Error","Select a image to continue 2.","error");
	}
	// if (inputFile1 === '') return alert_user("Error","Select a image to continue 2.","error");

	var fuData = document.getElementById('image_deco2');
	let inputFile2 = $("#image_deco2").val();
	var check = checkImgSize(fuData, inputFile2);
	if(inputFile2 !== '' && !check){
		return alert_user("Error","Select a image to continue 3.","error");
	}
	// if (inputFile === '') return alert_user("Error","Select a image to continue 3.","error");

	let formData = new FormData(this);
	console.log(formData);
	$.ajax({
		url: "/ajax/insert_carousel_head",
		method: "POST",
		data: formData,
		processData: false,
		contentType: false,
		success: function(response) {
			window.scrollTo(0,0);
			appendAlert('Updated successfully !', 'success')
			setTimeout(() => {
				location.reload();
			}, 3000);
		},
		error: function(xhr, status, error) {
			//console.error("Aqui mi rey: " + error);
		}
	});
});

companyForm.addEventListener("click", function (e) {
	e.preventDefault();
	const companyName = document.getElementById("companyName").value;
	const companyDescription = document.getElementById("companyDescription").value;
	const category = parseInt(document.getElementById("companyCategory").value);
	const industry = parseInt(document.getElementById("companyIndustry").value);
	const type = parseInt(document.getElementById("companyType").value);
	const companyWebsite = document.getElementById("companyWebsite").value;
	const companyPhone = document.getElementById("companyPhone").value;
	const companyEmail = document.getElementById("companyEmail").value;
	const companyAddress = document.getElementById("companyAddress").value;
	const companyFacebook = document.getElementById("companyFacebook").value;
	const companyInstagram = document.getElementById("companyInstagram").value;
	const companyCities = document.getElementById("companyCities").value;
	const blockCompany = !document.getElementById("blockCompany").checked? 1: 0;
	if (companyCities === "") return alertError("The city is required to continue");
	if (!/^[\w\s&'.,-]+$/i.test(companyName)) return alertError("Check the name company");
	if (category === "") return alertError("Select a category");
	if (!/^[A-Za-z0-9\s.,!@#$%^&*()_+-=;:'"\/?><\[\]\{\}]*$/.test(companyName)) return alertError("check the name company");
	if (!/^[\w\s&'.,-]+$/i.test(companyName)) return alertError("check the name company");
	if (companyPhone !== "" && !/^(\d{9})$/.test(companyPhone)) return alertError("Check the phone company");
	if (companyEmail !== "" && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(companyEmail)) return alertError("Check the email company");
	if (
		!/^((http|https):\/\/)?([a-z0-9-]+\.)+[a-z]{2,}(\/[^\s]*)?$/.test(
			companyWebsite
		)
	) return alertError("Check the website company");
	if (
		companyFacebook !== "" &&
		!/^(?:https?:\/\/)?(?:www\.)?facebook\.com\/(?:[\w\-\.]+\/)?([\w\-\.]+)\/?$/.test(
			companyFacebook
		)
	) return alertError("Check the facebook company");
	if (
		companyInstagram !== "" &&
		!/^(?:https?:\/\/)?(?:www\.)?instagram\.com\/(?:[A-Za-z0-9_\.]+)\/?$/.test(
			companyInstagram
		)
	) return alertError("Check the instagram company");

	// get the file input element and the selected file
	const companyImage = document.getElementById("companyImage");
	if (companyImage === "") return alertError("Put a image for the company");
	const file = companyImage.files[0];
	const companyImageBg = document.getElementById("companyImageBg");
	const fileBg = companyImageBg.files[0];
	// create a FormData object to send the file data
	const formData = new FormData();
	formData.append("companyImage", file);
	formData.append("companyImageBg", fileBg);
	formData.append("companyName", companyName);
	formData.append("companyDescription", companyDescription);
	formData.append("companyCategory", category);
	formData.append("companyIndustry", industry);
	formData.append("companyType", type);
	formData.append("companyWebsite", companyWebsite);
	formData.append("companyPhone", companyPhone);
	formData.append("companyEmail", companyEmail);
	formData.append("companyAddress", companyAddress);
	formData.append("companyFacebook", companyFacebook);
	formData.append("companyInstagram", companyInstagram);
	formData.append("companyCities", companyCities);
	formData.append("blockCompany", blockCompany);
	formData.append("id_company", id_company);
	console.log(formData);
	$.ajax({
		url: "/admin/company/create",
		method: "POST",
		data: formData,
		processData: false,
		contentType: false,
		success: function(response) {
			window.scrollTo(0,0);
			appendAlert('Updated successfully !', 'success')
			// setTimeout(() => {
			// 	location.reload();
			// }, 3000);
		},
		error: function(xhr, status, error) {
			// console.log('compani error', error, xhr.responseJSON);
			alert_user("Error","There was an error uploading the info","error");
		}
	});
	// send the form data via AJAX to the CodeIgniter controller
	
});

// function showErrorInForm(class_to_insert,msg) {
//     const = $(`.${class_to_insert}`)
//     const newHtml = $('<p class="text-danger">' + msg + '</p>');
//     $(`.${class_to_insert}`).append(newHtml);
// }

function alertError(msg) {
	Swal.fire({
		icon: "error",
		title: "Error",
		text: msg,
	});
}

$(document).ready(function() {
    $('#companyCountry').change(function() {
        let selectedValue = $(this).val();
		if (selectedValue === "") {
			$('#provinces').addClass("d-none");
			$('#cities').addClass("d-none");
			$('#companyProvince').empty();
			return $('#companyCities').empty();
		}
        $.ajax({
            type: "GET",
            url:'/ajax/' +"provinces_by_country/"+selectedValue,
            success: function(options) {
				$('#provinces').removeClass("d-none");
				$('#companyCities').empty();
				$('#companyProvince option').not(':first-child').remove();
				const provinces = JSON.parse(options);
				provinces.map(e=>{
					let option = $('<option/>', {
						value: e.id,
						text: e.name
					});
					$('#companyProvince').append(option);
				})
            },
        });
    });
	$('#companyProvince').change(function() {
        let selectedValue = $(this).val();
		if (selectedValue === "") {
			$('#cities').addClass("d-none");
			return $('#companyCities').empty();
		}
        $.ajax({
            type: "GET",
            url:'/ajax/' +"cities_by_provinces/"+selectedValue+"/"+3,
            success: function(options) {
				$('#cities').removeClass("d-none");
				$('#companyCities option').not(':first-child').remove();
				$('#companyCities').empty();
				const cities = JSON.parse(options);
				cities.map(e=>{
					let option = $('<option/>', {
						value: e.id,
						text: e.name
					});
					$('#companyCities').append(option);
				})
            }
        });
    });

	$('#companyCountryOffer').change(function() {
        let selectedValue = $(this).val();
		if (selectedValue === "") {
			$('#provincesOffer').addClass("d-none");
			$('#citiesOffer').addClass("d-none");
			$('#companyProvinceOffer').empty();
			return $('#companyCitiesOffer').empty();
		}
        $.ajax({
            type: "GET",
            url:'/ajax/' +"provinces_by_country/"+selectedValue,
            success: function(options) {
				$('#provincesOffer').removeClass("d-none");
				$('#companyCitiesOffer').empty();
				$('#companyProvinceOffer option').not(':first-child').remove();
				const provinces = JSON.parse(options);
				provinces.map(e=>{
					let option = $('<option/>', {
						value: e.id,
						text: e.name
					});
					$('#companyProvinceOffer').append(option);
				})
            },
        });
    });
	$('#companyProvinceOffer').change(function() {
        let selectedValue = $(this).val();
		if (selectedValue === "") {
			$('#citiesOffer').addClass("d-none");
			return $('#companyCitiesOffer').empty();
		}
        $.ajax({
            type: "GET",
            url:'/ajax/' +"cities_by_provinces/"+selectedValue+"/"+3,
            success: function(options) {
				$('#citiesOffer').removeClass("d-none");
				$('#companyCitiesOffer option').not(':first-child').remove();
				$('#companyCitiesOffer').empty();
				const cities = JSON.parse(options);
				cities.map(e=>{
					let option = $('<option/>', {
						value: e.id,
						text: e.name
					});
					$('#companyCitiesOffer').append(option);
				})
            }
        });
    });

	$("#offers_justlocal").on("submit", function(event) {
		event.preventDefault();

		if(id_company == 0){
			alert_user("Error","First you need to select a company.","error");
		}

		let offer_title = $("#offer_title").val();
		let discount_offer = $("#discount_offer").val();
		let review_offer = $("#review_offer").val();
		let description_offer = $("#description_offer").val();
		let city_offer = $("#companyCitiesOffer").val();

		if(offer_title == '' || discount_offer == '' || review_offer == '' || description_offer == ''){
			alert_user("Error","Please fill all the data","error");
		}
		if(city_offer == 0 || city_offer == ''){
			alert_user("Error","You must select a city","error");
		}

		let formData = new FormData(this);
		formData.append("id_company", id_company);
	
		$.ajax({
			url: "/ajax/insert_review",
			method: "POST",
			data: formData,
			processData: false,
			contentType: false, 
			success: function(response) {
				window.scrollTo(0,0);
				appendAlert('Added successfully !', 'success')
				setTimeout(() => {
					location.reload();
				}, 3000);
				console.log(response);
			},
			error: function(xhr, status, error) {
				console.error("Error submitting form: " + error);
			}
		});
	});

	$("#review_justlocal").on("submit", function(event) {
		event.preventDefault();

		if(id_company == 0){
			alert_user("Error","First you need to select a company.","error");
		}

		let comment_review = $("#comment_review").val();
		let name_user = $("#name_user").val();
		let job_description = $("#job_description").val();
		let review_image = $("#review_image").val();
		let formData = new FormData(this);
		formData.append("id_company", id_company);
	
		var fuData = document.getElementById('review_image');
		let inputFile = $("#review_image").val();
		var check = checkImgSize(fuData, inputFile);
		if(!check){
			return;
		}
	
		$.ajax({
			url: "/ajax/insert_review",
			method: "POST",
			data: formData,
			processData: false,
			contentType: false, 
			success: function(response) {
				//let data = JSON.parse(response);
				// let respuesta = JSON.parse(response);
				window.scrollTo(0,0);
				appendAlert('Added successfully !', 'success')
				setTimeout(() => {
					location.reload();
				}, 3000);
				// alert_user("Review inserted",respuesta.msg,"success");
				console.log(response);
			},
			error: function(xhr, status, error) {
			// Handle error response
			console.error("Error submitting form: " + error);
			}
		});
	});
});

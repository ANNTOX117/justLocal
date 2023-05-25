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

$(document).ready(function() {
	var id_offer = 0;
	var id_to_delete = 0;

	const delete_offer = document.querySelectorAll('.delete-icon');
    delete_offer.forEach(delete_button => {
        delete_button.addEventListener('click', function clickEv(e) {
            id_to_delete = this.dataset.id;
        });
    });

	const company_buttons = document.querySelectorAll('.btn-update-offer');
	company_buttons.forEach(button_clickable => {
	button_clickable.addEventListener('click', function handleChange(e) {
		
		id_offer = this.getAttribute('data-id');
		$.ajax({
			type: "GET",
			url:'/ajax/get/offer/'+id_offer,
			success: function(data) {
				var data_json = JSON.parse(data)[0];
					document.getElementById("offerName").value = data_json.title;
					document.getElementById("offerDescription").value = data_json.description;
					document.getElementById("company").value = data_json.company_id;
					document.getElementById("review").value = data_json.review;
					document.getElementById("discount").value = data_json.discount;
					document.getElementById("blockOffer").value = data_json.active;
					
					$('#companyCountry').val(data_json.country_id);
						var option = new Option(data_json.province_name, data_json.province_id);
						$("#companyProvince").append(option);
					$('#companyProvince').val(data_json.province_id);
						var option = new Option(data_json.city_name, data_json.city_id);
						$("#companyCities").append(option);
					$('#companyCities').val(data_json.city_id);
					$('#provinces').removeClass("d-none");
					$('#cities').removeClass("d-none");
					// $('#companyProvince').val(company.city_id);
			},
		});
	});
});

document.getElementById('delete_offer').addEventListener('click', function clickEv(e) {
	$.ajax({
		url: "/ajax/delete_offer/"+id_to_delete,
		method: "get",
		processData: false,
		contentType: false, 
		success: function(response) {
			$('#exampleModal').modal('hide');
			window.scrollTo(0,0);
			appendAlert('Deleted successfully !', 'success')
			setTimeout(() => {
				location.reload();
			}, 3000);
			console.log("hello there",response);
		},
		error: function(xhr, status, error) {
			window.scrollTo(0,0);
			appendAlert('There was a problem with the process !', 'danger')
			$('#exampleModal').modal('hide');
		}
	});
}); 

    const form_offer = $("#form_offer");
    form_offer.submit(function (event) {
        event.preventDefault();
		const offerName = $("#offerName").val();
		const offerDescription = $("#offerDescription").val();
		const company = $("#company").val();
		const review = $("#review").val();
		const discount = $("#discount").val();
		const companyCities = $("#companyCities").val();
		if (offerName === "") return alertError("The title is required");
		if (company === "") return alertError("The company is required");
		if (review === "") return alertError("The review is required");
		if (discount === "") return alertError("The discount is required");
		if (companyCities === "") return alertError("The city is required");
        // let formData = $(this).serialize();
		let formData = new FormData(this);
		formData.append("id_offer", id_offer);
		
		$.ajax({
            type: "POST",
            url:'/ajax/' +"insert_offer",
			data: formData,
			processData: false,
			contentType: false, 
            success: function(options) {
				appendAlert('Updated successfully !', 'success')
				let city = $("#companyCities").find('option:selected').text();
				let company = $("#company").find('option:selected').text();
				let data = JSON.parse(options);
				$("#offerName").val("");
				$("#offerDescription").val("");
				$("#company").val("");
				$("#review").val("");
				$("#discount").val("");
				$("#companyCountry").val("");
				$("#companyProvince").val("");
				$("#companyCities").val("");
				$('#blockOffer').prop('checked', false);
				$('#provinces').addClass("d-none");
				$('#cities').addClass("d-none");
				let newRow = $("<tr>");
				newRow.append($('<td>').text(data.id));
				newRow.append($('<td>').text(offerName));
				newRow.append($('<td>').text(offerDescription));
				newRow.append($('<td>').text(company));
				newRow.append($('<td>').text(city));
				newRow.append($('<td>').append('<span class="text-danger"><i class="fa-solid fa-trash" title="delete"></i></span>'));
				$("#table_offers").append(newRow);
            },
        });
    });

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
            url:'/ajax/' +"cities_by_provinces/"+selectedValue+'/3',
            success: function(options) {3
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
});

function alertError(msg) {
	Swal.fire({
		icon: "error",
		title: "Error",
		text: msg,
	});
}
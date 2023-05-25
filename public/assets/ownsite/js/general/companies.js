$(document).ready(function() {
	$("#pagination nav").addClass("nav-pagination");
	$("#pagination nav li").addClass("page-item");
	$("#pagination nav li a").addClass("page-link");
	let url = window.location.pathname;
	let value = url.substring(url.lastIndexOf('/') + 1);
	url = value === "offers"?'/ajax/return_pagination_offer':'/ajax/return_pagination_company';
	var urlParams = new URLSearchParams(window.location.search);
	var name_company = urlParams.get('name_company');
	$('#branche_all').change(function() {
		let selectedValue = $(this).val();
		
		$.ajax({
			type: "GET",
			url:url,
			data:{
				type_company:$('#filter-searching .active').data("id"),
				provincie:$("#province_all").val(),
				stad:$("#stad_all").val(),
				branche:selectedValue,
				name_company
			},
			success: function(response) {
				$('#blocks_first_part').html(response.views.first_part);
				$('#blocks_second_part').html(response.views.second_part);
				console.log(name_company);
			},
		});
	});

	let query_get = window.location.search.substring(1);
	let data_get = query_get !==""? parseQueryString(query_get):false;
	if (data_get) {
		$("#province_all").val(data_get.provincie);
		$.ajax({
            type: "GET",
            url:'/ajax/' +"cities_by_provinces/"+data_get.provincie+"/2",
            success: function(options) {
				$('#stad_all option').not(':first-child').remove();
				const cities = JSON.parse(options);
				cities.map(e=>{
					let option = $('<option/>', {
						value: e.id,
						text: e.name
					});
					$('#stad_all').append(option);
				});
				$("#stad_all").val(data_get.stad);
            }
        });
		$.ajax({
            type: "GET",
            url:'/ajax/' +"branches_by_city/"+data_get.stad+"/3",
            success: function(options) {
				$('#branche_all option').not(':first-child').remove();
				const cities = JSON.parse(options);
				cities.map(e=>{
					let option = $('<option/>', {
						value: e.id,
						text: e.name
					});
					$('#branche_all').append(option);
					$("#branche_all").val(data_get.branche);
				})
            }
        });
	}

	$("#filter-searching li a").click(function() {
		$("#filter-searching li a").removeClass("active");
		$(this).addClass("active");
		let type_company = this.attributes["data-id"].nodeValue;
		$.ajax({
			type: "GET",
			url:url,
			data:{
				type_company,
				provincie:$("#province_all").val(),
				stad:$("#stad_all").val(),
				branche:$("#branche_all").val(),
				name_company
			},
			success: function(response) {
				$('#blocks_first_part').html(response.views.first_part);
				$('#blocks_second_part').html(response.views.second_part);
				//$('#blocks_first_part').html(response.views.first_part);
			},
		});
	});

	function parseQueryString(queryString) {
		let params = {};
		let queries = queryString.split("&");
		for (let i = 0; i < queries.length; i++) {
			let temp = queries[i].split("=");
			params[temp[0]] = temp[1];
		}
		return params;
	}

	$('#province_all').change(function() {
        let selectedValue = $(this).val();
		if (selectedValue === "") {
			return $('#stad_all option').not(':first-child').remove();//$('#companyCities').empty();
		}
        $.ajax({
            type: "GET",
            url:'/ajax/' +"cities_by_provinces/"+selectedValue+"/2",
            success: function(options) {
				$('#stad_all option').not(':first-child').remove();
				const cities = JSON.parse(options);
				try {
					cities.map(e=>{
						let option = $('<option/>', {
							value: e.id,
							text: e.name
						});
						$('#stad_all').append(option);
					});	
				} catch (error) {
					
				}
				$.ajax({
					type: "GET",
					url:url,
					data:{
						provincie:selectedValue,
						type_company:$('#filter-searching .active').data("id"),
						name_company
					},
					success: function(response) {
						$('#blocks_first_part').html(response.views.first_part);
						$('#blocks_second_part').html(response.views.second_part);
						//$('#blocks_first_part').html(response.views.first_part);
					},
				});
            }
        });
    });

	$('#stad_all').change(function() {
        let selectedValue = $(this).val();
		if (selectedValue === "") {
			return $('#branche_all option').not(':first-child').remove();//$('#companyCities').empty();
		}
        $.ajax({
            type: "GET",
            url:'/ajax/' +"branches_by_city/"+selectedValue+"/3",
            success: function(options) {
				$('#branche_all option').not(':first-child').remove();
				const cities = JSON.parse(options);
				cities.map(e=>{
					let option = $('<option/>', {
						value: e.id,
						text: e.name
					});
					$('#branche_all').append(option);
				});
				$.ajax({
					type: "GET",
					url:url,
					data:{
						stad:selectedValue,
						type_company:$('#filter-searching .active').data("id"),
						name_company
					},
					success: function(response) {
						$('#blocks_first_part').html(response.views.first_part);
						$('#blocks_second_part').html(response.views.second_part);
						//$('#blocks_first_part').html(response.views.first_part);
					},
				});
            }
        });
    });
	
});
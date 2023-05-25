$(document).ready(function () {
	$("#category_submit").on("click", function (e) {
		e.preventDefault();
		const categoryName = $("#categoryName").val();
		const blockCategory = $("#blockCategory").is(":checked");
		let id_category = $("#id_category").val();
		if (categoryName === "") {
			alert("Put the name of a category");
		} else {
			axios
				.post("/admin/category/create", {
					category: categoryName,
					blockCategory,
					id_category,
				})
				.then(function (response) {
					console.log(response.data);
					const newCategory = $(
						'<button type="button" class="list-group-item list-group-item-action" data-id="' +
							response.data.id +
							'">' +
							categoryName +
							"</button>"
					);
					$(".list-group").append(newCategory);
					// clear the form
					$("#categoryName").val("");
					$("#blockCategory").prop("checked", false);
					// do something else on success, like show a success message
				})
				.catch(function (error) {
					console.log(error);
					alert("Error creating category!");
					// do something else on error, like show an error message
				});
		}
		$("#id_category").remove();
	});
	$(".list-group").on("click", ".list-group-item", function () {
		let dataId = $(this).data("id");
		$.ajax({
			url: "/admin/category/" + dataId,
			type: "GET",
			success: function (response) {
				if (response.status === 500) {
					alert_user("hola", "mundo", "error");
				}
				$("#categoryName").val(response.name);
				$("#blockCategory").prop("checked", response.block == 0);
				var hiddenInput = $("<input>")
					.attr("type", "hidden")
					.attr("id", "id_category")
					.attr("name", "id_category")
					.val(response.id);

				// Append the hidden input element to the form
				$("#id_category").remove();
				$(".card-body").append(hiddenInput);
			},
			error: function (xhr, status, error) {
				console.error("Form submission failed", error);
			},
		});
	});
});

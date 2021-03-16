$(document).on("submit", "#form-data", function (event) {
	return checkForm(event);
});
$(document).on("click", "#btn-submit", function (event) {
	return checkForm(event);
});

function checkForm(event) {
	event.preventDefault();
	var site_name = $("#site_name").val();
	var registration = $("#registration").val();
	if (site_name === "") {
		return Swal.fire({
			icon: "warning",
			html: "<p class='font-weight-light alert-text'>Nama aplikasi diperlukan!</p>"
		});
	}
	updateData(site_name, registration);
	return false;
}

function updateData(site_name, registration) {
	$.ajax({
		type: "PUT",
		url: APP_URL,
		headers: {
			"X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
		},
		dataType: "JSON",
		data: {
			site_name,
			registration
		},
		cache: false,
		success: function (data) {
			if (data.success === true) {
				Swal.fire({
					icon: "success",
					html: "<p class='font-weight-light alert-text'>" + data.message + "</p>",
				});
			} else {
				Swal.fire({
					icon: "error",
					html: "<p class='alert-text font-weight-light'>" + data.message + "</p>",
				});
			}
		},
		error: function () {
			Swal.fire({
				icon: "error",
				html: "<p class='font-weight-light alert-text'>Terjadi kesalahan</p>",
			});
		}
	});
}
$(document).on("submit", "#form-data", function (event) {
	return checkForm(event);
});
$(document).on("click", "#btn-submit", function (event) {
	return checkForm(event);
});

function checkForm(event) {
	event.preventDefault();
	var name = $("#name").val();
	var email = $("#email").val();
	var password = $("#password").val();
	var password_confirmation = $("#password_confirmation").val();
	if (name === "") {
		return Swal.fire({
			icon: "warning",
			html: "<p class='font-weight-light alert-text'>Nama lengkap Kamu diperlukan!</p>"
		});
	}
	if (email === "") {
		return Swal.fire({
			icon: "warning",
			html: "<p class='font-weight-light alert-text'>Alamat email Kamu juga diperlukan!</p>"
		});
	}
	if (password != password_confirmation) {
		return Swal.fire({
			icon: "warning",
			html: "<p class='font-weight-light alert-text'>Konfirmasi password Kamu nggak cocok <br /><br /> Harap periksa lagi yah!</p>"
		});
	}
	updateData(name, email, password, password_confirmation);
	return false;
}

function updateData(name, email, password, password_confirmation) {
	$.ajax({
		type: "PUT",
		url: APP_URL,
		headers: {
			"X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
		},
		dataType: "JSON",
		data: {
			name,
			email,
			password,
			password_confirmation
		},
		cache: false,
		success: function (data) {
			if (data.success === true) {
				Swal.fire({
					icon: 'success',
					html: "<p class='font-weight-light alert-text'>" + data.message + "</p>",
					timer: 1500
				});
			} else {
				Swal.fire({
					icon: "error",
					html: "<p class='font-weight-light alert-text'>" + data.message + "</p>",
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
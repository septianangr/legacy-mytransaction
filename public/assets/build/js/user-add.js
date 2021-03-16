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
			html: "<p class='font-weight-light alert-text'>Nama lengkap pengguna diperlukan!</p>"
		});
	}
	if (name.length < 3) {
		return Swal.fire({
			icon: "warning",
			html: "<p class='font-weight-light alert-text'>Nama lengkap pengguna minimal 3 karakter!</p>"
		});
	}
	if (email === "") {
		return Swal.fire({
			icon: "warning",
			html: "<p class='font-weight-light alert-text'>Alamat email pengguna diperlukan!</p>"
		});
	}
	if (password === "") {
		return Swal.fire({
			icon: "warning",
			html: "<p class='font-weight-light alert-text'>Password login pengguna diperlukan!</p>"
		});
	}
	if (password.length < 8) {
		return Swal.fire({
			icon: "warning",
			html: "<p class='font-weight-light alert-text'>Password login pengguna minimal 8 karakter!</p>"
		});
	}
	if (password_confirmation === "") {
		return Swal.fire({
			icon: "warning",
			html: "<p class='font-weight-light alert-text'>Konfirmasi password diperlukan!</p>"
		});
	}
	if (password != password_confirmation) {
		return Swal.fire({
			icon: "warning",
			html: "<p class='font-weight-light alert-text'>Konfirmasi password tidak sesuai!</p>"
		});
	}
	storeData(name, email, password, password_confirmation);
	return false;
}

function storeData(name, email, password, password_confirmation) {
	$.ajax({
		type: "POST",
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
					icon: "success",
					html: "<p class='font-weight-light alert-text'>" + data.message + "</p>",
					timer: 1500
				});
				$('#form-data').trigger("reset");
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
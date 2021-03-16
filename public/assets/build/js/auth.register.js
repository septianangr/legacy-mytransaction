$(document).on("submit", "#form-register", function (event) {
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
	if (name == "") {
		return Swal.fire({
			icon: "warning",
			html: "<p class='alert-text font-weight-light'>Harap isi nama lengkap Kamu!</p>",
		});
	}
	if (name.length < 3) {
		return Swal.fire({
			icon: "warning",
			html: "<p class='alert-text font-weight-light'>Nama lengkap minimal 3 karakter</p>",
		});
	}
	if (email == "") {
		return Swal.fire({
			icon: "warning",
			html: "<p class='alert-text font-weight-light'>Harap isi alamat email!</p>",
		});
	}
	if (password == "") {
		return Swal.fire({
			icon: 'warning',
			html: "<p class='alert-text font-weight-light'>Harap isi password login!</p>",
		});
	}
	if (password.length < 8) {
		return Swal.fire({
			icon: 'warning',
			html: "<p class='alert-text font-weight-light'>Password loginya minimal 8 karakter!</p>",
		});
	}
	if (password_confirmation == "") {
		return Swal.fire({
			icon: 'warning',
			html: "<p class='alert-text font-weight-light'>Harap isi juga konfirmasi password!</p>",
		});
	}
	if (password != password_confirmation) {
		return Swal.fire({
			icon: 'warning',
			html: "<p class='alert-text font-weight-light'>Konfirmasi password Kamu nggak cocok <br /><br /> Harap periksa lagi!</p>",
		});
	}
	Swal.fire({
		html: "<p class='alert-text font-weight-light'>Memproses pendaftaran akun</p>",
		timer: 1000,
		showConfirmButton: false,
		timerProgressBar: true,
	}).then((result) => {
		doRegister(name, email, password, password_confirmation);
	});
	return false;
}

function doRegister(name, email, password, password_confirmation) {
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
					html: "<h2 class='font-weight-light'>Selamat!</h2><p class='alert-text font-weight-light'>" + data.message + "</p>"
				}).then(() => {
					location.href = data.redirect;
				});
			} else {
				Swal.fire({
					icon: "error",
					html: "<p class='alert-text font-weight-light'>" + data.message + "</p>",
				});
			}
			return false;
		}
	});
}
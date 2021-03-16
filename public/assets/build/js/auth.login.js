$(document).on("submit", "#form-signin", function (event) {
	return checkForm(event);
});
$(document).on("click", "#btn-submit", function (event) {
	return checkForm(event);
});

function checkForm(event) {
	event.preventDefault();
	var email = $("#email").val();
	var password = $("#password").val();
	if (email === "") {
		return Swal.fire({
			icon: "warning",
			html: "<p class='alert-text font-weight-light'>Alamat email login diperlukan!</p>",
		});
	}
	if (password === "") {
		return Swal.fire({
			icon: 'warning',
			html: "<p class='alert-text font-weight-light'>Password login juga diperlukan!</p>",
		});
	}
	Swal.fire({
		html: "<p class='alert-text font-weight-light'>Memproses login akun</p>",
		timer: 600,
		showConfirmButton: false,
		timerProgressBar: true,
	}).then((result) => {
		doLogin(email, password);
	});
	return false;
}

function doLogin(email, password) {
	var remember = $("#remember").val();
	$("#remember").each(function () {
		if (this.checked) {
			remember = 1;
		} else {
			remember = 0;
		}
	});
	$.ajax({
		type: "POST",
		url: APP_URL,
		headers: {
			"X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
		},
		dataType: "JSON",
		data: {
			email,
			password,
			remember
		},
		cache: false,
		success: function (data) {
			if (data.success === true) {
				Swal.fire({
					icon: "success",
					html: "<p class='alert-text font-weight-light'>" + data.message + "</p>",
					timer: 1000,
					showConfirmButton: false,
				});
				location.href = data.redirect;
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
$(document).on("click", "#logout", function (event) {
	event.preventDefault();
	var redirect = $(this).data("href");
	Swal.fire({
		html: "<p class='font-weight-light alert-text'>Apakah Kamu yakin ingin keluar akun?</p>",
		showCancelButton: true,
		confirmButtonText: "Iya",
		cancelButtonText: "Tidak"
	}).then((result) => {
		if (result.value) {
			Swal.fire({
				html: "<p class='alert-text font-weight-light'>Memproses logout akun</p>",
				timer: 600,
				showConfirmButton: false,
				timerProgressBar: true,
			}).then((result) => {
				location.href = redirect;
			});
		}
		return false;
	})
});
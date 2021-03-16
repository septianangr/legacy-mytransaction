$(document).ready(function () {
	var length = $("#length").val();
	var keyword = $("#keyword").val();
	getData(length, keyword);
	$("#length").change(function () {
		var length = $("#length").val();
		var keyword = $("#keyword").val();
		getData(length, keyword);
	});
	$("#keyword").keyup(function () {
		var length = $("#length").val();
		var keyword = $("#keyword").val();
		getData(length, keyword);
	});
});

function getData(length, keyword) {
	$.ajax({
		type: "GET",
		url: APP_URL_1,
		headers: {
			"X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
		},
		dataType: "JSON",
		data: {
			length,
			keyword
		},
		cache: false,
		success: function (data) {
			var html = "";
			if (data.success === true) {
				html += '<p><strong>Data :</strong> ' + data.count + '</p>';
				$.each(data.row, function (i, val) {
					html += '<div class="card shadow-sm mb-4">' + '<div class="card-header bg-dark text-white">' + '<div class="d-flex nowrap">' + '<div class="mr-auto pt-1">' + val.name + '</div>' + '<div>' + val.edit + val.delete + '</div>' + '</div>' + '</div>' + '<div class="card-body">' + '<p>No: ' + val.number + '</p>' + '<p>' + 'Email: ' + val.email + '</p>' + '<p>' + 'Registrasi: ' + val.created_at + '</p>' + '</div>' + '</div>';
				});
			} else {
				html += '<div class="card shadow-sm">' + '<div class="card-header bg-dark text-white"><i class="fal fa-exclamation-circle fa-sm"></i>&nbsp; Data tidak tersedia</div>' + '</div>';
			}
			$("#content").html(html);
		}
	});
}
$(document).on("click", "#btn-edit", function (event) {
	event.preventDefault();
	var id = $(this).data("id");
	var old_email = $(this).data("email");
	Swal.fire({
		html: '<p class="font-weight-light alert-text">Perbarui Data Pengguna</p>' + '<form class="mt-4" id="form-data" action="javascript:void(0)">' + '<div class="form-group mb-4">' + '<div class="input-group shadow-sm">' + '<div class="input-group-prepend">' + '<div class="input-group-text"><i class="fal fa-user"></i></div>' + '</div>' + '<input type="text" class="form-control font-weight-light" id="name" autocomplete="off" maxlength="32" placeholder="Nama Lengkap" value="' + $(this).data("name") + '" required>' + '</div>' + '</div>' + '<div class="form-group mb-4">' + '<div class="input-group shadow-sm">' + '<div class="input-group-prepend">' + '<div class="input-group-text"><i class="fal fa-envelope"></i></div>' + '</div>' + '<input type="email" class="form-control font-weight-light" id="email" autocomplete="off" maxlength="64" placeholder="Alamat Email" value="' + $(this).data("email") + '" required>' + '</div>' + '</div>' + '<div class="form-group mb-4">' + '<div class="input-group shadow-sm">' + '<div class="input-group-prepend">' + '<div class="input-group-text"><i class="fal fa-lock"></i></div>' + '</div>' + '<input type="password" class="form-control font-weight-light" id="password" autocomplete="off" placeholder="Password Baru">' + '</div>' + '</div>' + '</form>',
		showCancelButton: true,
		confirmButtonText: "Simpan",
		cancelButtonText: "Kembali"
	}).then((result) => {
		if (result.value) {
			var name = $("#name").val();
			var email = $("#email").val();
			var password = $("#password").val();
			$.ajax({
				type: "PUT",
				url: APP_URL_2,
				headers: {
					"X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
				},
				dataType: "JSON",
				data: {
					id,
					name,
					email,
					old_email,
					password
				},
				cache: false,
				success: function (data) {
					if (data.success === true) {
						Swal.fire({
							icon: "success",
							html: "<p class='font-weight-light alert-text'>" + data.message + "</p>",
							timer: 1500
						});
						getData($("#length").val(), $("#keyword").val());
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
	})
});
$(document).on("click", "#btn-delete", function (event) {
	event.preventDefault();
	var id = $(this).data("id");
	Swal.fire({
		html: "<p class='font-weight-light alert-text'>Yakin ingin menghapus data pengguna ini?</p>",
		showCancelButton: true,
		confirmButtonText: "Iya",
		cancelButtonText: "Tidak"
	}).then((result) => {
		if (result.value) {
			$.ajax({
				type: "DELETE",
				url: APP_URL_3,
				headers: {
					"X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
				},
				dataType: "JSON",
				data: {
					id
				},
				cache: false,
				success: function (data) {
					if (data.success === true) {
						Swal.fire({
							icon: "success",
							html: "<p class='font-weight-light alert-text'>" + data.message + "</p>",
							timer: 1500
						});
						getData($("#length").val(), $("#keyword").val());
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
	})
});
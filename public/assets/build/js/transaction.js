$(document).ready(function () {
	var period = $("#period").val();
	var keyword = $("#keyword").val();
	getData(period, keyword);
	$("#period").change(function () {
		var period = $("#period").val();
		var keyword = check_keyword();
		getData(period, keyword);
	});
	$("#keyword").keyup(function () {
		var period = $("#period").val();
		var keyword = check_keyword();
		getData(period, keyword);
	});
	$("#to-top").click(function () {
		$("body,html").animate({
			scrollTop: 0
		}, 400);
	});
});
function check_keyword() {
	var keyword = $("#keyword").val();
	if (isNaN(parseInt(keyword))) {
		var keyword = window.btoa($("#keyword").val());
	} else {
		var keyword = $("#keyword").val();
	}
	return keyword;
}
function getData(period, keyword) {
	$.ajax({
		type: "GET",
		url: APP_URL_1,
		headers: {
			"X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
		},
		dataType: "JSON",
		data: {
			period,
			keyword
		},
		cache: false,
		success: function (data) {
			var html = "";
			if (data.success === true) {
				html += '<p><strong>Data :</strong> ' + data.count + '<br /><strong>Total :</strong> Rp. ' + data.sum + '</p>';
				$.each(data.row, function (i, val) {
					html += '<div class="card shadow-sm mb-4">' + '<div class="card-header bg-dark text-white">' + '<div class="d-flex nowrap">' + '<div class="mr-auto pt-1">' + val.date + '</div>' + '<div>' + val.delete + '</div>' + '</div>' + '</div>' + '<div class="card-body">' + '<p>No: ' + val.number + '</p>' + '<p>' + 'Waktu: ' + val.time + '</p>' + '<p>' + 'Biaya: ' + val.amount + '</p>' + '<p>' + 'Keterangan: ' + window.atob(val.info) + '</p>' + '</div>' + '</div>';
				});
				if (data.count > 7) {
					$("#to-top").show();
				} else {
					$("#to-top").hide();
				}
			} else {
				html += '<div class="card shadow-sm">' + '<div class="card-header bg-dark text-white"><i class="fal fa-exclamation-circle fa-sm"></i>&nbsp; Data tidak tersedia</div>' + '</div>';
				$("#to-top").hide();
			}
			$("#content").html(html);
		},
		error: function () {
			Swal.fire({
				icon: "error",
				html: "<p class='font-weight-light alert-text'>Terjadi kesalahan</p>",
			});
		}
	});
}
$(document).on("click", "#btn-delete", function (event) {
	event.preventDefault();
	var id = $(this).data("id");
	Swal.fire({
		html: "<p class='font-weight-light alert-text'>Kamu yakin ingin menghapus data transaksi ini?</p>",
		showCancelButton: true,
		confirmButtonText: "Iya",
		cancelButtonText: "Tidak"
	}).then((result) => {
		if (result.value) {
			$.ajax({
				type: "DELETE",
				url: APP_URL_2,
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
						getData($("#period").val(), check_keyword());
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
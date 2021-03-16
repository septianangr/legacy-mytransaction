$(document).ready(function () {
	$("#date-time-box").DateTimePicker({
		dateFormat: "yyyy-MM-dd",
		timeFormat: "HH:mm:ss"
	});
	$('#amount').keyup(function (event) {
		if (event.which >= 37 && event.which <= 40) {
			event.preventDefault();
		}
		$(this).val(function (index, value) {
			value = value.replace(/[^\d]/g, '');
			return value;
		});
		$(this).val(function (index, value) {
			value = value.replace(/,/g, '');
			return numberWithCommas(value);
		});
	});

	function numberWithCommas(x) {
		var parts = x.toString().split(".");
		parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		return parts.join(".");
	}
});
$(document).on("submit", "#form-data", function (event) {
	return checkForm(event);
});
$(document).on("click", "#btn-submit", function (event) {
	return checkForm(event);
});

function checkForm(event) {
	event.preventDefault();
	var date = $("#date").val();
	var time = $("#time").val();
	var info = $("#info").val();
	var amount = $("#amount").val();
	var amount = amount.replace(/,/g, "");
	if (date === "") {
		return Swal.fire({
			icon: "warning",
			html: "<p class='font-weight-light alert-text'>Harap isi tanggal transaksi!</p>"
		});
	}
	if (time === "") {
		return Swal.fire({
			icon: "warning",
			html: "<p class='font-weight-light alert-text'>Harap isi juga waktu transaksi!</p>"
		});
	}
	if (amount === "") {
		return Swal.fire({
			icon: "warning",
			html: "<p class='font-weight-light alert-text'>Harap isi biaya transaksi!</p>"
		});
	}
	if (amount < 100) {
		return Swal.fire({
			icon: "warning",
			html: "<p class='font-weight-light alert-text'>Minimal biaya transaksi adalah Rp. 100</p>"
		});
	}
	if (info === "") {
		return Swal.fire({
			icon: "warning",
			html: "<p class='font-weight-light alert-text'>Harap isi keterangan transaksi!</p>"
		});
	}
	storeData(date, time, amount, window.btoa(info));
	return false;
}

function storeData(date, time, amount, info) {
	$.ajax({
		type: "POST",
		url: APP_URL,
		headers: {
			"X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
		},
		dataType: "JSON",
		data: {
			date,
			time,
			amount,
			info
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
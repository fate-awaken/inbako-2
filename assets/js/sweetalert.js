// SWEET ALERT

$(document).ready(function () {
	$(".btn-delete-warga").on("click", function (e) {
		e.preventDefault();

		var deleteUrl = $(this).data("url");

		Swal.fire({
			title: "Apakah anda yakin?",
			text: "Kamu akan menghapus data warga!",
			showCancelButton: true,
			confirmButtonColor: "#d33",
			cancelButtonColor: "#3085d6",

			confirmButtonText: "Hapus Data",
			customClass: {
				confirmButton: "btn btn-danger",
				cancelButton: "btn btn-primary ms-2",
			},
		}).then(function (result) {
			if (result.isConfirmed) {
				// Redirect ke URL deleteUrl
				window.location.href = deleteUrl;
			}
		});
	});
});
$(document).ready(function () {
	$(".btn-delete-petugas").on("click", function (e) {
		e.preventDefault();

		var deleteUrl = $(this).data("url");

		Swal.fire({
			title: "Apakah anda yakin?",
			text: "Kamu akan menghapus data petugas!",
			showCancelButton: true,
			confirmButtonColor: "#d33",
			cancelButtonColor: "#3085d6",

			confirmButtonText: "Hapus Data",
			customClass: {
				confirmButton: "btn btn-danger",
				cancelButton: "btn btn-primary ms-2",
			},
		}).then(function (result) {
			if (result.isConfirmed) {
				// Redirect ke URL deleteUrl
				window.location.href = deleteUrl;
			}
		});
	});
});

function submitForm() {
	var form = document.getElementById("formUbah");
	var formData = new FormData(form);

	$.ajax({
		type: "POST",
		url: form.getAttribute("action"),
		data: formData,
		dataType: "json",
		processData: false,
		contentType: false,
		success: function (response) {
			if (response.status === "success") {
				Swal.fire({
					icon: "success",
					title: "Sukses",
					text: response.message,
				}).then(function () {
					window.location.href = '<?= base_url("admin/dataPetugas"); ?>';
				});
			} else if (response.status === "error") {
				Swal.fire({
					icon: "error",
					title: "Error",
					text: response.message,
				});
			}
		},
		error: function (xhr, status, error) {
			console.log(xhr.responseText);
		},
	});
}

$(document).ready(function () {
	$("#formUbahData").submit(function (e) {
		e.preventDefault();

		// Lakukan validasi form menggunakan JavaScript atau jQuery
		// ...

		// Jika validasi berhasil, submit form menggunakan AJAX
		$.ajax({
			url: $(this).attr("action"),
			type: "POST",
			dataType: "json",
			data: $(this).serialize(),
			success: function (response) {
				if (response.error) {
					swal({
						title: "Error",
						text: response.message,
						icon: "error",
						button: "OK",
					});
				} else {
					swal({
						title: "Success",
						text: response.message,
						icon: "success",
						button: "OK",
					}).then(function () {
						// Lakukan tindakan setelah berhasil, seperti redirect atau sejenisnya
						window.location.href = "admin/dataPetugas";
					});
				}
			},
		});
	});
});

$(document).ready(function () {
	$(".btn-delete-jadwal").on("click", function (e) {
		e.preventDefault();

		var deleteUrl = $(this).data("url");

		Swal.fire({
			title: "Apakah anda yakin?",
			text: "Kamu akan menyelesaikan sesi jadwal ini!",
			showCancelButton: true,
			confirmButtonColor: "#d33",
			cancelButtonColor: "#3085d6",

			confirmButtonText: "Selesaikan",
			customClass: {
				confirmButton: "btn btn-danger",
				cancelButton: "btn btn-primary ms-2",
			},
		}).then(function (result) {
			if (result.isConfirmed) {
				// Redirect ke URL deleteUrl
				window.location.href = deleteUrl;
			}
		});
	});
});

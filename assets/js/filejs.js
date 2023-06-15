$(document).ready(function () {
	$("#tambahJadwal").submit(function (e) {
		e.preventDefault();
		var form = $(this);

		$.ajax({
			type: "POST",
			url: form.attr("action"),
			data: form.serialize(),
			dataType: "json",
			success: function (response) {
				if (response.status == "error") {
					Swal.fire({
						icon: "error",
						title: "Opss",
						html: response.message,
					});
				} else if (response.status == "success") {
					Swal.fire({
						icon: "success",
						title: "Success",
						text: "Data petugas berhasil ditambahkan.",
					}).then((result) => {
						if (result.isConfirmed) {
							// Redirect to another page or do something else
							window.location.href = "jadwal";
						}
					});
				}
			},
		});
	});
});

<div class="container col-md-10 text-center" style="color: #FE804D;">

	<br>

	<div class="text-center mt-5">
		<br>
		<h1 class="fw-bolder"><?= $title; ?></h1>
	</div>

	<?php
	// Mendapatkan flash data dengan key 'success_message'
	$successMessage = $this->session->flashdata('success_message');
	?>

	<script>
		// Jika flash data tersedia, tampilkan SweetAlert dengan pesan sukses
		<?php if ($successMessage) : ?>
			Swal.fire({
				title: 'Sukses',
				text: '<?php echo $successMessage; ?>',
				icon: 'success'
			});
		<?php endif; ?>
	</script>


	<form id="ambilForm" action="<?= base_url('penerima/ambilSembako'); ?>" method="post">
		<?php foreach ($warga as $row) : ?>
			<?php if ($row->status_ambil == 0) : ?>
				<?php if ($row->email == $this->session->userdata('email')) : ?>
					<td>
						<input type="hidden" name="id" value="<?= $row->id; ?>">
						<div class="text-center mt-5">
							<button id="ambilButton" onclick="ambilData()" type="button" style="background-color: #FE804D;" class="btn text-white">Ambil Sembako</button>
						</div>
					</td>
				<?php else : ?>
				<?php endif; ?>
			<?php else : ?>
			<?php endif; ?>
		<?php endforeach; ?>
	</form>



	<br>
	<?php
	$tanggal = date('d', strtotime($jadwal->tanggal));
	$bulan = bulan_indonesia(date('n', strtotime($jadwal->tanggal)));
	$tahun = date('Y', strtotime($jadwal->tanggal));
	?>
	<?php if ($jadwal) : ?>

		<h6 class="fw-bolder text-dark">Dimulai Pada : <?= $tanggal . ' ' . $bulan . ' ' . $tahun; ?> Jam <?= substr($jadwal->mulai, 0, 5); ?> </h6>
	<?php endif; ?>
	<div class="container container-fluid w-100">
		<table class="table table-hover text-dark table-responsive text-center">
			<thead class="table-secondary">
				<tr>
					<th scope="col">NIK</th>
					<th scope="col">Nama</th>
					<th scope="col">Kelurahan</th>
					<th scope="col">Kecamatan</th>
					<th scope="col">Kota</th>
					<th scope="col">RT</th>
					<th scope="col">RW</th>
					<th scope="col">Tanggal<br>Lahir</th>
					<th scope="col">No<br>Telepon</th>
					<th scope="col">Kode<br>Wilayah</th>
					<th scope="col">Kode<br>Perwilayah</th>
					<th scope="col">Status<br>Pengambilan</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($warga as $row) :
				?>

					<tr>
						<td><?= $row->nik; ?></td>
						<td><?= $row->nama; ?></td>
						<td><?= $row->kelurahan; ?></td>
						<td><?= $row->kecamatan; ?></td>
						<td><?= $row->kota; ?></td>
						<td><?= $row->rt; ?></td>
						<td><?= $row->rw; ?></td>
						<td><?= $row->ttl; ?></td>
						<td><?= $row->no_telpon; ?></td>
						<td><?= $row->kode_wilayah ?></td>
						<td><?= $row->kode_perwilayah ?></td>
						<td>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" <?php if ($row->status_ambil == 1) echo "checked"; ?> disabled>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
		</table>
	</div>

</div>

<script>
	function checkJamMulai() {
		var jamMulai = "<?= $jadwal->mulai; ?>"; // Jam mulai jadwal
		var tanggalMulai = "<?= $jadwal->tanggal; ?>"; // Tanggal mulai jadwal

		var sekarang = new Date();
		var jamMulaiArray = jamMulai.split(":");
		var jamMulaiDate = new Date(
			sekarang.getFullYear(),
			sekarang.getMonth(),
			sekarang.getDate(),
			jamMulaiArray[0],
			jamMulaiArray[1],
			jamMulaiArray[2]
		);

		var tanggalMulaiArray = tanggalMulai.split("-");
		var tanggalMulaiDate = new Date(
			parseInt(tanggalMulaiArray[0]),
			parseInt(tanggalMulaiArray[1]) - 1,
			parseInt(tanggalMulaiArray[2])
		);

		// Membandingkan tanggal dan waktu sekarang dengan tanggal dan jam mulai
		if (sekarang >= tanggalMulaiDate && sekarang.getTime() >= jamMulaiDate.getTime()) {
			// Aktifkan tombol jika tanggal dan waktu sekarang lebih besar atau sama dengan tanggal dan jam mulai
			document.getElementById("ambilButton").disabled = false;
		} else {
			// Nonaktifkan tombol jika tanggal dan waktu sekarang masih sebelum tanggal dan jam mulai
			document.getElementById("ambilButton").disabled = true;
		}
	}

	function ambilData() {
		Swal.fire({
			title: 'Konfirmasi',
			text: 'Anda mau ambil sembako?',
			icon: 'question',
			showCancelButton: true,
			confirmButtonText: 'Ya',
			cancelButtonText: 'Tidak'
		}).then((result) => {
			if (result.isConfirmed) {
				// Jika pengguna menekan tombol "Ya", kirim form secara manual
				document.getElementById('ambilForm').submit();
			}
		});
	}

	// Memanggil fungsi checkJamMulai saat halaman selesai dimuat
	window.onload = checkJamMulai;
</script>
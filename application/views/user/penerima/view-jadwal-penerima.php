<div class="container mt-5" style="color: #FE804D;">

	<br>

	<div class="text-center">
		<br>
		<h1 class="fw-bolder"><?= $title; ?></h1>
	</div>


	<br>
	<br>
	<?php if (!empty($jadwal)) : ?>
		<div class="row row-cols-1 row-cols-md-3 g-4">
			<?php foreach ($jadwal as $jdl) : ?>
				<?php
				$timezone = new DateTimeZone('Asia/Jakarta');
				$tanggal_selesai = new DateTime($jdl->tanggal . ' ' . $jdl->selesai, $timezone);
				$tanggal_selesai = $tanggal_selesai->format('Y-m-d H:i:s');

				$waktu_sekarang = new DateTime('now', $timezone);
				$waktu_sekarang = $waktu_sekarang->format('Y-m-d H:i:s');

				if ($tanggal_selesai < $waktu_sekarang) {
					continue;
				}
				?>
				<div class="col">
					<div class="card text-center" style="background-color: #FE804D;">
						<img src="https://images.unsplash.com/photo-1679678691001-529c36fdfee5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1169&q=80" class="card-img-top" alt="...">
						<div class="card-body">
							<h5 class="card-title text-white"><?= $jdl->tanggal; ?></h5>
							<h5 class="card-title text-white"><?= $jdl->mulai ?> - <?= $jdl->selesai ?></h5>
							<h5 class="card-title text-white"><?= $jdl->kode_perwilayah ?></h5>
							<div class="text-center">
								<a href="<?= base_url('penerima/lihatDaftarPengambilan/' . $jdl->kode_perwilayah); ?>" class="btn" style="background-color: white; color:#FE804D;">Lihat Pengambilan</a>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	<?php else : ?>
		<div class="row text-center mt-5 p-5">
			<h6 class="text-white">
				<span class="bg-secondary p-2 rounded">Belum ada jadwal yang tersedia untuk Anda</span>
			</h6>
		</div>

	<?php endif; ?>


</div>
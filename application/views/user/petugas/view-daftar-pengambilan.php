<div class="container col-md-10" style="color: #FE804D;">

	<br>

	<div class="text-center mt-5">
		<br>
		<h1 class="fw-bolder"><?= $title; ?></h1>
	</div>

	<br>

	<div class="container justify-content-center">
		<div class="row p-3">
			<div class="col-1 mt-2">
				<?php
				$kode_perwilayah = '';
				foreach ($warga as $row) :
					if ($row->kode_perwilayah != $kode_perwilayah) {
						$kode_perwilayah = $row->kode_perwilayah;
						echo $kode_perwilayah;
					}
				endforeach;
				?>
			</div>
			<div class="row col-4">
				<div class="row justify-content-around">
					<div class="col-1 text-left">
						<form action="<?= base_url(''); ?>" method="post">
							<button type="submit" name="cetak" class="btn btn-primary text-white">Laporan</button>
						</form>
					</div>
					<div class="col-1 text-right">
						<?php foreach ($jadwal as $row) : ?>
							<input type="hidden" name="id" value="<?= $row->id; ?>">
							<div>
								<a type="button" class="btn text-white btn-success btn-delete-jadwal" data-url="<?= base_url('petugas/hapusJadwal'); ?>/<?= $row->id; ?>">Selesai</a>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>


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
					<th scope="col">No. Telepon</th>
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
								<input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" <?php if ($row->status_ambil == 1) echo "checked"; ?> disabled>
								<label class="form-check-label" for="flexCheckChecked">
								</label>
							</div>
						</td>

					</tr>
				<?php endforeach; ?>
		</table>
	</div>

</div>
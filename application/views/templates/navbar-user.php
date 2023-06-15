<?php
$role_id = $users['role_id'];

// Pengkondisian dengan operator ternary
$url = ($role_id == 2) ? base_url('petugas') : base_url('penerima');
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary navbar-dark fixed-top navbar-transparent" style="background-color: #FE804D;">
	<div class="container-fluid">
		<a class="navbar-brand" href="<?= $url ?>">
			<img src="<?= base_url('assets/icon/logo-2.png') ?>" alt="logo-2" width="100px">
		</a>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
			<span class="navbar-dark navbar-toggler-icon"></span>
		</button>

		<div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
			<ul class="navbar-nav ml-auto">
				<?php if ($role_id == 3) : ?>
					<li class="nav-item">
						<a class="nav-link text-white" aria-current="page" href="<?= $url ?>/jadwal">Jadwal Pengambilan</a>
					</li>
				<?php else : ?>
					<a class="nav-link text-white" aria-current="page" href="<?= $url ?>/jadwal">Jadwal Pengambilan</a>
					<a class="nav-link text-white" aria-current="page" href="<?= $url ?>/lihatDataPenerima">Data Penerima</a>
				<?php endif; ?>

				<li class="nav-item dropdown no-arrow">
					<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span class="mr-2 d-none d-lg-inline text-white"><?= $users['username']; ?></span>
						<img class="img-profile rounded-circle" src="<?= base_url('assets/img/undraw_profile.svg') ?>">
					</a>
					<!-- Dropdown - User Information -->
					<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
						<a class="dropdown-item" href="#">
							<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
							Profile
						</a>

						<div class="dropdown-divider"></div>

						<a class="dropdown-item" href="<?= base_url('auth/userLogout') ?>">
							<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
							Logout
						</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
</nav>

<script>
	// Mendeteksi saat halaman di-scroll
	window.addEventListener("scroll", function() {
		var navbar = document.querySelector(".navbar");
		navbar.classList.toggle("navbar-scrolled", window.scrollY > 0);
	});
</script>
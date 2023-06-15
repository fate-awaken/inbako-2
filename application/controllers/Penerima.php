<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penerima extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('ModelJadwal');
		$this->load->model('ModelPenerima');
		$this->load->model('ModelPetugas');

		if (empty($this->session->userdata('email'))) {
			redirect('auth');
		}
	}

	public function index()
	{

		if ($this->session->userdata('email')) {

			$desc['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
		}
		$title['title'] = "Dashboard Penerima";
		$kode_wilayah_petugas = $this->session->userdata('kode_wilayah');
		$data['jadwal'] = $this->ModelJadwal->getJadwal($kode_wilayah_petugas);

		$this->load->view('templates/header', $title);
		$this->load->view('templates/navbar-user.php', $desc);
		$this->load->view('user/penerima/view-dashboard-penerima.php', $data);
		$this->load->view('templates/footer');
	}

	public function jadwal()
	{
		if ($this->session->userdata('email')) {
			$desc['users'] = $this->ModelPenerima->cekData(['email' => $this->session->userdata('email')])->row_array();
		}

		$kode_wilayah = $this->session->userdata('kode_wilayah');
		$kode_perwilayah = $this->ModelPenerima->cekData(['email' => $this->session->userdata('email')])->row_array()['kode_perwilayah']; // tambahkan ini
		$data['jadwal'] = $this->ModelJadwal->getJadwalPerwilayah($kode_wilayah, $kode_perwilayah); // perbarui ini

		$data['title'] = "Jadwal Pengambilan";

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar-user', $desc);
		$this->load->view('user/penerima/view-jadwal-penerima', $data);
		$this->load->view('templates/footer');
	}



	public function lihatDaftarPengambilan($kode_perwilayah)
	{
		if ($this->session->userdata('email')) {
			$desc['users'] = $this->ModelPetugas->cekData(['email' => $this->session->userdata('email')])->row_array();
		}

		$kode_wilayah = $this->session->userdata('kode_wilayah');
		$email = $this->session->userdata('email');

		$data['warga'] = $this->ModelPenerima->get_warga_by_kode_wilayah_perwilayah($kode_wilayah, $kode_perwilayah);

		$title['title'] = "Daftar Pengambilan";

		$data['kode_perwilayah'] = $kode_perwilayah; // Menambahkan data kode_perwilayah ke array $data
		$data['jadwal'] = $this->ModelJadwal->getJadwalByKodePerwilayah($kode_perwilayah, $kode_wilayah);
		$data['tanggal'] = date("Y-m-d", strtotime($data['jadwal']->tanggal));

		// Mendapatkan status ambil penerima berdasarkan email
		$data['status_ambil'] = $this->ModelPenerima->getStatusAmbilByEmail($email);

		$this->load->view('templates/header', $title);
		$this->load->view('templates/navbar-user', $desc);
		$this->load->view('user/penerima/view-daftar-pengambilan-penerima.php', $data);
		$this->load->view('templates/footer');
	}



	public function ambilSembako()
	{
		$email = $this->session->userdata('email');
		$jadwalTerakhir = $this->ModelPenerima->getJadwalTerakhir();

		if ($jadwalTerakhir && date('Y-m-d') > $jadwalTerakhir) {
			$this->ModelPenerima->updateStatusAmbilByEmail($email, 0);
		} else {
			$this->ModelPenerima->updateStatusAmbilByEmail($email, 1);
		}

		// Set session flash data pesan sukses
		$this->session->set_flashdata('success_message', 'Sembako berhasil diambil, semoga bermanfaat 🙏');

		// Redirect ke halaman sebelumnya
		redirect($_SERVER['HTTP_REFERER']);
	}






	// public function ambilSembako()
	// {
	// 	// Ambil email dari pengguna yang sedang login
	// 	$email = $this->session->userdata('email');

	// 	// Cek apakah email pengguna tersedia
	// 	if ($email) {
	// 		// Update status_ambil menjadi 1
	// 		$this->ModelPenerima->updateStatusAmbil($email);

	// 		// Redirect ke halaman penerima
	// 		redirect('penerima');
	// 	}
	// }
}

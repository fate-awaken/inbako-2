<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Petugas extends CI_Controller
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
		require_once(APPPATH . 'libraries/fpdf/fpdf.php');
	}

	public function index()
	{

		if ($this->session->userdata('email')) {

			$desc['users'] = $this->ModelPetugas->cekData(['email' => $this->session->userdata('email')])->row_array();
		}
		$title['title'] = "Dashboard Petugas";

		$this->load->view('templates/header', $title);
		$this->load->view('templates/navbar-user.php', $desc);
		$this->load->view('user/petugas/view-dashboard-petugas.php');
		$this->load->view('templates/footer');
	}


	public function jadwal()
	{
		if ($this->session->userdata('email')) {
			$desc['users'] = $this->ModelPetugas->cekData(['email' => $this->session->userdata('email')])->row_array();
		}

		$kode_wilayah_petugas = $this->session->userdata('kode_wilayah');
		$this->ModelJadwal->deleteExpiredJadwal(); // Menghapus jadwal yang melewati jam selesai

		$data['jadwal'] = $this->ModelJadwal->getJadwal($kode_wilayah_petugas);

		$title['title'] = "Jadwal Pengambilan";

		$this->load->view('templates/header', $title);
		$this->load->view('templates/navbar-user', $desc);
		$this->load->view('user/petugas/view-jadwal-petugas.php', $data);
		$this->load->view('templates/footer');
	}

	public function buatJadwal()
	{
		$this->form_validation->set_rules('kode_wilayah', 'Kode Wilayah', 'required|trim');
		$this->form_validation->set_rules('kode_perwilayah', 'Kode Perwilayah', 'required|trim|callback_check_jadwal');

		if ($this->form_validation->run() == FALSE) {
			$errorMessage = validation_errors();
			echo json_encode(['status' => 'error', 'message' => $errorMessage]);
		} else {
			$kode = $this->input->post('kode_wilayah');
			$kode_perwilayah = $this->input->post('kode_perwilayah');
			$tgl = $this->input->post('tgl');
			$mulai = $this->input->post('mulai');
			$selesai = $this->input->post('selesai');

			$data = [
				'kode_wilayah' => $kode,
				'kode_perwilayah' => $kode_perwilayah,
				'tanggal' => $tgl,
				'mulai' => $mulai,
				'selesai' => $selesai,
			];

			$this->ModelPetugas->insertDataJadwal($data);

			echo json_encode(['status' => 'success']);
		}
	}


	public function check_jadwal($kode_perwilayah)
	{
		$kode_wilayah = $this->input->post('kode_wilayah');

		$exists = $this->ModelPetugas->checkJadwalExists($kode_wilayah, $kode_perwilayah);
		if ($exists) {
			$this->form_validation->set_message('check_jadwal', 'Jadwal sudah ada!');
			return FALSE;
		} else {
			return TRUE;
		}
	}




	public function lihatDataPenerima()
	{
		if ($this->session->userdata('email')) {
			$desc['users'] = $this->ModelPetugas->cekData(['email' => $this->session->userdata('email')])->row_array();
		}

		$kode_wilayah_petugas = $this->session->userdata('kode_wilayah');

		$this->load->model('ModelPenerima');
		$data['warga'] = $this->ModelPenerima->get_warga_by_kode_wilayah_petugas_login($kode_wilayah_petugas);
		$title['title'] = "Data Penduduk";


		$this->load->view('templates/header', $title);
		$this->load->view('templates/navbar-user', $desc);
		$this->load->view('user/petugas/view-data-penduduk.php', $data);
		$this->load->view('templates/footer');
	}


	public function lihatDaftarPengambilan($kode_perwilayah)
	{
		if ($this->session->userdata('email')) {
			$desc['users'] = $this->ModelPetugas->cekData(['email' => $this->session->userdata('email')])->row_array();
		}

		$kode_wilayah = $this->session->userdata('kode_wilayah');

		$data['warga'] = $this->ModelPenerima->get_warga_by_kode_wilayah_perwilayah($kode_wilayah, $kode_perwilayah);
		$data['jadwal'] = $this->ModelJadwal->getJadwalSelesai($kode_wilayah, $kode_perwilayah);

		$title['title'] = "Daftar Pengambilan";

		$this->load->view('templates/header', $title);
		$this->load->view('templates/navbar-user', $desc);
		$this->load->view('user/petugas/view-daftar-pengambilan.php', $data);
		$this->load->view('templates/footer');
	}

	public function hapusJadwal($id)
	{
		// Mengambil data jadwal yang akan dihapus
		$jadwal = $this->ModelJadwal->getDataJadwalById($id);

		// Mengupdate status_ambil menjadi 0 untuk warga dengan kode_wilayah dan kode_perwilayah yang sama dengan jadwal
		$where = array(
			'kode_wilayah' => $jadwal->kode_wilayah,
			'kode_perwilayah' => $jadwal->kode_perwilayah
		);
		$data = array(
			'status_ambil' => 0
		);
		$this->ModelJadwal->updateDataWarga($where, $data, 'warga');

		// Menghapus jadwal
		$this->ModelJadwal->deleteDataJadwal($where, 'jadwal');

		$this->session->set_flashdata('success_message', 'Terimakasih sudah menyalurkan');
		redirect('petugas/jadwal');
	}
}

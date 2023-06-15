<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelPenerima extends CI_Model
{
	public function cekData($where = null)
	{
		return $this->db->get_where('users', $where);
	}


	public function get_warga_by_kode_wilayah_petugas_login($kode_wilayah_petugas)
	{
		$this->db->where('kode_wilayah', $kode_wilayah_petugas);
		$query = $this->db->get('warga');
		return $query->result();
	}

	public function get_warga_by_kode_perwilayah($kode_perwilayah)
	{
		$this->db->select('*');
		$this->db->from('warga');
		$this->db->where('kode_perwilayah', $kode_perwilayah);

		$query = $this->db->get();

		return $query->result();
	}

	public function get_warga_by_kode_wilayah_perwilayah($kode_wilayah, $kode_perwilayah)
	{
		$this->db->select('*');
		$this->db->from('warga');
		$this->db->where('kode_wilayah', $kode_wilayah);
		$this->db->where('kode_perwilayah', $kode_perwilayah);

		$query = $this->db->get();

		return $query->result();
	}

	public function getJadwalTerakhir()
	{
		$this->db->select_max('tanggal');
		$this->db->from('jadwal');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row->tanggal;
		} else {
			return null;
		}
	}

	public function updateStatusAmbilByEmail($email, $status)
	{
		$this->db->where('email', $email);
		$this->db->update('warga', ['status_ambil' => $status]);
	}

	public function getStatusAmbilByEmail($email)
	{
		$this->db->select('status_ambil');
		$this->db->from('warga');
		$this->db->where('email', $email);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row->status_ambil;
		}

		return 0; // Jika tidak ditemukan, mengembalikan nilai default 0
	}

	// Di ModelWarga










	// public function updateStatusAmbil($email)
	// {
	// 	$data = array(
	// 		'status_ambil' => 1
	// 	);

	// 	$this->db->where('email', $email);
	// 	$this->db->update('warga', $data);
	// }
}

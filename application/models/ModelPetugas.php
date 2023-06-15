<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelPetugas extends CI_Model
{
	public function cek_login($email, $password)
	{
		$this->db->where('email', $email);
		$this->db->where('password', md5($password));
		$query = $this->db->get('users');
		if ($query->num_rows() == 1) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function cekData($where = null)
	{
		return $this->db->get_where('users', $where);
	}

	// password_verify($password, $users['password'])

	public function getDataPenduduk()
	{
		$query = $this->db->get('warga');
		return $query->result();
	}

	public function getDataJadwal($kode_wilayah_petugas)
	{
		$this->db->where('kode_wilayah', $kode_wilayah_petugas);
		$query = $this->db->get('jadwal');
		return $query->result();
	}

	public function get_kode_wilayah_by_email($email)
	{
		$this->db->select('kode_wilayah');
		$this->db->from('petugas');
		$this->db->where('email', $email);

		$query = $this->db->get();

		$result = $query->row_array();

		if (!empty($result)) {
			return $result['kode_wilayah'];
		} else {
			return null;
		}
	}

	public function insertDataJadwal($data)
	{
		$this->db->insert('jadwal', $data);
	}

	public function checkJadwalExists($kode_wilayah, $kode_perwilayah)
	{
		$this->db->where('kode_wilayah', $kode_wilayah);
		$this->db->where('kode_perwilayah', $kode_perwilayah);
		$query = $this->db->get('jadwal');

		return $query->num_rows() > 0;
	}
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelJadwal extends CI_Model
{


	public function getJadwal($kode_wilayah_petugas)
	{
		date_default_timezone_set('Asia/Jakarta');

		$this->db->where('kode_wilayah', $kode_wilayah_petugas);
		$waktu_sekarang = date('Y-m-d');

		$this->db->where('tanggal >=', $waktu_sekarang);

		$query = $this->db->get('jadwal');
		return $query->result();
	}

	public function getJadwalPenerima($kode_wilayah_penerima)
	{
		$this->db->where('kode_perwilayah', $kode_wilayah_penerima);

		$query = $this->db->get('jadwal');
		return $query->result();
	}

	public function getPerWilayah($kode_perwilayah)
	{
		$this->db->where('kode_perwilayah', $kode_perwilayah);
		$query = $this->db->get('jadwal');
		return $query->result();
	}

	public function getJadwalPerwilayah($kode_wilayah, $kode_perwilayah)
	{
		date_default_timezone_set('Asia/Jakarta');
		$waktu_sekarang = date('Y-m-d');

		$this->db->where('tanggal >=', $waktu_sekarang);
		$this->db->select('*');
		$this->db->from('jadwal');
		$this->db->where('kode_wilayah', $kode_wilayah);
		$this->db->where('kode_perwilayah', $kode_perwilayah);

		$query = $this->db->get();

		return $query->result();
	}

	public function getPerWilayahPenerima($kode_wilayah, $kode_perwilayah)
	{
		$waktu_sekarang = date('Y-m-d');

		$this->db->where('tanggal >=', $waktu_sekarang);
		$this->db->where('kode_wilayah', $kode_wilayah);
		$this->db->where('kode_perwilayah', $kode_perwilayah);
		$this->db->from('jadwal');
		$query = $this->db->get();
		return $query->result();
	}

	public function getJadwalByKodePerwilayah($kode_perwilayah, $kode_wilayah)
	{
		// Ganti 'nama_tabel_jadwal' dengan nama tabel jadwal yang sesuai
		$this->db->where('kode_perwilayah', $kode_perwilayah);
		$this->db->where('kode_wilayah', $kode_wilayah);
		$query = $this->db->get('jadwal');

		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return null;
		}
	}

	public function getJadwalSelesai($kode_wilayah, $kode_perwilayah)
	{
		$this->db->select('*');
		$this->db->from('jadwal');
		$this->db->where('kode_wilayah', $kode_wilayah);
		$this->db->where('kode_perwilayah', $kode_perwilayah);

		$query = $this->db->get();

		return $query->result();
	}

	public function getDataJadwalById($id)
	{
		// Kode untuk mengambil data jadwal berdasarkan id dari database
		// Misalnya:
		$query = $this->db->get_where('jadwal', array('id' => $id));
		return $query->row();
	}

	public function updateDataWarga($where, $data, $table)
	{
		// Kode untuk mengupdate data warga berdasarkan kriteria tertentu
		// Misalnya:
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	public function deleteDataJadwal($where, $table)
	{
		// Kode untuk menghapus data jadwal berdasarkan kriteria tertentu
		// Misalnya:
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function deleteExpiredJadwal()
	{
		$timezone = new DateTimeZone('Asia/Jakarta');
		$waktu_sekarang = new DateTime('now', $timezone);
		$waktu_sekarang = $waktu_sekarang->format('Y-m-d H:i:s');

		$this->db->where('selesai <', $waktu_sekarang);
		$this->db->delete('jadwal');
	}
}

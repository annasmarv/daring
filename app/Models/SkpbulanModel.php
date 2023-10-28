<?php namespace App\Models;

use CodeIgniter\Model;

class SkpbulanModel extends Model
{
	protected $table = 'tbl_skp_bulan';
	protected $allowedFields = ['skp_id', 'skp_list_id', 'month', 'target', 'realisasi', 'mutu', 'nilai', 'pelaksanaan', 'ketercapaian', 'laporan', 'user_id'];
	protected $useTimestamps = true;

	public function get_skp_by_skp_id($skp_id)
	{
		$this->select('tbl_skp_bulan.id, tbl_skp_bulan.skp_id, tbl_skp_bulan.skp_list_id, tbl_skp_bulan.target, tbl_skp_bulan.realisasi, tbl_skp_bulan.mutu, tbl_skp_bulan.pelaksanaan, tbl_skp_bulan.ketercapaian, tbl_skp_bulan.laporan, tbl_skp_bulan.nilai, tbl_skp_list.kegiatan, tbl_skp_list.output, tbl_skp_list.type, tbl_month.month_name, users.fullname' );
		$this->join('tbl_skp', 'tbl_skp.id = tbl_skp_bulan.skp_id', 'LEFT');
		$this->join('tbl_skp_list', 'tbl_skp_list.id = tbl_skp_bulan.skp_list_id', 'LEFT');
		$this->join('tbl_month', 'tbl_month.id = tbl_skp.month_id', 'LEFT');
		$this->join('users', 'users.id = tbl_skp_bulan.user_id', 'LEFT');
		$this->where(['tbl_skp_bulan.skp_id' => $skp_id, 'tbl_skp_bulan.user_id' => user()->id]);
		$this->orderBy('tbl_skp_list.id', 'ASC');
		$query = $this->get();
		return $query->getResultArray();
	}

	public function count_skp_by_id($id)
	{
		$this->selectCount('tbl_skp_bulan.id');
		$this->join('tbl_skp_list', 'tbl_skp_list.id = tbl_skp_bulan.skp_id', 'LEFT');
		$this->join('users', 'users.id = tbl_skp_bulan.user_id', 'LEFT');
		$this->where(['tbl_skp_bulan.skp_id' => $id, 'tbl_skp_bulan.user_id' => user()->id]);
		$this->orderBy('tbl_skp_list.id', 'ASC');
		return $this->first();
	}
}
?>
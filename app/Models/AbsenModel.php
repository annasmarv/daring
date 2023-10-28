<?php namespace App\Models;

use CodeIgniter\Model;

class AbsenModel extends Model
{
	protected $table = 'tbl_absen';
	protected $allowedFields = ['id', 'XLatitude', 'XLongitude', 'XTime', 'XDate', 'user_id', 'type', 'info', 'note'];

	public function get_absen()
	{
		$user = user()->id;
		$this->select('tbl_absen.id, tbl_absen.XTime, tbl_absen.XDate, tbl_absen.XLongitude, tbl_absen.XLatitude, users.fullname' );
		$this->join('users', 'users.id = tbl_absen.user_id');
		$this->where(['tbl_absen.user_id' => $user, 'tbl_absen.type' => '1']);
		$this->orderBy('id', 'DESC');
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_absen_today()
	{
		$user = user()->id;
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d');

		$this->select('tbl_absen.id, tbl_absen.XDate');
		$this->where(['tbl_absen.user_id' => $user, 'tbl_absen.type' => '1', 'XDate' => $date]);
		return $this->get();
	}
	
}
?>
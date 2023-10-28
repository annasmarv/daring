<?php namespace App\Models\Data;

use CodeIgniter\Model;

class AbsensiModel extends Model
{
	protected $table = 'tbl_absen';
	protected $useTimestamps = true;

	public function get_absen($kelas,$date)
	{
		$this->select('tbl_absen.id as aid, tbl_absen.XLatitude, tbl_absen.XLongitude, tbl_absen.XTime, tbl_absen.XDate, tbl_absen.user_id, tbl_absen.type, tbl_absen.info, tbl_absen.note, users.fullname, users.username, tbl_class_group.class_group_name, tbl_class_group.id as class_id');
		$this->join('users', 'users.id = tbl_absen.user_id');
		$this->join('tbl_student', 'tbl_student.user_id = tbl_absen.user_id');
		$this->join('tbl_class_group', 'tbl_class_group.id = tbl_student.class_group_id');
		$this->where(['tbl_class_group.id' => $kelas, 'tbl_absen.XDate' => $date, 'tbl_absen.type' => 1]);
		$query = $this->get();
		return $query->getResultArray();

	}
}
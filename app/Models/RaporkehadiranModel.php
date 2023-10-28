<?php namespace App\Models;

use CodeIgniter\Model;

class RaporkehadiranModel extends Model
{
	protected $table = 'rapor_kehadiran';
	protected $useTimestamps = true;
	protected $allowedFields = ['nis', 'sakit', 'ijin', 'absen', 'created_by'];

	public function get_kehadiran_rapor()
	{
		$classgroup_id = $_GET['kelas'];
		$this->select('users.fullname, users.username, rapor_kehadiran.*');
		$this->join('users', 'users.username = rapor_kehadiran.nis', 'LEFT');
		$this->join('tbl_student', 'tbl_student.user_id = users.id', 'LEFT');
		$this->where(['tbl_student.class_group_id' => $classgroup_id]);

		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_rapor_kehadiran($nis)
	{
		$this->select('users.fullname, users.username, rapor_kehadiran.*');
		$this->join('users', 'users.username = rapor_kehadiran.nis', 'LEFT');
		$this->join('tbl_student', 'tbl_student.user_id = users.id', 'LEFT');
		$this->where(['users.username' => $nis]);
		$query = $this->get();
		return $query->getResultArray();
	}

	public function save_batch($data){
    	$db      = \Config\Database::connect();
		$builder = $db->table('rapor_kehadiran');
    	               
        $builder->insertBatch($data);
    }
}
?>
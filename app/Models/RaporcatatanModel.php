<?php namespace App\Models;

use CodeIgniter\Model;

class RaporcatatanModel extends Model
{
	protected $table = 'rapor_catatan';
	protected $useTimestamps = true;
	protected $allowedFields = ['nis', 'deskripsi', 'created_by'];

	public function get_catatan_akademik()
	{
		$classgroup_id = $_GET['kelas'];
		$this->select('users.fullname, users.username, rapor_catatan.*');
		$this->join('users', 'users.username = rapor_catatan.nis', 'LEFT');
		$this->join('tbl_student', 'tbl_student.user_id = users.id', 'LEFT');
		$this->where(['tbl_student.class_group_id' => $classgroup_id]);

		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_rapor_catatan_akademik($nis)
	{
		$this->select('users.fullname, users.username, rapor_catatan.*');
		$this->join('users', 'users.username = rapor_catatan.nis', 'LEFT');
		$this->join('tbl_student', 'tbl_student.user_id = users.id', 'LEFT');
		$this->where(['users.username' => $nis]);
		$query = $this->get();
		return $query->getResultArray();
	}

	public function save_batch($data){
    	$db      = \Config\Database::connect();
		$builder = $db->table('rapor_catatan');
    	               
        $builder->insertBatch($data);
    }
}
?>
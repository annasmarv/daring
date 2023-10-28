<?php namespace App\Models;

use CodeIgniter\Model;

class RaporkarakterModel extends Model
{
	protected $table = 'rapor_karakter';
	protected $useTimestamps = true;
	protected $allowedFields = ['nis', 'integritas', 'religius', 'nasionalis', 'mandiri', 'gotong', 'catatan', 'created_by'];

	public function get_perkembangan_karakter()
	{
		$classgroup_id = $_GET['kelas'];
		$this->select('users.fullname, users.username, rapor_karakter.*');
		$this->join('users', 'users.username = rapor_karakter.nis', 'LEFT');
		$this->join('tbl_student', 'tbl_student.user_id = users.id', 'LEFT');
		$this->where(['tbl_student.class_group_id' => $classgroup_id]);

		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_rapor_karakter($nis)
	{
		$this->select('users.fullname, users.username, rapor_karakter.*');
		$this->join('users', 'users.username = rapor_karakter.nis', 'LEFT');
		$this->join('tbl_student', 'tbl_student.user_id = users.id', 'LEFT');
		$this->where(['users.username' => $nis]);
		$query = $this->get();
		return $query->getResultArray();
	}

	public function save_batch($data){
    	$db      = \Config\Database::connect();
		$builder = $db->table('rapor_karakter');
    	               
        $builder->insertBatch($data);
    }
}
?>
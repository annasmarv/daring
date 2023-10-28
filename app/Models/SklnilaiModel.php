<?php namespace App\Models;

use CodeIgniter\Model;

class SklnilaiModel extends Model
{
	protected $table = 'skl_nilai';
	protected $useTimestamps = true;
	protected $allowedFields = ['nis', 'pabp', 'ppkn', 'bindo', 'matk', 'sind', 'bing', 'sbud', 'pjok', 'bjaw', 'skdg', 'pkwu', 'dkli', 'kkli', 'status'];

	public function get_nilai()
	{
		$this->select('skl_nilai.nis, skl_nilai.pabp, users.username, users.fullname, users.id');
		$this->join('users', 'users.username = skl_nilai.nis', 'LEFT');

		$query = $this->get();
		return $query->getResultArray();
	}

	public function save_batch($data){
    	$db      = \Config\Database::connect();
		$builder = $db->table('skl_nilai');
    	               
        $builder->insertBatch($data);
    }

}
?>
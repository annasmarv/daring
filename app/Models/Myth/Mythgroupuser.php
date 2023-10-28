<?php namespace App\Models\Myth;

use CodeIgniter\Model;

class Mythgroupuser extends Model
{
	protected $table = 'auth_groups_users';
	protected $allowedFields = ['group_id', 'user_id'];

	public function get_auth_groups_users()
	{
		$this->select('*');
		$query = $this->get();
		return $query->getResultArray();
	}

	public function save_batch($data){
    	$db      = \Config\Database::connect();
		$builder = $db->table('auth_groups_users');
    	               
        $builder->insertBatch($data);
    }
}
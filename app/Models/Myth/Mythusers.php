<?php namespace App\Models\Myth;

use CodeIgniter\Model;

class Mythusers extends Model
{
	protected $table = 'users';
	protected $useTimestamps = true;
	protected $allowedFields = ['email', 'username', 'fullname', 'user_img', 'password_hash', 'reset_hash', 'reset_at', 'reset_expires', 'activate_hash', 'status', 'status_message', 'active', 'force_pass_reset', 'created_at', 'updated_at', 'deleted_at'];

	public function get_users()
	{
		$this->select('users.*, auth_groups.name as level');
		$this->join('auth_groups_users', 'auth_groups_users.user_id = users.id', 'left');
		$this->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id', 'left');
		$this->orderBy('users.id', 'ASC');
		$query = $this->get();
		return $query->getResultArray();
	}

	public function save_batch($data){
    	$db      = \Config\Database::connect();
		$builder = $db->table('users');
    	               
        $builder->insertBatch($data);
    }
}
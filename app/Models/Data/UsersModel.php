<?php namespace App\Models\Data;

use CodeIgniter\Model;

class UsersModel extends Model
{
	protected $table 		= 'users';
	protected $allowedFields = ['email', 'username', 'fullname', 'password_hash', 'active'];
	protected $useTimestamps = true;

	public function get_username($id)
	{
		$this->select('users.username, candidate.birth_date');
		$this->join('candidate', 'users.id = candidate.user_id');
		return $this->where(['users.id' => $id])->first();
	}
	
}
?>
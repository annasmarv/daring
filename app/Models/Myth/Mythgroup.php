<?php namespace App\Models\Myth;

use CodeIgniter\Model;

class Mythgroup extends Model
{
	protected $table = 'auth_groups';
	protected $allowedFields = ['name', 'description'];

	public function get_auth_groups()
	{
		$this->select('*');
		$query = $this->get();
		return $query->getResultArray();
	}
}
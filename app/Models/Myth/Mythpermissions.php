<?php namespace App\Models\Myth;

use CodeIgniter\Model;

class Mythpermissions extends Model
{
	protected $table = 'auth_permissions';
	protected $allowedFields = ['name', 'description'];

	public function get_auth_permissions()
	{
		$this->select('*');
		$query = $this->get();
		return $query->getResultArray();
	}
}
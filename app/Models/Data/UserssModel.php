<?php namespace App\Models\Data;

use CodeIgniter\Model;

class UserssModel extends Model
{
	protected $table = "ppp";
	protected $useTimestamps = true;

	public function get_student()
	{
		$this->select("ppp.username,ppp.password");
		$query = $this->get();
		return $query->getResultArray();

	}
}
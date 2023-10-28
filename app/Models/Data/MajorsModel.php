<?php namespace App\Models\Data;

use CodeIgniter\Model;

class MajorsModel extends Model
{
	protected $table = 'tbl_majors';
	protected $useTimestamps = true;

	public function get_major()
	{
		$this->select('*');
		$query = $this->get();
		return $query->getResultArray();

	}
}
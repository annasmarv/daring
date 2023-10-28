<?php namespace App\Models\Data;

use CodeIgniter\Model;

class ClasslevelModel extends Model
{
	protected $table = 'tbl_class_level';
	protected $useTimestamps = true;

	public function get_class_level()
	{
		$this->select('*');
		$query = $this->get();
		return $query->getResultArray();

	}
}
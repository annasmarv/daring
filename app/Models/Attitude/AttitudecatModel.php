<?php namespace App\Models\Attitude;

use CodeIgniter\Model;

class AttitudecatModel extends Model
{
	protected $table = 'tbl_attitude_category';
	protected $useTimestamps = true;
	protected $allowedFields = ['type', 'aspect'];

	public function get_attitude_category()
	{
		$this->select('
						tbl_attitude_category.id,
						tbl_attitude_category.type,
						tbl_attitude_category.aspect
						');
		$this->orderBy('tbl_attitude_category.id');
		$query = $this->get();
		return $query->getResultArray();
	}

}
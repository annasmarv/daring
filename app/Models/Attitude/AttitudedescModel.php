<?php namespace App\Models\Attitude;

use CodeIgniter\Model;

class AttitudedescModel extends Model
{
	protected $table = 'tbl_attitude_description';
	protected $useTimestamps = true;
	protected $allowedFields = ['category_id', 'description', 'point'];

	public function get_attitude_description()
	{
		$this->select('
						tbl_attitude_description.id,
						tbl_attitude_description.category_id,
						tbl_attitude_description.description,
						tbl_attitude_description.point,
						tbl_attitude_category.id as idac,
						tbl_attitude_category.type,
						tbl_attitude_category.aspect
						');
		$this->join('tbl_attitude_category', 'tbl_attitude_category.id = tbl_attitude_description.category_id');
		$this->orderBy('tbl_attitude_description.id');
		$query = $this->get();
		return $query->getResultArray();
	}

}
<?php namespace App\Models;

use CodeIgniter\Model;

class MonthModel extends Model
{
	protected $table = 'tbl_month';
	protected $allowedFields = ['month_name', 'weeks_id', 'is_active'];

	public function get_month_learn()
	{
		$user = user()->id;
		$this->select('tbl_month.id, tbl_month.month_name, tbl_month.weeks_id');
		$this->where(['tbl_month.is_active' => 1]);
		$query = $this->get();
		return $query->getResultArray();
	}
	
}
?>
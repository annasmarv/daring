<?php namespace App\Models;

use CodeIgniter\Model;

class PeriodYearModel extends Model
{
	protected $table = 'tbl_period_year';
	protected $allowedFields = ['id', 'start_year', 'end_year', 'oddeven', 'name', 'is_active'];
	protected $useTimestamps = true;

	public function getData()
	{
		$this->select('*');
		return $this->get();
	}

	public function getPeriodActive()
	{
		$this->select('*');
		$this->where('is_active', 1);
		return $this->get();
	}
}
?>
<?php namespace App\Models;

use CodeIgniter\Model;

class TaskTypeModel extends Model
{
	protected $table = 'tbl_task_type';
	protected $allowedFields = ['task_type_name', 'task_type_code', 'end_year', 'oddeven', 'name', 'is_active'];
	protected $useTimestamps = true;

	public function getData()
	{
		$this->select('*');
		return $this->get();
	}
}
?>
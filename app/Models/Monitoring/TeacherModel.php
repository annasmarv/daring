<?php namespace App\Models\Monitoring;

use CodeIgniter\Model;

class TeacherModel extends Model
{
	protected $table = 'tbl_teachers';

	public function get_count()
	{
		$this->selectCount('user_id');
		$query = $this->get();
		return $query->getResultArray();
	}
	
}
?>
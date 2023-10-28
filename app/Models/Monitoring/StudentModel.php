<?php namespace App\Models\Monitoring;

use CodeIgniter\Model;

class StudentModel extends Model
{
	protected $table = 'tbl_student';

	public function get_count()
	{
		$this->selectCount('user_id' );
		$query = $this->get();
		return $query->getResultArray();
	}
	
}
?>
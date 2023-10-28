<?php namespace App\Models\Data;

use CodeIgniter\Model;

class SubjectModel extends Model
{
	protected $table = 'tbl_subjects';
	protected $useTimestamps = true;
	protected $allowedFields = ['subject_code', 'subject_name'];

	public function get_subject($id = false)
	{
		if ($id == false) {
			return $this->findAll();
		}

		return $this->where(['id' => $id])->first();
	}
}
?>
<?php namespace App\Models\Learn;

use CodeIgniter\Model;

class TaskModel extends Model
{
	protected $table = 'mpd_answer';
	protected $useTimestamps = true;
	protected $allowedFields = ['XJawaban', 'XJawabanEssai', 'answer_date'];

	public function get_task($id)
	{
		$this->select('mpd_task.*, tbl_subjects.subject_name');
		// $this->join('tbl_subjects', 'tbl_subjects.id = mpd_modul.subject_id');
		$this->where('mpd_modul.id', $id);
		$query = $this->get();
		return $query->getResultArray();
	}
}
?>
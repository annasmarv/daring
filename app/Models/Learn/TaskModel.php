<?php namespace App\Models\Learn;

use CodeIgniter\Model;

class TaskModel extends Model
{
	protected $table = 'mpd_task';
	protected $useTimestamps = true;
	protected $allowedFields = ['task_name', 'task_type_id', 'class_group_id', 'subject_id', 'quest_bank_id', 'quest_total', 'task_date_start', 'task_date_finish', 'limit_work', 'task_status', 'random', 'teacher_id', 'periodyear'];

	public function get_task($id)
	{
		$this->select('mpd_task.*, tbl_subjects.subject_name');
		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_task.subject_id');
		$this->where('mpd_modul.id', $id);
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_task_teacher()
	{
		$user_id = user()->id;
		$this->select('mpd_task.*, tbl_class_group.class_group_name');
		$this->join('tbl_class_group', 'tbl_class_group.id = mpd_task.class_group_id');
		if (in_groups('teacher') && !in_groups('student')) {
			$this->where('mpd_task.teacher_id', $user_id);
		}
		$this->orderBy('mpd_task.id', 'DESC');
		$this->limit(5);
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_task_teacher_class_subject($postData)
	{
		$user_id = user()->id;
		$this->select('mpd_task.*, tbl_class_group.class_group_name');
		$this->join('tbl_class_group', 'tbl_class_group.id = mpd_task.class_group_id');
		$this->where('mpd_task.teacher_id', $user_id);
		$this->where(['mpd_task.subject_id' => $postData['subject_id'], 'mpd_task.class_group_id' => $postData['classgroup_id']]);
		$this->orderBy('mpd_task.id', 'DESC');
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_task_detail($id)
	{
		$this->select('mpd_task.id as taskid, mpd_task.task_name, mpd_task.subject_id, mpd_task.quest_bank_id, mpd_task.class_group_id, mpd_task.task_date_start, mpd_task.task_date_finish, mpd_task.quest_total, mpd_task.limit_work, mpd_task.task_status, mpd_task.random, mpd_task.created_at, mpd_task.updated_at, tbl_class_group.class_group_name, tbl_subjects.subject_name, users.fullname');
		$this->join('tbl_class_group', 'tbl_class_group.id = mpd_task.class_group_id');
		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_task.subject_id');
		$this->join('users', 'users.id = mpd_task.teacher_id');
		$this->where('mpd_task.id', $id);
		return $this->get();
	}
}
?>
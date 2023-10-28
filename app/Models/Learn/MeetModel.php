<?php namespace App\Models\Learn;

use CodeIgniter\Model;

class MeetModel extends Model
{
	protected $table = 'mpd_meet';
	protected $useTimestamps = true;
	protected $allowedFields = ['meet_name', 'subject_id', 'class_group_id', 'modul_id', 'task_id', 'interaktif_id', 'status', 'teacher_id', 'periodyear'];

	public function get_meet_student($classes,$class_group_id)
	{
		$this->select('mpd_meet.*');
		$this->where('mpd_discuss.teacher_id', $user_id);
	 	$this->orderBy('mpd_discuss.id', 'DESC');
	 	$query = $this->get();
	 	return $query->getResultArray();
	}

	public function get_meet_detail_agenda($id)
	{
		$this->select('mpd_meet.id as meetid, mpd_meet.meet_name, mpd_meet.subject_id, mpd_meet.class_group_id, mpd_discuss.date, mpd_discuss.time_start, mpd_discuss.time_finish, mpd_discuss.status, tbl_class_group.class_group_name, tbl_subjects.subject_name, users.fullname, tbl_teachers.nip');
		$this->join('mpd_discuss', 'mpd_discuss.id = mpd_meet.interaktif_id', 'LEFT');
		$this->join('tbl_class_group', 'tbl_class_group.id = mpd_meet.class_group_id', 'LEFT');
		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_meet.subject_id', 'LEFT');
		$this->join('users', 'users.id = mpd_meet.teacher_id', 'LEFT');
		$this->join('tbl_teachers', 'tbl_teachers.user_id = mpd_meet.teacher_id', 'LEFT');
		$this->where('mpd_meet.id', $id);
		return $this->get();
	}
	// public function get_meet_teacher()
	// {
	// 	$user_id = user()->id;
	// 	$this->select('mpd_discuss.*');
	// 	$this->where('mpd_discuss.teacher_id', $user_id);
	// 	$this->orderBy('mpd_discuss.id', 'DESC');
	// 	$query = $this->get();
	// 	return $query->getResultArray();
	// }

	public function get_meet_detail($id)
	{
		$this->select('mpd_meet.id as meetid, mpd_meet.meet_name, mpd_meet.subject_id, mpd_meet.class_group_id, mpd_meet.modul_id, mpd_meet.task_id, mpd_meet.interaktif_id, mpd_meet.status, tbl_class_group.class_group_name, tbl_subjects.subject_name, users.fullname, , mpd_modul.title as modul, mpd_task.task_name, mpd_discuss.title as interaktive');
		$this->join('mpd_modul', 'mpd_modul.id = mpd_meet.modul_id', 'LEFT');
		$this->join('mpd_task', 'mpd_task.id = mpd_meet.task_id', 'LEFT');
		$this->join('mpd_discuss', 'mpd_discuss.id = mpd_meet.interaktif_id', 'LEFT');
		$this->join('tbl_class_group', 'tbl_class_group.id = mpd_meet.class_group_id');
		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_meet.subject_id');
		$this->join('users', 'users.id = mpd_meet.teacher_id');
		$this->join('tbl_teachers', 'tbl_teachers.user_id = mpd_meet.teacher_id');
		$this->where('mpd_meet.id', $id);
		return $this->get();
	}
}
?>
<?php namespace App\Models\Learn;

use CodeIgniter\Model;

class InteractiveModel extends Model
{
	protected $table = 'mpd_discuss';
	// protected $useTimestamps = true;
	protected $allowedFields = ['title', 'subject_id', 'class_group_id', 'date', 'time_start', 'time_finish', 'status', 'teacher_id'];

	public function get_inter_teacher()
	{
		$user_id = user()->id;
		$this->select('mpd_discuss.*, tbl_class_group.class_group_name');
		$this->join('tbl_class_group', 'tbl_class_group.id = mpd_discuss.class_group_id');
		if (in_groups('teacher') && !in_groups('student')) {
			$this->where('mpd_discuss.teacher_id', $user_id);
		}
		$this->orderBy('mpd_discuss.id', 'DESC');
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_inter_teacher_class_subject($postData)
	{
		$user_id = user()->id;
		$this->select('mpd_discuss.*, tbl_class_group.class_group_name');
		$this->join('tbl_class_group', 'tbl_class_group.id = mpd_discuss.class_group_id');
		$this->where('mpd_discuss.teacher_id', $user_id);
		$this->where(['mpd_discuss.subject_id' => $postData['subject_id'], 'mpd_discuss.class_group_id' => $postData['classgroup_id']]);
		$this->orderBy('mpd_discuss.id', 'DESC');
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_inter_detail($id)
	{
		$this->select('mpd_discuss.id as disid, mpd_discuss.title, mpd_discuss.subject_id, mpd_discuss.class_group_id, mpd_discuss.date, mpd_discuss.time_start, mpd_discuss.time_finish, mpd_discuss.status, tbl_class_group.class_group_name, tbl_subjects.subject_name, users.fullname, tbl_teachers.nip');
		$this->join('tbl_class_group', 'tbl_class_group.id = mpd_discuss.class_group_id');
		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_discuss.subject_id');
		$this->join('users', 'users.id = mpd_discuss.teacher_id');
		$this->join('tbl_teachers', 'tbl_teachers.user_id = mpd_discuss.teacher_id');
		$this->where('mpd_discuss.id', $id);
		return $this->get();
	}
}
?>
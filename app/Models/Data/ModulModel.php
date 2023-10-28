<?php namespace App\Models\Data;

use CodeIgniter\Model;

class ModulModel extends Model
{
	protected $table = 'mpd_modul';
	protected $useTimestamps = true;
	protected $allowedFields = ['subject_id', 'class_group_id', 'title', 'content', 'youtube', 'video', 'cover', 'teacher_id', 'is_active', 'periodyear'];

	public function get_modul($id)
	{
		$this->select('mpd_modul.*, tbl_subjects.subject_name, users.fullname');
		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_modul.subject_id');
		$this->join('users', 'users.id = mpd_modul.teacher_id');
		$this->where('mpd_modul.id', $id);
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_modul_teacher()
	{
		$user_id = user()->id;
		$this->select('mpd_modul.id as mid, mpd_modul.title, tbl_subjects.subject_name, users.fullname');
		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_modul.subject_id');
		$this->join('users', 'users.id = mpd_modul.teacher_id');
		if (in_groups('teacher') && !in_groups('student')) {
			$this->where('mpd_modul.teacher_id', $user_id);
		}
		$this->orderBy('mpd_modul.id', 'DESC');
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_modul_teacher_class_subject($postData)
	{
		$user_id = user()->id;
		$id = '+'.$postData['classgroup_id'].'+';
		$this->select('mpd_modul.id as mid, mpd_modul.title, tbl_subjects.subject_name, users.fullname');
		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_modul.subject_id');
		$this->join('users', 'users.id = mpd_modul.teacher_id');
		$this->where('mpd_modul.teacher_id', $user_id);
		$this->where('mpd_modul.subject_id', $postData['subject_id']);
		$this->like('mpd_modul.class_group_id', $id);
		$this->orderBy('mpd_modul.id', 'DESC');
		$query = $this->get();
		return $query->getResultArray();
	}

}
?>
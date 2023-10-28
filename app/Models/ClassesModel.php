<?php namespace App\Models;

use CodeIgniter\Model;

class ClassesModel extends Model
{
	protected $table = 'mpd_classes';
	// protected $useTimestamps = true;
	// protected $allowedFields = ['subject_id', 'quest_bank_id', 'type', 'number', 'point', 'question', 'audio', 'video', 'answer1', 'answer2', 'answer3', 'answer4', 'answer5', 'quest_keys', 'random', 'teacher_id'];

	public function get_relation_detail($id)
	{
		$this->select('mpd_classes.id, mpd_classes.class_group_id, mpd_classes.subject_id, tbl_class_group.class_group_name, tbl_subjects.subject_name, users.fullname');
		$this->join('tbl_class_group', 'tbl_class_group.id = mpd_classes.class_group_id');
		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_classes.subject_id');
		$this->join('users', 'users.id = mpd_classes.teacher_id');
		return $this->where(['mpd_classes.id' => $id])->first();
	}

	public function get_classes_student($id = false)
	{
		$user = user()->id;
		$this->select('mpd_classes.id, mpd_classes.class_group_id, mpd_classes.subject_id, tbl_class_group.class_group_name, tbl_subjects.subject_name, users.fullname');
		$this->join('tbl_student', 'tbl_student.class_group_id = mpd_classes.class_group_id');
		$this->join('tbl_class_group', 'tbl_class_group.id = mpd_classes.class_group_id');
		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_classes.subject_id');
		$this->join('users', 'users.id = mpd_classes.teacher_id');
		
		if ($id == false) {
			$this->where(['mpd_classes.is_active' => '1', 'tbl_student.user_id' => $user]);
			return $this;
		}

		return $this->where(['mpd_classes.id' => $id,'mpd_classes.is_active' => '1', 'tbl_student.user_id' => $user])->first();
	}

	public function search_student($keyword)
	{
		$user = user()->id;
		$this->select('mpd_classes.id, mpd_classes.class_group_id, mpd_classes.subject_id, tbl_class_group.class_group_name, tbl_subjects.subject_name, users.fullname');
		$this->join('tbl_student', 'tbl_student.class_group_id = mpd_classes.class_group_id');
		$this->join('tbl_class_group', 'tbl_class_group.id = mpd_classes.class_group_id');
		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_classes.subject_id');
		$this->join('users', 'users.id = mpd_classes.teacher_id');
		$this->like('tbl_subjects.subject_name', $keyword);
		$this->orLike('tbl_class_group.class_group_name', $keyword);
		$this->orLike('users.fullname', $keyword);
		$this->where(['mpd_classes.is_active' => '1', 'tbl_student.user_id' => $user]);
		return $this;
	}

	public function search($keyword)
	{
		$user = user()->id;
		$this->select('mpd_classes.id, mpd_classes.class_group_id, mpd_classes.subject_id, tbl_class_group.class_group_name, tbl_subjects.subject_name, users.fullname' );
		$this->join('tbl_class_group', 'tbl_class_group.id = mpd_classes.class_group_id', 'LEFT');
		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_classes.subject_id', 'LEFT');
		$this->join('users', 'users.id = mpd_classes.teacher_id', 'LEFT');
		$this->join('mpd_classes_other_theacher', 'mpd_classes_other_theacher.classes_id = mpd_classes.id', 'LEFT');
		$this->like('tbl_subjects.subject_name', $keyword);
		$this->orLike('tbl_class_group.class_group_name', $keyword);
		$this->orLike('users.fullname', $keyword);
		if (in_groups('teacher')) {
			$this->where(['mpd_classes.teacher_id' => $user]);
			$this->orWhere(['mpd_classes_other_theacher.teacher_id' => $user]);
		}
		return $this;
	}

	public function get_classes_teacher($id = false)
	{
		$user = user()->id;
		$this->select('mpd_classes.id, mpd_classes.class_group_id, mpd_classes.subject_id, tbl_class_group.class_group_name, tbl_subjects.subject_name, users.fullname' );
		$this->join('tbl_class_group', 'tbl_class_group.id = mpd_classes.class_group_id', 'LEFT');
		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_classes.subject_id', 'LEFT');
		$this->join('users', 'users.id = mpd_classes.teacher_id', 'LEFT');
		$this->join('mpd_classes_other_theacher', 'mpd_classes_other_theacher.classes_id = mpd_classes.id', 'LEFT');
		
		if ($id == false) {
			if (in_groups('teacher')) {
				$this->where(['mpd_classes.teacher_id' => $user]);
				$this->orWhere(['mpd_classes_other_theacher.teacher_id' => $user]);
			}
			return $this;
		}

		return $this->where(['mpd_classes.id' => $id, 'mpd_classes.teacher_id' => $user])->first();
	}

	public function get_meet_class($classes,$code)
	{
		$this->select('mpd_classes.id, mpd_classes.class_group_id, tbl_subjects.subject_name, mpd_meet.meet_name, mpd_meet.id as meetid, mpd_meet.modul_id, mpd_meet.task_id, mpd_meet.interaktif_id, mpd_modul.title as modul, mpd_task.task_name as task, mpd_discuss.title as discuss, mpd_modul.is_active, mpd_task.task_status, mpd_discuss.status as inter_status');
		$this->join('mpd_classes_other_theacher', 'mpd_classes_other_theacher.classes_id = mpd_classes.id', 'LEFT');
		$this->join('mpd_meet', '(mpd_meet.subject_id = mpd_classes.subject_id and mpd_meet.teacher_id = mpd_classes.teacher_id or mpd_meet.teacher_id = mpd_classes_other_theacher.teacher_id)', 'LEFT');
		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_meet.subject_id', 'LEFT');
		$this->join('mpd_modul', 'mpd_modul.id = mpd_meet.modul_id', 'LEFT');
		$this->join('mpd_task', 'mpd_task.id = mpd_meet.task_id', 'LEFT');
		$this->join('mpd_discuss', 'mpd_discuss.id = mpd_meet.interaktif_id', 'LEFT');
		$this->join('users', 'users.id = mpd_meet.teacher_id', 'LEFT');
		$this->where(['mpd_classes.id' => $classes, 'mpd_meet.status' => 1, 'mpd_meet.class_group_id' => $code]);
		$this->orderBy('mpd_meet.id', 'DESC');
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_modul_class($classes,$code,$subject)
	{

		$id = '+'.$code.'+';
		$this->select('mpd_classes.id, mpd_classes.class_group_id, tbl_subjects.subject_name, mpd_modul.*,mpd_modul.id as modulid');
		$this->join('mpd_classes_other_theacher', 'mpd_classes_other_theacher.classes_id = mpd_classes.id', 'LEFT');
		$this->join('mpd_modul', '(mpd_modul.subject_id = mpd_classes.subject_id and mpd_modul.teacher_id = mpd_classes.teacher_id or mpd_modul.teacher_id = mpd_classes_other_theacher.teacher_id )');
		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_modul.subject_id');
		$this->join('users', 'users.id = mpd_modul.teacher_id');
		$this->like('mpd_modul.class_group_id', $id);
		$this->where(['mpd_classes.id' => $classes, 'mpd_modul.is_active' => 1, 'mpd_modul.subject_id' => $subject]);
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_task_class($classes,$code)
	{
		$this->select('mpd_classes.id, mpd_classes.class_group_id, tbl_subjects.subject_name, mpd_task.task_name, mpd_task.id as taskid, mpd_task.task_date_start, mpd_task.task_date_finish, mpd_task.task_status');
		$this->join('mpd_classes_other_theacher', 'mpd_classes_other_theacher.classes_id = mpd_classes.id', 'LEFT');
		$this->join('mpd_task', '(mpd_task.subject_id = mpd_classes.subject_id and mpd_task.teacher_id = mpd_classes.teacher_id or mpd_task.teacher_id = mpd_classes_other_theacher.teacher_id  )');
		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_task.subject_id');
		$this->join('users', 'users.id = mpd_task.teacher_id');
		$this->where(['mpd_classes.id' => $classes, 'mpd_task.task_status' => 1, 'mpd_task.class_group_id' => $code]);
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_inter_class($classes,$code)
	{
		$this->select('mpd_classes.id, mpd_classes.class_group_id, tbl_subjects.subject_name, mpd_discuss.title, mpd_discuss.id as did, mpd_discuss.date, mpd_discuss.time_start, mpd_discuss.time_finish');
		$this->join('mpd_classes_other_theacher', 'mpd_classes_other_theacher.classes_id = mpd_classes.id', 'LEFT');
		$this->join('mpd_discuss', '(mpd_discuss.subject_id = mpd_classes.subject_id and mpd_discuss.teacher_id = mpd_classes.teacher_id or mpd_discuss.teacher_id = mpd_classes_other_theacher.teacher_id)');
		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_discuss.subject_id');
		$this->join('users', 'users.id = mpd_discuss.teacher_id');
		$this->where(['mpd_classes.id' => $classes, 'mpd_discuss.status' => 1, 'mpd_discuss.class_group_id' => $code]);
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_modul($id)
	{
		$this->select('mpd_classes.id, tbl_class_group.class_group_name, tbl_subjects.subject_name, users.fullname' );
		$this->join('tbl_class_group', 'tbl_class_group.id = mpd_classes.class_group_id');
		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_classes.subject_id');
		$this->join('users', 'users.id = mpd_classes.teacher_id');

		return $this->where(['mpd_classes.id' => $id,'mpd_classes.is_active' => '1'])->first();
	}

	public function get_subject($id = false)
	{
		if ($id == false) {
			$this->select('mpd_classes.subject_id, tbl_subjects.subject_name' );
			$this->join('tbl_subjects', 'tbl_subjects.id = mpd_classes.subject_id');
			$this->join('users', 'users.id = mpd_classes.teacher_id');
			$this->join('mpd_classes_other_theacher', 'mpd_classes_other_theacher.classes_id = mpd_classes.id', 'LEFT');
			$this->groupBy('mpd_classes.subject_id');
		}else{
			$this->select('mpd_classes.subject_id, tbl_subjects.subject_name' );
			$this->join('tbl_subjects', 'tbl_subjects.id = mpd_classes.subject_id');
			$this->join('users', 'users.id = mpd_classes.teacher_id');
			$this->join('mpd_classes_other_theacher', 'mpd_classes_other_theacher.classes_id = mpd_classes.id', 'LEFT');
			if (in_groups('teacher') && !in_groups('student')) {
				$this->where(['mpd_classes.teacher_id' => $id]);
				$this->orWhere(['mpd_classes_other_theacher.teacher_id' => $id]);
			}
			$this->groupBy('mpd_classes.subject_id');
		}
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_subject_by_classgroup($postData)
	{
		$id = user()->id;
		$this->select('mpd_classes.class_group_id, tbl_subjects.id, tbl_subjects.subject_name' );
		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_classes.subject_id');
		$this->join('users', 'users.id = mpd_classes.teacher_id');
		$this->join('mpd_classes_other_theacher', 'mpd_classes_other_theacher.classes_id = mpd_classes.id', 'LEFT');
		$this->where('mpd_classes.class_group_id', $postData['classgroup_id']);
		if (!in_groups('admin')) {
			$this->where(['mpd_classes.teacher_id' => $id]);
		}
		$this->orWhere(['mpd_classes_other_theacher.teacher_id' => $id]);
		$this->groupBy('mpd_classes.subject_id');
		$query = $this->get();
		return $query->getResult();
	}

	public function get_class_all()
	{
		$this->select('mpd_classes.class_group_id, tbl_class_group.class_group_name' );
		$this->join('tbl_class_group', 'tbl_class_group.id = mpd_classes.class_group_id');
		$this->join('mpd_classes_other_theacher', 'mpd_classes_other_theacher.classes_id = mpd_classes.id', 'LEFT');
		$this->join('users', 'users.id = mpd_classes.teacher_id');
		$this->groupBy('mpd_classes.class_group_id');
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_class($id = false)
	{
		if ($id == false) {
			$this->select('mpd_classes.class_group_id, tbl_class_group.class_group_name' );
			$this->join('tbl_class_group', 'tbl_class_group.id = mpd_classes.class_group_id');
			$this->join('mpd_classes_other_theacher', 'mpd_classes_other_theacher.classes_id = mpd_classes.id', 'LEFT');
			$this->join('users', 'users.id = mpd_classes.teacher_id');
			$this->groupBy('mpd_classes.class_group_id');
		}else{
			$this->select('mpd_classes.id, mpd_classes.class_group_id, tbl_class_group.class_group_name' );
			$this->join('tbl_class_group', 'tbl_class_group.id = mpd_classes.class_group_id');
			$this->join('mpd_classes_other_theacher', 'mpd_classes_other_theacher.classes_id = mpd_classes.id', 'LEFT');
			$this->join('users', 'users.id = mpd_classes.teacher_id');
			if (in_groups('teacher') && !in_groups('student')) {
				$this->where(['mpd_classes.teacher_id' => $id]);
				$this->orWhere(['mpd_classes_other_theacher.teacher_id' => $id]);
			}
			$this->groupBy('mpd_classes.class_group_id');
		}
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_subject_name($id)
	{
		$this->select('tbl_subjects.subject_name' );
		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_classes.subject_id');
		return $this->where(['mpd_classes.id' => $id])->first();
	}

	public function get_class_name($id)
	{
		$this->select('tbl_class_group.class_group_name' );
		$this->join('tbl_class_group', 'tbl_class_group.id = mpd_classes.class_group_id');
		return $this->where(['mpd_classes.id' => $id])->first();
	}
}
?>
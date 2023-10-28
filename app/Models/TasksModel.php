<?php namespace App\Models;

use CodeIgniter\Model;

class TasksModel extends Model
{
	protected $table = 'mpd_task';
	protected $useTimestamps = true;
	// protected $allowedFields = ['subject_id', 'quest_bank_id', 'type', 'number', 'point', 'question', 'audio', 'video', 'answer1', 'answer2', 'answer3', 'answer4', 'answer5', 'quest_keys', 'random', 'teacher_id'];

	public function get_tasks($id = false)
	{
		$user = user()->id;
		$this->select('mpd_task.id ,mpd_task.task_name, mpd_task.task_date_start, mpd_task.task_date_finish, tbl_subjects.subject_name');		
		$this->join('tbl_student', 'tbl_student.class_group_id = mpd_task.class_group_id ');
		$this->join('tbl_class_group', 'tbl_class_group.id = mpd_task.class_group_id');
		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_task.subject_id');
		$this->where(['mpd_task.task_status' => '1',  'tbl_student.user_id' => $user]);
		$this->orderBy('mpd_task.task_date_start', 'DESC');
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_tasks_null()
	{
		$user = user()->id;
		$this->select('mpd_task.id ,mpd_task.task_name, mpd_task.task_date_start, mpd_task.task_date_finish, tbl_subjects.subject_name, mpd_join_task.status as jtstatus');		
		$this->join('tbl_student', 'tbl_student.class_group_id = mpd_task.class_group_id ');
		$this->join('tbl_class_group', 'tbl_class_group.id = mpd_task.class_group_id');
		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_task.subject_id');
		$this->join('mpd_join_task', 'mpd_task.id = mpd_join_task.task_id', 'LEFT');
		$this->where(['mpd_task.task_status' => '1',  'tbl_student.user_id' => $user]);
		$this->where(['mpd_join_task.status' => '0']);
		$this->orderBy('mpd_task.task_date_start', 'DESC');
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_tasks_start()
	{
		$user = user()->id;
		$this->select('mpd_task.id ,mpd_task.task_name, mpd_task.task_date_start, mpd_task.task_date_finish, tbl_subjects.subject_name, mpd_join_task.status as jtstatus');		
		$this->join('tbl_student', 'tbl_student.class_group_id = mpd_task.class_group_id ');
		$this->join('tbl_class_group', 'tbl_class_group.id = mpd_task.class_group_id');
		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_task.subject_id');
		$this->join('mpd_join_task', 'mpd_task.id = mpd_join_task.task_id', 'LEFT');
		$this->where(['mpd_task.task_status' => '1',  'tbl_student.user_id' => $user, 'mpd_join_task.user_id' => $user, 'mpd_join_task.status' => 1]);
		$this->orderBy('mpd_task.task_date_start', 'DESC');
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_tasks_finish()
	{
		$user = user()->id;
		$this->select('mpd_task.id ,mpd_task.task_name, mpd_task.task_date_start, mpd_task.task_date_finish, tbl_subjects.subject_name, mpd_join_task.status as jtstatus');		
		$this->join('tbl_student', 'tbl_student.class_group_id = mpd_task.class_group_id ');
		$this->join('tbl_class_group', 'tbl_class_group.id = mpd_task.class_group_id');
		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_task.subject_id');
		$this->join('mpd_join_task', 'mpd_task.id = mpd_join_task.task_id', 'LEFT');
		$this->where(['mpd_task.task_status' => '1',  'tbl_student.user_id' => $user, 'mpd_join_task.user_id' => $user, 'mpd_join_task.status' => 9]);
		$this->orderBy('mpd_task.task_date_start', 'DESC');
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_tasks_detail($id)
	{
		$this->select('mpd_task.id, mpd_task.task_name, mpd_task.task_date_start, mpd_task.task_date_finish, mpd_task.limit_work, mpd_task.task_status, tbl_subjects.subject_name, tbl_class_group.class_group_name, mpd_task.quest_bank_id, mpd_task.quest_total');
		$this->join('tbl_class_group', 'tbl_class_group.id = mpd_task.class_group_id');
		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_task.subject_id');
		
		return $this->where(['mpd_task.id' => $id])->first();
	}

	public function get_by_kolom_limit($kolom, $isi, $limit){
        $this->select('*')
        		->where([$kolom => $isi])
				->limit($limit);
        return $this->get();
    }
}
?>
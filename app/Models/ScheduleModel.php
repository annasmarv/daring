<?php namespace App\Models;

use CodeIgniter\Model;

class ScheduleModel extends Model
{
	protected $table = 'tbl_schedule';
	protected $useTimestamps = true;
	protected $allowedFields = ['relation_id', 'day', 'week', 'time_start', 'time_finish', 'time_of', 'jp', 'room', 'teacher_id', 'periodyear'];

	public function get_schedule_day_class($Day,$class_id,$Week)
	{
		$this->select('tbl_schedule.id as scheduleid, tbl_schedule.relation_id, tbl_schedule.day, tbl_schedule.time_start, tbl_schedule.time_finish, tbl_schedule.time_of, tbl_schedule.jp, tbl_schedule.room, tbl_schedule.week, tbl_class_group.class_group_name, tbl_subjects.subject_name, users.fullname');
		$this->join('mpd_classes', 'mpd_classes.id = tbl_schedule.relation_id');
		$this->join('tbl_class_group', 'tbl_class_group.id = mpd_classes.class_group_id');
		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_classes.subject_id');
		$this->join('users', 'users.id = mpd_classes.teacher_id');
		$this->where(['tbl_schedule.day' => $Day, 'tbl_schedule.week' => $Week, 'tbl_class_group.id' => $class_id]);

		$this->orderBy('tbl_schedule.time_of ASC');
		$query = $this->get();
		return $query->getResultArray();
	}


	public function get_schedule_day_teacher($Day,$user_id,$Week)
	{
		$this->select('tbl_schedule.id as scheduleid, tbl_schedule.relation_id, tbl_schedule.day, tbl_schedule.time_start, tbl_schedule.time_finish, tbl_schedule.time_of, tbl_schedule.jp, tbl_schedule.room, tbl_class_group.class_group_name, tbl_subjects.subject_name, users.fullname');
		$this->join('mpd_classes', 'mpd_classes.id = tbl_schedule.relation_id');
		$this->join('tbl_class_group', 'tbl_class_group.id = mpd_classes.class_group_id');
		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_classes.subject_id');
		$this->join('users', 'users.id = mpd_classes.teacher_id');
		$this->where(['tbl_schedule.day' => $Day, 'tbl_schedule.week' => $Week, 'users.id' => $user_id]);

		$this->orderBy('tbl_schedule.time_of ASC');
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_schedule_thisday_teacher()
	{
		$user_id = user()->id;
		$Day = date('D');

		$this->select('tbl_schedule.id as scheduleid, tbl_schedule.relation_id, tbl_schedule.day, tbl_schedule.time_start, tbl_schedule.time_finish, tbl_schedule.time_of, tbl_class_group.class_group_name, tbl_subjects.subject_name, users.fullname');
		$this->join('mpd_classes', 'mpd_classes.id = tbl_schedule.relation_id');
		$this->join('tbl_class_group', 'tbl_class_group.id = mpd_classes.class_group_id');
		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_classes.subject_id');
		$this->join('users', 'users.id = mpd_classes.teacher_id');
		$this->where(['tbl_schedule.day' => $Day, 'users.id' => $user_id]);

		$this->orderBy('tbl_schedule.time_of ASC');
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_schedule_thisday_teacher_week($Week)
	{
		$user_id = user()->id;
		$Day = date('D');

		$this->select('tbl_schedule.id as scheduleid, tbl_schedule.relation_id, tbl_schedule.day, tbl_schedule.time_start, tbl_schedule.time_finish, tbl_schedule.time_of, tbl_class_group.class_group_name, tbl_subjects.subject_name, users.fullname');
		$this->join('mpd_classes', 'mpd_classes.id = tbl_schedule.relation_id');
		$this->join('tbl_class_group', 'tbl_class_group.id = mpd_classes.class_group_id');
		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_classes.subject_id');
		$this->join('users', 'users.id = mpd_classes.teacher_id');
		$this->where(['tbl_schedule.day' => $Day, 'tbl_schedule.week' => $Week, 'users.id' => $user_id]);

		$this->orderBy('tbl_schedule.time_of ASC');
		$query = $this->get();
		return $query->getResultArray();
	}

		public function get_schedule_class()
	{
		$user = user()->id;
		$this->select('tbl_schedule.id as sid ,tbl_schedule.time_start, tbl_schedule.time_finish, tbl_subjects.subject_name, users.fullname, mpd_classes.id as cid, mpd_classes.class_group_id');
		$this->join('mpd_classes', 'mpd_classes.id = tbl_schedule.relation_id');
		$this->join('tbl_student', 'tbl_student.class_group_id = mpd_classes.class_group_id ');
		$this->join('tbl_class_group', 'tbl_class_group.id = mpd_classes.class_group_id');
		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_classes.subject_id');
		$this->join('users', 'users.id = mpd_classes.teacher_id');
		
		$this->where(['mpd_classes.is_active' => '1', 'tbl_student.user_id' => $user]);
		$query = $this->get();
		return $query->getResultArray();
	}

	public function count_schedule_by_week($week)
    {
        $this->selectCount('tbl_schedule.id');
        $this->join('mpd_classes', 'tbl_schedule.relation_id = mpd_classes.id', 'LEFT');
        $this->where(['tbl_schedule.week' => $week, 'mpd_classes.teacher_id' => user()->id]);
        $query = $this->first();
        return $query;
    }

}


// use CodeIgniter\Model;

// class ScheduleModel extends Model
// {
// 	protected $table = 'tbl_schedule';
// 	protected $useTimestamps = true;
// 	// protected $allowedFields = ['subject_id', 'quest_bank_id', 'type', 'number', 'point', 'question', 'audio', 'video', 'answer1', 'answer2', 'answer3', 'answer4', 'answer5', 'quest_keys', 'random', 'teacher_id'];

// 	public function get_schedule_class()
// 	{
// 		$user = user()->id;
// 		$this->select('tbl_schedule.id as sid ,tbl_schedule.time_start, tbl_schedule.time_finish, tbl_subjects.subject_name, users.fullname, mpd_classes.id as cid, mpd_classes.class_group_id');
// 		$this->join('mpd_classes', 'mpd_classes.id = tbl_schedule.classes_id');
// 		$this->join('tbl_student', 'tbl_student.class_group_id = mpd_classes.class_group_id ');
// 		$this->join('tbl_class_group', 'tbl_class_group.id = mpd_classes.class_group_id');
// 		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_classes.subject_id');
// 		$this->join('users', 'users.id = mpd_classes.teacher_id');
		
// 		$this->where(['mpd_classes.is_active' => '1', 'tbl_student.user_id' => $user]);
// 		$query = $this->get();
// 		return $query->getResultArray();
// 	}

// 	public function get_tasks_detail($id)
// 	{
// 		$this->select('tbl_schedule.id ,tbl_schedule.task_name, tbl_schedule.task_date_start, tbl_schedule.task_date_finish, tbl_subjects.subject_name, tbl_class_group.class_group_name');
// 		$this->join('tbl_class_group', 'tbl_class_group.id = tbl_schedule.class_group_id');
// 		$this->join('tbl_subjects', 'tbl_subjects.id = tbl_schedule.subject_id');
		
// 		return $this->where(['tbl_schedule.id' => $id,'tbl_schedule.task_status' => '1'])->first();
// 	}

// }
?>
<?php namespace App\Models\Learn;

use CodeIgniter\Model;

class PlanModel extends Model
{
	protected $table = 'tbl_learn_plan';
	protected $allowedFields = ['week_id', 'subject_id', 'class_group_id', 'title', 'alokasi_jp', 'goal', 'activity', 'asesmen', 'percent', 'teacher_id'];
	protected $useTimestamps = true;

	public function get_learn_plan($id)
	{	
		$this->select('tbl_learn_plan.id, tbl_learn_plan.week_id, tbl_learn_plan.subject_id, tbl_learn_plan.class_group_id, tbl_learn_plan.title, tbl_learn_plan.alokasi_jp, tbl_learn_plan.goal, tbl_learn_plan.activity, tbl_learn_plan.asesmen, tbl_learn_plan.teacher_id, tbl_learn_plan.created_at, tbl_learn_plan.updated_at, tbl_subjects.subject_name, users.fullname');
		$this->join('tbl_subjects', 'tbl_subjects.id = tbl_learn_plan.subject_id');
		$this->join('users', 'users.id = tbl_learn_plan.teacher_id');
		$this->where(['tbl_learn_plan.id' => $id]);
		return $this->first();
	}

	public function count_for_skp($month)
	{	
		$user = user()->id;
		$this->selectCount('id');
		$this->where(['tbl_learn_plan.teacher_id' => $user]);
		$this->whereIN('week_id', $month);
		return $this->first();
	}
	
}
?>
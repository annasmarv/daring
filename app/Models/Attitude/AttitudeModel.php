<?php namespace App\Models\Attitude;

use CodeIgniter\Model;

class AttitudeModel extends Model
{
	protected $table = 'tbl_attitude';
	protected $useTimestamps = true;
	protected $allowedFields = ['attdesc_id', 'user_id', 'poin', 'teacher_id', 'periodyear'];

	public function get_attitude()
	{
		$this->select('
						tbl_attitude.id,
						tbl_attitude.attdesc_id,
						tbl_attitude.user_id,
						tbl_attitude.poin,
						tbl_attitude.teacher_id,
						tbl_attitude_description.category_id,
						tbl_attitude_description.description,
						tbl_attitude_description.point,
						tbl_attitude_category.id as idac,
						tbl_attitude_category.type,
						tbl_attitude_category.aspect,
						tbl_attitude.periodyear,
						users.fullname,
						u.fullname as teacher_name,
						u.fullname as teacher_name,
						tbl_class_group.class_group_name
						');
		$this->join('tbl_attitude_description', 'tbl_attitude.attdesc_id = tbl_attitude_description.id');
		$this->join('tbl_attitude_category', 'tbl_attitude_category.id = tbl_attitude_description.category_id');
		$this->join('users', 'users.id = tbl_attitude.user_id');
		$this->join('users u', 'u.id = tbl_attitude.teacher_id', 'LEFT');
		$this->join('tbl_student', 'tbl_student.user_id = users.id');
		$this->join('tbl_class_group', 'tbl_student.class_group_id = tbl_class_group.id');

		if (!has_permission('kesiswaan') && in_groups('teacher')) {
			$this->where('tbl_attitude.teacher_id', user()->id);
		}
		$this->orderBy('tbl_attitude.id', 'DESC');
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_attitude_list()
	{
		$this->select('
						tbl_attitude.id,
						tbl_attitude.attdesc_id,
						tbl_attitude.user_id,
						tbl_attitude.poin,
						tbl_attitude.teacher_id,
						tbl_attitude_description.category_id,
						tbl_attitude_description.description,
						tbl_attitude_description.point,
						tbl_attitude_category.id as idac,
						tbl_attitude_category.type,
						tbl_attitude_category.aspect,
						tbl_attitude.periodyear
						');
		$this->join('tbl_attitude_description', 'tbl_attitude.attdesc_id = tbl_attitude_description.id');
		$this->join('tbl_attitude_category', 'tbl_attitude_category.id = tbl_attitude_description.category_id');
		$this->orderBy('tbl_attitude.id', 'DESC');
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_attitude_student()
	{
		$this->select('
						tbl_attitude.id,
						tbl_attitude.attdesc_id,
						tbl_attitude.user_id,
						tbl_attitude.periodyear,
						users.fullname,
						tbl_class_group.class_group_name
						');
		$this->selectSum('tbl_attitude.poin', 'total_poin');
		$this->join('users', 'users.id = tbl_attitude.user_id');
		$this->join('tbl_student', 'tbl_student.user_id = users.id');
		$this->join('tbl_class_group', 'tbl_student.class_group_id = tbl_class_group.id');
		$this->groupBy('tbl_attitude.user_id');
		$this->where('tbl_attitude.periodyear', period()->id);
		$this->orderBy('total_poin', 'ASC');
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_sum_point_student($user_id)
	{
		$this->select('
			tbl_attitude.id,
			tbl_attitude.attdesc_id,
			tbl_attitude.user_id,
			tbl_attitude.periodyear,
			users.fullname,
			tbl_class_group.class_group_name
		');
		$this->selectSum('tbl_attitude.poin', 'total_poin');
		$this->join('users', 'users.id = tbl_attitude.user_id');
		$this->join('tbl_student', 'tbl_student.user_id = users.id');
		$this->join('tbl_class_group', 'tbl_student.class_group_id = tbl_class_group.id');
		$this->groupBy('tbl_attitude.user_id');
		$this->where(['tbl_attitude.user_id' => $user_id, 'tbl_attitude.periodyear' => period()->id]);
		$this->orderBy('total_poin', 'ASC');
		return $this->first();
	}

	public function get_attitude_student_history($user_id)
	{
		$this->select('
						tbl_attitude.id,
						tbl_attitude.attdesc_id,
						tbl_attitude.user_id,
						tbl_attitude.poin,
						tbl_attitude.teacher_id,
						tbl_attitude_description.category_id,
						tbl_attitude_description.description,
						tbl_attitude_description.point,
						tbl_attitude_category.id as idac,
						tbl_attitude_category.type,
						tbl_attitude_category.aspect,
						tbl_attitude.periodyear,
						tbl_attitude.created_at,
						users.fullname,
						u.fullname as teacher_name,
						u.fullname as teacher_name,
						tbl_class_group.class_group_name
						');
		$this->join('tbl_attitude_description', 'tbl_attitude.attdesc_id = tbl_attitude_description.id');
		$this->join('tbl_attitude_category', 'tbl_attitude_category.id = tbl_attitude_description.category_id');
		$this->join('users', 'users.id = tbl_attitude.user_id');
		$this->join('users u', 'u.id = tbl_attitude.teacher_id', 'LEFT');
		$this->join('tbl_student', 'tbl_student.user_id = users.id');
		$this->join('tbl_class_group', 'tbl_student.class_group_id = tbl_class_group.id');
		$this->where(['tbl_attitude.user_id' => $user_id, 'tbl_attitude.periodyear' => period()->id]);
		$query = $this->get();
		return $query->getResultArray();
	}

}
<?php namespace App\Models\Data;

use CodeIgniter\Model;

class ClassgroupModel extends Model
{
	protected $table = 'tbl_class_group';
	protected $useTimestamps = true;
	protected $allowedFields = ['class_level_id', 'majors_id', 'class_group_name', 'teacher_id', 'is_active'];

	public function get_classgroup()
	{
		$this->select('
						tbl_class_group.id,
						tbl_class_group.majors_id,
						tbl_class_group.class_level_id,
						tbl_class_group.class_group_name,
						tbl_class_group.teacher_id,
						tbl_majors.major_name,
						tbl_class_level.class_level,
						users.fullname
						');
		$this->join('tbl_majors', 'tbl_majors.id = tbl_class_group.majors_id');
		$this->join('tbl_class_level', 'tbl_class_level.id = tbl_class_group.class_level_id');
		$this->join('users', 'users.id = tbl_class_group.teacher_id', 'left');
		$this->orderBy('tbl_class_group.id');
		$query = $this->get();
		return $query->getResultArray();
	}

	public function classgroup()
	{
		$this->select('id,class_group_name');
		$query = $this->get();
		return $query->getResultArray();
	}

}
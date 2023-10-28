<?php namespace App\Models\Data;

use CodeIgniter\Model;

class RelationModel extends Model
{
	protected $table = 'mpd_classes';
	protected $useTimestamps = true;
	protected $allowedFields = ['class_group_id', 'subject_id', 'teacher_id', 'is_active', 'periodyear'];

	public function get_relation($class_id)
	{
		if ($class_id==false) {
			$this->select('mpd_classes.*, tbl_class_group.class_group_name, tbl_subjects.subject_name, users.fullname');
			$this->join('tbl_class_group', 'tbl_class_group.id = mpd_classes.class_group_id');
			$this->join('tbl_subjects', 'tbl_subjects.id = mpd_classes.subject_id');
			$this->join('users', 'users.id = mpd_classes.teacher_id');
		}else{
			$this->select('mpd_classes.*, tbl_class_group.class_group_name, tbl_subjects.subject_name, users.fullname');
			$this->join('tbl_class_group', 'tbl_class_group.id = mpd_classes.class_group_id');
			$this->join('tbl_subjects', 'tbl_subjects.id = mpd_classes.subject_id');
			$this->join('users', 'users.id = mpd_classes.teacher_id');
			$this->where(['tbl_class_group.id' => $class_id]);
		}
		
		$this->orderBy('mpd_classes.teacher_id ASC', 'mpd_classes.class_group_id ASC', 'mpd_classes.subject_id ASC');
		$query = $this->get();
		return $query->getResultArray();
	}

	// public function get_relation_detail($rel_id)
	// {
	// 	$this->select('*');
	// 	$this->where('tbl_relation.id', $rel_id);
	// 	return $this->first();
	// }

	// public function get_relation_user()
	// {

	// 	$this->select('tbl_relation.*, tbl_class_group.class_group_name, tbl_subjects.subject_name, users.fullname');
	// 	$this->join('tbl_class_group', 'tbl_class_group.id = tbl_relation.class_group_id');
	// 	$this->join('tbl_subjects', 'tbl_subjects.id = tbl_relation.subject_id');
	// 	$this->join('users', 'users.id = tbl_relation.teacher_id');
	// 	if (in_groups('teacher')) {
	// 		$this->where(['tbl_relation.teacher_id' => user()->id]);
	// 	}

	// 	$this->orderBy('tbl_relation.id ASC','tbl_relation.teacher_id ASC', 'tbl_relation.class_group_id ASC', 'tbl_relation.subject_id ASC');
	// 	$query = $this->get();
	// 	return $query->getResultArray();
	// }

	// public function get_class($id = false)
	// {
	// 	if ($id == false) {
	// 		$this->select('tbl_relation.class_group_id, tbl_class_group.class_group_name' );
	// 		$this->join('tbl_class_group', 'tbl_class_group.id = tbl_relation.class_group_id');
	// 		$this->join('users', 'users.id = tbl_relation.teacher_id');
	// 		$this->groupBy('tbl_relation.class_group_id');
	// 	}else{
	// 		$this->select('tbl_relation.class_group_id, tbl_class_group.class_group_name' );
	// 		$this->join('tbl_class_group', 'tbl_class_group.id = tbl_relation.class_group_id');
	// 		$this->join('users', 'users.id = tbl_relation.teacher_id');
	// 		if (in_groups('teacher') && !in_groups('student')) {
	// 			$this->where(['tbl_relation.teacher_id' => $id]);
	// 		}
	// 		$this->groupBy('tbl_relation.class_group_id');
	// 	}
	// 	$query = $this->get();
	// 	return $query->getResultArray();
	// }

	// public function get_subject($id = false)
	// {
	// 	if ($id == false) {
	// 		$this->select('tbl_relation.subject_id, tbl_subjects.subject_name' );
	// 		$this->join('tbl_subjects', 'tbl_subjects.id = tbl_relation.subject_id');
	// 		$this->join('users', 'users.id = tbl_relation.teacher_id');
	// 		$this->groupBy('tbl_relation.subject_id');
	// 	}else{
	// 		$this->select('tbl_relation.subject_id, tbl_subjects.subject_name' );
	// 		$this->join('tbl_subjects', 'tbl_subjects.id = tbl_relation.subject_id');
	// 		$this->join('users', 'users.id = tbl_relation.teacher_id');
	// 		if (in_groups('teacher') && !in_groups('student')) {
	// 			$this->where(['tbl_relation.teacher_id' => $id]);
	// 		}
	// 		$this->groupBy('tbl_relation.subject_id');
	// 	}
	// 	$query = $this->get();
	// 	return $query->getResultArray();
	// }

}
?>
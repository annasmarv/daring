<?php namespace App\Models\Data;

use CodeIgniter\Model;

class RelationTeamModel extends Model
{
	protected $table = 'mpd_classes_other_theacher';
	protected $useTimestamps = true;
	protected $allowedFields = ['classes_id', 'teacher_id', 'created_by'];

	public function get_relation_team($classes_id)
	{
		$this->select('mpd_classes_other_theacher.*, tbl_class_group.class_group_name, tbl_subjects.subject_name, users.fullname, users.user_img');
		$this->join('mpd_classes', 'mpd_classes.id = mpd_classes_other_theacher.classes_id');
		$this->join('tbl_class_group', 'tbl_class_group.id = mpd_classes.class_group_id');
		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_classes.subject_id');
		$this->join('users', 'users.id = mpd_classes_other_theacher.teacher_id');
		$this->orderBy('mpd_classes.teacher_id ASC', 'mpd_classes.class_group_id ASC', 'mpd_classes.subject_id ASC');
		$this->where('mpd_classes_other_theacher.classes_id', $classes_id);
		$query = $this->get();
		return $query->getResultArray();
	}

}
?>
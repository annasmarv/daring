<?php namespace App\Models\Cbt;

use CodeIgniter\Model;

class UjianModel extends Model
{
	protected $table = 'cbt_ujian';
	protected $useTimestamps = true;
	protected $allowedFields = ['task_name', 'task_type_id', 'class_group_id', 'subject_id', 'quest_bank_id', 'quest_total', 'task_date_start', 'time_start', 'time_finish', 'time_limit', 'status', 'random', 'token', 'teacher_id', 'periodyear'];

	public function get_ujian()
	{
		$user_id = user()->id;
		$this->select('cbt_ujian.*, tbl_subjects.subject_name');
		$this->join('tbl_student', 'cbt_ujian.class_group_id = tbl_student.class_group_id');
		$this->join('tbl_subjects', 'tbl_subjects.id = cbt_ujian.subject_id');
			$this->where(['cbt_ujian.status' => '1', 'tbl_student.user_id' => $user_id]);
			$query = $this->get();
			return $query->getResultArray();
	}

	public function get_ujian_detail($id)
	{
		$this->select('cbt_ujian.id as ujianid, cbt_ujian.task_name, cbt_ujian.subject_id, cbt_ujian.quest_bank_id, cbt_ujian.class_group_id, cbt_ujian.task_date_start, cbt_ujian.time_start, cbt_ujian.time_finish, cbt_ujian.quest_total, cbt_ujian.status, cbt_ujian.random, cbt_ujian.token, cbt_ujian.created_at, cbt_ujian.updated_at, tbl_class_group.class_group_name, tbl_subjects.subject_name, users.fullname');
		$this->join('tbl_class_group', 'tbl_class_group.id = cbt_ujian.class_group_id');
		$this->join('tbl_subjects', 'tbl_subjects.id = cbt_ujian.subject_id');
		$this->join('users', 'users.id = cbt_ujian.teacher_id');
		$this->where('cbt_ujian.id', $id);
		return $this->get();
	}

	public function get_by_kolom_limit($kolom, $isi, $limit){
        $this->select('*')
        		->where([$kolom => $isi])
				->limit($limit);
        return $this->get();
    }
}
?>
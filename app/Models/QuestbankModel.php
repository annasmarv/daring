<?php namespace App\Models;

use CodeIgniter\Model;

class QuestbankModel extends Model
{
	protected $table = 'tbl_quest_bank';
	protected $useTimestamps = true;
	protected $allowedFields = ['subject_id', 'quest_code', 'quest_option', 'teacher_id', 'is_active', 'periodyear'];

	public function get_quest_bank($id = false)
	{
		if ($id == false) {
			$this->select('tbl_quest_bank.*, tbl_quest_bank.id as bankid, tbl_subjects.subject_name, users.fullname');
			$this->join('tbl_subjects', 'tbl_subjects.id = tbl_quest_bank.subject_id');
			$this->join('users', 'users.id = tbl_quest_bank.teacher_id');
			if (in_array('teacher', user()->roles)) {
				$this->where('tbl_quest_bank.teacher_id', user()->id);
			}
		}else{
			$this->select('tbl_quest_bank.*, tbl_quest_bank.id as bankid, tbl_subjects.subject_name, users.fullname');
			$this->join('tbl_subjects', 'tbl_subjects.id = tbl_quest_bank.subject_id');
			$this->join('users', 'users.id = tbl_quest_bank.teacher_id');
			$this->where('tbl_quest_bank.id', $id);
		}
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_quest_bank_by_subject($subject_id)
	{
		$this->select('tbl_quest_bank.*, tbl_quest_bank.id as bankid, tbl_subjects.subject_name, users.fullname');
		$this->join('tbl_subjects', 'tbl_subjects.id = tbl_quest_bank.subject_id');
		$this->join('users', 'users.id = tbl_quest_bank.teacher_id');
		$this->where('tbl_quest_bank.subject_id', $subject_id);
		$this->where('tbl_quest_bank.periodyear', period()->id);
		$this->orderBy('tbl_quest_bank.id', 'DESC');
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_quest_bank_teacher($id = false)
	{
		if ($id == false) {
			$this->select('id, quest_code');
		}else{
			$this->select('id, quest_code');
			if (in_groups('teacher') && !in_groups('student')) {
				$this->where('teacher_id', $id);
			}
		}
		$query = $this->get();
		return $query->getResultArray();
	}
}
?>
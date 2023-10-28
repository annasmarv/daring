<?php namespace App\Models;

use CodeIgniter\Model;

class AttendanceModel extends Model
{
	protected $table = 'tbl_attendance';
	protected $allowedFields = ['journal_id', 'user_id', 'present', 'description', 'yearmonth'];
	protected $useTimestamps = true;

	public function save_batch($data){
    	$db      = \Config\Database::connect();
		$builder = $db->table('tbl_attendance');
    	               
        $builder->insertBatch($data);
    }

	public function get_attendace($journal_id)
	{
		$this->select('tbl_attendance.id as attendance_id, tbl_attendance.journal_id, tbl_attendance.present, tbl_attendance.description, users.fullname, tbl_student.gender');
		$this->join('tbl_student', 'tbl_student.user_id = tbl_attendance.user_id', 'LEFT');
		$this->join('users', 'users.id = tbl_attendance.user_id', 'LEFT');
		$this->where('tbl_attendance.journal_id', $journal_id);
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_attendace_count_all($journal_id)
	{
		$this->selectCount("present", "JUM");
		$this->where('tbl_attendance.journal_id', $journal_id);
		$query = $this->get();
		return $query->getRow();
	}

	public function get_attendace_count_x($journal_id,$x)
	{
		$this->selectCount("present", "JUM");
		$this->where(['tbl_attendance.journal_id' => $journal_id, 'tbl_attendance.present' => $x]);
		$query = $this->get();
		return $query->getRow();
	}

	public function get_attendace_notin($journal_id)
	{
		$notin = ['H'];
		$this->select('tbl_attendance.id as attendance_id, tbl_attendance.journal_id, tbl_attendance.present, tbl_attendance.description, users.fullname', 'LEFT');
		$this->join('users', 'users.id = tbl_attendance.user_id', 'LEFT');
		$this->where('tbl_attendance.journal_id', $journal_id);
		$this->WhereNotIn('tbl_attendance.present', $notin);
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_recap_presence()
	{
		$this->select('tbl_attendance.id as attendance_id, tbl_attendance.journal_id, tbl_attendance.present, tbl_attendance.description, users.fullname');
		$this->join('tbl_journal', 'tbl_journal.id = tbl_attendance.journal_id', 'LEFT');
		$this->join('tbl_schedule', 'tbl_schedule.id = tbl_journal.schedule_id', 'LEFT');
		$this->join('tbl_relation', 'tbl_relation.id = tbl_schedule.relation_id', 'LEFT');
		$this->join('tbl_subjects', 'tbl_subjects.id = tbl_relation.subject_id', 'LEFT');
		$this->join('tbl_class_group', 'tbl_class_group.id = tbl_relation.class_group_id', 'LEFT');
		$this->join('users', 'users.id = tbl_attendance.user_id', 'LEFT');
		$this->where(['tbl_attendance.yearmonth' => '2021-10', 'tbl_relation.subject_id' => 1, 'tbl_relation.class_group_id' => 1]);
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_recap_presence_user($journal_id,$user_id)
	{
		$this->select('tbl_attendance.id as attendance_id, tbl_attendance.journal_id, tbl_attendance.present, tbl_attendance.description, users.fullname');
		$this->join('tbl_journal', 'tbl_journal.id = tbl_attendance.journal_id', 'LEFT');
		$this->join('users', 'users.id = tbl_attendance.user_id', 'LEFT');
		$this->where(['tbl_attendance.journal_id' => $journal_id, 'tbl_attendance.user_id' => $user_id]);
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_recap_absensi_user_month($yearmonth)
	{
		$user_id = user()->id;
		$this->select('tbl_attendance.id as attendance_id, tbl_attendance.journal_id, tbl_attendance.present, tbl_attendance.description, users.fullname, tbl_subjects.subject_name, tbl_journal.teach_date');
		$this->join('tbl_journal', 'tbl_journal.id = tbl_attendance.journal_id', 'LEFT');
		$this->join('tbl_schedule', 'tbl_schedule.id = tbl_journal.schedule_id', 'LEFT');
		$this->join('tbl_relation', 'tbl_relation.id = tbl_schedule.relation_id', 'LEFT');
		$this->join('tbl_subjects', 'tbl_subjects.id = tbl_relation.subject_id', 'LEFT');
		$this->join('tbl_class_group', 'tbl_class_group.id = tbl_relation.class_group_id');
		$this->join('users', 'users.id = tbl_attendance.user_id', 'LEFT');
		$this->where(['tbl_attendance.yearmonth' => $yearmonth, 'tbl_attendance.user_id' => $user_id]);
		$this->orderBy('tbl_journal.teach_date', 'DESC');
		$this->orderBy('tbl_subjects.id', 'ASC');
		$query = $this->get();
		return $query->getResultArray();
	}
	
}
?>
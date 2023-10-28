<?php namespace App\Models;

use CodeIgniter\Model;

class JournalModel extends Model
{
	protected $table = 'tbl_journal';
	protected $allowedFields = ['relation_id', 'week_id', 'schedule_id', 'journal_key', 'note', 'reflection', 'percent', 'teacher_id', 'periodyear'];
	protected $useTimestamps = true;

	public function get_journal_by_key($journal_key)
	{
		$this->select('tbl_journal.id, tbl_journal.journal_key, tbl_journal.note, tbl_journal.reflection, tbl_journal.percent, tbl_journal.created_at, tbl_journal.updated_at, users.fullname' );
		$this->join('users', 'users.id = tbl_journal.teacher_id');
		$this->where(['tbl_journal.journal_key' => $journal_key]);
		$this->orderBy('id', 'DESC');
		$query = $this->first();
		return $query;
	}

	public function get_journal_by_id($id)
	{
		$this->select('tbl_journal.id, tbl_journal.journal_key, tbl_journal.note, tbl_journal.reflection, tbl_journal.percent, tbl_journal.created_at, tbl_journal.updated_at, tbl_subjects.subject_name, tbl_class_group.class_group_name, users.fullname' );
		$this->join('mpd_classes', 'mpd_classes.id = tbl_journal.relation_id', 'LEFT');
		$this->join('tbl_subjects', 'tbl_subjects.id = mpd_classes.subject_id', 'LEFT');
		$this->join('tbl_class_group', 'tbl_class_group.id = mpd_classes.class_group_id', 'LEFT');
		$this->join('users', 'users.id = tbl_journal.teacher_id');
		$this->where(['tbl_journal.id' => $id]);
		$this->orderBy('id', 'DESC');
		$query = $this->first();
		return $query;
	}

	public function get_journal_by_week($week)
	{
		$this->select('tbl_journal.id, tbl_journal.journal_key, tbl_journal.note, tbl_journal.reflection, tbl_journal.percent, tbl_journal.created_at, tbl_journal.updated_at, users.fullname' );
		$this->join('users', 'users.id = tbl_journal.teacher_id');
		$this->where(['tbl_journal.week_id' => $week]);
		$this->orderBy('id', 'DESC');
		$this->get();
		$query = $this->getResultArray();
		return $query;
	}

	public function count_jp_journal_skp($month)
	{
		$user = user()->id;
		$this->selectSum('tbl_schedule.jp');
		$this->join('tbl_schedule', 'tbl_schedule.id = tbl_journal.schedule_id');
		$this->join('users', 'users.id = tbl_journal.teacher_id');
		$this->where(['tbl_journal.teacher_id' => $user]);
		$this->whereIN('tbl_journal.week_id', $month);
		$query = $this->first();
		return $query;
	}
	
	public function get_recap_journal($getData)
    {
        $this->select('tbl_journal.id as journal_id, tbl_journal.schedule_id, tbl_journal.teach_date, tbl_schedule.time_start, tbl_schedule.time_finish');
        $this->join('tbl_schedule', 'tbl_schedule.id = tbl_journal.schedule_id', 'LEFT');
        $this->join('mpd_classes', 'mpd_classes.id = tbl_schedule.relation_id', 'LEFT');
        $this->join('tbl_subjects', 'tbl_subjects.id = tbl_relation.subject_id', 'LEFT');
        $this->join('tbl_class_group', 'tbl_class_group.id = tbl_relation.class_group_id', 'LEFT');
        $this->where(['tbl_journal.yearmonth' => $getData['month'], 'tbl_relation.id' => $getData['rel']]);
        $query = $this->get();
        return $query->getResultArray();
    }

    public function get_percent_journal_week($week_id)
    {
        $this->selectSum('tbl_journal.percent');
        $this->where(['tbl_journal.week_id' => $week_id, 'tbl_journal.teacher_id' => user()->id]);
        $query = $this->first();
        return $query;
    }
    
}
?>
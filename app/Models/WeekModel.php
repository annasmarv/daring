<?php namespace App\Models;

use CodeIgniter\Model;

class WeekModel extends Model
{
	protected $table = 'tbl_week';
	// protected $allowedFields = ['id', 'XLatitude', 'XLongitude', 'XTime', 'XDate', 'user_id', 'type', 'info', 'note'];

	public function get_week_learning_schedule_teacher()
	{
		$user = user()->id;
		$this->select('tbl_week.id as week_id, tbl_week.week_schedule, tbl_week.week_name, tbl_week.date_start, tbl_week.date_finish');
		// $this->orderBy('id', 'DESC');
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_week_this_date($date)
	{
    	$this->select('tbl_week.id as week_id, tbl_week.week_schedule, tbl_week.week_name, tbl_week.date_start, tbl_week.date_finish');
    	$this->where("'$date' BETWEEN date_start AND date_finish");
		return $this->first();
	}
	
}
?>
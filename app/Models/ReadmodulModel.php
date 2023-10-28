<?php namespace App\Models;

use CodeIgniter\Model;

class ReadmodulModel extends Model
{
	protected $table = 'mpd_readmodul';
	protected $allowedFields = ['id_modul', 'user_id', 'date', 'periodyear'];

	public function get_data($id)
	{
	 	$this->select('mpd_readmodul.read_date, users.fullname' );
	 	$this->join('users', 'users.id = mpd_readmodul.user_id');
	 	$this->orderBy('mpd_readmodul.id', 'DESC');

	 	$query = $this->get();
	 	return $query->getResultArray();
	}

	public function count_data($id)
	{
	 	$this->selectCount('mpd_readmodul.id' );
	 	$this->orderBy('mpd_readmodul.id', 'DESC');
	 	$this->where('id_modul', $id);
	 	$query = $this->get();
	 	return $query->getResultArray();
	}

	public function list_read_modul($id)
	{
	 	$this->select('mpd_readmodul.user_id, mpd_readmodul.read_date, users.fullname, tbl_class_group.class_group_name');
	 	$this->join('users', 'users.id = mpd_readmodul.user_id');
	 	$this->join('tbl_student', 'tbl_student.user_id = mpd_readmodul.user_id');
	 	$this->join('tbl_class_group', 'tbl_class_group.id = tbl_student.class_group_id');
	 	$this->orderBy('mpd_readmodul.id', 'DESC');
	 	$this->groupBy('mpd_readmodul.user_id');
	 	$this->where('id_modul', $id);
	 	$query = $this->get();
	 	return $query->getResultArray();
	}	
}
?>
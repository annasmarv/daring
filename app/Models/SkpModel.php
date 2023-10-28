<?php namespace App\Models;

use CodeIgniter\Model;

class SkpModel extends Model
{
	protected $table = 'tbl_skp';
	protected $allowedFields = ['month_id', 'user_id', 'periodyear'];
	protected $useTimestamps = true;

	public function get_skp_list_user($id = false)
	{
		$this->select('tbl_skp.id, tbl_skp.month_id, tbl_month.month_name, tbl_month.weeks_id, users.fullname' );
		$this->join('tbl_month', 'tbl_month.id = tbl_skp.month_id', 'LEFT');
		$this->join('users', 'users.id = tbl_skp.user_id', 'LEFT');
		if ($id == false) {
			$this->where(['tbl_skp.user_id' => user()->id]);
			$query = $this->get();
			return $query->getResultArray();
		}else{
			$this->where(['tbl_skp.user_id' => user()->id, 'tbl_skp.id' => $id]);
			return $this->first();
		}
	}
}
?>
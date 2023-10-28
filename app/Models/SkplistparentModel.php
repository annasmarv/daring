<?php namespace App\Models;

use CodeIgniter\Model;

class SkplistparentModel extends Model
{
	protected $table = 'tbl_skp_list_parent';
	protected $allowedFields = ['type'];
	protected $useTimestamps = true;

	public function get_skp_categories()
	{
		$this->select('*');
		$this->orderBy('id', 'ASC');
		$query = $this->get();
		return $query->getResultArray();
	}
}
?>
<?php namespace App\Models;

use CodeIgniter\Model;

class SkplistModel extends Model
{
	protected $table = 'tbl_skp_list';
	protected $allowedFields = ['kegiatan', 'output', 'type'];
	protected $useTimestamps = true;

	public function get_skp_list($postData)
	{
		$this->select('*');
		$this->where(['tbl_skp_list.type' => $postData['id']]);
		$this->orderBy('id', 'ASC');
		$query = $this->get();
		return $query->getResultArray();
	}
}
?>
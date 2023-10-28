<?php namespace App\Models;

use CodeIgniter\Model;

class FeedbackModel extends Model
{
	protected $table = 'tbl_feedback';
	protected $allowedFields = ['menu', 'menu_id', 'sender_id', 'sender_chat'];
	protected $useTimestamps = true;

	public function get_feedback($menu,$menu_id)
	{
		$this->select('tbl_feedback.id, tbl_feedback.menu, tbl_feedback.menu_id, tbl_feedback.sender_chat, tbl_feedback.sender_id, tbl_feedback.created_at, users.fullname, users.user_img' );
		$this->join('users', 'users.id = tbl_feedback.sender_id');
		$this->where(['tbl_feedback.menu' => $menu, 'tbl_feedback.menu_id' => $menu_id]);
		$this->orderBy('tbl_feedback.id', 'ASC');

		$query = $this->get();
		return $query->getResultArray();
	}
	
}
?>
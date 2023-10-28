<?php namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{
	protected $table = 'tbl_news';
	protected $useTimestamps = true;
	protected $allowedFields = ['title', 'send_to', 'news', 'teacher_id'];

	public function get_news()
	{
		$this->select('tbl_news.id as newsid, tbl_news.title, tbl_news.news, tbl_news.created_at, tbl_news.teacher_id, users.fullname' );
		$this->join('users', 'users.id = tbl_news.teacher_id');
		$this->orderBy('tbl_news.id', 'DESC');
		$this->limit(3);

		$query = $this->get();
		return $query->getResultArray();
	}
	
}
?>
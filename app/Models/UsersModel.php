<?php namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
	protected $table = 'users';
	protected $useTimestamps = true;
	protected $allowedFields = ['user_img','password_hash', 'username', 'email', 'fullname'];

	// public function get_news()
	// {
	// 	$this->select('tbl_news.id as newsid, tbl_news.title, tbl_news.news, tbl_news.created_at, tbl_news.teacher_id, users.fullname' );
	// 	$this->join('users', 'users.id = tbl_news.teacher_id');
	// 	$this->orderBy('tbl_news.id', 'DESC');

	// 	$query = $this->get();
	// 	return $query->getResultArray();
	// }
	
}
?>
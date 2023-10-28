<?php namespace App\Models\Learn;

use CodeIgniter\Model;

class UsertaskModel extends Model
{
	protected $table = 'mpd_join_task';
	protected $allowedFields = ['status'];
	
	public function get_user_task($id)
	{
		$x = "''";
		$this->select('mpd_join_task.id, mpd_join_task.user_id, mpd_join_task.task_id, mpd_join_task.N2, mpd_join_task.status, users.fullname, users.username');
		$this->selectSum('mpd_answer.XNilai', 'NA');
		$this->join('tbl_student', ('tbl_student.user_id = mpd_join_task.user_id OR mpd_join_task.user_id IS NULL'), 'LEFT');
		$this->join('mpd_answer', ('mpd_answer.user_id = mpd_join_task.user_id and mpd_answer.task_id = mpd_join_task.task_id'), 'LEFT');
		$this->join('users', 'users.id = mpd_join_task.user_id', 'LEFT');
		$this->groupBy('mpd_join_task.user_id');
		$this->where(['mpd_join_task.task_id' => $id]);
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_user_NA($id)
	{
		$user_id = user()->id;
		$this->select('mpd_join_task.user_id, mpd_join_task.task_id, users.fullname');
		$this->selectSum('mpd_answer.XNilai', 'NA');
		$this->join('mpd_answer', ('mpd_answer.user_id = mpd_join_task.user_id and mpd_answer.task_id = mpd_join_task.task_id'));
		$this->join('users', 'users.id = mpd_join_task.user_id');
		$this->groupBy('mpd_join_task.user_id');
		$this->where(['mpd_join_task.task_id' => $id, 'mpd_answer.user_id' => $user_id ]);
		$query = $this->get();
		return $query;
	}

	public function get_user_NA_1_student($id,$user_id)
	{
		$this->select('mpd_join_task.user_id, mpd_join_task.task_id, users.fullname');
		$this->selectSum('mpd_answer.XNilai', 'NA');
		$this->join('mpd_answer', ('mpd_answer.user_id = mpd_join_task.user_id and mpd_answer.task_id = mpd_join_task.task_id'));
		$this->join('users', 'users.id = mpd_join_task.user_id');
		$this->groupBy('mpd_join_task.user_id');
		$this->where(['quest_type' => 1, 'mpd_join_task.task_id' => $id, 'mpd_answer.user_id' => $user_id ]);
		$query = $this->get();
		return $query;
	}

	public function get_user_NA_1($id)
	{
		$user_id = user()->id;
		$this->select('mpd_join_task.user_id, mpd_join_task.task_id, users.fullname');
		$this->selectSum('mpd_answer.XNilai', 'NA');
		$this->join('mpd_answer', ('mpd_answer.user_id = mpd_join_task.user_id and mpd_answer.task_id = mpd_join_task.task_id'));
		$this->join('users', 'users.id = mpd_join_task.user_id');
		$this->groupBy('mpd_join_task.user_id');
		$this->where(['quest_type' => 1, 'mpd_join_task.task_id' => $id, 'mpd_answer.user_id' => $user_id ]);
		$query = $this->get();
		return $query;
	}

	public function get_user_NA_2($id)
	{
		$user_id = user()->id;
		$this->select('mpd_join_task.user_id, mpd_join_task.task_id, users.fullname');
		$this->selectSum('mpd_answer.XNilai', 'NA');
		$this->join('mpd_answer', ('mpd_answer.user_id = mpd_join_task.user_id and mpd_answer.task_id = mpd_join_task.task_id'));
		$this->join('users', 'users.id = mpd_join_task.user_id');
		$this->groupBy('mpd_join_task.user_id');
		$this->where(['quest_type' => 2, 'mpd_join_task.task_id' => $id, 'mpd_answer.user_id' => $user_id ]);
		$query = $this->get();
		return $query;
	}
}
?>
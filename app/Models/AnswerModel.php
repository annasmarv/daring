<?php namespace App\Models;

use CodeIgniter\Model;

class AnswerModel extends Model
{
	protected $table = 'mpd_answer';
    protected $allowedFields = ['sort', 'number', 'task_id', 'quest_type', 'XJawaban', 'XJawabanEssai', 'point', 'answer_date', 'answer_key', 'user_id', 'XNilai'];

	public function get_question_answer($task_id)
	{
		$user = user()->id;
		$this->select('mpd_answer.*, mpd_answer.id as asid, ');
		$this->join('mpd_task', 'mpd_task.id = mpd_answer.task_id');
		$this->join('tbl_quest', 'tbl_quest.quest_bank_id = mpd_task.quest_bank_id');
		$this->where(['mpd_task.task_status' => '1', 'mpd_answer.user_id' => $user]);
		$query =  $this->get();
		return $query->getResultArray();
	}

    public function save_batch($data){
    	$db      = \Config\Database::connect();
		$builder = $db->table('mpd_answer');
    	               
        $builder->insertBatch($data);
    }

    public function get_question_answer_user_task($id,$user_id,$task_id)
	{
		$user = user()->id;
		$this->select('*');
		$this->where(['mpd_answer.id' => $id, 'mpd_answer.task_id' => $task_id, 'mpd_answer.user_id' => $user]);
		$query =  $this->get();
		return $query->getRow();
	}

	public function delete_answer($user_id,$task_id)
	{
		$this->select('*');
		$this->where(['mpd_answer.task_id' => $task_id, 'mpd_answer.user_id' => $user_id]);
		$query =  $this->get();
		return $query->getRow();
	}

	public function get_answered_status($user_id,$task_id)
	{
		$this->select('mpd_answer.sort, mpd_answer.XJawaban, mpd_answer.XJawabanEssai');
		$this->where(['mpd_answer.task_id' => $task_id, 'mpd_answer.user_id' => $user_id]);
		$query =  $this->get();
		return $query->getResultArray();
	}

	public function get_answer_by_task($task_id)
	{
		// code...
	}
}
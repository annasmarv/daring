<?php namespace App\Models\Learn;

use CodeIgniter\Model;

class CorrectionModel extends Model
{
	protected $table = 'mpd_answer';
    protected $allowedFields = ['sort', 'number', 'task_id', 'quest_type', 'XJawaban', 'XJawabanEssai', 'point', 'answer_date', 'answer_key', 'user_id', 'XNilai'];

	public function get_question_answer($user_id,$task_id)
	{
		$this->select('mpd_answer.*, mpd_answer.id as asid, tbl_quest.question, tbl_quest.answer1, tbl_quest.answer2, tbl_quest.answer3, tbl_quest.answer4, tbl_quest.answer5, tbl_quest.type, tbl_quest.point as maxpoint, tbl_quest_bank.quest_option');
		$this->join('mpd_task', 'mpd_task.id = mpd_answer.task_id', 'LEFT');
		$this->join('tbl_quest_bank', 'tbl_quest_bank.id = mpd_task.quest_bank_id', 'LEFT');
		$this->join('tbl_quest', ('tbl_quest.quest_bank_id = mpd_task.quest_bank_id and tbl_quest.number = mpd_answer.number'), 'LEFT');
		$this->where(['mpd_answer.task_id' => $task_id , 'mpd_answer.user_id' => $user_id]);
		$this->orderBy('mpd_answer.sort', 'ASC');
		$query =  $this->get();
		return $query->getResultArray();
	}

	public function get_question_answer_all($task_id)
	{
		$this->select('mpd_answer.*, mpd_answer.id as asid, tbl_quest.question, tbl_quest.answer1, tbl_quest.answer2, tbl_quest.answer3, tbl_quest.answer4, tbl_quest.answer5, tbl_quest.type, tbl_quest.point as maxpoint, tbl_quest_bank.quest_option, users.id, users.fullname');
		$this->join('mpd_task', 'mpd_task.id = mpd_answer.task_id');
		$this->join('tbl_quest_bank', 'tbl_quest_bank.id = mpd_task.quest_bank_id');
		$this->join('tbl_quest', ('tbl_quest.quest_bank_id = mpd_task.quest_bank_id and tbl_quest.number = mpd_answer.number'));
		$this->join('users', 'users.id = mpd_answer.user_id');
		$this->where(['mpd_answer.task_id' => $task_id]);
		$this->orderBy('mpd_answer.sort', 'ASC');
		$query =  $this->get();
		return $query->getResultArray();
	}

    public function save_batch($data){
    	$db      = \Config\Database::connect();
		$builder = $db->table('mpd_answer');
    	               
        $builder->insertBatch($data);
    }
}
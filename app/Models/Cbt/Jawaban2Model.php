<?php namespace App\Models\Cbt;

use CodeIgniter\Model;

class Jawaban2Model extends Model
{
	protected $table = 'cbt_jawaban';
    protected $allowedFields = ['token', 'sort', 'number', 'task_id', 'quest_bank_id', 'quest_type', 'XA', 'XB', 'XC', 'XD', 'XE', 'XRagu', 'XJawaban', 'XJawabanEssai', 'XNilai', 'point', 'answer_date', 'answer_key', 'user_id'];

	public function get_question_answer($task_id)
	{
		$user = user()->id;
		$this->select('cbt_jawaban.*, cbt_jawaban.id as asid, ');
		$this->join('cbt_ujian', 'cbt_ujian.id = cbt_jawaban.task_id');
		$this->join('tbl_quest', 'tbl_quest.quest_bank_id = cbt_ujian.quest_bank_id');
		$this->where(['cbt_ujian.task_status' => '1', 'cbt_jawaban.user_id' => $user]);
		$query =  $this->get();
		return $query->getResultArray();
	}

    public function get_question_answer_user_task($id,$user_id,$task_id)
	{
		$user = user()->id;
		$this->select('*');
		$this->where(['cbt_jawaban.id' => $id, 'cbt_jawaban.task_id' => $task_id, 'cbt_jawaban.user_id' => $user]);
		$query =  $this->get();
		return $query->getRow();
	}

	public function get_question_answer_correction($user_id,$task_id)
	{
		$this->select('cbt_jawaban.*, cbt_jawaban.id as asid, tbl_quest.question, tbl_quest.answer1, tbl_quest.answer2, tbl_quest.answer3, tbl_quest.answer4, tbl_quest.answer5, tbl_quest.type, tbl_quest.point as maxpoint, tbl_quest_bank.quest_option');
		$this->join('cbt_ujian', 'cbt_ujian.id = cbt_jawaban.task_id');
		$this->join('tbl_quest_bank', 'tbl_quest_bank.id = cbt_ujian.quest_bank_id');
		$this->join('tbl_quest', ('tbl_quest.quest_bank_id = cbt_ujian.quest_bank_id and tbl_quest.number = cbt_jawaban.number'));
		$this->where(['cbt_jawaban.task_id' => $task_id , 'cbt_jawaban.user_id' => $user_id]);
		$this->orderBy('cbt_jawaban.number', 'ASC');
		$query =  $this->get();
		return $query->getResultArray();
	}

    public function save_batch($data){
    	$db      = \Config\Database::connect();
		$builder = $db->table('cbt_jawaban');
    	               
        $builder->insertBatch($data);
    }

    public function get_answer_by_task($task_id,$user_id)
	{
		$this->select('cbt_jawaban.XJawaban, cbt_jawaban.XJawabanEssai, cbt_jawaban.user_id as juser_id, cbt_jawaban.task_id as jtask_id');
		$this->where(['cbt_jawaban.task_id' => $task_id, 'cbt_jawaban.user_id' => $user_id ]);
		$this->orderBy('cbt_jawaban.number', 'ASC');
		$query =  $this->get();
		return $query->getResultArray();
	}

    public function get_answer_essay_by_task($task_id,$user_id)
	{
		$this->select('cbt_jawaban.XJawabanEssai, cbt_jawaban.XNilai, cbt_jawaban.user_id as juser_id, cbt_jawaban.task_id as jtask_id');
		$this->where(['cbt_jawaban.task_id' => $task_id, 'cbt_jawaban.user_id' => $user_id, 'cbt_jawaban.quest_type' => 2 ]);
		$this->orderBy('cbt_jawaban.number', 'ASC');
		$query =  $this->get();
		return $query->getResultArray();
	}

	public function get_answer_pilgan_by_task($task_id,$user_id)
	{
		$this->select('cbt_jawaban.XJawaban, cbt_jawaban.XNilai, cbt_jawaban.user_id as juser_id, cbt_jawaban.task_id as jtask_id');
		$this->where(['cbt_jawaban.task_id' => $task_id, 'cbt_jawaban.user_id' => $user_id, 'cbt_jawaban.quest_type' => 1 ]);
		$this->orderBy('cbt_jawaban.number', 'ASC');
		$query =  $this->get();
		return $query->getResultArray();
	}
}
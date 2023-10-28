<?php namespace App\Models;

use CodeIgniter\Model;

class QuestModel extends Model
{
	protected $table = 'tbl_quest';
	protected $useTimestamps = true;
	protected $allowedFields = ['subject_id', 'quest_bank_id', 'type', 'number', 'point', 'question', 'audio', 'video', 'answer1', 'answer2', 'answer3', 'answer4', 'answer5', 'quest_keys', 'random', 'teacher_id'];

	public function get_quest($id)
	{
		$this->select('tbl_quest.id as qid, tbl_quest.subject_id, tbl_quest.quest_bank_id, tbl_quest.type, tbl_quest.number, tbl_quest.point, tbl_quest.question, tbl_quest.audio, tbl_quest.video, tbl_quest.answer1, tbl_quest.answer2, tbl_quest.answer3, tbl_quest.answer4, tbl_quest.answer5, tbl_quest.quest_keys, tbl_quest.random, tbl_quest_bank.quest_option, tbl_quest.teacher_id')
				->join('tbl_quest_bank', 'tbl_quest_bank.id = tbl_quest.quest_bank_id')
				->where('tbl_quest.quest_bank_id',$id)
				->orderBy('tbl_quest.number');
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_quest_keys($id)
	{
		$this->select('tbl_quest.quest_keys');
		$this->join('tbl_quest_bank', 'tbl_quest_bank.id = tbl_quest.quest_bank_id');
		$this->where(['tbl_quest.quest_bank_id' => $id, 'tbl_quest.type' => 1]);
		$this->orderBy('tbl_quest.number');
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_quest_essai($id)
	{
		$this->select('tbl_quest.id as qid, tbl_quest.subject_id, tbl_quest.quest_bank_id, tbl_quest.type, tbl_quest.number, tbl_quest.point, tbl_quest.question, tbl_quest.audio, tbl_quest.video, tbl_quest.answer1, tbl_quest.answer2, tbl_quest.answer3, tbl_quest.answer4, tbl_quest.answer5, tbl_quest.quest_keys, tbl_quest.random, tbl_quest_bank.quest_option')
			->join('tbl_quest_bank', 'tbl_quest_bank.id = tbl_quest.quest_bank_id')
			->where(['tbl_quest.quest_bank_id' => $id, 'tbl_quest.type' => 2])
			->orderBy('tbl_quest.number');
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_quest_limit($id, $limit)
	{
		$this->select('*');
		// $this->join('tbl_subjects', 'tbl_subjects.id = mpd_modul.subject_id');
		$this->where('quest_bank_id', $id);
		$this->limit($limit);
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_quest_limit_rand($id, $limit)
	{
		$this->select('*');
		// $this->join('tbl_subjects', 'tbl_subjects.id = mpd_modul.subject_id');
		$this->where('quest_bank_id', $id);
		$this->limit($limit);
		$this->orderBy('RAND()');
		$query = $this->get();
		return $query->getResultArray();
	}

	public function ubah($data, $code)
	{
		$this->builder = $this->db->table($this->table);

        $this->builder->where('quest_bank_id', $code);
        return $this->builder->update($data);
	}

	public function get_quest_count($id)
	{
		$ok = $this->selectCount('quest_bank_id')
				->where(['quest_bank_id' => $id])->first();
		$okC = $ok['quest_bank_id'];
		return $okC;
	}

	public function get_point_count($id)
	{
		$ok = $this->selectSUM('point')
				->where(['quest_bank_id' => $id])->first();
		$point = $ok['point'];
		return round($point, 2);
	}

	public function save_batch($data){
    	$db      = \Config\Database::connect();
		$builder = $db->table('tbl_quest');
    	               
        $builder->insertBatch($data);
    }
}
?>
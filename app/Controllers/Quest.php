<?php namespace App\Controllers;

use Irsyadulibad\DataTables\DataTables;
use App\Models\QuestbankModel;
use App\Models\QuestModel;
use App\Models\Data\SubjectModel;

class Quest extends BaseController
{
	public function __construct()
	{
		$this->questModel = new QuestModel();
	}

	public function index($id)
	{
		$quest = $this->questModel->select('tbl_quest.id as qid, tbl_quest.subject_id, tbl_quest.quest_bank_id, tbl_quest.type, tbl_quest.number, tbl_quest.point, tbl_quest.question, tbl_quest.audio, tbl_quest.video, tbl_quest.answer1, tbl_quest.answer2, tbl_quest.answer3, tbl_quest.answer4, tbl_quest.answer5, tbl_quest.quest_keys, tbl_quest.random, tbl_quest_bank.quest_option')
				->join('tbl_quest_bank', 'tbl_quest_bank.id = tbl_quest.quest_bank_id')
				->where('tbl_quest.quest_bank_id',$id)
				->orderBy('tbl_quest.number');
		$data = [
			'title' => 'Daftar Soal',
			'quests' => $quest->paginate(1 ,'quest'),
			'pager' => $this->questModel->pager
		];

		return view('learn/quest_add', $data);
	}

	public function add()
	{
		$total = $this->request->getPost('total');
		$code = $this->request->getPost('id');
		$count = $this->questModel->get_quest_count($code);
		$totalx = $count+$total;

		for ($i=$count+1; $i <= $totalx ; $i++) { 
		$data = [
			'subject_id'	=> 3, 
			'quest_bank_id'	=> $this->request->getPost('id'), 
			'type'	=> $this->request->getPost('type'),
			'point'	=> $this->request->getPost('point'),
			'teacher_id'	=> user()->id,
			'number' => $i
		];
		
		$this->questModel->save($data);
		}

		session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('quest/' . $code));
	}

	public function update()
    {
    	$code = $this->request->getPost('code');
    	$currentPage = $this->request->getPost('page');
        $data = [
        	'id' => $this->request->getPost('id'),
        	// 'number' => $this->request->getPost('number'),
        	'point' => $this->request->getPost('point'),
        	'question' => $this->request->getPost('question'),
        	// 'audio' => $this->request->getPost('audio'),
        	// 'video' => $this->request->getPost('video'),
        	'answer1' => $this->request->getPost('answer1'),
        	'answer2' => $this->request->getPost('answer2'),
        	'answer3' => $this->request->getPost('answer3'),
        	'answer4' => $this->request->getPost('answer4'),
        	'answer5' => $this->request->getPost('answer5'),
        	'quest_keys' => $this->request->getPost('kunci'),
        	'point' => $this->request->getPost('point')
        ];

        $this->questModel->save($data);
		session()->setFlashdata('pesan', 'Data berhasil diubah');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('quest/'.$code.'?page_quest='.$currentPage));
    }

	public function delete()
	{
		$id = $this->request->getPost('id');
		$qbid = $this->request->getPost('code');
		$this->questModel->delete($id);
		session()->setFlashdata('pesan', 'Data berhasil dihapus');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url().'/questbank/'.$qbid);
	}

	public function count_soal()
	{
		$kodesoal = $this->request->getVar('soal');
		$jums = $this->questModel->get_quest_count($kodesoal);
		echo $jums;
	}

	//--------------------------------------------------------------------

}

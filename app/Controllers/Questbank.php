<?php namespace App\Controllers;

use Irsyadulibad\DataTables\DataTables;
use App\Models\QuestbankModel;
use App\Models\QuestModel;
use App\Models\ClassesModel;

class Questbank extends BaseController
{
	public function __construct()
	{
		$this->questModel = new QuestbankModel();
	}

	public function index()
	{
		$classes = new ClassesModel;
		$data = [
			'title' => 'Bank Soal',
			'subjects' => $classes->get_subject(user()->id)
		];

		return view('questbank/index', $data);
	}

    public function getQuestbank()
    {
    	$postData = [
    		'subject_id' => $this->request->getVar('subject_id')
    	];

    	$data = $this->questModel->get_quest_bank_by_subject($postData);

    	echo json_encode($data);
    }

    public function copyQuestBank($id)
    {
    	$quest_bank_id = $this->request->getPost('quest_bank_id');
    	$quest = new QuestModel;

    	$soal = $quest->get_quest($quest_bank_id);

    	$copysoal = array();
    	foreach ($soal as $data) {
    		$data = [
				'subject_id'	=> $data['subject_id'], 
				'quest_bank_id'	=> $id, 
				'type'			=> $data['type'],
				'number'		=> $data['number'],
				'point'			=> $data['point'],
				'question'		=> $data['question'],
				'audio'			=> $data['audio'],
				'video'			=> $data['video'],
				'answer1'		=> $data['answer1'],
				'answer2'		=> $data['answer2'],
				'answer3'		=> $data['answer3'],
				'answer4'		=> $data['answer4'],
				'answer5'		=> $data['answer5'],
				'quest_keys'	=> $data['quest_keys'],
				'random'		=> $data['random'],
				'teacher_id'	=> $data['teacher_id'],
				'created_at'	=> date('Y-m-d'),
				'updated_at'	=> date('Y-m-d'),
			];

			$copysoal[] = $data;
    	}

    	$quest->save_batch($copysoal);
    	session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
		session()->setFlashdata('type', 'success');
    	return redirect()->back();
    }

	public function detail($id)
	{
		$quest = new QuestModel;
		$data = [
			'title' => 'Bank Soal',
			'banks' => $this->questModel->get_quest_bank($id),
			'lists' => $this->questModel->get_quest_bank(),
			'quests' => $quest->get_quest($id),
			'point' => $quest->get_point_count($id)
		];

		return view('questbank/detail', $data);
	}

	public function get_quest_bank($periodyear = false)
	{
		if ($periodyear == false) {
			$periodyear = period()->id;
		}

		$user = user()->id;

		if (in_groups('teacher')) {
			return DataTables::use('tbl_quest_bank')
				->select('tbl_quest_bank.id as bankid, tbl_quest_bank.subject_id, tbl_quest_bank.quest_code, tbl_quest_bank.quest_option, tbl_quest_bank.subject_id, tbl_subjects.subject_name as sbjk')
				->join('tbl_subjects', 'tbl_subjects.id = tbl_quest_bank.subject_id')
				->where(['tbl_quest_bank.teacher_id' => $user, 'periodyear' => $periodyear])
				->make(true);
		}elseif (in_groups('admin')) {
			return DataTables::use('tbl_quest_bank')
				->select('tbl_quest_bank.id as bankid, tbl_quest_bank.subject_id, tbl_quest_bank.quest_code,tbl_subjects.subject_name as sbjk')
				->join('tbl_subjects', 'tbl_subjects.id = tbl_quest_bank.subject_id')
				->where(['periodyear' => $periodyear])
				->make(true);
		}
	}

	public function create()
	{
		$data = [
			'subject_id'	=> $this->request->getPost('subject'), 
			'quest_code'	=> $this->request->getPost('code'), 
			'quest_option'	=> $this->request->getPost('option'),
			'teacher_id'	=> user()->id,
			'periodyear'	=> period()->id
		];

		$this->questModel->save($data);
		session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('questbank'));
	}

	public function update()
	{
		$data = [
			'id'			=> $this->request->getPost('id'),
			'number'		=> $this->request->getPost('number'),
			'subject_id'	=> $this->request->getPost('subject'), 
			'quest_code'	=> $this->request->getPost('code'), 
			'quest_option'	=> $this->request->getPost('option'),
			'teacher_id'	=> user()->id
		];

		$this->questModel->save($data);
		session()->setFlashdata('pesan', 'Data berhasil fiubah');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('questbank'));
	}

	public function delete()
	{
		$id = $this->request->getPost('id');

		$this->questModel->delete($id);
		session()->setFlashdata('pesan', 'Data berhasil dihapus');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('questbank'));
	}

	public function show($id)
    {
        if ($this->request->isAJAX()) {
            $result = $this->questModel->find($id);
            if ($result) {
                $this->output['success'] = true;
                $this->output['message']  = 'Data ditemukan';
                $this->output['data']   = $result;
            }
            echo json_encode($this->output);
        }
    }

    public function viewPdf($id)
    {
    	$quest = new QuestModel;
		$data = [
			'title' => 'Bank Soal',
			'banks' => $this->questModel->get_quest_bank($id),
			'quests' => $quest->get_quest($id)
		];

        return view('export/questbank', $data);
    }

    public function pdf($id)
    {
    	$quest = new QuestModel;
		$data = [
			'title' => 'Bank Soal',
			'banks' => $this->questModel->get_quest_bank($id),
			'quests' => $quest->get_quest($id)
		];
   
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml(view('export/questbank', $data));
        // $dompdf->load_html_file('img/1609853179_1e66fb06ccdaf3ee3759.png');
        // $dompdf->setPaper('A4', 'potrait');
        $dompdf->setPaper(array(0,0,609.4488,935.433), 'potrait');
        $dompdf->render();
        $dompdf->stream('Bank Soal | '.$data['banks'][0]['quest_code'].'.pdf', array('Attachment' => false));
   
    }

	//--------------------------------------------------------------------
}

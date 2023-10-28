<?php namespace App\Controllers\Learn;

use App\Controllers\BaseController;
use App\Models\Learn\CorrectionModel;
use App\Models\Learn\TaskModel;
use App\Models\QuestModel;
use App\Models\Learn\UsertaskModel;

class Correction extends BaseController
{
	private $db;
	public function __construct()
	{
		$this->correctionModel = new CorrectionModel();
		$this->taskModel = new TaskModel();
		$this->usertaskModel = new UsertaskModel();
		$this->questModel = new QuestModel();
		$this->db = \Config\Database::connect();
	}

	public function index($user_id,$task_id)
	{
		$uri = service('uri');
		$data = [
			'title' => 'Koreksi Jawaban',
			'qna' => $this->correctionModel->get_question_answer($user_id,$task_id),
			'page' => $uri->getSegment(4)
		];

		return view('learn/correction', $data);
	}

	public function all($task_id)
	{
		$uri = service('uri');
		$task = $this->taskModel->get_task_detail($task_id)->getRow();
		$data = [
			'title' => 'Koreksi Jawaban',
			'qna' => $this->correctionModel->get_question_answer_all($task_id),
			'essai' => $this->questModel->get_quest_essai($task->quest_bank_id),
			'page' => $uri->getSegment(3)
		];
		
		return view('learn/correction_all', $data);
	}

	public function save()
	{	
		$a = $this->request->getPost('1');
		$b = $this->request->getPost('2');
		$id = $this->request->getPost('id');
		$nilai = $this->request->getPost('nilai');

		$data = "";
		foreach (array_combine($id, $nilai) as $x => $nilai) {
			$data = [
				'id' => $x,
				'XNilai' => $nilai
			];		
		$this->correctionModel->save($data);
		}

		return redirect()->to(base_url('learn/correction/'.$a.'/'.$b));
	}

	public function truncate($user_id,$task_id)
	{
		$builder = $this->db->table('mpd_answer');
		$builder->delete(['user_id' => $user_id, 'task_id' => $task_id]);
		$builder1 = $this->db->table('mpd_join_task');
		$builder1->delete(['user_id' => $user_id, 'task_id' => $task_id]);
		session()->setFlashdata('pesan', 'Data berhasil dihapus');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('learn/task/'.$task_id));
	}
	
}

<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Cbt\UjianModel;
use App\Models\Cbt\SiswaujianModel;
use App\Models\Cbt\JawabanModel;

class Correction extends BaseController
{
	private $db;
	public function __construct()
	{
		$this->taskModel = new UjianModel();
		$this->usertaskModel = new SiswaujianModel();
		$this->correctionModel = new JawabanModel();
		$this->db = \Config\Database::connect();
	}

	public function index($user_id,$task_id)
	{	
		$uri = service('uri');
		$data = [
			'title' => 'Koreksi Jawaban',
			'qna' => $this->correctionModel->get_question_answer_correction($user_id,$task_id),
			'page' => $uri->getSegment(3)
		];
	
		return view('cbt/correction', $data);
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

		return redirect()->to(base_url('correction/'.$a.'/'.$b));
	}

	public function truncate($user_id,$task_id)
	{
		$builder = $this->db->table('cbt_jawaban');
		$builder->delete(['user_id' => $user_id, 'task_id' => $task_id]);
		$builder1 = $this->db->table('cbt_siswa_ujian');
		$builder1->delete(['user_id' => $user_id, 'task_id' => $task_id]);
		session()->setFlashdata('pesan', 'Data berhasil dihapus');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('ujian/reset/'.$task_id));
	}
	
}

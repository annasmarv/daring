<?php namespace App\Controllers\Data;

use App\Controllers\BaseController;
use App\Models\TaskTypeModel;

class Tasktype extends BaseController
{
	protected $TaskTypeModel;

	public function __construct()
	{
		$this->taskTypeModel = new TaskTypeModel();
	}

	public function index()
	{
		$data = [
			'title' => 'Jenis Penilaian',
			'tasktypes' => $this->taskTypeModel->getData()->getResultArray()
		];

		return view('tasktype/index', $data);
	}

	public function create()
	{
		$this->taskTypeModel->save($this->request->getPost());

		session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
		session()->setFlashdata('type', 'success');
		return redirect()->to('data/tasktype');
	}
	//--------------------------------------------------------------------

}

<?php namespace App\Controllers\Data;

use App\Controllers\BaseController;
use App\Models\Data\SubjectModel;

class Subject extends BaseController
{
	protected $SubjectModel;

	public function __construct()
	{
		$this->SubjectModel = new SubjectModel();
	}

	public function index()
	{
		$data = [
			'title' => 'Mata Pelajaran',
			'subjects' => $this->SubjectModel->get_subject()
		];

		return view('data/subject', $data);
	}

	public function create()
	{
		$data = [
			'subject_code' => $this->request->getPost('subject_code'),
			'subject_name' => $this->request->getPost('subject_name')
		];

		$this->SubjectModel->save($data);
		session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('data/subject'));
	}

	public function update()
	{
		$data = [
			'id' => $this->request->getPost('subject_id'),
			'subject_code' => $this->request->getPost('subject_code'),
			'subject_name' => $this->request->getPost('subject_name')
		];

		$this->SubjectModel->save($data);
		session()->setFlashdata('pesan', 'Data berhasil diubah');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('data/subject'));
	}

	public function delete()
	{
		$id = $this->request->getPost('subject_id');
		$this->SubjectModel->delete($id);
		session()->setFlashdata('pesan', 'Data berhasil dihapus');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('data/subject'));
	}
}




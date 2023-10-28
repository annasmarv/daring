<?php namespace App\Controllers;

use App\Models\HomeModel;

class News extends BaseController
{
	protected $newsModel;

	public function __construct()
	{
		$this->newsModel = new HomeModel;
	}

	public function index()
	{
		helper('indo');
		$data = [
			'news' => $this->newsModel->get_news(),
			'title' => 'Pengumuman'
		];

		return view('home/news', $data);
	}

	public function create()
	{
		$data = [
			'title' => $this->request->getPost('title'),
			'news' => $this->request->getPost('news'),
			'teacher_id' => user()->id
		];

		$this->newsModel->save($data);
		session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('/'));

	}

	public function delete()
	{
		$id = $this->request->getPost('id');

		$this->newsModel->delete($id);
		session()->setFlashdata('pesan', 'Data berhasil dihapus');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('/'));

	}

	//--------------------------------------------------------------------

}
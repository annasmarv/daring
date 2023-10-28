<?php namespace App\Controllers\Data;

use App\Controllers\BaseController;
use App\Models\PeriodYearModel;

class Periodyear extends BaseController
{
	protected $periodYearModel;

	public function __construct()
	{
		$this->periodYearModel = new PeriodYearModel();
	}

	public function index()
	{
		$data = [
			'title' => 'Tahun Ajaran',
			'periodyears' => $this->periodYearModel->getData()->getResultArray()
		];

		return view('periodyear/index', $data);
	}

	public function create()
	{
		$this->periodYearModel->save($this->request->getPost());

		session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
		session()->setFlashdata('type', 'success');
		return redirect()->to('data/tasktype');
	}
	//--------------------------------------------------------------------

}

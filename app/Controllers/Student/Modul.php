<?php namespace App\Controllers\Student;

use App\Controllers\BaseController;
use App\Models\Data\ModulModel;
use App\Models\Data\SubjectModel;
use App\Models\Data\ClassgroupModel;

class Modul extends BaseController
{
	protected $ModulModel;

	public function __construct()
	{
		$this->ModulModel = new ModulModel();
	}
	public function index($id)
	{
		$data = [
			'title' => 'Baca Materi',
			'modul' => $this->ModulModel->get_modul($id),
			'uri' => $this->request->uri
		];

		if (empty($data['modul'])) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Materi tidak ditemukan.');
			
		}
		return view('student/modul_read', $data);
	}
}
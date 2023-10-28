<?php namespace App\Controllers;

use App\Models\Monitoring\StudentModel;
use App\Models\Monitoring\TeacherModel;

class Monitoring extends BaseController
{
	protected $studentModel;
	protected $teacherModel;

	function __construct()
	{
		$this->studentModel = new StudentModel;
		$this->teacherModel = new TeacherModel;
	}
	public function index()
	{
		$data = [
			'title' => 'Monitoring',
			'abc' => $this->studentModel->get_count()
		];

		return view('data/monitoring.php', $data);
	}

	//--------------------------------------------------------------------

}

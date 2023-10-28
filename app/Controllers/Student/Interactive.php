<?php namespace App\Controllers\Student;

use App\Controllers\BaseController;

class Interactive extends BaseController
{

	public function index()
	{
		$data = [
			'title' => 'Kelas Interactive',
			'tasks' => $this->tasksModel->get_tasks(),
		];

		return view('student/tasks', $data);
	}
}

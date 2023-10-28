<?php namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\FeedbackModel;

class Feedback extends BaseController
{
	// protected $db, $builder, $studentModel, $classesModel, $taskModel, $usertaskModel, $weekModel, $scheduleModel, $planModel;

	public function __construct()
	{
        $this->feedModel = new FeedbackModel;
	}

	public function send()
	{
		$data = [
			'menu' => $this->request->getPost('menu'),
			'menu_id' => $this->request->getPost('menu_id'),
			'sender_chat' => $this->request->getPost('chat'),
			'sender_id' => user()->id
		];

		$this->feedModel->save($data);

		return redirect()->to(base_url($this->request->getPost('uri')));
	}

	//--------------------------------------------------------------------

}
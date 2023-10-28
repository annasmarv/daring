<?php namespace App\Controllers\Student;

use App\Controllers\BaseController;
use App\Models\ClassesModel;
use App\Models\TasksModel;
use App\Models\QuestModel;
use App\Models\JointaskModel;
use App\Models\Learn\UsertaskModel;

class Tasks extends BaseController
{
	public function __construct()
	{
		$this->classesModel = new ClassesModel();
		$this->tasksModel = new TasksModel();
		$this->questModel = new QuestModel();
		$this->jointaskModel = new JointaskModel();
		$this->usertaskModel = new UsertaskModel();
	}

	public function index()
	{
		$data = [
			'title' => 'Tugas',
			'task1' => $this->tasksModel->get_tasks_null(),
			'task2' => $this->tasksModel->get_tasks_start(),
			'task3' => $this->tasksModel->get_tasks_finish(),
		];

		return view('student/tasks', $data);
	}

	public function detail($id)
	{
		helper('indo');
		$uri = service('uri');
		$task_id = $uri->getSegment(3);
		$user_id = user()->id;
		$task = $this->tasksModel->get_tasks_detail($id);
		$join = $this->jointaskModel->get_join_task($user_id,$task_id);
		if ($this->jointaskModel->count_by_user_tes_1($user_id,$task_id) > 0) {
			$chance = $this->jointaskModel->get_id_join_task($user_id, $task_id)->getRow()->chance;
		}else{
			$chance = 0;
		}
		$data = [
			'title' => 'Kelas Ku',
			'task' => $task,
			'count' => $this->questModel->get_quest_count($task['quest_bank_id']),
			'status' => $join,
			'chance' => $chance,
			'NA' => $this->usertaskModel->get_user_NA($id)->getRow(),
			'NA1' => $this->usertaskModel->get_user_NA_1($id, $user_id)->getRow(),
			'NA2' => $this->usertaskModel->get_user_NA_2($id)->getRow()
		];

		return view('student/task_detail', $data);
	}

	public function finish($id)
	{
		$user_id = user()->id;
		$join_id = $this->jointaskModel->get_id_join_task($user_id,$id)->getRow()->id;

		$data = [
			'id' => $join_id,
			'status' => 9
		];

		$this->jointaskModel->save($data);
		return redirect()->to('/student/tasks/'.$id);
	}
	//--------------------------------------------------------------------

}

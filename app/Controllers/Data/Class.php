<?php namespace App\Controllers\Data;

use App\Controllers\BaseController;
use App\Models\Data \ClassModel;
use App\Models\Data\ClassgroupModel;
use App\Models\Data\SubjectModel;
use App\Models\Data\TeacherModel;

class Class extends BaseController
{
	public function __construct()
	{
		$this->classModel = new ClassModel();
		$this->classgroupModel = new ClassgroupModel();
		$this->subjectModel = new SubjectModel();
		$this->teacherModel = new TeacherModel();
	}

	public function index()
	{
		$data = [
			'title' => 'Kelas Ku',
			'classes' => $this->classesModel->get_classes_teacher(),
		];

		return view('learn/class', $data);
	}

	public function detail($id,$code)
	{
		$data = [
			'title' => 'Kelas Ku',
			'moduls' => $this->classesModel->get_modul_class($id,$code),
			'tasks' => $this->classesModel->get_task_class($id,$code),
			'inter' => $this->classesModel->get_inter_class($id,$code),
			'subject' => $this->classesModel->get_subject_name($id),
			'class' => $this->classesModel->get_class_name($id)
		];

		return view('learn/class_detail', $data);
	}

	public function read($id)
	{
		$readModul = new ReadmodulModel();
		$readdata = [
			'id_modul' => $id,
			'user_id' => user()->id
		];
		$readModul->save($readdata);
		return redirect()->to(base_url('learn/modul/'.$id));	
	}
	//--------------------------------------------------------------------

}

<?php namespace App\Controllers\Student;

use App\Controllers\BaseController;
use App\Models\ClassesModel;
use App\Models\Data\ModulModel;
use App\Models\ReadmodulModel;

class Classes extends BaseController
{
	public function __construct()
	{
		$this->classesModel = new ClassesModel();
		$this->modulModel = new ModulModel();
	}

	public function index()
	{
		$keyword = "";
		$keyword = $this->request->getGet('search');
		if ($keyword) {
			$classes = $this->classesModel->search_student($keyword);
		}else{
			$classes = $this->classesModel->get_classes_student();
		}

		$data = [
			'keyword' => $keyword,
			'title' => 'Kelas Ku',
			'classes' => $classes->paginate(15, 'pager'),
			'pager' => $this->classesModel->pager
		];
		
		return view('student/class', $data);
	}

	public function detail($id,$code,$subject)
	{
		$data = [
			'title' => 'Kelas Ku',
			'moduls' => $this->classesModel->get_modul_class($id,$code,$subject),
			'tasks' => $this->classesModel->get_task_class($id,$code),
			'meets' => $this->classesModel->get_meet_class($id,$code),
			'inter' => $this->classesModel->get_inter_class($id,$code),
			'subject' => $this->classesModel->get_subject_name($id),
			'class' => $this->classesModel->get_class_name($id)
		];

		return view('student/class_detail', $data);
	}

	public function read($id)
	{
		$readModul = new ReadmodulModel();
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d');
		$readdata = [
			'id_modul' => $id,
			'user_id' => user()->id,
			'date' => $date
		];
		$readModul->save($readdata);
		return redirect()->to(base_url('student/modul/'.$id));	
	}
	//--------------------------------------------------------------------

}

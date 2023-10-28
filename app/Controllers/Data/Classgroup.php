<?php namespace App\Controllers\Data;

use App\Controllers\BaseController;
use App\Models\Data\ClassgroupModel;
use App\Models\Data\ClasslevelModel;
use App\Models\Data\MajorsModel;
use App\Models\Data\TeacherModel;
use App\Models\Data\StudentModel;
use App\Models\Data\SubjectModel;
use App\Models\Data\RelationModel;

class Classgroup extends BaseController
{
	protected $ClassgroupModel, $studentModel;

	public function __construct()
	{
		$this->ClassgroupModel = new ClassgroupModel();
		$this->studentModel = new StudentModel();
		$this->relationModel = new RelationModel();
		$this->subjectModel = new SubjectModel();
		$this->teacher = new TeacherModel();
	}

	public function index($id = false)
	{
		$mlevel = new ClasslevelModel();
		$mmajors = new MajorsModel();
		$teacher = new TeacherModel();
		if ($id == false) {
			$data = [
				'title' => 'Rombongan Belajar',
				'class' => $this->ClassgroupModel->get_classgroup(),
				'levels' => $mlevel->get_class_level(),
				'majors' => $mmajors->get_major(),
				'teachers' => $teacher->get_teacher()
			];

			return view('data/class-group', $data);
		}

		$data = [
				'title' => 'Rombongan Belajar',
				'students' => $this->studentModel->get_student_class($id),
				'studentfree' => $this->studentModel->get_student_no_class(),
				'class' => $this->ClassgroupModel->get_classgroup(),
				'class_id' => $id
			];

		return view('data/classstudent', $data);
	}

	public function create()
	{
		$data = [
			'class_level_id' => $this->request->getPost('tingkat'),
			'majors_id' => $this->request->getPost('jurusan'),
			'class_group_name' => $this->request->getPost('kodekelas'),
			'teacher_id' => $this->request->getPost('walas'),
			'is_active' => 1
		];

		$this->ClassgroupModel->save($data);
		session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('data/classgroup'));
	}

	public function update()
	{
		$data = [
			'id' => $this->request->getPost('class_id'),
			'class_level_id' => $this->request->getPost('tingkat'),
			'majors_id' => $this->request->getPost('jurusan'),
			'class_group_name' => $this->request->getPost('kodekelas'),
			'teacher_id' => $this->request->getPost('walas'),
			'is_active' => 1
		];

		$this->ClassgroupModel->save($data);
		session()->setFlashdata('pesan', 'Data berhasil diubah');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('data/classgroup'));
	}

	public function delete()
	{
		$id = $this->request->getPost('class_id');
		$this->ClassgroupModel->delete($id);
		session()->setFlashdata('pesan', 'Data berhasil dihapus');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('data/classgroup'));
	}

	public function learning($class_id)
	{
		$data = [
			'title' => 'Relasi Data',
			'relations' => $this->relationModel->get_relation($class_id),
			'subjects' => $this->subjectModel->get_subject(),
			'teachers' => $this->teacher->get_teacher(),
			'classgroup' => $this->ClassgroupModel->classgroup()
		];

		return view('data/class-learning', $data);
	}

}




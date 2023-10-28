<?php namespace App\Controllers\Data;

use App\Controllers\BaseController;
use App\Models\Data\RelationModel;
use App\Models\Data\RelationTeamModel;
use App\Models\Data\ClassgroupModel;
use App\Models\Data\SubjectModel;
use App\Models\Data\TeacherModel;

class Relation extends BaseController
{
	protected $relationModel, $timModel;

	public function __construct()
	{
		$this->relationModel = new RelationModel();
		$this->timModel = new RelationTeamModel();
	}

	public function index()
	{
		$subject = new SubjectModel();
		$teacher = new TeacherModel();
		$classgroup = new ClassgroupModel();
		$data = [
			'title' => 'Relasi Data',
			'relations' => $this->relationModel->get_relation(),
			'subjects' => $subject->get_subject(),
			'teachers' => $teacher->get_teacher(),
			'classgroup' => $classgroup->classgroup()
		];

		return view('data/relation', $data);
	}

	public function create()
	{
		$data = [
			'subject_id' => $this->request->getPost('subject'),
			'class_group_id' => $this->request->getPost('classgroup'),
			'teacher_id' => $this->request->getPost('teacher'),
			'is_active' => 1
		];

		$this->relationModel->save($data);
		session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url($this->request->getPost('redirect')));
	}

	public function update()
	{
		$data = [
			'id' => $this->request->getPost('id'),
			'subject_id' => $this->request->getPost('subject'),
			'class_group_id' => $this->request->getPost('classid'),
			'teacher_id' => $this->request->getPost('teacher')
		];

		$this->relationModel->save($data);
		session()->setFlashdata('pesan', 'Data berhasil diubah');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url($this->request->getPost('uri')));
	}

	public function delete()
	{
		$id = $this->request->getPost('id');
		$this->relationModel->delete($id);
		session()->setFlashdata('pesan', 'Data berhasil dihapus');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url($this->request->getPost('uri')));
	}
}
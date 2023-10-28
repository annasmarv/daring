<?php namespace App\Controllers\Data;

use App\Controllers\BaseController;
use App\Models\Data\ClassgroupModel;
use App\Models\Data\ClasslevelModel;
use App\Models\Data\MajorsModel;
use App\Models\Data\SubjectModel;
use App\Models\Data\TeacherModel;
use App\Models\Data\StudentModel;
use App\Models\Data\RelationModel;
use App\Models\ScheduleModel;

class Schedule extends BaseController
{
	protected $ClassgroupModel, $studentModel, $levelModel, $subjectModel, $majorModel, $teacherModel, $relationModel, $scheduleModel;

	public function __construct()
	{
		$this->ClassgroupModel = new ClassgroupModel();
		$this->studentModel = new StudentModel();
		$this->levelModel = new ClasslevelModel();
		$this->majorModel = new MajorsModel();
		$this->subjectModel = new SubjectModel();
		$this->teacherModel = new TeacherModel();
		$this->relationModel = new RelationModel();
		$this->scheduleModel = new ScheduleModel();
	}

	public function index($class_id)
	{
		$data = [
			'title' => 'Jadwal Pelajaran',
			'monday1' => $this->scheduleModel->get_schedule_day_class('Mon',$class_id,'1'),
			'tuesday1' => $this->scheduleModel->get_schedule_day_class('Tue',$class_id,'1'),
			'wednesday1' => $this->scheduleModel->get_schedule_day_class('Wed',$class_id,'1'),
			'thursday1' => $this->scheduleModel->get_schedule_day_class('Thu',$class_id,'1'),
			'friday1' => $this->scheduleModel->get_schedule_day_class('Fri',$class_id,'1'),

			'monday2' => $this->scheduleModel->get_schedule_day_class('Mon',$class_id,'2'),
			'tuesday2' => $this->scheduleModel->get_schedule_day_class('Tue',$class_id,'2'),
			'wednesday2' => $this->scheduleModel->get_schedule_day_class('Wed',$class_id,'2'),
			'thursday2' => $this->scheduleModel->get_schedule_day_class('Thu',$class_id,'2'),
			'friday2' => $this->scheduleModel->get_schedule_day_class('Fri',$class_id,'2'),

			'relations' => $this->relationModel->get_relation($class_id),
			'subjects' => $this->subjectModel->get_subject(),
			'teachers' => $this->teacherModel->get_teacher(),
			'classgroup' => $this->ClassgroupModel->classgroup()
		];

		return view('schedule/index', $data);
	}

	public function create()
	{
		$data = [
			'day' => $this->request->getPost('day'),
			'relation_id' => $this->request->getPost('relation'),
			'time_start' => $this->request->getPost('time_start'),
			'time_finish' => $this->request->getPost('time_finish'),
			'time_of' => $this->request->getPost('time_of'),
			'week' => $this->request->getPost('week')
		];

		$this->scheduleModel->save($data);
		session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url($this->request->getPost('uri')));
	}

	public function update()
	{
		$data = [
			'id' => $this->request->getPost('id'),
			'day' => $this->request->getPost('day'),
			'relation_id' => $this->request->getPost('relation'),
			'time_start' => $this->request->getPost('time_start'),
			'time_finish' => $this->request->getPost('time_finish'),
			'time_of' => $this->request->getPost('time_of')
		];

		$this->scheduleModel->save($data);
		session()->setFlashdata('pesan', 'Data berhasil diubah');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url($this->request->getPost('uri')));
	}

	public function delete()
	{
		$id = $this->request->getPost('class_id');
		$this->ClassgroupModel->delete($id);
		session()->setFlashdata('pesan', 'Data berhasil dihapus');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('classgroup/index'));
	}

}




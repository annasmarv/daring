<?php namespace App\Controllers\Learn;
use App\Controllers\BaseController;
use Irsyadulibad\DataTables\DataTables;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use App\Models\TasksModel;
use App\Models\ClassesModel;
use App\Models\Data\ClassgroupModel;
use App\Models\Learn\UsertaskModel;
use App\Models\Learn\PlanModel;
use App\Models\Data\StudentModel;
use App\Models\ScheduleModel;
use App\Models\WeekModel;
use App\Models\FeedbackModel;

class Plan extends BaseController
{
	protected $db, $builder, $studentModel, $classesModel, $taskModel, $usertaskModel, $weekModel, $scheduleModel, $planModel;

	public function __construct()
	{
		$this->db = \Config\Database::connect();
        $this->builder = $this->db;
        $this->studentModel = new StudentModel;
        $this->classesModel = new ClassesModel;
        $this->classModel = new ClassgroupModel;
        $this->taskModel = new TasksModel;
        $this->usertaskModel = new UsertaskModel;
        $this->scheduleModel = new ScheduleModel;
        $this->weekModel = new WeekModel;
        $this->planModel = new PlanModel;
        $this->feedModel = new FeedbackModel;
	}

	public function index($id)
	{
		$data = [
			'title' => 'Rencana Pembelajaran',
			'subjects' => $this->classesModel->get_subject(user()->id),
			'classes' => $this->classesModel->get_class(user()->id),
			'plan' => $this->planModel->get_learn_plan($id),
			'feedback' => $this->feedModel->get_feedback('plan', $id)
		];

		return view('journal/planupdate', $data);
	}

	public function review($id)
	{	
		$data = [
			'title' => 'Rencana Pembelajaran',
			'classes' => $this->classModel->classgroup(),
			'plan' => $this->planModel->get_learn_plan($id),
			'feedback' => $this->feedModel->get_feedback('plan', $id)
		];

		return view('journal/reviewplan', $data);
	}

	public function get_learn_plan($id)
	{
		if (in_groups('teacher')) {
			return DataTables::use('tbl_learn_plan')
				->select('tbl_learn_plan.id as pid, tbl_learn_plan.title, tbl_learn_plan.percent, tbl_learn_plan.subject_id, tbl_subjects.subject_name as sbjk')
				 ->join('tbl_subjects', 'tbl_subjects.id = tbl_learn_plan.subject_id')
				 ->where(['tbl_learn_plan.week_id' => $id, 'tbl_learn_plan.teacher_id' => user()->id])
				->make(true);
		}elseif (in_groups('admin')) {
			return DataTables::use('tbl_learn_plan')
				->select('tbl_learn_plan.id as pid, tbl_learn_plan.title, tbl_learn_plan.percent, tbl_learn_plan.subject_id, tbl_subjects.subject_name as sbjk, users.fullname as teacher_name')
				 ->join('tbl_subjects', 'tbl_subjects.id = tbl_learn_plan.subject_id')
				 ->join('users', 'users.id = tbl_learn_plan.teacher_id')
				->make(true);
		}
	}

	public function create($weekmeet_id)
	{
		$class_group_arr = $this->request->getPost('class_group_id');
		$class_group_id = implode(',', $class_group_arr);
		$goal = $this->request->getPost('goal');
		$activity = $this->request->getPost('activity');
		$asesmen = $this->request->getPost('asesmen');

		$jumlah = str_word_count($goal)+str_word_count($activity)+str_word_count($asesmen);
		$percent = persen($jumlah);

		$data = [
			'week_id' => $weekmeet_id,
			'subject_id' => $this->request->getPost('subject_id'),
			'class_group_id' => $class_group_id,
			'title' => $this->request->getPost('title'),
			'alokasi_jp' => $this->request->getPost('alokasi'),
			'goal' => $this->request->getPost('goal'),
			'activity' => $activity,
			'asesmen' => $asesmen,
			'percent' => $percent,
			'teacher_id' => user()->id
		];

		$this->planModel->save($data);
		session()->setFlashdata('pesan', 'Data berhasil diubah');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('learn/journal/plans/'.$weekmeet_id));
	}

	
	public function update($id)
	{
		$goal = $this->request->getPost('goal');
		$activity = $this->request->getPost('activity');
		$asesmen = $this->request->getPost('asesmen');

		$jumlah = str_word_count($goal)+str_word_count($activity)+str_word_count($asesmen);
		$percent = persen($jumlah);

		$class_group_arr = $this->request->getPost('class_group_id');
		$class_group_id = implode(',', $class_group_arr);

		$data = [
			'id' => $id,
			'subject_id' => $this->request->getPost('subject_id'),
			'class_group_id' => $class_group_id,
			'title' => $this->request->getPost('title'),
			'alokasi_jp' => $this->request->getPost('alokasi'),
			'goal' => $this->request->getPost('goal'),
			'activity' => $activity,
			'asesmen' => $asesmen,
			'percent' => $percent
		];

		$this->planModel->save($data);
		session()->setFlashdata('pesan', 'Data berhasil diubah');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('learn/plan/index/'.$id));
	}

	public function delete()
	{
		$this->planModel->delete($this->request->getPost('plan_id'));
		session()->setFlashdata('pesan', 'Data berhasil dihapus');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url($this->request->getPost('uri')));		
	}

	public function pdf($id)
	{
		// $jurnal = $this->jurnalModel->get_journal_by_id($id);
		$data = [
			'title' => 'Rencana Pembelajaran',
			'subjects' => $this->classesModel->get_subject(user()->id),
			'classes' => $this->classesModel->get_class(user()->id),
			'plan' => $this->planModel->get_learn_plan($id)
		];

		$dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml(view('journal/ppdf', $data));
        // $dompdf->setPaper('A4', 'potrait');
        $dompdf->setPaper(array(0,0,609.4488,935.433), 'potrait');
        $dompdf->render();
        $dompdf->stream('document.pdf', array('Attachment' => false));
	}

	//--------------------------------------------------------------------

}
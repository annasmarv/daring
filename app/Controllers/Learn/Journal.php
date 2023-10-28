<?php namespace App\Controllers\Learn;
use App\Controllers\BaseController;
use Irsyadulibad\DataTables\DataTables;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use App\Models\TasksModel;
use App\Models\ClassesModel;
use App\Models\Learn\UsertaskModel;
use App\Models\Learn\PlanModel;
use App\Models\Data\StudentModel;
use App\Models\ScheduleModel;
use App\Models\WeekModel;
use App\Models\JournalModel;
use App\Models\AttendanceModel;
use App\Models\FeedbackModel;

class Journal extends BaseController
{
	protected $db, $builder, $studentModel, $classesModel, $taskModel, $usertaskModel, $weekModel, $scheduleModel, $planModel, $jurnalModel, $attendanceModel;

	public function __construct()
	{
		$this->db = \Config\Database::connect();
        $this->builder = $this->db;
        $this->studentModel = new StudentModel;
        $this->classesModel = new ClassesModel;
        $this->taskModel = new TasksModel;
        $this->usertaskModel = new UsertaskModel;
        $this->scheduleModel = new ScheduleModel;
        $this->weekModel = new WeekModel;
        $this->planModel = new PlanModel;
        $this->jurnalModel = new JournalModel;
        $this->attendanceModel = new AttendanceModel;
        $this->feedModel = new FeedbackModel;
	}

	public function index()
	{			
		$data = [
			'title' => 'Perencanaan dan Jurnal Mengajar',
			'monday1' => $this->scheduleModel->get_schedule_day_teacher('Mon', user()->id, '1'),
			'tuesday1' => $this->scheduleModel->get_schedule_day_teacher('Tue', user()->id, '1'),
			'wednesday1' => $this->scheduleModel->get_schedule_day_teacher('Wed', user()->id, '1'),
			'thursday1' => $this->scheduleModel->get_schedule_day_teacher('Thu', user()->id, '1'),
			'friday1' => $this->scheduleModel->get_schedule_day_teacher('Fri', user()->id, '1'),
			'monday2' => $this->scheduleModel->get_schedule_day_teacher('Mon', user()->id, '2'),
			'tuesday2' => $this->scheduleModel->get_schedule_day_teacher('Tue', user()->id, '2'),
			'wednesday2' => $this->scheduleModel->get_schedule_day_teacher('Wed', user()->id, '2'),
			'thursday2' => $this->scheduleModel->get_schedule_day_teacher('Thu', user()->id, '2'),
			'friday2' => $this->scheduleModel->get_schedule_day_teacher('Fri', user()->id, '2'),
			'weeks' => $this->weekModel->get_week_learning_schedule_teacher()
		];
		
		return view('journal/index', $data);
	}

	public function plans($weekmeet_id)
	{
		$data = [
			'title' => 'Rencana Pembelajaran'
		];

		return view('journal/plans', $data);
	}

	public function plan($id)
	{
		$data = [
			'title' => 'Buat Rencana Pembelajaran',
			'subjects' => $this->classesModel->get_subject(user()->id),
			'classes' => $this->classesModel->get_class(user()->id),
		];

		return view('journal/plan', $data);
	}

	public function create($relation_id,$weekmeet_id,$jurnal_key,$schedule_id)
	{
		$jurnal = $this->jurnalModel->get_journal_by_key($jurnal_key);
		if(empty($jurnal)){
			$define = [
				'relation_id' => $relation_id,
				'week_id' => $weekmeet_id,
				'journal_key' => $jurnal_key,
				'schedule_id' => $schedule_id,
				'note' => '',
				'reflection' => '',
				'teacher_id' => user()->id
			];

			$this->jurnalModel->save($define);

	        $id = $this->jurnalModel->getInsertID(); 
	        $relation = $this->classesModel->get_relation_detail($relation_id);
	        $student = $this->studentModel->get_student_class($relation['class_group_id']);

	        $data = array();
	        foreach ($student as $row) {
	            $das['journal_id'] = $id;
	            $das['user_id'] = $row['id'];
	            $das['present'] = 'H';
	            $das['yearmonth'] = date('Y-m');
	            $das['created_at'] = date('Y-m-d H:i:s');
	            $das['updated_at'] = date('Y-m-d H:i:s');
	            $data[] = $das;  
	        }

	        $this->attendanceModel->save_batch($data);

	        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
	        session()->setFlashdata('type', 'success');
	        return redirect()->to(base_url('/learn/journal/create/'.$relation_id.'/'.$weekmeet_id.'/'.$jurnal_key.'/'.$schedule_id));
		}else{
			$data = [
				'title' => 'Jurnal Mengajar',
				'jurnal' => $jurnal,
				'students' => $this->attendanceModel->get_attendace($jurnal['id']),
				'feedback' => $this->feedModel->get_feedback('journal', $jurnal['id'])
			];
			
			return view('journal/create', $data);
		}
	}

	public function update($id)
	{
		$note = $this->request->getPost('note');
		$reflection = $this->request->getPost('reflection');

		$jumlah = str_word_count($note)+str_word_count($reflection);
		$percent = persen($jumlah);
		$data = [
			'id' => $id,
			'note' => $note,
			'reflection' => $reflection,
			'percent' => $percent
		];

		$this->jurnalModel->save($data);
			session()->setFlashdata('pesan', 'Data berhasil diubah');
			session()->setFlashdata('type', 'success');
			return redirect()->to(base_url($this->request->getPost('uri')));
	}

	public function pdf($id)
	{
		$jurnal = $this->jurnalModel->get_journal_by_id($id);
		$data = [
			'title' => 'Jurnal Mengajar',
			'journal' => $jurnal,
			'students' => $this->attendanceModel->get_attendace($jurnal['id'])
		];

		$dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml(view('journal/pdf', $data));
        // $dompdf->setPaper('A4', 'potrait');
        $dompdf->setPaper(array(0,0,609.4488,935.433), 'potrait');
        $dompdf->render();
        $dompdf->stream('document.pdf', array('Attachment' => false));
	}

	public function get_journal_learn()
	{
		if (in_groups('teacher')) {
			return DataTables::use('tbl_journal')
				->select('tbl_journal.id as jid, tbl_journal.week_id, tbl_class_group.class_group_name as classname, tbl_subjects.subject_name as sbjk, tbl_journal.created_at as tgl_buat')
				 ->join('mpd_classes', 'mpd_classes.id = tbl_journal.relation_id')
				 ->join('tbl_subjects', 'tbl_subjects.id = mpd_classes.subject_id')
				 ->join('tbl_class_group', 'tbl_class_group.id = mpd_classes.class_group_id')
				 ->where(['tbl_journal.teacher_id' => user()->id])
				->make(true);
		}elseif (in_groups('admin')) {
			return DataTables::use('tbl_journal')
				->select('tbl_journal.id as jid, tbl_journal.week_id, tbl_class_group.class_group_name as classname, tbl_subjects.subject_name as sbjk, users.fullname as teacher_name, tbl_journal.created_at as tgl_buat')
				 ->join('mpd_classes', 'mpd_classes.id = tbl_journal.relation_id')
				 ->join('tbl_subjects', 'tbl_subjects.id = mpd_classes.subject_id')
				 ->join('tbl_class_group', 'tbl_class_group.id = mpd_classes.class_group_id')
				 ->join('users', 'users.id = tbl_journal.teacher_id')
				->make(true);
		}
	}

	public function review($id)
	{
		$jurnal = $this->jurnalModel->get_journal_by_id($id);
		$data = [
			'title' => 'Jurnal Mengajar',
			'jurnal' => $jurnal,
			'students' => $this->attendanceModel->get_attendace($jurnal['id']),
			'feedback' => $this->feedModel->get_feedback('journal', $id)
		];

		return view('journal/reviewjournal', $data);
	}

	//--------------------------------------------------------------------

}
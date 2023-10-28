<?php namespace App\Controllers\Learn;

use App\Controllers\BaseController;
use Irsyadulibad\DataTables\DataTables;
use App\Models\Learn\InteractiveModel;
use App\Models\Learn\TaskModel;
use App\Models\Learn\MeetModel;
use App\Models\ClassesModel;
use App\Models\Data\StudentModel;
use App\Models\Data\ModulModel;

class Meet extends BaseController
{
	public function __construct()
	{
		$this->interModel = new InteractiveModel();
		$this->meetModel = new MeetModel();
		$this->student = new StudentModel();
		$this->modulModel = new ModulModel();
		$this->taskModel = new TaskModel();
	}

	public function index()
	{
		$classes = new ClassesModel;
		$data = [
			'title' => 'Topik',
			'subjects' => $classes->get_subject(user()->id),
			'classes' => $classes->get_class(user()->id),
			'modul' => $this->modulModel->get_modul_teacher(),
			'inters' => $this->interModel->get_inter_teacher(),
			'tasks' => $this->taskModel->get_task_teacher()
		];
		return view('learn/meet', $data);
	}

	public function ubah($id)
	{
		$classes = new ClassesModel;
		$data = [
			'subjects' => $classes->get_subject(user()->id),
			'title' => 'Ubah Data Pertemuan',
			'classes' => $classes->get_class(user()->id),
			'modul' => $this->modulModel->get_modul_teacher(),
			'inters' => $this->interModel->get_inter_teacher(),
			'tasks' => $this->taskModel->get_task_teacher(),
			'detail' => $this->meetModel->get_meet_detail($id)->getRow()
		];

		return view('learn/meet_ubah', $data);;
	}
	
	public function get_meet()
	{
		$role = user()->roles;
		if ($role == 'admin') {
			$where = "1";
			$user = 1;
		}else{
			$where = "mpd_meet.teacher_id";
			$user = user()->id;
		}

		if (in_groups('teacher')) {
			return DataTables::use('mpd_meet')
				->select('mpd_meet.id as meetid, mpd_meet.meet_name as meetname, mpd_meet.subject_id, mpd_meet.class_group_id, mpd_meet.modul_id, mpd_meet.task_id, mpd_meet.interaktif_id, mpd_meet.status, tbl_subjects.subject_name as sbjk, tbl_class_group.class_group_name as class, mpd_modul.title as modul, mpd_task.task_name as task, mpd_discuss.title as discuss', 'LEFT')
				->join('tbl_subjects', 'tbl_subjects.id = mpd_meet.subject_id', 'LEFT')
				->join('tbl_class_group', 'tbl_class_group.id = mpd_meet.class_group_id', 'LEFT')
				->join('mpd_modul', 'mpd_modul.id = mpd_meet.modul_id', 'LEFT')
				->join('mpd_task', 'mpd_task.id = mpd_meet.task_id', 'LEFT')
				->join('mpd_discuss', 'mpd_discuss.id = mpd_meet.interaktif_id', 'LEFT')
				->where([$where => $user])
				->make(true);
		}elseif (in_groups('admin')) {
			return DataTables::use('mpd_meet')
				->select('mpd_meet.id as meetid, mpd_meet.meet_name as meetname, mpd_meet.subject_id, mpd_meet.class_group_id, mpd_meet.modul_id, mpd_meet.task_id, mpd_meet.interaktif_id, mpd_meet.status, tbl_subjects.subject_name as sbjk, tbl_class_group.class_group_name as class, mpd_modul.title as modul, mpd_task.task_name as task, mpd_discuss.title as discuss', 'LEFT')
				->join('tbl_subjects', 'tbl_subjects.id = mpd_meet.subject_id', 'LEFT')
				->join('tbl_class_group', 'tbl_class_group.id = mpd_meet.class_group_id', 'LEFT')
				->join('mpd_modul', 'mpd_modul.id = mpd_meet.modul_id', 'LEFT')
				->join('mpd_task', 'mpd_task.id = mpd_meet.task_id', 'LEFT')
				->join('mpd_discuss', 'mpd_discuss.id = mpd_meet.interaktif_id', 'LEFT')
				->make(true);
		}
	}

	public function create()
	{
		$data = [
			'meet_name'		=> $this->request->getPost('name'), 
			'subject_id'	=> $this->request->getPost('subject'), 
			'class_group_id'=> $this->request->getPost('class'), 
			'modul_id'		=> $this->request->getPost('modul'), 
			'task_id'		=> $this->request->getPost('task'), 
			'interaktif_id'	=> $this->request->getPost('inter'), 
			'status'		=> $this->request->getPost('status'), 
			'teacher_id'	=> user()->id
		];

		$this->meetModel->save($data);
		session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('learn/meet'));
	}

	public function update()
	{
		$data = [
			'id'			=> $this->request->getPost('id'),
			'meet_name'		=> $this->request->getPost('meet_name'), 
			'subject_id'	=> $this->request->getPost('subject'), 
			'class_group_id'=> $this->request->getPost('class'), 
			'modul_id'		=> $this->request->getPost('modul'), 
			'task_id'		=> $this->request->getPost('task'), 
			'interaktif_id'	=> $this->request->getPost('inter'), 
			'status'		=> $this->request->getPost('status'), 
			'teacher_id'	=> user()->id
		];

		$this->meetModel->save($data);
		session()->setFlashdata('pesan', 'Data berhasil diubah');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('learn/meet'));
	}

	public function delete()
	{
		$id = $this->request->getPost('meet_id');
		$this->meetModel->delete($id);
		session()->setFlashdata('pesan', 'Data berhasil dihapus');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('learn/meet'));
	}

	public function status()
	{
		if ($this->request->getPost('status') == 0) {
			$status = '1';
		}else{
			$status = '0';
		}
		$data = [
			'id' => $this->request->getPost('id'),
			'status' => $status
		];

		$this->meetModel->save($data);
		session()->setFlashdata('pesan', 'Data berhasil diubah');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('learn/meet'));
	}

	public function show($id)
    {
        if ($this->request->isAJAX()) {
            $result = $this->meetModel->find($id);
            if ($result) {
                $this->output['success'] = true;
                $this->output['message']  = 'Data ditemukan';
                $this->output['data']   = $result;
            }
            echo json_encode($this->output);
        }
    }

    public function viewPdf($meet_id,$class_group_id)
    {
    	helper('indo');
        $meet = $this->meetModel->get_meet_detail_agenda($meet_id)->getRow();
        $data = [
            'meet' => $meet,
            'orang' => $this->student->get_meet_agenda($meet_id,$class_group_id),
        ];

        return view('export/meet', $data);
    }

    public function pdf($meet_id,$class_group_id)
    {
    	helper('indo');
        $meet = $this->meetModel->get_meet_detail_agenda($meet_id)->getRow();
        $data = [
            'meet' => $meet,
            'orang' => $this->student->get_meet_agenda($meet_id,$class_group_id),
        ];
   
        $dompdf = new \Dompdf\Dompdf();
        // $dompdf->isRemoteEnabled(true); 
        $dompdf->loadHtml(view('export/meet', $data));
        // $dompdf->load_html_file('img/1609853179_1e66fb06ccdaf3ee3759.png');
        // $dompdf->setPaper('A4', 'potrait');
        $dompdf->setPaper(array(0,0,609.4488,935.433), 'potrait');
        $dompdf->render();
        $dompdf->stream('document.pdf', array('Attachment' => false));
    }

    public function get_task_meet()
    {
    	$postData = [
    		'classgroup_id' => $this->request->getPost('class_id'),
    		'subject_id' => $this->request->getPost('subject_id')
    	];

    	$data = $this->taskModel->get_task_teacher_class_subject($postData);

    	echo json_encode($data);
    }

	//--------------------------------------------------------------------

}

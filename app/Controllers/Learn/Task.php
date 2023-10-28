<?php namespace App\Controllers\Learn;

use App\Controllers\BaseController;
use Irsyadulibad\DataTables\DataTables;
use App\Models\Data\StudentModel;
use App\Models\Learn\TaskModel;
use App\Models\Learn\UsertaskModel;
use App\Models\JointaskModel;
use App\Models\ClassesModel;
use App\Models\QuestbankModel;
use App\Models\QuestModel;
use App\Models\AnswerModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Task extends BaseController
{
	protected $taskModel;
	protected $usertaskModel;

	public function __construct()
	{
		$this->db      = \Config\Database::connect();
		$this->taskModel = new TaskModel();
		$this->studentModel = new StudentModel;
		$this->questModel = new QuestModel();
		$this->answerModel = new AnswerModel();
		$this->jointaskModel = new JointaskModel();
		$this->usertaskModel = new UsertaskModel();
	}

	public function index()
	{
		$classes = new ClassesModel;
		$questbank = new QuestbankModel;
		$data = [
			'title' => 'Tugas Belajar',
			'subjects' => $classes->get_subject(user()->id),
			'classes' => $classes->get_class(user()->id),
			'questbank' => $questbank->get_quest_bank_teacher(user()->id)
		];

		return view('task/index', $data);
	}

	public function detail($id)
	{
		$data = [
			'title' => 'Detail Tugas',
			'userlists' => $this->usertaskModel->get_user_task($id),
			'detail' => $this->taskModel->get_task_detail($id)->getRow()
		];

		return view('task/detail', $data);;
	}

	public function ubah($id)
	{
		$classes = new ClassesModel;
		$questbank = new QuestbankModel;
		$data = [
			'subjects' => $classes->get_subject(user()->id),
			'questbank' => $questbank->get_quest_bank_teacher(user()->id),
			'classes' => $classes->get_class(user()->id),
			'title' => 'Ubah Tugas',
			'detail' => $this->taskModel->get_task_detail($id)->getRow()
		];

		return view('task/update', $data);
	}
	
	public function get_task($periodyear = false)
	{
		if ($periodyear == false) {
			$periodyear = period()->id;
		}

		$role = user()->roles;

		if ($role == 'admin') {
			$where = "1";
			$user = 1;
		}else{
			$where = "mpd_task.teacher_id";
			$user = user()->id;
		}

		if (in_groups('teacher')) {
			return DataTables::use('mpd_task')
				->select('mpd_task.id as taskid, mpd_task.task_name, mpd_task.subject_id, mpd_task.class_group_id, mpd_task.task_date_start, mpd_task.task_date_finish, mpd_task.task_status, tbl_subjects.subject_name as sbjk, tbl_class_group.class_group_name as class')
				 ->join('tbl_subjects', 'tbl_subjects.id = mpd_task.subject_id')
				 ->join('tbl_class_group', 'tbl_class_group.id = mpd_task.class_group_id')
				 ->where([$where => $user, 'periodyear' => $periodyear])
				->make(true);
		}elseif (in_groups('admin')) {
			return DataTables::use('mpd_task')
				->select('mpd_task.id as taskid, mpd_task.task_name, mpd_task.subject_id, mpd_task.class_group_id, mpd_task.task_date_start, mpd_task.task_date_finish, mpd_task.task_status, tbl_subjects.subject_name as sbjk, tbl_class_group.class_group_name as class')
				 ->join('tbl_subjects', 'tbl_subjects.id = mpd_task.subject_id')
				 ->join('tbl_class_group', 'tbl_class_group.id = mpd_task.class_group_id')
				 ->where(['periodyear' => $periodyear])
				->make(true);
		}
	}

	public function create()
	{
		$quest_bank_id = $this->request->getPost('quest_bank_id');
		$quest_total = $this->request->getPost('quest_total');
		$data = [
			'task_name'			=> $this->request->getPost('task_name'), 
			'class_group_id'	=> $this->request->getPost('class'), 
			'subject_id'		=> $this->request->getPost('subject'), 
			'quest_bank_id'		=> $this->request->getPost('quest_bank_id'), 
			'quest_total'		=> $this->request->getPost('quest_total'), 
			'task_date_start'	=> $this->request->getPost('start'), 
			'task_date_finish'	=> $this->request->getPost('finish'), 
			// 'limit_work'		=> $this->request->getPost('limit'), 
			'task_status'		=> $this->request->getPost('status'), 
			'random'			=> $this->request->getPost('random'),
			'teacher_id'		=> user()->id,
			'periodyear'		=> period()->id
		];

		$this->taskModel->save($data);

		$task_id = $this->taskModel->getInsertID();
		$student = $this->studentModel->get_student_class($this->request->getPost('class'));

	    $arr = array();
	    foreach ($student as $row) {
	        $das['task_id'] = $task_id;
	        $das['user_id'] = $row['id'];
	        $das['N2'] = 0;
	        $das['date'] = date('Y-m-d');
	        $das['status'] = 0;
	        $das['chance'] = 1;
	        $das['date_task'] = date('Y-m-d H:i:s');
	        $das['last_update'] = date('Y-m-d H:i:s');
	        $arr[] = $das;  
	    }

	    $this->jointaskModel->save_batch($arr);

	    // $jointaskdata = $this->usertaskModel->get_user_task($task_id);
		// $detailtask = $this->taskModel->get_task_detail($task_id)->getRow();

		// $questtotal = $detailtask->quest_total;
		$soal = $this->questModel->get_quest_limit($quest_bank_id,$quest_total);
		
		$insert_soal = array();
		foreach ($student as $row) {
			for ($i=0; $i <$quest_total ; $i++) { 
				$data_soal['sort'] = $i;
				$data_soal['number'] = $soal[$i]['number'];
				$data_soal['point'] = $soal[$i]['point'];
				$data_soal['task_id'] = $task_id;
				$data_soal['quest_type'] = $soal[$i]['type'];
				$data_soal['answer_date'] = date('Y-m-d H:i:s');
				$data_soal['answer_key'] = $soal[$i]['quest_keys'];
				$data_soal['user_id'] = $row['id'];
			$insert_soal[] = $data_soal;
			}
		}

		$this->answerModel->save_batch($insert_soal);
		session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('learn/task'));
	}

	public function saven1($task_id)
	{
		$id = $this->request->getPost('id');
        $N2 = $this->request->getPost('N2');
		$result = array();
            foreach ($id as $key => $val) {
                $result[] = [
                    'id' => $id[$key],
                    'N2' => $N2[$key]
                ];
            }

        $builder = $this->db->table('mpd_join_task');
        $builder->updateBatch($result, 'id');

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('learn/task/'.$task_id));
	}

	public function update()
	{
		$data = [
			'id'				=> $this->request->getPost('id'),
			'task_name'			=> $this->request->getPost('task_name'), 
			'class_group_id'	=> $this->request->getPost('class'), 
			'subject_id'		=> $this->request->getPost('subject'), 
			'quest_bank_id'		=> $this->request->getPost('quest_bank_id'), 
			'quest_total'		=> $this->request->getPost('quest_total'), 
			'task_date_start'	=> $this->request->getPost('start'), 
			'task_date_finish'	=> $this->request->getPost('finish'), 
			'task_status'		=> $this->request->getPost('status'), 
			'random'			=> $this->request->getPost('random'),
			'teacher_id'		=> user()->id
		];
		
		$this->taskModel->save($data);
		session()->setFlashdata('pesan', 'Data berhasil diubah');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('learn/task'));
	}

	public function delete()
	{
		$id = $this->request->getPost('task_id');
		$this->taskModel->delete($id);
		session()->setFlashdata('pesan', 'Data berhasil dihapus');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('learn/task'));
	}

	public function reload($task_id)
	{
		$jointaskdata = $this->usertaskModel->get_user_task($task_id);
		$detailtask = $this->taskModel->get_task_detail($task_id)->getRow();

		$questtotal = $detailtask->quest_total;
		$soal = $this->questModel->get_quest_limit($detailtask->quest_bank_id,$detailtask->quest_total);
		
		$insert_soal = array();
		foreach ($jointaskdata as $row) {
			for ($i=0; $i <$questtotal ; $i++) { 
				$data_soal['sort'] = $i;
				$data_soal['number'] = $soal[$i]['number'];
				$data_soal['point'] = $soal[$i]['point'];
				$data_soal['task_id'] = $task_id;
				$data_soal['quest_type'] = $soal[$i]['type'];
				$data_soal['answer_date'] = date('Y-m-d H:i:s');
				$data_soal['answer_key'] = $soal[$i]['quest_keys'];
				$data_soal['user_id'] = $row['user_id'];
			$insert_soal[] = $data_soal;
			}
		}

		$this->answerModel->save_batch($insert_soal);
		return redirect()->to(base_url('learn/task/'.$task_id));
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
			'task_status' => $status
		];

		$this->taskModel->save($data);
		session()->setFlashdata('pesan', 'Data berhasil diubah');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('learn/task'));
	}

	public function show($id)
    {
        if ($this->request->isAJAX()) {
            $result = $this->taskModel->find($id);
            if ($result) {
                $this->output['success'] = true;
                $this->output['message']  = 'Data ditemukan';
                $this->output['data']   = $result;
            }
            echo json_encode($this->output);
        }
    }  

    public function importnilai($id)
    {
        $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        if(isset($_FILES['upload']['name']) && in_array($_FILES['upload']['type'], $file_mimes)) {
             
        	$arr_file = explode('.', $_FILES['upload']['name']);
        	$extension = end($arr_file);
                
            if('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
             
            $spreadsheet = $reader->load($_FILES['upload']['tmp_name']);
                 
            $sheetData = $spreadsheet->getActiveSheet()->toArray();

            for($i = 1;$i < count($sheetData);$i++)
            {
                $user_id 	= $sheetData[$i]['1'];
                $nilai 		= $sheetData[$i]['3'];

                $ar[] = array(                          
                    'user_id' => $user_id,
                    'N2'	  => $nilai,
                );
            }

            $builder = $this->db->table('mpd_join_task');
	        $builder->updateBatch($ar, 'user_id');

	        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
			session()->setFlashdata('type', 'success');
            return redirect()->to(base_url('learn/task/'.$id));
        }
    }

	public function temp($id)
    {
        $result_task = $this->usertaskModel->get_user_task($id);
        
        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'USER ID')
            ->setCellValue('C1', 'Nama Siswa')
            ->setCellValue('D1', 'Nilai');

        $column = 2;
        $no = 1;
        foreach ($result_task as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $no++)
                ->setCellValue('B' . $column, $data['user_id'])
                ->setCellValue('C' . $column, $data['fullname'])
                ->setCellValue('D' . $column, '');
            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'Template Nilai';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit();
    }

    public function export_excel_rekap_tugas($id)
    {
        $result_task = $this->usertaskModel->get_user_task($id);
        $detail = $this->taskModel->get_task_detail($id)->getRow();
        //$detail = $this->ujianModel->get_ujian_detail($id)->getRow();  

        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'NISN')
            ->setCellValue('C1', 'Nama Siswa')
            ->setCellValue('D1', 'Jumlah Soal')
            ->setCellValue('E1', 'Nilai 1')
            ->setCellValue('F1', 'Nilai 2')
            ->setCellValue('G1', 'Nilai Akhir');

        $column = 2;
        // tulis data mobil ke cell
        $no = 1;
        $count = count($result_task);
		$count1 = $count+1;
		$count2 = $count+2;
		$count3 = $count+3;
		$count4 = $count+4;

        foreach ($result_task as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $no++)
                ->setCellValue('B' . $column, $data['username'])
                ->setCellValue('C' . $column, $data['fullname'])
                ->setCellValue('D' . $column, '')
                ->setCellValue('E' . $column, $data['NA'])
                ->setCellValue('F' . $column, $data['N2'])
                ->setCellValue('G' . $column, $data['NA']+$data['N2'])
            ->setCellValue('A'.$count2, 'RATA-RATA')
			->setCellValue('G'.$count2, '=AVERAGE(G2:G'.$count1.')')
			->setCellValue('A'.$count3, 'NILAI TERENDAH')
			->setCellValue('G'.$count3, '=MIN(G2:G'.$count1.')')
			->setCellValue('A'.$count4, 'NILAI TERTINGGI')
			->setCellValue('G'.$count4, '=MAX(G2:G'.$count1.')');
            $column++;
        }
       
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Rekap Nilai - '.$detail->task_name;

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit();
    }

	//--------------------------------------------------------------------

}

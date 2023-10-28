<?php namespace App\Controllers;

use App\Controllers\BaseController;
use Irsyadulibad\DataTables\DataTables;
use App\Models\Cbt\UjianModel;
use App\Models\Cbt\JawabanModel;
use App\Models\Cbt\SiswaujianModel;
use App\Models\Cbt\Jawaban2Model;
use App\Models\Cbt\Siswaujian2Model;
use App\Models\ClassesModel;
use App\Models\QuestbankModel;
use App\Models\QuestModel;
use App\Models\TaskTypeModel;
use App\Models\Data\StudentModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Ujian extends BaseController
{
	protected $ujianModel;
	protected $userujianModel;
	protected $jawabanModel;
	protected $studentModel;
	protected $questModel;
	protected $classesModel;

	public function __construct()
	{
		$this->db      = \Config\Database::connect();
		$this->siswaujianModel = new SiswaujianModel();
		$this->siswaujian2Model = new Siswaujian2Model();
		$this->ujianModel = new UjianModel();
		$this->jawabanModel = new JawabanModel();
		$this->jawaban2Model = new Jawaban2Model();
		$this->studentModel = new StudentModel();
		$this->questModel = new QuestModel();
		$this->taskTypeModel = new TaskTypeModel();
		$this->classesModel = new ClassesModel();
	}

	public function index()
	{
		$classes = new ClassesModel;
		$questbank = new QuestbankModel;
		$data = [
			'title' => 'Ujian CBT',
			'subjects' => $classes->get_subject(),
			'classes' => $classes->get_class(),
			'questbank' => $questbank->get_quest_bank_teacher(user()->id)
		];

		return view('cbt/index', $data);
	}

	public function cbt()
	{
		$classes = new ClassesModel;
		$questbank = new QuestbankModel;
		if ($this->request->getGet('tasktype')) {
			$filter = $this->request->getGet('tasktype');
		}else{
			$filter = 5;
		}
		$data = [
			'title' => 'Ujian CBT',
			'subjects' => $classes->get_subject(),
			'classes' => $classes->get_class(),
			'questbank' => $questbank->get_quest_bank_teacher(),
			'tasktypes' => $this->taskTypeModel->getData()->getResultArray(),
			'filter' => $filter
		];

		return view('cbt/ujian', $data);
	}

	public function detail($id)
	{
		$detail = $this->ujianModel->get_ujian_detail($id)->getRow();
		$data = [
			'title' => 'Detail Ujian',
			'userlists' => $this->siswaujianModel->get_user_task($id),
			'detail' => $detail
		];

		return view('cbt/detail', $data);;
	}

	public function examview($id)
	{
		$detail = $this->ujianModel->get_ujian_detail($id)->getRow();
		$data = [
			'title' => 'Detail Ujian',
			'userlists' => $this->siswaujian2Model->get_user_task($id),
			'studentclass' => $this->studentModel->get_student_gen_ujian($id,$detail->class_group_id),
			'detail' => $detail
		];

		return view('cbt/examview', $data);;
	}

	public function reset($id)
	{
		$data = [
			'title' => 'Detail Ujian',
			'userlists' => $this->siswaujianModel->get_user_task($id),
			'detail' => $this->ujianModel->get_ujian_detail($id)->getRow()
		];

		return view('cbt/reset', $data);;
	}

	public function ubah($id)
	{
		$classes = new ClassesModel;
		$questbank = new QuestbankModel;
		$data = [
			'subjects' => $classes->get_subject(),
			'classes' => $classes->get_class(),
			'questbank' => $questbank->get_quest_bank_teacher(),
			'title' => 'Ubah Jadwal Ujian',
			'detail' => $this->ujianModel->get_ujian_detail($id)->getRow()
		];

		return view('cbt/cbt_ubah', $data);;
	}
	
	public function get_ujian($periodyear = false)
	{
		if ($periodyear == false) {
			$periodyear = period()->id;
		}

		$role = user()->roles;
		
		if ($role == 'admin') {
			$where = "1";
			$user = 1;
		}else{
			$where = "cbt_ujian.teacher_id";
			$user = user()->id;
		}

		if (in_groups('teacher')) {
			return DataTables::use('cbt_ujian')
				->select('cbt_ujian.id as ujianid, cbt_ujian.task_name as taskname, cbt_ujian.subject_id as sbjkid, cbt_ujian.class_group_id as classid, cbt_ujian.task_date_start as datestart, cbt_ujian.time_start as timestart, cbt_ujian.time_finish as timefinish, cbt_ujian.status, cbt_ujian.token, tbl_subjects.subject_name as sbjk, tbl_class_group.class_group_name as class, tbl_task_type.task_type_name, tbl_task_type.task_type_code')
				 ->join('tbl_subjects', 'tbl_subjects.id = cbt_ujian.subject_id', 'LEFT')
				 ->join('tbl_class_group', 'tbl_class_group.id = cbt_ujian.class_group_id', 'LEFT')
				 ->join('tbl_task_type', 'tbl_task_type.id = cbt_ujian.task_type_id', 'LEFT')
				 ->where([$where => $user, 'periodyear' => $periodyear])
				->make(true);
		}elseif (in_groups('admin')) {
			return DataTables::use('cbt_ujian')
				->select('cbt_ujian.id as ujianid, cbt_ujian.task_name as taskname, cbt_ujian.subject_id as sbjkid, cbt_ujian.class_group_id as classid, cbt_ujian.task_date_start as datestart, cbt_ujian.time_start as timestart, cbt_ujian.time_finish as timefinish, cbt_ujian.status, cbt_ujian.token, tbl_subjects.subject_name as sbjk, tbl_class_group.class_group_name as class, tbl_task_type.task_type_name, tbl_task_type.task_type_code')
				 ->join('tbl_subjects', 'tbl_subjects.id = cbt_ujian.subject_id', 'LEFT')
				 ->join('tbl_class_group', 'tbl_class_group.id = cbt_ujian.class_group_id', 'LEFT')
				 ->join('tbl_task_type', 'tbl_task_type.id = cbt_ujian.task_type_id', 'LEFT')
				 ->where(['periodyear' => $periodyear])
				->make(true);
		}
	}

	public function get_ujian_all($periodyear = false, $filter = false)
	{
		if ($periodyear == false) {
			$periodyear = period()->id;
		}

		$role = user()->roles;
		
		if ($role == 'admin') {
			$where = "1";
			$user = 1;
		}else{
			$where = "cbt_ujian.teacher_id";
			$user = user()->id;
		}
			return DataTables::use('cbt_ujian')
				->select('cbt_ujian.id as ujianid, cbt_ujian.task_name as taskname, cbt_ujian.subject_id, cbt_ujian.class_group_id, cbt_ujian.task_date_start as datestart, cbt_ujian.time_start as timestart, cbt_ujian.time_finish as timefinish, cbt_ujian.time_limit as timelimit, cbt_ujian.status, cbt_ujian.token, tbl_subjects.subject_name as sbjk, tbl_class_group.class_group_name as class, tbl_task_type.task_type_name, tbl_task_type.task_type_code')
				 ->join('tbl_subjects', 'tbl_subjects.id = cbt_ujian.subject_id', 'LEFT')
				 ->join('tbl_class_group', 'tbl_class_group.id = cbt_ujian.class_group_id', 'LEFT')
				 ->join('tbl_task_type', 'tbl_task_type.id = cbt_ujian.task_type_id', 'LEFT')
				 ->where(['periodyear' => $periodyear, 'cbt_ujian.task_type_id' => $filter])
				->make(true);
	}

	public function create()
	{
		$data = [
			'task_name'			=> $this->request->getPost('task_name'), 
			'task_type_id'		=> $this->request->getPost('task_type_id'), 
			'class_group_id'	=> $this->request->getPost('class'), 
			'subject_id'		=> $this->request->getPost('subject'), 
			'quest_bank_id'		=> $this->request->getPost('quest_bank_id'), 
			'quest_total'		=> $this->request->getPost('quest_total'), 
			'task_date_start'	=> $this->request->getPost('datestart'), 
			'time_start'		=> $this->request->getPost('timestart'), 
			'time_finish'		=> $this->request->getPost('timefinish'), 
			'time_limit'		=> $this->request->getPost('timelimit'), 
			'status'			=> $this->request->getPost('status'), 
			'token'				=> $this->request->getPost('token'), 
			'random'			=> $this->request->getPost('random'),
			'teacher_id'		=> user()->id,
			'periodyear'		=> period()->id
		];

		$this->ujianModel->save($data);
		session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('ujian/cbt'));
	}

	public function saven1($ujian_id)
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

        $builder = $this->db->table('cbt_siswa_ujian_fix');
        $builder->updateBatch($result, 'id');

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('ujian/'.$ujian_id));
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
			'task_date_start'	=> $this->request->getPost('datestart'), 
			'time_start'		=> $this->request->getPost('timestart'), 
			'time_finish'		=> $this->request->getPost('timefinish'), 
			'status'			=> $this->request->getPost('status'), 
			'random'			=> $this->request->getPost('random'),
		];

		$this->ujianModel->save($data);
		session()->setFlashdata('pesan', 'Data berhasil diubah');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('ujian/cbt'));
	}

	public function delete()
	{
		$id = $this->request->getPost('task_id');
		$this->ujianModel->delete($id);
		session()->setFlashdata('pesan', 'Data berhasil dihapus');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('ujian/cbt'));
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

		$this->ujianModel->save($data);
		session()->setFlashdata('pesan', 'Data berhasil diubah');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('ujian/cbt'));
	}

	public function show($id)
    {
        if ($this->request->isAJAX()) {
            $result = $this->ujianModel->find($id);
            if ($result) {
                $this->output['success'] = true;
                $this->output['message']  = 'Data ditemukan';
                $this->output['data']   = $result;
            }
            echo json_encode($this->output);
        }
    }  

    public function export_tes($id)
    {
    	$result_task = $this->userujianModel->get_user_task($id);

    	dd($result_task);
    }

	public function export_excel_rekap_tugas($id)
    {
        $result_task = $this->siswaujianModel->get_user_task($id);
        $detail = $this->ujianModel->get_ujian_detail($id)->getRow();      
        
        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'NISN')
            ->setCellValue('C1', 'Nama Siswa')
            ->setCellValue('D1', 'Jumlah Soal')
            ->setCellValue('E1', 'Nilai N1')
            ->setCellValue('F1', 'Nilai N2')
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
                ->setCellValue('D' . $column, '0')
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
        exit;
    }

    public function export_excel_analisis_jawaban($id)
    {
        $result_task = $this->siswaujianModel->get_user_task($id);
        $detail = $this->ujianModel->get_ujian_detail($id)->getRow();
        
        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'NISN')
            ->setCellValue('C1', 'Nama Siswa')
            ->setCellValue('D1', '');

        $column = 3;
        // tulis data mobil ke cell
        $nox = 1;
        foreach ($result_task as $data) {
        $NA1 = $this->siswaujianModel->get_user_NA_1($id,$data['user_id']);
        $NA2 = $this->siswaujianModel->get_user_NA_2($id,$data['user_id']);

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $nox++)
                ->setCellValue('B' . $column, $data['username'])
                ->setCellValue('C' . $column, $data['fullname'])
                ->setCellValue('D' . $column, '');
				$kolom = 6;

					$jawaban = $this->jawabanModel->get_answer_by_task($id,$data['user_id']);
					$kunci = $this->questModel->get_quest_keys($detail->quest_bank_id);
					foreach ($kunci as $key) {

						if ($key['quest_keys'] == '1') {
								$knc = 'A';
							}elseif ($key['quest_keys'] == '2') {
								$knc = 'B';
							}elseif ($key['quest_keys'] == '3') {
								$knc = 'C';
							}elseif ($key['quest_keys'] == '4') {
								$knc = 'D';
							}elseif ($key['quest_keys'] == '5') {
								$knc = 'E';
							}else{
								$knc = '';
							}
						$spreadsheet->setActiveSheetIndex(0)
							->setCellValueByColumnAndRow($kolom, 2, $knc);

						$kolom++;
					}
				$kolom = 6;
				$no = 1;
					foreach ($jawaban as $x) {

						// dd($jawaban);
							if ($x['XJawaban'] == '1') {
								$jawab = 'A';
							}elseif ($x['XJawaban'] == '2') {
								$jawab = 'B';
							}elseif ($x['XJawaban'] == '3') {
								$jawab = 'C';
							}elseif ($x['XJawaban'] == '4') {
								$jawab = 'D';
							}elseif ($x['XJawaban'] == '5') {
								$jawab = 'E';
							}else{
								$jawab = $x['XJawabanEssai'];
							}

							$spreadsheet->setActiveSheetIndex(0)
							->setCellValueByColumnAndRow($kolom, 1, $no++)
							->setCellValueByColumnAndRow($kolom, $column, $jawab);			
						
						$kolom++;
					}
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Analisis Jawaban - '.$detail->task_name;

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

     public function export_excel_rekap_isian_tugas($id)
    {
        $result_task = $this->siswaujianModel->get_user_task($id);
        
        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'NISN')
            ->setCellValue('C1', 'Nama Siswa')
            ->setCellValue('D1', 'Nilai');

        $column = 2;
        // tulis data mobil ke cell
        $no = 1;
        foreach ($result_task as $data) {
        $NA1 = $this->siswaujianModel->get_user_NA_1($id,$data['user_id']);
        $NA2 = $this->siswaujianModel->get_user_NA_2($id,$data['user_id']);

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $no++)
                ->setCellValue('B' . $column, $data['username'])
                ->setCellValue('C' . $column, $data['fullname'])
                ->setCellValue('D' . $column, $NA2['NA']);
				$kolom = 5;
					$jawaban = $this->jawabanModel->get_answer_essay_by_task($id,$data['user_id']);
					foreach ($jawaban as $x) {

							$spreadsheet->setActiveSheetIndex(0)
							->setCellValueByColumnAndRow($kolom, $column, $x['XJawabanEssai']);	
						
						$kolom++;
					}
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Rekap Nilai';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }


    public function get_subject_by_classgroup()
    {
    	$postData = [
    		'classgroup_id' => $this->request->getPost('class_id')
    	];

    	$data = $this->classesModel->get_subject_by_classgroup($postData);

    	echo json_encode($data);
    }

    public function generateujian()
    {

    	$users = $this->request->getPost('userid');
    	$insert = array();
    	$no = 0;
    	foreach ($users as $user) {
    		$data = [
	    		'user_id' => $user,
	    		'task_id' => $this->request->getPost('task_id'),
	    		'token' => $this->request->getPost('token'),
	    		'status' => '0'
	    	];
	    	$insert[] = $data;
    	};
    	
    	$this->siswaujian2Model->save_batch($insert);
    	return redirect()->to(base_url($this->request->getPost('uri')));
    }

    public function generatesoal()
    {
    	$task_id = $this->request->getPost('task_id');
    	$quest_id = $this->request->getPost('quest_bank_id');
    	
    	$query_tes = $this->ujianModel->get_by_kolom_limit('id', $task_id, 1);
    	
    	if ($query_tes->getRow()->id>0) {
            $query_tes = $query_tes->getRow();

            $query_soal = $this->questModel->get_quest_limit_rand($query_tes->quest_bank_id,$query_tes->quest_total);
	    	if($query_soal>0){
				$query_soal = $query_soal;
				$i_soal = 0;
	        	$insert_soal = array();
	            	foreach ($query_soal as $soal) {
	                // Memasukkan data soal ke table 
	                    $data_soal['sort'] = ++$i_soal;
	                    $data_soal['token'] = $this->request->getPost('token');
	                    $data_soal['number'] = $soal['number'];
	                    $data_soal['task_id'] = $task_id;
	                    $data_soal['quest_bank_id'] = $quest_id;
	                    $data_soal['quest_type'] = $soal['type'];
	                    $data_soal['XA'] = '1';
	                    $data_soal['XB'] = '2';
	                    $data_soal['XC'] = '3';
	                    $data_soal['XD'] = '4';
	                    $data_soal['XE'] = '5';
	                    $data_soal['XRagu'] = '0';
	                    $data_soal['point'] = $soal['point'];
	                    $data_soal['answer_date'] = date('Y-m-d H:i:s');
	                    $data_soal['answer_key'] = $soal['quest_keys'];
	                    $data_soal['user_id'] = $this->request->getPost('user_id');;
	                    $insert_soal[] = $data_soal;
	                }
	            // menggunakan batch query langsung untuk mengehemat waktu dan memory
	            $this->jawaban2Model->save_batch($insert_soal);
	        }
        }

        return redirect()->to(base_url($this->request->getPost('uri')));
    }
	//--------------------------------------------------------------------

}

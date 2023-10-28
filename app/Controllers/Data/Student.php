<?php namespace App\Controllers\Data;

use App\Controllers\BaseController;
use App\Models\Data\ClassgroupModel;
use App\Models\Data\StudentModel;
use App\Models\Data\UsersModel;

class Student extends BaseController
{
	public function __construct()
	{
		$this->classgroupModel = new ClassgroupModel();
		$this->studentModel = new StudentModel();
		$this->userModel = new UsersModel();
	}

	public function index()
	{
		$data = [
			'title' => 'Daftar Siswa',
			'students' => $this->studentModel->get_student(),
		];

		return view('data/student', $data);
	}

	public function changeclass()
	{
		$cek = $this->request->getPost('kelas');
		$ids = $this->request->getPost('studentid'); 

		if ($cek == 0) {
			// $cekuserid = $this->studentModel->get_student_detail_id($ids)->getResultArray();
			// dd($cekuserid);
			$data = [
				'id' => $this->request->getPost('studentid'),
				'class_group_id' => $this->request->getPost('kelas'),
				'status' => 9
			];

			$this->studentModel->save($data);

			// $useraktive = [
			// 	'id' => $cekuserid->id,
			// 	'active' => 0
			// ];

			// $this->userModel->save($useraktive);

			session()->setFlashdata('pesan', 'Data berhasil diubah');
			session()->setFlashdata('type', 'success');
			return redirect()->to(base_url('data/classgroup'));
		}else{
			$data = [
				'id' => $this->request->getPost('studentid'),
				'class_group_id' => $this->request->getPost('kelas')
			];
			$this->studentModel->save($data);
			session()->setFlashdata('pesan', 'Data berhasil diubah');
			session()->setFlashdata('type', 'success');
			return redirect()->to(base_url('data/classgroup'));
		}

	}

	public function transfer($class_id)
	{
		$data = [
			'id' => $this->request->getPost('idstudent'),
			'class_group_id' => $class_id
		];
		$this->studentModel->save($data);
		session()->setFlashdata('pesan', 'Data berhasil diubah');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('data/classgroup/index/'.$class_id));
	}

    public function import()
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
				    $email 		= $sheetData[$i]['1'];
				    $username	= $sheetData[$i]['2'];
				    $fullname	= $sheetData[$i]['3'];

				    $data = [							
						'email'		=> $email,
						'username'	=> $username,
						'fullname'	=> $fullname,
						'user_img'	=> 'default.svg',
						'password_hash'=> '$2y$10$9Ge0xlIsm/DlRup5PrxlRehrHWT2k3LrqXnm5KTvYV.0XCRHIO5eq',
						'active'	=> '1'
					];

					$this->userModel->save($data);
					$iduser = $this->userModel->getInsertID(); 
					$student = [
						'user_id' => $iduser
					];
					$this->studentModel->save($student);
				}

				// $data['info'] = $ar;
				// dd($data['info']);
				// $this->raporcatatanModel->save_batch($ar);
				return redirect()->to(base_url('data/student'));
			}
    }

	// public function detail($id,$code)
	// {
	// 	$data = [
	// 		'title' => 'Kelas Ku',
	// 		'moduls' => $this->classesModel->get_modul_class($id,$code),
	// 		'tasks' => $this->classesModel->get_task_class($id,$code),
	// 		'inter' => $this->classesModel->get_inter_class($id,$code),
	// 		'subject' => $this->classesModel->get_subject_name($id),
	// 		'class' => $this->classesModel->get_class_name($id)
	// 	];

	// 	return view('learn/class_detail', $data);
	// }

	// public function read($id)
	// {
	// 	$readModul = new ReadmodulModel();
	// 	$readdata = [
	// 		'id_modul' => $id,
	// 		'user_id' => user()->id
	// 	];
	// 	$readModul->save($readdata);
	// 	return redirect()->to(base_url('learn/modul/'.$id));	
	// }
	//--------------------------------------------------------------------

}

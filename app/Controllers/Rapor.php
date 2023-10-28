<?php namespace App\Controllers;

use App\Models\RapornilaiModel;
use App\Models\RaporcatatanModel;
use App\Models\RaporkarakterModel;
use App\Models\RaporkehadiranModel;
use App\Models\ClassesModel;
use App\Models\Data\StudentModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;


class Rapor extends BaseController
{
	protected $raporModel, $raporcatatanModel, $raporkarakterModel, $raporkehadiranModel, $studentModel;
	protected $db, $builder;

	public function __construct()
	{
		$this->db = \Config\Database::connect();
        $this->builder = $this->db;
		$this->raporModel = new RapornilaiModel;
		$this->raporcatatanModel = new RaporcatatanModel;
		$this->raporkarakterModel = new RaporkarakterModel;
		$this->raporkehadiranModel = new RaporkehadiranModel;
		$this->studentModel = new StudentModel;
	}

	public function index()
	{
		// helper('indo');
		$data = [
			'title' => 'Input Nilai SKL'
		];

		return view('rapor/index', $data);
	}

	public function nilaiakademik()
	{
		// helper('indo');
		$classes = new ClassesModel;
		$data = [
			'title' => 'Rapor Nilai Akademik',
			'subjects' => $classes->get_subject(user()->id),
			'classes' => $classes->get_class(user()->id),
			'datas' => $this->raporModel->get_nilai_pnk()
		];

		return view('rapor/nilaiakademik', $data);
	}

	public function catatanakademik()
	{
		// helper('indo');
		$classes = new ClassesModel;
		$data = [
			'title' => 'Rapor Catatan Akademik',
			'classes' => $classes->get_class_all(),
			'datas' => $this->raporcatatanModel->get_catatan_akademik()
		];

		return view('rapor/catatanakademik', $data);
	}

	public function karakter()
	{
		// helper('indo');
		$classes = new ClassesModel;
		$data = [
			'title' => 'Rapor Perkembangan Karakter',
			'classes' => $classes->get_class_all(),
			'datas' => $this->raporkarakterModel->get_perkembangan_karakter()
		];

		return view('rapor/karakter', $data);
	}

	public function viewPdf()
    {
    	helper('indo');
        // $inter = $this->interModel->get_inter_detail($inter_id)->getRow();
        $data = [
            'inter' => 'a',
            // 'orang' => $this->student->get_user_interactive_absen($inter->disid,$inter->class_group_id),
        ];

        return view('export/skl', $data);
    }
	public function pdf($nis)
    {
    	helper('indo');
    	helper('predikat');
        $data = [
            'data' => $this->studentModel->get_student_detail($nis)->getRow(),
            'dataa' => $this->raporModel->get_nilai_pnk_siswa_A($nis),
            'datab' => $this->raporModel->get_nilai_pnk_siswa_B($nis),
            'datac1' => $this->raporModel->get_nilai_pnk_siswa_C1($nis),
            'datac2' => $this->raporModel->get_nilai_pnk_siswa_C2($nis),
            'datac3' => $this->raporModel->get_nilai_pnk_siswa_C3($nis),
            'cttakdm'=> $this->raporcatatanModel->get_rapor_catatan_akademik($nis),
            'kehadiran'=> $this->raporkehadiranModel->get_rapor_kehadiran($nis),
            'karakter'=> $this->raporkarakterModel->get_rapor_karakter($nis)
        ];
   	
   		//dd($data['datas']);
        $dompdf = new \Dompdf\Dompdf();
        // $dompdf->isRemoteEnabled(true); 
        $dompdf->loadHtml(view('export/rapor', $data));
        // $dompdf->setPaper('A4', 'potrait');
        $dompdf->setPaper(array(0,0,609.4488,935.433), 'potrait');
        $dompdf->render();
        $dompdf->stream('document.pdf', array('Attachment' => false));
   
    }

    public function import($subject)
    {
    	$created_by = user()->id;
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
				    $nis 		= $sheetData[$i]['2'];
				    $knowledge	= $sheetData[$i]['3'];
					$skils		= $sheetData[$i]['4'];

				    $ar[] = array(							
							'nis'		=> $nis,
							'knowledge'	=> $knowledge,
							'skils'		=> $skils,
							'subject_id' => $subject,
							'created_by'=> $created_by,
							'created_at'=> date('Y-m-d H:i:s'),
							'updated_at'=> date('Y-m-d H:i:s')
				    	);
				    }

				$data['info'] = $ar;
				// dd($data['info']);
				$this->raporModel->save_batch($ar);
				return redirect()->to(base_url('rapor/nilaiakademik'));
			}
    }

    public function importcatatan()
    {
    	$created_by = user()->id;
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
				    $nis 		= $sheetData[$i]['2'];
				    $deskripsi	= $sheetData[$i]['3'];

				    $ar[] = array(							
							'nis'		=> $nis,
							'deskripsi'	=> $deskripsi,
							'created_by'=> $created_by,
							'created_at'=> date('Y-m-d H:i:s'),
							'updated_at'=> date('Y-m-d H:i:s')
				    	);
				    }

				$data['info'] = $ar;
				// dd($data['info']);
				$this->raporcatatanModel->save_batch($ar);
				return redirect()->to(base_url('rapor/catatanakademik'));
			}
    }

    public function importkarakter()
    {
    	$created_by = user()->id;
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
				    $nis 		= $sheetData[$i]['2'];
				    $integritas	= $sheetData[$i]['3'];
				    $religius	= $sheetData[$i]['4'];
				    $nasionalis	= $sheetData[$i]['5'];


				    $ar[] = array(							
							'nis'		=> $nis,
							'integritas'=> $integritas,
							'religius'	=> $religius,
							'nasionalis'=> $nasionalis,
							'created_by'=> $created_by,
							'created_at'=> date('Y-m-d H:i:s'),
							'updated_at'=> date('Y-m-d H:i:s')
				    	);
				    }

				$data['info'] = $ar;
				//dd($data['info']);
				$this->raporkarakterModel->save_batch($ar);
				return redirect()->to(base_url('rapor/karakter'));
			}
    }
	//--------------------------------------------------------------------

}
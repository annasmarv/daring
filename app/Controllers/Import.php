<?php
namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use App\Models\SklnilaiModel;

class Import extends BaseController
{
	protected $sklModel;
    protected $db, $builder;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db;
        $this->sklModel = new SklnilaiModel;
    }

	public function skl()
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
			     //    $nama = $sheetData[$i]['0'];
				    // $username = $sheetData[$i]['1'];
				    // $password = $sheetData[$i]['2'];
				    $nis	= $sheetData[$i]['3'];
					$pabp	= $sheetData[$i]['4'];
					$ppkn	= $sheetData[$i]['5'];
					$bindo	= $sheetData[$i]['6'];
					$matk	= $sheetData[$i]['7'];
					$sind	= $sheetData[$i]['8'];
					$bing	= $sheetData[$i]['9'];
					$sbud	= $sheetData[$i]['10'];
					$pjok	= $sheetData[$i]['11'];
					$bjaw	= $sheetData[$i]['12'];
					$skdg	= $sheetData[$i]['13'];
					$pkwu	= $sheetData[$i]['14'];
					$dkli	= $sheetData[$i]['15'];
					$kkli	= $sheetData[$i]['16'];
					$status	= $sheetData[$i]['17'];

				    // $nra_fix = str_replace(' ', '', $nra);


				    $ar[] = array(							
							'nis'		=> $nis,
							'pabp'		=> $pabp,
							'ppkn'		=> $ppkn,
							'bindo'		=> $bindo,
							'matk'		=> $matk,
							'sind'		=> $sind,
							'bing'		=> $bing,
							'sbud'		=> $sbud,
							'pjok'		=> $pjok,
							'bjaw'		=> $bjaw,
							'skdg'		=> $skdg,
							'pkwu'		=> $pkwu,
							'dkli'		=> $dkli,
							'kkli'		=> $kkli,
							'status'	=> $status
				    	);
				    }

				$data['info'] = $ar;
				$this->sklModel->save_batch($ar);
			}
	}
	
}
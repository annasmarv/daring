<?php namespace App\Controllers\Data;

use App\Controllers\BaseController;
use App\Models\Data\AbsensiModel;
use App\Models\Data\ClassgroupModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Absensi extends BaseController
{
	protected $absensiModel;

	public function __construct()
	{
		$this->absensiModel = new AbsensiModel();
	}

	public function index()
	{
		$date = $this->request->getGet('date');
		$class_id = $this->request->getGet('class_id');
		$classgroup = new ClassgroupModel();
		$data = [
			'date' => $date,
			'class_id' => $class_id,
			'title' => 'Rekap Absensi',
			'class_group' => $classgroup->classgroup(),
			'absens' => $this->absensiModel->get_absen($class_id, $date)
		];

		return view('data/absensi', $data);
	}

	public function maps()
	{
		$date = $this->request->getGet('date');
		$class_id = $this->request->getGet('class_id');
		$data = [
			'date' => $date,
			'class_id' => $class_id,
			'title' => 'Maps',
			'absens' => $this->absensiModel->get_absen($class_id, $date)
		];

		return view('data/maps', $data);
	}

	public function export_excel_rekap_absensi()
    {
        $date = $this->request->getGet('date');
		$class_id = $this->request->getGet('class_id');
		$result = $this->absensiModel->get_absen($class_id, $date);

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'NISN')
            ->setCellValue('C1', 'Nama Siswa')
            ->setCellValue('D1', 'Kelas')
            ->setCellValue('E1', 'Waktu')
            ->setCellValue('F1', 'Koordinat');

        $column = 2;
        // tulis data mobil ke cell
        $no = 1;
        foreach ($result as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $no++)
                ->setCellValue('B' . $column, $data['username'])
                ->setCellValue('C' . $column, $data['fullname'])
                ->setCellValue('D' . $column, $data['class_group_name'])
                ->setCellValue('E' . $column, $data['XDate'].','.$data['XTime'])
                ->setCellValue('F' . $column, $data['XLatitude'].','.$data['XLongitude']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Rekap Absensi';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');
        ob_end_clean();
        $writer->save('php://output');
        exit();
    }

//     public function siswa()
// {
//     $mobil = new SiswaModel();
//     $dataMobil = $mobil->findAll();

//     $spreadsheet = new Spreadsheet();
//     // tulis header/nama kolom 
//     $spreadsheet->setActiveSheetIndex(0)
//                 ->setCellValue('A1', 'Nama')
//                 ->setCellValue('B1', 'Kelas')
//                 ->setCellValue('C1', 'Jurusan')
//                 ->setCellValue('D1', 'Angkatan')
//                 ->setCellValue('E1', 'NIS');
    
//     $column = 2;
//     // tulis data mobil ke cell
//     foreach($dataMobil as $data) {
//         $spreadsheet->setActiveSheetIndex(0)
//                     ->setCellValue('A' . $column, $data['nama'])
//                     ->setCellValue('B' . $column, $data['kelas'])
//                     ->setCellValue('C' . $column, $data['jurusan'])
//                     ->setCellValue('D' . $column, $data['angkatan'])
//                     ->setCellValue('E' . $column, $data['nis']);
//         $column++;
//     }
//     // tulis dalam format .xlsx
//     $writer = new Xlsx($spreadsheet);
//     $fileName = 'Data Siswa';

//     // Redirect hasil generate xlsx ke web client
//     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//     header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
//     header('Cache-Control: max-age=0');

//     $writer->save('php://output');
}




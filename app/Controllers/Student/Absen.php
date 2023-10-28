<?php namespace App\Controllers\Student;
use App\Controllers\BaseController;
use App\Models\AbsenModel;

class Absen extends BaseController
{
	protected $absenModel;

	public function __construct()
	{
		$this->absenModel = new AbsenModel;
	}

	public function index()
	{
		helper('indo');
		$data = [
			'title' => 'Absensi',
			'isA' => $this->absenModel->get_absen_today()->getRow()
		];

		return view('student/absen', $data);
	}

	public function report()
	{
		$data = [
			'title' => 'Laporan Absensi',
			'report' => $this->absenModel->get_absen()
		];

		return view('student/absen_report', $data);
	}

	public function send()
	{
		$data = [
			'title' => 'Absensi',
			'isA' => $this->absenModel->get_absen_today()->getRow()
		];

		return view('student/absen_finish', $data);
	}

	public function check()
	{
		$data = [
			'title' => 'Cek Lokasi'
		];

		return view('student/absen_maps_check', $data);
	}

	public function cek()
	{
		date_default_timezone_set('Asia/Jakarta');
		$time = date('H:i:s');
		$date = date('Y-m-d');
		$data = [
			'XLatitude' => $this->request->getPost('latitude'),
			'XLongitude' => $this->request->getPost('longitude'),
			//'XLatitude' => '1',
			//'XLongitude' => '2',
			'XTime' => $time,
			'XDate' => $date,
			'user_id' => user()->id,
			'type' => '1'
		];

		$this->absenModel->save($data);
		// session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
		// session()->setFlashdata('type', 'success');
		// return redirect()->to(base_url('student/absen_finish'));
	}

	public function note()
	{
		date_default_timezone_set('Asia/Jakarta');
		$time = date('H:i:s');
		$date = date('Y-m-d');
		$data = [
			'note' => $this->request->getPost('note'),
			'type' => '2',
			'user_id' => user()->id,
			'XTime' => $time,
			'XDate' => $date,
		];
		$title['title'] = 'Absensi';
		$this->absenModel->save($data);
		// session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
		// session()->setFlashdata('type', 'success');
		return view('student/absen_note_finish',$title);
	}

	//--------------------------------------------------------------------

}

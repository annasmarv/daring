<?php namespace App\Controllers\Learn;

use App\Controllers\BaseController;
use Irsyadulibad\DataTables\DataTables;
use App\Models\Learn\InteractiveModel;
use App\Models\ClassesModel;
use App\Models\Data\StudentModel;

class Interactive extends BaseController
{
	public function __construct()
	{
		$this->interModel = new InteractiveModel();
		$this->student = new StudentModel();
	}

	public function index()
	{
		$classes = new ClassesModel;
		$data = [
			'title' => 'Kelas Interaktif',
			'subjects' => $classes->get_subject(user()->id),
			'classes' => $classes->get_class(user()->id)
		];

		return view('learn/inter', $data);
	}

	public function ubah($id)
	{
		$classes = new ClassesModel;
		$data = [
			'subjects' => $classes->get_subject(user()->id),
			'title' => 'Ubah Kelas Interaktif',
			'classes' => $classes->get_class(user()->id),
			'detail' => $this->interModel->get_inter_detail($id)->getRow()
		];

		return view('learn/inter_ubah', $data);;
	}
	
	public function get_interactive()
	{
		$role = user()->roles;
		if ($role == 'admin') {
			$where = "1";
			$user = 1;
		}else{
			$where = "mpd_discuss.teacher_id";
			$user = user()->id;
		}

		if (in_groups('teacher')) {
			return DataTables::use('mpd_discuss')
				->select('mpd_discuss.id as did, mpd_discuss.title, mpd_discuss.subject_id, mpd_discuss.class_group_id, mpd_discuss.date, mpd_discuss.time_start, mpd_discuss.time_finish, mpd_discuss.status, tbl_subjects.subject_name as sbjk, tbl_class_group.class_group_name as class')
				 ->join('tbl_subjects', 'tbl_subjects.id = mpd_discuss.subject_id')
				 ->join('tbl_class_group', 'tbl_class_group.id = mpd_discuss.class_group_id')
				 ->where([$where => $user])
				->make(true);
		}elseif (in_groups('admin')) {
			return DataTables::use('mpd_discuss')
				->select('mpd_discuss.id as did, mpd_discuss.title, mpd_discuss.subject_id, mpd_discuss.class_group_id, mpd_discuss.date, mpd_discuss.time_start, mpd_discuss.time_finish, mpd_discuss.status, tbl_subjects.subject_name as sbjk, tbl_class_group.class_group_name as class')
				 ->join('tbl_subjects', 'tbl_subjects.id = mpd_discuss.subject_id')
				 ->join('tbl_class_group', 'tbl_class_group.id = mpd_discuss.class_group_id')
				->make(true);
		}
	}

	public function create()
	{
		$data = [
			'title'			=> $this->request->getPost('tema'), 
			'subject_id'	=> $this->request->getPost('subject'), 
			'class_group_id'=> $this->request->getPost('class'), 
			'date'			=> $this->request->getPost('tgl'), 
			'time_start'	=> $this->request->getPost('start'), 
			'time_finish'	=> $this->request->getPost('finish'), 
			'status'		=> $this->request->getPost('status'), 
			'teacher_id'	=> user()->id
		];

		$this->interModel->save($data);
		session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('learn/interactive'));
	}

	public function update()
	{
		$data = [
			'id'			=> $this->request->getPost('id'),
			'title'			=> $this->request->getPost('tema'), 
			'subject_id'	=> $this->request->getPost('subject'), 
			'class_group_id'=> $this->request->getPost('class'), 
			'date'			=> $this->request->getPost('tgl'), 
			'time_start'	=> $this->request->getPost('start'), 
			'time_finish'	=> $this->request->getPost('finish'), 
			'status'		=> $this->request->getPost('status'), 
			'teacher_id'	=> user()->id
		];

		$this->interModel->save($data);
		session()->setFlashdata('pesan', 'Data berhasil diubah');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('learn/interactive'));
	}

	public function delete()
	{
		$id = $this->request->getPost('inter_id');
		$this->interModel->delete($id);
		session()->setFlashdata('pesan', 'Data berhasil dihapus');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('learn/interactive'));
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

		$this->interModel->save($data);
		session()->setFlashdata('pesan', 'Data berhasil diubah');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('learn/interactive'));
	}

	public function show($id)
    {
        if ($this->request->isAJAX()) {
            $result = $this->interModel->find($id);
            if ($result) {
                $this->output['success'] = true;
                $this->output['message']  = 'Data ditemukan';
                $this->output['data']   = $result;
            }
            echo json_encode($this->output);
        }
    }

    	public function export_excel_rekap_interactive()
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

        $writer->save('php://output');
    }

    public function viewPdf($inter_id)
    {
    	helper('indo');
        $inter = $this->interModel->get_inter_detail($inter_id)->getRow();
        $data = [
            'inter' => $inter,
            'orang' => $this->student->get_user_interactive_absen($inter->disid,$inter->class_group_id),
        ];

        return view('export/interactive', $data);
    }

    public function pdf($inter_id)
    {
    	helper('indo');
    	$inter = $this->interModel->get_inter_detail($inter_id)->getRow();
        $data = [
            'inter' => $inter,
            'orang' => $this->student->get_user_interactive_absen($inter->disid,$inter->class_group_id),
        ];
   
        $dompdf = new \Dompdf\Dompdf();
        // $dompdf->isRemoteEnabled(true); 
        $dompdf->loadHtml(view('export/interactive', $data));
        // $dompdf->load_html_file('img/1609853179_1e66fb06ccdaf3ee3759.png');
        // $dompdf->setPaper('A4', 'potrait');
        $dompdf->setPaper(array(0,0,609.4488,935.433), 'potrait');
        $dompdf->render();
        $dompdf->stream('document.pdf', array('Attachment' => false));
   
    }

    public function get_inter_meet()
    {
    	$postData = [
    		'classgroup_id' => $this->request->getPost('class_id'),
    		'subject_id' => $this->request->getPost('subject_id')
    	];

    	$data = $this->interModel->get_inter_teacher_class_subject($postData);

    	echo json_encode($data);
    }
	//--------------------------------------------------------------------

}

<?php namespace App\Controllers;

use App\Models\SklnilaiModel;

class Skl extends BaseController
{
	protected $sklModel;

	public function __construct()
	{
		$this->sklModel = new SklnilaiModel;
	}

	public function announcement()
	{
		$data = [
			'title' => 'Pengumuman Kelulusan - SMK Negeri 7 Kendal'
		];
		return view('skl/skl', $data);
	}

	public function skl()
	{
		$id = user()->username;
		return redirect()->to(base_url('unduh/skl/'.$id.'.pdf'));
	}

	public function rapor()
	{
		$id = user()->username;
		return redirect()->to(base_url('unduh/rapor/'.$id.'.pdf'));
	}

	public function index()
	{
		// helper('indo');
		$data = [
			'data' => $this->sklModel->get_nilai(),
			'title' => 'Input Nilai SKL'
		];

		return view('skl/index', $data);
	}

	// public function create()
	// {
	// 	$data = [
	// 		'title' => $this->request->getPost('title'),
	// 		'news' => $this->request->getPost('news'),
	// 		'teacher_id' => user()->id
	// 	];

	// 	$this->newsModel->save($data);
	// 	session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
	// 	session()->setFlashdata('type', 'success');
	// 	return redirect()->to(base_url('/'));

	// }

	// public function delete()
	// {
	// 	$id = $this->request->getPost('id');

	// 	$this->newsModel->delete($id);
	// 	session()->setFlashdata('pesan', 'Data berhasil dihapus');
	// 	session()->setFlashdata('type', 'success');
	// 	return redirect()->to(base_url('/'));

	// }
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
	public function pdf()
    {
    	helper('indo');
    	// $inter = $this->interModel->get_inter_detail($inter_id)->getRow();
        $data = [
            'inter' => 'a'
            // 'orang' => $this->student->get_user_interactive_absen($inter->disid,$inter->class_group_id),
        ];
   
        $dompdf = new \Dompdf\Dompdf();
        // $dompdf->isRemoteEnabled(true); 
        $dompdf->loadHtml(view('export/skl', $data));
        // $dompdf->load_html_file('img/1609853179_1e66fb06ccdaf3ee3759.png');
        // $dompdf->setPaper('A4', 'potrait');
        $dompdf->setPaper(array(0,0,609.4488,935.433), 'potrait');
        $dompdf->render();
        $dompdf->stream('document.pdf', array('Attachment' => false));
   
    }
	//--------------------------------------------------------------------

}
<?php namespace App\Controllers;

use App\Models\HomeModel;
use App\Models\ScheduleModel;
use App\Models\TasksModel;
use App\Models\Data\StudentModel;
use App\Models\Data\TeacherModel;
use App\Models\WeekModel;
use App\Models\SinagaXModel;

class Home extends BaseController
{
	protected $newsModel;
	protected $session;
	protected $weekModel;

	public function __construct()
	{
		$this->session = \Config\Services::session();
        $this->session->start();
		$this->newsModel = new HomeModel;
		$this->schModel = new ScheduleModel;
		$this->tasksModel = new TasksModel;
		$this->studentModel = new StudentModel;
		$this->teacherModel = new TeacherModel;
		$this->weekModel = new WeekModel;
		$this->sinaX = new SinagaXModel;
	}

	public function ceksinaga()
	{
		$nip = '196802142005011007';
		$thn = '2023';
		$bln = '09';
		$abs = 'am';
		$abs1 = 'ap';

		$code = $thn.$bln.'_'.$nip.'-'.$abs."_";
		$code2 = $thn.$bln.'_'.$nip.'-'.$abs1."_";
		dd($this->request->getPost());
		$this->sinaX->save(['json'=>$this->request->getPost()]);
		// for ($i=1; $i <=30 ; $i++) { 
		// 	$asas= $this->request->getPost($code.str_pad($i, 2, "0", STR_PAD_LEFT));
		// 	$asas2= $this->request->getPost($code2.str_pad($i, 2, "0", STR_PAD_LEFT));
		// 	// echo $asas;
		// 	$iss  = preg_replace('/[^0-9]/', '', "$asas");
		// 	// $wk ='<img height="250px" src="http://103.107.245.162/bkd_asigam/assets/images/swafoto/'.$thn.'/'.$bln.'/'.$nip.'/'.$nip.'_'.$iss.'.jpg">';
		// 	// $wkx =$nip.'_'.$iss;
		// 	// echo $wk."<br>".$wkx."<br>";
		// 	$wkz =$nip.' '.$asas.' http://103.107.245.162/bkd_asigam/assets/images/swafoto/'.$thn.'/'.$bln.'/'.$nip.'/'.$nip.'_'.$iss.'.jpg';
		// 	$wkz1 =$nip.' '.$asas2.' http://103.107.245.162/bkd_asigam/assets/images/swafoto/'.$thn.'/'.$bln.'/'.$nip.'/'.$nip.'_'.$iss.'.jpg';
		// 	echo $wkz."<br>";
		// 	echo $wkz1."<br>";
		// }
	}

	public function period($periodyear)
	{
		helper('cookie');
		$coo = [
	        'name' => 'periodyear',
	        'value' => $periodyear,
	        'expire' => '3600',
	    ];

        return redirect()->back()->setCookie($coo);
	}

	public function index()
	{
		date_default_timezone_set('Asia/Jakarta');
		if ($this->request->getGet('date')) {
			$date = $this->request->getGet('date');
		}else{
			$date = date('Y-m-d');
		}

		helper('indo');
		if (in_groups('admin')) {
			$week = $this->weekModel->get_week_this_date(date('Y-m-d'));
			if (isset($week['week_schedule'])) {
				$week_schedule = 0;
			}else{
				$week_schedule = 1;
			}
			$data = [
				'news' => $this->newsModel->get_news(),
				'title' => 'Dashboard',
				'week_schedule' => $week_schedule
			];
		}

		if (in_groups('student')) {
			$user_id = user()->id;
			$data = [
				'news' => $this->newsModel->get_news(),
				'title' => 'Dashboard',
				'sch' => $this->schModel->get_schedule_class(),
				'tasks' => $this->tasksModel->get_tasks(),
				'level' => $this->studentModel->get_student_level($user_id)
			];
		}

		if (in_groups('teacher')) {
			$user_id = user()->id;
			$week = $this->weekModel->get_week_this_date(date('Y-m-d'));
			$data = [
				'news' => $this->newsModel->get_news(),
				'title' => 'Dashboard',
				'sch' => $this->schModel->get_schedule_thisday_teacher_week($week['week_schedule'])
			];
		}

		return view('home/index', $data);
	}

	public function create()
	{
		$data = [
			'title' => $this->request->getPost('title'),
			'news' => $this->request->getPost('news'),
			'teacher_id' => user()->id
		];

		$this->newsModel->save($data);
		session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('/'));

	}

	public function update()
	{
		$data = [
			'id' => $this->request->getPost('id'),
			'title' => $this->request->getPost('title'),
			'news' => $this->request->getPost('news'),
			'teacher_id' => user()->id
		];

		$this->newsModel->save($data);
		session()->setFlashdata('pesan', 'Data berhasil diubah');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('/'));

	}

	public function delete()
	{
		$id = $this->request->getPost('id');

		$this->newsModel->delete($id);
		session()->setFlashdata('pesan', 'Data berhasil dihapus');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('/'));

	}


	//--------------------------------------------------------------------

}

<?php namespace App\Controllers\Data;

use App\Controllers\BaseController;
use Irsyadulibad\DataTables\DataTables;
use Myth\Auth;
use App\Models\Data\ModulModel;
use App\Models\Data\ClassgroupModel;
use App\Models\ClassesModel;
use App\Models\ReadmodulModel;

class Modul extends BaseController
{
	protected $ModulModel;

	public function __construct()
	{
		$this->ModulModel = new ModulModel();
	}

	public function index()
	{
		$data = [
			'title' => 'Materi Belajar'
		];

		return view('modul/index', $data);
	}

	public function detail($id)
	{
		$class = new ClassgroupModel;
		$readModul = new ReadmodulModel;
		$data = [
			'title' => 'Detail Materi',
			'classes' => $class->classgroup(),
			'modul' => $this->ModulModel->get_modul($id),
			'count' => $readModul->count_data($id),
			'lists' => $readModul->list_read_modul($id)
		];

		return view('modul/detail', $data);
	}

	public function add()
	{
		$classes = new ClassesModel;
		$data = [
			'title' => 'Tambah Materi',
			'subjects' => $classes->get_subject(user()->id),
			'classes' => $classes->get_class(user()->id),
		];

		return view('modul/create', $data);
	}

	public function update($id)
	{
		$class = new ClassgroupModel;
		$classes = new ClassesModel;
		$data = [
			'title' => 'Update Materi',
			'modul' => $this->ModulModel->get_modul($id),
			'subjects' => $classes->get_subject(user()->id),
			'classes' => $class->classgroup()
		];

		return view('modul/update', $data);
	}

	public function get_modul($periodyear = false)
	{
		if ($periodyear == false) {
			$periodyear = period()->id;
		}

		$role = user()->roles;

		if ($role == 'admin') {
			$where = "1";
			$user = 1;
		}else{
			$where = "mpd_modul.teacher_id";
			$user = user()->id;
		}

		if (in_groups('teacher')) {
			return DataTables::use('mpd_modul')
			->select('mpd_modul.id as modulid, mpd_modul.class_group_id, mpd_modul.subject_id, mpd_modul.title, mpd_modul.is_active, tbl_subjects.subject_name as sbjk')
			->join('tbl_subjects', 'tbl_subjects.id = subject_id')
			->where([$where => $user, 'periodyear' => $periodyear])
			->make(true);
		}elseif (in_groups('admin')) {
			return DataTables::use('mpd_modul')
			->select('mpd_modul.id as modulid, mpd_modul.class_group_id, mpd_modul.subject_id, mpd_modul.title, mpd_modul.is_active, tbl_subjects.subject_name as sbjk')
			->join('tbl_subjects', 'tbl_subjects.id = subject_id')
			->where(['periodyear' => $periodyear])
			->make(true);
		}
	}

	public function create()
	{
		$class_group_id = $this->request->getPost('kelas');
		$xid = implode(',', $class_group_id);
		$data = [
			'subject_id' => $this->request->getPost('subject'),
			'class_group_id' => $xid,
			'title' => $this->request->getPost('title'),
			'youtube' => $this->request->getPost('youtube'),
			'content' => $this->request->getPost('content'),
			'is_active' => $this->request->getPost('is_active'),
			'teacher_id' => user()->id,
			'periodyear'		=> period()->id
		];

		$this->ModulModel->save($data);
		session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('data/modul'));
	}

	public function edit()
	{
		$class_group_id = $this->request->getPost('kelas');
		$xid = implode(',', $class_group_id);
		$data = [
			'id' => $this->request->getPost('modul_id'),
			'class_group_id' => $xid,
			'subject_id' => $this->request->getPost('subject_id'),
			'title' => $this->request->getPost('title'),
			'youtube' => $this->request->getPost('youtube'),
			'content' => $this->request->getPost('content'),
			'is_active' => $this->request->getPost('is_active')
		];

		$this->ModulModel->save($data);
		session()->setFlashdata('pesan', 'Data berhasil diubah');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('data/modul/'.$data['id']));
	}

	public function delete()
	{
		$id = $this->request->getPost('id');

		$this->ModulModel->delete($id);
		session()->setFlashdata('pesan', 'Data berhasil dihapus');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('data/modul'));
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
			'is_active' => $status
		];

		$this->ModulModel->save($data);
		session()->setFlashdata('pesan', 'Data berhasil diubah');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('data/modul'));
	}

	public function show($id)
    {
        if ($this->request->isAJAX()) {
            $result = $this->ModulModel->find($id);
            if ($result) {
                $this->output['success'] = true;
                $this->output['message']  = 'Data ditemukan';
                $this->output['data']   = $result;
            }
            echo json_encode($this->output);
        }
    }

    public function get_modul_meet()
    {
    	$postData = [
    		'classgroup_id' => $this->request->getPost('class_id'),
    		'subject_id' => $this->request->getPost('subject_id')
    	];

    	$data = $this->ModulModel->get_modul_teacher_class_subject($postData);

    	echo json_encode($data);
    } 
}




<?php namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\Data\TeacherModel;

class Profile extends BaseController
{
	protected $usersModel;

	public function __construct()
	{
		$this->usersModel = new UsersModel;	
		$this->teacherModel = new TeacherModel;	
	}

	public function index()
	{
		if (in_groups(['admin','teacher'])) {
			$data = [
				'title' => 'Profil',
				'user' => $this->teacherModel->profile(user()->id),
				'validation' => \Config\Services::validation()
			];
		}else{
			$data = [
				'title' => 'Profil',
				'validation' => \Config\Services::validation()
			];
		}

		return view('profil/index', $data);
	}

	public function password()
	{
		$data = [
			'title' => 'Ubah Password'
		];

		return view('profil/password', $data);
	}

	public function save()
	{
		$data = [
        	'id' => $this->request->getPost('profileid'),
        	'nip' => $this->request->getPost('nip'),
        	'nik' => $this->request->getPost('nik'),
        	'gender' => $this->request->getPost('gender'),
        	'birth_place' => $this->request->getPost('birth_place'),
        	'birth_date' => $this->request->getPost('birth_date'),
        	'religion' => $this->request->getPost('religion')
        ];
        $dataa = [
        	'id' => $this->request->getPost('userid'),
        	'username' => $this->request->getPost('username'),
        	'email' => $this->request->getPost('email'),
        	'fullname' => $this->request->getPost('fullname')
        ];

        $this->usersModel->save($dataa);
        if (in_groups(['admin','teacher'])) {
        	$this->teacherModel->save($data);
        }
		session()->setFlashdata('pesan', 'Data berhasil diubah');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('profile'));
	}

	public function img()
	{

		if (!$this->validate([
			'user_img' => [
				'rules' => 'is_image[user_img]|mime_in[user_img,image/jpg,image/jpeg,image/png]|max_size[user_img,1024]',
				'errors' => [
					'max_size' => 'Ukuran terlalu besar',
					'is_image' => 'File anda bukan gambar',
					'mime_in' => 'File anda bukan gambar'
				]
			]
		])) {
			return redirect()->to('/profile')->withInput();
		}

		$user_img = $this->request->getFile('user_img');

		if ($user_img->getError() == 4) {
			$name_img = 'user.png';
		}else{
			$name_img = $user_img->getRandomName();
			$user_img->move('img/profile', $name_img);
		}

		$data = [
			'id' => user()->id,
			'user_img' => $name_img,
		];

		$query = $this->usersModel->save($data);

		session()->setFlashdata('pesan', 'Data berhasil diubah');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('profile'));
	}

	public function changepassword()
	{
		$olddbPassword = user()->password_hash;
		$oldPassInput = $this->request->getPost('oldPass');
		$newPassInput = $this->request->getPost('newPass'); 
		$newPassConf = $this->request->getPost('confPass');

		$result = password_verify(base64_encode(hash('sha384', $oldPassInput, true)), $olddbPassword);
		
		if ($newPassInput != $newPassConf) {
			session()->setFlashdata('pesan', 'Konfirmasi Password Berbeda');
			session()->setFlashdata('type', 'warning');
			return redirect()->to(base_url('profile/password'));
		}elseif ($result != true) {
			session()->setFlashdata('pesan', 'Password Lama Salah');
			session()->setFlashdata('type', 'warning');
			return redirect()->to(base_url('profile/password'));
		}else{
			$data = [
				'id' => user()->id,
				'password_hash' => password_hash(base64_encode(hash('sha384', $newPassInput, true)), PASSWORD_DEFAULT)
			];

			$query = $this->usersModel->save($data);

			session()->setFlashdata('pesan', 'Password berhasil diubah');
			session()->setFlashdata('type', 'success');
			return redirect()->to(base_url('profile/password'));
		}
	}
	//--------------------------------------------------------------------

}

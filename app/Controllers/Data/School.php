<?php namespace App\Controllers\Data;

use App\Controllers\BaseController;
use App\Models\Data\SchoolModel;

class School extends BaseController
{
	protected $SchoolModel;

	public function __construct()
	{
		$this->SchoolModel = new SchoolModel();
	}

	public function index()
	{
		session();
		$data = [
			'validation' => \Config\Services::validation(),
			'title' => 'Data Sekolah',
			'sekolah' => $this->SchoolModel->getProfile()
		];
		
		if (empty($data['sekolah'])) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Tidak Ditemukan');	
		}
		return view('data/school', $data);
	}

	public function update($id)
	{
		if (!$this->validate([
			'logo' => [
				'rules' => 'is_image[logo]|mime_in[logo,image/jpg,image/jpeg,image/png]|max_size[logo,1024]',
				'errors' => [
					'max_size' => 'Ukuran terlalu besar',
					'is_image' => 'File anda bukan gambar',
					'mime_in' => 'File anda bukan gambar'
				]
			]
		])) {
			return redirect()->to('/data/school')->withInput();
		}

		$logo_file = $this->request->getFile('logo');

		//cek gambar apakah tetap gambar lama
		if ($logo_file->getError() == 4) {
			$logo_name = $this->request->getVar('logo_lama');
		}else{
			$logo_name = $logo_file->getRandomName();
			$logo_file->move('img', $logo_name);
			// hapus file lama
			unlink('img/' . $this->request->getVar('logo_lama'));
		}

		$this->SchoolModel->save([
			'id' 			=> $id,
			'npsn' 			=> $this->request->getPost('npsn'),
			'nama_sekolah' 	=> $this->request->getPost('nsekolah'), 
			'alamat' 		=> $this->request->getPost('alamats'), 
			'kecamatan' 	=> $this->request->getPost('kecs'), 
			'kabupaten' 	=> $this->request->getPost('kabs'), 
			'provinsi' 		=> $this->request->getPost('provs'), 
			'kodepos' 		=> $this->request->getPost('kpos'), 
			'nama_kepsek' 	=> $this->request->getPost('kepsek'), 
			'nip_kepsek' 	=> $this->request->getPost('nipksek'), 
			'nama_pengawas' => $this->request->getPost('pengawassek'), 
			'nip_pengawas' 	=> $this->request->getPost('nippsek'), 
			'telp' 			=> $this->request->getPost('telp'), 
			'fax' 			=> $this->request->getPost('fax'), 
			'web' 			=> $this->request->getPost('web'), 
			'email' 		=> $this->request->getPost('email'), 
			'kontak_kepsek' => $this->request->getPost('nohp'),
			'logo' 			=> $logo_name		
		]);

		session()->setFlashdata('pesan', 'Data berhasil diubah.');
		return redirect()->to('/data/school');
	}

	//--------------------------------------------------------------------

}

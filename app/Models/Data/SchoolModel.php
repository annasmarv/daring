<?php namespace App\Models\Data;

use CodeIgniter\Model;

class SchoolModel extends Model
{
	protected $table = 'tbl_school';
	protected $useTimestamps = true;
	protected $allowedFields = ['npsn', 'jenjang', 'nama_sekolah', 'alamat', 'kecamatan', 'kabupaten', 'provinsi', 'kodepos', 'nama_kepsek', 'nip_kepsek', 'nama_pengawas', 'nip_pengawas', 'telp', 'fax', 'web', 'email', 'kontak_kepsek', 'logo'];

	public function getProfile($id = '1')
	{
		if ($id == false) {
			return $this->findAll();
		}

		return $this->where(['id' => $id])->first();
	}
}
?>
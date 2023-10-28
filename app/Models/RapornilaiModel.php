<?php namespace App\Models;

use CodeIgniter\Model;

class RapornilaiModel extends Model
{
	protected $table = 'rapor_nilai';
	protected $useTimestamps = true;
	protected $allowedFields = ['subject_id', 'knowledge', 'skils', 'created_by'];

	public function get_nilai_pnk()
	{
		$subject_id = $_GET['mapel'];
		$classgroup_id = $_GET['kelas'];
		$this->select('users.fullname, users.username, rapor_nilai.*');
		$this->join('users', 'users.username = rapor_nilai.nis', 'LEFT');
		$this->join('tbl_student', 'tbl_student.user_id = users.id', 'LEFT');
		$this->where(['tbl_student.class_group_id' => $classgroup_id, 'rapor_nilai.subject_id' => $subject_id]);

		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_nilai_pnk_siswa_A($nis)
	{
		$nn = "A";
		$this->select('users.fullname, users.username, tbl_subjects.subject_name, rapor_nilai.*');
		$this->join('users', 'users.username = rapor_nilai.nis', 'LEFT');
		$this->join('tbl_student', 'tbl_student.user_id = users.id', 'LEFT');
		$this->join('tbl_subjects', 'tbl_subjects.id = rapor_nilai.subject_id');
		$this->where(['users.username' => $nis, 'tbl_subjects.str' => $nn]);
		$this->orderBy('tbl_subjects.id', 'ASC');

		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_nilai_pnk_siswa_B($nis)
	{
		$nn = "B";
		$this->select('users.fullname, users.username, tbl_subjects.subject_name, rapor_nilai.*');
		$this->join('users', 'users.username = rapor_nilai.nis', 'LEFT');
		$this->join('tbl_student', 'tbl_student.user_id = users.id', 'LEFT');
		$this->join('tbl_subjects', 'tbl_subjects.id = rapor_nilai.subject_id');
		$this->where(['users.username' => $nis, 'tbl_subjects.str' => $nn]);
		$this->orderBy('tbl_subjects.id', 'ASC');

		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_nilai_pnk_siswa_C1($nis)
	{
		$nn = "C1";
		$this->select('users.fullname, users.username, tbl_subjects.subject_name, rapor_nilai.*');
		$this->join('users', 'users.username = rapor_nilai.nis', 'LEFT');
		$this->join('tbl_student', 'tbl_student.user_id = users.id', 'LEFT');
		$this->join('tbl_subjects', 'tbl_subjects.id = rapor_nilai.subject_id');
		$this->where(['users.username' => $nis, 'tbl_subjects.str' => $nn]);
		$this->orderBy('tbl_subjects.id', 'ASC');

		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_nilai_pnk_siswa_C2($nis)
	{
		$nn = "C2";
		$this->select('users.fullname, users.username, tbl_subjects.subject_name, rapor_nilai.*');
		$this->join('users', 'users.username = rapor_nilai.nis', 'LEFT');
		$this->join('tbl_student', 'tbl_student.user_id = users.id', 'LEFT');
		$this->join('tbl_subjects', 'tbl_subjects.id = rapor_nilai.subject_id');
		$this->where(['users.username' => $nis, 'tbl_subjects.str' => $nn]);
		$this->orderBy('tbl_subjects.id', 'ASC');

		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_nilai_pnk_siswa_C3($nis)
	{
		$nn = "C3";
		$this->select('users.fullname, users.username, tbl_subjects.subject_name, rapor_nilai.*');
		$this->join('users', 'users.username = rapor_nilai.nis', 'LEFT');
		$this->join('tbl_student', 'tbl_student.user_id = users.id', 'LEFT');
		$this->join('tbl_subjects', 'tbl_subjects.id = rapor_nilai.subject_id');
		$this->where(['users.username' => $nis, 'tbl_subjects.str' => $nn]);
		$this->orderBy('tbl_subjects.id', 'ASC');

		$query = $this->get();
		return $query->getResultArray();
	}

	public function save_batch($data){
    	$db      = \Config\Database::connect();
		$builder = $db->table('rapor_nilai');
    	               
        $builder->insertBatch($data);
    }
}
?>
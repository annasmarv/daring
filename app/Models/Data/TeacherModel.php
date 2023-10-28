<?php namespace App\Models\Data;

use CodeIgniter\Model;

class TeacherModel extends Model
{
	protected $table = "tbl_teachers";
	protected $useTimestamps = true;
	protected $allowedFields = ['user_id', 'nip', 'nik', 'gender', 'birth_place', 'birth_date', 'religion'];

	public function get_teacher()
	{
		$this->select("users.id,users.fullname");
		$this->join("users", "tbl_teachers.user_id = users.id");
		$query = $this->get();
		return $query->getResultArray();

	}

	public function profile($user_id)
	{
		$this->select("tbl_teachers.id as profileid, tbl_teachers.user_id, tbl_teachers.nip, tbl_teachers.nik, tbl_teachers.gender, tbl_teachers.birth_place, tbl_teachers.birth_date, tbl_teachers.religion, tbl_teachers.dapouser, tbl_teachers.dapopass, tbl_teachers.infogtkurl, users.fullname, users.username, users.email");
		$this->join("users", "tbl_teachers.user_id = users.id");

		return $this->where(['user_id' => $user_id])->first();
	}

	public function get_teacher_count_all()
	{
		$this->selectCount("id", "JUM");
		$query = $this->get();
		return $query->getRow();

	}

	public function get_teacher_active_all_count($date)
	{
		$this->distinct("tbl_teachers.id");
		$this->select("tbl_teachers.id");
		$this->join("tbl_chat", "(tbl_chat.chat_pengirim = tbl_teachers.user_id and tbl_chat.tgl = '$date')", "LEFT");
		$this->where("tbl_chat.id IS NOT NULL");
		$query = $this->countAllResults();
		return $query;

	}

	public function get_teacher_active_all_list($date)
	{
		$this->select("tbl_teachers.id, tbl_teachers.user_id, mpd_discuss.title, mpd_discuss.class_group_id, tbl_class_group.class_group_name, users.fullname");
		$this->distinct();
		$this->join("tbl_chat", "(tbl_chat.chat_pengirim = tbl_teachers.user_id and tbl_chat.tgl = '$date')", "LEFT");
		$this->join("mpd_discuss", "(mpd_discuss.id = tbl_chat.id_discuss and tbl_chat.tgl = '$date')", "LEFT");
		$this->join("users", "users.id = tbl_teachers.user_id");
		$this->join("tbl_class_group", "tbl_class_group.id = mpd_discuss.class_group_id");
		$this->where("tbl_chat.id IS NOT NULL");
		$query = $this->get();
		return $query->getResultArray();

	}

	public function get_teacher_nonactive_all_count($date)
	{
		$this->select("tbl_teachers.id");
		$this->join("tbl_chat", "(tbl_chat.chat_pengirim = tbl_teachers.user_id and tbl_chat.tgl = '$date')", "LEFT");
		$this->where("tbl_chat.id IS NULL");
		$query = $this->countAllResults();
		return $query;

	}

	public function get_teacher_nonactive_all_list($date)
	{
		$this->select("tbl_teachers.id, tbl_teachers.user_id, tbl_chat.id, mpd_discuss.id, users.fullname");
		$this->distinct();
		$this->join("tbl_chat", "(tbl_chat.chat_pengirim = tbl_teachers.user_id and tbl_chat.tgl = '$date')", "LEFT");
		$this->join("mpd_discuss", "(mpd_discuss.id = tbl_chat.id_discuss and tbl_chat.tgl = '$date')", "LEFT");
		$this->join("users", "users.id = tbl_teachers.user_id");
		$this->where("tbl_chat.id IS NULL");
		$query = $this->get();
		return $query->getResultArray();

	}

}
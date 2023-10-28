<?php namespace App\Models\Data;

use CodeIgniter\Model;

class StudentModel extends Model
{
	protected $table = "tbl_student";
	protected $allowedFields = ['user_id', 'class_group_id', 'status'];
	protected $useTimestamps = false;

	public function get_student()
	{
		$this->select("users.id, users.fullname, users.username, tbl_student.id as studentid, tbl_class_group.class_group_name");
		$this->join("users", "tbl_student.user_id = users.id");
		$this->join("tbl_class_group", "tbl_student.class_group_id = tbl_class_group.id", "LEFT");
		$this->orderBy("tbl_student.class_group_id", "ASC");
		$this->orderBy("users.fullname", "ASC");
		$this->where("tbl_student.status", "1");
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_student_class($class_id)
	{
		$this->select("users.id, users.fullname, users.username, tbl_student.id as studentid, tbl_class_group.class_group_name");
		$this->join("users", "tbl_student.user_id = users.id");
		$this->join("tbl_class_group", "tbl_student.class_group_id = tbl_class_group.id", "LEFT");
		$this->where("tbl_student.class_group_id = $class_id");
		$this->orderBy("tbl_student.class_group_id", "ASC");
		$this->orderBy("users.fullname", "ASC");
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_student_no_class()
	{
		$this->select("users.id, users.fullname, users.username, tbl_student.id as studentid, tbl_class_group.class_group_name");
		$this->join("users", "tbl_student.user_id = users.id");
		$this->join("tbl_class_group", "tbl_student.class_group_id = tbl_class_group.id", "LEFT");
		$this->orderBy("tbl_student.class_group_id", "ASC");
		$this->orderBy("users.username", "ASC");
		$this->where(['tbl_student.class_group_id' => 0, 'tbl_student.status' => 1]);
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_student_gen_ujian($task_id,$class)
	{
		$this->select("users.id as userid, users.fullname, users.username, tbl_student.id as studentid, cbt_siswa_ujian.id as jtid");
		$this->join("users", "tbl_student.user_id = users.id", "LEFT");
		$this->join("tbl_class_group", "tbl_class_group.id = tbl_student.class_group_id", "LEFT");
		$this->join("cbt_siswa_ujian", "cbt_siswa_ujian.task_id = $task_id", "LEFT");
		$this->where(['tbl_class_group.id' => $class]);
		$this->where('cbt_siswa_ujian.user_id IS NULL');
		$this->orderBy("tbl_student.class_group_id", "ASC");
		$this->orderBy("users.username", "ASC");
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_student_detail_id($id)
	{
		$this->select("users.fullname, users.username, users.id, tbl_class_group.id as classid, tbl_class_group.class_group_name");
		$this->join("users", "tbl_student.user_id = users.id");
		$this->join("tbl_class_group", "tbl_class_group.id = tbl_student.class_group_id");
		$this->where(['users.id' => $id]);
		return $this->get();
	}

	public function get_student_detail($nis)
	{
		$this->select("users.fullname, users.username, users.id, tbl_class_group.id as classid, tbl_class_group.class_group_name");
		$this->join("users", "tbl_student.user_id = users.id");
		$this->join("tbl_class_group", "tbl_class_group.id = tbl_student.class_group_id");
		$this->where(['users.username' => $nis]);
		return $this->get();
	}

	public function get_student_level($user_id)
	{
		$this->select("tbl_student.user_id, tbl_class_group.id, tbl_class_group.class_level_id");
		$this->join("tbl_class_group", "tbl_student.class_group_id = tbl_class_group.id");
		$this->where("tbl_student.user_id", $user_id);
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_student_by_class_id($class_id)
	{
		$this->select('tbl_student.user_id, tbl_student.class_group_id, tbl_class_group.class_group_name, users.username, users.fullname');
		$this->join('tbl_class_group', 'tbl_class_group.id = tbl_student.class_group_id', 'LEFT');
		$this->join('users', 'users.id = tbl_student.user_id');
		$this->where(['tbl_student.class_group_id' => $class_id]);
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_task_date_get()
	{
		$class_id 	= $_GET['kelas'];
		$subject_id = $_GET['mapel'];
		$awal 		= $_GET['awal'];
		$akhir 		= strtotime($awal);
		$akhir 		= strtotime("+ 4 day", $akhir);
		$akhir 		= date('Y-m-d', $akhir);
		// $akhir 		= $_GET['akhir'];
		$user = user()->id;
		$this->select('tbl_student.id as stid, users.fullname, users.username, mpd_task.id, mpd_task.task_name, mpd_join_task.task_id, mpd_join_task.status as st_pengerjaan, mpd_join_task.id as jtid');			
		$this->join('mpd_task', "mpd_task.class_group_id = tbl_student.class_group_id AND mpd_task.task_date_start >='$awal' AND mpd_task.task_date_finish <='$akhir'", 'LEFT');
		$this->join('mpd_join_task', 'mpd_join_task.user_id = tbl_student.user_id and mpd_join_task.task_id = mpd_task.id and mpd_join_task.status = mpd_join_task.status and mpd_join_task.id = mpd_join_task.id', 'LEFT');
		$this->join('users', 'users.id = tbl_student.user_id');
		$this->where(['mpd_task.teacher_id' => $user, 'mpd_task.class_group_id' => $class_id, 'mpd_task.subject_id' => $subject_id]);
		$this->where('mpd_task.task_date_start >=', $awal);
		$this->where('mpd_task.task_date_finish <=', $akhir);
		$this->orderBy('mpd_task.id ASC');
		$this->orderBy('users.fullname ASC');
		$query = $this->get();
		return $query->getResultArray();
	}


	public function get_student_count_all()
	{
		$this->selectCount("id", "JUM");
		$this->where("status", "1");
		$query = $this->get();
		return $query->getRow();

	}

	public function get_student_active_all_count($date)
	{
		$this->distinct("tbl_student.id");
		$this->select("tbl_student.id");
		$this->join("tbl_chat", "(tbl_chat.chat_pengirim = tbl_student.user_id and tbl_chat.tgl = '$date')", "LEFT");
		$this->join("mpd_join_task", "(mpd_join_task.user_id = tbl_student.user_id and mpd_join_task.date = '$date')", "LEFT");
		$this->join("mpd_readmodul", "(mpd_readmodul.user_id = tbl_student.user_id and mpd_readmodul.date = '$date')", "LEFT");
		$this->where("tbl_student.status", "1");
		$this->where("tbl_chat.id IS NOT NULL");
		$this->orWhere("mpd_join_task.id IS NOT NULL");
		$this->orWhere("mpd_readmodul.id IS NOT NULL");
		$query = $this->countAllResults();
		return $query;
	}

	public function get_student_active_all_list($date)
	{
		$this->select("tbl_student.id, tbl_student.user_id, tbl_class_group.class_group_name, tbl_chat.chat_pengirim, mpd_join_task.user_id as tid, mpd_readmodul.user_id as rid, users.fullname");
		$this->distinct();
		$this->join("tbl_chat", "(tbl_chat.chat_pengirim = tbl_student.user_id and tbl_chat.tgl = '$date')", "LEFT");
		$this->join("mpd_join_task", "(mpd_join_task.user_id = tbl_student.user_id and mpd_join_task.date = '$date')", "LEFT");
		$this->join("mpd_readmodul", "(mpd_readmodul.user_id = tbl_student.user_id and mpd_readmodul.date = '$date')", "LEFT");
		$this->join("tbl_class_group", "tbl_class_group.id = tbl_student.class_group_id");
		$this->join("users", "users.id = tbl_student.user_id");
		$this->where("tbl_chat.id IS NOT NULL");
		$this->orWhere("mpd_join_task.id IS NOT NULL");
		$this->orWhere("mpd_readmodul.id IS NOT NULL");
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_student_nonactive_all_count($date)
	{
		$this->select("tbl_student.id");
		$this->join("tbl_chat", "(tbl_chat.chat_pengirim = tbl_student.user_id and tbl_chat.tgl = '$date')", "LEFT");
		$this->join("mpd_join_task", "(mpd_join_task.user_id = tbl_student.user_id and mpd_join_task.date = '$date')", "LEFT");
		$this->join("mpd_readmodul", "(mpd_readmodul.user_id = tbl_student.user_id and mpd_readmodul.date = '$date')", "LEFT");
		$this->where("tbl_student.status", "1");
		$this->where("tbl_chat.id IS NULL");
		$this->Where("mpd_join_task.id IS NULL");
		$this->Where("mpd_readmodul.id IS NULL");
		$query = $this->countAllResults();
		return $query;

	}

	public function get_student_nonactive_all_list($date)
	{
		$this->select("tbl_student.id, tbl_student.user_id, tbl_class_group.class_group_name, tbl_chat.chat_pengirim, mpd_join_task.user_id as tid, mpd_readmodul.user_id as rid, users.fullname");
		$this->join("tbl_chat", "(tbl_chat.chat_pengirim = tbl_student.user_id and tbl_chat.tgl = '$date')", "LEFT");
		$this->join("mpd_join_task", "(mpd_join_task.user_id = tbl_student.user_id and mpd_join_task.date = '$date')", "LEFT");
		$this->join("mpd_readmodul", "(mpd_readmodul.user_id = tbl_student.user_id and mpd_readmodul.date = '$date')", "LEFT");
		$this->join("tbl_class_group", "tbl_class_group.id = tbl_student.class_group_id");
		$this->join("users", "users.id = tbl_student.user_id");
		$this->where("tbl_chat.id IS NULL");
		$this->Where("mpd_join_task.id IS NULL");
		$this->Where("mpd_readmodul.id IS NULL");
		$query = $this->get();
		return $query->getResultArray();

	}

	public function get_absen_isactive_today_count($date)
	{
		date_default_timezone_set("Asia/Jakarta");
		$this->distinct("tbl_student.id");
		$this->select("tbl_student.id");
		$this->join("tbl_absen", "(tbl_absen.user_id = tbl_student.user_id and tbl_absen.XDate = '$date')", "LEFT");
		$this->where("tbl_absen.user_id IS NOT NULL");
		$query = $this->countAllResults();
		return $query;
	}

	public function get_absen_isactive_today_list($date)
	{
		date_default_timezone_set("Asia/Jakarta");
		$this->distinct("tbl_student.id");
		$this->select("tbl_student.id, tbl_student.user_id, tbl_class_group.class_group_name, tbl_absen.XDate, tbl_absen.XTime, users.fullname");
		$this->join("tbl_absen", "(tbl_absen.user_id = tbl_student.user_id and tbl_absen.XDate = '$date')", "LEFT");
		$this->join("tbl_class_group", "tbl_class_group.id = tbl_student.class_group_id");
		$this->join("users", "users.id = tbl_student.user_id");
		$this->where("tbl_student.status", "1");
		$this->where("tbl_absen.user_id IS NOT NULL");
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_absen_nonactive_today_count($date)
	{
		date_default_timezone_set("Asia/Jakarta");
		$this->select("tbl_student.id");
		$this->join("tbl_absen", "(tbl_absen.user_id = tbl_student.user_id and tbl_absen.XDate = '$date')", "LEFT");
		$this->where("tbl_student.status", "1");
		$this->where("tbl_absen.user_id IS NULL");
		$query = $this->countAllResults();
		return $query;
	}

	public function get_absen_nonactive_today_list($date)
	{
		date_default_timezone_set("Asia/Jakarta");
		$this->select("tbl_student.id, tbl_student.user_id, tbl_class_group.class_group_name, tbl_absen.XDate, tbl_absen.XTime, users.fullname");
		$this->join("tbl_absen", "(tbl_absen.user_id = tbl_student.user_id and tbl_absen.XDate = '$date')", "LEFT");
		$this->join("tbl_class_group", "tbl_class_group.id = tbl_student.class_group_id");
		$this->join("users", "users.id = tbl_student.user_id");
		$this->where("tbl_absen.user_id IS NULL");
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_user_interactive_absen($inter_id,$class_group_id)
	{
		$this->select("users.fullname, mpd_join_interactive.interactive_id, mpd_join_interactive.XDate, mpd_join_interactive.XTime");
		$this->join("mpd_join_interactive", "(mpd_join_interactive.interactive_id = $inter_id and mpd_join_interactive.user_id = tbl_student.user_id)","LEFT");
		$this->join("users", "users.id = tbl_student.user_id");
		$this->where("tbl_student.status", "1");
		$this->where(["tbl_student.class_group_id" => $class_group_id]);
		$this->orderBy("tbl_student.user_id asc");
		$query = $this->get();
		return $query->getResultArray();
	}

	public function get_meet_agenda($meet_id,$class_group_id)
	{
		$this->select("users.fullname, mpd_join_interactive.interactive_id, mpd_join_interactive.XDate, mpd_join_interactive.XTime, mpd_readmodul.read_date, mpd_join_task.date_task");
		$this->join("mpd_meet", "(mpd_meet.id = $meet_id and mpd_meet.class_group_id = $class_group_id)", "LEFT");
		$this->join("mpd_join_interactive", "(mpd_join_interactive.interactive_id = mpd_meet.interaktif_id and mpd_join_interactive.user_id = tbl_student.user_id)","LEFT");
		$this->join("mpd_readmodul", "(mpd_readmodul.id_modul = mpd_meet.modul_id and mpd_readmodul.user_id = tbl_student.user_id)","LEFT");
		$this->join("mpd_join_task", "(mpd_join_task.task_id = mpd_meet.task_id and mpd_join_task.user_id = tbl_student.user_id)","LEFT");
		$this->join("users", "users.id = tbl_student.user_id", "LEFT");
		$this->where(["tbl_student.class_group_id" => $class_group_id]);
		$this->where("tbl_student.status", "1");
		$this->orderBy("tbl_student.user_id asc");
		$query = $this->get();
		return $query->getResultArray();
	}

}
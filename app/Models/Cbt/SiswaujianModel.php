<?php namespace App\Models\Cbt;

use CodeIgniter\Model;

class SiswaujianModel extends Model
{
	protected $table = 'cbt_siswa_ujian_fix';
    protected $allowedFields = ['user_id', 'task_id', 'N2', 'date', 'date_task', 'exam_time', 'start_time', 'long_time', 'last_update', 'token', 'status'];
	
    public function save_batch($data){
        $db      = \Config\Database::connect();
        $builder = $db->table('cbt_siswa_ujian_fix ');
                       
        $builder->insertBatch($data);
    }

    public function get_user_task($id)
    {
        $x = "''";
        $this->select('cbt_siswa_ujian_fix.id, cbt_siswa_ujian_fix.user_id, cbt_siswa_ujian_fix.task_id, cbt_siswa_ujian_fix.N2, cbt_siswa_ujian_fix .status, users.fullname, users.username');
        $this->selectSum('cbt_jawaban_fix.XNilai', 'NA');
        $this->join('cbt_jawaban_fix', ('cbt_jawaban_fix.user_id = cbt_siswa_ujian_fix .user_id and cbt_jawaban_fix.task_id = cbt_siswa_ujian_fix .task_id'), 'LEFT');
        $this->join('users', 'users.id = cbt_siswa_ujian_fix .user_id');
        $this->groupBy('cbt_siswa_ujian_fix .user_id');
        $this->where(['cbt_siswa_ujian_fix .task_id' => $id]);
        $query = $this->get();
        return $query->getResultArray();

        $this->select('mpd_join_task.id, mpd_join_task.user_id, mpd_join_task.task_id, mpd_join_task.N2, mpd_join_task.status, users.fullname, users.username');
        $this->selectSum('mpd_answer.XNilai', 'NA');
        $this->join('tbl_student', ('tbl_student.user_id = mpd_join_task.user_id OR mpd_join_task.user_id IS NULL'), 'LEFT');
        $this->join('mpd_answer', ('mpd_answer.user_id = mpd_join_task.user_id and mpd_answer.task_id = mpd_join_task.task_id'), 'LEFT');
        $this->join('users', 'users.id = mpd_join_task.user_id', 'LEFT');
        $this->groupBy('mpd_join_task.user_id');
        $this->where(['mpd_join_task.task_id' => $id]);
    }

	public function get_join_task($user_id,$task_id)
    {
        $this->select('id,status');
        return $this->where(['user_id' => $user_id, 'task_id' => $task_id])->first();
    }

    public function get_id_join_task($user_id,$task_id)
    {
        $this->select('id');
        $this->where(['user_id' => $user_id, 'task_id' => $task_id]);
         return $this->get();  
    }

    public function count_by_user_tes($user_id, $task_id){
        $this->selectCount('id')
                ->where(['user_id' => $user_id, 'task_id' =>$task_id]);
        return $this->get();
    }

    public function count_by_user_tes_1($user_id, $task_id){
        $ok = $this->selectCount('id')
                ->where(['user_id' => $user_id, 'task_id' =>$task_id])->first();
        $okC = $ok['id'];
        return $okC;
    }

    public function get_user_NA($id)
    {
        $user_id = user()->id;
        $this->select('cbt_siswa_ujian_fix .user_id, cbt_siswa_ujian_fix .task_id, users.fullname');
        $this->selectSum('cbt_jawaban_fix.XNilai', 'NA');
        $this->join('cbt_jawaban_fix', ('cbt_jawaban_fix.user_id = cbt_siswa_ujian_fix .user_id and cbt_jawaban_fix.task_id = cbt_siswa_ujian_fix .task_id'));
        $this->join('users', 'users.id = cbt_siswa_ujian_fix .user_id');
        $this->groupBy('cbt_siswa_ujian_fix .user_id');
        $this->where(['cbt_siswa_ujian_fix .task_id' => $id, 'cbt_jawaban_fix.user_id' => $user_id ]);
        $query = $this->get();
        return $query;
    }

    public function get_user_NA_1($id,$user_id)
    {
        // $user_id = user()->id;
        // $this->select('cbt_siswa_ujian_fix .user_id, cbt_siswa_ujian_fix .task_id, users.fullname');
        $this->selectSum('cbt_jawaban_fix.XNilai', 'NA');
        $this->join('cbt_jawaban_fix', ('cbt_jawaban_fix.user_id = cbt_siswa_ujian_fix .user_id and cbt_jawaban_fix.task_id = cbt_siswa_ujian_fix .task_id'));
        $this->join('users', 'users.id = cbt_siswa_ujian_fix .user_id');
        $this->groupBy('cbt_siswa_ujian_fix .user_id');
        return $this->where(['cbt_jawaban_fix.quest_type' => 1, 'cbt_siswa_ujian_fix .task_id' => $id, 'cbt_jawaban_fix.user_id' => $user_id ])->first();
        // $query = $this->get();
        // return $query;
    }

    public function get_user_NA_2($id,$user_id)
    {
        $this->select('cbt_siswa_ujian_fix .user_id, cbt_siswa_ujian_fix .task_id, users.fullname');
        $this->selectSum('cbt_jawaban_fix.XNilai', 'NA');
        $this->join('cbt_jawaban_fix', ('cbt_jawaban_fix.user_id = cbt_siswa_ujian_fix .user_id and cbt_jawaban_fix.task_id = cbt_siswa_ujian_fix .task_id'));
        $this->join('users', 'users.id = cbt_siswa_ujian_fix .user_id');
        $this->groupBy('cbt_siswa_ujian_fix .user_id');
        return $this->where(['quest_type' => 2, 'cbt_siswa_ujian_fix .task_id' => $id, 'cbt_jawaban_fix.user_id' => $user_id ])->first();
    }

}
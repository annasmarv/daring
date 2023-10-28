<?php namespace App\Models\Cbt;

use CodeIgniter\Model;

class Siswaujian2Model extends Model
{
	protected $table = 'cbt_siswa_ujian';
    protected $allowedFields = ['user_id', 'task_id', 'date', 'date_task', 'exam_time', 'start_time', 'long_time', 'last_update', 'token', 'status'];
	
    public function save_batch($data){
        $db      = \Config\Database::connect();
        $builder = $db->table('cbt_siswa_ujian');
                       
        $builder->insertBatch($data);
    }

    public function get_user_task($id)
    {
        $x = "''";
        $this->select('cbt_siswa_ujian.id, cbt_siswa_ujian.user_id, cbt_siswa_ujian.task_id, cbt_siswa_ujian.status, users.fullname, users.username');
        $this->selectSum('cbt_jawaban.XNilai', 'NA');
        $this->join('cbt_jawaban', ('cbt_jawaban.user_id = cbt_siswa_ujian.user_id and cbt_jawaban.task_id = cbt_siswa_ujian.task_id'), 'LEFT');
        $this->join('users', 'users.id = cbt_siswa_ujian.user_id');
        $this->groupBy('cbt_siswa_ujian.user_id');
        $this->where(['cbt_siswa_ujian.task_id' => $id]);
        $query = $this->get();
        return $query->getResultArray();
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
        $this->select('cbt_siswa_ujian.user_id, cbt_siswa_ujian.task_id, users.fullname');
        $this->selectSum('cbt_jawaban.XNilai', 'NA');
        $this->join('cbt_jawaban', ('cbt_jawaban.user_id = cbt_siswa_ujian.user_id and cbt_jawaban.task_id = cbt_siswa_ujian.task_id'));
        $this->join('users', 'users.id = cbt_siswa_ujian.user_id');
        $this->groupBy('cbt_siswa_ujian.user_id');
        $this->where(['cbt_siswa_ujian.task_id' => $id, 'cbt_jawaban.user_id' => $user_id ]);
        $query = $this->get();
        return $query;
    }

    public function get_user_NA_1($id,$user_id)
    {
        // $user_id = user()->id;
        // $this->select('cbt_siswa_ujian.user_id, cbt_siswa_ujian.task_id, users.fullname');
        $this->selectSum('cbt_jawaban.XNilai', 'NA');
        $this->join('cbt_jawaban', ('cbt_jawaban.user_id = cbt_siswa_ujian.user_id and cbt_jawaban.task_id = cbt_siswa_ujian.task_id'));
        $this->join('users', 'users.id = cbt_siswa_ujian.user_id');
        $this->groupBy('cbt_siswa_ujian.user_id');
        return $this->where(['cbt_jawaban.quest_type' => 1, 'cbt_siswa_ujian.task_id' => $id, 'cbt_jawaban.user_id' => $user_id ])->first();
        // $query = $this->get();
        // return $query;
    }

    public function get_user_NA_2($id,$user_id)
    {
        $this->select('cbt_siswa_ujian.user_id, cbt_siswa_ujian.task_id, users.fullname');
        $this->selectSum('cbt_jawaban.XNilai', 'NA');
        $this->join('cbt_jawaban', ('cbt_jawaban.user_id = cbt_siswa_ujian.user_id and cbt_jawaban.task_id = cbt_siswa_ujian.task_id'));
        $this->join('users', 'users.id = cbt_siswa_ujian.user_id');
        $this->groupBy('cbt_siswa_ujian.user_id');
        return $this->where(['quest_type' => 2, 'cbt_siswa_ujian.task_id' => $id, 'cbt_jawaban.user_id' => $user_id ])->first();
    }

}
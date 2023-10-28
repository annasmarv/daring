<?php namespace App\Models;

use CodeIgniter\Model;

class JointaskModel extends Model
{
	protected $table = 'mpd_join_task';
    protected $allowedFields = ['user_id', 'task_id', 'N2', 'date_task', 'last_update', 'chance', 'status', 'date'];
	
	public function get_join_task($user_id,$task_id)
    {
        $this->select('id,status');
        return $this->where(['user_id' => $user_id, 'task_id' => $task_id])->first();
    }

    public function get_id_join_task($user_id,$task_id)
    {
        $this->select('id,chance');
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

    public function save_batch($data){
        $db      = \Config\Database::connect();
        $builder = $db->table('mpd_join_task');
                       
        $builder->insertBatch($data);
    }

}
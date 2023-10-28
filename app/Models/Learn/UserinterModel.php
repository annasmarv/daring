<?php namespace App\Models\Learn;

use CodeIgniter\Model;

class UserinterModel extends Model
{
	protected $table = 'mpd_join_interactive';
	protected $useTimestamps = true;
	protected $allowedFields = ['user_id', 'interactive_id', 'created_at', 'updated_at'];
	
	public function get_user_interactive($date,$user_id,$inter_id)
	{
		$this->select('mpd_join_interactive.user_id, mpd_join_interactive.interactive_id');
		$this->where(['mpd_join_interactive.user_id' => $user_id, 'mpd_join_interactive.interactive_id' => $inter_id, 'created_at' => $date]);
		$query = $this->get();
		return $query->getResultArray();
	}
}
?>
<?php namespace App\Models;

use CodeIgniter\Model;

class PresensiKwkModel extends Model
{
	protected $table = 'tbl_presensi_kwk';
	protected $useTimestamps = true;
	protected $allowedFields = ['code', 'nip', 'month', 'kwk', 'skwk'];

	public function save_batch($data){
    	$db      = \Config\Database::connect();
		$builder = $db->table('tbl_presensi_kwk');
    	               
        $builder->insertBatch($data);
    }
	
}
?>
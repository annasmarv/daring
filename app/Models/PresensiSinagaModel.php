<?php namespace App\Models;

use CodeIgniter\Model;

class PresensiSinagaModel extends Model
{
	protected $table = 'tbl_presensi_sinaga';
	protected $useTimestamps = true;
	protected $allowedFields = ['code', 'nip', 'month', 'date', 'am', 'ap', 'status'];

	public function save_batch($data){
    	$db      = \Config\Database::connect();
		$builder = $db->table('tbl_presensi_sinaga');
    	               
        $builder->insertBatch($data);
    }
	
}
?>
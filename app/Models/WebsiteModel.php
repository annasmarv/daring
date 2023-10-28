<?php namespace App\Models;

use CodeIgniter\Model;

class WebsiteModel extends Model
{
	protected $table = 'website';
	protected $useTimestamps = true;
	protected $allowedFields = ['name', 'logo', 'text_logo', 'logo_text', 'favicon', 'footer', 'email', 'url', 'phone', 'address', 'maps', 'facebook', 'twitter', 'instagram', 'youtube', 'meta_description', 'meta_keyword', 'meta_favicon', 'city_id'];

	public function getSetting()
	{
		$this->select('*');
		$this->where('id', 1);
		return $this->first();
	}

	public function getSettings()
	{
		$this->select('*');
		$this->where('id', 1);
		// $this->get();
		return $this->get();
	}
	
}
?>
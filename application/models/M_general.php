<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_general extends CI_Model {
	public $variable;
	public function __construct()
	{
		parent::__construct();
		
	}
	public function recentNews()
	{
		$this->db->limit(1);
		$this->db->order_by('DATE(created_at)', 'desc');
		return $this->db->get('z_artikel');
	}
	//auth function
	public function verify($table, $condition)
	{
		return $this->db->get_where($table, $condition);
	}
	//general function CRUD
	public function add($table, $data)
	{
		return $this->db->insert($table, $data);
	}
	public function edit($table, $condition)
	{
		return $this->db->get_where($table, $condition);
	}
	public function update($table, $condition, $data)
	{
		return $this->db->update($table, $data, $condition);
	}
	public function delete($table, $condition)
	{
		return $this->db->delete($table, $condition);;
	}
	public function getData($table)
	{
		return $this->db->get($table);
	}
	//end function CRUD
	
	public function getDataDesc($table, $field)
	{
		$this->db->order_by(''.$field, 'desc');
		return $this->db->get($table);
	}
	public function insertId($table, $data)
	{
		$this->db->insert($table, $data);
		return $this->db->insert_id();;
	}
	public function insBatch($table, $data)
	{
		return $this->db->insert_batch($table, $data);
	}
	public function updateBatch($table, $data){
		return $this->db->update_batch($table, $data, 'id');
	}
	public function lastId($table)
	{
		$this->db->select('AUTO_INCREMENT');
		$this->db->from('information_schema.TABLES');
		$this->db->where('TABLE_SCHEMA', 'baligatr_mydio');
		$this->db->where('TABLE_NAME', $table);
		return $this->db->get();
	}
	public function newsFeatured($lang)
	{
		$this->db->select('*');
		$this->db->from('z_artikel');
		$this->db->where('bahasa', $lang);
		$this->db->order_by('DATE(created_at)', 'desc');
		$this->db->limit(4, 0);
		return $this->db->get()->result_array();
	}
	public function newsListing($lang)
	{
		$this->db->select('*');
		$this->db->from('z_artikel');
		$this->db->where('bahasa', $lang);
		$this->db->limit(4, 4);
		$this->db->order_by('DATE(created_at)', 'desc');
		return $this->db->get()->result_array();
	}
	public function newsListingAjax($lang, $offset)
	{
		$this->db->select('*');
		$this->db->from('z_artikel');
		$this->db->where('bahasa', $lang);
		$this->db->limit(4, $offset);
		$this->db->order_by('DATE(created_at)', 'desc');
		return $this->db->get()->result_array();
	}
	public function youtube()
	{
		$this->db->order_by('id', 'desc');
		return $this->db->get('z_video');
	}
}
/* End of file M_general.php */
/* Location: ./application/models/M_general.php */ 
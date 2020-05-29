<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_DataPost extends CI_Model {

	public $variable;
	var $table  ='z_artikel';
	var $column_order = array(null,'id', 'judul', 'bahasa'); //set column field database for datatable orderable
    var $column_search = array(null,'id', 'judul', 'bahasa'); 
    //set column field database for datatable searchable 
    var $order = array('id' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		
	}

	private function _get_datatables_query()
        {
        $this->db->select('id, judul, bahasa, jumlah_tayangan, link');
        $this->db->from($this->table);
        $i = 0;

        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->escape_like_str($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
	}

	function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result_array();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}

/* End of file M_DataPost.php */
/* Location: ./application/models/M_DataPost.php */ 
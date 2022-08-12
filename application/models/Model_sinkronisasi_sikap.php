<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_sinkronisasi_sikap extends MY_Model {

	private $primary_key 	= 'id_sinkronisasi';
	private $table_name 	= 'sinkronisasi_sikap';
	private $field_search 	= ['id_indikator_pbp', 'id_penilaian_sikap'];

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
		 	'table_name' 	=> $this->table_name,
		 	'field_search' 	=> $this->field_search,
		 );

		parent::__construct($config);
	}

	public function count_all($q = null, $field = null)
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "sinkronisasi_sikap.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "sinkronisasi_sikap.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "sinkronisasi_sikap.".$field . " LIKE '%" . $q . "%' )";
        }

		$this->join_avaiable();
        $this->db->where($where);
		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}

	public function get($q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "sinkronisasi_sikap.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "sinkronisasi_sikap.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "sinkronisasi_sikap.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('sinkronisasi_sikap.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

	public function join_avaiable() {
		$this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = sinkronisasi_sikap.id_indikator_pbp', 'LEFT');
	    $this->db->join('penilaian_sikap', 'penilaian_sikap.id_penilaian_sikap = sinkronisasi_sikap.id_penilaian_sikap', 'LEFT');
	    
    	return $this;
	}

}

/* End of file Model_sinkronisasi_sikap.php */
/* Location: ./application/models/Model_sinkronisasi_sikap.php */
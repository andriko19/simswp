<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_rapot_pbp extends MY_Model {

	private $primary_key 	= 'id_rapot_pbp';
	private $table_name 	= 'rapot_pbp';
	private $field_search 	= ['id_siswa', 'id_semester', 'id_pilar_pbp_1', 'catatan_pbp_1', 'id_pilar_pbp_2', 'catatan_pbp_2', 'id_pilar_pbp_3', 'catatan_pbp_3', 'id_pilar_pbp_4', 'catatan_pbp_4', 'id_pilar_pbp_5', 'catatan_pbp_5', 'id_pilar_pbp_6', 'catatan_pbp_6', 'tanggal', 'id_guru'];

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
	                $where .= "rapot_pbp.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "rapot_pbp.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "rapot_pbp.".$field . " LIKE '%" . $q . "%' )";
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
	                $where .= "rapot_pbp.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "rapot_pbp.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "rapot_pbp.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('rapot_pbp.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

	public function join_avaiable() {
		$this->db->join('siswa', 'siswa.id_siswa = rapot_pbp.id_siswa', 'LEFT');
	    $this->db->join('semester', 'semester.id_semester = rapot_pbp.id_semester', 'LEFT');
	    
    	return $this;
	}

}

/* End of file Model_rapot_pbp.php */
/* Location: ./application/models/Model_rapot_pbp.php */
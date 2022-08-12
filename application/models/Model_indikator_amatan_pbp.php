<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_indikator_amatan_pbp extends MY_Model {

	private $primary_key 	= 'id_indikator_pbp';
	private $table_name 	= 'indikator_amatan_pbp';
	private $field_search 	= ['kode_indikator', 'id_dimensi_pbp', 'indikator'];

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
	                $where .= "indikator_amatan_pbp.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "indikator_amatan_pbp.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "indikator_amatan_pbp.".$field . " LIKE '%" . $q . "%' )";
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
	                $where .= "indikator_amatan_pbp.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "indikator_amatan_pbp.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "indikator_amatan_pbp.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('indikator_amatan_pbp.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

	public function join_avaiable() {
		$this->db->select('indikator_amatan_pbp.*, dimensi_pbp.dimensi_pbp as dimensi_pbp, pilar_pbp.pilar_pbp as pilar_pbp, kode_sekolah.kode_sekolah as kode_sekolah');

		$this->db->join('dimensi_pbp', 'dimensi_pbp.id_dimensi_pbp = indikator_amatan_pbp.id_dimensi_pbp', 'LEFT');
		$this->db->join('pilar_pbp', 'pilar_pbp.id_pilar_pbp = dimensi_pbp.id_pilar_pbp', 'LEFT');
		$this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = indikator_amatan_pbp.id_kodesekolah', 'LEFT');
	    
    	return $this;
	}

}

/* End of file Model_indikator_amatan_pbp.php */
/* Location: ./application/models/Model_indikator_amatan_pbp.php */
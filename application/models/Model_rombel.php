<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_rombel extends MY_Model
{

	private $primary_key 	= 'id_rombel';
	private $table_name 	= 'rombel';
	private $field_search 	= ['kode_sekolah', 'kode_jurusan', 'nama_rombel', 'wali_kelas', 'kelas', 'periode'];
	private $smk            = "3";
	private $sma            = "2";
	private $smp            = "1";
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
					$where .= "rombel." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "rombel." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "rombel." . $field . " LIKE '%" . $q . "%' )";
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
					$where .= "rombel." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "rombel." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "rombel." . $field . " LIKE '%" . $q . "%' )";
		}

		if (is_array($select_field) and count($select_field)) {
			$this->db->select($select_field);
		}

		$this->join_avaiable();
		$this->db->where($where);
		$this->db->limit($limit, $offset);
		$this->db->order_by('rombel.' . $this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}
	//filter smk
	public function count_all2($q = null, $field = null)
	{
		$iterasi = 1;
		$num = count($this->field_search);
		$where = NULL;
		$q = $this->scurity($q);
		$field = $this->scurity($field);

		if (empty($field)) {
			foreach ($this->field_search as $field) {
				if ($iterasi == 1) {
					$where .= "rombel." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "rombel." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "rombel." . $field . " LIKE '%" . $q . "%' )";
		}
		$where .= "and rombel.kode_sekolah=" . $this->smk;
		$this->join_avaiable();
		$this->db->where($where);
		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}

	public function get2($q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
	{
		$iterasi = 1;
		$num = count($this->field_search);
		$where = NULL;
		$q = $this->scurity($q);
		$field = $this->scurity($field);

		if (empty($field)) {
			foreach ($this->field_search as $field) {
				if ($iterasi == 1) {
					$where .= "rombel." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "rombel." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "rombel." . $field . " LIKE '%" . $q . "%' )";
		}

		if (is_array($select_field) and count($select_field)) {
			$this->db->select($select_field);
		}
		$where .= "and rombel.kode_sekolah=" . $this->smk;
		$this->join_avaiable();
		$this->db->where($where);
		$this->db->limit($limit, $offset);
		$this->db->order_by('rombel.' . $this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}
	//filter sma
	public function count_all3($q = null, $field = null)
	{
		$iterasi = 1;
		$num = count($this->field_search);
		$where = NULL;
		$q = $this->scurity($q);
		$field = $this->scurity($field);

		if (empty($field)) {
			foreach ($this->field_search as $field) {
				if ($iterasi == 1) {
					$where .= "rombel." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "rombel." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "rombel." . $field . " LIKE '%" . $q . "%' )";
		}
		$where .= "and rombel.kode_sekolah=" . $this->sma;
		$this->join_avaiable();
		$this->db->where($where);
		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}

	public function get3($q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
	{
		$iterasi = 1;
		$num = count($this->field_search);
		$where = NULL;
		$q = $this->scurity($q);
		$field = $this->scurity($field);

		if (empty($field)) {
			foreach ($this->field_search as $field) {
				if ($iterasi == 1) {
					$where .= "rombel." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "rombel." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "rombel." . $field . " LIKE '%" . $q . "%' )";
		}

		if (is_array($select_field) and count($select_field)) {
			$this->db->select($select_field);
		}
		$where .= "and rombel.kode_sekolah=" . $this->sma;
		$this->join_avaiable();
		$this->db->where($where);
		$this->db->limit($limit, $offset);
		$this->db->order_by('rombel.' . $this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}
	//filter smp
	public function count_all4($q = null, $field = null)
	{
		$iterasi = 1;
		$num = count($this->field_search);
		$where = NULL;
		$q = $this->scurity($q);
		$field = $this->scurity($field);

		if (empty($field)) {
			foreach ($this->field_search as $field) {
				if ($iterasi == 1) {
					$where .= "rombel." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "rombel." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "rombel." . $field . " LIKE '%" . $q . "%' )";
		}
		$where .= "and rombel.kode_sekolah=" . $this->smp;
		$this->join_avaiable();
		$this->db->where($where);
		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}

	public function get4($q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
	{
		$iterasi = 1;
		$num = count($this->field_search);
		$where = NULL;
		$q = $this->scurity($q);
		$field = $this->scurity($field);

		if (empty($field)) {
			foreach ($this->field_search as $field) {
				if ($iterasi == 1) {
					$where .= "rombel." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "rombel." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "rombel." . $field . " LIKE '%" . $q . "%' )";
		}

		if (is_array($select_field) and count($select_field)) {
			$this->db->select($select_field);
		}
		$where .= "and rombel.kode_sekolah=" . $this->smp;
		$this->join_avaiable();
		$this->db->where($where);
		$this->db->limit($limit, $offset);
		$this->db->order_by('rombel.' . $this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

	public function join_avaiable()
	{
		$this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = rombel.kode_sekolah', 'LEFT');
		$this->db->join('kode_jurusan', 'kode_jurusan.id_kodejurusan = rombel.kode_jurusan', 'LEFT');
		$this->db->join('guru', 'guru.id_guru = rombel.wali_kelas', 'LEFT');
		$this->db->join('kelas', 'kelas.kode_kelas = rombel.kelas', 'LEFT');
		$this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

		return $this;
	}
}

/* End of file Model_rombel.php */
/* Location: ./application/models/Model_rombel.php */
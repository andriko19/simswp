<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_guru extends MY_Model
{

	private $primary_key 	= 'id_guru';
	private $table_name 	= 'guru';
	private $field_search 	= ['nip', 'nama_guru', 'id_jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'nik', 'niy_nigk', 'nuptk', 'id_status_kepegawaian', 'id_jenis_ptk', 'pengawas_bidang_studi', 'id_agama', 'alamat_jalan', 'rt', 'rw', 'nama_dusun', 'desa_kelurahan', 'kecamatan', 'kode_pos', 'telepon', 'hp', 'email', 'tugas_tambahan', 'id_status_keaktifan', 'sk_cpns', 'tanggal_cpns', 'sk_pengangkatan', 'tmt_pengangkatan', 'lembaga_pengangkatan', 'id_golongan', 'keahlian_laboratorium', 'sumber_gaji', 'nama_ibu_kandung', 'id_status_pernikahan', 'nama_suami_istri', 'nip_suami_istri', 'pekerjaan_suami_istri', 'tmt_pns', 'lisensi_kepsek', 'jumlah_sekolah_binaan', 'diklat_kepengawasan', 'mampu_handle_kk', 'keahlian_breile', 'keahlian_bahasa_isyarat', 'npwp', 'kewarganegaraan', 'foto', 'id_sekolah'];
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
					$where .= "guru." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "guru." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "guru." . $field . " LIKE '%" . $q . "%' )";
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
					$where .= "guru." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "guru." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "guru." . $field . " LIKE '%" . $q . "%' )";
		}

		if (is_array($select_field) and count($select_field)) {
			$this->db->select($select_field);
		}

		$this->join_avaiable();
		$this->db->where($where);
		$this->db->limit($limit, $offset);
		$this->db->order_by('guru.' . $this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

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
					$where .= "guru." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "guru." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "guru." . $field . " LIKE '%" . $q . "%' )";
		}

		$where .= "and id_sekolah=" . $this->smk;

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
					$where .= "guru." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "guru." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "guru." . $field . " LIKE '%" . $q . "%' )";
		}

		if (is_array($select_field) and count($select_field)) {
			$this->db->select($select_field);
		}

		$where .= "and id_sekolah=" . $this->smk;

		$this->join_avaiable();
		$this->db->where($where);
		$this->db->limit($limit, $offset);
		$this->db->order_by('guru.' . $this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

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
					$where .= "guru." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "guru." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "guru." . $field . " LIKE '%" . $q . "%' )";
		}

		$where .= "and id_sekolah=" . $this->sma;

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
					$where .= "guru." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "guru." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "guru." . $field . " LIKE '%" . $q . "%' )";
		}

		if (is_array($select_field) and count($select_field)) {
			$this->db->select($select_field);
		}

		$where .= "and id_sekolah=" . $this->sma;

		$this->join_avaiable();
		$this->db->where($where);
		$this->db->limit($limit, $offset);
		$this->db->order_by('guru.' . $this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

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
					$where .= "guru." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "guru." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "guru." . $field . " LIKE '%" . $q . "%' )";
		}

		$where .= "and id_sekolah=" . $this->smp;

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
					$where .= "guru." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "guru." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "guru." . $field . " LIKE '%" . $q . "%' )";
		}

		if (is_array($select_field) and count($select_field)) {
			$this->db->select($select_field);
		}

		$where .= "and id_sekolah=" . $this->smp;

		$this->join_avaiable();
		$this->db->where($where);
		$this->db->limit($limit, $offset);
		$this->db->order_by('guru.' . $this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

	public function join_avaiable()
	{
		$this->db->join('jenis_kelamin', 'jenis_kelamin.id_jeniskelamin = guru.id_jenis_kelamin', 'LEFT');
		$this->db->join('status_kepegawaian', 'status_kepegawaian.id_statuskepegawaian = guru.id_status_kepegawaian', 'LEFT');
		$this->db->join('jenis_ptk', 'jenis_ptk.id_jenisptk = guru.id_jenis_ptk', 'LEFT');
		$this->db->join('agama', 'agama.id_agama = guru.id_agama', 'LEFT');
		$this->db->join('status_keaktifan', 'status_keaktifan.id_statuskeaktifan = guru.id_status_keaktifan', 'LEFT');
		$this->db->join('golongan', 'golongan.id_golongan = guru.id_golongan', 'LEFT');
		$this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = guru.id_sekolah', 'LEFT');

		return $this;
	}
}

/* End of file Model_guru.php */
/* Location: ./application/models/Model_guru.php */
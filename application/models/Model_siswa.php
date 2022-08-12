<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_siswa extends MY_Model {

	private $primary_key 	= 'id_siswa';
	private $table_name 	= 'siswa';
	private $field_search 	= ['nipd', 'nama', 'id_jenis_kelamin', 'nisn', 'tempat_lahir', 'tanggal_lahir', 'nik', 'id_agama', 'kebutuhan_khusus', 'alamat', 'rt', 'rw', 'dusun', 'kelurahan', 'kecamatan', 'kode_pos', 'jenis_tinggal', 'alat_transportasi', 'telepon', 'hp', 'email', 'skhun', 'penerima_kps', 'no_kps', 'foto', 'nama_ayah', 'tahun_lahir_ayah', 'pendidikan_ayah', 'pekerjaan_ayah', 'penghasilan_ayah', 'kebutuhan_khusus_ayah', 'no_telpon_ayah', 'nama_ibu', 'tahun_lahir_ibu', 'pendidikan_ibu', 'pekerjaan_ibu', 'penghasilan_ibu', 'kebutuhan_khusus_ibu', 'no_telpon_ibu', 'nama_wali', 'tahun_lahir_wali', 'pendidikan_wali', 'pekerjaan_wali', 'penghasilan_wali', 'angkatan', 'status_awal', 'status_siswa', 'tingkat', 'kode_jurusan', 'id_sesi'];
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
	                $where .= "siswa.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "siswa.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "siswa.".$field . " LIKE '%" . $q . "%' )";
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
	                $where .= "siswa.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "siswa.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "siswa.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('siswa.'.$this->primary_key, "DESC");
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
	                $where .= "siswa.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "siswa.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "siswa.".$field . " LIKE '%" . $q . "%' )";
        }

        $where .= "and id_sekolah=".$this->smk;

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
	                $where .= "siswa.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "siswa.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "siswa.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }

        $where .= "and id_sekolah=".$this->smk;
		
		$this->join_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('siswa.'.$this->primary_key, "DESC");
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
	                $where .= "siswa.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "siswa.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "siswa.".$field . " LIKE '%" . $q . "%' )";
        }

        $where .= "and id_sekolah=".$this->sma;

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
	                $where .= "siswa.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "siswa.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "siswa.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }

        $where .= "and id_sekolah=".$this->sma;
		
		$this->join_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('siswa.'.$this->primary_key, "DESC");
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
	                $where .= "siswa.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "siswa.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "siswa.".$field . " LIKE '%" . $q . "%' )";
        }

        $where .= "and id_sekolah=".$this->smp;

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
	                $where .= "siswa.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "siswa.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "siswa.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }

        $where .= "and id_sekolah=".$this->smp;
		
		$this->join_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('siswa.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

	public function join_avaiable() {
		$this->db->join('jenis_kelamin', 'jenis_kelamin.id_jeniskelamin = siswa.id_jenis_kelamin', 'LEFT');
    $this->db->join('agama', 'agama.id_agama = siswa.id_agama', 'LEFT');
    $this->db->join('status_keaktifan', 'status_keaktifan.id_statuskeaktifan = siswa.status_siswa', 'LEFT');
    // $this->db->join('kelas', 'kelas.kode_kelas = siswa.kode_kelas', 'LEFT');
    $this->db->join('kode_jurusan', 'kode_jurusan.id_kodejurusan = siswa.kode_jurusan', 'LEFT');
    $this->db->join('aauth_users', 'aauth_users.id_siswa = siswa.id_siswa', 'LEFT');
    
    return $this;
	}

  // public function get_id_kodesekolah($data1){

	// 	$this->db->select('*');
	// 	$this->db->from('kode_sekolah');
	// 	$this->db->where('id_kodesekolah', $data1);

	// 	$query = $this->db->get();

	// 	foreach ($query->result_array() as $data ){
	// 		$id_kodesekolah = $data['id_kodesekolah'];
	// 	}
	// 	return $id_kodesekolah;
	// }

  // Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function insert_multiple($data){
		// var_dump($data);
		// die();
		$this->db->insert_batch('siswa', $data);
	}

}

/* End of file Model_siswa.php */
/* Location: ./application/models/Model_siswa.php */
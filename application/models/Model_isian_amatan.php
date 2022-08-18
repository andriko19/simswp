<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_isian_amatan extends MY_Model {

	private $primary_key 	= 'id_isian_amatan';
	private $table_name 	= 'isian_amatan';
	private $field_search 	= ['nama', 'nama_rombel', 'nama_guru'];
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

	private function maxIdPeriodeList() {
    $this->db->select_max('id_periode');
    // $this->db->from();
    $query = $this->db->get('periode');

		foreach ($query->result_array() as $data ){
			$maxIdPeriode = $data['id_periode'];
		}

    return $maxIdPeriode;
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
	                $where .= $field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . $field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . $field . " LIKE '%" . $q . "%' )";
        }

				$where .= " and rombel.periode=".$this->maxIdPeriodeList();

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
	                $where .= $field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . $field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . $field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
				$where .= " and rombel.periode=".$this->maxIdPeriodeList();

		$this->join_avaiable();
    $this->db->where($where);
    $this->db->limit($limit, $offset);
    $this->db->order_by('isian_amatan.'.$this->primary_key, "DESC");
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
		$role = $this->session->groups;
		
		// var_dump($role);
		// die;
		if($role == 11){
			$id_kodesekolah == 1;
		}elseif ($role == 12) {
			$id_kodesekolah == 2;
		}elseif ($role == 13) {
			$id_kodesekolah == 3;
		}
        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= $field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . $field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . $field . " LIKE '%" . $q . "%' )";
        }

		$b = $this->session->id;
		$c = $this->getId($b);

		$where .= " and id_pengamat=".$c;
		$where .= " and rombel.periode=".$this->maxIdPeriodeList();
		$where .= " and isian_amatan.id_kodesekolah=".$id_kodesekolah;

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
	                $where .= $field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . $field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . $field . " LIKE '%" . $q . "%' )";
        }

		$b = $this->session->id;
		$c = $this->getId($b);

		$where .= " and id_pengamat=".$c;
		$where .= " and rombel.periode=".$this->maxIdPeriodeList();

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable();
		$this->db->where($where);
		$this->db->limit($limit, $offset);
		$this->db->order_by('isian_amatan.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

	public function join_avaiable() {
		$this->db->select('isian_amatan.*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah as kode_sekolah, rombel.nama_rombel as kelas, nama, isian_amatan.isi_amatan as isi_amatan, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

		$this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
		$this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
	    
    	return $this;
	}

  public function maxIdPeriode() {
    $this->db->select_max('id_periode');
    // $this->db->from();
    $query = $this->db->get('periode');

		foreach ($query->result_array() as $data ){
			$maxIdPeriode = $data['id_periode'];
		}

    return $maxIdPeriode;
  }

	public function sekolah($id_sekolah, $getMaxIdPeriode) {
		$sekolah="<option value='0'>--pilih--</option>";

		$this->db->select('*');
		$this->db->from('siswa');
		$this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
		$this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
		$this->db->where('periode', $getMaxIdPeriode);
    $this->db->where('id_sekolah', $id_sekolah);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$sekolah.= "<option value='$data[id_siswa]'>$data[nipd] / $data[nama] / $data[nama_rombel]</option>";
		}
		return $sekolah;
	}

  public function kode_indikatorSMP($smk, $sma) {
		$kode_indikator="<option value='0'>--pilih--</option>";

		$this->db->select('*');
		$this->db->from('indikator_amatan_pbp');
		// $this->db->join('dimensi_pbp', 'dimensi_pbp.id_dimensi_pbp = indikator_amatan_pbp.id_dimensi_pbp', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = indikator_amatan_pbp.id_kodesekolah', 'LEFT');
		$this->db->where('kode_sekolah.id_kodesekolah !=', $smk);
    $this->db->where('kode_sekolah.id_kodesekolah !=', $sma);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$kode_indikator.= "<option value='$data[id_indikator_pbp]'>$data[kode_sekolah] / $data[kode_indikator] / $data[indikator]</option>";
		}
		return $kode_indikator;
	}

  public function kode_indikatorSMA($smk, $smp) {
		$kode_indikator="<option value='0'>--pilih--</option>";

		$this->db->select('*');
		$this->db->from('indikator_amatan_pbp');
		// $this->db->join('dimensi_pbp', 'dimensi_pbp.id_dimensi_pbp = indikator_amatan_pbp.id_dimensi_pbp', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = indikator_amatan_pbp.id_kodesekolah', 'LEFT');
    $this->db->where('kode_sekolah.id_kodesekolah !=', $smk);
		$this->db->where('kode_sekolah.id_kodesekolah !=', $smp);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$kode_indikator.= "<option value='$data[id_indikator_pbp]'>$data[kode_sekolah] / $data[kode_indikator] / $data[indikator]</option>";
		}
		return $kode_indikator;
	}

  public function kode_indikatorSMK($sma, $smp) {
		$kode_indikator="<option value='0'>--pilih--</option>";

		$this->db->select('*');
		$this->db->from('indikator_amatan_pbp');
		// $this->db->join('dimensi_pbp', 'dimensi_pbp.id_dimensi_pbp = indikator_amatan_pbp.id_dimensi_pbp', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = indikator_amatan_pbp.id_kodesekolah', 'LEFT');
    $this->db->where('kode_sekolah.id_kodesekolah !=', $sma);
		$this->db->where('kode_sekolah.id_kodesekolah !=', $smp);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$kode_indikator.= "<option value='$data[id_indikator_pbp]'>$data[kode_sekolah] / $data[kode_indikator] / $data[indikator]</option>";
		}
		return $kode_indikator;
	}

	public function kode_indikatorPBPEdit() {
		$this->db->select('*');
		// $this->db->from('indikator_amatan_pbp');
		$this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = indikator_amatan_pbp.id_kodesekolah', 'LEFT');
		// $this->db->where('kode_sekolah.id_kodesekolah !=', $smp);
    // $this->db->where('kode_sekolah.id_kodesekolah !=', $sma);

		$query = $this->db->get('indikator_amatan_pbp');

		return $query->result();
	}

	public function nama_siswa($id_siswa) {
		$this->db->select('*');
		$this->db->from('siswa');
		$this->db->where('id_siswa', $id_siswa);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$nama_siswa = $data['nama'];
		}
		return $nama_siswa;
	}

	public function kelas($id_siswa) {
		$this->db->select('*');
		$this->db->from('siswa');
		$this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
		$this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
		$this->db->where('siswa.id_siswa', $id_siswa);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$kelas = $data['nama_rombel'];
		}
		return $kelas;
	}

	public function nama_pengamat_staf() {
		$nama_pengamat="<option value='0'>--pilih--</option>";

		$this->db->select('*');
		$this->db->from('guru');
		$this->db->where('id_status_kepegawaian', 1);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$nama_pengamat.= "<option value='$data[id_guru]'>$data[nama_guru]</option>";
		}
		return $nama_pengamat;
	}

	public function nama_pengamat_guru() {
		$nama_pengamat="<option value='0'>--pilih--</option>";

		$this->db->select('*');
		$this->db->from('guru');
		$this->db->where('id_status_kepegawaian !=', 1);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$nama_pengamat.= "<option value='$data[id_guru]'>$data[nama_guru]</option>";
		}
		return $nama_pengamat;
	}

	public function get_id_siswa($data3){

		$this->db->select('*');
		$this->db->from('siswa');
		$this->db->where('nipd', $data3);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$id_siswa1 = $data['id_siswa'];
		}
		return $id_siswa1;
	}

	public function get_id($data1){

		$this->db->select('*');
		$this->db->from('indikator_amatan_pbp');
		$this->db->where('kode_indikator', $data1);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$id_indikator_pbp = $data['id_indikator_pbp'];
		}
		return $id_indikator_pbp;
	}

	public function get_id_pengamat($data2){

		$this->db->select('*');
		$this->db->from('guru');
		$this->db->where('email', $data2);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$id_guru = $data['id_guru'];
		}
		return $id_guru;
	}

	// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function insert_multiple($data){
		$this->db->insert_batch('isian_amatan', $data);
	}

	public function getId($b){
		$this->db->select('*');
		$this->db->from('aauth_users');
		$this->db->join('guru','guru.id_guru = aauth_users.id_guru');		
		$this->db->where('id', $b);

		$query = $this->db->get();

		// log_message($this->db->last_query());

		foreach ($query->result_array() as $data ){
			$id_guru = $data['id_guru'];
		}
		return $id_guru;
	}

	public function getKodeSkolah($id_siswa)
	{
		$this->db->select('*');
		$this->db->from('siswa');
		$this->db->where('id_siswa', $id_siswa);

		$query = $this->db->get();

		// log_message($this->db->last_query());

		foreach ($query->result_array() as $data ){
			$id_sekolah = $data['id_sekolah'];
		}
		return $id_sekolah;
	}

  //Get Data SMP 
	public function count_allBKSMP($q = null, $field = null, $getBulanAwal = null, $getTahunAwal = null, $getBulanAkhir = null)
	{
		$iterasi = 1;
    $num = count($this->field_search);
    $where = NULL;
    $q = $this->scurity($q);
		$field = $this->scurity($field);

		$BulanAwal = $this->scurity($getBulanAwal);
		$TahunAwal = $this->scurity($getTahunAwal);
    $BulanAkhir = $this->scurity($getBulanAkhir);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= $field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . $field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . $field . " LIKE '%" . $q . "%' )";
        }

		$where .= " and isian_amatan.id_kodesekolah=".$this->smp;
		$where .= " and rombel.periode=".$this->maxIdPeriodeList();

		if ($BulanAwal != null) {
      $where .= " and MONTH(isian_amatan.tanggal)>=".$BulanAwal;
      $where .= " and MONTH(isian_amatan.tanggal)<=".$BulanAkhir;
      $where .= " and YEAR(isian_amatan.tanggal)=".$TahunAwal;
      // $where .= " and YEAR(isian_amatan.tanggal)>=".$TahunAkhir;
    }

		$this->join_avaiableBK();
    $this->db->where($where);
		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}

	public function getBKSMP($q = null, $field = null, $limit = 0, $offset = 0, $getBulanAwal = null, $getTahunAwal = null, $getBulanAkhir = null, $select_field = [])
	{
		$iterasi = 1;
    $num = count($this->field_search);
    $where = NULL;
    $q = $this->scurity($q);
		$field = $this->scurity($field);

		$BulanAwal = $this->scurity($getBulanAwal);
		$TahunAwal = $this->scurity($getTahunAwal);
    $BulanAkhir = $this->scurity($getBulanAkhir);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= $field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . $field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . $field . " LIKE '%" . $q . "%' )";
        }

        $where .= " and isian_amatan.id_kodesekolah=".$this->smp;
				$where .= " and rombel.periode=".$this->maxIdPeriodeList();

				if ($BulanAwal != null) {
					$where .= " and MONTH(isian_amatan.tanggal)>=".$BulanAwal;
					$where .= " and MONTH(isian_amatan.tanggal)<=".$BulanAkhir;
					$where .= " and YEAR(isian_amatan.tanggal)=".$TahunAwal;
					// $where .= " and YEAR(isian_amatan.tanggal)>=".$TahunAkhir;
				}

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiableBK();
    $this->db->where($where);
    $this->db->limit($limit, $offset);
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

	//Get Data SMA
	public function count_allBKSMA($q = null, $field = null, $getBulanAwal = null, $getTahunAwal = null, $getBulanAkhir = null)
	{
		$iterasi = 1;
    $num = count($this->field_search);
    $where = NULL;
    $q = $this->scurity($q);
		$field = $this->scurity($field);

		$BulanAwal = $this->scurity($getBulanAwal);
		$TahunAwal = $this->scurity($getTahunAwal);
    $BulanAkhir = $this->scurity($getBulanAkhir);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= $field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . $field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . $field . " LIKE '%" . $q . "%' )";
        }

		$where .= " and isian_amatan.id_kodesekolah=".$this->sma;
		$where .= " and rombel.periode=".$this->maxIdPeriodeList();

		if ($BulanAwal != null) {
      $where .= " and MONTH(isian_amatan.tanggal)>=".$BulanAwal;
      $where .= " and MONTH(isian_amatan.tanggal)<=".$BulanAkhir;
      $where .= " and YEAR(isian_amatan.tanggal)=".$TahunAwal;
      // $where .= " and YEAR(isian_amatan.tanggal)>=".$TahunAkhir;
    }

		$this->join_avaiableBK();
    $this->db->where($where);
		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}

	public function getBKSMA($q = null, $field = null, $limit = 0, $offset = 0, $getBulanAwal = null, $getTahunAwal = null, $getBulanAkhir = null, $select_field = [])
	{
		$iterasi = 1;
    $num = count($this->field_search);
    $where = NULL;
    $q = $this->scurity($q);
		$field = $this->scurity($field);

		$BulanAwal = $this->scurity($getBulanAwal);
		$TahunAwal = $this->scurity($getTahunAwal);
    $BulanAkhir = $this->scurity($getBulanAkhir);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= $field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . $field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . $field . " LIKE '%" . $q . "%' )";
        }

        $where .= " and isian_amatan.id_kodesekolah=".$this->sma;
				$where .= " and rombel.periode=".$this->maxIdPeriodeList();

				if ($BulanAwal != null) {
					$where .= " and MONTH(isian_amatan.tanggal)>=".$BulanAwal;
					$where .= " and MONTH(isian_amatan.tanggal)<=".$BulanAkhir;
					$where .= " and YEAR(isian_amatan.tanggal)=".$TahunAwal;
					// $where .= " and YEAR(isian_amatan.tanggal)>=".$TahunAkhir;
				}

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiableBK();
    $this->db->where($where);
    $this->db->limit($limit, $offset);
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

	//Get Data SMK
	public function count_allBKSMK($q = null, $field = null, $getBulanAwal = null, $getTahunAwal = null, $getBulanAkhir = null)
	{
		$iterasi = 1;
    $num = count($this->field_search);
    $where = NULL;
    $q = $this->scurity($q);
		$field = $this->scurity($field);

		$BulanAwal = $this->scurity($getBulanAwal);
		$TahunAwal = $this->scurity($getTahunAwal);
    $BulanAkhir = $this->scurity($getBulanAkhir);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= $field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . $field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . $field . " LIKE '%" . $q . "%' )";
        }

		$where .= " and isian_amatan.id_kodesekolah=".$this->smk;
		$where .= " and rombel.periode=".$this->maxIdPeriodeList();

		if ($BulanAwal != null) {
			$where .= " and MONTH(isian_amatan.tanggal)>=".$BulanAwal;
			$where .= " and MONTH(isian_amatan.tanggal)<=".$BulanAkhir;
			$where .= " and YEAR(isian_amatan.tanggal)=".$TahunAwal;
			// $where .= " and YEAR(isian_amatan.tanggal)>=".$TahunAkhir;
		}

		$this->join_avaiableBK();
    $this->db->where($where);
		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}

	public function getBKSMK($q = null, $field = null, $limit = 0, $offset = 0, $getBulanAwal = null, $getTahunAwal = null, $getBulanAkhir = null, $select_field = [])
	{
		$iterasi = 1;
    $num = count($this->field_search);
    $where = NULL;
    $q = $this->scurity($q);
		$field = $this->scurity($field);

		$BulanAwal = $this->scurity($getBulanAwal);
		$TahunAwal = $this->scurity($getTahunAwal);
    $BulanAkhir = $this->scurity($getBulanAkhir);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= $field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . $field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . $field . " LIKE '%" . $q . "%' )";
        }

        $where .= " and isian_amatan.id_kodesekolah=".$this->smk;
				$where .= " and rombel.periode=".$this->maxIdPeriodeList();

				if ($BulanAwal != null) {
					$where .= " and MONTH(isian_amatan.tanggal)>=".$BulanAwal;
					$where .= " and MONTH(isian_amatan.tanggal)<=".$BulanAkhir;
					$where .= " and YEAR(isian_amatan.tanggal)=".$TahunAwal;
					// $where .= " and YEAR(isian_amatan.tanggal)>=".$TahunAkhir;
				}

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiableBK();
    $this->db->where($where);
    $this->db->limit($limit, $offset);
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

	public function isian_amatan_bk_detail($id_siswa, $id_sekolah, $getBulanAwal = null, $getTahunAwal = null, $getBulanAkhir = null) {
		$maxIdPeriodeList = $this->maxIdPeriodeList();
		$this->db->select('isian_amatan.*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah as kode_sekolah, rombel.nama_rombel as kelas, nama, isian_amatan.isi_amatan as isi_amatan, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

		$this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
		$this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
		// $this->db->group_by('isian_amatan.id_siswa');
		$this->db->order_by('isian_amatan.id_status_amatan', "ASC");
		$this->db->order_by('isian_amatan.tanggal', "ASC");
		// $this->db->limit(15);
    if ($getBulanAwal != null) {
      $query = $this->db->get_where('isian_amatan', array('isian_amatan.id_kodesekolah'=>$id_sekolah, 'isian_amatan.id_siswa'=>$id_siswa, 'MONTH(isian_amatan.tanggal)>='=>$getBulanAwal, 'MONTH(isian_amatan.tanggal)<='=>$getBulanAkhir, 'YEAR(isian_amatan.tanggal)='=>$getTahunAwal, 'rombel.periode' =>$maxIdPeriodeList));
    } else {
      $query = $this->db->get_where('isian_amatan', array('isian_amatan.id_kodesekolah'=>$id_sekolah, 'isian_amatan.id_siswa'=>$id_siswa, 'rombel.periode' =>$maxIdPeriodeList));
    }

    if($query->num_rows()>0) {
		 	return $query->result();
		}
	}

	public function join_avaiableBK() {

		$this->db->select('id_isian_amatan, tanggal, kode_sekolah.kode_sekolah as kode_sekolah, rombel.nama_rombel as kelas, nama, count(status_amatan.id_status_amatan) as total_status, isian_amatan.id_siswa as id_siswa');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

		$this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
		$this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
		$this->db->group_by('isian_amatan.id_siswa');
		$this->db->order_by('total_status', "DESC");
		// $this->db->limit(15);
		// $this->db->get_where('isian_amatan', array('isian_amatan.id_kodesekolah'=>1));

    return $this;
	}

	 public function getBulanAwal($idSmester){

		$this->db->select('*');
		$this->db->from('semester');
		// $this->db->join('guru','guru.id_guru = aauth_users.id_guru');		
		$this->db->where('id_semester', $idSmester);

		$query = $this->db->get();

		// log_message($this->db->last_query());

		foreach ($query->result_array() as $data ){
			$BulanAwal = $data['bulan_awal'];
		}
		return $BulanAwal;
	}

	public function getBulanAkhir($idSmester){

		$this->db->select('*');
		$this->db->from('semester');
		// $this->db->join('guru','guru.id_guru = aauth_users.id_guru');		
		$this->db->where('id_semester', $idSmester);

		$query = $this->db->get();

		// log_message($this->db->last_query());

		foreach ($query->result_array() as $data ){
			$BulanAkhir = $data['bulan_akhir'];
		}
		return $BulanAkhir;		
	}	

	public function getTahun($idSmester){

		$this->db->select('*');
		$this->db->from('semester');
		// $this->db->join('guru','guru.id_guru = aauth_users.id_guru');		
		$this->db->where('id_semester', $idSmester);

		$query = $this->db->get();

		// log_message($this->db->last_query());

		foreach ($query->result_array() as $data ){
			$Tahun = $data['tahun_akhir'];
		}
		return $Tahun;		

	}	

	public function getSemester($idSemester){

		$this->db->select('*');
		$this->db->from('semester');
		// $this->db->join('guru','guru.id_guru = aauth_users.id_guru');		
		$this->db->where('id_semester', $idSemester);

		$query = $this->db->get();

		// log_message($this->db->last_query());

		foreach ($query->result_array() as $data ){
			$semester = $data['semester'];
		}
		return $semester;		

	}	

	public function getTahunAjar($idSemester){

		$this->db->select('*');
		$this->db->from('semester');
		$this->db->join('periode','periode.id_periode = semester.id_periode');		
		$this->db->where('id_semester', $idSemester);

		$query = $this->db->get();

		// log_message($this->db->last_query());

		foreach ($query->result_array() as $data ){
			$TahunAjar = $data['keterangan'];
		}
		return $TahunAjar;		

	}	

  public function rekap_amatan_indikator_excel($bulanAwal, $bulanAkhir, $tahun) {

    $query = $this->db->query("SELECT distinct ib.id_indikator_pbp, kode_indikator, indikator,
        (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '1' AND ia.id_status_amatan = '1' AND ia.id_indikator_pbp = ic.id_indikator_pbp AND MONTH(ia.tanggal) >= $bulanAwal AND MONTH(ia.tanggal) <= $bulanAkhir AND YEAR(ia.tanggal) = $tahun) 
        AS positif_smp,
        (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '1' AND ia.id_status_amatan = '2' AND ia.id_indikator_pbp = ic.id_indikator_pbp AND MONTH(ia.tanggal) >= $bulanAwal AND MONTH(ia.tanggal) <= $bulanAkhir AND YEAR(ia.tanggal) = $tahun) 
        AS negatif_smp,
        (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '2' AND ia.id_status_amatan = '1' AND ia.id_indikator_pbp = ic.id_indikator_pbp AND MONTH(ia.tanggal) >= $bulanAwal AND MONTH(ia.tanggal) <= $bulanAkhir AND YEAR(ia.tanggal) = $tahun) 
        AS positif_sma,
        (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '2' AND ia.id_status_amatan = '2' AND ia.id_indikator_pbp = ic.id_indikator_pbp AND MONTH(ia.tanggal) >= $bulanAwal AND MONTH(ia.tanggal) <= $bulanAkhir AND YEAR(ia.tanggal) = $tahun) 
        AS negatif_sma,
        (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '3' AND ia.id_status_amatan = '1' AND ia.id_indikator_pbp = ic.id_indikator_pbp AND MONTH(ia.tanggal) >= $bulanAwal AND MONTH(ia.tanggal) <= $bulanAkhir AND YEAR(ia.tanggal) = $tahun) 
        AS positif_smk,
        (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '3' AND ia.id_status_amatan = '2' AND ia.id_indikator_pbp = ic.id_indikator_pbp AND MONTH(ia.tanggal) >= $bulanAwal AND MONTH(ia.tanggal) <= $bulanAkhir AND YEAR(ia.tanggal) = $tahun) 
        AS negatif_smk
      FROM isian_amatan ib
      JOIN indikator_amatan_pbp ic ON ib.id_indikator_pbp = ic.id_indikator_pbp
      WHERE YEAR(ib.tanggal) = $tahun
      ORDER BY kode_indikator");
    return $query->result();
  }

	 public function rekap_amatan_indikator_excel_count($bulanAwal, $bulanAkhir, $tahun) {

    $query = $this->db->query("SELECT distinct ib.id_indikator_pbp, kode_indikator, indikator,
        (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '1' AND ia.id_status_amatan = '1' AND ia.id_indikator_pbp = ic.id_indikator_pbp AND MONTH(ia.tanggal) >= $bulanAwal AND MONTH(ia.tanggal) <= $bulanAkhir AND YEAR(ia.tanggal) = $tahun) 
        AS positif_smp,
        (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '1' AND ia.id_status_amatan = '2' AND ia.id_indikator_pbp = ic.id_indikator_pbp AND MONTH(ia.tanggal) >= $bulanAwal AND MONTH(ia.tanggal) <= $bulanAkhir AND YEAR(ia.tanggal) = $tahun) 
        AS negatif_smp,
        (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '2' AND ia.id_status_amatan = '1' AND ia.id_indikator_pbp = ic.id_indikator_pbp AND MONTH(ia.tanggal) >= $bulanAwal AND MONTH(ia.tanggal) <= $bulanAkhir AND YEAR(ia.tanggal) = $tahun) 
        AS positif_sma,
        (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '2' AND ia.id_status_amatan = '2' AND ia.id_indikator_pbp = ic.id_indikator_pbp AND MONTH(ia.tanggal) >= $bulanAwal AND MONTH(ia.tanggal) <= $bulanAkhir AND YEAR(ia.tanggal) = $tahun) 
        AS negatif_sma,
        (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '3' AND ia.id_status_amatan = '1' AND ia.id_indikator_pbp = ic.id_indikator_pbp AND MONTH(ia.tanggal) >= $bulanAwal AND MONTH(ia.tanggal) <= $bulanAkhir AND YEAR(ia.tanggal) = $tahun) 
        AS positif_smk,
        (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '3' AND ia.id_status_amatan = '2' AND ia.id_indikator_pbp = ic.id_indikator_pbp AND MONTH(ia.tanggal) >= $bulanAwal AND MONTH(ia.tanggal) <= $bulanAkhir AND YEAR(ia.tanggal) = $tahun) 
        AS negatif_smk
      FROM isian_amatan ib
      JOIN indikator_amatan_pbp ic ON ib.id_indikator_pbp = ic.id_indikator_pbp
      WHERE YEAR(ib.tanggal) = $tahun
      ORDER BY kode_indikator");
    return $query->num_rows();
  }

	public function rekap_amatan_pengamat_excel($bulanAwal, $bulanAkhir, $tahun) {

    $query = $this->db->query("SELECT distinct nama_guru,
        (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '1' AND ia.id_status_amatan = '1' AND ia.id_pengamat = ic.id_guru AND MONTH(ia.tanggal) >= $bulanAwal AND MONTH(ia.tanggal) <= $bulanAkhir AND YEAR(ia.tanggal) = $tahun) 
        AS positif_smp,
        (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '1' AND ia.id_status_amatan = '2' AND ia.id_pengamat = ic.id_guru AND MONTH(ia.tanggal) >= $bulanAwal AND MONTH(ia.tanggal) <= $bulanAkhir AND YEAR(ia.tanggal) = $tahun) 
        AS negatif_smp,
        (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '2' AND ia.id_status_amatan = '1' AND ia.id_pengamat = ic.id_guru AND MONTH(ia.tanggal) >= $bulanAwal AND MONTH(ia.tanggal) <= $bulanAkhir AND YEAR(ia.tanggal) = $tahun) 
        AS positif_sma,
        (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '2' AND ia.id_status_amatan = '2' AND ia.id_pengamat = ic.id_guru AND MONTH(ia.tanggal) >= $bulanAwal AND MONTH(ia.tanggal) <= $bulanAkhir AND YEAR(ia.tanggal) = $tahun) 
        AS negatif_sma,
        (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '3' AND ia.id_status_amatan = '1' AND ia.id_pengamat = ic.id_guru AND MONTH(ia.tanggal) >= $bulanAwal AND MONTH(ia.tanggal) <= $bulanAkhir AND YEAR(ia.tanggal) = $tahun) 
        AS positif_smk,
        (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '3' AND ia.id_status_amatan = '2' AND ia.id_pengamat = ic.id_guru AND MONTH(ia.tanggal) >= $bulanAwal AND MONTH(ia.tanggal) <= $bulanAkhir AND YEAR(ia.tanggal) = $tahun) 
        AS negatif_smk
      FROM isian_amatan ib
      JOIN guru ic ON ib.id_pengamat = ic.id_guru
      WHERE YEAR(ib.tanggal) = $tahun
      ORDER BY nama_guru");
    return $query->result();
  }

	public function rekap_amatan_pengamat_excel_count($bulanAwal, $bulanAkhir, $tahun) {

    $query = $this->db->query("SELECT distinct nama_guru,
        (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '1' AND ia.id_status_amatan = '1' AND ia.id_pengamat = ic.id_guru AND MONTH(ia.tanggal) >= $bulanAwal AND MONTH(ia.tanggal) <= $bulanAkhir AND YEAR(ia.tanggal) = $tahun) 
        AS positif_smp,
        (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '1' AND ia.id_status_amatan = '2' AND ia.id_pengamat = ic.id_guru AND MONTH(ia.tanggal) >= $bulanAwal AND MONTH(ia.tanggal) <= $bulanAkhir AND YEAR(ia.tanggal) = $tahun) 
        AS negatif_smp,
        (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '2' AND ia.id_status_amatan = '1' AND ia.id_pengamat = ic.id_guru AND MONTH(ia.tanggal) >= $bulanAwal AND MONTH(ia.tanggal) <= $bulanAkhir AND YEAR(ia.tanggal) = $tahun) 
        AS positif_sma,
        (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '2' AND ia.id_status_amatan = '2' AND ia.id_pengamat = ic.id_guru AND MONTH(ia.tanggal) >= $bulanAwal AND MONTH(ia.tanggal) <= $bulanAkhir AND YEAR(ia.tanggal) = $tahun) 
        AS negatif_sma,
        (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '3' AND ia.id_status_amatan = '1' AND ia.id_pengamat = ic.id_guru AND MONTH(ia.tanggal) >= $bulanAwal AND MONTH(ia.tanggal) <= $bulanAkhir AND YEAR(ia.tanggal) = $tahun) 
        AS positif_smk,
        (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '3' AND ia.id_status_amatan = '2' AND ia.id_pengamat = ic.id_guru AND MONTH(ia.tanggal) >= $bulanAwal AND MONTH(ia.tanggal) <= $bulanAkhir AND YEAR(ia.tanggal) = $tahun) 
        AS negatif_smk
      FROM isian_amatan ib
      JOIN guru ic ON ib.id_pengamat = ic.id_guru
      WHERE YEAR(ib.tanggal) = $tahun
      ORDER BY nama_guru");
    return $query->num_rows();
  }



























































































	// public function rekap_amatan_indikator($dataPerhalaman,	$start, $bulanAwal, $bulanAkhir, $tahun) {

  //   $query = $this->db->query("SELECT distinct ib.id_indikator_pbp, kode_indikator, indikator,
  //       (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '1' AND ia.id_status_amatan = '1' AND ia.id_indikator_pbp = ic.id_indikator_pbp AND MONTH(ia.tanggal) >= $bulanAwal AND MONTH(ia.tanggal) <= $bulanAkhir AND YEAR(ia.tanggal) = $tahun) 
  //       AS positif_smp,
  //       (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '1' AND ia.id_status_amatan = '2' AND ia.id_indikator_pbp = ic.id_indikator_pbp AND MONTH(ia.tanggal) >= $bulanAwal AND MONTH(ia.tanggal) <= $bulanAkhir AND YEAR(ia.tanggal) = $tahun) 
  //       AS negatif_smp,
  //       (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '2' AND ia.id_status_amatan = '1' AND ia.id_indikator_pbp = ic.id_indikator_pbp AND MONTH(ia.tanggal) >= $bulanAwal AND MONTH(ia.tanggal) <= $bulanAkhir AND YEAR(ia.tanggal) = $tahun) 
  //       AS positif_sma,
  //       (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '2' AND ia.id_status_amatan = '2' AND ia.id_indikator_pbp = ic.id_indikator_pbp AND MONTH(ia.tanggal) >= $bulanAwal AND MONTH(ia.tanggal) <= $bulanAkhir AND YEAR(ia.tanggal) = $tahun) 
  //       AS negatif_sma,
  //       (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '3' AND ia.id_status_amatan = '1' AND ia.id_indikator_pbp = ic.id_indikator_pbp AND MONTH(ia.tanggal) >= $bulanAwal AND MONTH(ia.tanggal) <= $bulanAkhir AND YEAR(ia.tanggal) = $tahun) 
  //       AS positif_smk,
  //       (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '3' AND ia.id_status_amatan = '2' AND ia.id_indikator_pbp = ic.id_indikator_pbp AND MONTH(ia.tanggal) >= $bulanAwal AND MONTH(ia.tanggal) <= $bulanAkhir AND YEAR(ia.tanggal) = $tahun) 
  //       AS negatif_smk
  //     FROM isian_amatan ib
  //     JOIN indikator_amatan_pbp ic ON ib.id_indikator_pbp = ic.id_indikator_pbp
  //     WHERE YEAR(ib.tanggal) = $tahun
  //     ORDER BY kode_indikator
  //     LIMIT $start, $dataPerhalaman");
  //   return $query->result();
  // }

	//  public function get_jumlah_rekap_amatan_indikator($tahun = 2021) {

  //   $query = $this->db->query("SELECT distinct ib.id_indikator_pbp, kode_indikator, indikator,
  //       (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '1' AND ia.id_status_amatan = '1' AND ia.id_indikator_pbp = ic.id_indikator_pbp AND MONTH(ia.tanggal) >= 7 AND MONTH(ia.tanggal) <= 12 AND YEAR(ia.tanggal) = $tahun) 
  //       AS positif_smp,
  //       (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '1' AND ia.id_status_amatan = '2' AND ia.id_indikator_pbp = ic.id_indikator_pbp AND MONTH(ia.tanggal) >= 7 AND MONTH(ia.tanggal) <= 12 AND YEAR(ia.tanggal) = $tahun) 
  //       AS negatif_smp,
  //       (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '2' AND ia.id_status_amatan = '1' AND ia.id_indikator_pbp = ic.id_indikator_pbp AND MONTH(ia.tanggal) >= 7 AND MONTH(ia.tanggal) <= 12 AND YEAR(ia.tanggal) = $tahun) 
  //       AS positif_sma,
  //       (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '2' AND ia.id_status_amatan = '2' AND ia.id_indikator_pbp = ic.id_indikator_pbp AND MONTH(ia.tanggal) >= 7 AND MONTH(ia.tanggal) <= 12 AND YEAR(ia.tanggal) = $tahun) 
  //       AS negatif_sma,
  //       (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '3' AND ia.id_status_amatan = '1' AND ia.id_indikator_pbp = ic.id_indikator_pbp AND MONTH(ia.tanggal) >= 7 AND MONTH(ia.tanggal) <= 12 AND YEAR(ia.tanggal) = $tahun) 
  //       AS positif_smk,
  //       (SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '3' AND ia.id_status_amatan = '2' AND ia.id_indikator_pbp = ic.id_indikator_pbp AND MONTH(ia.tanggal) >= 7 AND MONTH(ia.tanggal) <= 12 AND YEAR(ia.tanggal) = $tahun) 
  //       AS negatif_smk
  //     FROM isian_amatan ib
  //     JOIN indikator_amatan_pbp ic ON ib.id_indikator_pbp = ic.id_indikator_pbp
  //     WHERE YEAR(ib.tanggal) = $tahun
  //     ORDER BY kode_indikator");
  //   return $query->result();
  // }

  //  public function rekap_amatan_indikators_count_all($tahun=2021) {

  //   $query = $this->db->query("SELECT distinct ib.id_indikator_pbp, kode_indikator, indikator,
	// 		(SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '1' AND ia.id_status_amatan = '1' AND ia.id_indikator_pbp = ic.id_indikator_pbp AND MONTH(ia.tanggal) >= 7 AND MONTH(ia.tanggal) <= 12 AND YEAR(ia.tanggal) = $tahun) 
	// 		AS positif_smp,
	// 		(SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '1' AND ia.id_status_amatan = '2' AND ia.id_indikator_pbp = ic.id_indikator_pbp AND MONTH(ia.tanggal) >= 7 AND MONTH(ia.tanggal) <= 12 AND YEAR(ia.tanggal) = $tahun) 
	// 		AS negatif_smp,
	// 		(SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '2' AND ia.id_status_amatan = '1' AND ia.id_indikator_pbp = ic.id_indikator_pbp AND MONTH(ia.tanggal) >= 7 AND MONTH(ia.tanggal) <= 12 AND YEAR(ia.tanggal) = $tahun) 
	// 		AS positif_sma,
	// 		(SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '2' AND ia.id_status_amatan = '2' AND ia.id_indikator_pbp = ic.id_indikator_pbp AND MONTH(ia.tanggal) >= 7 AND MONTH(ia.tanggal) <= 12 AND YEAR(ia.tanggal) = $tahun) 
	// 		AS negatif_sma,
	// 		(SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '3' AND ia.id_status_amatan = '1' AND ia.id_indikator_pbp = ic.id_indikator_pbp AND MONTH(ia.tanggal) >= 7 AND MONTH(ia.tanggal) <= 12 AND YEAR(ia.tanggal) = $tahun) 
	// 		AS positif_smk,
	// 		(SELECT COUNT(*) FROM isian_amatan ia WHERE ia.id_kodesekolah = '3' AND ia.id_status_amatan = '2' AND ia.id_indikator_pbp = ic.id_indikator_pbp AND MONTH(ia.tanggal) >= 7 AND MONTH(ia.tanggal) <= 12 AND YEAR(ia.tanggal) = $tahun) 
	// 		AS negatif_smk
	// 	FROM isian_amatan ib
	// 	JOIN indikator_amatan_pbp ic ON ib.id_indikator_pbp = ic.id_indikator_pbp
	// 	WHERE YEAR(ib.tanggal) = $tahun
	// 	ORDER BY kode_indikator");
  //   return $query->num_rows();
  // }

}

/* End of file Model_isian_amatan.php */
/* Location: ./application/models/Model_isian_amatan.php */
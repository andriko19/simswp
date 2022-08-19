<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_tindakan_bk extends MY_Model {

	private $primary_key 	= 'id_tindakan_bk';
	private $table_name 	= 'tindakan_bk';
	private $field_search = ['tanggal', 'id_siswa', 'isi_tindakan', 'id_guru_bk'];
	private $smk          = "3";
  private $sma          = "2";
  private $smp          = "1";

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
		 	'table_name' 	=> $this->table_name,
		 	'field_search' 	=> $this->field_search,
		 );

		parent::__construct($config);
	}

	public function maxIdPeriodeList() {
    $this->db->select_max('id_periode');
    // $this->db->from();
    $query = $this->db->get('periode');

		foreach ($query->result_array() as $data ){
			$maxIdPeriode = $data['id_periode'];
		}

    return $maxIdPeriode;
  }

	public function count_all($q = null, $field = null, $getBulanAwal = null, $getTahunAwal = null, $getBulanAkhir = null)
	{
		$table_name 	= 'isian_amatan';
		$field_search = ['tanggal', 'jam', 'minggu', 'id_kodesekolah', 'id_siswa', 'id_indikator_pbp', 'id_lokasi_amatan', 'id_jenis_pengamat', 'id_pengamat'];

		$iterasi = 1;
    $num = count($field_search);
    $where = NULL;
    $q = $this->scurity($q);
		$field = $this->scurity($field);

		$BulanAwal = $this->scurity($getBulanAwal);
		$TahunAwal = $this->scurity($getTahunAwal);
    $BulanAkhir = $this->scurity($getBulanAkhir);
		

        if (empty($field)) {
	        foreach ($field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "isian_amatan.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "isian_amatan.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "isian_amatan.".$field . " LIKE '%" . $q . "%' )";
        }

				if ($BulanAwal != null) {
					$where .= " and MONTH(isian_amatan.tanggal)>=".$BulanAwal;
					$where .= " and MONTH(isian_amatan.tanggal)<=".$BulanAkhir;
					$where .= " and YEAR(isian_amatan.tanggal)=".$TahunAwal;
					// $where .= " and YEAR(isian_amatan.tanggal)>=".$TahunAkhir;
				}

		$this->join_avaiableKepsek();
    $this->db->where($where);
		$query = $this->db->get($table_name);

		return $query->num_rows();
	}

	public function get($q = null, $field = null, $limit = 0, $offset = 0, $getBulanAwal = null, $getTahunAwal = null, $getBulanAkhir = null, $select_field = [])
	{
		$primary_key 	= 'id_isian_amatan';
		$table_name		= 'isian_amatan';
		$field_search = ['tanggal', 'jam', 'minggu', 'id_kodesekolah', 'id_siswa', 'id_indikator_pbp', 'id_lokasi_amatan', 'id_jenis_pengamat', 'id_pengamat'];

		$iterasi = 1;
    $num = count($field_search);
    $where = NULL;
    $q = $this->scurity($q);
		$field = $this->scurity($field);

		$BulanAwal = $this->scurity($getBulanAwal);
		$TahunAwal = $this->scurity($getTahunAwal);
    $BulanAkhir = $this->scurity($getBulanAkhir);
		

        if (empty($field)) {
	        foreach ($field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "isian_amatan.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "isian_amatan.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "isian_amatan.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }

				if ($BulanAwal != null) {
					$where .= " and MONTH(isian_amatan.tanggal)>=".$BulanAwal;
					$where .= " and MONTH(isian_amatan.tanggal)<=".$BulanAkhir;
					$where .= " and YEAR(isian_amatan.tanggal)=".$TahunAwal;
					// $where .= " and YEAR(isian_amatan.tanggal)>=".$TahunAkhir;
				}
		
		$this->join_avaiableKepsek();
    $this->db->where($where);
    $this->db->limit($limit, $offset);
    $this->db->order_by('isian_amatan.'.$primary_key, "DESC");
		$query = $this->db->get($table_name);

		return $query->result();
	}

	public function count_allKepsekSMP($q = null, $field = null, $getBulanAwal = null, $getTahunAwal = null, $getBulanAkhir = null)
	{
		$table_name 	= 'isian_amatan';
		$field_search = ['tanggal', 'jam', 'minggu', 'id_kodesekolah', 'id_siswa', 'id_indikator_pbp', 'id_lokasi_amatan', 'id_jenis_pengamat', 'id_pengamat'];

		$iterasi = 1;
    $num = count($field_search);
    $where = NULL;
    $q = $this->scurity($q);
		$field = $this->scurity($field);

		$BulanAwal = $this->scurity($getBulanAwal);
		$TahunAwal = $this->scurity($getTahunAwal);
    $BulanAkhir = $this->scurity($getBulanAkhir);

        if (empty($field)) {
	        foreach ($field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "isian_amatan.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "isian_amatan.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "isian_amatan.".$field . " LIKE '%" . $q . "%' )";
        }

    $where .= "and isian_amatan.id_kodesekolah=".$this->smp;

		if ($BulanAwal != null) {
      $where .= " and MONTH(isian_amatan.tanggal)>=".$BulanAwal;
      $where .= " and MONTH(isian_amatan.tanggal)<=".$BulanAkhir;
      $where .= " and YEAR(isian_amatan.tanggal)=".$TahunAwal;
      // $where .= " and YEAR(isian_amatan.tanggal)>=".$TahunAkhir;
    }

		$this->join_avaiableKepsek();
    $this->db->where($where);
		$query = $this->db->get($table_name);

		return $query->num_rows();
	}

	public function getKepsekSMP($q = null, $field = null, $limit = 0, $offset = 0, $getBulanAwal = null, $getTahunAwal = null, $getBulanAkhir = null, $select_field = [])
	{
		$primary_key 	= 'id_isian_amatan';
		$table_name		= 'isian_amatan';
		$field_search = ['tanggal', 'jam', 'minggu', 'id_kodesekolah', 'id_siswa', 'id_indikator_pbp', 'id_lokasi_amatan', 'id_jenis_pengamat', 'id_pengamat'];

		$iterasi = 1;
    $num = count($field_search);
    $where = NULL;
    $q = $this->scurity($q);
		$field = $this->scurity($field);

		$BulanAwal = $this->scurity($getBulanAwal);
		$TahunAwal = $this->scurity($getTahunAwal);
    $BulanAkhir = $this->scurity($getBulanAkhir);

        if (empty($field)) {
	        foreach ($field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "isian_amatan.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "isian_amatan.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "isian_amatan.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }

    $where .= "and isian_amatan.id_kodesekolah=".$this->smp;

		if ($BulanAwal != null) {
      $where .= " and MONTH(isian_amatan.tanggal)>=".$BulanAwal;
      $where .= " and MONTH(isian_amatan.tanggal)<=".$BulanAkhir;
      $where .= " and YEAR(isian_amatan.tanggal)=".$TahunAwal;
      // $where .= " and YEAR(isian_amatan.tanggal)>=".$TahunAkhir;
    }
		
		$this->join_avaiableKepsek();
    $this->db->where($where);
    $this->db->limit($limit, $offset);
    $this->db->order_by('isian_amatan.'.$primary_key, "DESC");
		$query = $this->db->get($table_name);

		return $query->result();
	}

	public function count_allKepsekSMA($q = null, $field = null, $getBulanAwal = null, $getTahunAwal = null, $getBulanAkhir = null)
	{
		$table_name 	= 'isian_amatan';
		$field_search = ['tanggal', 'jam', 'minggu', 'id_kodesekolah', 'id_siswa', 'id_indikator_pbp', 'id_lokasi_amatan', 'id_jenis_pengamat', 'id_pengamat'];

		$iterasi = 1;
    $num = count($field_search);
    $where = NULL;
    $q = $this->scurity($q);
		$field = $this->scurity($field);

		$BulanAwal = $this->scurity($getBulanAwal);
		$TahunAwal = $this->scurity($getTahunAwal);
    $BulanAkhir = $this->scurity($getBulanAkhir);
		

        if (empty($field)) {
	        foreach ($field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "isian_amatan.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "isian_amatan.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "isian_amatan.".$field . " LIKE '%" . $q . "%' )";
        }

    $where .= " and isian_amatan.id_kodesekolah=".$this->sma;
    
		if ($BulanAwal != null) {
      $where .= " and MONTH(isian_amatan.tanggal)>=".$BulanAwal;
      $where .= " and MONTH(isian_amatan.tanggal)<=".$BulanAkhir;
      $where .= " and YEAR(isian_amatan.tanggal)=".$TahunAwal;
      // $where .= " and YEAR(isian_amatan.tanggal)>=".$TahunAkhir;
    }

		$this->join_avaiableKepsek();
    $this->db->where($where);
		$query = $this->db->get($table_name);

		return $query->num_rows();
	}

	public function getKepsekSMA($q = null, $field = null, $limit = 0, $offset = 0, $getBulanAwal = null, $getTahunAwal = null, $getBulanAkhir = null, $select_field = [])
	{
		$primary_key 	= 'id_isian_amatan';
		$table_name		= 'isian_amatan';
		$field_search = ['tanggal', 'jam', 'minggu', 'id_kodesekolah', 'id_siswa', 'id_indikator_pbp', 'id_lokasi_amatan', 'id_jenis_pengamat', 'id_pengamat'];

		$iterasi = 1;
    $num = count($field_search);
    $where = NULL;
    $q = $this->scurity($q);
		$field = $this->scurity($field);

    $BulanAwal = $this->scurity($getBulanAwal);
		$TahunAwal = $this->scurity($getTahunAwal);
    $BulanAkhir = $this->scurity($getBulanAkhir);
		

    // var_dump($BulanAwal);
    // die;
    

        if (empty($field)) {
	        foreach ($field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "isian_amatan.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "isian_amatan.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "isian_amatan.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }

    $where .= " and isian_amatan.id_kodesekolah=".$this->sma ;
    
    if ($BulanAwal != null) {
      $where .= " and MONTH(isian_amatan.tanggal)>=".$BulanAwal;
      $where .= " and MONTH(isian_amatan.tanggal)<=".$BulanAkhir;
      $where .= " and YEAR(isian_amatan.tanggal)=".$TahunAwal;
      // $where .= " and YEAR(isian_amatan.tanggal)>=".$TahunAkhir;
    }
		
		$this->join_avaiableKepsek();
    $this->db->where($where);
    $this->db->limit($limit, $offset);
    $this->db->order_by('isian_amatan.'.$primary_key, "DESC");
		$query = $this->db->get($table_name);

		return $query->result();
	}

	public function count_allKepsekSMK($q = null, $field = null, $getBulanAwal = null, $getTahunAwal = null, $getBulanAkhir = null)
	{
		$table_name 	= 'isian_amatan';
		$field_search = ['tanggal', 'jam', 'minggu', 'id_kodesekolah', 'id_siswa', 'id_indikator_pbp', 'id_lokasi_amatan', 'id_jenis_pengamat', 'id_pengamat'];

		$iterasi = 1;
    $num = count($field_search);
    $where = NULL;
    $q = $this->scurity($q);
		$field = $this->scurity($field);

		$BulanAwal = $this->scurity($getBulanAwal);
		$TahunAwal = $this->scurity($getTahunAwal);
    $BulanAkhir = $this->scurity($getBulanAkhir);

        if (empty($field)) {
	        foreach ($field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "isian_amatan.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "isian_amatan.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "isian_amatan.".$field . " LIKE '%" . $q . "%' )";
        }

    $where .= "and isian_amatan.id_kodesekolah=".$this->smk;

		if ($BulanAwal != null) {
      $where .= " and MONTH(isian_amatan.tanggal)>=".$BulanAwal;
      $where .= " and MONTH(isian_amatan.tanggal)<=".$BulanAkhir;
      $where .= " and YEAR(isian_amatan.tanggal)=".$TahunAwal;
      // $where .= " and YEAR(isian_amatan.tanggal)>=".$TahunAkhir;
    }

		$this->join_avaiableKepsek();
    $this->db->where($where);
		$query = $this->db->get($table_name);

		return $query->num_rows();
	}

	public function getKepsekSMK($q = null, $field = null, $limit = 0, $offset = 0, $getBulanAwal = null, $getTahunAwal = null, $getBulanAkhir = null, $select_field = [])
	{
		$primary_key 	= 'id_isian_amatan';
		$table_name		= 'isian_amatan';
		$field_search = ['tanggal', 'jam', 'minggu', 'id_kodesekolah', 'id_siswa', 'id_indikator_pbp', 'id_lokasi_amatan', 'id_jenis_pengamat', 'id_pengamat'];

		$iterasi = 1;
    $num = count($field_search);
    $where = NULL;
    $q = $this->scurity($q);
		$field = $this->scurity($field);

		$BulanAwal = $this->scurity($getBulanAwal);
		$TahunAwal = $this->scurity($getTahunAwal);
    $BulanAkhir = $this->scurity($getBulanAkhir);

        if (empty($field)) {
	        foreach ($field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "isian_amatan.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "isian_amatan.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "isian_amatan.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }

    $where .= "and isian_amatan.id_kodesekolah=".$this->smk;
		
		if ($BulanAwal != null) {
      $where .= " and MONTH(isian_amatan.tanggal)>=".$BulanAwal;
      $where .= " and MONTH(isian_amatan.tanggal)<=".$BulanAkhir;
      $where .= " and YEAR(isian_amatan.tanggal)=".$TahunAwal;
      // $where .= " and YEAR(isian_amatan.tanggal)>=".$TahunAkhir;
    }
		
		$this->join_avaiableKepsek();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('isian_amatan.'.$primary_key, "DESC");
		$query = $this->db->get($table_name);

		return $query->result();
	}

	public function join_avaiableKepsek() {

    $this->db->select('kode_sekolah.id_kodesekolah as id_kodesekolah, kode_sekolah.kode_sekolah as kode_sekolah, count(isian_amatan.id_isian_amatan) as total_amatan');

		$this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
		$this->db->group_by('isian_amatan.id_kodesekolah');
		$this->db->order_by('kode_sekolah.id_kodesekolah', "ASC");
	    
    return $this;
	}

	public function getDataBK($id_siswa, $getBulanAwal = null, $getTahunAwal = null, $getBulanAkhir = null) {

    $this->db->select('tindakan_bk.*, aauth_users.full_name as nama_bk');

		$this->db->join('aauth_users', 'aauth_users.id = tindakan_bk.id_guru_bk', 'LEFT');
		$this->db->order_by('tindakan_bk.tanggal', "ASC");
	    
    // $this->db->order_by('isian_amatan.tanggal', "ASC");
	  if ($getBulanAwal != null) {
			$query = $this->db->get_where('tindakan_bk', array('tindakan_bk.id_siswa'=>$id_siswa, 'MONTH(tindakan_bk.tanggal)>='=>$getBulanAwal, 'MONTH(tindakan_bk.tanggal)<='=>$getBulanAkhir, 'YEAR(tindakan_bk.tanggal)'=>$getTahunAwal));
		} else {
			$query = $this->db->get_where('tindakan_bk', array('tindakan_bk.id_siswa'=>$id_siswa));
		}
		
		$data = $query->result();
		return $data;
	}

	public function count_allDataBK($id_siswa, $getBulanAwal = null, $getTahunAwal = null, $getBulanAkhir = null) {

    $this->db->select('tindakan_bk.*, aauth_users.full_name as nama_bk');

		$this->db->join('aauth_users', 'aauth_users.id = tindakan_bk.id_guru_bk', 'LEFT');
		$this->db->order_by('tindakan_bk.tanggal', "ASC");
	    
    // $this->db->order_by('tindakan_bk.tanggal', "ASC");
	    
		if ($getBulanAwal != null) {
			$query = $this->db->get_where('tindakan_bk', array('tindakan_bk.id_siswa'=>$id_siswa, 'MONTH(tindakan_bk.tanggal)>='=>$getBulanAwal, 'MONTH(tindakan_bk.tanggal)<='=>$getBulanAkhir, 'YEAR(tindakan_bk.tanggal)'=>$getTahunAwal));
		} else {
			$query = $this->db->get_where('tindakan_bk', array('tindakan_bk.id_siswa'=>$id_siswa));
		}

		$data = $query->num_rows();
		return $data;
	}

	public function count_allRombel($id_kodesekolah)
	{
		$maxIdPeriodeList = $this->maxIdPeriodeList();
		$this->db->select('id_rombel, nama_rombel');

		$this->db->group_by('rombel.nama_rombel');
		
		$this->db->order_by('rombel.nama_rombel', "ASC");
		
		$query = $this->db->get_where('rombel', array('rombel.kode_sekolah'=>$id_kodesekolah, 'rombel.periode' =>$maxIdPeriodeList));

    return $query->num_rows();
	}

	public function getRombel($id_kodesekolah)
	{
		$maxIdPeriodeList = $this->maxIdPeriodeList();
		$this->db->select('id_rombel, nama_rombel, kode_sekolah');

		$this->db->group_by('rombel.nama_rombel');
		
		$this->db->order_by('rombel.nama_rombel', "ASC");
		
		$query = $this->db->get_where('rombel', array('rombel.kode_sekolah'=>$id_kodesekolah, 'rombel.periode' =>$maxIdPeriodeList));

    if($query->num_rows()>0) {
		 	return $query->result();
		}
	}

	public function count_allAmatan($id_rombel, $getBulanAwal = null, $getTahunAwal = null, $getBulanAkhir = null)
	{
		$maxIdPeriodeList = $this->maxIdPeriodeList();
		$this->db->select('id_isian_amatan, isian_amatan.tanggal as tanggal, kode_sekolah.id_kodesekolah as id_kodesekolah, kode_sekolah.kode_sekolah as kode_sekolah, rombel.nama_rombel as kelas, nama,

			count(status_amatan.id_status_amatan) as total_status, isian_amatan.id_siswa as id_siswa');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    // $this->db->join('tindakan_bk', 'tindakan_bk.id_siswa = isian_amatan.id_siswa', 'LEFT');

		$this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
		$this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
		$this->db->group_by('isian_amatan.id_siswa');
		$this->db->order_by('total_status', "DESC");
		// $this->db->limit(15);
		// $this->db->get_where('isian_amatan', array('isian_amatan.id_kodesekolah'=>1));
		
		if ($getBulanAwal != null) {
			$query = $this->db->get_where('isian_amatan', array('rombel.id_rombel'=>$id_rombel, 'MONTH(isian_amatan.tanggal)>='=>$getBulanAwal, 'MONTH(isian_amatan.tanggal)<='=>$getBulanAkhir, 'YEAR(isian_amatan.tanggal)'=>$getTahunAwal, 'rombel.periode' =>$maxIdPeriodeList));
      // $where .= " and YEAR(isian_amatan.tanggal)>=".$TahunAkhir;
    } else {
			$query = $this->db->get_where('isian_amatan', array('rombel.id_rombel'=>$id_rombel, 'rombel.periode' =>$maxIdPeriodeList));
		}

    return $query->num_rows();
	}

	public function getAmatan($id_rombel, $getBulanAwal = null, $getTahunAwal = null, $getBulanAkhir = null)
	{
		$maxIdPeriodeList = $this->maxIdPeriodeList();
		$this->db->select('id_isian_amatan, isian_amatan.tanggal as tanggal, kode_sekolah.id_kodesekolah as id_kodesekolah, kode_sekolah.kode_sekolah as kode_sekolah, rombel.id_rombel as id_rombel, rombel.nama_rombel as kelas, nama,

			count(status_amatan.id_status_amatan) as total_status, isian_amatan.id_siswa as id_siswa');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    // $this->db->join('tindakan_bk', 'tindakan_bk.id_siswa = isian_amatan.id_siswa', 'LEFT');

		$this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
		$this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
		$this->db->group_by('isian_amatan.id_siswa');
		$this->db->order_by('total_status', "DESC");
		// $this->db->limit(15);
		// $this->db->get_where('isian_amatan', array('isian_amatan.id_kodesekolah'=>1));

		if ($getBulanAwal != null) {
			$query = $this->db->get_where('isian_amatan', array('rombel.id_rombel'=>$id_rombel, 'MONTH(isian_amatan.tanggal)>='=>$getBulanAwal, 'MONTH(isian_amatan.tanggal)<='=>$getBulanAkhir, 'YEAR(isian_amatan.tanggal)='=>$getTahunAwal, 'rombel.periode' =>$maxIdPeriodeList));
      // $where .= " and YEAR(isian_amatan.tanggal)>=".$TahunAkhir;
    } else {
			$query = $this->db->get_where('isian_amatan', array('rombel.id_rombel'=>$id_rombel, 'rombel.periode' =>$maxIdPeriodeList));
		}

    if($query->num_rows()>0) {
		 	return $query->result();
		}
	}

  public function getBulanAwal($id_semester = null){
		$this->db->select('*');
		$this->db->from('semester');
		$this->db->join('bulan','bulan.id_bulan = semester.bulan_awal');
		$this->db->where('id_semester', $id_semester);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$BulanAwal = $data['angka'];
		}
		return $BulanAwal;
	}

	public function getTahunAwal($id_semester = null){
		$this->db->select('*');
		$this->db->from('semester');
		$this->db->where('id_semester', $id_semester);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$TahunAwal = $data['tahun_awal'];
		}
		return $TahunAwal;
	}

	public function getBulanAkhir($id_semester = null){
		$this->db->select('*');
		$this->db->from('semester');
		$this->db->join('bulan','bulan.id_bulan = semester.bulan_akhir');
		$this->db->where('id_semester', $id_semester);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$BulanAkhir = $data['angka'];
		}
		return $BulanAkhir;
	}

	public function getTahunAkhir($id_semester = null){
		$this->db->select('*');
		$this->db->from('semester');
		$this->db->where('id_semester', $id_semester);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$TahunAkhir = $data['tahun_akhir'];
		}
		return $TahunAkhir;
	}
	






















	// public function count_all($q = null, $field = null)
	// {
	// 	$iterasi = 1;
 //    $num = count($this->field_search);
 //    $where = NULL;
 //    $q = $this->scurity($q);
	// 	$field = $this->scurity($field);

 //        if (empty($field)) {
	//         foreach ($this->field_search as $field) {
	//             if ($iterasi == 1) {
	//                 $where .= "tindakan_bk.".$field . " LIKE '%" . $q . "%' ";
	//             } else {
	//                 $where .= "OR " . "tindakan_bk.".$field . " LIKE '%" . $q . "%' ";
	//             }
	//             $iterasi++;
	//         }

	//         $where = '('.$where.')';
 //        } else {
 //        	$where .= "(" . "tindakan_bk.".$field . " LIKE '%" . $q . "%' )";
 //        }

	// 	$this->join_avaiable();
 //    $this->db->where($where);
	// 	$query = $this->db->get($this->table_name);

	// 	return $query->num_rows();
	// }

	// public function get($q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
	// {
	// 	$iterasi = 1;
 //    $num = count($this->field_search);
 //    $where = NULL;
 //    $q = $this->scurity($q);
	// 	$field = $this->scurity($field);

 //        if (empty($field)) {
	//         foreach ($this->field_search as $field) {
	//             if ($iterasi == 1) {
	//                 $where .= "tindakan_bk.".$field . " LIKE '%" . $q . "%' ";
	//             } else {
	//                 $where .= "OR " . "tindakan_bk.".$field . " LIKE '%" . $q . "%' ";
	//             }
	//             $iterasi++;
	//         }

	//         $where = '('.$where.')';
 //        } else {
 //        	$where .= "(" . "tindakan_bk.".$field . " LIKE '%" . $q . "%' )";
 //        }

 //        if (is_array($select_field) AND count($select_field)) {
 //        	$this->db->select($select_field);
 //        }
		
	// 	$this->join_avaiable();
 //        $this->db->where($where);
 //        $this->db->limit($limit, $offset);
 //        $this->db->order_by('tindakan_bk.'.$this->primary_key, "DESC");
	// 	$query = $this->db->get($this->table_name);

	// 	return $query->result();
	// }

	// public function join_avaiable() {

 //    $this->db->select('tindakan_bk.*, aauth_users.full_name as nama_bk');

	// 	$this->db->join('aauth_users', 'aauth_users.id = tindakan_bk.id_guru_bk', 'LEFT');
	// 	$this->db->order_by('tindakan_bk.tanggal', "ASC");
	    
 //    return $this;
	// }

}

/* End of file Model_tindakan_bk.php */
/* Location: ./application/models/Model_tindakan_bk.php */
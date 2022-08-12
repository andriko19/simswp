<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_rapot_pbp extends MY_Model {

	private $primary_key 	= 'id_rapot_pbp';
	private $table_name 	= 'rapot_pbp';
	private $field_search = ['nama', 'nama_rombel', 'nama_guru'];

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
		
		$this->join_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('rapot_pbp.'.$this->primary_key, "DESC");
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

    $where .= "and aauth_users.id=".$this->session->id;

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

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }

    $where .= "and aauth_users.id=".$this->session->id;
		
		$this->join_avaiable();
    $this->db->where($where);
    $this->db->limit($limit, $offset);
    $this->db->order_by('rapot_pbp.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

	public function join_avaiable() 
	{
		$this->db->select('rapot_pbp.*,siswa.nama as nama_siswa, rombel.nama_rombel as rombel, pilar_1.pilar_pbp as pilar_1, pilar_2.pilar_pbp as pilar_2, pilar_3.pilar_pbp as pilar_3, pilar_4.pilar_pbp as pilar_4, pilar_5.pilar_pbp as pilar_5, pilar_6.pilar_pbp as pilar_6, periode.periode as periode, semester.semester as semester, guru.nama_guru as guru');

		$this->db->join('siswa', 'siswa.id_siswa = rapot_pbp.id_siswa', 'LEFT');
		$this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
		$this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
		$this->db->join('pilar_pbp pilar_1', 'pilar_1.id_pilar_pbp = rapot_pbp.id_pilar_pbp_1', 'LEFT');
		$this->db->join('pilar_pbp pilar_2', 'pilar_2.id_pilar_pbp = rapot_pbp.id_pilar_pbp_2', 'LEFT');
		$this->db->join('pilar_pbp pilar_3', 'pilar_3.id_pilar_pbp = rapot_pbp.id_pilar_pbp_3', 'LEFT');
		$this->db->join('pilar_pbp pilar_4', 'pilar_4.id_pilar_pbp = rapot_pbp.id_pilar_pbp_4', 'LEFT');
		$this->db->join('pilar_pbp pilar_5', 'pilar_5.id_pilar_pbp = rapot_pbp.id_pilar_pbp_5', 'LEFT');
		$this->db->join('pilar_pbp pilar_6', 'pilar_6.id_pilar_pbp = rapot_pbp.id_pilar_pbp_6', 'LEFT');
	  $this->db->join('semester', 'semester.id_semester = rapot_pbp.id_semester', 'LEFT');
	  $this->db->join('periode', 'periode.id_periode = semester.id_periode', 'LEFT');
	  $this->db->join('guru', 'guru.id_guru = rapot_pbp.id_guru', 'LEFT');
	  $this->db->join('aauth_users', 'aauth_users.id_guru = rapot_pbp.id_guru', 'LEFT');
	    
    	return $this;
	}

	public function getWali($b) 
	{
		$this->db->select('*');
		$this->db->from('aauth_users');
		$this->db->where('id', $b);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$id_guru = $data['id_guru'];
		}
		return $id_guru;
	}

	public function Semester()
	{
		$semester="<option value=''>--pilih--</option>";

		$this->db->select('*');
		$this->db->from('semester');
		$this->db->join('periode','periode.id_periode = semester.id_periode');
		// $this->db->where('id_sekolah', $id_sekolah);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$semester.= "<option value='$data[id_semester]'>$data[periode] / $data[semester]</option>";
		}
		return $semester;
	}

	public function getBulanAwal($id_semester)
	{
		$this->db->select('*');
		$this->db->from('semester');
		$this->db->where('id_semester', $id_semester);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$bulan_awal = $data['bulan_awal'];
		}
		return $bulan_awal;
	}

	public function getTahunAwal($id_semester)
	{
		$this->db->select('*');
		$this->db->from('semester');
		$this->db->where('id_semester', $id_semester);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$tahun_awal = $data['tahun_awal'];
		}
		return $tahun_awal;
	}

	public function getBulanAkhir($id_semester)
	{
		$this->db->select('*');
		$this->db->from('semester');
		$this->db->where('id_semester', $id_semester);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$bulan_akhir = $data['bulan_akhir'];
		}
		return $bulan_akhir;
	}

	public function getTahunAkhir($id_semester)
	{
		$this->db->select('*');
		$this->db->from('semester');
		$this->db->where('id_semester', $id_semester);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$tahun_akhir = $data['tahun_akhir'];
		}
		return $tahun_akhir;
	}
	
	public function getPilar_1($id_siswa, $id_pilar_pbp_1, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir)
	{
		$this->db->select("dimensi_pbp.dimensi_pbp as nama_dimensi, isi_amatan, indikator_amatan_pbp.kode_indikator as kode_indikator, count(isian_amatan.id_indikator_pbp) as total_indikator,

			(select count(*) from isian_amatan ia where ia.id_status_amatan=1 and ia.id_siswa=$id_siswa and ia.isi_amatan=isian_amatan.isi_amatan and ia.id_indikator_pbp=isian_amatan.id_indikator_pbp and MONTH(ia.tanggal) BETWEEN $bulanAwal AND $bulanAkhir and YEAR(ia.tanggal) BETWEEN $tahunAwal AND $tahunAkhir) as total_positif,

			(select count(*) from isian_amatan ia where ia.id_status_amatan=2 and ia.id_siswa=$id_siswa and ia.isi_amatan=isian_amatan.isi_amatan and ia.id_indikator_pbp=isian_amatan.id_indikator_pbp and MONTH(ia.tanggal) BETWEEN $bulanAwal AND $bulanAkhir and YEAR(ia.tanggal) BETWEEN $tahunAwal AND $tahunAkhir) as total_negatif

			");

    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('dimensi_pbp', 'dimensi_pbp.id_dimensi_pbp = indikator_amatan_pbp.id_dimensi_pbp', 'LEFT');
    $this->db->join('pilar_pbp', 'pilar_pbp.id_pilar_pbp = dimensi_pbp.id_pilar_pbp', 'LEFT');

    $this->db->order_by('indikator_amatan_pbp.id_indikator_pbp', "ASC");
    $this->db->group_by('isi_amatan');
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$bulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$tahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$bulanAkhir, 'YEAR(isian_amatan.tanggal)<='=>$tahunAkhir, 'isian_amatan.id_siswa'=>$id_siswa, 'pilar_pbp.id_pilar_pbp'=>$id_pilar_pbp_1));
		$data = $query->result();
		return $data;
	}

	public function getPilar_2($id_siswa, $id_pilar_pbp_2, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir)
	{
		$this->db->select("dimensi_pbp.dimensi_pbp as nama_dimensi, isi_amatan, indikator_amatan_pbp.kode_indikator as kode_indikator, count(isian_amatan.id_indikator_pbp) as total_indikator,

			(select count(*) from isian_amatan ia where ia.id_status_amatan=1 and ia.id_siswa=$id_siswa and ia.isi_amatan=isian_amatan.isi_amatan and ia.id_indikator_pbp=isian_amatan.id_indikator_pbp and MONTH(ia.tanggal) BETWEEN $bulanAwal AND $bulanAkhir and YEAR(ia.tanggal) BETWEEN $tahunAwal AND $tahunAkhir) as total_positif,

			(select count(*) from isian_amatan ia where ia.id_status_amatan=2 and ia.id_siswa=$id_siswa and ia.isi_amatan=isian_amatan.isi_amatan and ia.id_indikator_pbp=isian_amatan.id_indikator_pbp and MONTH(ia.tanggal) BETWEEN $bulanAwal AND $bulanAkhir and YEAR(ia.tanggal) BETWEEN $tahunAwal AND $tahunAkhir) as total_negatif

			");

    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('dimensi_pbp', 'dimensi_pbp.id_dimensi_pbp = indikator_amatan_pbp.id_dimensi_pbp', 'LEFT');
    $this->db->join('pilar_pbp', 'pilar_pbp.id_pilar_pbp = dimensi_pbp.id_pilar_pbp', 'LEFT');

    $this->db->order_by('indikator_amatan_pbp.id_indikator_pbp', "ASC");
    $this->db->group_by('isi_amatan');
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$bulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$tahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$bulanAkhir, 'YEAR(isian_amatan.tanggal)<='=>$tahunAkhir, 'isian_amatan.id_siswa'=>$id_siswa, 'pilar_pbp.id_pilar_pbp'=>$id_pilar_pbp_2));
		$data = $query->result();
		return $data;
	}

	public function getPilar_3($id_siswa, $id_pilar_pbp_3, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir)
	{
		$this->db->select("dimensi_pbp.dimensi_pbp as nama_dimensi, isi_amatan, indikator_amatan_pbp.kode_indikator as kode_indikator, count(isian_amatan.id_indikator_pbp) as total_indikator,

			(select count(*) from isian_amatan ia where ia.id_status_amatan=1 and ia.id_siswa=$id_siswa and ia.isi_amatan=isian_amatan.isi_amatan and ia.id_indikator_pbp=isian_amatan.id_indikator_pbp and MONTH(ia.tanggal) BETWEEN $bulanAwal AND $bulanAkhir and YEAR(ia.tanggal) BETWEEN $tahunAwal AND $tahunAkhir) as total_positif,

			(select count(*) from isian_amatan ia where ia.id_status_amatan=2 and ia.id_siswa=$id_siswa and ia.isi_amatan=isian_amatan.isi_amatan and ia.id_indikator_pbp=isian_amatan.id_indikator_pbp and MONTH(ia.tanggal) BETWEEN $bulanAwal AND $bulanAkhir and YEAR(ia.tanggal) BETWEEN $tahunAwal AND $tahunAkhir) as total_negatif

			");

    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('dimensi_pbp', 'dimensi_pbp.id_dimensi_pbp = indikator_amatan_pbp.id_dimensi_pbp', 'LEFT');
    $this->db->join('pilar_pbp', 'pilar_pbp.id_pilar_pbp = dimensi_pbp.id_pilar_pbp', 'LEFT');

    $this->db->order_by('indikator_amatan_pbp.id_indikator_pbp', "ASC");
    $this->db->group_by('isi_amatan');
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$bulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$tahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$bulanAkhir, 'YEAR(isian_amatan.tanggal)<='=>$tahunAkhir, 'isian_amatan.id_siswa'=>$id_siswa, 'pilar_pbp.id_pilar_pbp'=>$id_pilar_pbp_3));
		$data = $query->result();
		return $data;
	}

	public function getPilar_4($id_siswa, $id_pilar_pbp_4, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir)
	{
		$this->db->select("dimensi_pbp.dimensi_pbp as nama_dimensi, isi_amatan, indikator_amatan_pbp.kode_indikator as kode_indikator, count(isian_amatan.id_indikator_pbp) as total_indikator,

			(select count(*) from isian_amatan ia where ia.id_status_amatan=1 and ia.id_siswa=$id_siswa and ia.isi_amatan=isian_amatan.isi_amatan and ia.id_indikator_pbp=isian_amatan.id_indikator_pbp and MONTH(ia.tanggal) BETWEEN $bulanAwal AND $bulanAkhir and YEAR(ia.tanggal) BETWEEN $tahunAwal AND $tahunAkhir) as total_positif,

			(select count(*) from isian_amatan ia where ia.id_status_amatan=2 and ia.id_siswa=$id_siswa and ia.isi_amatan=isian_amatan.isi_amatan and ia.id_indikator_pbp=isian_amatan.id_indikator_pbp and MONTH(ia.tanggal) BETWEEN $bulanAwal AND $bulanAkhir and YEAR(ia.tanggal) BETWEEN $tahunAwal AND $tahunAkhir) as total_negatif

			");

    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('dimensi_pbp', 'dimensi_pbp.id_dimensi_pbp = indikator_amatan_pbp.id_dimensi_pbp', 'LEFT');
    $this->db->join('pilar_pbp', 'pilar_pbp.id_pilar_pbp = dimensi_pbp.id_pilar_pbp', 'LEFT');

    $this->db->order_by('indikator_amatan_pbp.id_indikator_pbp', "ASC");
    $this->db->group_by('isi_amatan');
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$bulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$tahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$bulanAkhir, 'YEAR(isian_amatan.tanggal)<='=>$tahunAkhir, 'isian_amatan.id_siswa'=>$id_siswa, 'pilar_pbp.id_pilar_pbp'=>$id_pilar_pbp_4));
		$data = $query->result();
		return $data;
	}

	public function getPilar_5($id_siswa, $id_pilar_pbp_5, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir)
	{
		$this->db->select("dimensi_pbp.dimensi_pbp as nama_dimensi, isi_amatan, indikator_amatan_pbp.kode_indikator as kode_indikator, count(isian_amatan.id_indikator_pbp) as total_indikator,

			(select count(*) from isian_amatan ia where ia.id_status_amatan=1 and ia.id_siswa=$id_siswa and ia.isi_amatan=isian_amatan.isi_amatan and ia.id_indikator_pbp=isian_amatan.id_indikator_pbp and MONTH(ia.tanggal) BETWEEN $bulanAwal AND $bulanAkhir and YEAR(ia.tanggal) BETWEEN $tahunAwal AND $tahunAkhir) as total_positif,

			(select count(*) from isian_amatan ia where ia.id_status_amatan=2 and ia.id_siswa=$id_siswa and ia.isi_amatan=isian_amatan.isi_amatan and ia.id_indikator_pbp=isian_amatan.id_indikator_pbp and MONTH(ia.tanggal) BETWEEN $bulanAwal AND $bulanAkhir and YEAR(ia.tanggal) BETWEEN $tahunAwal AND $tahunAkhir) as total_negatif

			");

    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('dimensi_pbp', 'dimensi_pbp.id_dimensi_pbp = indikator_amatan_pbp.id_dimensi_pbp', 'LEFT');
    $this->db->join('pilar_pbp', 'pilar_pbp.id_pilar_pbp = dimensi_pbp.id_pilar_pbp', 'LEFT');

    $this->db->order_by('indikator_amatan_pbp.id_indikator_pbp', "ASC");
    $this->db->group_by('isi_amatan');
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$bulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$tahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$bulanAkhir, 'YEAR(isian_amatan.tanggal)<='=>$tahunAkhir, 'isian_amatan.id_siswa'=>$id_siswa, 'pilar_pbp.id_pilar_pbp'=>$id_pilar_pbp_5));
		$data = $query->result();
		return $data;
	}

	public function getPilar_6($id_siswa, $id_pilar_pbp_6, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir)
	{
		$this->db->select("dimensi_pbp.dimensi_pbp as nama_dimensi, isi_amatan, indikator_amatan_pbp.kode_indikator as kode_indikator, count(isian_amatan.id_indikator_pbp) as total_indikator,

			(select count(*) from isian_amatan ia where ia.id_status_amatan=1 and ia.id_siswa=$id_siswa and ia.isi_amatan=isian_amatan.isi_amatan and ia.id_indikator_pbp=isian_amatan.id_indikator_pbp and MONTH(ia.tanggal) BETWEEN $bulanAwal AND $bulanAkhir and YEAR(ia.tanggal) BETWEEN $tahunAwal AND $tahunAkhir) as total_positif,

			(select count(*) from isian_amatan ia where ia.id_status_amatan=2 and ia.id_siswa=$id_siswa and ia.isi_amatan=isian_amatan.isi_amatan and ia.id_indikator_pbp=isian_amatan.id_indikator_pbp and MONTH(ia.tanggal) BETWEEN $bulanAwal AND $bulanAkhir and YEAR(ia.tanggal) BETWEEN $tahunAwal AND $tahunAkhir) as total_negatif

			");

    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('dimensi_pbp', 'dimensi_pbp.id_dimensi_pbp = indikator_amatan_pbp.id_dimensi_pbp', 'LEFT');
    $this->db->join('pilar_pbp', 'pilar_pbp.id_pilar_pbp = dimensi_pbp.id_pilar_pbp', 'LEFT');

    $this->db->order_by('indikator_amatan_pbp.id_indikator_pbp', "ASC");
    $this->db->group_by('isi_amatan');
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$bulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$tahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$bulanAkhir, 'YEAR(isian_amatan.tanggal)<='=>$tahunAkhir, 'isian_amatan.id_siswa'=>$id_siswa, 'pilar_pbp.id_pilar_pbp'=>$id_pilar_pbp_6));
		$data = $query->result();
		return $data;
	}

	public function getNamaSiswa($id_rapot_pbp)
	{
		$this->db->select('*');
		$this->db->from('rapot_pbp');
		$this->db->join('siswa','siswa.id_siswa = rapot_pbp.id_siswa');
		$this->db->where('id_rapot_pbp', $id_rapot_pbp);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$namaSiswa = $data['nama'];
		}
		return $namaSiswa;
	}

	public function getIdSiswa($id_rapot_pbp)
	{
		$this->db->select('*');
		$this->db->from('rapot_pbp');
		$this->db->where('id_rapot_pbp', $id_rapot_pbp);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$IdSiswa = $data['id_siswa'];
		}
		return $IdSiswa;
	}

	public function getNIPD($id_rapot_pbp)
	{
		$this->db->select('*');
		$this->db->from('rapot_pbp');
		$this->db->join('siswa','siswa.id_siswa = rapot_pbp.id_siswa');
		$this->db->where('id_rapot_pbp', $id_rapot_pbp);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$NIPD = $data['nipd'];
		}
		return $NIPD;
	}

	public function getKelas($id_rapot_pbp)
	{
		$this->db->select('*');
		$this->db->from('rapot_pbp');
		$this->db->join('detail_rombel','detail_rombel.id_siswa = rapot_pbp.id_siswa');
		$this->db->join('rombel','rombel.id_rombel = detail_rombel.id_rombel');
		$this->db->where('id_rapot_pbp', $id_rapot_pbp);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$Rombel = $data['nama_rombel'];
		}
		return $Rombel;
	}

	public function getSemester($id_rapot_pbp)
	{
		$this->db->select('*');
		$this->db->from('rapot_pbp');
		$this->db->join('semester','semester.id_semester = rapot_pbp.id_semester');
		$this->db->join('periode','periode.id_periode = semester.id_periode');
		$this->db->where('id_rapot_pbp', $id_rapot_pbp);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$Semester = $data['periode']." ".$data['semester'];
		}
		return $Semester;
	}

	public function getKodeSekolah($id_rapot_pbp)
	{
		$this->db->select('*');
		$this->db->from('rapot_pbp');
		$this->db->join('detail_rombel','detail_rombel.id_siswa = rapot_pbp.id_siswa');
		$this->db->join('rombel','rombel.id_rombel = detail_rombel.id_rombel');
		$this->db->where('id_rapot_pbp', $id_rapot_pbp);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$KodeSekolah = $data['kode_sekolah'];
		}
		return $KodeSekolah;
	}

	public function getWaliKelas($id_rapot_pbp)
	{
		$this->db->select('*');
		$this->db->from('rapot_pbp');
		$this->db->join('guru','guru.id_guru = rapot_pbp.id_guru');
		// $this->db->join('rombel','rombel.id_rombel = detail_rombel.id_rombel');
		$this->db->where('id_rapot_pbp', $id_rapot_pbp);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$WaliKelas = $data['nama_guru'];
		}
		return $WaliKelas;
	}

		public function getTanggal($id_rapot_pbp)
	{
		$this->db->select('*');
		$this->db->from('rapot_pbp');
		// $this->db->join('guru','guru.id_guru = rapot_pbp.id_guru');
		// $this->db->join('rombel','rombel.id_rombel = detail_rombel.id_rombel');
		$this->db->where('id_rapot_pbp', $id_rapot_pbp);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$Tanggal = $data['tanggal'];
		}
		return $Tanggal;
	}

	// Get Catatan PBP
	public function getCatatan_1($id_rapot_pbp)
	{
		$this->db->select('*');
		$this->db->from('rapot_pbp');
		$this->db->where('id_rapot_pbp', $id_rapot_pbp);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$catatan_1 = $data['catatan_pbp_1'];
		}
		return $catatan_1;
	}

	public function getCatatan_2($id_rapot_pbp)
	{
		$this->db->select('*');
		$this->db->from('rapot_pbp');
		$this->db->where('id_rapot_pbp', $id_rapot_pbp);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$catatan_2 = $data['catatan_pbp_2'];
		}
		return $catatan_2;
	}

	public function getCatatan_3($id_rapot_pbp)
	{
		$this->db->select('*');
		$this->db->from('rapot_pbp');
		$this->db->where('id_rapot_pbp', $id_rapot_pbp);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$catatan_3 = $data['catatan_pbp_3'];
		}
		return $catatan_3;
	}

	public function getCatatan_4($id_rapot_pbp)
	{
		$this->db->select('*');
		$this->db->from('rapot_pbp');
		$this->db->where('id_rapot_pbp', $id_rapot_pbp);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$catatan_4 = $data['catatan_pbp_4'];
		}
		return $catatan_4;
	}

	public function getCatatan_5($id_rapot_pbp)
	{
		$this->db->select('*');
		$this->db->from('rapot_pbp');
		$this->db->where('id_rapot_pbp', $id_rapot_pbp);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$catatan_5 = $data['catatan_pbp_5'];
		}
		return $catatan_5;
	}

	public function getCatatan_6($id_rapot_pbp)
	{
		$this->db->select('*');
		$this->db->from('rapot_pbp');
		$this->db->where('id_rapot_pbp', $id_rapot_pbp);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$catatan_6 = $data['catatan_pbp_6'];
		}
		return $catatan_6;
	}

	// Get Id Pilar
	public function getIdPilar_1($id_rapot_pbp)
	{
		$this->db->select('*');
		$this->db->from('rapot_pbp');
		$this->db->where('id_rapot_pbp', $id_rapot_pbp);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$IdPilar_1 = $data['id_pilar_pbp_1'];
		}
		return $IdPilar_1;
	}

	public function getIdPilar_2($id_rapot_pbp)
	{
		$this->db->select('*');
		$this->db->from('rapot_pbp');
		$this->db->where('id_rapot_pbp', $id_rapot_pbp);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$IdPilar_2 = $data['id_pilar_pbp_2'];
		}
		return $IdPilar_2;
	}

	public function getIdPilar_3($id_rapot_pbp)
	{
		$this->db->select('*');
		$this->db->from('rapot_pbp');
		$this->db->where('id_rapot_pbp', $id_rapot_pbp);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$IdPilar_3 = $data['id_pilar_pbp_3'];
		}
		return $IdPilar_3;
	}

	public function getIdPilar_4($id_rapot_pbp)
	{
		$this->db->select('*');
		$this->db->from('rapot_pbp');
		$this->db->where('id_rapot_pbp', $id_rapot_pbp);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$IdPilar_4 = $data['id_pilar_pbp_4'];
		}
		return $IdPilar_4;
	}

	public function getIdPilar_5($id_rapot_pbp)
	{
		$this->db->select('*');
		$this->db->from('rapot_pbp');
		$this->db->where('id_rapot_pbp', $id_rapot_pbp);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$IdPilar_5 = $data['id_pilar_pbp_5'];
		}
		return $IdPilar_5;
	}

	public function getIdPilar_6($id_rapot_pbp)
	{
		$this->db->select('*');
		$this->db->from('rapot_pbp');
		$this->db->where('id_rapot_pbp', $id_rapot_pbp);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$IdPilar_6 = $data['id_pilar_pbp_6'];
		}
		return $IdPilar_6;
	}

	// Get Id Semester
	public function getIdSemseter($id_rapot_pbp)
	{
		$this->db->select('*');
		$this->db->from('rapot_pbp');
		$this->db->where('id_rapot_pbp', $id_rapot_pbp);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$Semester = $data['id_semester'];
		}
		return $Semester;
	}

	// Get Jumlah Amatan Per Pilar
	public function dataJumlahAmatanPilar_1($id_siswa, $id_pilar_pbp_1, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir)
	{
		$this->db->select('tanggal, jam, isi_amatan, lokasi_amatan.nama_lokasi as nama_lokasi, guru.nama_guru as nama_guru');

    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('dimensi_pbp', 'dimensi_pbp.id_dimensi_pbp = indikator_amatan_pbp.id_dimensi_pbp', 'LEFT');
    $this->db->join('pilar_pbp', 'pilar_pbp.id_pilar_pbp = dimensi_pbp.id_pilar_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');

    $this->db->order_by('indikator_amatan_pbp.id_indikator_pbp', "ASC");
    // $this->db->group_by('indikator_amatan_pbp.id_indikator_pbp');
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$bulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$tahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$bulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$tahunAkhir, 'isian_amatan.id_siswa'=>$id_siswa, 'pilar_pbp.id_pilar_pbp'=>$id_pilar_pbp_1));
		$data = $query->num_rows();
		return $data;
	}

	public function dataJumlahAmatanPilar_2($id_siswa, $id_pilar_pbp_2, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir)
	{
		$this->db->select('tanggal, jam, isi_amatan, lokasi_amatan.nama_lokasi as nama_lokasi, guru.nama_guru as nama_guru');

    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('dimensi_pbp', 'dimensi_pbp.id_dimensi_pbp = indikator_amatan_pbp.id_dimensi_pbp', 'LEFT');
    $this->db->join('pilar_pbp', 'pilar_pbp.id_pilar_pbp = dimensi_pbp.id_pilar_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');

    $this->db->order_by('indikator_amatan_pbp.id_indikator_pbp', "ASC");
    // $this->db->group_by('indikator_amatan_pbp.id_indikator_pbp');
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$bulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$tahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$bulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$tahunAkhir, 'isian_amatan.id_siswa'=>$id_siswa, 'pilar_pbp.id_pilar_pbp'=>$id_pilar_pbp_2));
		$data = $query->num_rows();
		return $data;
	}

	public function dataJumlahAmatanPilar_3($id_siswa, $id_pilar_pbp_3, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir)
	{
		$this->db->select('tanggal, jam, isi_amatan, lokasi_amatan.nama_lokasi as nama_lokasi, guru.nama_guru as nama_guru');

    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('dimensi_pbp', 'dimensi_pbp.id_dimensi_pbp = indikator_amatan_pbp.id_dimensi_pbp', 'LEFT');
    $this->db->join('pilar_pbp', 'pilar_pbp.id_pilar_pbp = dimensi_pbp.id_pilar_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');

    $this->db->order_by('indikator_amatan_pbp.id_indikator_pbp', "ASC");
    // $this->db->group_by('indikator_amatan_pbp.id_indikator_pbp');
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$bulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$tahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$bulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$tahunAkhir, 'isian_amatan.id_siswa'=>$id_siswa, 'pilar_pbp.id_pilar_pbp'=>$id_pilar_pbp_3));
		$data = $query->num_rows();
		return $data;
	}

	public function dataJumlahAmatanPilar_4($id_siswa, $id_pilar_pbp_4, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir)
	{
		$this->db->select('tanggal, jam, isi_amatan, lokasi_amatan.nama_lokasi as nama_lokasi, guru.nama_guru as nama_guru');

    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('dimensi_pbp', 'dimensi_pbp.id_dimensi_pbp = indikator_amatan_pbp.id_dimensi_pbp', 'LEFT');
    $this->db->join('pilar_pbp', 'pilar_pbp.id_pilar_pbp = dimensi_pbp.id_pilar_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');

    $this->db->order_by('indikator_amatan_pbp.id_indikator_pbp', "ASC");
    // $this->db->group_by('indikator_amatan_pbp.id_indikator_pbp');
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$bulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$tahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$bulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$tahunAkhir, 'isian_amatan.id_siswa'=>$id_siswa, 'pilar_pbp.id_pilar_pbp'=>$id_pilar_pbp_4));
		$data = $query->num_rows();
		return $data;
	}

	public function dataJumlahAmatanPilar_5($id_siswa, $id_pilar_pbp_5, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir)
	{
		$this->db->select('tanggal, jam, isi_amatan, lokasi_amatan.nama_lokasi as nama_lokasi, guru.nama_guru as nama_guru');

    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('dimensi_pbp', 'dimensi_pbp.id_dimensi_pbp = indikator_amatan_pbp.id_dimensi_pbp', 'LEFT');
    $this->db->join('pilar_pbp', 'pilar_pbp.id_pilar_pbp = dimensi_pbp.id_pilar_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');

    $this->db->order_by('indikator_amatan_pbp.id_indikator_pbp', "ASC");
    // $this->db->group_by('indikator_amatan_pbp.id_indikator_pbp');
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$bulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$tahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$bulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$tahunAkhir, 'isian_amatan.id_siswa'=>$id_siswa, 'pilar_pbp.id_pilar_pbp'=>$id_pilar_pbp_5));
		$data = $query->num_rows();
		return $data;
	}

	public function dataJumlahAmatanPilar_6($id_siswa, $id_pilar_pbp_6, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir)
	{
		$this->db->select('tanggal, jam, isi_amatan, lokasi_amatan.nama_lokasi as nama_lokasi, guru.nama_guru as nama_guru');

    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('dimensi_pbp', 'dimensi_pbp.id_dimensi_pbp = indikator_amatan_pbp.id_dimensi_pbp', 'LEFT');
    $this->db->join('pilar_pbp', 'pilar_pbp.id_pilar_pbp = dimensi_pbp.id_pilar_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');

    $this->db->order_by('indikator_amatan_pbp.id_indikator_pbp', "ASC");
    // $this->db->group_by('indikator_amatan_pbp.id_indikator_pbp');
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$bulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$tahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$bulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$tahunAkhir, 'isian_amatan.id_siswa'=>$id_siswa, 'pilar_pbp.id_pilar_pbp'=>$id_pilar_pbp_6));
		$data = $query->num_rows();
		return $data;
	}

	// Get Amatan Per Pilar
	public function dataAmatanPilar_1($id_siswa, $id_pilar_pbp_1, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir)
	{
		$this->db->select('tanggal, jam, isi_amatan, lokasi_amatan.nama_lokasi as nama_lokasi, guru.nama_guru as nama_guru');

    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('dimensi_pbp', 'dimensi_pbp.id_dimensi_pbp = indikator_amatan_pbp.id_dimensi_pbp', 'LEFT');
    $this->db->join('pilar_pbp', 'pilar_pbp.id_pilar_pbp = dimensi_pbp.id_pilar_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');

    $this->db->order_by('indikator_amatan_pbp.id_indikator_pbp', "ASC");
    // $this->db->group_by('indikator_amatan_pbp.id_indikator_pbp');
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$bulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$tahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$bulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$tahunAkhir, 'isian_amatan.id_siswa'=>$id_siswa, 'pilar_pbp.id_pilar_pbp'=>$id_pilar_pbp_1));
		$data = $query->result();
		return $data;
	}

	public function dataAmatanPilar_2($id_siswa, $id_pilar_pbp_2, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir)
	{
		$this->db->select('tanggal, jam, isi_amatan, lokasi_amatan.nama_lokasi as nama_lokasi, guru.nama_guru as nama_guru');

    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('dimensi_pbp', 'dimensi_pbp.id_dimensi_pbp = indikator_amatan_pbp.id_dimensi_pbp', 'LEFT');
    $this->db->join('pilar_pbp', 'pilar_pbp.id_pilar_pbp = dimensi_pbp.id_pilar_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');

    $this->db->order_by('indikator_amatan_pbp.id_indikator_pbp', "ASC");
    // $this->db->group_by('indikator_amatan_pbp.id_indikator_pbp');
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$bulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$tahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$bulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$tahunAkhir, 'isian_amatan.id_siswa'=>$id_siswa, 'pilar_pbp.id_pilar_pbp'=>$id_pilar_pbp_2));
		$data = $query->result();
		return $data;
	}

	public function dataAmatanPilar_3($id_siswa, $id_pilar_pbp_3, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir)
	{
		$this->db->select('tanggal, jam, isi_amatan, lokasi_amatan.nama_lokasi as nama_lokasi, guru.nama_guru as nama_guru');

    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('dimensi_pbp', 'dimensi_pbp.id_dimensi_pbp = indikator_amatan_pbp.id_dimensi_pbp', 'LEFT');
    $this->db->join('pilar_pbp', 'pilar_pbp.id_pilar_pbp = dimensi_pbp.id_pilar_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');

    $this->db->order_by('indikator_amatan_pbp.id_indikator_pbp', "ASC");
    // $this->db->group_by('indikator_amatan_pbp.id_indikator_pbp');
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$bulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$tahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$bulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$tahunAkhir, 'isian_amatan.id_siswa'=>$id_siswa, 'pilar_pbp.id_pilar_pbp'=>$id_pilar_pbp_3));
		$data = $query->result();
		return $data;
	}

	public function dataAmatanPilar_4($id_siswa, $id_pilar_pbp_4, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir)
	{
		$this->db->select('tanggal, jam, isi_amatan, lokasi_amatan.nama_lokasi as nama_lokasi, guru.nama_guru as nama_guru');

    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('dimensi_pbp', 'dimensi_pbp.id_dimensi_pbp = indikator_amatan_pbp.id_dimensi_pbp', 'LEFT');
    $this->db->join('pilar_pbp', 'pilar_pbp.id_pilar_pbp = dimensi_pbp.id_pilar_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');

    $this->db->order_by('indikator_amatan_pbp.id_indikator_pbp', "ASC");
    // $this->db->group_by('indikator_amatan_pbp.id_indikator_pbp');
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$bulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$tahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$bulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$tahunAkhir, 'isian_amatan.id_siswa'=>$id_siswa, 'pilar_pbp.id_pilar_pbp'=>$id_pilar_pbp_4));
		$data = $query->result();
		return $data;
	}

	public function dataAmatanPilar_5($id_siswa, $id_pilar_pbp_5, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir)
	{
		$this->db->select('tanggal, jam, isi_amatan, lokasi_amatan.nama_lokasi as nama_lokasi, guru.nama_guru as nama_guru');

    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('dimensi_pbp', 'dimensi_pbp.id_dimensi_pbp = indikator_amatan_pbp.id_dimensi_pbp', 'LEFT');
    $this->db->join('pilar_pbp', 'pilar_pbp.id_pilar_pbp = dimensi_pbp.id_pilar_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');

    $this->db->order_by('indikator_amatan_pbp.id_indikator_pbp', "ASC");
    // $this->db->group_by('indikator_amatan_pbp.id_indikator_pbp');
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$bulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$tahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$bulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$tahunAkhir, 'isian_amatan.id_siswa'=>$id_siswa, 'pilar_pbp.id_pilar_pbp'=>$id_pilar_pbp_5));
		$data = $query->result();
		return $data;
	}

	public function dataAmatanPilar_6($id_siswa, $id_pilar_pbp_6, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir)
	{
		$this->db->select('tanggal, jam, isi_amatan, lokasi_amatan.nama_lokasi as nama_lokasi, guru.nama_guru as nama_guru');

    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('dimensi_pbp', 'dimensi_pbp.id_dimensi_pbp = indikator_amatan_pbp.id_dimensi_pbp', 'LEFT');
    $this->db->join('pilar_pbp', 'pilar_pbp.id_pilar_pbp = dimensi_pbp.id_pilar_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');

    $this->db->order_by('indikator_amatan_pbp.id_indikator_pbp', "ASC");
    // $this->db->group_by('indikator_amatan_pbp.id_indikator_pbp');
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$bulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$tahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$bulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$tahunAkhir, 'isian_amatan.id_siswa'=>$id_siswa, 'pilar_pbp.id_pilar_pbp'=>$id_pilar_pbp_6));
		$data = $query->result();
		return $data;
	}

	public function update_rapot($id)
	{
		$this->db->select('rapot_pbp.*, siswa.nipd as nipd, siswa.nama as nama, rombel.nama_rombel as rombel, pilar_pbp_1.pilar_pbp as pilar_1, pilar_pbp_2.pilar_pbp as pilar_2, pilar_pbp_3.pilar_pbp as pilar_3, pilar_pbp_4.pilar_pbp as pilar_4, pilar_pbp_5.pilar_pbp as pilar_5, pilar_pbp_6.pilar_pbp as pilar_6,');

		$this->db->join('pilar_pbp pilar_pbp_1', 'pilar_pbp_1.id_pilar_pbp = rapot_pbp.id_pilar_pbp_1', 'LEFT');
    $this->db->join('pilar_pbp pilar_pbp_2', 'pilar_pbp_2.id_pilar_pbp = rapot_pbp.id_pilar_pbp_2', 'LEFT');
    $this->db->join('pilar_pbp pilar_pbp_3', 'pilar_pbp_3.id_pilar_pbp = rapot_pbp.id_pilar_pbp_3', 'LEFT');
    $this->db->join('pilar_pbp pilar_pbp_4', 'pilar_pbp_4.id_pilar_pbp = rapot_pbp.id_pilar_pbp_4', 'LEFT');
    $this->db->join('pilar_pbp pilar_pbp_5', 'pilar_pbp_5.id_pilar_pbp = rapot_pbp.id_pilar_pbp_5', 'LEFT');
    $this->db->join('pilar_pbp pilar_pbp_6', 'pilar_pbp_6.id_pilar_pbp = rapot_pbp.id_pilar_pbp_6', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = rapot_pbp.id_siswa', 'LEFT');

    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
		$this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');


    // $this->db->order_by('indikator_amatan_pbp.id_indikator_pbp', "ASC");
    // $this->db->group_by('indikator_amatan_pbp.id_indikator_pbp');
	    
		$query = $this->db->get_where('rapot_pbp', array('id_rapot_pbp' => $id));
		$data = $query->row();
		return $data;
	}

}

/* End of file Model_rapot_pbp.php */
/* Location: ./application/models/Model_rapot_pbp.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_laporan_pengamatan_perilaku_siswa extends MY_Model {

	private $primary_key 	= 'id_laporan_pengamatan_perilaku_siswa';
	private $table_name 	= 'laporan_pengamatan_perilaku_siswa';
	private $field_search 	= ['laporan_pengamatan_perilaku_siswa'];

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
	                $where .= "laporan_pengamatan_perilaku_siswa.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "laporan_pengamatan_perilaku_siswa.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "laporan_pengamatan_perilaku_siswa.".$field . " LIKE '%" . $q . "%' )";
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
	                $where .= "laporan_pengamatan_perilaku_siswa.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "laporan_pengamatan_perilaku_siswa.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "laporan_pengamatan_perilaku_siswa.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('laporan_pengamatan_perilaku_siswa.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

	public function join_avaiable() {
		
    	return $this;
	}

	public function siswa($id_sekolah) {
		$sekolah="<option value=''>--pilih--</option>";

		$this->db->select('*');
		$this->db->from('siswa');
		$this->db->where('id_sekolah', $id_sekolah);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$sekolah.= "<option value='$data[id_siswa]'>$data[nipd] / $data[nama]</option>";
		}
		return $sekolah;
	}

	public function semua_rombel() {
		$rombel="<option value=''>--pilih--</option>";

		$this->db->select('*');
		$this->db->from('rombel');

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$rombel.= "<option value='$data[id_rombel]'>$data[nama_rombel]</option>";
		}
		return $rombel;
	}

	public function terpilih_rombel($id_sekolah) {
		$rombel="<option value=''>--pilih--</option>";

		$this->db->select('*');
		$this->db->from('rombel');
		$this->db->where('kode_sekolah', $id_sekolah);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$rombel.= "<option value='$data[id_rombel]'>$data[nama_rombel]</option>";
		}
		return $rombel;
	}

	public function wali_kelas($id_rombel) {

		$this->db->select('*');
		$this->db->from('rombel');
		$this->db->join('guru','guru.id_guru = rombel.wali_kelas');
		$this->db->where('id_rombel', $id_rombel);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$wali_kelas = "<option value='$data[id_guru]'>$data[nama_guru]</option>";
		}
		return $wali_kelas;
	}

	public function getWaliKelas($wali_kelas){
		$this->db->select('*');
		$this->db->from('guru');
		$this->db->where('id_guru', $wali_kelas);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$NameGuru = $data['nama_guru'];
		}
		return $NameGuru;
	}

  public function getIdSiswaWali($b){
		$this->db->select('*');
		$this->db->from('aauth_users');
		$this->db->where('username', $b);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$IdSiswaWali = $data['id_siswawali'];
		}
		return $IdSiswaWali;
	}

	public function getRombel($rombel){
		$this->db->select('*');
		$this->db->from('rombel');
		$this->db->where('id_rombel', $rombel);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$NameRombel = $data['nama_rombel'];
		}
		return $NameRombel;
	}

	public function getSemester($semester){
		$this->db->select('*');
		$this->db->from('semester');
		$this->db->join('periode','periode.id_periode = semester.id_periode');
		$this->db->where('id_semester', $semester);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$NamePeriode = $data['periode']." ".$data['semester'];
		}
		return $NamePeriode;
	}

	public function getBulanAwal($semester){
		$this->db->select('*');
		$this->db->from('semester');
		$this->db->join('bulan','bulan.id_bulan = semester.bulan_awal');
		$this->db->where('id_semester', $semester);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$BulanAwal = $data['angka'];
		}
		return $BulanAwal;
	}

	public function getTahunAwal($semester){
		$this->db->select('*');
		$this->db->from('semester');
		$this->db->where('id_semester', $semester);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$TahunAwal = $data['tahun_awal'];
		}
		return $TahunAwal;
	}

	public function getBulanAkhir($semester){
		$this->db->select('*');
		$this->db->from('semester');
		$this->db->join('bulan','bulan.id_bulan = semester.bulan_akhir');
		$this->db->where('id_semester', $semester);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$BulanAkhir = $data['angka'];
		}
		return $BulanAkhir;
	}

	public function getTahunAkhir($semester){
		$this->db->select('*');
		$this->db->from('semester');
		$this->db->where('id_semester', $semester);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$TahunAkhir = $data['tahun_akhir'];
		}
		return $TahunAkhir;
	}

  public function getWaliAmatanSemesterBulanAwal($bulanSekarang, $tahunSekarang){

		$query =  $this->db->query("SELECT *
                                FROM semester
                                JOIN bulan ON bulan.id_bulan = semester.bulan_awal
             										WHERE $bulanSekarang BETWEEN semester.bulan_awal AND semester.bulan_akhir AND $tahunSekarang BETWEEN semester.tahun_awal AND semester.tahun_akhir
             										");

		foreach ($query->result_array() as $data ){
			$BulanAwal = $data['angka'];
		}
		return $BulanAwal;
	}

	public function getWaliAmatanSemesterTahunAwal($bulanSekarang, $tahunSekarang){

		$query =  $this->db->query("SELECT *
                                FROM semester
                                -- JOIN bulan ON bulan.id_bulan = semester.bulan_awal
             										WHERE $bulanSekarang BETWEEN semester.bulan_awal AND semester.bulan_akhir AND $tahunSekarang BETWEEN semester.tahun_awal AND semester.tahun_akhir
             										");

		foreach ($query->result_array() as $data ){
			$TahunAwal = $data['tahun_awal'];
		}
		return $TahunAwal;
	}	

	public function getWaliAmatanSemesterBulanAkhir($bulanSekarang, $tahunSekarang){

		$query =  $this->db->query("SELECT *
                                FROM semester
                                JOIN bulan ON bulan.id_bulan = semester.bulan_akhir
             										WHERE $bulanSekarang BETWEEN semester.bulan_awal AND semester.bulan_akhir AND $tahunSekarang BETWEEN semester.tahun_awal AND semester.tahun_akhir
             										");

		foreach ($query->result_array() as $data ){
			$BulanAkhir = $data['angka'];
		}
		return $BulanAkhir;
	}	

	public function getWaliAmatanSemesterTahunAkhir($bulanSekarang, $tahunSekarang){

		$query =  $this->db->query("SELECT *
                                FROM semester
                                -- JOIN bulan ON bulan.id_bulan = semester.bulan_awal
             										WHERE $bulanSekarang BETWEEN semester.bulan_awal AND semester.bulan_akhir AND $tahunSekarang BETWEEN semester.tahun_awal AND semester.tahun_akhir
             										");

		foreach ($query->result_array() as $data ){
			$TahunAkhir = $data['tahun_akhir'];
		}
		return $TahunAkhir;
	}	

	public function getPPBP($ppbp){
		$this->db->select('*');
		$this->db->from('guru');
		$this->db->where('id_guru', $ppbp);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$NamePPBP = $data['nama_guru'];
		}
		return $NamePPBP;
	}

  // START query getDataMingguanAllAll - 1
	public function getDataMingguanAllAll($getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$getBulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$getBulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAkhir));
		$data = $query->result();
		return $data;
	}
	// END query getDataMingguanAllAll - 1

	// START query getDataMingguanNoMingguNoRombel - 1
	public function getDataMingguanNoMingguNoRombel($getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$getBulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$getBulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAkhir, 'isian_amatan.id_kodesekolah'=>$sekolah));
		$data = $query->result();
		return $data;
	}
	// END query getDataMingguanNoMingguNoRombel - 1

    // START query getDataMingguanAllNoRombel - 1
	public function getDataMingguanAllNoRombel($getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$getBulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$getBulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAkhir));
		$data = $query->result();
		return $data;
	}
	// END query getDataMingguanAllNoRombel - 1

	// START query getDataMingguanNoMinggu - 8
	public function getDataMingguanNoMinggu($getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $rombel){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$getBulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$getBulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAkhir, 'isian_amatan.id_kodesekolah'=>$sekolah, 'detail_rombel.id_rombel'=>$rombel));
		$data = $query->result();
		return $data;
	}

	public function getDataMingguanNoMinggu1($getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_siswa, $id_pengamat, $id_indikator_pbp, $rombel){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$getBulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$getBulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAkhir, 'isian_amatan.id_kodesekolah'=>$sekolah, 'isian_amatan.id_siswa'=> $id_siswa, 'isian_amatan.id_indikator_pbp'=>$id_indikator_pbp, 'isian_amatan.id_pengamat'=>$id_pengamat, 'detail_rombel.id_rombel'=>$rombel));
		$data = $query->result();
		return $data;
	}

	public function getDataMingguanNoMinggu2($getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_pengamat, $id_indikator_pbp, $rombel){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$getBulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$getBulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAkhir, 'isian_amatan.id_kodesekolah'=>$sekolah, 'isian_amatan.id_indikator_pbp'=>$id_indikator_pbp, 'isian_amatan.id_pengamat'=>$id_pengamat, 'detail_rombel.id_rombel'=>$rombel));
		$data = $query->result();
		return $data;
	}

	public function getDataMingguanNoMinggu3($getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_siswa, $id_indikator_pbp, $rombel){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$getBulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$getBulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAkhir, 'isian_amatan.id_kodesekolah'=>$sekolah, 'isian_amatan.id_siswa'=> $id_siswa, 'isian_amatan.id_indikator_pbp'=>$id_indikator_pbp, 'detail_rombel.id_rombel'=>$rombel));
		$data = $query->result();
		return $data;
	}

	public function getDataMingguanNoMinggu4($getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_siswa, $id_pengamat, $rombel){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$getBulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$getBulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAkhir, 'isian_amatan.id_kodesekolah'=>$sekolah, 'isian_amatan.id_siswa'=> $id_siswa, 'isian_amatan.id_pengamat'=>$id_pengamat, 'detail_rombel.id_rombel'=>$rombel));
		$data = $query->result();
		return $data;
	}

	public function getDataMingguanNoMinggu5($getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_pengamat, $rombel){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$getBulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$getBulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAkhir, 'isian_amatan.id_kodesekolah'=>$sekolah, 'isian_amatan.id_pengamat'=>$id_pengamat, 'detail_rombel.id_rombel'=>$rombel));
		$data = $query->result();
		return $data;
	}

	public function getDataMingguanNoMinggu6($getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_indikator_pbp, $rombel){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$getBulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$getBulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAkhir, 'isian_amatan.id_kodesekolah'=>$sekolah, 'isian_amatan.id_indikator_pbp'=>$id_indikator_pbp, 'detail_rombel.id_rombel'=>$rombel));
		$data = $query->result();
		return $data;
	}

	public function getDataMingguanNoMinggu7($getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_siswa, $rombel){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$getBulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$getBulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAkhir, 'isian_amatan.id_kodesekolah'=>$sekolah, 'isian_amatan.id_siswa'=> $id_siswa, 'detail_rombel.id_rombel'=>$rombel));
		$data = $query->result();
		return $data;
	}
	// END query getDataMingguanNoMinggu - 8

	// START query getDataMingguanAll - 3
	public function getDataMingguanAll($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $rombel){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$getBulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$getBulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAkhir, 'isian_amatan.minggu'=>$minggu, 'detail_rombel.id_rombel'=>$rombel));
		$data = $query->result();
		return $data;
	}

	public function getDataMingguanAll1($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $id_indikator_pbp, $id_pengamat, $rombel){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$getBulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$getBulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAkhir, 'isian_amatan.minggu'=>$minggu, 'isian_amatan.id_indikator_pbp'=>$id_indikator_pbp, 'isian_amatan.id_pengamat'=>$id_pengamat, 'detail_rombel.id_rombel'=>$rombel));
		$data = $query->result();
		return $data;
	}

	public function getDataMingguanAll2($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $id_indikator_pbp, $rombel){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$getBulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$getBulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAkhir, 'isian_amatan.minggu'=>$minggu, 'isian_amatan.id_indikator_pbp'=>$id_indikator_pbp, 'detail_rombel.id_rombel'=>$rombel));
		$data = $query->result();
		return $data;
	}

	public function getDataMingguanAll3($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $id_pengamat, $rombel){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$getBulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$getBulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAkhir, 'isian_amatan.minggu'=>$minggu, 'isian_amatan.id_pengamat'=>$id_pengamat, 'detail_rombel.id_rombel'=>$rombel));
		$data = $query->result();
		return $data;
	}
	// END query getDataMingguanAll - 3


	// START query getDataMingguanNoRombel - 1
	public function getDataMingguanNoRombel($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$getBulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$getBulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAkhir, 'isian_amatan.minggu'=>$minggu, 'isian_amatan.id_kodesekolah'=>$sekolah));
		$data = $query->result();
		return $data;
	}
	// END query getDataMingguanNoRombel - 1

	// START query getDataMingguan - 3
	public function getDataMingguan($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $rombel){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$getBulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$getBulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAkhir, 'isian_amatan.minggu'=>$minggu, 'isian_amatan.id_kodesekolah'=>$sekolah, 'detail_rombel.id_rombel'=>$rombel));
		$data = $query->result();
		return $data;
	}

	public function getDataMingguan1($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_siswa, $id_pengamat, $id_indikator_pbp, $rombel){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$getBulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$getBulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAkhir, 'isian_amatan.minggu'=>$minggu, 'isian_amatan.id_kodesekolah'=>$sekolah, 'isian_amatan.id_siswa'=> $id_siswa, 'isian_amatan.id_indikator_pbp'=>$id_indikator_pbp, 'isian_amatan.id_pengamat'=>$id_pengamat, 'detail_rombel.id_rombel'=>$rombel));
		$data = $query->result();
		return $data;
	}

	public function getDataMingguan2($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_pengamat, $id_indikator_pbp, $rombel){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$getBulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$getBulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAkhir, 'isian_amatan.minggu'=>$minggu, 'isian_amatan.id_kodesekolah'=>$sekolah, 'isian_amatan.id_indikator_pbp'=>$id_indikator_pbp, 'isian_amatan.id_pengamat'=>$id_pengamat, 'detail_rombel.id_rombel'=>$rombel));
		$data = $query->result();
		return $data;
	}

	public function getDataMingguan3($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_siswa, $id_indikator_pbp, $rombel){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$getBulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$getBulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAkhir, 'isian_amatan.minggu'=>$minggu, 'isian_amatan.id_kodesekolah'=>$sekolah, 'isian_amatan.id_siswa'=> $id_siswa, 'isian_amatan.id_indikator_pbp'=>$id_indikator_pbp, 'detail_rombel.id_rombel'=>$rombel));
		$data = $query->result();
		return $data;
	}

	public function getDataMingguan4($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_siswa, $id_pengamat, $rombel){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$getBulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$getBulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAkhir, 'isian_amatan.minggu'=>$minggu, 'isian_amatan.id_kodesekolah'=>$sekolah, 'isian_amatan.id_siswa'=> $id_siswa, 'isian_amatan.id_pengamat'=>$id_pengamat, 'detail_rombel.id_rombel'=>$rombel));
		$data = $query->result();
		return $data;
	}

	public function getDataMingguan5($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_pengamat, $rombel){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$getBulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$getBulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAkhir, 'isian_amatan.minggu'=>$minggu, 'isian_amatan.id_kodesekolah'=>$sekolah, 'isian_amatan.id_pengamat'=>$id_pengamat, 'detail_rombel.id_rombel'=>$rombel));
		$data = $query->result();
		return $data;
	}

	public function getDataMingguan6($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_indikator_pbp, $rombel){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$getBulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$getBulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAkhir, 'isian_amatan.minggu'=>$minggu, 'isian_amatan.id_kodesekolah'=>$sekolah, 'isian_amatan.id_indikator_pbp'=>$id_indikator_pbp, 'detail_rombel.id_rombel'=>$rombel));
		$data = $query->result();
		return $data;
	}

	public function getDataMingguan7($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_siswa, $rombel){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$getBulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$getBulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$getTahunAkhir, 'isian_amatan.minggu'=>$minggu, 'isian_amatan.id_kodesekolah'=>$sekolah, 'isian_amatan.id_siswa'=> $id_siswa, 'detail_rombel.id_rombel'=>$rombel));
		$data = $query->result();
		return $data;
	}
	// END query getDataMingguan - 7


	// STARST query getDataHariaAll - 4
	public function getDataHarianAllAll($tanggal_awal, $tanggal_akhir){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('isian_amatan.tanggal>='=>$tanggal_awal, 'isian_amatan.tanggal<='=>$tanggal_akhir));
		$data = $query->result();
		return $data;
	}

	public function getDataHarianAll($tanggal_awal, $tanggal_akhir, $rombel){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('isian_amatan.tanggal>='=>$tanggal_awal, 'isian_amatan.tanggal<='=>$tanggal_akhir, 'detail_rombel.id_rombel'=>$rombel));
		$data = $query->result();
		return $data;
	}

	public function getDataHarianAll1($tanggal_awal, $tanggal_akhir, $id_indikator_pbp, $id_pengamat, $rombel){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('isian_amatan.tanggal>='=>$tanggal_awal, 'isian_amatan.tanggal<='=>$tanggal_akhir, 'isian_amatan.id_indikator_pbp'=>$id_indikator_pbp, 'isian_amatan.id_pengamat'=>$id_pengamat, 'detail_rombel.id_rombel'=>$rombel));
		$data = $query->result();
		return $data;
	}

	public function getDataHarianAll2($tanggal_awal, $tanggal_akhir, $id_indikator_pbp, $rombel){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('isian_amatan.tanggal>='=>$tanggal_awal, 'isian_amatan.tanggal<='=>$tanggal_akhir, 'isian_amatan.id_indikator_pbp'=>$id_indikator_pbp, 'detail_rombel.id_rombel'=>$rombel));
		$data = $query->result();
		
		return $data;
	}

	public function getDataHarianAll3($tanggal_awal, $tanggal_akhir, $id_pengamat, $rombel){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('isian_amatan.tanggal>='=>$tanggal_awal, 'isian_amatan.tanggal<='=>$tanggal_akhir, 'isian_amatan.id_pengamat'=>$id_pengamat, 'detail_rombel.id_rombel'=>$rombel));
		$data = $query->result();
		return $data;
	}
	// END query getDataHariaAll - 3

	// START query getDataHarian - 7
	public function getDataHarian($tanggal_awal, $tanggal_akhir, $sekolah, $rombel){
		$this->db->select('isian_amatan.tanggal AS tanggal,  isian_amatan.jam AS jam, minggu_ke, rombel.nama_rombel AS kelas, nama, isi_amatan, status_amatan.status_amatan AS nama_status_amatan, nama_lokasi, guru.nama_guru AS nama_pengamat');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    // $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    // $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('isian_amatan.tanggal>='=>$tanggal_awal, 'isian_amatan.tanggal<='=>$tanggal_akhir, 'isian_amatan.id_kodesekolah'=>$sekolah, 'detail_rombel.id_rombel'=>$rombel));
		$data = $query->result();
		return $data;
	}

	public function getDataHarian1($tanggal_awal, $tanggal_akhir, $sekolah, $id_siswa, $id_pengamat, $id_indikator_pbp, $rombel){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('isian_amatan.tanggal>='=>$tanggal_awal, 'isian_amatan.tanggal<='=>$tanggal_akhir, 'isian_amatan.id_kodesekolah'=>$sekolah, 'isian_amatan.id_siswa'=> $id_siswa, 'isian_amatan.id_indikator_pbp'=>$id_indikator_pbp, 'isian_amatan.id_pengamat'=>$id_pengamat, 'detail_rombel.id_rombel'=>$rombel));
		$data = $query->result();
		return $data;
	}	

	public function getDataHarian2($tanggal_awal, $tanggal_akhir, $sekolah, $id_pengamat, $id_indikator_pbp, $rombel){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('isian_amatan.tanggal>='=>$tanggal_awal, 'isian_amatan.tanggal<='=>$tanggal_akhir, 'isian_amatan.id_kodesekolah'=>$sekolah, 'isian_amatan.id_indikator_pbp'=>$id_indikator_pbp, 'isian_amatan.id_pengamat'=>$id_pengamat, 'detail_rombel.id_rombel'=>$rombel));
		$data = $query->result();
		return $data;
	}

	public function getDataHarian3($tanggal_awal, $tanggal_akhir, $sekolah, $id_siswa, $id_indikator_pbp, $rombel){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('isian_amatan.tanggal>='=>$tanggal_awal, 'isian_amatan.tanggal<='=>$tanggal_akhir, 'isian_amatan.id_kodesekolah'=>$sekolah, 'isian_amatan.id_indikator_pbp'=>$id_indikator_pbp, 'isian_amatan.id_siswa'=> $id_siswa, 'detail_rombel.id_rombel'=>$rombel));
		$data = $query->result();
		return $data;
	}

	public function getDataHarian4($tanggal_awal, $tanggal_akhir, $sekolah, $id_siswa, $id_pengamat, $rombel){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('isian_amatan.tanggal>='=>$tanggal_awal, 'isian_amatan.tanggal<='=>$tanggal_akhir, 'isian_amatan.id_kodesekolah'=>$sekolah, 'isian_amatan.id_pengamat'=>$id_pengamat, 'isian_amatan.id_siswa'=> $id_siswa, 'detail_rombel.id_rombel'=>$rombel));
		$data = $query->result();
		return $data;
	}

	public function getDataHarian5($tanggal_awal, $tanggal_akhir, $sekolah, $id_pengamat, $rombel){
		$this->db->select('isian_amatan.tanggal AS tanggal,  isian_amatan.jam AS jam, minggu_ke, rombel.nama_rombel AS kelas, nama, isi_amatan, status_amatan.status_amatan AS nama_status_amatan, nama_lokasi, guru.nama_guru AS nama_pengamat');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    // $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    // $this->db->order_by('isian_amatan.tanggal', "ASC");
	    

		$query = $this->db->get_where('isian_amatan', array('isian_amatan.tanggal>='=>$tanggal_awal, 'isian_amatan.tanggal<='=>$tanggal_akhir, 'isian_amatan.id_kodesekolah'=>$sekolah, 'isian_amatan.id_pengamat'=>$id_pengamat, 'detail_rombel.id_rombel'=>$rombel));
		$data = $query->result();
		log_message("ERROR",$this->db->last_query());
		return $data;
	}

	public function getDataHarian6($tanggal_awal, $tanggal_akhir, $sekolah, $id_indikator_pbp, $rombel){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('isian_amatan.tanggal>='=>$tanggal_awal, 'isian_amatan.tanggal<='=>$tanggal_akhir, 'isian_amatan.id_kodesekolah'=>$sekolah, 'isian_amatan.id_indikator_pbp'=>$id_indikator_pbp, 'detail_rombel.id_rombel'=>$rombel));
		$data = $query->result();
		return $data;
	}

	public function getDataHarian7($tanggal_awal, $tanggal_akhir, $sekolah, $id_siswa, $rombel){
		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('isian_amatan.tanggal>='=>$tanggal_awal, 'isian_amatan.tanggal<='=>$tanggal_akhir, 'isian_amatan.id_kodesekolah'=>$sekolah, 'isian_amatan.id_siswa'=> $id_siswa, 'detail_rombel.id_rombel'=>$rombel));
		$data = $query->result();
		return $data;
	}
	// END query getDataHarian - 7

	// START query getDataHariIni - 1
  public function getJumlahDataHariIni($sub_b, $hariIni){

		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('siswa.id_siswa'=>$sub_b, 'isian_amatan.tanggal'=>$hariIni));
		$data = $query->num_rows();
		return $data;
	}
  
	public function getDataHariIni($sub_b, $hariIni){

		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('siswa.id_siswa'=>$sub_b, 'isian_amatan.tanggal'=>$hariIni));
		$data = $query->result();
		return $data;
	}
	// START query getDataHariIni - 1
	
	// START query getWaliAmatan - 3
	public function getWaliAmatanHariIni($id_siswa, $hariIni){

		$this->db->select('isian_amatan.tanggal as tanggal, jam, nama, isian_amatan.isi_amatan as isi_amatan, status_amatan.status_amatan as nama_status_amatan, nama_lokasi, guru.nama_guru as nama_pengamat');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('siswa.id_siswa'=>$id_siswa, 'isian_amatan.tanggal'=>$hariIni));
		$data = $query->result();
		return $data;
	}

	public function getWaliAmatanBulanSekarang($id_siswa, $bulanSekarang){

		$this->db->select('isian_amatan.tanggal as tanggal, jam, nama, isian_amatan.isi_amatan as isi_amatan, status_amatan.status_amatan as nama_status_amatan, nama_lokasi, guru.nama_guru as nama_pengamat');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('siswa.id_siswa'=>$id_siswa, 'MONTH(isian_amatan.tanggal)'=>$bulanSekarang));
		$data = $query->result();
		return $data;
	}

  public function getWaliAmatanSemesterSekarang($id_siswa, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir){

		$this->db->select('*, guru.nama_guru as nama_pengamat, minggu_ke, kode_sekolah.kode_sekolah, nama, kode_indikator, nama_lokasi, jenis_pengamat, status_amatan.status_amatan as nama_status_amatan, rombel.nama_rombel as kelas');

		$this->db->join('minggu_ke', 'minggu_ke.id_minggu_ke = isian_amatan.minggu', 'LEFT');
    $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = isian_amatan.id_kodesekolah', 'LEFT');
    $this->db->join('indikator_amatan_pbp', 'indikator_amatan_pbp.id_indikator_pbp = isian_amatan.id_indikator_pbp', 'LEFT');
    $this->db->join('lokasi_amatan', 'lokasi_amatan.id_lokasi_amatan = isian_amatan.id_lokasi_amatan', 'LEFT');
    $this->db->join('jenis_pengamat', 'jenis_pengamat.id_jenis_pengamat = isian_amatan.id_jenis_pengamat', 'LEFT');
    $this->db->join('guru', 'guru.id_guru = isian_amatan.id_pengamat', 'LEFT');
    $this->db->join('status_amatan', 'status_amatan.id_status_amatan = isian_amatan.id_status_amatan', 'LEFT');

    $this->db->join('siswa', 'siswa.id_siswa = isian_amatan.id_siswa', 'LEFT');
    $this->db->join('detail_rombel', 'detail_rombel.id_siswa = siswa.id_siswa', 'LEFT');
    $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
    $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');

    $this->db->order_by('isian_amatan.tanggal', "ASC");
	    
		$query = $this->db->get_where('isian_amatan', array('MONTH(isian_amatan.tanggal)>='=>$bulanAwal, 'YEAR(isian_amatan.tanggal)>='=>$tahunAwal, 'MONTH(isian_amatan.tanggal)<='=>$bulanAkhir, 'YEAR(isian_amatan.tanggal)>='=>$tahunAkhir, 'siswa.id_siswa'=>$id_siswa));
		$data = $query->result();
		return $data;
	}
	// END query getWaliAmatan - 3

	public function namaFilePdf($data, $table){
		$this->db->insert($table,$data);
	}

	public function fileName(){

		$this->db->select('id_laporan_pengamatan_perilaku_siswa')->from('laporan_pengamatan_perilaku_siswa')->where('jenis_laporan', 'mingguan');
     	$subQuery =  $this->db->get_compiled_select();

		$query = $this->db->select('laporan_pengamatan_perilaku_siswa')
	     ->from('laporan_pengamatan_perilaku_siswa')
	     ->where("id_laporan_pengamatan_perilaku_siswa IN ($subQuery)", NULL, FALSE)
	     ->get();

		foreach ($query->result_array() as $data ){
			$fileName = $data['laporan_pengamatan_perilaku_siswa'];
		}
		return $fileName;
	}

	public function fileNameHarian(){
		// $query = $this->db->query("SELECT MAX(laporan_pengamatan_perilaku_siswa) FROM `laporan_pengamatan_perilaku_siswa`WHERE jenis_laporan = 'mingguan'")->result_array();

		$this->db->select('id_laporan_pengamatan_perilaku_siswa')->from('laporan_pengamatan_perilaku_siswa')->where('jenis_laporan', 'harian');
     	$subQuery =  $this->db->get_compiled_select();

		$query = $this->db->select('laporan_pengamatan_perilaku_siswa')
	     ->from('laporan_pengamatan_perilaku_siswa')
	     ->where("id_laporan_pengamatan_perilaku_siswa IN ($subQuery)", NULL, FALSE)
	     ->get();

		foreach ($query->result_array() as $data ){
			$fileName = $data['laporan_pengamatan_perilaku_siswa'];
		}
		return $fileName;
	}

	public function fileNameExcel(){
		// $query = $this->db->query("SELECT MAX(laporan_pengamatan_perilaku_siswa) FROM `laporan_pengamatan_perilaku_siswa`WHERE jenis_laporan = 'mingguan'")->result_array();

    $this->db->select('id_laporan_pengamatan_perilaku_siswa')->from('laporan_pengamatan_perilaku_siswa')->where('jenis_laporan', 'mingguan_excel');
     	$subQuery =  $this->db->get_compiled_select();

		$query = $this->db->select('laporan_pengamatan_perilaku_siswa')
	     ->from('laporan_pengamatan_perilaku_siswa')
	     ->where("id_laporan_pengamatan_perilaku_siswa IN ($subQuery)", NULL, FALSE)
	     ->get();

		foreach ($query->result_array() as $data ){
			$fileName = $data['laporan_pengamatan_perilaku_siswa'];
		}
		return $fileName;

	}

	public function fileNameHarianExcel(){
		// $query = $this->db->query("SELECT MAX(laporan_pengamatan_perilaku_siswa) FROM `laporan_pengamatan_perilaku_siswa`WHERE jenis_laporan = 'mingguan'")->result_array();

		$this->db->select('id_laporan_pengamatan_perilaku_siswa')->from('laporan_pengamatan_perilaku_siswa')->where('jenis_laporan', 'harian_excel');
     	$subQuery =  $this->db->get_compiled_select();

		$query = $this->db->select('laporan_pengamatan_perilaku_siswa')
	     ->from('laporan_pengamatan_perilaku_siswa')
	     ->where("id_laporan_pengamatan_perilaku_siswa IN ($subQuery)", NULL, FALSE)
	     ->get();

		foreach ($query->result_array() as $data ){
			$fileName = $data['laporan_pengamatan_perilaku_siswa'];
		}
		return $fileName;
	}


}

/* End of file Model_laporan_pengamatan_perilaku_siswa.php */
/* Location: ./application/models/Model_laporan_pengamatan_perilaku_siswa.php */
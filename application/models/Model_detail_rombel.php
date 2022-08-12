<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_detail_rombel extends MY_Model
{

	private $primary_key 	= 'id_detail_rombel';
	private $table_name 	= 'detail_rombel';
	private $field_search 	= ['a', 'id_rombel', 'id_siswa'];

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
					$where .= "detail_rombel." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "detail_rombel." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "detail_rombel." . $field . " LIKE '%" . $q . "%' )";
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
					$where .= "detail_rombel." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "detail_rombel." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "detail_rombel." . $field . " LIKE '%" . $q . "%' )";
		}

		if (is_array($select_field) and count($select_field)) {
			$this->db->select($select_field);
		}

		$this->join_avaiable();
		$this->db->where($where);
		$this->db->limit($limit, $offset);
		$this->db->order_by('detail_rombel.' . $this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}
	public function get_rombel($id)
	{
		$query = $this->db->get_where('rombel', array('rombel.id_rombel' => $id));
		return $query->row();
	}
	public function get_detail_rombel($id)
	{
		$this->db->select('*');

		$this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'left');
		$this->db->join('periode', 'periode.id_periode = rombel.periode', 'left');
		$this->db->join('guru', 'guru.id_guru = rombel.wali_kelas', 'left');

		// $this->db->order_by('siswa.nipd', "ASC");

		$query = $this->db->get_where('detail_rombel', array('detail_rombel.id_rombel' => $id));
		$data = $query->row();
		return $data;
	}
	public function siswa_detail_rombel($id)
	{
		$this->db->select('siswa.*, detail_rombel.*, siswa.nipd as nipd, siswa.nama as nama_siswa');

		// $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
		$this->db->join('siswa', 'siswa.id_siswa = detail_rombel.id_siswa', 'LEFT');
		// $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');
		// $this->db->join('guru', 'guru.id_guru = rombel.wali_kelas', 'LEFT');

		$this->db->order_by('detail_rombel.id_detail_rombel', "ASC");

		$query = $this->db->get_where('detail_rombel', array('detail_rombel.id_rombel' => $id));
		$data = $query->result();
		return $data;
	}
	public function count_detail_rombel($id)
	{

		$this->db->where('id_rombel', $id);
		return $this->db->count_all_results('detail_rombel');
		// $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
		// $this->db->join('siswa', 'siswa.id_siswa = detail_rombel.id_siswa', 'LEFT');
		// $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');
		// $this->db->join('guru', 'guru.id_guru = rombel.wali_kelas', 'LEFT');

		// $this->db->order_by('siswa.nipd', "ASC");

		// $this->db->where('detail_rombel', array('detail_rombel.id_rombel' => $id));
		// // $data = $query->result();
		// return $this->db->count_all_results('detail_rombel');;
	}
	public function siswa($id_sekolah)
	{
		$sekolah = "<option value=''>--pilih--</option>";

		$this->db->select('*');
		$this->db->from('siswa');
		$this->db->where('id_sekolah', $id_sekolah);

		$query = $this->db->get();

		foreach ($query->result_array() as $data) {
			$sekolah .= "<option value='$data[id_siswa]'>$data[nipd] / $data[nama]</option>";
		}
		return $sekolah;
	}
	public function join_avaiable()
	{
		$this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
		$this->db->join('siswa', 'siswa.id_siswa = detail_rombel.id_siswa', 'LEFT');

		return $this;
	}

	public function save_siswa($save_data)
	{
		$this->db->insert('detail_rombel', $save_data);
	}

	public function insertDataToDB($data)
	{
		return $this->db->insert('detail_rombel', $data);
	}
	public function getLastEnrtyData()
	{
		$this->db->from('content');
		$last_id = $this->db->insert_id();
		$this->db->where('id', $last_id);

		return $this->db->get()->row();
	}

  public function get_id_kode_sekolah($data1){
		$this->db->select('*');
		$this->db->from('kode_sekolah');
		$this->db->where('kode_sekolah', $data1);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$id_kodesekolah = $data['id_kodesekolah'];
		}
		return $id_kodesekolah;
	}

  public function get_id_periode($data3){
		$this->db->select('*');
		$this->db->from('periode');
		$this->db->where('periode', $data3);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$id_periode = $data['id_periode'];
		}
		return $id_periode;
	}

  public function get_id_rombel($id_kode_sekolah, $data2, $id_periode){
		$this->db->select('*');
		$this->db->from('rombel');
		$this->db->where('kode_sekolah', $id_kode_sekolah);
    $this->db->where('nama_rombel', $data2);
    $this->db->where('periode', $id_periode);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$id_rombel = $data['id_rombel'];
		}
		return $id_rombel;
	}


  public function get_id_siswa($data4){
		$this->db->select('*');
		$this->db->from('siswa');
		$this->db->where('nipd', $data4);

		$query = $this->db->get();

		foreach ($query->result_array() as $data ){
			$id_siswa = $data['id_siswa'];
		}
		return $id_siswa;
	}

  // Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function insert_multiple($data){
		$this->db->insert_batch('detail_rombel', $data);
	}
}

/* End of file Model_detail_rombel.php */
/* Location: ./application/models/Model_detail_rombel.php */
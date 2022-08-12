<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_akd_jurnal_guru extends MY_Model
{

    private $primary_key     = 'id_jurnal';
    private $table_name     = 'akd_jurnal_guru';
    private $field_search     = ['kode_jadwal', 'hari', 'tanggal', 'jam_ke', 'materi', 'kompetensi_dasar', 'kegiatan', 'media_pembelajaran', 'sumber_belajar', 'keterangan', 'waktu_input'];

    public function __construct()
    {
        $config = array(
            'primary_key'     => $this->primary_key,
            'table_name'     => $this->table_name,
            'field_search'     => $this->field_search,
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
                    $where .= "akd_jurnal_guru." . $field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "akd_jurnal_guru." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "akd_jurnal_guru." . $field . " LIKE '%" . $q . "%' )";
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
                    $where .= "akd_jurnal_guru." . $field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "akd_jurnal_guru." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "akd_jurnal_guru." . $field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) and count($select_field)) {
            $this->db->select($select_field);
        }

        $this->join_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('akd_jurnal_guru.' . $this->primary_key, "DESC");
        $query = $this->db->get($this->table_name);

        return $query->result();
    }
    public function get_jadwal_rombel($id)
    {
        // var_dump($id);
        // die;
        // $this->join_avaiable();
        $this->db->select('*');

        $this->db->join('akd_mata_pelajaran', 'akd_mata_pelajaran.id_pelajaran=akd_jadwal_pelajaran.id_pelajaran', 'LEFT');
        $this->db->join('guru', 'guru.id_guru=akd_jadwal_pelajaran.guru_pengajar', 'LEFT');
        $this->db->join('rombel', 'rombel.id_rombel=akd_jadwal_pelajaran.rombel', 'LEFT');

        // $this->db->join('')
        // $query = $this->db->where('akd_jadwal_pelajaran.id_jadwal_pelajaran', $id);
        $query = $this->db->get_where('akd_jadwal_pelajaran', array('id_jadwal_pelajaran' => $id));
        $data = $query->row();
        return $data;
    }

    public function join_avaiable()
    {
        $this->db->join('akd_jadwal_pelajaran', 'akd_jadwal_pelajaran.id_jadwal_pelajaran = akd_jurnal_guru.kode_jadwal', 'LEFT');

        return $this;
    }
}

/* End of file Model_akd_jurnal_guru.php */
/* Location: ./application/models/Model_akd_jurnal_guru.php */
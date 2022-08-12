<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_akd_absensi_siswa extends MY_Model
{

    private $primary_key     = 'id_absensi_siswa';
    private $table_name     = 'akd_absensi_siswa';
    private $field_search     = ['id_jadwal_pelajaran', 'id_siswa', 'kode_kehadiran', 'tanggal', 'waktu_input'];

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
                    $where .= "akd_absensi_siswa." . $field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "akd_absensi_siswa." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "akd_absensi_siswa." . $field . " LIKE '%" . $q . "%' )";
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
                    $where .= "akd_absensi_siswa." . $field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "akd_absensi_siswa." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "akd_absensi_siswa." . $field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) and count($select_field)) {
            $this->db->select($select_field);
        }

        $this->join_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('akd_absensi_siswa.' . $this->primary_key, "DESC");
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
    public function get_siswa_rombel($id)
    {
        // $query = $this->db->query("SELECT * FROM akd_jadwal_pelajaran j
        //    left join j on j.rombel=r.id_rombel
        //    left join rombel r on r.id_rombel=d.id_detail_rombel
        //    left join detail_rombel d on d.id_siswa=siswa.id_siswa
        //     where j.id_jadwal_pelajaran='$id'
        //     order by d.id_detail_rombel asc");

        $this->db->select('*');

        // $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
        $this->db->join('rombel', 'rombel.id_rombel = akd_jadwal_pelajaran.rombel', 'LEFT');
        $this->db->join('detail_rombel', 'detail_rombel.id_rombel = rombel.id_rombel', 'LEFT');
        $this->db->join('siswa', 'siswa.id_siswa = detail_rombel.id_siswa', 'LEFT');
        // $query = $this->db->where('akd_jadwal_pelajaran.id_jadwal_pelajaran', $id);

        // $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');
        // $this->db->join('guru', 'guru.id_guru = rombel.wali_kelas', 'LEFT'); 
        $this->db->order_by('siswa.id_siswa', "ASC");
        $query = $this->db->get_where('akd_jadwal_pelajaran', array('akd_jadwal_pelajaran.id_jadwal_pelajaran' => $id));
        $data = $query->result();
        return $data;
    }

    public function join_avaiable()
    {
        $this->db->join('akd_jadwal_pelajaran', 'akd_jadwal_pelajaran.id_jadwal_pelajaran = akd_absensi_siswa.id_jadwal_pelajaran', 'LEFT');
        $this->db->join('akd_jadwal_pelajaran', 'akd_jadwal_pelajaran.id_pelajaran = akd_mata_pelajaran.id_pelajaran', 'LEFT');
        $this->db->join('siswa', 'siswa.id_siswa = akd_absensi_siswa.id_siswa', 'LEFT');

        return $this;
    }
    public function absensi_save($data)
    {
        $this->db->insert_batch('akd_absensi_siswa', $data);
    }
}

/* End of file Model_akd_absensi_siswa.php */
/* Location: ./application/models/Model_akd_absensi_siswa.php */
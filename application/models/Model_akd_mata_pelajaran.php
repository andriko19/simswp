<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_akd_mata_pelajaran extends MY_Model
{

    private $primary_key     = 'id_pelajaran';
    private $table_name     = 'akd_mata_pelajaran';
    private $field_search     = ['id_kelompok_mata_pelajaran', 'kode_jurusan', 'nama_mata_pelajaran', 'kompetensi_umum', 'kompetensi_khusus', 'jumlah_jam', 'kode_sekolah', 'aktif'];
    private $smk            = "3";
    private $sma            = "2";
    private $smp            = "1";

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
                    $where .= "akd_mata_pelajaran." . $field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "akd_mata_pelajaran." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "akd_mata_pelajaran." . $field . " LIKE '%" . $q . "%' )";
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
                    $where .= "akd_mata_pelajaran." . $field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "akd_mata_pelajaran." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "akd_mata_pelajaran." . $field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) and count($select_field)) {
            $this->db->select($select_field);
        }

        $this->join_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('akd_mata_pelajaran.' . $this->primary_key, "DESC");
        $query = $this->db->get($this->table_name);

        return $query->result();
    }
    //Filter SMK
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
                    $where .= "akd_mata_pelajaran." . $field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "akd_mata_pelajaran." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "akd_mata_pelajaran." . $field . " LIKE '%" . $q . "%' )";
        }
        $where .= "and akd_mata_pelajaran.kode_sekolah=" . $this->smk;
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
                    $where .= "akd_mata_pelajaran." . $field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "akd_mata_pelajaran." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "akd_mata_pelajaran." . $field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) and count($select_field)) {
            $this->db->select($select_field);
        }
        $where .= "and akd_mata_pelajaran.kode_sekolah=" . $this->smk;
        $this->join_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('akd_mata_pelajaran.' . $this->primary_key, "DESC");
        $query = $this->db->get($this->table_name);

        return $query->result();
    }
    //filter SMA
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
                    $where .= "akd_mata_pelajaran." . $field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "akd_mata_pelajaran." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "akd_mata_pelajaran." . $field . " LIKE '%" . $q . "%' )";
        }
        $where .= "and akd_mata_pelajaran.kode_sekolah=" . $this->sma;
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
                    $where .= "akd_mata_pelajaran." . $field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "akd_mata_pelajaran." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "akd_mata_pelajaran." . $field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) and count($select_field)) {
            $this->db->select($select_field);
        }
        $where .= "and akd_mata_pelajaran.kode_sekolah=" . $this->sma;
        $this->join_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('akd_mata_pelajaran.' . $this->primary_key, "DESC");
        $query = $this->db->get($this->table_name);

        return $query->result();
    }
    //filter SMP
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
                    $where .= "akd_mata_pelajaran." . $field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "akd_mata_pelajaran." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "akd_mata_pelajaran." . $field . " LIKE '%" . $q . "%' )";
        }
        $where .= "and akd_mata_pelajaran.kode_sekolah=" . $this->smp;
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
                    $where .= "akd_mata_pelajaran." . $field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "akd_mata_pelajaran." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "akd_mata_pelajaran." . $field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) and count($select_field)) {
            $this->db->select($select_field);
        }
        $where .= "and akd_mata_pelajaran.kode_sekolah=" . $this->smp;
        $this->join_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('akd_mata_pelajaran.' . $this->primary_key, "DESC");
        $query = $this->db->get($this->table_name);

        return $query->result();
    }

    public function join_avaiable()
    {
        $this->db->join('akd_kelompok_mata_pelajaran', 'akd_kelompok_mata_pelajaran.id_kelompok_mata_pelajaran = akd_mata_pelajaran.id_kelompok_mata_pelajaran', 'LEFT');
        $this->db->join('kode_jurusan', 'kode_jurusan.id_kodejurusan = akd_mata_pelajaran.kode_jurusan', 'LEFT');
        // $this->db->join('kelas', 'kelas.kode_kelas = akd_mata_pelajaran.tingkat', 'LEFT');
        $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = akd_mata_pelajaran.kode_sekolah', 'LEFT');
        $this->db->join('status_keaktifan', 'status_keaktifan.id_statuskeaktifan = akd_mata_pelajaran.aktif', 'LEFT');

        return $this;
    }
}

/* End of file Model_akd_mata_pelajaran.php */
/* Location: ./application/models/Model_akd_mata_pelajaran.php */
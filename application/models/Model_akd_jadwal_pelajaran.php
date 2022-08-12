<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_akd_jadwal_pelajaran extends MY_Model
{

    private $primary_key     = 'id_jadwal_pelajaran';
    private $table_name     = 'akd_jadwal_pelajaran';
    private $field_search     = ['tahun_ajaran', 'kode_jadwal', 'rombel', 'id_pelajaran', 'ruangan', 'guru_pengajar', 'paralel', 'jadwal_serial', 'jam_mulai', 'jam_akhir', 'hari', 'kode_sekolah', 'aktif'];
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
                    $where .= "akd_jadwal_pelajaran." . $field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "akd_jadwal_pelajaran." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "akd_jadwal_pelajaran." . $field . " LIKE '%" . $q . "%' )";
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
                    $where .= "akd_jadwal_pelajaran." . $field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "akd_jadwal_pelajaran." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "akd_jadwal_pelajaran." . $field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) and count($select_field)) {
            $this->db->select($select_field);
        }

        $this->join_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('akd_jadwal_pelajaran.' . $this->primary_key, "DESC");
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
                    $where .= "akd_jadwal_pelajaran." . $field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "akd_jadwal_pelajaran." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "akd_jadwal_pelajaran." . $field . " LIKE '%" . $q . "%' )";
        }
        $where .= "and akd_jadwal_pelajaran.kode_sekolah=" . $this->smk;
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
                    $where .= "akd_jadwal_pelajaran." . $field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "akd_jadwal_pelajaran." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "akd_jadwal_pelajaran." . $field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) and count($select_field)) {
            $this->db->select($select_field);
        }
        $where .= "and akd_jadwal_pelajaran.kode_sekolah=" . $this->smk;
        $this->join_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('akd_jadwal_pelajaran.' . $this->primary_key, "DESC");
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
                    $where .= "akd_jadwal_pelajaran." . $field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "akd_jadwal_pelajaran." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "akd_jadwal_pelajaran." . $field . " LIKE '%" . $q . "%' )";
        }
        $where .= "and akd_jadwal_pelajaran.kode_sekolah=" . $this->sma;
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
                    $where .= "akd_jadwal_pelajaran." . $field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "akd_jadwal_pelajaran." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "akd_jadwal_pelajaran." . $field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) and count($select_field)) {
            $this->db->select($select_field);
        }
        $where .= "and akd_jadwal_pelajaran.kode_sekolah=" . $this->sma;
        $this->join_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('akd_jadwal_pelajaran.' . $this->primary_key, "DESC");
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
                    $where .= "akd_jadwal_pelajaran." . $field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "akd_jadwal_pelajaran." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "akd_jadwal_pelajaran." . $field . " LIKE '%" . $q . "%' )";
        }
        $where .= "and akd_jadwal_pelajaran.kode_sekolah=" . $this->smp;
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
                    $where .= "akd_jadwal_pelajaran." . $field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "akd_jadwal_pelajaran." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "akd_jadwal_pelajaran." . $field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) and count($select_field)) {
            $this->db->select($select_field);
        }
        $where .= "and akd_jadwal_pelajaran.kode_sekolah=" . $this->smp;
        $this->join_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('akd_jadwal_pelajaran.' . $this->primary_key, "DESC");
        $query = $this->db->get($this->table_name);

        return $query->result();
    }
    public function get_rombel($id)
    {
        // $query = $this->db->query("SELECT * FROM akd_jadwal_pelajaran j
        //    left join j on j.rombel=r.id_rombel
        //    left join rombel r on r.id_rombel=d.id_detail_rombel
        //    left join detail_rombel d on d.id_siswa=siswa.id_siswa
        //     where j.id_jadwal_pelajaran='$id'
        //     order by d.id_detail_rombel asc");
        $this->db->select('rombel.*');
        // $this->db->join('rombel', 'rombel.id_rombel = detail_rombel.id_rombel', 'LEFT');
        $this->db->join('rombel', 'rombel.id_rombel = akd_jadwal_pelajaran.rombel', 'LEFT');
        // $this->db->join('detail_rombel', 'detail_rombel.id_rombel = rombel.id_rombel', 'LEFT');
        // $this->db->join('siswa', 'siswa.id_siswa = detail_rombel.id_siswa', 'LEFT');
        // $query = $this->db->where('akd_jadwal_pelajaran.id_jadwal_pelajaran', $id);
        // $this->db->join('periode', 'periode.id_periode = rombel.periode', 'LEFT');
        // $this->db->join('guru', 'guru.id_guru = rombel.wali_kelas', 'LEFT'); 
        $this->db->order_by('akd_jadwal_pelajaran.hari', "ASC");
        $query = $this->db->get_where('akd_jadwal_pelajaran', array('akd_jadwal_pelajaran.rombel' => $id));
        $data = $query->result();
        return $data;
    }
    public function get_index($id)
    {
        $iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        // $q = $this->scurity($q);
        // $field = $this->scurity($field);

        // if (empty($field)) {
        //     foreach ($this->field_search as $field) {
        //         if ($iterasi == 1) {
        //             $where .= "akd_jadwal_pelajaran." . $field . " LIKE '%" . $q . "%' ";
        //         } else {
        //             $where .= "OR " . "akd_jadwal_pelajaran." . $field . " LIKE '%" . $q . "%' ";
        //         }
        //         $iterasi++;
        //     }

        //     $where = '(' . $where . ')';
        // } else {
        //     $where .= "(" . "akd_jadwal_pelajaran." . $field . " LIKE '%" . $q . "%' )";
        // }

        // if (is_array($select_field) and count($select_field)) {
        //     $this->db->select($select_field);
        // }
        $where .= " akd_jadwal_pelajaran.rombel=" . $id;
        $this->join_avaiable();
        $this->db->where($where);
        // $this->db->limit($limit, $offset);
        $this->db->order_by('akd_jadwal_pelajaran.hari', "DESC");
        $query = $this->db->get($this->table_name);

        return $query->result();
    }

    public function join_avaiable()
    {
        $this->db->select('id_jadwal_pelajaran,periode.periode as periode,semester.semester as semester,kode_jadwal ,rombel.nama_rombel as nama_rombel, akd_mata_pelajaran.nama_mata_pelajaran as nama_mata_pelajaran, ruangan.nama_ruangan as nama_ruangan, guru.nama_guru as nama_guru,  awal.jam_ke as jam_mulai, akhir.jam_ke as jam_akhir, hari, kode_sekolah.kode_sekolah as kode_sekolah, status_keaktifan.status_keaktifan as status_keaktifan ');
        $this->db->join('semester', 'semester.id_semester = akd_jadwal_pelajaran.tahun_ajaran', 'LEFT');
        $this->db->join('periode', 'periode.id_periode = semester.id_periode', 'LEFT');
        $this->db->join('rombel', 'rombel.id_rombel = akd_jadwal_pelajaran.rombel', 'LEFT');
        $this->db->join('akd_mata_pelajaran', 'akd_mata_pelajaran.id_pelajaran = akd_jadwal_pelajaran.id_pelajaran', 'LEFT');
        $this->db->join('ruangan', 'ruangan.kode_ruangan = akd_jadwal_pelajaran.ruangan', 'LEFT');
        $this->db->join('guru', 'guru.id_guru = akd_jadwal_pelajaran.guru_pengajar', 'LEFT');
        $this->db->join('akd_jadwal_jam_ke awal', 'awal.id_jam_ke = akd_jadwal_pelajaran.jam_mulai', 'LEFT');
        $this->db->join('akd_jadwal_jam_ke akhir', 'akhir.id_jam_ke = akd_jadwal_pelajaran.jam_akhir', 'LEFT');
        $this->db->join('kode_sekolah', 'kode_sekolah.id_kodesekolah = akd_jadwal_pelajaran.kode_sekolah', 'LEFT');
        $this->db->join('status_keaktifan', 'status_keaktifan.id_statuskeaktifan = akd_jadwal_pelajaran.aktif', 'LEFT');

        return $this;
    }
}

/* End of file Model_akd_jadwal_pelajaran.php */
/* Location: ./application/models/Model_akd_jadwal_pelajaran.php */
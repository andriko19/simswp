<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_ruangan extends MY_Model
{

    private $primary_key     = 'kode_ruangan';
    private $table_name     = 'ruangan';
    private $field_search     = ['kode_gedung', 'nama_ruangan', 'kapasitas_belajar', 'kapasitas_ujian', 'keterangan', 'aktif'];
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
                    $where .= "ruangan." . $field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "ruangan." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "ruangan." . $field . " LIKE '%" . $q . "%' )";
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
                    $where .= "ruangan." . $field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "ruangan." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "ruangan." . $field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) and count($select_field)) {
            $this->db->select($select_field);
        }

        $this->join_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('ruangan.' . $this->primary_key, "DESC");
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
                    $where .= "ruangan." . $field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "ruangan." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "ruangan." . $field . " LIKE '%" . $q . "%' )";
        }
        $where .= "and ruangan.kode_sekolah=" . $this->smk;
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
                    $where .= "ruangan." . $field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "ruangan." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "ruangan." . $field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) and count($select_field)) {
            $this->db->select($select_field);
        }
        $where .= "and ruangan.kode_sekolah=" . $this->smk;
        $this->join_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('ruangan.' . $this->primary_key, "DESC");
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
                    $where .= "ruangan." . $field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "ruangan." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "ruangan." . $field . " LIKE '%" . $q . "%' )";
        }
        $where .= "and ruangan.kode_sekolah=" . $this->sma;
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
                    $where .= "ruangan." . $field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "ruangan." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "ruangan." . $field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) and count($select_field)) {
            $this->db->select($select_field);
        }
        $where .= "and ruangan.kode_sekolah=" . $this->sma;
        $this->join_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('ruangan.' . $this->primary_key, "DESC");
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
                    $where .= "ruangan." . $field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "ruangan." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "ruangan." . $field . " LIKE '%" . $q . "%' )";
        }
        $where .= "and ruangan.kode_sekolah=" . $this->smp;
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
                    $where .= "ruangan." . $field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "ruangan." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "ruangan." . $field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) and count($select_field)) {
            $this->db->select($select_field);
        }
        $where .= "and ruangan.kode_sekolah=" . $this->smp;
        $this->join_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('ruangan.' . $this->primary_key, "DESC");
        $query = $this->db->get($this->table_name);

        return $query->result();
    }

    public function join_avaiable()
    {
        $this->db->join('gedung', 'gedung.kode_gedung = ruangan.kode_gedung', 'LEFT');
        $this->db->join('status_keaktifan', 'status_keaktifan.id_statuskeaktifan = ruangan.aktif', 'LEFT');

        return $this;
    }
}

/* End of file Model_ruangan.php */
/* Location: ./application/models/Model_ruangan.php */
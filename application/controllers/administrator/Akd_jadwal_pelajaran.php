<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| Akd Jadwal Pelajaran Controller
 *| --------------------------------------------------------------------------
 *| Akd Jadwal Pelajaran site
 *|
 */
class Akd_jadwal_pelajaran extends Admin
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_akd_jadwal_pelajaran');
    }

    /**
     * show all Akd Jadwal Pelajarans
     *
     * @var $offset String
     */
    public function index($offset = 0)
    {
        $this->is_allowed('akd_jadwal_pelajaran_list');

        $filter = $this->input->get('q');
        $field     = $this->input->get('f');
        $a = $this->session->groups;
        if ($a == 1) {
            $this->data['akd_jadwal_pelajarans'] = $this->model_akd_jadwal_pelajaran->get($filter, $field, $this->limit_page, $offset);
            $this->data['akd_jadwal_pelajaran_counts'] = $this->model_akd_jadwal_pelajaran->count_all($filter, $field);

            $config = [
                'base_url'     => 'administrator/akd_jadwal_pelajaran/index/',
                'total_rows'   => $this->model_akd_jadwal_pelajaran->count_all($filter, $field),
                'per_page'     => $this->limit_page,
                'uri_segment'  => 4,
            ];
        } else if ($a == 16) {
            $this->data['akd_jadwal_pelajarans'] = $this->model_akd_jadwal_pelajaran->get2($filter, $field, $this->limit_page, $offset);
            $this->data['akd_jadwal_pelajaran_counts'] = $this->model_akd_jadwal_pelajaran->count_all2($filter, $field);

            $config = [
                'base_url'     => 'administrator/akd_jadwal_pelajaran/index/',
                'total_rows'   => $this->model_akd_jadwal_pelajaran->count_all2($filter, $field),
                'per_page'     => $this->limit_page,
                'uri_segment'  => 4,
            ];
        } else if ($a == 15) {
            $this->data['akd_jadwal_pelajarans'] = $this->model_akd_jadwal_pelajaran->get3($filter, $field, $this->limit_page, $offset);
            $this->data['akd_jadwal_pelajaran_counts'] = $this->model_akd_jadwal_pelajaran->count_all3($filter, $field);

            $config = [
                'base_url'     => 'administrator/akd_jadwal_pelajaran/index/',
                'total_rows'   => $this->model_akd_jadwal_pelajaran->count_all3($filter, $field),
                'per_page'     => $this->limit_page,
                'uri_segment'  => 4,
            ];
        } else if ($a == 14) {
            $this->data['akd_jadwal_pelajarans'] = $this->model_akd_jadwal_pelajaran->get4($filter, $field, $this->limit_page, $offset);
            $this->data['akd_jadwal_pelajaran_counts'] = $this->model_akd_jadwal_pelajaran->count_all4($filter, $field);

            $config = [
                'base_url'     => 'administrator/akd_jadwal_pelajaran/index/',
                'total_rows'   => $this->model_akd_jadwal_pelajaran->count_all4($filter, $field),
                'per_page'     => $this->limit_page,
                'uri_segment'  => 4,
            ];
        }
        $this->data['pagination'] = $this->pagination($config);

        $this->template->title('Akd Jadwal Pelajaran List');
        $this->render('backend/standart/administrator/akd_jadwal_pelajaran/akd_jadwal_pelajaran_list', $this->data);
    }

    /**
     * Add new akd_jadwal_pelajarans
     *
     */
    public function add()
    {
        $this->is_allowed('akd_jadwal_pelajaran_add');

        $this->template->title('Akd Jadwal Pelajaran New');
        $this->render('backend/standart/administrator/akd_jadwal_pelajaran/akd_jadwal_pelajaran_add', $this->data);
    }

    public function add_by($id)
    {
        $this->is_allowed('akd_jadwal_pelajaran_add');

        $this->data['akd_jadwal_pelajaran'] = $this->model_akd_jadwal_pelajaran->join_avaiable()->find($id);
        $this->data['akd_jadwal_pelajarans'] = $this->model_akd_jadwal_pelajaran->get_index($id);
        $this->template->title('Akd Jadwal Pelajaran Update');
        $this->render('backend/standart/administrator/akd_jadwal_pelajaran/akd_jadwal_pelajaran_add_by', $this->data);
    }

    /**
     * Add New Akd Jadwal Pelajarans
     *
     * @return JSON
     */
    public function add_save()
    {
        if (!$this->is_allowed('akd_jadwal_pelajaran_add', false)) {
            echo json_encode([
                'success' => false,
                'message' => cclang('sorry_you_do_not_have_permission_to_access')
            ]);
            exit;
        }

        $this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran/Semester', 'trim|required');
        $this->form_validation->set_rules('kode_jadwal', 'Kode Guru Pengajar', 'trim|required');
        $this->form_validation->set_rules('rombel', 'Rombongan Belajar', 'trim|required');
        $this->form_validation->set_rules('id_pelajaran', 'Mata Pelajaran', 'trim|required');
        $this->form_validation->set_rules('guru_pengajar', 'Guru Pengajar', 'trim|required');
        $this->form_validation->set_rules('start', 'Mulai Jam Ke', 'trim|required');
        $this->form_validation->set_rules('end', 'Berakhir Jam Ke', 'trim|required');
        $this->form_validation->set_rules('hari', 'Hari', 'trim|required');
        $this->form_validation->set_rules('kode_sekolah', 'Kode Sekolah', 'trim|required');
        $this->form_validation->set_rules('aktif', 'Aktif', 'trim|required');


        if ($this->form_validation->run()) {

            $save_data = [
                'tahun_ajaran' => $this->input->post('tahun_ajaran'),
                'kode_jadwal' => $this->input->post('kode_jadwal'),
                'rombel' => $this->input->post('rombel'),
                'id_pelajaran' => $this->input->post('id_pelajaran'),
                'ruangan' => $this->input->post('ruangan'),
                'guru_pengajar' => $this->input->post('guru_pengajar'),
                'paralel' => $this->input->post('paralel'),
                'jadwal_serial' => $this->input->post('jadwal_serial'),
                'jam_mulai' => $this->input->post('start'),
                'jam_akhir' => $this->input->post('end'),
                'hari' => $this->input->post('hari'),
                'kode_sekolah' => $this->input->post('kode_sekolah'),
                'aktif' => $this->input->post('aktif'),
            ];


            $save_akd_jadwal_pelajaran = $this->model_akd_jadwal_pelajaran->store($save_data);

            if ($save_akd_jadwal_pelajaran) {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = true;
                    $this->data['id']        = $save_akd_jadwal_pelajaran;
                    $this->data['message'] = cclang('success_save_data_stay', [
                        anchor('administrator/akd_jadwal_pelajaran/edit/' . $save_akd_jadwal_pelajaran, 'Edit Akd Jadwal Pelajaran'),
                        anchor('administrator/akd_jadwal_pelajaran', ' Go back to list')
                    ]);
                } else {
                    set_message(
                        cclang('success_save_data_redirect', [
                            anchor('administrator/akd_jadwal_pelajaran/edit/' . $save_akd_jadwal_pelajaran, 'Edit Akd Jadwal Pelajaran')
                        ]),
                        'success'
                    );

                    $this->data['success'] = true;
                    $this->data['redirect'] = base_url('administrator/akd_jadwal_pelajaran');
                }
            } else {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                } else {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                    $this->data['redirect'] = base_url('administrator/akd_jadwal_pelajaran');
                }
            }
        } else {
            $this->data['success'] = false;
            $this->data['message'] = validation_errors();
        }

        echo json_encode($this->data);
    }

    /**
     * Update view Akd Jadwal Pelajarans
     *
     * @var $id String
     */
    public function edit($id)
    {
        $this->is_allowed('akd_jadwal_pelajaran_update');

        $this->data['akd_jadwal_pelajaran'] = $this->model_akd_jadwal_pelajaran->find($id);

        $this->template->title('Akd Jadwal Pelajaran Update');
        $this->render('backend/standart/administrator/akd_jadwal_pelajaran/akd_jadwal_pelajaran_update', $this->data);
    }

    /**
     * Update Akd Jadwal Pelajarans
     *
     * @var $id String
     */
    public function edit_save($id)
    {
        if (!$this->is_allowed('akd_jadwal_pelajaran_update', false)) {
            echo json_encode([
                'success' => false,
                'message' => cclang('sorry_you_do_not_have_permission_to_access')
            ]);
            exit;
        }

        $this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran/Semester', 'trim|required');
        $this->form_validation->set_rules('kode_jadwal', 'Kode Guru Pengajar', 'trim|required');
        $this->form_validation->set_rules('rombel', 'Rombongan Belajar', 'trim|required');
        $this->form_validation->set_rules('id_pelajaran', 'Mata Pelajaran', 'trim|required');
        $this->form_validation->set_rules('guru_pengajar', 'Guru Pengajar', 'trim|required');
        $this->form_validation->set_rules('start', 'Mulai Jam Ke', 'trim|required');
        $this->form_validation->set_rules('end', 'Berakhir Jam Ke', 'trim|required');
        $this->form_validation->set_rules('hari', 'Hari', 'trim|required');
        $this->form_validation->set_rules('kode_sekolah', 'Kode Sekolah', 'trim|required');
        $this->form_validation->set_rules('aktif', 'Aktif', 'trim|required');

        if ($this->form_validation->run()) {

            $save_data = [
                'tahun_ajaran' => $this->input->post('tahun_ajaran'),
                'kode_jadwal' => $this->input->post('kode_jadwal'),
                'rombel' => $this->input->post('rombel'),
                'id_pelajaran' => $this->input->post('id_pelajaran'),
                'ruangan' => $this->input->post('ruangan'),
                'guru_pengajar' => $this->input->post('guru_pengajar'),
                'paralel' => $this->input->post('paralel'),
                'jadwal_serial' => $this->input->post('jadwal_serial'),
                'rentang_jam_pelajaran' => implode(',', (array) $this->input->post('rentang_jam_pelajaran')),
                'hari' => $this->input->post('hari'),
                'kode_sekolah' => $this->input->post('kode_sekolah'),
                'aktif' => $this->input->post('aktif'),
            ];


            $save_akd_jadwal_pelajaran = $this->model_akd_jadwal_pelajaran->change($id, $save_data);

            if ($save_akd_jadwal_pelajaran) {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = true;
                    $this->data['id']        = $id;
                    $this->data['message'] = cclang('success_update_data_stay', [
                        anchor('administrator/akd_jadwal_pelajaran', ' Go back to list')
                    ]);
                } else {
                    set_message(
                        cclang('success_update_data_redirect', []),
                        'success'
                    );

                    $this->data['success'] = true;
                    $this->data['redirect'] = base_url('administrator/akd_jadwal_pelajaran');
                }
            } else {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                } else {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                    $this->data['redirect'] = base_url('administrator/akd_jadwal_pelajaran');
                }
            }
        } else {
            $this->data['success'] = false;
            $this->data['message'] = validation_errors();
        }

        echo json_encode($this->data);
    }

    /**
     * delete Akd Jadwal Pelajarans
     *
     * @var $id String
     */
    public function delete($id)
    {
        $this->is_allowed('akd_jadwal_pelajaran_delete');

        $this->load->helper('file');

        $arr_id = $this->input->get('id');
        $remove = false;

        if (!empty($id)) {
            $remove = $this->_remove($id);
        } elseif (count($arr_id) > 0) {
            foreach ($arr_id as $id) {
                $remove = $this->_remove($id);
            }
        }

        if ($remove) {
            set_message(cclang('has_been_deleted', 'akd_jadwal_pelajaran'), 'success');
        } else {
            set_message(cclang('error_delete', 'akd_jadwal_pelajaran'), 'error');
        }

        redirect_back();
    }

    /**
     * View view Akd Jadwal Pelajarans
     *
     * @var $id String
     */
    public function view($id)
    {
        $this->is_allowed('akd_jadwal_pelajaran_view');
        $offset = 0;
        $filter = $this->input->get('q');
        $field     = $this->input->get('f');
        // $uri = $this->uri->segment(5);

        $this->data['akd_jadwal_pelajarans'] = $this->model_akd_jadwal_pelajaran->get_index($id);
        $this->data['akd_jadwal_pelajaran_counts'] = $this->model_akd_jadwal_pelajaran->count_all($filter, $field);
        $this->data['akd_jadwal_pelajaran'] = $this->model_akd_jadwal_pelajaran->join_avaiable()->find($id);
        $this->data['rombel'] = $this->model_akd_jadwal_pelajaran->get_rombel($id);
        $config = [
            'base_url'     => 'administrator/akd_jadwal_pelajaran/index/',
            'total_rows'   => $this->model_akd_jadwal_pelajaran->count_all($filter, $field),
            'per_page'     => $this->limit_page,
            'uri_segment'  => 4,
        ];
        $this->data['pagination'] = $this->pagination($config);

        $this->template->title('Akd Jadwal Pelajaran Detail');
        $this->render('backend/standart/administrator/akd_jadwal_pelajaran/akd_jadwal_pelajaran_view', $this->data);
    }

    /**
     * delete Akd Jadwal Pelajarans
     *
     * @var $id String
     */
    private function _remove($id)
    {
        $akd_jadwal_pelajaran = $this->model_akd_jadwal_pelajaran->find($id);



        return $this->model_akd_jadwal_pelajaran->remove($id);
    }


    /**
     * Export to excel
     *
     * @return Files Excel .xls
     */
    public function export()
    {
        $this->is_allowed('akd_jadwal_pelajaran_export');

        $this->model_akd_jadwal_pelajaran->export('akd_jadwal_pelajaran', 'akd_jadwal_pelajaran');
    }

    /**
     * Export to PDF
     *
     * @return Files PDF .pdf
     */
    public function export_pdf()
    {
        $this->is_allowed('akd_jadwal_pelajaran_export');

        $this->model_akd_jadwal_pelajaran->pdf('akd_jadwal_pelajaran', 'akd_jadwal_pelajaran');
    }
}


/* End of file akd_jadwal_pelajaran.php */
/* Location: ./application/controllers/administrator/Akd Jadwal Pelajaran.php */
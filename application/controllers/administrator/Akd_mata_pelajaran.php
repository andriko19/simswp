<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| Akd Mata Pelajaran Controller
 *| --------------------------------------------------------------------------
 *| Akd Mata Pelajaran site
 *|
 */
class Akd_mata_pelajaran extends Admin
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_akd_mata_pelajaran');
    }

    /**
     * show all Akd Mata Pelajarans
     *
     * @var $offset String
     */
    public function index($offset = 0)
    {
        $this->is_allowed('akd_mata_pelajaran_list');

        $filter = $this->input->get('q');
        $field     = $this->input->get('f');
        $a = $this->session->groups;

        if ($a == 1) {
            $this->data['akd_mata_pelajarans'] = $this->model_akd_mata_pelajaran->get($filter, $field, $this->limit_page, $offset);
            $this->data['akd_mata_pelajaran_counts'] = $this->model_akd_mata_pelajaran->count_all($filter, $field);

            $config = [
                'base_url'     => 'administrator/akd_mata_pelajaran/index/',
                'total_rows'   => $this->model_akd_mata_pelajaran->count_all($filter, $field),
                'per_page'     => $this->limit_page,
                'uri_segment'  => 4,
            ];
        }
        //Filter SMK
        else if ($a == 16) {
            $this->data['akd_mata_pelajarans'] = $this->model_akd_mata_pelajaran->get2($filter, $field, $this->limit_page, $offset);
            $this->data['akd_mata_pelajaran_counts'] = $this->model_akd_mata_pelajaran->count_all2($filter, $field);

            $config = [
                'base_url'     => 'administrator/akd_mata_pelajaran/index/',
                'total_rows'   => $this->model_akd_mata_pelajaran->count_all2($filter, $field),
                'per_page'     => $this->limit_page,
                'uri_segment'  => 4,
            ];
        }
        //filter SMA
        else if ($a == 15) {
            $this->data['akd_mata_pelajarans'] = $this->model_akd_mata_pelajaran->get3($filter, $field, $this->limit_page, $offset);
            $this->data['akd_mata_pelajaran_counts'] = $this->model_akd_mata_pelajaran->count_all3($filter, $field);

            $config = [
                'base_url'     => 'administrator/akd_mata_pelajaran/index/',
                'total_rows'   => $this->model_akd_mata_pelajaran->count_all3($filter, $field),
                'per_page'     => $this->limit_page,
                'uri_segment'  => 4,
            ];
        }
        //filter SMP
        else if ($a == 14) {
            $this->data['akd_mata_pelajarans'] = $this->model_akd_mata_pelajaran->get4($filter, $field, $this->limit_page, $offset);
            $this->data['akd_mata_pelajaran_counts'] = $this->model_akd_mata_pelajaran->count_all4($filter, $field);

            $config = [
                'base_url'     => 'administrator/akd_mata_pelajaran/index/',
                'total_rows'   => $this->model_akd_mata_pelajaran->count_all4($filter, $field),
                'per_page'     => $this->limit_page,
                'uri_segment'  => 4,
            ];
        }
        $this->data['pagination'] = $this->pagination($config);

        $this->template->title('Akd Mata Pelajaran List');
        $this->render('backend/standart/administrator/akd_mata_pelajaran/akd_mata_pelajaran_list', $this->data);
    }

    /**
     * Add new akd_mata_pelajarans
     *
     */
    public function add()
    {
        $this->is_allowed('akd_mata_pelajaran_add');

        $this->template->title('Akd Mata Pelajaran New');
        $this->render('backend/standart/administrator/akd_mata_pelajaran/akd_mata_pelajaran_add', $this->data);
    }

    /**
     * Add New Akd Mata Pelajarans
     *
     * @return JSON
     */
    public function add_save()
    {
        if (!$this->is_allowed('akd_mata_pelajaran_add', false)) {
            echo json_encode([
                'success' => false,
                'message' => cclang('sorry_you_do_not_have_permission_to_access')
            ]);
            exit;
        }

        $this->form_validation->set_rules('id_kelompok_mata_pelajaran', 'Kelompok Mata Pelajaran', 'trim|required');
        $this->form_validation->set_rules('kode_jurusan', 'Jurusan', 'trim|required');
        $this->form_validation->set_rules('nama_mata_pelajaran', 'Nama Mata Pelajaran', 'trim|required');
        // $this->form_validation->set_rules('tingkat', 'Tingkat/Kelas', 'trim|required');
        $this->form_validation->set_rules('jumlah_jam', 'Jumlah Jam', 'trim|required');
        $this->form_validation->set_rules('kode_sekolah', 'Kode Sekolah', 'trim|required');
        $this->form_validation->set_rules('aktif', 'Aktif', 'trim|required');


        if ($this->form_validation->run()) {

            $save_data = [
                'id_kelompok_mata_pelajaran' => $this->input->post('id_kelompok_mata_pelajaran'),
                'kode_jurusan' => $this->input->post('kode_jurusan'),
                'nama_mata_pelajaran' => $this->input->post('nama_mata_pelajaran'),
                // 'tingkat' => $this->input->post('tingkat'),
                'kompetensi_umum' => $this->input->post('kompetensi_umum'),
                'kompetensi_khusus' => $this->input->post('kompetensi_khusus'),
                'jumlah_jam' => $this->input->post('jumlah_jam'),
                'kode_sekolah' => $this->input->post('kode_sekolah'),
                // 'urutan' => $this->input->post('urutan'),
                'aktif' => $this->input->post('aktif'),
            ];


            $save_akd_mata_pelajaran = $this->model_akd_mata_pelajaran->store($save_data);

            if ($save_akd_mata_pelajaran) {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = true;
                    $this->data['id']        = $save_akd_mata_pelajaran;
                    $this->data['message'] = cclang('success_save_data_stay', [
                        anchor('administrator/akd_mata_pelajaran/edit/' . $save_akd_mata_pelajaran, 'Edit Akd Mata Pelajaran'),
                        anchor('administrator/akd_mata_pelajaran', ' Go back to list')
                    ]);
                } else {
                    set_message(
                        cclang('success_save_data_redirect', [
                            anchor('administrator/akd_mata_pelajaran/edit/' . $save_akd_mata_pelajaran, 'Edit Akd Mata Pelajaran')
                        ]),
                        'success'
                    );

                    $this->data['success'] = true;
                    $this->data['redirect'] = base_url('administrator/akd_mata_pelajaran');
                }
            } else {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                } else {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                    $this->data['redirect'] = base_url('administrator/akd_mata_pelajaran');
                }
            }
        } else {
            $this->data['success'] = false;
            $this->data['message'] = validation_errors();
        }

        echo json_encode($this->data);
    }

    /**
     * Update view Akd Mata Pelajarans
     *
     * @var $id String
     */
    public function edit($id)
    {
        $this->is_allowed('akd_mata_pelajaran_update');

        $this->data['akd_mata_pelajaran'] = $this->model_akd_mata_pelajaran->find($id);

        $this->template->title('Akd Mata Pelajaran Update');
        $this->render('backend/standart/administrator/akd_mata_pelajaran/akd_mata_pelajaran_update', $this->data);
    }

    /**
     * Update Akd Mata Pelajarans
     *
     * @var $id String
     */
    public function edit_save($id)
    {
        if (!$this->is_allowed('akd_mata_pelajaran_update', false)) {
            echo json_encode([
                'success' => false,
                'message' => cclang('sorry_you_do_not_have_permission_to_access')
            ]);
            exit;
        }

        $this->form_validation->set_rules('id_kelompok_mata_pelajaran', 'Kelompok Mata Pelajaran', 'trim|required');
        $this->form_validation->set_rules('kode_jurusan', 'Jurusan', 'trim|required');
        $this->form_validation->set_rules('nama_mata_pelajaran', 'Nama Mata Pelajaran', 'trim|required');
        // $this->form_validation->set_rules('tingkat', 'Tingkat/Kelas', 'trim|required');
        $this->form_validation->set_rules('jumlah_jam', 'Jumlah Jam', 'trim|required');
        $this->form_validation->set_rules('kode_sekolah', 'Kode Sekolah', 'trim|required');
        $this->form_validation->set_rules('aktif', 'Aktif', 'trim|required');

        if ($this->form_validation->run()) {

            $save_data = [
                'id_kelompok_mata_pelajaran' => $this->input->post('id_kelompok_mata_pelajaran'),
                'kode_jurusan' => $this->input->post('kode_jurusan'),
                'nama_mata_pelajaran' => $this->input->post('nama_mata_pelajaran'),
                // 'tingkat' => $this->input->post('tingkat'),
                'kompetensi_umum' => $this->input->post('kompetensi_umum'),
                'kompetensi_khusus' => $this->input->post('kompetensi_khusus'),
                'jumlah_jam' => $this->input->post('jumlah_jam'),
                'kode_sekolah' => $this->input->post('kode_sekolah'),
                // 'urutan' => $this->input->post('urutan'),
                'aktif' => $this->input->post('aktif'),
            ];


            $save_akd_mata_pelajaran = $this->model_akd_mata_pelajaran->change($id, $save_data);

            if ($save_akd_mata_pelajaran) {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = true;
                    $this->data['id']        = $id;
                    $this->data['message'] = cclang('success_update_data_stay', [
                        anchor('administrator/akd_mata_pelajaran', ' Go back to list')
                    ]);
                } else {
                    set_message(
                        cclang('success_update_data_redirect', []),
                        'success'
                    );

                    $this->data['success'] = true;
                    $this->data['redirect'] = base_url('administrator/akd_mata_pelajaran');
                }
            } else {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                } else {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                    $this->data['redirect'] = base_url('administrator/akd_mata_pelajaran');
                }
            }
        } else {
            $this->data['success'] = false;
            $this->data['message'] = validation_errors();
        }

        echo json_encode($this->data);
    }

    /**
     * delete Akd Mata Pelajarans
     *
     * @var $id String
     */
    public function delete($id)
    {
        $this->is_allowed('akd_mata_pelajaran_delete');

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
            set_message(cclang('has_been_deleted', 'akd_mata_pelajaran'), 'success');
        } else {
            set_message(cclang('error_delete', 'akd_mata_pelajaran'), 'error');
        }

        redirect_back();
    }

    /**
     * View view Akd Mata Pelajarans
     *
     * @var $id String
     */
    public function view($id)
    {
        $this->is_allowed('akd_mata_pelajaran_view');

        $this->data['akd_mata_pelajaran'] = $this->model_akd_mata_pelajaran->join_avaiable()->find($id);

        $this->template->title('Akd Mata Pelajaran Detail');
        $this->render('backend/standart/administrator/akd_mata_pelajaran/akd_mata_pelajaran_view', $this->data);
    }

    /**
     * delete Akd Mata Pelajarans
     *
     * @var $id String
     */
    private function _remove($id)
    {
        $akd_mata_pelajaran = $this->model_akd_mata_pelajaran->find($id);



        return $this->model_akd_mata_pelajaran->remove($id);
    }


    /**
     * Export to excel
     *
     * @return Files Excel .xls
     */
    public function export()
    {
        $this->is_allowed('akd_mata_pelajaran_export');

        $this->model_akd_mata_pelajaran->export('akd_mata_pelajaran', 'akd_mata_pelajaran');
    }

    /**
     * Export to PDF
     *
     * @return Files PDF .pdf
     */
    public function export_pdf()
    {
        $this->is_allowed('akd_mata_pelajaran_export');

        $this->model_akd_mata_pelajaran->pdf('akd_mata_pelajaran', 'akd_mata_pelajaran');
    }
}


/* End of file akd_mata_pelajaran.php */
/* Location: ./application/controllers/administrator/Akd Mata Pelajaran.php */
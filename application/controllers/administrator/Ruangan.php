<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| Ruangan Controller
 *| --------------------------------------------------------------------------
 *| Ruangan site
 *|
 */
class Ruangan extends Admin
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_ruangan');
    }

    /**
     * show all Ruangans
     *
     * @var $offset String
     */
    public function index($offset = 0)
    {
        $this->is_allowed('ruangan_list');

        $filter = $this->input->get('q');
        $field     = $this->input->get('f');
        $a = $this->session->groups;


        if ($a == 1) {
            $this->data['ruangans'] = $this->model_ruangan->get($filter, $field, $this->limit_page, $offset);
            $this->data['ruangan_counts'] = $this->model_ruangan->count_all($filter, $field);

            $config = [
                'base_url'     => 'administrator/ruangan/index/',
                'total_rows'   => $this->model_ruangan->count_all($filter, $field),
                'per_page'     => $this->limit_page,
                'uri_segment'  => 4,
            ];
        }
        if ($a == 16) {
            $this->data['ruangans'] = $this->model_ruangan->get2($filter, $field, $this->limit_page, $offset);
            $this->data['ruangan_counts'] = $this->model_ruangan->count_all2($filter, $field);

            $config = [
                'base_url'     => 'administrator/ruangan/index/',
                'total_rows'   => $this->model_ruangan->count_all2($filter, $field),
                'per_page'     => $this->limit_page,
                'uri_segment'  => 4,
            ];
        }
        if ($a == 15) {
            $this->data['ruangans'] = $this->model_ruangan->get3($filter, $field, $this->limit_page, $offset);
            $this->data['ruangan_counts'] = $this->model_ruangan->count_all3($filter, $field);

            $config = [
                'base_url'     => 'administrator/ruangan/index/',
                'total_rows'   => $this->model_ruangan->count_all3($filter, $field),
                'per_page'     => $this->limit_page,
                'uri_segment'  => 4,
            ];
        }
        if ($a == 14) {
            $this->data['ruangans'] = $this->model_ruangan->get4($filter, $field, $this->limit_page, $offset);
            $this->data['ruangan_counts'] = $this->model_ruangan->count_all4($filter, $field);

            $config = [
                'base_url'     => 'administrator/ruangan/index/',
                'total_rows'   => $this->model_ruangan->count_all4($filter, $field),
                'per_page'     => $this->limit_page,
                'uri_segment'  => 4,
            ];
        }
        $this->data['pagination'] = $this->pagination($config);

        $this->template->title('Ruangan List');
        $this->render('backend/standart/administrator/ruangan/ruangan_list', $this->data);
    }

    /**
     * Add new ruangans
     *
     */
    public function add()
    {
        $this->is_allowed('ruangan_add');

        $this->template->title('Ruangan New');
        $this->render('backend/standart/administrator/ruangan/ruangan_add', $this->data);
    }

    /**
     * Add New Ruangans
     *
     * @return JSON
     */
    public function add_save()
    {
        if (!$this->is_allowed('ruangan_add', false)) {
            echo json_encode([
                'success' => false,
                'message' => cclang('sorry_you_do_not_have_permission_to_access')
            ]);
            exit;
        }

        $this->form_validation->set_rules('kode_gedung', 'Kode Gedung', 'trim|required');
        $this->form_validation->set_rules('nama_ruangan', 'Nama Ruangan/Kelas', 'trim|required');
        $this->form_validation->set_rules('kapasitas_belajar', 'Kapasitas Belajar', 'trim|callback_valid_number');
        $this->form_validation->set_rules('kapasitas_ujian', 'Kapasitas Ujian', 'trim|callback_valid_number');
        $this->form_validation->set_rules('kode_sekolah', 'Sekolah', 'trim|required');
        $this->form_validation->set_rules('aktif', 'Aktif', 'trim|required');


        if ($this->form_validation->run()) {

            $save_data = [
                'kode_gedung' => $this->input->post('kode_gedung'),
                'nama_ruangan' => $this->input->post('nama_ruangan'),
                'kapasitas_belajar' => $this->input->post('kapasitas_belajar'),
                'kapasitas_ujian' => $this->input->post('kapasitas_ujian'),
                'keterangan' => $this->input->post('keterangan'),
                'kode_sekolah' => $this->input->post('kode_sekolah'),
                'aktif' => $this->input->post('aktif'),
            ];


            $save_ruangan = $this->model_ruangan->store($save_data);

            if ($save_ruangan) {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = true;
                    $this->data['id']        = $save_ruangan;
                    $this->data['message'] = cclang('success_save_data_stay', [
                        anchor('administrator/ruangan/edit/' . $save_ruangan, 'Edit Ruangan'),
                        anchor('administrator/ruangan', ' Go back to list')
                    ]);
                } else {
                    set_message(
                        cclang('success_save_data_redirect', [
                            anchor('administrator/ruangan/edit/' . $save_ruangan, 'Edit Ruangan')
                        ]),
                        'success'
                    );

                    $this->data['success'] = true;
                    $this->data['redirect'] = base_url('administrator/ruangan');
                }
            } else {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                } else {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                    $this->data['redirect'] = base_url('administrator/ruangan');
                }
            }
        } else {
            $this->data['success'] = false;
            $this->data['message'] = validation_errors();
        }

        echo json_encode($this->data);
    }

    /**
     * Update view Ruangans
     *
     * @var $id String
     */
    public function edit($id)
    {
        $this->is_allowed('ruangan_update');

        $this->data['ruangan'] = $this->model_ruangan->find($id);

        $this->template->title('Ruangan Update');
        $this->render('backend/standart/administrator/ruangan/ruangan_update', $this->data);
    }

    /**
     * Update Ruangans
     *
     * @var $id String
     */
    public function edit_save($id)
    {
        if (!$this->is_allowed('ruangan_update', false)) {
            echo json_encode([
                'success' => false,
                'message' => cclang('sorry_you_do_not_have_permission_to_access')
            ]);
            exit;
        }

        $this->form_validation->set_rules('kode_gedung', 'Kode Gedung', 'trim|required');
        $this->form_validation->set_rules('nama_ruangan', 'Nama Ruangan/Kelas', 'trim|required');
        $this->form_validation->set_rules('kapasitas_belajar', 'Kapasitas Belajar', 'trim|callback_valid_number');
        $this->form_validation->set_rules('kapasitas_ujian', 'Kapasitas Ujian', 'trim|callback_valid_number');
        $this->form_validation->set_rules('kode_sekolah', 'Sekolah', 'trim|required');
        $this->form_validation->set_rules('aktif', 'Aktif', 'trim|required');

        if ($this->form_validation->run()) {

            $save_data = [
                'kode_gedung' => $this->input->post('kode_gedung'),
                'nama_ruangan' => $this->input->post('nama_ruangan'),
                'kapasitas_belajar' => $this->input->post('kapasitas_belajar'),
                'kapasitas_ujian' => $this->input->post('kapasitas_ujian'),
                'keterangan' => $this->input->post('keterangan'),
                'kode_sekolah' => $this->input->post('kode_sekolah'),
                'aktif' => $this->input->post('aktif'),
            ];


            $save_ruangan = $this->model_ruangan->change($id, $save_data);

            if ($save_ruangan) {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = true;
                    $this->data['id']        = $id;
                    $this->data['message'] = cclang('success_update_data_stay', [
                        anchor('administrator/ruangan', ' Go back to list')
                    ]);
                } else {
                    set_message(
                        cclang('success_update_data_redirect', []),
                        'success'
                    );

                    $this->data['success'] = true;
                    $this->data['redirect'] = base_url('administrator/ruangan');
                }
            } else {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                } else {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                    $this->data['redirect'] = base_url('administrator/ruangan');
                }
            }
        } else {
            $this->data['success'] = false;
            $this->data['message'] = validation_errors();
        }

        echo json_encode($this->data);
    }

    /**
     * delete Ruangans
     *
     * @var $id String
     */
    public function delete($id)
    {
        $this->is_allowed('ruangan_delete');

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
            set_message(cclang('has_been_deleted', 'ruangan'), 'success');
        } else {
            set_message(cclang('error_delete', 'ruangan'), 'error');
        }

        redirect_back();
    }

    /**
     * View view Ruangans
     *
     * @var $id String
     */
    public function view($id)
    {
        $this->is_allowed('ruangan_view');

        $this->data['ruangan'] = $this->model_ruangan->join_avaiable()->find($id);

        $this->template->title('Ruangan Detail');
        $this->render('backend/standart/administrator/ruangan/ruangan_view', $this->data);
    }

    /**
     * delete Ruangans
     *
     * @var $id String
     */
    private function _remove($id)
    {
        $ruangan = $this->model_ruangan->find($id);



        return $this->model_ruangan->remove($id);
    }


    /**
     * Export to excel
     *
     * @return Files Excel .xls
     */
    public function export()
    {
        $this->is_allowed('ruangan_export');

        $this->model_ruangan->export('ruangan', 'ruangan');
    }

    /**
     * Export to PDF
     *
     * @return Files PDF .pdf
     */
    public function export_pdf()
    {
        $this->is_allowed('ruangan_export');

        $this->model_ruangan->pdf('ruangan', 'ruangan');
    }
}


/* End of file ruangan.php */
/* Location: ./application/controllers/administrator/Ruangan.php */
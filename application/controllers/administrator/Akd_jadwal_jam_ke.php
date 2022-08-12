<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| Akd Jadwal Jam Ke Controller
 *| --------------------------------------------------------------------------
 *| Akd Jadwal Jam Ke site
 *|
 */
class Akd_jadwal_jam_ke extends Admin
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_akd_jadwal_jam_ke');
    }

    /**
     * show all Akd Jadwal Jam Kes
     *
     * @var $offset String
     */
    public function index($offset = 0)
    {
        $this->is_allowed('akd_jadwal_jam_ke_list');

        $filter = $this->input->get('q');
        $field     = $this->input->get('f');
        $a = $this->session->groups;
        if ($a == 1) {
            $this->data['akd_jadwal_jam_kes'] = $this->model_akd_jadwal_jam_ke->get($filter, $field, $this->limit_page, $offset);
            $this->data['akd_jadwal_jam_ke_counts'] = $this->model_akd_jadwal_jam_ke->count_all($filter, $field);

            $config = [
                'base_url'     => 'administrator/akd_jadwal_jam_ke/index/',
                'total_rows'   => $this->model_akd_jadwal_jam_ke->count_all($filter, $field),
                'per_page'     => $this->limit_page,
                'uri_segment'  => 4,
            ];
        }
        //Filter SMK
        if ($a == 16) {
            $this->data['akd_jadwal_jam_kes'] = $this->model_akd_jadwal_jam_ke->get2($filter, $field, $this->limit_page, $offset);
            $this->data['akd_jadwal_jam_ke_counts'] = $this->model_akd_jadwal_jam_ke->count_all2($filter, $field);

            $config = [
                'base_url'     => 'administrator/akd_jadwal_jam_ke/index/',
                'total_rows'   => $this->model_akd_jadwal_jam_ke->count_all($filter, $field),
                'per_page'     => $this->limit_page,
                'uri_segment'  => 4,
            ];
        }
        //Filtter SMA
        if ($a == 15) {
            $this->data['akd_jadwal_jam_kes'] = $this->model_akd_jadwal_jam_ke->get3($filter, $field, $this->limit_page, $offset);
            $this->data['akd_jadwal_jam_ke_counts'] = $this->model_akd_jadwal_jam_ke->count_all3($filter, $field);

            $config = [
                'base_url'     => 'administrator/akd_jadwal_jam_ke/index/',
                'total_rows'   => $this->model_akd_jadwal_jam_ke->count_all($filter, $field),
                'per_page'     => $this->limit_page,
                'uri_segment'  => 4,
            ];
        }
        //Filter SMP
        if ($a == 14) {
            $this->data['akd_jadwal_jam_kes'] = $this->model_akd_jadwal_jam_ke->get4($filter, $field, $this->limit_page, $offset);
            $this->data['akd_jadwal_jam_ke_counts'] = $this->model_akd_jadwal_jam_ke->count_all4($filter, $field);

            $config = [
                'base_url'     => 'administrator/akd_jadwal_jam_ke/index/',
                'total_rows'   => $this->model_akd_jadwal_jam_ke->count_all($filter, $field),
                'per_page'     => $this->limit_page,
                'uri_segment'  => 4,
            ];
        }
        $this->data['pagination'] = $this->pagination($config);

        $this->template->title('Akd Jadwal Jam Ke List');
        $this->render('backend/standart/administrator/akd_jadwal_jam_ke/akd_jadwal_jam_ke_list', $this->data);
    }

    /**
     * Add new akd_jadwal_jam_kes
     *
     */
    public function add()
    {
        $this->is_allowed('akd_jadwal_jam_ke_add');

        $this->template->title('Akd Jadwal Jam Ke New');
        $this->render('backend/standart/administrator/akd_jadwal_jam_ke/akd_jadwal_jam_ke_add', $this->data);
    }

    /**
     * Add New Akd Jadwal Jam Kes
     *
     * @return JSON
     */
    public function add_save()
    {
        if (!$this->is_allowed('akd_jadwal_jam_ke_add', false)) {
            echo json_encode([
                'success' => false,
                'message' => cclang('sorry_you_do_not_have_permission_to_access')
            ]);
            exit;
        }

        $this->form_validation->set_rules('kode_sekolah', 'Kode Sekolah', 'trim|required');
        $this->form_validation->set_rules('jam_ke', 'Jam Ke', 'trim|required');
        $this->form_validation->set_rules('jam_mulai', 'Jam Mulai', 'trim|required');
        $this->form_validation->set_rules('jam_selesai', 'Jam Selesai', 'trim|required');


        if ($this->form_validation->run()) {

            $save_data = [
                'kode_sekolah' => $this->input->post('kode_sekolah'),
                'jam_ke' => $this->input->post('jam_ke'),
                'jam_mulai' => $this->input->post('jam_mulai'),
                'jam_selesai' => $this->input->post('jam_selesai'),
            ];


            $save_akd_jadwal_jam_ke = $this->model_akd_jadwal_jam_ke->store($save_data);

            if ($save_akd_jadwal_jam_ke) {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = true;
                    $this->data['id']        = $save_akd_jadwal_jam_ke;
                    $this->data['message'] = cclang('success_save_data_stay', [
                        anchor('administrator/akd_jadwal_jam_ke/edit/' . $save_akd_jadwal_jam_ke, 'Edit Akd Jadwal Jam Ke'),
                        anchor('administrator/akd_jadwal_jam_ke', ' Go back to list')
                    ]);
                } else {
                    set_message(
                        cclang('success_save_data_redirect', [
                            anchor('administrator/akd_jadwal_jam_ke/edit/' . $save_akd_jadwal_jam_ke, 'Edit Akd Jadwal Jam Ke')
                        ]),
                        'success'
                    );

                    $this->data['success'] = true;
                    $this->data['redirect'] = base_url('administrator/akd_jadwal_jam_ke');
                }
            } else {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                } else {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                    $this->data['redirect'] = base_url('administrator/akd_jadwal_jam_ke');
                }
            }
        } else {
            $this->data['success'] = false;
            $this->data['message'] = validation_errors();
        }

        echo json_encode($this->data);
    }

    /**
     * Update view Akd Jadwal Jam Kes
     *
     * @var $id String
     */
    public function edit($id)
    {
        $this->is_allowed('akd_jadwal_jam_ke_update');

        $this->data['akd_jadwal_jam_ke'] = $this->model_akd_jadwal_jam_ke->find($id);

        $this->template->title('Akd Jadwal Jam Ke Update');
        $this->render('backend/standart/administrator/akd_jadwal_jam_ke/akd_jadwal_jam_ke_update', $this->data);
    }

    /**
     * Update Akd Jadwal Jam Kes
     *
     * @var $id String
     */
    public function edit_save($id)
    {
        if (!$this->is_allowed('akd_jadwal_jam_ke_update', false)) {
            echo json_encode([
                'success' => false,
                'message' => cclang('sorry_you_do_not_have_permission_to_access')
            ]);
            exit;
        }

        $this->form_validation->set_rules('kode_sekolah', 'Kode Sekolah', 'trim|required');
        $this->form_validation->set_rules('jam_ke', 'Jam Ke', 'trim|required');
        $this->form_validation->set_rules('jam_mulai', 'Jam Mulai', 'trim|required');
        $this->form_validation->set_rules('jam_selesai', 'Jam Selesai', 'trim|required');

        if ($this->form_validation->run()) {

            $save_data = [
                'kode_sekolah' => $this->input->post('kode_sekolah'),
                'jam_ke' => $this->input->post('jam_ke'),
                'jam_mulai' => $this->input->post('jam_mulai'),
                'jam_selesai' => $this->input->post('jam_selesai'),
            ];


            $save_akd_jadwal_jam_ke = $this->model_akd_jadwal_jam_ke->change($id, $save_data);

            if ($save_akd_jadwal_jam_ke) {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = true;
                    $this->data['id']        = $id;
                    $this->data['message'] = cclang('success_update_data_stay', [
                        anchor('administrator/akd_jadwal_jam_ke', ' Go back to list')
                    ]);
                } else {
                    set_message(
                        cclang('success_update_data_redirect', []),
                        'success'
                    );

                    $this->data['success'] = true;
                    $this->data['redirect'] = base_url('administrator/akd_jadwal_jam_ke');
                }
            } else {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                } else {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                    $this->data['redirect'] = base_url('administrator/akd_jadwal_jam_ke');
                }
            }
        } else {
            $this->data['success'] = false;
            $this->data['message'] = validation_errors();
        }

        echo json_encode($this->data);
    }

    /**
     * delete Akd Jadwal Jam Kes
     *
     * @var $id String
     */
    public function delete($id)
    {
        $this->is_allowed('akd_jadwal_jam_ke_delete');

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
            set_message(cclang('has_been_deleted', 'akd_jadwal_jam_ke'), 'success');
        } else {
            set_message(cclang('error_delete', 'akd_jadwal_jam_ke'), 'error');
        }

        redirect_back();
    }

    /**
     * View view Akd Jadwal Jam Kes
     *
     * @var $id String
     */
    public function view($id)
    {
        $this->is_allowed('akd_jadwal_jam_ke_view');

        $this->data['akd_jadwal_jam_ke'] = $this->model_akd_jadwal_jam_ke->join_avaiable()->find($id);

        $this->template->title('Akd Jadwal Jam Ke Detail');
        $this->render('backend/standart/administrator/akd_jadwal_jam_ke/akd_jadwal_jam_ke_view', $this->data);
    }

    /**
     * delete Akd Jadwal Jam Kes
     *
     * @var $id String
     */
    private function _remove($id)
    {
        $akd_jadwal_jam_ke = $this->model_akd_jadwal_jam_ke->find($id);



        return $this->model_akd_jadwal_jam_ke->remove($id);
    }


    /**
     * Export to excel
     *
     * @return Files Excel .xls
     */
    public function export()
    {
        $this->is_allowed('akd_jadwal_jam_ke_export');

        $this->model_akd_jadwal_jam_ke->export('akd_jadwal_jam_ke', 'akd_jadwal_jam_ke');
    }

    /**
     * Export to PDF
     *
     * @return Files PDF .pdf
     */
    public function export_pdf()
    {
        $this->is_allowed('akd_jadwal_jam_ke_export');

        $this->model_akd_jadwal_jam_ke->pdf('akd_jadwal_jam_ke', 'akd_jadwal_jam_ke');
    }
}


/* End of file akd_jadwal_jam_ke.php */
/* Location: ./application/controllers/administrator/Akd Jadwal Jam Ke.php */
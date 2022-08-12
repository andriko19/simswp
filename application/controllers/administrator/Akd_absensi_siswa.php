<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| Akd Absensi Siswa Controller
 *| --------------------------------------------------------------------------
 *| Akd Absensi Siswa site
 *|
 */
class Akd_absensi_siswa extends Admin
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_akd_absensi_siswa');
    }

    /**
     * show all Akd Absensi Siswas
     *
     * @var $offset String
     */
    public function index($offset = 0)
    {
        $this->is_allowed('akd_absensi_siswa_list');

        $filter = $this->input->get('q');
        $field     = $this->input->get('f');

        $this->data['akd_absensi_siswas'] = $this->model_akd_absensi_siswa->get($filter, $field, $this->limit_page, $offset);
        $this->data['akd_absensi_siswa_counts'] = $this->model_akd_absensi_siswa->count_all($filter, $field);

        $config = [
            'base_url'     => 'administrator/akd_absensi_siswa/index/',
            'total_rows'   => $this->model_akd_absensi_siswa->count_all($filter, $field),
            'per_page'     => $this->limit_page,
            'uri_segment'  => 4,
        ];

        $this->data['pagination'] = $this->pagination($config);

        $this->template->title('Akd Absensi Siswa List');
        $this->render('backend/standart/administrator/akd_absensi_siswa/akd_absensi_siswa_list', $this->data);
    }

    /**
     * Add new akd_absensi_siswas
     *
     */
    public function add($id)
    {
        $this->is_allowed('akd_absensi_siswa_add');

        $this->data['akd_absensi_siswa'] = $this->model_akd_absensi_siswa->get_siswa_rombel($id);
        $this->data['akd_jadwal_rombel'] = $this->model_akd_absensi_siswa->get_jadwal_rombel($id);
        // $this->data['rombel'] = $this->model_akd_absensi_siswa->get_rombel($id);
        // $this->data['siswa_rombel'] = $this->model_akd_absensi_siswa->siswa_detail_rombel($id);
        // $this->data['count_siswa_rombel'] = $this->model_akd_absensi_siswa->count_detail_rombel($id);

        $this->template->title('Akd Absensi Siswa New');
        $this->render('backend/standart/administrator/akd_absensi_siswa/akd_absensi_siswa_add', $this->data);
    }

    /**
     * Add New Akd Absensi Siswas
     *
     * @return JSON
     */
    public function add_save()
    {
        if (!$this->is_allowed('akd_absensi_siswa_add', false)) {
            echo json_encode([
                'success' => false,
                'message' => cclang('sorry_you_do_not_have_permission_to_access')
            ]);
            exit;
        }

        $this->form_validation->set_rules('id_jadwal_pelajaran', 'Id Jadwal Pelajaran');
        $this->form_validation->set_rules('id_siswa', 'Id Siswa');
        $this->form_validation->set_rules('kode_kehadiran', 'Kode Kehadiran', 'trim|required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');


        if ($this->form_validation->run()) {
            $result = array();
            foreach ($_POST['id_jadwal_pelajaran'] as $key => $val) {
                $result[] = array(
                    'id_jadwal_pelajaran' => $_POST['id_jadwal_pelajaran'][$key],
                    'id_siswa' => $_POST['id_siswa'][$key],
                    'kode_kehadiran' => $_POST['kehadiran'][$key],
                    'tanggal' => $_POST['tanggal'][$key],
                    'keterangan' => $_POST['keterangan'][$key],
                    'waktu_input' => $_POST['waktu_input'][$key]
                );
                $this->db->insert('akd_absensi_siswa', $result[$key]);
            }
            // $save_data = [
            //     'id_jadwal_pelajaran' => $this->input->post('id_jadwal_pelajaran[]'),
            //     'id_siswa' => $this->input->post('id_siswa[]'),
            //     'tanggal' => $this->input->post('tanggal[]'),
            //     'kehadiran' => $this->input->post('kehadiran[]'),
            //     'keterangan' => $this->input->post('keterangan[]'),
            //     'waktu_input' => date('Y-m-d H:i:s'),
            // ];

            // $save_akd_absensi_siswa = $this->model_akd_absensi_siswa->store($save_data);
            // $save_akd_absensi_siswa = $this->model_akd_absensi_siswa->absensi_save($result);

            // if ($save_akd_absensi_siswa) {
            //     if ($this->input->post('save_type') == 'stay') {
            //         $this->data['success'] = true;
            //         $this->data['id']        = $save_akd_absensi_siswa;
            //         $this->data['message'] = cclang('success_save_data_stay', [
            //             anchor('administrator/akd_absensi_siswa/edit/' . $save_akd_absensi_siswa, 'Edit Akd Absensi Siswa'),
            //             anchor('administrator/akd_absensi_siswa', ' Go back to list')
            //         ]);
            //     } else {
            //         set_message(
            //             cclang('success_save_data_redirect', [
            //                 anchor('administrator/akd_absensi_siswa/edit/' . $save_akd_absensi_siswa, 'Edit Akd Absensi Siswa')
            //             ]),
            //             'success'
            //         );

            //         $this->data['success'] = true;
            //         $this->data['redirect'] = base_url('administrator/akd_absensi_siswa');
            //     }
            // } else {
            //     if ($this->input->post('save_type') == 'stay') {
            //         $this->data['success'] = false;
            //         $this->data['message'] = cclang('data_not_change');
            //     } else {
            //         $this->data['success'] = false;
            //         $this->data['message'] = cclang('data_not_change');
            //         $this->data['redirect'] = base_url('administrator/akd_absensi_siswa');
            //     }
            // }
        } else {
            $this->data['success'] = false;
            $this->data['message'] = validation_errors();
        }

        echo json_encode($this->data);
    }
    public function add_save_akd_absensi_siswa()
    {
        if (!$this->is_allowed('akd_absensi_siswa_add', false)) {
            echo json_encode([
                'success' => false,
                'message' => cclang('sorry_you_do_not_have_permission_to_access')
            ]);
            exit;
        }

        $this->form_validation->set_rules('id_jadwal_pelajaran', 'Id Jadwal Pelajaran');
        $this->form_validation->set_rules('id_siswa', 'Id Siswa');
        $this->form_validation->set_rules('kode_kehadiran', 'Kode Kehadiran');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');


        if ($this->form_validation->run()) {
            $result = array();
            foreach ($_POST['id_jadwal_pelajaran'] as $key => $val) {
                $result[] = array(
                    'id_jadwal_pelajaran' => $_POST['id_jadwal_pelajaran'],
                    'id_siswa' => $_POST['id_siswa'][$key],
                    'kode_kehadiran' => $_POST['kehadiran'][$key],
                    'tanggal' => $_POST['tanggal'][$key],
                    'keterangan' => $_POST['keterangan'][$key],
                    'waktu_input' => $_POST['waktu_input'][$key]
                );
            }
            // $save_data = [
            //     'id_jadwal_pelajaran' => $this->input->post('id_jadwal_pelajaran'),
            //     'id_siswa' => $this->input->post('id_siswa'),
            //     'tanggal' => $this->input->post('tanggal'),
            //     'kode_kehadiran' => $this->input->post('kehadiran'),
            //     'keterangan' => $this->input->post('keterangan'),
            //     'waktu_input' => date('Y-m-d H:i:s'),
            // ];

            // $save_akd_absensi_siswa = $this->model_akd_absensi_siswa->store($save_data);
            $this->db->insert_batch('akd_absensi_siswa', $result);

            // if ($save_akd_absensi_siswa) {
            //     if ($this->input->post('save_type') == 'stay') {
            //         $this->data['success'] = true;
            //         $this->data['id']        = $save_akd_absensi_siswa;
            //         $this->data['message'] = cclang('success_save_data_stay', [
            //             anchor('administrator/akd_absensi_siswa/edit/' . $save_akd_absensi_siswa, 'Edit Akd Absensi Siswa'),
            //             anchor('administrator/akd_absensi_siswa', ' Go back to list')
            //         ]);
            //     } else {
            //         set_message(
            //             cclang('success_save_data_redirect', [
            //                 anchor('administrator/akd_absensi_siswa/edit/' . $save_akd_absensi_siswa, 'Edit Akd Absensi Siswa')
            //             ]),
            //             'success'
            //         );

            //         $this->data['success'] = true;
            //         $this->data['redirect'] = base_url('administrator/akd_absensi_siswa');
            //     }
            // } else {
            //     if ($this->input->post('save_type') == 'stay') {
            //         $this->data['success'] = false;
            //         $this->data['message'] = cclang('data_not_change');
            //     } else {
            //         $this->data['success'] = false;
            //         $this->data['message'] = cclang('data_not_change');
            //         $this->data['redirect'] = base_url('administrator/akd_absensi_siswa');
            //     }
            // }
        } else {
            $this->data['success'] = false;
            $this->data['message'] = validation_errors();
        }

        echo json_encode($this->data);
    }

    /**
     * Update view Akd Absensi Siswas
     *
     * @var $id String
     */
    public function edit($id)
    {
        $this->is_allowed('akd_absensi_siswa_update');

        $this->data['akd_absensi_siswa'] = $this->model_akd_absensi_siswa->find($id);

        $this->template->title('Akd Absensi Siswa Update');
        $this->render('backend/standart/administrator/akd_absensi_siswa/akd_absensi_siswa_update', $this->data);
    }

    /**
     * Update Akd Absensi Siswas
     *
     * @var $id String
     */
    public function edit_save($id)
    {
        if (!$this->is_allowed('akd_absensi_siswa_update', false)) {
            echo json_encode([
                'success' => false,
                'message' => cclang('sorry_you_do_not_have_permission_to_access')
            ]);
            exit;
        }

        $this->form_validation->set_rules('id_jadwal_pelajaran', 'Id Jadwal Pelajaran', 'trim|required|max_length[11]');
        $this->form_validation->set_rules('id_siswa', 'Id Siswa', 'trim|required|max_length[11]');
        $this->form_validation->set_rules('kode_kehadiran', 'Kode Kehadiran', 'trim|required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');

        if ($this->form_validation->run()) {

            $save_data = [
                'id_jadwal_pelajaran' => $this->input->post('id_jadwal_pelajaran'),
                'id_siswa' => $this->input->post('id_siswa'),
                'kode_kehadiran' => $this->input->post('kode_kehadiran'),
                'tanggal' => $this->input->post('tanggal'),
                'waktu_input' => date('Y-m-d H:i:s'),
            ];


            $save_akd_absensi_siswa = $this->model_akd_absensi_siswa->change($id, $save_data);

            if ($save_akd_absensi_siswa) {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = true;
                    $this->data['id']        = $id;
                    $this->data['message'] = cclang('success_update_data_stay', [
                        anchor('administrator/akd_absensi_siswa', ' Go back to list')
                    ]);
                } else {
                    set_message(
                        cclang('success_update_data_redirect', []),
                        'success'
                    );

                    $this->data['success'] = true;
                    $this->data['redirect'] = base_url('administrator/akd_absensi_siswa');
                }
            } else {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                } else {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                    $this->data['redirect'] = base_url('administrator/akd_absensi_siswa');
                }
            }
        } else {
            $this->data['success'] = false;
            $this->data['message'] = validation_errors();
        }

        echo json_encode($this->data);
    }

    /**
     * delete Akd Absensi Siswas
     *
     * @var $id String
     */
    public function delete($id)
    {
        $this->is_allowed('akd_absensi_siswa_delete');

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
            set_message(cclang('has_been_deleted', 'akd_absensi_siswa'), 'success');
        } else {
            set_message(cclang('error_delete', 'akd_absensi_siswa'), 'error');
        }

        redirect_back();
    }

    /**
     * View view Akd Absensi Siswas
     *
     * @var $id String
     */
    public function view($id)
    {
        $this->is_allowed('akd_absensi_siswa_view');

        $this->data['akd_absensi_siswa'] = $this->model_akd_absensi_siswa->join_avaiable()->find($id);

        $this->template->title('Akd Absensi Siswa Detail');
        $this->render('backend/standart/administrator/akd_absensi_siswa/akd_absensi_siswa_view', $this->data);
    }

    /**
     * delete Akd Absensi Siswas
     *
     * @var $id String
     */
    private function _remove($id)
    {
        $akd_absensi_siswa = $this->model_akd_absensi_siswa->find($id);



        return $this->model_akd_absensi_siswa->remove($id);
    }


    /**
     * Export to excel
     *
     * @return Files Excel .xls
     */
    public function export()
    {
        $this->is_allowed('akd_absensi_siswa_export');

        $this->model_akd_absensi_siswa->export('akd_absensi_siswa', 'akd_absensi_siswa');
    }

    /**
     * Export to PDF
     *
     * @return Files PDF .pdf
     */
    public function export_pdf()
    {
        $this->is_allowed('akd_absensi_siswa_export');

        $this->model_akd_absensi_siswa->pdf('akd_absensi_siswa', 'akd_absensi_siswa');
    }
}


/* End of file akd_absensi_siswa.php */
/* Location: ./application/controllers/administrator/Akd Absensi Siswa.php */
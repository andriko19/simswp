<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| Akd Jurnal Guru Controller
 *| --------------------------------------------------------------------------
 *| Akd Jurnal Guru site
 *|
 */
class Akd_jurnal_guru extends Admin
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_akd_jurnal_guru');
    }

    /**
     * show all Akd Jurnal Gurus
     *
     * @var $offset String
     */
    public function index($offset = 0)
    {
        $this->is_allowed('akd_jurnal_guru_list');

        $filter = $this->input->get('q');
        $field     = $this->input->get('f');

        $this->data['akd_jurnal_gurus'] = $this->model_akd_jurnal_guru->get($filter, $field, $this->limit_page, $offset);
        $this->data['akd_jurnal_guru_counts'] = $this->model_akd_jurnal_guru->count_all($filter, $field);

        $config = [
            'base_url'     => 'administrator/akd_jurnal_guru/index/',
            'total_rows'   => $this->model_akd_jurnal_guru->count_all($filter, $field),
            'per_page'     => $this->limit_page,
            'uri_segment'  => 4,
        ];

        $this->data['pagination'] = $this->pagination($config);

        $this->template->title('Jurnal Guru List');
        $this->render('backend/standart/administrator/akd_jurnal_guru/akd_jurnal_guru_list', $this->data);
    }

    /**
     * Add new akd_jurnal_gurus
     *
     */
    public function add($id)
    {
        $this->is_allowed('akd_jurnal_guru_add');
        // $this->data['akd_absensi_siswa'] = $this->model_akd_absensi_siswa->get_siswa_rombel($id);
        $this->data['akd_jadwal_rombel'] = $this->model_akd_jurnal_guru->get_jadwal_rombel($id);

        $this->template->title('Jurnal Guru New');
        $this->render('backend/standart/administrator/akd_jurnal_guru/akd_jurnal_guru_add', $this->data);
    }

    /**
     * Add New Akd Jurnal Gurus
     *
     * @return JSON
     */
    public function add_save()
    {
        if (!$this->is_allowed('akd_jurnal_guru_add', false)) {
            echo json_encode([
                'success' => false,
                'message' => cclang('sorry_you_do_not_have_permission_to_access')
            ]);
            exit;
        }

        $this->form_validation->set_rules('kode_jadwal', 'Kode Jadwal', 'trim|required|max_length[15]');
        $this->form_validation->set_rules('hari', 'Hari', 'trim|required|max_length[12]');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
        $this->form_validation->set_rules('jam_ke', 'Jam Ke', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('materi', 'Materi', 'trim|required');
        $this->form_validation->set_rules('kegiatan[]', 'Kegiatan', 'trim|required|max_length[255]');
        $this->form_validation->set_rules('media_pembelajaran[]', 'Media Pembelajaran', 'trim|required|max_length[255]');
        $this->form_validation->set_rules('sumber_belajar[]', 'Sumber Belajar', 'trim|required|max_length[255]');
        $this->form_validation->set_rules('kode_sekolah', 'Sekolah', 'trim|required|max_length[11]');


        if ($this->form_validation->run()) {

            $save_data = [
                'kode_jadwal' => $this->input->post('kode_jadwal'),
                'hari' => $this->input->post('hari'),
                'tanggal' => $this->input->post('tanggal'),
                'jam_ke' => $this->input->post('jam_ke'),
                'materi' => $this->input->post('materi'),
                'kompetensi_dasar' => $this->input->post('kompetensi_dasar'),
                'kegiatan' => implode(',', (array) $this->input->post('kegiatan')),
                'media_pembelajaran' => implode(',', (array) $this->input->post('media_pembelajaran')),
                'sumber_belajar' => implode(',', (array) $this->input->post('sumber_belajar')),
                'keterangan' => $this->input->post('keterangan'),
                'kode_sekolah' => $this->input->post('kode_sekolah'),
            ];


            $save_akd_jurnal_guru = $this->model_akd_jurnal_guru->store($save_data);

            if ($save_akd_jurnal_guru) {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = true;
                    $this->data['id']        = $save_akd_jurnal_guru;
                    $this->data['message'] = cclang('success_save_data_stay', [
                        anchor('administrator/akd_jurnal_guru/edit/' . $save_akd_jurnal_guru, 'Edit Akd Jurnal Guru'),
                        anchor('administrator/akd_jurnal_guru', ' Go back to list')
                    ]);
                } else {
                    set_message(
                        cclang('success_save_data_redirect', [
                            anchor('administrator/akd_jurnal_guru/edit/' . $save_akd_jurnal_guru, 'Edit Akd Jurnal Guru')
                        ]),
                        'success'
                    );

                    $this->data['success'] = true;
                    $this->data['redirect'] = base_url('administrator/akd_jurnal_guru');
                }
            } else {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                } else {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                    $this->data['redirect'] = base_url('administrator/akd_jurnal_guru');
                }
            }
        } else {
            $this->data['success'] = false;
            $this->data['message'] = validation_errors();
        }

        echo json_encode($this->data);
    }

    /**
     * Update view Akd Jurnal Gurus
     *
     * @var $id String
     */
    public function edit($id)
    {
        $this->is_allowed('akd_jurnal_guru_update');

        $this->data['akd_jurnal_guru'] = $this->model_akd_jurnal_guru->find($id);

        $this->template->title('Jurnal Guru Update');
        $this->render('backend/standart/administrator/akd_jurnal_guru/akd_jurnal_guru_update', $this->data);
    }

    /**
     * Update Akd Jurnal Gurus
     *
     * @var $id String
     */
    public function edit_save($id)
    {
        if (!$this->is_allowed('akd_jurnal_guru_update', false)) {
            echo json_encode([
                'success' => false,
                'message' => cclang('sorry_you_do_not_have_permission_to_access')
            ]);
            exit;
        }

        $this->form_validation->set_rules('kode_jadwal', 'Kode Jadwal', 'trim|required|max_length[15]');
        $this->form_validation->set_rules('hari', 'Hari', 'trim|required|max_length[12]');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
        $this->form_validation->set_rules('jam_ke', 'Jam Ke', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('materi', 'Materi', 'trim|required');
        $this->form_validation->set_rules('kegiatan[]', 'Kegiatan', 'trim|required|max_length[255]');
        $this->form_validation->set_rules('media_pembelajaran[]', 'Media Pembelajaran', 'trim|required|max_length[255]');
        $this->form_validation->set_rules('sumber_belajar[]', 'Sumber Belajar', 'trim|required|max_length[255]');
        $this->form_validation->set_rules('kode_sekolah', 'Sekolah', 'trim|required|max_length[11]');

        if ($this->form_validation->run()) {

            $save_data = [
                'kode_jadwal' => $this->input->post('kode_jadwal'),
                'hari' => $this->input->post('hari'),
                'tanggal' => $this->input->post('tanggal'),
                'jam_ke' => $this->input->post('jam_ke'),
                'materi' => $this->input->post('materi'),
                'kompetensi_dasar' => $this->input->post('kompetensi_dasar'),
                'kegiatan' => implode(',', (array) $this->input->post('kegiatan')),
                'media_pembelajaran' => implode(',', (array) $this->input->post('media_pembelajaran')),
                'sumber_belajar' => implode(',', (array) $this->input->post('sumber_belajar')),
                'keterangan' => $this->input->post('keterangan'),
                'kode_sekolah' => $this->input->post('kode_sekolah'),
            ];


            $save_akd_jurnal_guru = $this->model_akd_jurnal_guru->change($id, $save_data);

            if ($save_akd_jurnal_guru) {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = true;
                    $this->data['id']        = $id;
                    $this->data['message'] = cclang('success_update_data_stay', [
                        anchor('administrator/akd_jurnal_guru', ' Go back to list')
                    ]);
                } else {
                    set_message(
                        cclang('success_update_data_redirect', []),
                        'success'
                    );

                    $this->data['success'] = true;
                    $this->data['redirect'] = base_url('administrator/akd_jurnal_guru');
                }
            } else {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                } else {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                    $this->data['redirect'] = base_url('administrator/akd_jurnal_guru');
                }
            }
        } else {
            $this->data['success'] = false;
            $this->data['message'] = validation_errors();
        }

        echo json_encode($this->data);
    }

    /**
     * delete Akd Jurnal Gurus
     *
     * @var $id String
     */
    public function delete($id)
    {
        $this->is_allowed('akd_jurnal_guru_delete');

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
            set_message(cclang('has_been_deleted', 'akd_jurnal_guru'), 'success');
        } else {
            set_message(cclang('error_delete', 'akd_jurnal_guru'), 'error');
        }

        redirect_back();
    }

    /**
     * View view Akd Jurnal Gurus
     *
     * @var $id String
     */
    public function view($id)
    {
        $this->is_allowed('akd_jurnal_guru_view');

        $this->data['akd_jurnal_guru'] = $this->model_akd_jurnal_guru->join_avaiable()->find($id);

        $this->template->title('Jurnal Guru Detail');
        $this->render('backend/standart/administrator/akd_jurnal_guru/akd_jurnal_guru_view', $this->data);
    }

    /**
     * delete Akd Jurnal Gurus
     *
     * @var $id String
     */
    private function _remove($id)
    {
        $akd_jurnal_guru = $this->model_akd_jurnal_guru->find($id);



        return $this->model_akd_jurnal_guru->remove($id);
    }


    /**
     * Export to excel
     *
     * @return Files Excel .xls
     */
    public function export()
    {
        $this->is_allowed('akd_jurnal_guru_export');

        $this->model_akd_jurnal_guru->export('akd_jurnal_guru', 'akd_jurnal_guru');
    }

    /**
     * Export to PDF
     *
     * @return Files PDF .pdf
     */
    public function export_pdf()
    {
        $this->is_allowed('akd_jurnal_guru_export');

        $this->model_akd_jurnal_guru->pdf('akd_jurnal_guru', 'akd_jurnal_guru');
    }
}


/* End of file akd_jurnal_guru.php */
/* Location: ./application/controllers/administrator/Akd Jurnal Guru.php */
<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| Guru Controller
 *| --------------------------------------------------------------------------
 *| Guru site
 *|
 */
class Guru extends Admin
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_guru');
    }

    /**
     * show all Gurus
     *
     * @var $offset String
     */
    public function index($offset = 0)
    {
        $this->is_allowed('guru_list');

        $filter = $this->input->get('q');
        $field     = $this->input->get('f');

        $a = $this->session->groups;
        // var_dump($a);
        // die;
        if ($a == 1) {
            $this->data['gurus'] = $this->model_guru->get($filter, $field, $this->limit_page, $offset);
            $this->data['guru_counts'] = $this->model_guru->count_all($filter, $field);

            $config = [
                'base_url'     => 'administrator/guru/index/',
                'total_rows'   => $this->model_guru->count_all($filter, $field),
                'per_page'     => $this->limit_page,
                'uri_segment'  => 4,
            ];
        } // filter admin smk
        else if ($a == 16) {
            $this->data['gurus'] = $this->model_guru->get2($filter, $field, $this->limit_page, $offset);
            $this->data['guru_counts'] = $this->model_guru->count_all2($filter, $field);

            $config = [
                'base_url'     => 'administrator/guru/index/',
                'total_rows'   => $this->model_guru->count_all2($filter, $field),
                'per_page'     => $this->limit_page,
                'uri_segment'  => 4,
            ];
        } // filter admin sma
        else if ($a == 15) {
            $this->data['gurus'] = $this->model_guru->get3($filter, $field, $this->limit_page, $offset);
            $this->data['guru_counts'] = $this->model_guru->count_all3($filter, $field);

            $config = [
                'base_url'     => 'administrator/guru/index/',
                'total_rows'   => $this->model_guru->count_all3($filter, $field),
                'per_page'     => $this->limit_page,
                'uri_segment'  => 4,
            ];
        } // filter admin smp
        else if ($a == 14) {
            $this->data['gurus'] = $this->model_guru->get4($filter, $field, $this->limit_page, $offset);
            $this->data['guru_counts'] = $this->model_guru->count_all4($filter, $field);

            $config = [
                'base_url'     => 'administrator/guru/index/',
                'total_rows'   => $this->model_guru->count_all4($filter, $field),
                'per_page'     => $this->limit_page,
                'uri_segment'  => 4,
            ];
        }

        $this->data['pagination'] = $this->pagination($config);

        $this->template->title('Guru List');
        $this->render('backend/standart/administrator/guru/guru_list', $this->data);
    }

    /**
     * Add new gurus
     *
     */
    public function add()
    {
        $this->is_allowed('guru_add');

        $this->template->title('Guru New');
        $this->render('backend/standart/administrator/guru/guru_add', $this->data);
    }

    /**
     * Add New Gurus
     *
     * @return JSON
     */
    public function add_save()
    {
        if (!$this->is_allowed('guru_add', false)) {
            echo json_encode([
                'success' => false,
                'message' => cclang('sorry_you_do_not_have_permission_to_access')
            ]);
            exit;
        }

        $this->form_validation->set_rules('nip', 'NIP', 'trim|max_length[100]');
        // $this->form_validation->set_rules('password', 'Password', 'trim|max_length[255]');
        $this->form_validation->set_rules('nama_guru', 'Nama Guru', 'trim|required|max_length[150]');
        $this->form_validation->set_rules('id_jenis_kelamin', 'Jenis Kelamin', 'trim|required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('id_status_kepegawaian', 'Status Kepegawaian', 'trim|required');
        $this->form_validation->set_rules('id_jenis_ptk', 'Jenis PTK', 'trim|required');
        $this->form_validation->set_rules('id_agama', 'Agama', 'trim|required');
        $this->form_validation->set_rules('keahlian_laboratorium', 'Keahlian Laboratorium', 'required');
        $this->form_validation->set_rules('keahlian_breile', 'Keahlian Braille', 'required');
        $this->form_validation->set_rules('keahlian_bahasa_isyarat', 'Keahlian Bahasa Isyarat', 'required');
        $this->form_validation->set_rules('alamat_jalan', 'Alamat', 'trim|max_length[255]');
        $this->form_validation->set_rules('rt', 'RT', 'trim');
        $this->form_validation->set_rules('rw', 'RW', 'trim');
        $this->form_validation->set_rules('nama_dusun', 'Dusun', 'trim');
        $this->form_validation->set_rules('desa_kelurahan', 'Desa/Kelurahan', 'trim');
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'trim');
        $this->form_validation->set_rules('hp', 'HP', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('id_status_keaktifan', 'Status Keaktifan', 'trim|required|max_length[5]');
        $this->form_validation->set_rules('id_golongan', 'Golongan', 'trim|max_length[5]');
        $this->form_validation->set_rules('nama_ibu_kandung', 'Nama Ibu Kandung', 'trim');
        $this->form_validation->set_rules('id_status_pernikahan', 'Status Pernikahan', 'trim|required');
        $this->form_validation->set_rules('nama_suami_istri', 'Nama Suami/Istri', 'trim');
        $this->form_validation->set_rules('guru_foto_name', 'Foto', 'trim');
        $this->form_validation->set_rules('id_sekolah', 'Home Base Sekolah', 'trim|required');


        if ($this->form_validation->run()) {
            $guru_foto_uuid = $this->input->post('guru_foto_uuid');
            $guru_foto_name = $this->input->post('guru_foto_name');

            $save_data = [
                'nip' => $this->input->post('nip'),
                // 'password' => $this->input->post('password'),
                'nama_guru' => $this->input->post('nama_guru'),
                'id_jenis_kelamin' => $this->input->post('id_jenis_kelamin'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'nik' => $this->input->post('nik'),
                'niy_nigk' => $this->input->post('niy_nigk'),
                'nuptk' => $this->input->post('nuptk'),
                'id_status_kepegawaian' => $this->input->post('id_status_kepegawaian'),
                'id_jenis_ptk' => $this->input->post('id_jenis_ptk'),
                'pengawas_bidang_studi' => $this->input->post('pengawas_bidang_studi'),
                'id_agama' => $this->input->post('id_agama'),
                'alamat_jalan' => $this->input->post('alamat_jalan'),
                'rt' => $this->input->post('rt'),
                'rw' => $this->input->post('rw'),
                'nama_dusun' => $this->input->post('nama_dusun'),
                'desa_kelurahan' => $this->input->post('desa_kelurahan'),
                'kecamatan' => $this->input->post('kecamatan'),
                'kode_pos' => $this->input->post('kode_pos'),
                'telepon' => $this->input->post('telepon'),
                'hp' => $this->input->post('hp'),
                'email' => $this->input->post('email'),
                'tugas_tambahan' => $this->input->post('tugas_tambahan'),
                'id_status_keaktifan' => $this->input->post('id_status_keaktifan'),
                'sk_cpns' => $this->input->post('sk_cpns'),
                'tanggal_cpns' => $this->input->post('tanggal_cpns'),
                'sk_pengangkatan' => $this->input->post('sk_pengangkatan'),
                'tmt_pengangkatan' => $this->input->post('tmt_pengangkatan'),
                'lembaga_pengangkatan' => $this->input->post('lembaga_pengangkatan'),
                'id_golongan' => $this->input->post('id_golongan'),
                'keahlian_laboratorium' => $this->input->post('keahlian_laboratorium'),
                'sumber_gaji' => $this->input->post('sumber_gaji'),
                'nama_ibu_kandung' => $this->input->post('nama_ibu_kandung'),
                'id_status_pernikahan' => $this->input->post('id_status_pernikahan'),
                'nama_suami_istri' => $this->input->post('nama_suami_istri'),
                'nip_suami_istri' => $this->input->post('nip_suami_istri'),
                'pekerjaan_suami_istri' => $this->input->post('pekerjaan_suami_istri'),
                'tmt_pns' => $this->input->post('tmt_pns'),
                'lisensi_kepsek' => $this->input->post('lisensi_kepsek'),
                'jumlah_sekolah_binaan' => $this->input->post('jumlah_sekolah_binaan'),
                'diklat_kepengawasan' => $this->input->post('diklat_kepengawasan'),
                'mampu_handle_kk' => $this->input->post('mampu_handle_kk'),
                'keahlian_breile' => $this->input->post('keahlian_breile'),
                'keahlian_bahasa_isyarat' => $this->input->post('keahlian_bahasa_isyarat'),
                'npwp' => $this->input->post('npwp'),
                'kewarganegaraan' => $this->input->post('kewarganegaraan'),
                'id_sekolah' => $this->input->post('id_sekolah'),
            ];

            if (!is_dir(FCPATH . '/uploads/guru/')) {
                mkdir(FCPATH . '/uploads/guru/');
            }

            if (!empty($guru_foto_name)) {
                $guru_foto_name_copy = date('YmdHis') . '-' . $guru_foto_name;

                rename(
                    FCPATH . 'uploads/tmp/' . $guru_foto_uuid . '/' . $guru_foto_name,
                    FCPATH . 'uploads/guru/' . $guru_foto_name_copy
                );

                if (!is_file(FCPATH . '/uploads/guru/' . $guru_foto_name_copy)) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Error uploading file'
                    ]);
                    exit;
                }

                $save_data['foto'] = $guru_foto_name_copy;
            }


            $save_guru = $this->model_guru->store($save_data);

            if ($save_guru) {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = true;
                    $this->data['id']        = $save_guru;
                    $this->data['message'] = cclang('success_save_data_stay', [
                        anchor('administrator/guru/edit/' . $save_guru, 'Edit Guru'),
                        anchor('administrator/guru', ' Go back to list')
                    ]);
                } else {
                    set_message(
                        cclang('success_save_data_redirect', [
                            anchor('administrator/guru/edit/' . $save_guru, 'Edit Guru')
                        ]),
                        'success'
                    );

                    $this->data['success'] = true;
                    $this->data['redirect'] = base_url('administrator/guru');
                }
            } else {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                } else {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                    $this->data['redirect'] = base_url('administrator/guru');
                }
            }
        } else {
            $this->data['success'] = false;
            $this->data['message'] = validation_errors();
        }

        echo json_encode($this->data);
    }

    /**
     * Update view Gurus
     *
     * @var $id String
     */
    public function edit($id)
    {
        $this->is_allowed('guru_update');

        $this->data['guru'] = $this->model_guru->find($id);

        $this->template->title('Guru Update');
        $this->render('backend/standart/administrator/guru/guru_update', $this->data);
    }

    /**
     * Update Gurus
     *
     * @var $id String
     */
    public function edit_save($id)
    {
        if (!$this->is_allowed('guru_update', false)) {
            echo json_encode([
                'success' => false,
                'message' => cclang('sorry_you_do_not_have_permission_to_access')
            ]);
            exit;
        }

        $this->form_validation->set_rules('nip', 'NIP', 'trim|max_length[100]');
        // $this->form_validation->set_rules('password', 'Password', 'trim|max_length[255]');
        $this->form_validation->set_rules('nama_guru', 'Nama Guru', 'trim|required|max_length[150]');
        $this->form_validation->set_rules('id_jenis_kelamin', 'Jenis Kelamin', 'trim|required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('id_status_kepegawaian', 'Status Kepegawaian', 'trim|required');
        $this->form_validation->set_rules('id_jenis_ptk', 'Jenis PTK', 'trim|required');
        $this->form_validation->set_rules('id_agama', 'Agama', 'trim|required');
        $this->form_validation->set_rules('keahlian_laboratorium', 'Keahlian Laboratorium', 'required');
        $this->form_validation->set_rules('keahlian_breile', 'Keahlian Braille', 'required');
        $this->form_validation->set_rules('keahlian_bahasa_isyarat', 'Keahlian Bahasa Isyarat', 'required');
        $this->form_validation->set_rules('alamat_jalan', 'Alamat', 'trim|max_length[255]');
        $this->form_validation->set_rules('rt', 'RT', 'trim');
        $this->form_validation->set_rules('rw', 'RW', 'trim');
        $this->form_validation->set_rules('nama_dusun', 'Dusun', 'trim');
        $this->form_validation->set_rules('desa_kelurahan', 'Desa/Kelurahan', 'trim');
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'trim');
        $this->form_validation->set_rules('hp', 'HP', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('id_status_keaktifan', 'Status Keaktifan', 'trim|required|max_length[5]');
        $this->form_validation->set_rules('id_golongan', 'Golongan', 'trim|max_length[5]');
        $this->form_validation->set_rules('nama_ibu_kandung', 'Nama Ibu Kandung', 'trim');
        $this->form_validation->set_rules('id_status_pernikahan', 'Status Pernikahan', 'trim|required');
        $this->form_validation->set_rules('nama_suami_istri', 'Nama Suami/Istri', 'trim');
        $this->form_validation->set_rules('guru_foto_name', 'Foto', 'trim');
        $this->form_validation->set_rules('id_sekolah', 'Home Base Sekolah', 'trim|required');

        if ($this->form_validation->run()) {
            $guru_foto_uuid = $this->input->post('guru_foto_uuid');
            $guru_foto_name = $this->input->post('guru_foto_name');

            $save_data = [
                'nip' => $this->input->post('nip'),
                // 'password' => $this->input->post('password'),
                'nama_guru' => $this->input->post('nama_guru'),
                'id_jenis_kelamin' => $this->input->post('id_jenis_kelamin'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'nik' => $this->input->post('nik'),
                'niy_nigk' => $this->input->post('niy_nigk'),
                'nuptk' => $this->input->post('nuptk'),
                'id_status_kepegawaian' => $this->input->post('id_status_kepegawaian'),
                'id_jenis_ptk' => $this->input->post('id_jenis_ptk'),
                'pengawas_bidang_studi' => $this->input->post('pengawas_bidang_studi'),
                'id_agama' => $this->input->post('id_agama'),
                'alamat_jalan' => $this->input->post('alamat_jalan'),
                'rt' => $this->input->post('rt'),
                'rw' => $this->input->post('rw'),
                'nama_dusun' => $this->input->post('nama_dusun'),
                'desa_kelurahan' => $this->input->post('desa_kelurahan'),
                'kecamatan' => $this->input->post('kecamatan'),
                'kode_pos' => $this->input->post('kode_pos'),
                'telepon' => $this->input->post('telepon'),
                'hp' => $this->input->post('hp'),
                'email' => $this->input->post('email'),
                'tugas_tambahan' => $this->input->post('tugas_tambahan'),
                'id_status_keaktifan' => $this->input->post('id_status_keaktifan'),
                'sk_cpns' => $this->input->post('sk_cpns'),
                'tanggal_cpns' => $this->input->post('tanggal_cpns'),
                'sk_pengangkatan' => $this->input->post('sk_pengangkatan'),
                'tmt_pengangkatan' => $this->input->post('tmt_pengangkatan'),
                'lembaga_pengangkatan' => $this->input->post('lembaga_pengangkatan'),
                'id_golongan' => $this->input->post('id_golongan'),
                'keahlian_laboratorium' => $this->input->post('keahlian_laboratorium'),
                'sumber_gaji' => $this->input->post('sumber_gaji'),
                'nama_ibu_kandung' => $this->input->post('nama_ibu_kandung'),
                'id_status_pernikahan' => $this->input->post('id_status_pernikahan'),
                'nama_suami_istri' => $this->input->post('nama_suami_istri'),
                'nip_suami_istri' => $this->input->post('nip_suami_istri'),
                'pekerjaan_suami_istri' => $this->input->post('pekerjaan_suami_istri'),
                'tmt_pns' => $this->input->post('tmt_pns'),
                'lisensi_kepsek' => $this->input->post('lisensi_kepsek'),
                'jumlah_sekolah_binaan' => $this->input->post('jumlah_sekolah_binaan'),
                'diklat_kepengawasan' => $this->input->post('diklat_kepengawasan'),
                'mampu_handle_kk' => $this->input->post('mampu_handle_kk'),
                'keahlian_breile' => $this->input->post('keahlian_breile'),
                'keahlian_bahasa_isyarat' => $this->input->post('keahlian_bahasa_isyarat'),
                'npwp' => $this->input->post('npwp'),
                'kewarganegaraan' => $this->input->post('kewarganegaraan'),
                'id_sekolah' => $this->input->post('id_sekolah'),
            ];

            if (!is_dir(FCPATH . '/uploads/guru/')) {
                mkdir(FCPATH . '/uploads/guru/');
            }

            if (!empty($guru_foto_uuid)) {
                $guru_foto_name_copy = date('YmdHis') . '-' . $guru_foto_name;

                rename(
                    FCPATH . 'uploads/tmp/' . $guru_foto_uuid . '/' . $guru_foto_name,
                    FCPATH . 'uploads/guru/' . $guru_foto_name_copy
                );

                if (!is_file(FCPATH . '/uploads/guru/' . $guru_foto_name_copy)) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Error uploading file'
                    ]);
                    exit;
                }

                $save_data['foto'] = $guru_foto_name_copy;
            }


            $save_guru = $this->model_guru->change($id, $save_data);

            if ($save_guru) {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = true;
                    $this->data['id']        = $id;
                    $this->data['message'] = cclang('success_update_data_stay', [
                        anchor('administrator/guru', ' Go back to list')
                    ]);
                } else {
                    set_message(
                        cclang('success_update_data_redirect', []),
                        'success'
                    );

                    $this->data['success'] = true;
                    $this->data['redirect'] = base_url('administrator/guru');
                }
            } else {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                } else {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                    $this->data['redirect'] = base_url('administrator/guru');
                }
            }
        } else {
            $this->data['success'] = false;
            $this->data['message'] = validation_errors();
        }

        echo json_encode($this->data);
    }

    /**
     * delete Gurus
     *
     * @var $id String
     */
    public function delete($id)
    {
        $this->is_allowed('guru_delete');

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
            set_message(cclang('has_been_deleted', 'guru'), 'success');
        } else {
            set_message(cclang('error_delete', 'guru'), 'error');
        }

        redirect_back();
    }

    /**
     * View view Gurus
     *
     * @var $id String
     */
    public function view($id)
    {
        $this->is_allowed('guru_view');

        $this->data['guru'] = $this->model_guru->join_avaiable()->find($id);

        $this->template->title('Guru Detail');
        $this->render('backend/standart/administrator/guru/guru_view', $this->data);
    }

    /**
     * delete Gurus
     *
     * @var $id String
     */
    private function _remove($id)
    {
        $guru = $this->model_guru->find($id);

        if (!empty($guru->foto)) {
            $path = FCPATH . '/uploads/guru/' . $guru->foto;

            if (is_file($path)) {
                $delete_file = unlink($path);
            }
        }


        return $this->model_guru->remove($id);
    }

    /**
     * Upload Image Guru	* 
     * @return JSON
     */
    public function upload_foto_file()
    {
        if (!$this->is_allowed('guru_add', false)) {
            echo json_encode([
                'success' => false,
                'message' => cclang('sorry_you_do_not_have_permission_to_access')
            ]);
            exit;
        }

        $uuid = $this->input->post('qquuid');

        echo $this->upload_file([
            'uuid'              => $uuid,
            'table_name'     => 'guru',
            'allowed_types' => 'jpg',
            'max_size'          => 1024,
        ]);
    }

    /**
     * Delete Image Guru	* 
     * @return JSON
     */
    public function delete_foto_file($uuid)
    {
        if (!$this->is_allowed('guru_delete', false)) {
            echo json_encode([
                'success' => false,
                'error' => cclang('sorry_you_do_not_have_permission_to_access')
            ]);
            exit;
        }

        echo $this->delete_file([
            'uuid'              => $uuid,
            'delete_by'         => $this->input->get('by'),
            'field_name'        => 'foto',
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'guru',
            'primary_key'       => 'id_guru',
            'upload_path'       => 'uploads/guru/'
        ]);
    }

    /**
     * Get Image Guru	* 
     * @return JSON
     */
    public function get_foto_file($id)
    {
        if (!$this->is_allowed('guru_update', false)) {
            echo json_encode([
                'success' => false,
                'message' => 'Image not loaded, you do not have permission to access'
            ]);
            exit;
        }

        $guru = $this->model_guru->find($id);

        echo $this->get_file([
            'uuid'              => $id,
            'delete_by'         => 'id',
            'field_name'        => 'foto',
            'table_name'        => 'guru',
            'primary_key'       => 'id_guru',
            'upload_path'       => 'uploads/guru/',
            'delete_endpoint'   => 'administrator/guru/delete_foto_file'
        ]);
    }


    /**
     * Export to excel
     *
     * @return Files Excel .xls
     */
    public function export()
    {
        $this->is_allowed('guru_export');

        $this->model_guru->export('guru', 'guru');
    }

    /**
     * Export to PDF
     *
     * @return Files PDF .pdf
     */
    public function export_pdf()
    {
        $this->is_allowed('guru_export');

        $this->model_guru->pdf('guru', 'guru');
    }
}


/* End of file guru.php */
/* Location: ./application/controllers/administrator/Guru.php */
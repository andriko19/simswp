<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| Siswa Controller
 *| --------------------------------------------------------------------------
 *| Siswa site
 *|
 */
class Siswa extends Admin
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_siswa');
    }

    /**
     * show all Siswas
     *
     * @var $offset String
     */
    public function index($offset = 0)
    {
        $this->is_allowed('siswa_list');

        $filter = $this->input->get('q');
        $field     = $this->input->get('f');


        $a = $this->session->groups;
        // var_dump($a);
        // die;
        if ($a == 1) {
            $this->data['siswas'] = $this->model_siswa->get($filter, $field, $this->limit_page, $offset);
            $this->data['siswa_counts'] = $this->model_siswa->count_all($filter, $field);

            $config = [
                'base_url'     => 'administrator/siswa/index/',
                'total_rows'   => $this->model_siswa->count_all($filter, $field),
                'per_page'     => $this->limit_page,
                'uri_segment'  => 4,
            ];
        } // filter admin smk1
        else if ($a == 16) {
            $this->data['siswas'] = $this->model_siswa->get2($filter, $field, $this->limit_page, $offset);
            $this->data['siswa_counts'] = $this->model_siswa->count_all2($filter, $field);

            $config = [
                'base_url'     => 'administrator/siswa/index/',
                'total_rows'   => $this->model_siswa->count_all2($filter, $field),
                'per_page'     => $this->limit_page,
                'uri_segment'  => 4,
            ];
        } // filter admin sma
        else if ($a == 15) {
            $this->data['siswas'] = $this->model_siswa->get3($filter, $field, $this->limit_page, $offset);
            $this->data['siswa_counts'] = $this->model_siswa->count_all3($filter, $field);

            $config = [
                'base_url'     => 'administrator/siswa/index/',
                'total_rows'   => $this->model_siswa->count_all3($filter, $field),
                'per_page'     => $this->limit_page,
                'uri_segment'  => 4,
            ];
        } // filter admin smp
        else if ($a == 14) {
            $this->data['siswas'] = $this->model_siswa->get4($filter, $field, $this->limit_page, $offset);
            $this->data['siswa_counts'] = $this->model_siswa->count_all4($filter, $field);

            $config = [
                'base_url'     => 'administrator/siswa/index/',
                'total_rows'   => $this->model_siswa->count_all4($filter, $field),
                'per_page'     => $this->limit_page,
                'uri_segment'  => 4,
            ];
        }
        $this->data['pagination'] = $this->pagination($config);

        $this->template->title('Siswa List');
        $this->render('backend/standart/administrator/siswa/siswa_list', $this->data);
    }

    /**
     * Add new siswas
     *
     */
    public function add()
    {
        $this->is_allowed('siswa_add');

        $this->template->title('Siswa New');
        $this->render('backend/standart/administrator/siswa/siswa_add', $this->data);
    }

    /**
     * Add New Siswas
     *
     * @return JSON
     */
    public function add_save()
    {
        if (!$this->is_allowed('siswa_add', false)) {
            echo json_encode([
                'success' => false,
                'message' => cclang('sorry_you_do_not_have_permission_to_access')
            ]);
            exit;
        }

        $this->form_validation->set_rules('nipd', 'NIPD', 'trim|required');
        // $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('nama', 'Nama Siswa', 'trim|required');
        $this->form_validation->set_rules('id_jenis_kelamin', 'Jenis Kelamin', 'trim|required|max_length[5]');
        $this->form_validation->set_rules('nisn', 'NISN', 'trim');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('id_agama', 'Agama', 'trim|required');
        $this->form_validation->set_rules('kebutuhan_khusus', 'Kebutuhan Khusus', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'trim|required');
        $this->form_validation->set_rules('hp', 'HP', 'trim|required|callback_valid_number');
        $this->form_validation->set_rules('email', 'Email Aktif', 'trim|required|valid_email');
        $this->form_validation->set_rules('siswa_foto_name', 'Foto', 'trim');
        $this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'trim|required');
        $this->form_validation->set_rules('tahun_lahir_ayah', 'Tahun Lahir Ayah', 'trim|required');
        $this->form_validation->set_rules('pendidikan_ayah', 'Pendidikan Ayah', 'trim|required');
        $this->form_validation->set_rules('pekerjaan_ayah', 'Pekerjaan Ayah', 'trim|required');
        $this->form_validation->set_rules('penghasilan_ayah', 'Penghasilan Ayah', 'trim|required');
        $this->form_validation->set_rules('kebutuhan_khusus_ayah', 'Kebutuhan Khusus Ayah', 'trim|required');
        $this->form_validation->set_rules('no_telpon_ayah', 'No. Telepon Ayah', 'trim|required|callback_valid_number');
        $this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'trim');
        $this->form_validation->set_rules('tahun_lahir_ibu', 'Tahun Lahir Ibu', 'trim|max_length[4]');
        $this->form_validation->set_rules('pendidikan_ibu', 'Pendidikan Ibu', 'trim');
        $this->form_validation->set_rules('pekerjaan_ibu', 'Pekerjaan Ibu', 'trim');
        $this->form_validation->set_rules('kebutuhan_khusus_ibu', 'Kebutuhan Khusus Ibu', 'trim|required');
        $this->form_validation->set_rules('no_telpon_ibu', 'No. Telepon Ibu', 'trim');
        $this->form_validation->set_rules('nama_wali', 'Nama Wali', 'trim');
        $this->form_validation->set_rules('tahun_lahir_wali', 'Tahun Lahir Wali', 'trim');
        $this->form_validation->set_rules('pendidikan_wali', 'Pendidikan Wali', 'trim');
        $this->form_validation->set_rules('pekerjaan_wali', 'Pekerjaan Wali', 'trim');
        $this->form_validation->set_rules('angkatan', 'Angkatan/Tahun Masuk', 'trim|required');
        $this->form_validation->set_rules('status_siswa', 'Status Keaktifan', 'trim|required');
        $this->form_validation->set_rules('tingkat', 'Tingkat', 'trim|required');
        // $this->form_validation->set_rules('kode_kelas', 'Kelas', 'trim|required');
        $this->form_validation->set_rules('kode_jurusan', 'Jurusan', 'trim|required');
        $this->form_validation->set_rules('kode_sekolah', 'Id Sekolah', 'trim|required');


        if ($this->form_validation->run()) {
            $siswa_foto_uuid = $this->input->post('siswa_foto_uuid');
            $siswa_foto_name = $this->input->post('siswa_foto_name');

            $save_data = [
                'nipd' => $this->input->post('nipd'),
                // 'password' => $this->input->post('password'),
                'nama' => $this->input->post('nama'),
                'id_jenis_kelamin' => $this->input->post('id_jenis_kelamin'),
                'nisn' => $this->input->post('nisn'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'nik' => $this->input->post('nik'),
                'id_agama' => $this->input->post('id_agama'),
                'kebutuhan_khusus' => $this->input->post('kebutuhan_khusus'),
                'alamat' => $this->input->post('alamat'),
                'rt' => $this->input->post('rt'),
                'rw' => $this->input->post('rw'),
                'dusun' => $this->input->post('dusun'),
                'kelurahan' => $this->input->post('kelurahan'),
                'kecamatan' => $this->input->post('kecamatan'),
                'kode_pos' => $this->input->post('kode_pos'),
                'jenis_tinggal' => $this->input->post('jenis_tinggal'),
                'alat_transportasi' => $this->input->post('alat_transportasi'),
                'telepon' => $this->input->post('telepon'),
                'hp' => $this->input->post('hp'),
                'email' => $this->input->post('email'),
                'skhun' => $this->input->post('skhun'),
                'penerima_kps' => $this->input->post('penerima_kps'),
                'no_kps' => $this->input->post('no_kps'),
                'nama_ayah' => $this->input->post('nama_ayah'),
                'tahun_lahir_ayah' => $this->input->post('tahun_lahir_ayah'),
                'pendidikan_ayah' => $this->input->post('pendidikan_ayah'),
                'pekerjaan_ayah' => $this->input->post('pekerjaan_ayah'),
                'penghasilan_ayah' => $this->input->post('penghasilan_ayah'),
                'kebutuhan_khusus_ayah' => $this->input->post('kebutuhan_khusus_ayah'),
                'no_telpon_ayah' => $this->input->post('no_telpon_ayah'),
                'nama_ibu' => $this->input->post('nama_ibu'),
                'tahun_lahir_ibu' => $this->input->post('tahun_lahir_ibu'),
                'pendidikan_ibu' => $this->input->post('pendidikan_ibu'),
                'pekerjaan_ibu' => $this->input->post('pekerjaan_ibu'),
                'penghasilan_ibu' => $this->input->post('penghasilan_ibu'),
                'kebutuhan_khusus_ibu' => $this->input->post('kebutuhan_khusus_ibu'),
                'no_telpon_ibu' => $this->input->post('no_telpon_ibu'),
                'nama_wali' => $this->input->post('nama_wali'),
                'tahun_lahir_wali' => $this->input->post('tahun_lahir_wali'),
                'pendidikan_wali' => $this->input->post('pendidikan_wali'),
                'pekerjaan_wali' => $this->input->post('pekerjaan_wali'),
                'penghasilan_wali' => $this->input->post('penghasilan_wali'),
                'angkatan' => $this->input->post('angkatan'),
                'status_awal' => $this->input->post('status_awal'),
                'status_siswa' => $this->input->post('status_siswa'),
                'tingkat' => $this->input->post('tingkat'),
                // 'kode_kelas' => $this->input->post('kode_kelas'),
                'kode_jurusan' => $this->input->post('kode_jurusan'),
                'id_sesi' => $this->input->post('id_sesi'),
                'id_sekolah' => $this->input->post('kode_sekolah'),
            ];

            if (!is_dir(FCPATH . '/uploads/siswa/')) {
                mkdir(FCPATH . '/uploads/siswa/');
            }

            if (!empty($siswa_foto_name)) {
                $siswa_foto_name_copy = date('YmdHis') . '-' . $siswa_foto_name;

                rename(
                    FCPATH . 'uploads/tmp/' . $siswa_foto_uuid . '/' . $siswa_foto_name,
                    FCPATH . 'uploads/siswa/' . $siswa_foto_name_copy
                );

                if (!is_file(FCPATH . '/uploads/siswa/' . $siswa_foto_name_copy)) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Error uploading file'
                    ]);
                    exit;
                }

                $save_data['foto'] = $siswa_foto_name_copy;
            }


            $save_siswa = $this->model_siswa->store($save_data);

            if ($save_siswa) {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = true;
                    $this->data['id']        = $save_siswa;
                    $this->data['message'] = cclang('success_save_data_stay', [
                        anchor('administrator/siswa/edit/' . $save_siswa, 'Edit Siswa'),
                        anchor('administrator/siswa', ' Go back to list')
                    ]);
                } else {
                    set_message(
                        cclang('success_save_data_redirect', [
                            anchor('administrator/siswa/edit/' . $save_siswa, 'Edit Siswa')
                        ]),
                        'success'
                    );

                    $this->data['success'] = true;
                    $this->data['redirect'] = base_url('administrator/siswa');
                }
            } else {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                } else {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                    $this->data['redirect'] = base_url('administrator/siswa');
                }
            }
        } else {
            $this->data['success'] = false;
            $this->data['message'] = validation_errors();
        }

        echo json_encode($this->data);
    }

    /**
     * Update view Siswas
     *
     * @var $id String
     */
    public function edit($id)
    {
        $this->is_allowed('siswa_update');

        $this->data['siswa'] = $this->model_siswa->find($id);

        $this->template->title('Siswa Update');
        $this->render('backend/standart/administrator/siswa/siswa_update', $this->data);
    }

    /**
     * Update Siswas
     *
     * @var $id String
     */
    public function edit_save($id)
    {
        if (!$this->is_allowed('siswa_update', false)) {
            echo json_encode([
                'success' => false,
                'message' => cclang('sorry_you_do_not_have_permission_to_access')
            ]);
            exit;
        }

        $this->form_validation->set_rules('nipd', 'NIPD', 'trim|required');
        // $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('nama', 'Nama Siswa', 'trim|required');
        $this->form_validation->set_rules('id_jenis_kelamin', 'Jenis Kelamin', 'trim|required|max_length[5]');
        $this->form_validation->set_rules('nisn', 'NISN', 'trim');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('id_agama', 'Agama', 'trim|required');
        $this->form_validation->set_rules('kebutuhan_khusus', 'Kebutuhan Khusus', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'trim|required');
        $this->form_validation->set_rules('hp', 'HP', 'trim|required|callback_valid_number');
        $this->form_validation->set_rules('email', 'Email Aktif', 'trim|required|valid_email');
        $this->form_validation->set_rules('siswa_foto_name', 'Foto', 'trim');
        $this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'trim|required');
        $this->form_validation->set_rules('tahun_lahir_ayah', 'Tahun Lahir Ayah', 'trim|required');
        $this->form_validation->set_rules('pendidikan_ayah', 'Pendidikan Ayah', 'trim|required');
        $this->form_validation->set_rules('pekerjaan_ayah', 'Pekerjaan Ayah', 'trim|required');
        $this->form_validation->set_rules('penghasilan_ayah', 'Penghasilan Ayah', 'trim|required');
        $this->form_validation->set_rules('kebutuhan_khusus_ayah', 'Kebutuhan Khusus Ayah', 'trim|required');
        $this->form_validation->set_rules('no_telpon_ayah', 'No. Telepon Ayah', 'trim|required|callback_valid_number');
        $this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'trim');
        $this->form_validation->set_rules('tahun_lahir_ibu', 'Tahun Lahir Ibu', 'trim|max_length[4]');
        $this->form_validation->set_rules('pendidikan_ibu', 'Pendidikan Ibu', 'trim');
        $this->form_validation->set_rules('pekerjaan_ibu', 'Pekerjaan Ibu', 'trim');
        $this->form_validation->set_rules('kebutuhan_khusus_ibu', 'Kebutuhan Khusus Ibu', 'trim|required');
        $this->form_validation->set_rules('no_telpon_ibu', 'No. Telepon Ibu', 'trim');
        $this->form_validation->set_rules('nama_wali', 'Nama Wali', 'trim');
        $this->form_validation->set_rules('tahun_lahir_wali', 'Tahun Lahir Wali', 'trim');
        $this->form_validation->set_rules('pendidikan_wali', 'Pendidikan Wali', 'trim');
        $this->form_validation->set_rules('pekerjaan_wali', 'Pekerjaan Wali', 'trim');
        $this->form_validation->set_rules('angkatan', 'Angkatan/Tahun Masuk', 'trim|required');
        $this->form_validation->set_rules('status_siswa', 'Status Keaktifan', 'trim|required');
        $this->form_validation->set_rules('tingkat', 'Tingkat', 'trim|required');
        // $this->form_validation->set_rules('kode_kelas', 'Kelas', 'trim|required');
        $this->form_validation->set_rules('kode_jurusan', 'Jurusan', 'trim|required');
        $this->form_validation->set_rules('kode_sekolah', 'Id Sekolah', 'trim|required');

        if ($this->form_validation->run()) {
            $siswa_foto_uuid = $this->input->post('siswa_foto_uuid');
            $siswa_foto_name = $this->input->post('siswa_foto_name');

            $save_data = [
                'nipd' => $this->input->post('nipd'),
                // 'password' => $this->input->post('password'),
                'nama' => $this->input->post('nama'),
                'id_jenis_kelamin' => $this->input->post('id_jenis_kelamin'),
                'nisn' => $this->input->post('nisn'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'nik' => $this->input->post('nik'),
                'id_agama' => $this->input->post('id_agama'),
                'kebutuhan_khusus' => $this->input->post('kebutuhan_khusus'),
                'alamat' => $this->input->post('alamat'),
                'rt' => $this->input->post('rt'),
                'rw' => $this->input->post('rw'),
                'dusun' => $this->input->post('dusun'),
                'kelurahan' => $this->input->post('kelurahan'),
                'kecamatan' => $this->input->post('kecamatan'),
                'kode_pos' => $this->input->post('kode_pos'),
                'jenis_tinggal' => $this->input->post('jenis_tinggal'),
                'alat_transportasi' => $this->input->post('alat_transportasi'),
                'telepon' => $this->input->post('telepon'),
                'hp' => $this->input->post('hp'),
                'email' => $this->input->post('email'),
                'skhun' => $this->input->post('skhun'),
                'penerima_kps' => $this->input->post('penerima_kps'),
                'no_kps' => $this->input->post('no_kps'),
                'nama_ayah' => $this->input->post('nama_ayah'),
                'tahun_lahir_ayah' => $this->input->post('tahun_lahir_ayah'),
                'pendidikan_ayah' => $this->input->post('pendidikan_ayah'),
                'pekerjaan_ayah' => $this->input->post('pekerjaan_ayah'),
                'penghasilan_ayah' => $this->input->post('penghasilan_ayah'),
                'kebutuhan_khusus_ayah' => $this->input->post('kebutuhan_khusus_ayah'),
                'no_telpon_ayah' => $this->input->post('no_telpon_ayah'),
                'nama_ibu' => $this->input->post('nama_ibu'),
                'tahun_lahir_ibu' => $this->input->post('tahun_lahir_ibu'),
                'pendidikan_ibu' => $this->input->post('pendidikan_ibu'),
                'pekerjaan_ibu' => $this->input->post('pekerjaan_ibu'),
                'penghasilan_ibu' => $this->input->post('penghasilan_ibu'),
                'kebutuhan_khusus_ibu' => $this->input->post('kebutuhan_khusus_ibu'),
                'no_telpon_ibu' => $this->input->post('no_telpon_ibu'),
                'nama_wali' => $this->input->post('nama_wali'),
                'tahun_lahir_wali' => $this->input->post('tahun_lahir_wali'),
                'pendidikan_wali' => $this->input->post('pendidikan_wali'),
                'pekerjaan_wali' => $this->input->post('pekerjaan_wali'),
                'penghasilan_wali' => $this->input->post('penghasilan_wali'),
                'angkatan' => $this->input->post('angkatan'),
                'status_awal' => $this->input->post('status_awal'),
                'status_siswa' => $this->input->post('status_siswa'),
                'tingkat' => $this->input->post('tingkat'),
                // 'kode_kelas' => $this->input->post('kode_kelas'),
                'kode_jurusan' => $this->input->post('kode_jurusan'),
                'id_sesi' => $this->input->post('id_sesi'),
                'id_sekolah' => $this->input->post('kode_sekolah'),
            ];

            if (!is_dir(FCPATH . '/uploads/siswa/')) {
                mkdir(FCPATH . '/uploads/siswa/');
            }

            if (!empty($siswa_foto_uuid)) {
                $siswa_foto_name_copy = date('YmdHis') . '-' . $siswa_foto_name;

                rename(
                    FCPATH . 'uploads/tmp/' . $siswa_foto_uuid . '/' . $siswa_foto_name,
                    FCPATH . 'uploads/siswa/' . $siswa_foto_name_copy
                );

                if (!is_file(FCPATH . '/uploads/siswa/' . $siswa_foto_name_copy)) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Error uploading file'
                    ]);
                    exit;
                }

                $save_data['foto'] = $siswa_foto_name_copy;
            }


            $save_siswa = $this->model_siswa->change($id, $save_data);

            if ($save_siswa) {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = true;
                    $this->data['id']        = $id;
                    $this->data['message'] = cclang('success_update_data_stay', [
                        anchor('administrator/siswa', ' Go back to list')
                    ]);
                } else {
                    set_message(
                        cclang('success_update_data_redirect', []),
                        'success'
                    );

                    $this->data['success'] = true;
                    $this->data['redirect'] = base_url('administrator/siswa');
                }
            } else {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                } else {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                    $this->data['redirect'] = base_url('administrator/siswa');
                }
            }
        } else {
            $this->data['success'] = false;
            $this->data['message'] = validation_errors();
        }

        echo json_encode($this->data);
    }

    /**
     * delete Siswas
     *
     * @var $id String
     */
    public function delete($id)
    {
        $this->is_allowed('siswa_delete');

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
            set_message(cclang('has_been_deleted', 'siswa'), 'success');
        } else {
            set_message(cclang('error_delete', 'siswa'), 'error');
        }

        redirect_back();
    }

    /**
     * View view Siswas
     *
     * @var $id String
     */
    public function view($id)
    {
        $this->is_allowed('siswa_view');

        $this->data['siswa'] = $this->model_siswa->join_avaiable()->find($id);

        $this->template->title('Siswa Detail');
        $this->render('backend/standart/administrator/siswa/siswa_view', $this->data);
    }

    /**
     * delete Siswas
     *
     * @var $id String
     */
    private function _remove($id)
    {
        $siswa = $this->model_siswa->find($id);

        if (!empty($siswa->foto)) {
            $path = FCPATH . '/uploads/siswa/' . $siswa->foto;

            if (is_file($path)) {
                $delete_file = unlink($path);
            }
        }


        return $this->model_siswa->remove($id);
    }

    /**
     * Upload Image Siswa	* 
     * @return JSON
     */
    public function upload_foto_file()
    {
        if (!$this->is_allowed('siswa_add', false)) {
            echo json_encode([
                'success' => false,
                'message' => cclang('sorry_you_do_not_have_permission_to_access')
            ]);
            exit;
        }

        $uuid = $this->input->post('qquuid');

        echo $this->upload_file([
            'uuid'              => $uuid,
            'table_name'     => 'siswa',
            'allowed_types' => 'jpg',
            'max_size'          => 1024,
        ]);
    }

    /**
     * Delete Image Siswa	* 
     * @return JSON
     */
    public function delete_foto_file($uuid)
    {
        if (!$this->is_allowed('siswa_delete', false)) {
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
            'table_name'        => 'siswa',
            'primary_key'       => 'id_siswa',
            'upload_path'       => 'uploads/siswa/'
        ]);
    }

    /**
     * Get Image Siswa	* 
     * @return JSON
     */
    public function get_foto_file($id)
    {
        if (!$this->is_allowed('siswa_update', false)) {
            echo json_encode([
                'success' => false,
                'message' => 'Image not loaded, you do not have permission to access'
            ]);
            exit;
        }

        $siswa = $this->model_siswa->find($id);

        echo $this->get_file([
            'uuid'              => $id,
            'delete_by'         => 'id',
            'field_name'        => 'foto',
            'table_name'        => 'siswa',
            'primary_key'       => 'id_siswa',
            'upload_path'       => 'uploads/siswa/',
            'delete_endpoint'   => 'administrator/siswa/delete_foto_file'
        ]);
    }


    /**
     * Export to excel
     *
     * @return Files Excel .xls
     */
    public function export()
    {
        $this->is_allowed('siswa_export');

        $this->model_siswa->export('siswa', 'siswa');
    }

    /**
     * Export to PDF
     *
     * @return Files PDF .pdf
     */
    public function export_pdf()
    {
        $this->is_allowed('siswa_export');

        $this->model_siswa->pdf('siswa', 'siswa');
    }

  public function import()
	{
		$this->template->title('Import Siswa');
		$this->render('backend/standart/administrator/siswa/siswa_import');
	}

  public function upload_excel_file()
	{
		if (!$this->is_allowed('siswa_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'siswa',
		]);
	}

  public function add_save_upload()
	{
		if (!$this->is_allowed('siswa_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('import_excel_name', 'Upload Data Excel', 'trim|required');
		// echo "manuk lek 1";

		if ($this->form_validation->run() == false) {
			
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();

		} else {

			$import_excel_uuid = $this->input->post('import_excel_uuid');
			$import_excel_name = $this->input->post('import_excel_name');
			$import_excel_name_copy = date('YmdHis') . '-' . $import_excel_name;

            // var_dump($import_excel_name_copy);
            // die();
            // echo "manuk lek 2";

			$this->load->library('upload'); // Load librari upload
	
			$config['upload_path'] = rename(FCPATH . 'uploads/tmp/' . $import_excel_uuid . '/' . $import_excel_name, 
											FCPATH . 'excel/' . $import_excel_name_copy);
			$config['allowed_types'] = '';
			$config['max_size']	= '20048';
			$config['overwrite'] = true;
			// $config['file_name'] = $import_excel_name;
		
			$this->upload->initialize($config); 

			// include APPPATH.'third_party/PHPExcel/PHPExcel.php';
      require_once(APPPATH . "libraries/Excel/PHPExcel.php");
        // echo "manuk lek 3";

      $excelreader = new PHPExcel_Reader_Excel2007();
			$loadexcel = $excelreader->load('excel/'.$import_excel_name_copy); // Load file yang telah diupload ke folder excel
			$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
			
			// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
			$data = array();

            // echo "manuk lek 4";

			
			$numrow = 1;
			foreach($sheet as $row){
				// Cek $numrow apakah lebih dari 1
				// Artinya karena baris pertama adalah nama-nama kolom
				// Jadi dilewat saja, tidak usah diimport
				if($numrow > 1){
					// $data1 = $row['W'];
					// $id_kodesekolah = $this->model_siswa->get_id_kodesekolah($data1);
					
					// $data1 = $row['G'];
					// $id_indikator_pbp = $this->model_isian_amatan->get_id($data1);

					// $data2 = $row['K'];
					// $id_pengamat = $this->model_isian_amatan->get_id_pengamat($data2); 
					// var_dump($id_kodesekolah);
					// die;
					// Kita push (add) array data ke variabel data
					array_push($data, array(
						'nipd' => $row['A'],
                        'nama' => $row['B'],
                        'id_jenis_kelamin' => $row['C'],
                        'nisn' => $row['D'],
                        'tempat_lahir' => $row['E'],
                        'tanggal_lahir' => $row['F'],
                        'nik' => $row['G'],
                        'id_agama' => $row['H'],
                        'kebutuhan_khusus' => $row['I'],
                        'alamat' => $row['J'],
                        'rt' => $row['K'],
                        'rw' => $row['L'],
                        'dusun' => $row['M'],
                        'kelurahan' => $row['N'],
                        'kecamatan' => $row['O'],
                        'kode_pos' => $row['P'],
                        'jenis_tinggal' => $row['Q'],
                        'alat_transportasi' => $row['R'],
                        'telepon' => $row['S'],
                        'hp' => $row['T'],
                        'email' => $row['U'],
                        'skhun' => $row['V'],
                        'penerima_kps' => NULL,
                        'no_kps' => NULL,
                        'nama_ayah' => $row['W'],
                        'tahun_lahir_ayah' => $row['X'],
                        'pendidikan_ayah' => $row['Y'],
                        'pekerjaan_ayah' => $row['Z'],
                        'penghasilan_ayah' => $row['AA'],
                        'kebutuhan_khusus_ayah' => $row['AB'],
                        'no_telpon_ayah' => $row['AC'],
                        'nama_ibu' => $row['AD'],
                        'tahun_lahir_ibu' => $row['AE'],
                        'pendidikan_ibu' => $row['AF'],
                        'pekerjaan_ibu' => $row['AG'],
                        'penghasilan_ibu' => $row['AH'],
                        'kebutuhan_khusus_ibu' => $row['AI'],
                        'no_telpon_ibu' => $row['AJ'],
                        'nama_wali' => $row['AK'],
                        'tahun_lahir_wali' => $row['AL'],
                        'pendidikan_wali' => $row['AM'],
                        'pekerjaan_wali' => $row['AN'],
                        'penghasilan_wali' => $row['AO'],
                        'angkatan' => $row['AP'],
                        'status_awal' => NULL,
                        'status_siswa' => $row['AQ'],
                        'tingkat' => $row['AR'],
                        'kode_jurusan' => $row['AS'],
                        'gelombang' => $row['AT'],
                        'id_sekolah' => $row['AU'],
					));
				}
				
				$numrow++; // Tambah 1 setiap kali looping
			}

            // var_dump($data);
            // die();

			// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
			$this->model_siswa->insert_multiple($data);

			//delete file excel dari folder excel
      unlink(realpath('excel/'.$import_excel_name_copy));



			if ($this->input->post('save_type') == 'stay') {
				$this->data['success'] = true;
				// $this->data['id'] 	   = $save_sk_reviewer;
				$this->data['message'] = cclang('success_save_data_stay', [
					// anchor('administrator/sk_reviewer/edit/' . $save_sk_reviewer, 'Edit Sk Reviewer'),
					anchor('administrator/siswa', ' Go back to list')
				]);
			}

		}

		echo json_encode($this->data);
	}




}


/* End of file siswa.php */
/* Location: ./application/controllers/administrator/Siswa.php */
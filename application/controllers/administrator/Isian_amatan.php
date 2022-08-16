<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Isian Amatan Controller
*| --------------------------------------------------------------------------
*| Isian Amatan site
*|
*/
class Isian_amatan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_isian_amatan');
		$this->load->model('model_tindakan_bk');
	}

	/**
	* show all Isian Amatans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('isian_amatan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');
		$id_semester 	= $this->input->get('id_semester');

    if ($id_semester != null ) {
      $getBulanAwal		= $this->model_tindakan_bk->getBulanAwal($id_semester);
      $getTahunAwal		= $this->model_tindakan_bk->getTahunAwal($id_semester);
      $getBulanAkhir	= $this->model_tindakan_bk->getBulanAkhir($id_semester);
      // $getTahunAkhir	= $this->model_tindakan_bk->getTahunAkhir($id_semester);
    } else {
      $getBulanAwal		= null;
      $getTahunAwal		= null;
      $getBulanAkhir	= null;
      // $getTahunAkhir	= null;
    }

		$a = $this->session->groups;
		
		if ($a == 18) {

			$this->data['dataBK'] = $this->model_isian_amatan->getBKSMP($filter, $field, $this->limit_page, $offset, $getBulanAwal, $getTahunAwal, $getBulanAkhir);
			$this->data['isian_amatan_counts'] = $this->model_isian_amatan->count_allBKSMP($filter, $field, $getBulanAwal, $getTahunAwal, $getBulanAkhir);
			$this->data['id_semester'] =  $id_semester;
			$this->data['getBulanAwal'] =  $getBulanAwal;
			$this->data['getBulanAkhir'] =  $getBulanAkhir;
			$this->data['getTahunAwal'] =  $getTahunAwal;	

			$configBKSMP = [
				'base_url'     => 'administrator/isian_amatan/index/',
				'total_rows'   => $this->model_isian_amatan->count_allBKSMP($filter, $field, $getBulanAwal, $getTahunAwal, $getBulanAkhir),
				'per_page'     => $this->limit_page,
				'uri_segment'  => 4,
			];

			$this->data['pagination'] = $this->pagination($configBKSMP);

			$this->template->title('Isian Amatan List');

			$this->render('backend/standart/administrator/isian_amatan/isian_amatan_list_bk', $this->data);

		} else if ($a == 19) {

			$this->data['dataBK'] = $this->model_isian_amatan->getBKSMA($filter, $field, $this->limit_page, $offset, $getBulanAwal, $getTahunAwal, $getBulanAkhir);
			$this->data['isian_amatan_counts'] = $this->model_isian_amatan->count_allBKSMA($filter, $field, $getBulanAwal, $getTahunAwal, $getBulanAkhir);
			$this->data['id_semester'] =  $id_semester;
			$this->data['getBulanAwal'] =  $getBulanAwal;
			$this->data['getBulanAkhir'] =  $getBulanAkhir;
			$this->data['getTahunAwal'] =  $getTahunAwal;	

			$configBKSMA = [
				'base_url'     => 'administrator/isian_amatan/index/',
				'total_rows'   => $this->model_isian_amatan->count_allBKSMA($filter, $field, $getBulanAwal, $getTahunAwal, $getBulanAkhir),
				'per_page'     => $this->limit_page,
				'uri_segment'  => 4,
			];

			$this->data['pagination'] = $this->pagination($configBKSMA);

			$this->template->title('Isian Amatan List');

			$this->render('backend/standart/administrator/isian_amatan/isian_amatan_list_bk', $this->data);

		} else if ($a == 20) {

			$this->data['dataBK'] = $this->model_isian_amatan->getBKSMK($filter, $field, $this->limit_page, $offset, $getBulanAwal, $getTahunAwal, $getBulanAkhir);
			$this->data['isian_amatan_counts'] = $this->model_isian_amatan->count_allBKSMK($filter, $field, $getBulanAwal, $getTahunAwal, $getBulanAkhir);
			$this->data['id_semester'] =  $id_semester;
			$this->data['getBulanAwal'] =  $getBulanAwal;
			$this->data['getBulanAkhir'] =  $getBulanAkhir;
			$this->data['getTahunAwal'] =  $getTahunAwal;	

			$configBKSMK = [
				'base_url'     => 'administrator/isian_amatan/index/',
				'total_rows'   => $this->model_isian_amatan->count_allBKSMK($filter, $field, $getBulanAwal, $getTahunAwal, $getBulanAkhir),
				'per_page'     => $this->limit_page,
				'uri_segment'  => 4,
			];

			$this->data['pagination'] = $this->pagination($configBKSMK);

			$this->template->title('Isian Amatan List');

			$this->render('backend/standart/administrator/isian_amatan/isian_amatan_list_bk', $this->data);

		} else if ($a == 1 || $a == 7) {

			$this->data['isian_amatans'] = $this->model_isian_amatan->get($filter, $field, $this->limit_page, $offset);
			$this->data['isian_amatan_counts'] = $this->model_isian_amatan->count_all($filter, $field);

			$config = [
				'base_url'     => 'administrator/isian_amatan/index/',
				'total_rows'   => $this->model_isian_amatan->count_all($filter, $field),
				'per_page'     => $this->limit_page,
				'uri_segment'  => 4,
			];

			$this->data['pagination'] = $this->pagination($config);

			$this->template->title('Isian Amatan List');
			$this->render('backend/standart/administrator/isian_amatan/isian_amatan_list', $this->data);

		} else {

			$this->data['isian_amatans'] = $this->model_isian_amatan->get2($filter, $field, $this->limit_page, $offset);
			$this->data['isian_amatan_counts'] = $this->model_isian_amatan->count_all2($filter, $field);
			
			// var_dump($this->data['isian_amatans']); die;

			$config = [
				'base_url'     => 'administrator/isian_amatan/index/',
				'total_rows'   => $this->model_isian_amatan->count_all2($filter, $field),
				'per_page'     => $this->limit_page,
				'uri_segment'  => 4,
			];

			$this->data['pagination'] = $this->pagination($config);

			$this->template->title('Isian Amatan List');
			$this->render('backend/standart/administrator/isian_amatan/isian_amatan_list', $this->data);
			
		}
	}
	
	/**
	* Add new isian_amatans
	*
	*/
	public function add()
	{
		$this->is_allowed('isian_amatan_add');
    // $this->data['getMaxIdPeriode'] = $this->model_isian_amatan->maxIdPeriode();
    // var_dump($getMaxIdPeriode);
    // die;
		$this->template->title('Isian Amatan New');
		$this->render('backend/standart/administrator/isian_amatan/isian_amatan_add', $this->data);
	}

	/**
	* Add New Isian Amatans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('isian_amatan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
		$this->form_validation->set_rules('jam', 'Jam', 'trim|required');
		$this->form_validation->set_rules('minggu', 'Minggu', 'trim|required|max_length[5]');
		$this->form_validation->set_rules('id_kodesekolah', 'Kode Sekolah', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_siswa', 'No. Induk', 'trim|required|max_length[10]');
		$this->form_validation->set_rules('isi_amatan', 'Isian Amatan', 'trim|required|max_length[250]');
		$this->form_validation->set_rules('id_indikator_pbp', 'Kode Indikator', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('status_amatan', 'Status Amatan', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_lokasi_amatan', 'Lokasi Amatan', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_jenis_pengamat', 'Pengamat', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_pengamat', 'Nama Pengamat', 'trim|required|max_length[11]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'tanggal' => $this->input->post('tanggal'),
				'jam' => $this->input->post('jam'),
				'minggu' => $this->input->post('minggu'),
				'id_kodesekolah' => $this->input->post('id_kodesekolah'),
				'id_siswa' => $this->input->post('id_siswa'),
				'isi_amatan' => $this->input->post('isi_amatan'),
				'id_indikator_pbp' => $this->input->post('id_indikator_pbp'),
				'id_status_amatan' => $this->input->post('status_amatan'),
				'id_lokasi_amatan' => $this->input->post('id_lokasi_amatan'),
				'id_jenis_pengamat' => $this->input->post('id_jenis_pengamat'),
				'id_pengamat' => $this->input->post('id_pengamat'),
        'created_by' =>  $this->session->id,
				'created_at' => date("Y-m-d H:i:s"),
			];

			
			$save_isian_amatan = $this->model_isian_amatan->store($save_data);
			// var_dump($save_data);
			// die;

			if ($save_isian_amatan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_isian_amatan;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/isian_amatan/add', 'Add Isian Amatan'),
						anchor('administrator/isian_amatan', ' Go back to list')
					]);
					// $this->data['redirect'] = base_url('administrator/isian_amatan/add');
					
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/isian_amatan/edit/' . $save_isian_amatan, 'Edit Isian Amatan')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/isian_amatan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/isian_amatan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Isian Amatans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('isian_amatan_update');

		// Role guru SMP = 11
    // Role guru SMP = 12
    // Role guru SMP = 13
    $role = $this->session->groups;

    $all            = "4";
    $smk            = "3";
    $sma            = "2";
    $smp            = "1";

    if ($role == '11') {
      $this->data['kode_indikatorEdit'] = $this->model_isian_amatan->kode_indikatorSMPEdit($smk, $sma);
    }
    elseif ($role == '12') {
      $this->data['kode_indikatorEdit'] = $this->model_isian_amatan->kode_indikatorSMAEdit($smk, $smp);
    }
    elseif ($role == '13') { 
      $this->data['kode_indikatorEdit'] = $this->model_isian_amatan->kode_indikatorSMKEdit($sma, $smp);
     
    }
		
		$this->data['isian_amatan'] = $this->model_isian_amatan->find($id);

		$this->template->title('Isian Amatan Update');
		$this->render('backend/standart/administrator/isian_amatan/isian_amatan_update', $this->data);
	}

	/**
	* Update Isian Amatans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('isian_amatan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
		$this->form_validation->set_rules('jam', 'Jam', 'trim|required');
		$this->form_validation->set_rules('minggu', 'Minggu', 'trim|required|max_length[5]');
		$this->form_validation->set_rules('id_kodesekolah', 'Kode Sekolah', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_siswa', 'No. Induk', 'trim|required|max_length[10]');
		$this->form_validation->set_rules('isi_amatan', 'Isian Amatan', 'trim|required|max_length[250]');
		$this->form_validation->set_rules('id_indikator_pbp', 'Kode Indikator', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('status_amatan', 'Status Amatan', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_lokasi_amatan', 'Lokasi Amatan', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_jenis_pengamat', 'Pengamat', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_pengamat', 'Nama Pengamat', 'trim|required|max_length[11]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'tanggal' => $this->input->post('tanggal'),
				'jam' => $this->input->post('jam'),
				'minggu' => $this->input->post('minggu'),
				'id_kodesekolah' => $this->input->post('id_kodesekolah'),
				'id_siswa' => $this->input->post('id_siswa'),
				'isi_amatan' => $this->input->post('isi_amatan'),
				'id_indikator_pbp' => $this->input->post('id_indikator_pbp'),
				'id_status_amatan' => $this->input->post('status_amatan'),
				'id_lokasi_amatan' => $this->input->post('id_lokasi_amatan'),
				'id_jenis_pengamat' => $this->input->post('id_jenis_pengamat'),
				'id_pengamat' => $this->input->post('id_pengamat'),
        'updated_by' =>  $this->session->id,
				'updated_at' => date("Y-m-d H:i:s"),
			];

			
			$save_isian_amatan = $this->model_isian_amatan->change($id, $save_data);

			if ($save_isian_amatan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/isian_amatan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/isian_amatan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/isian_amatan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Isian Amatans
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('isian_amatan_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$remove = false;

		if (!empty($id)) {
			$remove = $this->_remove($id);
		} elseif (count($arr_id) >0) {
			foreach ($arr_id as $id) {
				$remove = $this->_remove($id);
			}
		}

		if ($remove) {
            set_message(cclang('has_been_deleted', 'isian_amatan'), 'success');
        } else {
            set_message(cclang('error_delete', 'isian_amatan'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Isian Amatans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('isian_amatan_view');

		$this->data['isian_amatan'] = $this->model_isian_amatan->join_avaiable()->find($id);

		$this->template->title('Isian Amatan Detail');
		$this->render('backend/standart/administrator/isian_amatan/isian_amatan_view', $this->data);
	}
	
	/**
	* delete Isian Amatans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$isian_amatan = $this->model_isian_amatan->find($id);

		
		
		return $this->model_isian_amatan->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function import()
	{

		$this->template->title('Import Isian Amatan');
		$this->render('backend/standart/administrator/isian_amatan/isian_amatan_import');
	}

	public function upload_excel_file()
	{
		if (!$this->is_allowed('isian_amatan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'isian_amatan',
		]);
	}

  
	public function add_save_upload()
	{
		if (!$this->is_allowed('isian_amatan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('import_excel_name', 'Upload Data Excel', 'trim|required');
		

		if ($this->form_validation->run() == false) {
			
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();

		} else {

			$import_excel_uuid = $this->input->post('import_excel_uuid');
			$import_excel_name = $this->input->post('import_excel_name');
			$import_excel_name_copy = date('YmdHis') . '-' . $import_excel_name;


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

    		$excelreader = new PHPExcel_Reader_Excel2007();
			$loadexcel = $excelreader->load('excel/'.$import_excel_name_copy); // Load file yang telah diupload ke folder excel
			$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
			
			// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
			$data = array();
			
			$numrow = 1;
			foreach($sheet as $row){
				// Cek $numrow apakah lebih dari 1
				// Artinya karena baris pertama adalah nama-nama kolom
				// Jadi dilewat saja, tidak usah diimport
				if($numrow > 1){
					$data3 = $row['E'];
					$id_siswa = $this->model_isian_amatan->get_id_siswa($data3);
					
					// $data1 = $row['G'];
					// $id_indikator_pbp = $this->model_isian_amatan->get_id($data1);

					$data2 = $row['K'];
					$id_pengamat = $this->model_isian_amatan->get_id_pengamat($data2); 
					// var_dump($data2);
					// die;
					// Kita push (add) array data ke variabel data
					array_push($data, array(
						'tanggal'=>$row['A'], // Insert data npm dari kolom A di excel
						'jam'=>$row['B'], // Insert data nama mahasiswa dari kolom B di excel
						'minggu'=>$row['C'], // Insert data jenis kelamin dari kolom C di excel
						'id_kodesekolah'=>$row['D'], // Insert data alamat dari kolom D di excel
						'id_siswa'=>$id_siswa, // Insert data npm dari kolom A di excel
						'isi_amatan'=>$row['F'], // Insert data nama mahasiswa dari kolom B di excel
						'id_indikator_pbp'=>$row['G'], // Insert data jenis kelamin dari kolom C di excel
						'id_status_amatan'=>$row['H'], // Insert data alamat dari kolom D di excel
						'id_lokasi_amatan'=>$row['I'], // Insert data npm dari kolom A di excel
						'id_jenis_pengamat'=>$row['J'], // Insert data nama mahasiswa dari kolom B di excel
						'id_pengamat'=>$id_pengamat, // Insert data jenis kelamin dari kolom C di excel
            'created_by' =>  $this->session->id,
				    'created_at' => date("Y-m-d H:i:s"),
					));
				}
				
				$numrow++; // Tambah 1 setiap kali looping
			}

			// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
			$this->model_isian_amatan->insert_multiple($data);

			//delete file excel dari folder excel
            unlink(realpath('excel/'.$import_excel_name_copy));



			if ($this->input->post('save_type') == 'stay') {
				$this->data['success'] = true;
				// $this->data['id'] 	   = $save_sk_reviewer;
				$this->data['message'] = cclang('success_save_data_stay', [
					// anchor('administrator/sk_reviewer/edit/' . $save_sk_reviewer, 'Edit Sk Reviewer'),
					anchor('administrator/isian_amatan', ' Go back to list')
				]);
			}

		}

		echo json_encode($this->data);
	}

	public function export()
	{
		$this->is_allowed('isian_amatan_export');

		$this->model_isian_amatan->export('isian_amatan', 'isian_amatan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('isian_amatan_export');

		$this->model_isian_amatan->pdf('isian_amatan', 'isian_amatan');
	}

  public function rekap()
	{
    $dataPerhalaman 		 = 10;
		$start 							 = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0  ;
		$this->data['start'] = $this->uri->segment(4);
		$idSmester	= 1;
    
		$bulanAwal  = $this->model_isian_amatan->getBulanAwal($idSmester);
    $bulanAkhir = $this->model_isian_amatan->getBulanAkhir($idSmester);
    $tahun 			= $this->model_isian_amatan->getTahun($idSmester);
		// $dataAmatanCount = $this->model_isian_amatan->rekap_amatan_indikator_excel_count($bulanAwal, $bulanAkhir, $tahun);

		// var_dump($dataAmatanCount);
		// die;

		$this->data['semesterSekarang'] = 

		$this->load->library('pagination');
        
		$config = [
				'base_url'         => site_url('administrator/isian_amatan/rekap/'),
				// 'total_rows'       => $this->model_isian_amatan->rekap_amatan_indikators_count_all(),
				'per_page'         => 10,
				'num_tag_open'     => '<li>',
				'num_tag_close'    => '</li>',
				'full_tag_open'    => '<ul class="pagination">',
				'full_tag_close'   => '</ul>',
				'first_link'       => 'First',
				'first_tag_open'   => '<li>',
				'first_tag_close'  => '</li>',
				'last_link'        => 'Last',
				'last_tag_open'    => '<li>',
				'last_tag_close'   => '</li>',
				'next_link'        => 'Next',
				'next_tag_open'    => '<li>',
				'next_tag_close'   => '</li>',
				'prev_link'        => 'Prev',
				'prev_tag_open'    => '<li>',
				'prev_tag_close'   => '</li>',
				'cur_tag_open'     => '<li class="active"><a href="#">',
				'cur_tag_close'    => '</a></li>',
				
		];

		$this->pagination->initialize($config);

		// $this->data['rekap_amatan_indikators'] = $this->model_isian_amatan->rekap_amatan_indikator($dataPerhalaman,	$start, $bulanAwal, $bulanAkhir, $tahun);
		// $this->data['get_jumlah_rekap_amatan_indikators'] = $this->model_isian_amatan->get_jumlah_rekap_amatan_indikator();
		// $this->data['rekap_amatan_indikators_counts'] = $this->model_isian_amatan->rekap_amatan_indikators_count_all();
		
    $this->template->title('Rekap Amatan');
		$this->render('backend/standart/administrator/isian_amatan/isian_amatan_rekap', $this->data);
	}

	public function excel_rekap_amatan_indikator($idSemester)
	{
		$semester 	= $this->model_isian_amatan->getSemester($idSemester);
		$tahunAjar 	= $this->model_isian_amatan->getTahunAjar($idSemester);
		$bulanAwal  = $this->model_isian_amatan->getBulanAwal($idSemester);
    $bulanAkhir = $this->model_isian_amatan->getBulanAkhir($idSemester);
    $tahun 			= $this->model_isian_amatan->getTahun($idSemester);

		$jumlah_positif_smp = 0;
		$jumlah_negatif_smp = 0;
		$jumlah_positif_sma = 0;
		$jumlah_negatif_sma = 0;
		$jumlah_positif_smk = 0;
		$jumlah_negatif_smk = 0;
		$total_jumlah       = 0;


		require_once(APPPATH . "libraries/Excel/PHPExcel.php");

		$excel = new PHPExcel();

		$excel->getProperties()	->setCreator('ICT UWP')
														->setLastModifiedBy('ICT UWP')
														->setTitle('Laporan Rekapitulasi Amatan')
														->setDescription('Laporan Rekapitulasi Amatan')
														->setKeywords('Laporan Rekapitulasi Amatan');
		$style_col = array(
			'font'		=> array('bold' => true),
			'alignment' => array(
				'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
			'borders' => array(
				'top'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'right'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'left'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
			)
		);

		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
			'borders' => array(
				'top'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'right'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'left'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
			)
		);

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "SEKOLAH WIJAYA PUTRA");
		$excel->getActiveSheet()->mergeCells('A1:I1');
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$excel->setActiveSheetIndex(0)->setCellValue('A2', "Rekapitulasi per Indikator Amatan");
		$excel->getActiveSheet()->mergeCells('A2:I2');
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(13);
		$excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$excel->setActiveSheetIndex(0)->setCellValue('A3', "Semester ".$semester." ".$tahunAjar);
		$excel->getActiveSheet()->mergeCells('A3:I3');
		$excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(13);
		$excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


		// baris untuk parsing data
		$excel->setActiveSheetIndex(0)->setCellValue('A5', "NO");
		$excel->getActiveSheet()->mergeCells('A5:A7');
		$excel->setActiveSheetIndex(0)->setCellValue('B5', "INDIKATOR AMATAN");
		$excel->getActiveSheet()->mergeCells('B5:B7');
		$excel->setActiveSheetIndex(0)->setCellValue('C5', "SISWA YANG DIAMATI");
		$excel->getActiveSheet()->mergeCells('C5:H5');
		$excel->setActiveSheetIndex(0)->setCellValue('C6', "SMP");
		$excel->getActiveSheet()->mergeCells('C6:D6');
		$excel->setActiveSheetIndex(0)->setCellValue('C7', "POSITIF");
		$excel->setActiveSheetIndex(0)->setCellValue('D7', "NEGATIF");	
		$excel->setActiveSheetIndex(0)->setCellValue('E6', "SMA");
		$excel->getActiveSheet()->mergeCells('E6:F6');
		$excel->setActiveSheetIndex(0)->setCellValue('E7', "POSITIF");
		$excel->setActiveSheetIndex(0)->setCellValue('F7', "NEGATIF");	
		$excel->setActiveSheetIndex(0)->setCellValue('G6', "SMK");
		$excel->getActiveSheet()->mergeCells('G6:H6');
		$excel->setActiveSheetIndex(0)->setCellValue('G7', "POSITIF");
		$excel->setActiveSheetIndex(0)->setCellValue('H7', "NEGATIF");
		$excel->setActiveSheetIndex(0)->setCellValue('I5', "JUMLAH");
		$excel->getActiveSheet()->mergeCells('I5:I7');

		$excel->getActiveSheet()->getStyle('A5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('A6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('A7')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B7')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C7')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D7')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E7')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F7')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G7')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H7')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I7')->applyFromArray($style_col);

		$dataAmatan = $this->model_isian_amatan->rekap_amatan_indikator_excel($bulanAwal, $bulanAkhir, $tahun);
		$getDataAmatanCount = $this->model_isian_amatan->rekap_amatan_indikator_excel_count($bulanAwal, $bulanAkhir, $tahun);
		$dataAmatanCount = $getDataAmatanCount + 8;
		$no = 1;
		$numrow = 8;
		foreach ($dataAmatan as $data) {
			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->indikator);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->positif_smp);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->negatif_smp);
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->positif_sma);
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->negatif_sma);
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->positif_smk);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->negatif_smk);
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->positif_smp+$data->negatif_smp+$data->positif_sma+$data->negatif_sma+$data->positif_smk+$data->negatif_smk);

			$jumlah_positif_smp += $data->positif_smp;
			$jumlah_negatif_smp += $data->negatif_smp;
			$jumlah_positif_sma += $data->positif_sma;
			$jumlah_negatif_sma += $data->negatif_sma;
			$jumlah_positif_smk += $data->positif_smk;
			$jumlah_negatif_smk += $data->negatif_smk;
			$total_jumlah       += $data->positif_smp+$data->negatif_smp+$data->positif_sma+$data->negatif_sma+$data->positif_smk+$data->negatif_smk;

			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
			
			$no++;
			$numrow++;
		}

		$excel->setActiveSheetIndex(0)->setCellValue('A'.$dataAmatanCount, "TOTAL AMATAN");
		$excel->getActiveSheet()->mergeCells('A'.$dataAmatanCount.':B'.$dataAmatanCount);
		$excel->getActiveSheet()->getStyle('A'.$dataAmatanCount)->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B'.$dataAmatanCount)->applyFromArray($style_col);
		$excel->setActiveSheetIndex(0)->setCellValue('C'.$dataAmatanCount, $jumlah_positif_smp);
		$excel->getActiveSheet()->getStyle('C'.$dataAmatanCount)->applyFromArray($style_col);
		$excel->setActiveSheetIndex(0)->setCellValue('D'.$dataAmatanCount, $jumlah_negatif_smp);
		$excel->getActiveSheet()->getStyle('D'.$dataAmatanCount)->applyFromArray($style_col);
		$excel->setActiveSheetIndex(0)->setCellValue('E'.$dataAmatanCount, $jumlah_positif_sma);
		$excel->getActiveSheet()->getStyle('E'.$dataAmatanCount)->applyFromArray($style_col);
		$excel->setActiveSheetIndex(0)->setCellValue('F'.$dataAmatanCount, $jumlah_negatif_sma);
		$excel->getActiveSheet()->getStyle('F'.$dataAmatanCount)->applyFromArray($style_col);
		$excel->setActiveSheetIndex(0)->setCellValue('G'.$dataAmatanCount, $jumlah_positif_smk);
		$excel->getActiveSheet()->getStyle('G'.$dataAmatanCount)->applyFromArray($style_col);
		$excel->setActiveSheetIndex(0)->setCellValue('H'.$dataAmatanCount, $jumlah_negatif_smk);
		$excel->getActiveSheet()->getStyle('H'.$dataAmatanCount)->applyFromArray($style_col);
		$excel->setActiveSheetIndex(0)->setCellValue('I'.$dataAmatanCount, $total_jumlah);
		$excel->getActiveSheet()->getStyle('I'.$dataAmatanCount)->applyFromArray($style_col);


		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(90);


		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$excel->getActiveSheet(0)->setTitle("Laporan Rekaputulasi Amatan");
		$excel->setActiveSheetIndex(0);

		$fileName = "Laporan Rekapitulasi Amatan -".date('d-m-Y').".xls";
		$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
		ob_end_clean();
		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$fileName);
		$objWriter->save('php://output');
	}

	public function excel_rekap_amatan_pengamat($idSemester)
	{
		$semester 	= $this->model_isian_amatan->getSemester($idSemester);
		$tahunAjar 	= $this->model_isian_amatan->getTahunAjar($idSemester);
		$bulanAwal  = $this->model_isian_amatan->getBulanAwal($idSemester);
    $bulanAkhir = $this->model_isian_amatan->getBulanAkhir($idSemester);
    $tahun 			= $this->model_isian_amatan->getTahun($idSemester);

		$jumlah_positif_smp = 0;
		$jumlah_negatif_smp = 0;
		$jumlah_positif_sma = 0;
		$jumlah_negatif_sma = 0;
		$jumlah_positif_smk = 0;
		$jumlah_negatif_smk = 0;
		$total_jumlah       = 0;


		require_once(APPPATH . "libraries/Excel/PHPExcel.php");

		$excel = new PHPExcel();

		$excel->getProperties()	->setCreator('ICT UWP')
														->setLastModifiedBy('ICT UWP')
														->setTitle('Laporan Rekapitulasi Amatan')
														->setDescription('Laporan Rekapitulasi Amatan')
														->setKeywords('Laporan Rekapitulasi Amatan');
		$style_col = array(
			'font'		=> array('bold' => true),
			'alignment' => array(
				'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
			'borders' => array(
				'top'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'right'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'left'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
			)
		);

		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
			'borders' => array(
				'top'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'right'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'left'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
			)
		);

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "SEKOLAH WIJAYA PUTRA");
		$excel->getActiveSheet()->mergeCells('A1:I1');
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$excel->setActiveSheetIndex(0)->setCellValue('A2', "Rekapitulasi per Pengamat");
		$excel->getActiveSheet()->mergeCells('A2:I2');
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(13);
		$excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$excel->setActiveSheetIndex(0)->setCellValue('A3', "Semester ".$semester." ".$tahunAjar);
		$excel->getActiveSheet()->mergeCells('A3:I3');
		$excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(13);
		$excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


		// baris untuk parsing data
		$excel->setActiveSheetIndex(0)->setCellValue('A5', "NO");
		$excel->getActiveSheet()->mergeCells('A5:A7');
		$excel->setActiveSheetIndex(0)->setCellValue('B5', "NAMA PENGAMAT");
		$excel->getActiveSheet()->mergeCells('B5:B7');
		$excel->setActiveSheetIndex(0)->setCellValue('C5', "SISWA YANG DIAMATI");
		$excel->getActiveSheet()->mergeCells('C5:H5');
		$excel->setActiveSheetIndex(0)->setCellValue('C6', "SMP");
		$excel->getActiveSheet()->mergeCells('C6:D6');
		$excel->setActiveSheetIndex(0)->setCellValue('C7', "POSITIF");
		$excel->setActiveSheetIndex(0)->setCellValue('D7', "NEGATIF");	
		$excel->setActiveSheetIndex(0)->setCellValue('E6', "SMA");
		$excel->getActiveSheet()->mergeCells('E6:F6');
		$excel->setActiveSheetIndex(0)->setCellValue('E7', "POSITIF");
		$excel->setActiveSheetIndex(0)->setCellValue('F7', "NEGATIF");	
		$excel->setActiveSheetIndex(0)->setCellValue('G6', "SMK");
		$excel->getActiveSheet()->mergeCells('G6:H6');
		$excel->setActiveSheetIndex(0)->setCellValue('G7', "POSITIF");
		$excel->setActiveSheetIndex(0)->setCellValue('H7', "NEGATIF");
		$excel->setActiveSheetIndex(0)->setCellValue('I5', "JUMLAH");
		$excel->getActiveSheet()->mergeCells('I5:I7');

		$excel->getActiveSheet()->getStyle('A5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('A6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('A7')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B7')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C7')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D7')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E7')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F7')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G7')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H7')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I7')->applyFromArray($style_col);

		$dataAmatan = $this->model_isian_amatan->rekap_amatan_pengamat_excel($bulanAwal, $bulanAkhir, $tahun);
		$getDataAmatanCount = $this->model_isian_amatan->rekap_amatan_pengamat_excel_count($bulanAwal, $bulanAkhir, $tahun);
		$dataAmatanCount = $getDataAmatanCount + 8;
		$no = 1;
		$numrow = 8;
		foreach ($dataAmatan as $data) {
			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->nama_guru);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->positif_smp);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->negatif_smp);
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->positif_sma);
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->negatif_sma);
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->positif_smk);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->negatif_smk);
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->positif_smp+$data->negatif_smp+$data->positif_sma+$data->negatif_sma+$data->positif_smk+$data->negatif_smk);

			$jumlah_positif_smp += $data->positif_smp;
			$jumlah_negatif_smp += $data->negatif_smp;
			$jumlah_positif_sma += $data->positif_sma;
			$jumlah_negatif_sma += $data->negatif_sma;
			$jumlah_positif_smk += $data->positif_smk;
			$jumlah_negatif_smk += $data->negatif_smk;
			$total_jumlah       += $data->positif_smp+$data->negatif_smp+$data->positif_sma+$data->negatif_sma+$data->positif_smk+$data->negatif_smk;

			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
			
			$no++;
			$numrow++;
		}

		$excel->setActiveSheetIndex(0)->setCellValue('A'.$dataAmatanCount, "TOTAL AMATAN");
		$excel->getActiveSheet()->mergeCells('A'.$dataAmatanCount.':B'.$dataAmatanCount);
		$excel->getActiveSheet()->getStyle('A'.$dataAmatanCount)->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B'.$dataAmatanCount)->applyFromArray($style_col);
		$excel->setActiveSheetIndex(0)->setCellValue('C'.$dataAmatanCount, $jumlah_positif_smp);
		$excel->getActiveSheet()->getStyle('C'.$dataAmatanCount)->applyFromArray($style_col);
		$excel->setActiveSheetIndex(0)->setCellValue('D'.$dataAmatanCount, $jumlah_negatif_smp);
		$excel->getActiveSheet()->getStyle('D'.$dataAmatanCount)->applyFromArray($style_col);
		$excel->setActiveSheetIndex(0)->setCellValue('E'.$dataAmatanCount, $jumlah_positif_sma);
		$excel->getActiveSheet()->getStyle('E'.$dataAmatanCount)->applyFromArray($style_col);
		$excel->setActiveSheetIndex(0)->setCellValue('F'.$dataAmatanCount, $jumlah_negatif_sma);
		$excel->getActiveSheet()->getStyle('F'.$dataAmatanCount)->applyFromArray($style_col);
		$excel->setActiveSheetIndex(0)->setCellValue('G'.$dataAmatanCount, $jumlah_positif_smk);
		$excel->getActiveSheet()->getStyle('G'.$dataAmatanCount)->applyFromArray($style_col);
		$excel->setActiveSheetIndex(0)->setCellValue('H'.$dataAmatanCount, $jumlah_negatif_smk);
		$excel->getActiveSheet()->getStyle('H'.$dataAmatanCount)->applyFromArray($style_col);
		$excel->setActiveSheetIndex(0)->setCellValue('I'.$dataAmatanCount, $total_jumlah);
		$excel->getActiveSheet()->getStyle('I'.$dataAmatanCount)->applyFromArray($style_col);


		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(40);


		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$excel->getActiveSheet(0)->setTitle("Laporan Rekaputulasi Amatan");
		$excel->setActiveSheetIndex(0);

		$fileName = "Laporan Rekapitulasi Amatan -".date('d-m-Y').".xls";
		$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
		ob_end_clean();
		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$fileName);
		$objWriter->save('php://output');
	}

	public function data_sekolah()
	{
		$id_sekolah = $this->input->post('id');
		$modul = $this->input->post('modul');
    $all            = "4";
    $smk            = "3";
    $sma            = "2";
    $smp            = "1";
    $getMaxIdPeriode = $this->model_isian_amatan->maxIdPeriode();

		if ($modul == 'sekolah') {
			echo $this->model_isian_amatan->sekolah($id_sekolah, $getMaxIdPeriode);
		}
    elseif ($modul == 'kode_indikator') {
      if ($id_sekolah == '1') {
        echo $this->model_isian_amatan->kode_indikatorSMP($smk, $sma);
      }
      elseif ($id_sekolah == '2') {
        echo $this->model_isian_amatan->kode_indikatorSMA($smk, $smp);
      }
      elseif ($id_sekolah == '3') {
        echo $this->model_isian_amatan->kode_indikatorSMK($sma, $smp);
      }
		}
	}
  

	public function data_siswa()
	{
		$id_siswa = $this->input->post('id');
		$modul = $this->input->post('modul');
		// log_message("ERROR",'aaaaa');

		if ($modul == 'nama_siswa') {
			echo $this->model_isian_amatan->nama_siswa($id_siswa);
		}
		elseif ($modul == 'kelas') {
			echo $this->model_isian_amatan->kelas($id_siswa);
		}
	}

	public function jenis_pengamat()
	{
		$id_jenis_pengamat = $this->input->post('id');
		$modul = $this->input->post('modul');
		// log_message("ERROR",'aaaaa');

		if ($id_jenis_pengamat == 1) {
			echo $this->model_isian_amatan->nama_pengamat_guru();
		} else {
			echo $this->model_isian_amatan->nama_pengamat_staf();
		}
	}

	public function view_detailbK($id_siswa, $id_semester = null)
	{
		$id_sekolah = $this->model_isian_amatan->getKodeSkolah($id_siswa);
		
		if ($id_semester != null ) {
      $getBulanAwal		= $this->model_tindakan_bk->getBulanAwal($id_semester);
      $getTahunAwal		= $this->model_tindakan_bk->getTahunAwal($id_semester);
      $getBulanAkhir	= $this->model_tindakan_bk->getBulanAkhir($id_semester);
      // $getTahunAkhir	= $this->model_tindakan_bk->getTahunAkhir($id_semester);
    } else {
      $getBulanAwal		= null;
      $getTahunAwal		= null;
      $getBulanAkhir	= null;
      // $getTahunAkhir	= null;
    }

		$this->data['id_siswa'] = $id_siswa;
		$this->data['id_semester'] =  $id_semester; 
		$this->data['isian_amatan_bk_details'] = $this->model_isian_amatan->isian_amatan_bk_detail($id_siswa, $id_sekolah, $getBulanAwal, $getTahunAwal, $getBulanAkhir);
		
		$this->data['tindakan_bks'] = $this->model_tindakan_bk->getDataBK($id_siswa, $getBulanAwal, $getTahunAwal, $getBulanAkhir);
		$this->data['tindakan_bk_counts'] = $this->model_tindakan_bk->count_allDataBK($id_siswa, $getBulanAwal, $getTahunAwal, $getBulanAkhir);

		
		$this->template->title('Isian Amatan Detail');
		$this->render('backend/standart/administrator/isian_amatan/isian_amatan_list_bk_detail', $this->data);
	}
}


/* End of file isian_amatan.php */
/* Location: ./application/controllers/administrator/Isian Amatan.php */
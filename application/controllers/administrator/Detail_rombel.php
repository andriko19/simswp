<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| Detail Rombel Controller
 *| --------------------------------------------------------------------------
 *| Detail Rombel site
 *|
 */
class Detail_rombel extends Admin
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_detail_rombel');
	}

	/**
	 * show all Detail Rombels
	 *
	 * @var $offset String
	 */
	public function index($offset = 0)
	{
		$this->is_allowed('detail_rombel_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['detail_rombels'] = $this->model_detail_rombel->get($filter, $field, $this->limit_page, $offset);
		$this->data['detail_rombel_counts'] = $this->model_detail_rombel->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/detail_rombel/index/',
			'total_rows'   => $this->model_detail_rombel->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Detail Rombel List');
		$this->render('backend/standart/administrator/detail_rombel/detail_rombel_list', $this->data);
	}

	/**
	 * Add new detail_rombels
	 *
	 */
	public function add($id)
	{
		$this->is_allowed('detail_rombel_add');

		$this->data['detail_rombel'] = $this->model_detail_rombel->get_detail_rombel($id);
		$this->data['rombel'] = $this->model_detail_rombel->get_rombel($id);
		$this->data['siswa_rombel'] = $this->model_detail_rombel->siswa_detail_rombel($id);
		$this->data['count_siswa_rombel'] = $this->model_detail_rombel->count_detail_rombel($id);


		$this->template->title('Detail Rombel');

		$this->render('backend/standart/administrator/detail_rombel/detail_rombel_add', $this->data);
	}

	/**
	 * Add New Detail Rombels
	 *
	 * @return JSON
	 */
	public function add_save()
	{
		if (!$this->is_allowed('detail_rombel_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
			]);
			exit;
		}

		$this->form_validation->set_rules('a', 'A', 'trim|max_length[11]');
		$this->form_validation->set_rules('id_rombel', 'Nama Rombel', 'trim|required');
		$this->form_validation->set_rules('id_siswa', 'Siswa', 'trim|required');


		if ($this->form_validation->run()) {

			$save_data = [
				'a' => $this->input->post('a'),
				'id_rombel' => $this->input->post('id_rombel'),
				'id_siswa' => $this->input->post('id_siswa'),
			];


			$save_detail_rombel = $this->model_detail_rombel->store($save_data);

			if ($save_detail_rombel) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_detail_rombel;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/detail_rombel/edit/' . $save_detail_rombel, 'Edit Detail Rombel'),
						anchor('administrator/detail_rombel', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
							anchor('administrator/detail_rombel/edit/' . $save_detail_rombel, 'Edit Detail Rombel')
						]),
						'success'
					);

					$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/detail_rombel');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/detail_rombel');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	 * Update view Detail Rombels
	 *
	 * @var $id String
	 */
	public function edit($id)
	{
		$this->is_allowed('detail_rombel_update');

		$this->data['detail_rombel'] = $this->model_detail_rombel->find($id);

		$this->template->title('Detail Rombel Update');
		$this->render('backend/standart/administrator/detail_rombel/detail_rombel_update', $this->data);
	}

	/**
	 * Update Detail Rombels
	 *
	 * @var $id String
	 */
	public function edit_save($id)
	{
		if (!$this->is_allowed('detail_rombel_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
			]);
			exit;
		}

		$this->form_validation->set_rules('a', 'A', 'trim|max_length[11]');
		$this->form_validation->set_rules('id_rombel', 'Nama Rombel', 'trim|required');
		$this->form_validation->set_rules('id_siswa', 'Siswa', 'trim|required');

		if ($this->form_validation->run()) {

			$save_data = [
				'a' => $this->input->post('a'),
				'id_rombel' => $this->input->post('id_rombel'),
				'id_siswa' => $this->input->post('id_siswa'),
			];


			$save_detail_rombel = $this->model_detail_rombel->change($id, $save_data);

			if ($save_detail_rombel) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/detail_rombel', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', []),
						'success'
					);

					$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/detail_rombel');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/detail_rombel');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	 * delete Detail Rombels
	 *
	 * @var $id String
	 */
	public function delete($id)
	{
		$this->is_allowed('detail_rombel_delete');

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
			set_message(cclang('has_been_deleted', 'detail_rombel'), 'success');
		} else {
			set_message(cclang('error_delete', 'detail_rombel'), 'error');
		}

		redirect_back();
	}

	/**
	 * View view Detail Rombels
	 *
	 * @var $id String
	 */
	public function view($id)
	{
		$this->is_allowed('detail_rombel_view');

		$this->data['detail_rombel'] = $this->model_detail_rombel->join_avaiable()->find($id);

		$this->template->title('Detail Rombel Detail');
		$this->render('backend/standart/administrator/detail_rombel/detail_rombel_view', $this->data);
	}

	public function detail($id)
	{
		$this->is_allowed('detail_rombel_view');

		$this->data['detail_rombel'] = $this->model_detail_rombel->get_detail_rombel($id);
		$this->data['siswa_rombel'] = $this->model_detail_rombel->siswa_detail_rombel($id);
		$this->data['count_siswa_rombel'] = $this->model_detail_rombel->count_detail_rombel($id);


		$this->template->title('Detail Rombel Detail');
		$this->render('backend/standart/administrator/detail_rombel/detail_rombel_all', $this->data);
	}
	public function data_siswa()
	{
		$id_sekolah = $this->input->post('id');
		$modul = $this->input->post('modul');
		// log_message("ERROR",'aaaaa');

		if ($modul == 'sekolah') {
			echo $this->model_detail_rombel->siswa($id_sekolah);
		}
	}

	/**
	 * delete Detail Rombels
	 *
	 * @var $id String
	 */
	private function _remove($id)
	{
		$detail_rombel = $this->model_detail_rombel->find($id);



		return $this->model_detail_rombel->remove($id);
	}

  public function import()
	{
		$this->template->title('Import Detail Rombel');
		$this->render('backend/standart/administrator/detail_rombel/detail_rombel_import');
	}

  public function upload_excel_file()
	{
		if (!$this->is_allowed('detail_rombel_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'detail_rombel',
		]);
	}

  public function add_save_upload()
	{
		if (!$this->is_allowed('detail_rombel_add', false)) {
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
					$data1 = $row['A']; //Kode kelas
          $data2 = $row['B']; //nama rombel
          $data3 = $row['C']; //periode
          $data4 = $row['D']; //nipd siswa

          $id_kode_sekolah =$this->model_detail_rombel->get_id_kode_sekolah($data1);
          $id_periode = $this->model_detail_rombel->get_id_periode($data3);

          $id_rombel = $this->model_detail_rombel->get_id_rombel($id_kode_sekolah, $data2, $id_periode); 


					$id_siswa = $this->model_detail_rombel->get_id_siswa($data4);
					
					// Kita push (add) array data ke variabel data
					array_push($data, array(
            'a' =>0,
						'id_rombel'=>$id_rombel, // Insert data alamat dari kolom D di excel
						'id_siswa'=>$id_siswa, // Insert data npm dari kolom A di excel
					));
				}
				
				$numrow++; // Tambah 1 setiap kali looping
			}

			// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
			$this->model_detail_rombel->insert_multiple($data);

			//delete file excel dari folder excel
      unlink(realpath('excel/'.$import_excel_name_copy));

			if ($this->input->post('save_type') == 'stay') {
				$this->data['success'] = true;
				// $this->data['id'] 	   = $save_sk_reviewer;
				$this->data['message'] = cclang('success_save_data_stay', [
					// anchor('administrator/sk_reviewer/edit/' . $save_sk_reviewer, 'Edit Sk Reviewer'),
					anchor('administrator/detail_rombel', ' Go back to list')
				]);
			}

		}

		echo json_encode($this->data);
	}

	/**
	 * Export to excel
	 *
	 * @return Files Excel .xls
	 */
	public function export()
	{
		$this->is_allowed('detail_rombel_export');

		$this->model_detail_rombel->export('detail_rombel', 'detail_rombel');
	}

	/**
	 * Export to PDF
	 *
	 * @return Files PDF .pdf
	 */
	public function export_pdf()
	{
		$this->is_allowed('detail_rombel_export');

		$this->model_detail_rombel->pdf('detail_rombel', 'detail_rombel');
	}

	public function save_siswa_baru()
	{
		// $this->is_allowed('detail_rombel_add');
		// $save_data = [
		// 	'id_rombel' => 3,
		// 	'id_siswa' => $this->input->post('id_siswa'),
		// ];

		// $this->model_detail_rombel->save_siswa($save_data);
		if (!$this->is_allowed('detail_rombel_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
			]);
			exit;
		}

		$this->form_validation->set_rules('a', 'A', 'trim|max_length[11]');
		$this->form_validation->set_rules('id_rombel', 'Nama Rombel', 'trim|required');
		$this->form_validation->set_rules('id_siswa', 'Siswa', 'trim|required');


		if ($this->form_validation->run()) {

			$save_data = [
				'a' => $this->input->post('a'),
				'id_rombel' => $this->input->post('id_rombel'),
				'id_siswa' => $this->input->post('id_siswa'),
			];


			$save_detail_rombel = $this->model_detail_rombel->store($save_data);

			if ($save_detail_rombel) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_detail_rombel;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/detail_rombel/edit/' . $save_detail_rombel, 'Edit Detail Rombel'),
						anchor('administrator/detail_rombel', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
							anchor('administrator/detail_rombel/edit/' . $save_detail_rombel, 'Edit Detail Rombel')
						]),
						'success'
					);

					$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/detail_rombel');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/detail_rombel');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	public function insert_siswa()
	{
		$data['message'] = $this->input->post('message');

		$insert = $this->model_detail_rombel->insertDataToDB($data);

		if ($insert) {
			//get the last entry data
			$content = $this->model_detail_rombel->getLastEnrtyData();
			echo $content->message;
		}
	}
}


/* End of file detail_rombel.php */
/* Location: ./application/controllers/administrator/Detail Rombel.php */
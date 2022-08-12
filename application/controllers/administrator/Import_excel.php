<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Import Excel Controller
*| --------------------------------------------------------------------------
*| Import Excel site
*|
*/
class Import_excel extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_import_excel');
	}

	/**
	* show all Import Excels
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('import_excel_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['import_excels'] = $this->model_import_excel->get($filter, $field, $this->limit_page, $offset);
		$this->data['import_excel_counts'] = $this->model_import_excel->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/import_excel/index/',
			'total_rows'   => $this->model_import_excel->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Import Excel List');
		$this->render('backend/standart/administrator/import_excel/import_excel_list', $this->data);
	}
	
	/**
	* Add new import_excels
	*
	*/
	public function add()
	{
		$this->is_allowed('import_excel_add');

		$this->template->title('Import Excel New');
		$this->render('backend/standart/administrator/import_excel/import_excel_add', $this->data);
	}

	/**
	* Add New Import Excels
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('import_excel_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('nama_file', 'Nama File', 'trim|required|max_length[150]');
		$this->form_validation->set_rules('import_excel_file_name', 'File', 'trim|required|max_length[250]');
		

		if ($this->form_validation->run()) {
			$import_excel_file_uuid = $this->input->post('import_excel_file_uuid');
			$import_excel_file_name = $this->input->post('import_excel_file_name');
		
			$save_data = [
				'nama_file' => $this->input->post('nama_file'),
			];

			if (!is_dir(FCPATH . '/uploads/import_excel/')) {
				mkdir(FCPATH . '/uploads/import_excel/');
			}

			if (!empty($import_excel_file_name)) {
				$import_excel_file_name_copy = date('YmdHis') . '-' . $import_excel_file_name;

				rename(FCPATH . 'uploads/tmp/' . $import_excel_file_uuid . '/' . $import_excel_file_name, 
						FCPATH . 'uploads/import_excel/' . $import_excel_file_name_copy);

				if (!is_file(FCPATH . '/uploads/import_excel/' . $import_excel_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $import_excel_file_name_copy;
			}
		
			
			$save_import_excel = $this->model_import_excel->store($save_data);

			if ($save_import_excel) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_import_excel;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/import_excel/edit/' . $save_import_excel, 'Edit Import Excel'),
						anchor('administrator/import_excel', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/import_excel/edit/' . $save_import_excel, 'Edit Import Excel')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/import_excel');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/import_excel');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Import Excels
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('import_excel_update');

		$this->data['import_excel'] = $this->model_import_excel->find($id);

		$this->template->title('Import Excel Update');
		$this->render('backend/standart/administrator/import_excel/import_excel_update', $this->data);
	}

	/**
	* Update Import Excels
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('import_excel_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('nama_file', 'Nama File', 'trim|required|max_length[150]');
		$this->form_validation->set_rules('import_excel_file_name', 'File', 'trim|required|max_length[250]');
		
		if ($this->form_validation->run()) {
			$import_excel_file_uuid = $this->input->post('import_excel_file_uuid');
			$import_excel_file_name = $this->input->post('import_excel_file_name');
		
			$save_data = [
				'nama_file' => $this->input->post('nama_file'),
			];

			if (!is_dir(FCPATH . '/uploads/import_excel/')) {
				mkdir(FCPATH . '/uploads/import_excel/');
			}

			if (!empty($import_excel_file_uuid)) {
				$import_excel_file_name_copy = date('YmdHis') . '-' . $import_excel_file_name;

				rename(FCPATH . 'uploads/tmp/' . $import_excel_file_uuid . '/' . $import_excel_file_name, 
						FCPATH . 'uploads/import_excel/' . $import_excel_file_name_copy);

				if (!is_file(FCPATH . '/uploads/import_excel/' . $import_excel_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $import_excel_file_name_copy;
			}
		
			
			$save_import_excel = $this->model_import_excel->change($id, $save_data);

			if ($save_import_excel) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/import_excel', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/import_excel');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/import_excel');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Import Excels
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('import_excel_delete');

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
            set_message(cclang('has_been_deleted', 'import_excel'), 'success');
        } else {
            set_message(cclang('error_delete', 'import_excel'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Import Excels
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('import_excel_view');

		$this->data['import_excel'] = $this->model_import_excel->join_avaiable()->find($id);

		$this->template->title('Import Excel Detail');
		$this->render('backend/standart/administrator/import_excel/import_excel_view', $this->data);
	}
	
	/**
	* delete Import Excels
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$import_excel = $this->model_import_excel->find($id);

		if (!empty($import_excel->file)) {
			$path = FCPATH . '/uploads/import_excel/' . $import_excel->file;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_import_excel->remove($id);
	}
	
	/**
	* Upload Image Import Excel	* 
	* @return JSON
	*/
	public function upload_file_file()
	{
		if (!$this->is_allowed('import_excel_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'import_excel',
		]);
	}

	/**
	* Delete Image Import Excel	* 
	* @return JSON
	*/
	public function delete_file_file($uuid)
	{
		if (!$this->is_allowed('import_excel_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'file', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'import_excel',
            'primary_key'       => 'id_import',
            'upload_path'       => 'uploads/import_excel/'
        ]);
	}

	/**
	* Get Image Import Excel	* 
	* @return JSON
	*/
	public function get_file_file($id)
	{
		if (!$this->is_allowed('import_excel_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$import_excel = $this->model_import_excel->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'file', 
            'table_name'        => 'import_excel',
            'primary_key'       => 'id_import',
            'upload_path'       => 'uploads/import_excel/',
            'delete_endpoint'   => 'administrator/import_excel/delete_file_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('import_excel_export');

		$this->model_import_excel->export('import_excel', 'import_excel');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('import_excel_export');

		$this->model_import_excel->pdf('import_excel', 'import_excel');
	}
}


/* End of file import_excel.php */
/* Location: ./application/controllers/administrator/Import Excel.php */
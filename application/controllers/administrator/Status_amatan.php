<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Status Amatan Controller
*| --------------------------------------------------------------------------
*| Status Amatan site
*|
*/
class Status_amatan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_status_amatan');
	}

	/**
	* show all Status Amatans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('status_amatan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['status_amatans'] = $this->model_status_amatan->get($filter, $field, $this->limit_page, $offset);
		$this->data['status_amatan_counts'] = $this->model_status_amatan->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/status_amatan/index/',
			'total_rows'   => $this->model_status_amatan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Status Amatan List');
		$this->render('backend/standart/administrator/status_amatan/status_amatan_list', $this->data);
	}
	
	/**
	* Add new status_amatans
	*
	*/
	public function add()
	{
		$this->is_allowed('status_amatan_add');

		$this->template->title('Status Amatan New');
		$this->render('backend/standart/administrator/status_amatan/status_amatan_add', $this->data);
	}

	/**
	* Add New Status Amatans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('status_amatan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('status_amatan', 'Status Amatan', 'trim|required|max_length[50]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'status_amatan' => $this->input->post('status_amatan'),
			];

			
			$save_status_amatan = $this->model_status_amatan->store($save_data);

			if ($save_status_amatan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_status_amatan;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/status_amatan/edit/' . $save_status_amatan, 'Edit Status Amatan'),
						anchor('administrator/status_amatan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/status_amatan/edit/' . $save_status_amatan, 'Edit Status Amatan')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/status_amatan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/status_amatan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Status Amatans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('status_amatan_update');

		$this->data['status_amatan'] = $this->model_status_amatan->find($id);

		$this->template->title('Status Amatan Update');
		$this->render('backend/standart/administrator/status_amatan/status_amatan_update', $this->data);
	}

	/**
	* Update Status Amatans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('status_amatan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('status_amatan', 'Status Amatan', 'trim|required|max_length[50]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'status_amatan' => $this->input->post('status_amatan'),
			];

			
			$save_status_amatan = $this->model_status_amatan->change($id, $save_data);

			if ($save_status_amatan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/status_amatan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/status_amatan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/status_amatan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Status Amatans
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('status_amatan_delete');

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
            set_message(cclang('has_been_deleted', 'status_amatan'), 'success');
        } else {
            set_message(cclang('error_delete', 'status_amatan'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Status Amatans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('status_amatan_view');

		$this->data['status_amatan'] = $this->model_status_amatan->join_avaiable()->find($id);

		$this->template->title('Status Amatan Detail');
		$this->render('backend/standart/administrator/status_amatan/status_amatan_view', $this->data);
	}
	
	/**
	* delete Status Amatans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$status_amatan = $this->model_status_amatan->find($id);

		
		
		return $this->model_status_amatan->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('status_amatan_export');

		$this->model_status_amatan->export('status_amatan', 'status_amatan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('status_amatan_export');

		$this->model_status_amatan->pdf('status_amatan', 'status_amatan');
	}
}


/* End of file status_amatan.php */
/* Location: ./application/controllers/administrator/Status Amatan.php */
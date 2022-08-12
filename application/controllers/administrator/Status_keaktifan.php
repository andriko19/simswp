<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Status Keaktifan Controller
*| --------------------------------------------------------------------------
*| Status Keaktifan site
*|
*/
class Status_keaktifan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_status_keaktifan');
	}

	/**
	* show all Status Keaktifans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('status_keaktifan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['status_keaktifans'] = $this->model_status_keaktifan->get($filter, $field, $this->limit_page, $offset);
		$this->data['status_keaktifan_counts'] = $this->model_status_keaktifan->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/status_keaktifan/index/',
			'total_rows'   => $this->model_status_keaktifan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Status Keaktifan List');
		$this->render('backend/standart/administrator/status_keaktifan/status_keaktifan_list', $this->data);
	}
	
	/**
	* Add new status_keaktifans
	*
	*/
	public function add()
	{
		$this->is_allowed('status_keaktifan_add');

		$this->template->title('Status Keaktifan New');
		$this->render('backend/standart/administrator/status_keaktifan/status_keaktifan_add', $this->data);
	}

	/**
	* Add New Status Keaktifans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('status_keaktifan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('status_keaktifan', 'Status Keaktifan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[80]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'status_keaktifan' => $this->input->post('status_keaktifan'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_status_keaktifan = $this->model_status_keaktifan->store($save_data);

			if ($save_status_keaktifan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_status_keaktifan;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/status_keaktifan/edit/' . $save_status_keaktifan, 'Edit Status Keaktifan'),
						anchor('administrator/status_keaktifan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/status_keaktifan/edit/' . $save_status_keaktifan, 'Edit Status Keaktifan')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/status_keaktifan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/status_keaktifan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Status Keaktifans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('status_keaktifan_update');

		$this->data['status_keaktifan'] = $this->model_status_keaktifan->find($id);

		$this->template->title('Status Keaktifan Update');
		$this->render('backend/standart/administrator/status_keaktifan/status_keaktifan_update', $this->data);
	}

	/**
	* Update Status Keaktifans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('status_keaktifan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('status_keaktifan', 'Status Keaktifan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[80]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'status_keaktifan' => $this->input->post('status_keaktifan'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_status_keaktifan = $this->model_status_keaktifan->change($id, $save_data);

			if ($save_status_keaktifan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/status_keaktifan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/status_keaktifan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/status_keaktifan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Status Keaktifans
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('status_keaktifan_delete');

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
            set_message(cclang('has_been_deleted', 'status_keaktifan'), 'success');
        } else {
            set_message(cclang('error_delete', 'status_keaktifan'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Status Keaktifans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('status_keaktifan_view');

		$this->data['status_keaktifan'] = $this->model_status_keaktifan->join_avaiable()->find($id);

		$this->template->title('Status Keaktifan Detail');
		$this->render('backend/standart/administrator/status_keaktifan/status_keaktifan_view', $this->data);
	}
	
	/**
	* delete Status Keaktifans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$status_keaktifan = $this->model_status_keaktifan->find($id);

		
		
		return $this->model_status_keaktifan->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('status_keaktifan_export');

		$this->model_status_keaktifan->export('status_keaktifan', 'status_keaktifan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('status_keaktifan_export');

		$this->model_status_keaktifan->pdf('status_keaktifan', 'status_keaktifan');
	}
}


/* End of file status_keaktifan.php */
/* Location: ./application/controllers/administrator/Status Keaktifan.php */
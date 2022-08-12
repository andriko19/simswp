<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Status Kepegawaian Controller
*| --------------------------------------------------------------------------
*| Status Kepegawaian site
*|
*/
class Status_kepegawaian extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_status_kepegawaian');
	}

	/**
	* show all Status Kepegawaians
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('status_kepegawaian_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['status_kepegawaians'] = $this->model_status_kepegawaian->get($filter, $field, $this->limit_page, $offset);
		$this->data['status_kepegawaian_counts'] = $this->model_status_kepegawaian->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/status_kepegawaian/index/',
			'total_rows'   => $this->model_status_kepegawaian->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Status Kepegawaian List');
		$this->render('backend/standart/administrator/status_kepegawaian/status_kepegawaian_list', $this->data);
	}
	
	/**
	* Add new status_kepegawaians
	*
	*/
	public function add()
	{
		$this->is_allowed('status_kepegawaian_add');

		$this->template->title('Status Kepegawaian New');
		$this->render('backend/standart/administrator/status_kepegawaian/status_kepegawaian_add', $this->data);
	}

	/**
	* Add New Status Kepegawaians
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('status_kepegawaian_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('status_kepegawaian', 'Status Kepegawaian', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[80]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'status_kepegawaian' => $this->input->post('status_kepegawaian'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_status_kepegawaian = $this->model_status_kepegawaian->store($save_data);

			if ($save_status_kepegawaian) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_status_kepegawaian;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/status_kepegawaian/edit/' . $save_status_kepegawaian, 'Edit Status Kepegawaian'),
						anchor('administrator/status_kepegawaian', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/status_kepegawaian/edit/' . $save_status_kepegawaian, 'Edit Status Kepegawaian')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/status_kepegawaian');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/status_kepegawaian');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Status Kepegawaians
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('status_kepegawaian_update');

		$this->data['status_kepegawaian'] = $this->model_status_kepegawaian->find($id);

		$this->template->title('Status Kepegawaian Update');
		$this->render('backend/standart/administrator/status_kepegawaian/status_kepegawaian_update', $this->data);
	}

	/**
	* Update Status Kepegawaians
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('status_kepegawaian_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('status_kepegawaian', 'Status Kepegawaian', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[80]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'status_kepegawaian' => $this->input->post('status_kepegawaian'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_status_kepegawaian = $this->model_status_kepegawaian->change($id, $save_data);

			if ($save_status_kepegawaian) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/status_kepegawaian', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/status_kepegawaian');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/status_kepegawaian');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Status Kepegawaians
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('status_kepegawaian_delete');

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
            set_message(cclang('has_been_deleted', 'status_kepegawaian'), 'success');
        } else {
            set_message(cclang('error_delete', 'status_kepegawaian'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Status Kepegawaians
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('status_kepegawaian_view');

		$this->data['status_kepegawaian'] = $this->model_status_kepegawaian->join_avaiable()->find($id);

		$this->template->title('Status Kepegawaian Detail');
		$this->render('backend/standart/administrator/status_kepegawaian/status_kepegawaian_view', $this->data);
	}
	
	/**
	* delete Status Kepegawaians
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$status_kepegawaian = $this->model_status_kepegawaian->find($id);

		
		
		return $this->model_status_kepegawaian->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('status_kepegawaian_export');

		$this->model_status_kepegawaian->export('status_kepegawaian', 'status_kepegawaian');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('status_kepegawaian_export');

		$this->model_status_kepegawaian->pdf('status_kepegawaian', 'status_kepegawaian');
	}
}


/* End of file status_kepegawaian.php */
/* Location: ./application/controllers/administrator/Status Kepegawaian.php */
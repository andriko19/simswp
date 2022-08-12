<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Status Pernikahan Controller
*| --------------------------------------------------------------------------
*| Status Pernikahan site
*|
*/
class Status_pernikahan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_status_pernikahan');
	}

	/**
	* show all Status Pernikahans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('status_pernikahan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['status_pernikahans'] = $this->model_status_pernikahan->get($filter, $field, $this->limit_page, $offset);
		$this->data['status_pernikahan_counts'] = $this->model_status_pernikahan->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/status_pernikahan/index/',
			'total_rows'   => $this->model_status_pernikahan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Status Pernikahan List');
		$this->render('backend/standart/administrator/status_pernikahan/status_pernikahan_list', $this->data);
	}
	
	/**
	* Add new status_pernikahans
	*
	*/
	public function add()
	{
		$this->is_allowed('status_pernikahan_add');

		$this->template->title('Status Pernikahan New');
		$this->render('backend/standart/administrator/status_pernikahan/status_pernikahan_add', $this->data);
	}

	/**
	* Add New Status Pernikahans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('status_pernikahan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('nama_statuspernikahan', 'Nama Statuspernikahan', 'trim|required|max_length[100]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'nama_statuspernikahan' => $this->input->post('nama_statuspernikahan'),
			];

			
			$save_status_pernikahan = $this->model_status_pernikahan->store($save_data);

			if ($save_status_pernikahan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_status_pernikahan;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/status_pernikahan/edit/' . $save_status_pernikahan, 'Edit Status Pernikahan'),
						anchor('administrator/status_pernikahan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/status_pernikahan/edit/' . $save_status_pernikahan, 'Edit Status Pernikahan')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/status_pernikahan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/status_pernikahan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Status Pernikahans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('status_pernikahan_update');

		$this->data['status_pernikahan'] = $this->model_status_pernikahan->find($id);

		$this->template->title('Status Pernikahan Update');
		$this->render('backend/standart/administrator/status_pernikahan/status_pernikahan_update', $this->data);
	}

	/**
	* Update Status Pernikahans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('status_pernikahan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('nama_statuspernikahan', 'Nama Statuspernikahan', 'trim|required|max_length[100]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'nama_statuspernikahan' => $this->input->post('nama_statuspernikahan'),
			];

			
			$save_status_pernikahan = $this->model_status_pernikahan->change($id, $save_data);

			if ($save_status_pernikahan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/status_pernikahan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/status_pernikahan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/status_pernikahan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Status Pernikahans
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('status_pernikahan_delete');

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
            set_message(cclang('has_been_deleted', 'status_pernikahan'), 'success');
        } else {
            set_message(cclang('error_delete', 'status_pernikahan'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Status Pernikahans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('status_pernikahan_view');

		$this->data['status_pernikahan'] = $this->model_status_pernikahan->join_avaiable()->find($id);

		$this->template->title('Status Pernikahan Detail');
		$this->render('backend/standart/administrator/status_pernikahan/status_pernikahan_view', $this->data);
	}
	
	/**
	* delete Status Pernikahans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$status_pernikahan = $this->model_status_pernikahan->find($id);

		
		
		return $this->model_status_pernikahan->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('status_pernikahan_export');

		$this->model_status_pernikahan->export('status_pernikahan', 'status_pernikahan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('status_pernikahan_export');

		$this->model_status_pernikahan->pdf('status_pernikahan', 'status_pernikahan');
	}
}


/* End of file status_pernikahan.php */
/* Location: ./application/controllers/administrator/Status Pernikahan.php */
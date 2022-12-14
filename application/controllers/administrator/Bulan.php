<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Bulan Controller
*| --------------------------------------------------------------------------
*| Bulan site
*|
*/
class Bulan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_bulan');
	}

	/**
	* show all Bulans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('bulan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['bulans'] = $this->model_bulan->get($filter, $field, $this->limit_page, $offset);
		$this->data['bulan_counts'] = $this->model_bulan->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/bulan/index/',
			'total_rows'   => $this->model_bulan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Bulan List');
		$this->render('backend/standart/administrator/bulan/bulan_list', $this->data);
	}
	
	/**
	* Add new bulans
	*
	*/
	public function add()
	{
		$this->is_allowed('bulan_add');

		$this->template->title('Bulan New');
		$this->render('backend/standart/administrator/bulan/bulan_add', $this->data);
	}

	/**
	* Add New Bulans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('bulan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('bulan', 'Bulan', 'trim|required|max_length[50]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'bulan' => $this->input->post('bulan'),
			];

			
			$save_bulan = $this->model_bulan->store($save_data);

			if ($save_bulan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_bulan;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/bulan/edit/' . $save_bulan, 'Edit Bulan'),
						anchor('administrator/bulan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/bulan/edit/' . $save_bulan, 'Edit Bulan')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/bulan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/bulan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Bulans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('bulan_update');

		$this->data['bulan'] = $this->model_bulan->find($id);

		$this->template->title('Bulan Update');
		$this->render('backend/standart/administrator/bulan/bulan_update', $this->data);
	}

	/**
	* Update Bulans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('bulan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('bulan', 'Bulan', 'trim|required|max_length[50]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'bulan' => $this->input->post('bulan'),
			];

			
			$save_bulan = $this->model_bulan->change($id, $save_data);

			if ($save_bulan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/bulan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/bulan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/bulan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Bulans
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('bulan_delete');

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
            set_message(cclang('has_been_deleted', 'bulan'), 'success');
        } else {
            set_message(cclang('error_delete', 'bulan'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Bulans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('bulan_view');

		$this->data['bulan'] = $this->model_bulan->join_avaiable()->find($id);

		$this->template->title('Bulan Detail');
		$this->render('backend/standart/administrator/bulan/bulan_view', $this->data);
	}
	
	/**
	* delete Bulans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$bulan = $this->model_bulan->find($id);

		
		
		return $this->model_bulan->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('bulan_export');

		$this->model_bulan->export('bulan', 'bulan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('bulan_export');

		$this->model_bulan->pdf('bulan', 'bulan');
	}
}


/* End of file bulan.php */
/* Location: ./application/controllers/administrator/Bulan.php */
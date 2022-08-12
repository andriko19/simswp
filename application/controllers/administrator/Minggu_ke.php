<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Minggu Ke Controller
*| --------------------------------------------------------------------------
*| Minggu Ke site
*|
*/
class Minggu_ke extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_minggu_ke');
	}

	/**
	* show all Minggu Kes
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('minggu_ke_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['minggu_kes'] = $this->model_minggu_ke->get($filter, $field, $this->limit_page, $offset);
		$this->data['minggu_ke_counts'] = $this->model_minggu_ke->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/minggu_ke/index/',
			'total_rows'   => $this->model_minggu_ke->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Minggu Ke List');
		$this->render('backend/standart/administrator/minggu_ke/minggu_ke_list', $this->data);
	}
	
	/**
	* Add new minggu_kes
	*
	*/
	public function add()
	{
		$this->is_allowed('minggu_ke_add');

		$this->template->title('Minggu Ke New');
		$this->render('backend/standart/administrator/minggu_ke/minggu_ke_add', $this->data);
	}

	/**
	* Add New Minggu Kes
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('minggu_ke_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('minggu_ke', 'Minggu Ke', 'trim|required|max_length[5]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'minggu_ke' => $this->input->post('minggu_ke'),
			];

			
			$save_minggu_ke = $this->model_minggu_ke->store($save_data);

			if ($save_minggu_ke) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_minggu_ke;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/minggu_ke/edit/' . $save_minggu_ke, 'Edit Minggu Ke'),
						anchor('administrator/minggu_ke', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/minggu_ke/edit/' . $save_minggu_ke, 'Edit Minggu Ke')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/minggu_ke');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/minggu_ke');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Minggu Kes
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('minggu_ke_update');

		$this->data['minggu_ke'] = $this->model_minggu_ke->find($id);

		$this->template->title('Minggu Ke Update');
		$this->render('backend/standart/administrator/minggu_ke/minggu_ke_update', $this->data);
	}

	/**
	* Update Minggu Kes
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('minggu_ke_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('minggu_ke', 'Minggu Ke', 'trim|required|max_length[5]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'minggu_ke' => $this->input->post('minggu_ke'),
			];

			
			$save_minggu_ke = $this->model_minggu_ke->change($id, $save_data);

			if ($save_minggu_ke) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/minggu_ke', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/minggu_ke');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/minggu_ke');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Minggu Kes
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('minggu_ke_delete');

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
            set_message(cclang('has_been_deleted', 'minggu_ke'), 'success');
        } else {
            set_message(cclang('error_delete', 'minggu_ke'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Minggu Kes
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('minggu_ke_view');

		$this->data['minggu_ke'] = $this->model_minggu_ke->join_avaiable()->find($id);

		$this->template->title('Minggu Ke Detail');
		$this->render('backend/standart/administrator/minggu_ke/minggu_ke_view', $this->data);
	}
	
	/**
	* delete Minggu Kes
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$minggu_ke = $this->model_minggu_ke->find($id);

		
		
		return $this->model_minggu_ke->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('minggu_ke_export');

		$this->model_minggu_ke->export('minggu_ke', 'minggu_ke');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('minggu_ke_export');

		$this->model_minggu_ke->pdf('minggu_ke', 'minggu_ke');
	}
}


/* End of file minggu_ke.php */
/* Location: ./application/controllers/administrator/Minggu Ke.php */
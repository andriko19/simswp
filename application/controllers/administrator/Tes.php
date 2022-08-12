<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Tes Controller
*| --------------------------------------------------------------------------
*| Tes site
*|
*/
class Tes extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tes');
	}

	/**
	* show all Tess
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('tes_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['tess'] = $this->model_tes->get($filter, $field, $this->limit_page, $offset);
		$this->data['tes_counts'] = $this->model_tes->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/tes/index/',
			'total_rows'   => $this->model_tes->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Tes List');
		$this->render('backend/standart/administrator/tes/tes_list', $this->data);
	}
	
	/**
	* Add new tess
	*
	*/
	public function add()
	{
		$this->is_allowed('tes_add');

		$this->template->title('Tes New');
		$this->render('backend/standart/administrator/tes/tes_add', $this->data);
	}

	/**
	* Add New Tess
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('tes_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('tes[]', 'Tes', 'trim|required|max_length[255]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'tes' => implode(',', (array) $this->input->post('tes')),
				'a' => $this->input->post('a'),
			];

			
			$save_tes = $this->model_tes->store($save_data);

			if ($save_tes) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_tes;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/tes/edit/' . $save_tes, 'Edit Tes'),
						anchor('administrator/tes', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/tes/edit/' . $save_tes, 'Edit Tes')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/tes');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/tes');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Tess
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('tes_update');

		$this->data['tes'] = $this->model_tes->find($id);

		$this->template->title('Tes Update');
		$this->render('backend/standart/administrator/tes/tes_update', $this->data);
	}

	/**
	* Update Tess
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('tes_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('tes[]', 'Tes', 'trim|required|max_length[255]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'tes' => implode(',', (array) $this->input->post('tes')),
				'a' => $this->input->post('a'),
			];

			
			$save_tes = $this->model_tes->change($id, $save_data);

			if ($save_tes) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/tes', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/tes');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/tes');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Tess
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('tes_delete');

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
            set_message(cclang('has_been_deleted', 'tes'), 'success');
        } else {
            set_message(cclang('error_delete', 'tes'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Tess
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('tes_view');

		$this->data['tes'] = $this->model_tes->join_avaiable()->find($id);

		$this->template->title('Tes Detail');
		$this->render('backend/standart/administrator/tes/tes_view', $this->data);
	}
	
	/**
	* delete Tess
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$tes = $this->model_tes->find($id);

		
		
		return $this->model_tes->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('tes_export');

		$this->model_tes->export('tes', 'tes');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('tes_export');

		$this->model_tes->pdf('tes', 'tes');
	}
}


/* End of file tes.php */
/* Location: ./application/controllers/administrator/Tes.php */
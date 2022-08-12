<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pilar Pbp Controller
*| --------------------------------------------------------------------------
*| Pilar Pbp site
*|
*/
class Pilar_pbp extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_pilar_pbp');
	}

	/**
	* show all Pilar Pbps
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('pilar_pbp_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['pilar_pbps'] = $this->model_pilar_pbp->get($filter, $field, $this->limit_page, $offset);
		$this->data['pilar_pbp_counts'] = $this->model_pilar_pbp->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/pilar_pbp/index/',
			'total_rows'   => $this->model_pilar_pbp->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Pilar Pbp List');
		$this->render('backend/standart/administrator/pilar_pbp/pilar_pbp_list', $this->data);
	}
	
	/**
	* Add new pilar_pbps
	*
	*/
	public function add()
	{
		$this->is_allowed('pilar_pbp_add');

		$this->template->title('Pilar Pbp New');
		$this->render('backend/standart/administrator/pilar_pbp/pilar_pbp_add', $this->data);
	}

	/**
	* Add New Pilar Pbps
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('pilar_pbp_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('pilar_pbp', 'Pilar Pbp', 'trim|required|max_length[50]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'pilar_pbp' => $this->input->post('pilar_pbp'),
			];

			
			$save_pilar_pbp = $this->model_pilar_pbp->store($save_data);

			if ($save_pilar_pbp) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_pilar_pbp;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/pilar_pbp/edit/' . $save_pilar_pbp, 'Edit Pilar Pbp'),
						anchor('administrator/pilar_pbp', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/pilar_pbp/edit/' . $save_pilar_pbp, 'Edit Pilar Pbp')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pilar_pbp');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pilar_pbp');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Pilar Pbps
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('pilar_pbp_update');

		$this->data['pilar_pbp'] = $this->model_pilar_pbp->find($id);

		$this->template->title('Pilar Pbp Update');
		$this->render('backend/standart/administrator/pilar_pbp/pilar_pbp_update', $this->data);
	}

	/**
	* Update Pilar Pbps
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('pilar_pbp_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('pilar_pbp', 'Pilar Pbp', 'trim|required|max_length[50]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'pilar_pbp' => $this->input->post('pilar_pbp'),
			];

			
			$save_pilar_pbp = $this->model_pilar_pbp->change($id, $save_data);

			if ($save_pilar_pbp) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/pilar_pbp', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pilar_pbp');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pilar_pbp');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Pilar Pbps
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('pilar_pbp_delete');

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
            set_message(cclang('has_been_deleted', 'pilar_pbp'), 'success');
        } else {
            set_message(cclang('error_delete', 'pilar_pbp'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Pilar Pbps
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('pilar_pbp_view');

		$this->data['pilar_pbp'] = $this->model_pilar_pbp->join_avaiable()->find($id);

		$this->template->title('Pilar Pbp Detail');
		$this->render('backend/standart/administrator/pilar_pbp/pilar_pbp_view', $this->data);
	}
	
	/**
	* delete Pilar Pbps
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$pilar_pbp = $this->model_pilar_pbp->find($id);

		
		
		return $this->model_pilar_pbp->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('pilar_pbp_export');

		$this->model_pilar_pbp->export('pilar_pbp', 'pilar_pbp');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('pilar_pbp_export');

		$this->model_pilar_pbp->pdf('pilar_pbp', 'pilar_pbp');
	}
}


/* End of file pilar_pbp.php */
/* Location: ./application/controllers/administrator/Pilar Pbp.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Dimensi Pbp Controller
*| --------------------------------------------------------------------------
*| Dimensi Pbp site
*|
*/
class Dimensi_pbp extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_dimensi_pbp');
	}

	/**
	* show all Dimensi Pbps
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('dimensi_pbp_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['dimensi_pbps'] = $this->model_dimensi_pbp->get($filter, $field, $this->limit_page, $offset);
		$this->data['dimensi_pbp_counts'] = $this->model_dimensi_pbp->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/dimensi_pbp/index/',
			'total_rows'   => $this->model_dimensi_pbp->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Dimensi Pbp List');
		$this->render('backend/standart/administrator/dimensi_pbp/dimensi_pbp_list', $this->data);
	}
	
	/**
	* Add new dimensi_pbps
	*
	*/
	public function add()
	{
		$this->is_allowed('dimensi_pbp_add');

		$this->template->title('Dimensi Pbp New');
		$this->render('backend/standart/administrator/dimensi_pbp/dimensi_pbp_add', $this->data);
	}

	/**
	* Add New Dimensi Pbps
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('dimensi_pbp_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('dimensi_pbp', 'Dimensi Pbp', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('id_pilar_pbp', 'Id Pilar Pbp', 'trim|required|max_length[11]');
    // $this->form_validation->set_rules('id_kodesekolah', 'Id Kode Sekolah', 'trim|required|max_length[11]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'dimensi_pbp' => $this->input->post('dimensi_pbp'),
				'id_pilar_pbp' => $this->input->post('id_pilar_pbp'),
        'id_kodesekolah' => 4,
			];

			
			$save_dimensi_pbp = $this->model_dimensi_pbp->store($save_data);

			if ($save_dimensi_pbp) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_dimensi_pbp;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/dimensi_pbp/edit/' . $save_dimensi_pbp, 'Edit Dimensi Pbp'),
						anchor('administrator/dimensi_pbp', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/dimensi_pbp/edit/' . $save_dimensi_pbp, 'Edit Dimensi Pbp')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dimensi_pbp');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dimensi_pbp');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Dimensi Pbps
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('dimensi_pbp_update');

		$this->data['dimensi_pbp'] = $this->model_dimensi_pbp->find($id);

		$this->template->title('Dimensi Pbp Update');
		$this->render('backend/standart/administrator/dimensi_pbp/dimensi_pbp_update', $this->data);
	}

	/**
	* Update Dimensi Pbps
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('dimensi_pbp_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('dimensi_pbp', 'Dimensi Pbp', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('id_pilar_pbp', 'Id Pilar Pbp', 'trim|required|max_length[11]');
    // $this->form_validation->set_rules('id_kodesekolah', 'Id Kode Sekolah', 'trim|required|max_length[11]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'dimensi_pbp' => $this->input->post('dimensi_pbp'),
				'id_pilar_pbp' => $this->input->post('id_pilar_pbp'),
        'id_kodesekolah' => 4,
			];

			
			$save_dimensi_pbp = $this->model_dimensi_pbp->change($id, $save_data);

			if ($save_dimensi_pbp) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/dimensi_pbp', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dimensi_pbp');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dimensi_pbp');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Dimensi Pbps
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('dimensi_pbp_delete');

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
            set_message(cclang('has_been_deleted', 'dimensi_pbp'), 'success');
        } else {
            set_message(cclang('error_delete', 'dimensi_pbp'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Dimensi Pbps
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('dimensi_pbp_view');

		$this->data['dimensi_pbp'] = $this->model_dimensi_pbp->join_avaiable()->find($id);

		$this->template->title('Dimensi Pbp Detail');
		$this->render('backend/standart/administrator/dimensi_pbp/dimensi_pbp_view', $this->data);
	}
	
	/**
	* delete Dimensi Pbps
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$dimensi_pbp = $this->model_dimensi_pbp->find($id);

		
		
		return $this->model_dimensi_pbp->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('dimensi_pbp_export');

		$this->model_dimensi_pbp->export('dimensi_pbp', 'dimensi_pbp');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('dimensi_pbp_export');

		$this->model_dimensi_pbp->pdf('dimensi_pbp', 'dimensi_pbp');
	}
}


/* End of file dimensi_pbp.php */
/* Location: ./application/controllers/administrator/Dimensi Pbp.php */
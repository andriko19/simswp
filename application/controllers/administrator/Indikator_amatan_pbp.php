<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Indikator Amatan Pbp Controller
*| --------------------------------------------------------------------------
*| Indikator Amatan Pbp site
*|
*/
class Indikator_amatan_pbp extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_indikator_amatan_pbp');
	}

	/**
	* show all Indikator Amatan Pbps
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('indikator_amatan_pbp_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['indikator_amatan_pbps'] = $this->model_indikator_amatan_pbp->get($filter, $field, $this->limit_page, $offset);
		$this->data['indikator_amatan_pbp_counts'] = $this->model_indikator_amatan_pbp->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/indikator_amatan_pbp/index/',
			'total_rows'   => $this->model_indikator_amatan_pbp->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Indikator Amatan Pbp List');
		$this->render('backend/standart/administrator/indikator_amatan_pbp/indikator_amatan_pbp_list', $this->data);
	}
	
	/**
	* Add new indikator_amatan_pbps
	*
	*/
	public function add()
	{
		$this->is_allowed('indikator_amatan_pbp_add');

		$this->template->title('Indikator Amatan Pbp New');
		$this->render('backend/standart/administrator/indikator_amatan_pbp/indikator_amatan_pbp_add', $this->data);
	}

	/**
	* Add New Indikator Amatan Pbps
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('indikator_amatan_pbp_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('kode_indikator', 'Kode Indikator', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('id_dimensi_pbp', 'Id Dimensi Pbp', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('indikator', 'Indikator', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('id_kodesekolah', 'Id Kode Sekolah', 'trim|required|max_length[11]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kode_indikator' => $this->input->post('kode_indikator'),
				'id_dimensi_pbp' => $this->input->post('id_dimensi_pbp'),
				'indikator' => $this->input->post('indikator'),
				'id_kodesekolah' => $this->input->post('id_kodesekolah'),
			];

			
			$save_indikator_amatan_pbp = $this->model_indikator_amatan_pbp->store($save_data);

			if ($save_indikator_amatan_pbp) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_indikator_amatan_pbp;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/indikator_amatan_pbp/edit/' . $save_indikator_amatan_pbp, 'Edit Indikator Amatan Pbp'),
						anchor('administrator/indikator_amatan_pbp', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/indikator_amatan_pbp/edit/' . $save_indikator_amatan_pbp, 'Edit Indikator Amatan Pbp')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/indikator_amatan_pbp');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/indikator_amatan_pbp');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Indikator Amatan Pbps
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('indikator_amatan_pbp_update');

		$this->data['indikator_amatan_pbp'] = $this->model_indikator_amatan_pbp->find($id);

		$this->template->title('Indikator Amatan Pbp Update');
		$this->render('backend/standart/administrator/indikator_amatan_pbp/indikator_amatan_pbp_update', $this->data);
	}

	/**
	* Update Indikator Amatan Pbps
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('indikator_amatan_pbp_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('kode_indikator', 'Kode Indikator', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('id_dimensi_pbp', 'Id Dimensi Pbp', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('indikator', 'Indikator', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('id_kodesekolah', 'Id Kode Sekolah', 'trim|required|max_length[11]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'kode_indikator' => $this->input->post('kode_indikator'),
				'id_dimensi_pbp' => $this->input->post('id_dimensi_pbp'),
				'indikator' => $this->input->post('indikator'),
				'id_kodesekolah' => $this->input->post('id_kodesekolah'),
			];

			
			$save_indikator_amatan_pbp = $this->model_indikator_amatan_pbp->change($id, $save_data);

			if ($save_indikator_amatan_pbp) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/indikator_amatan_pbp', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/indikator_amatan_pbp');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/indikator_amatan_pbp');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Indikator Amatan Pbps
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('indikator_amatan_pbp_delete');

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
            set_message(cclang('has_been_deleted', 'indikator_amatan_pbp'), 'success');
        } else {
            set_message(cclang('error_delete', 'indikator_amatan_pbp'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Indikator Amatan Pbps
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('indikator_amatan_pbp_view');

		$this->data['indikator_amatan_pbp'] = $this->model_indikator_amatan_pbp->join_avaiable()->find($id);

		$this->template->title('Indikator Amatan Pbp Detail');
		$this->render('backend/standart/administrator/indikator_amatan_pbp/indikator_amatan_pbp_view', $this->data);
	}
	
	/**
	* delete Indikator Amatan Pbps
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$indikator_amatan_pbp = $this->model_indikator_amatan_pbp->find($id);

		
		
		return $this->model_indikator_amatan_pbp->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('indikator_amatan_pbp_export');

		$this->model_indikator_amatan_pbp->export('indikator_amatan_pbp', 'indikator_amatan_pbp');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('indikator_amatan_pbp_export');

		$this->model_indikator_amatan_pbp->pdf('indikator_amatan_pbp', 'indikator_amatan_pbp');
	}
}


/* End of file indikator_amatan_pbp.php */
/* Location: ./application/controllers/administrator/Indikator Amatan Pbp.php */
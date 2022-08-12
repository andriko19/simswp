<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Periode Controller
*| --------------------------------------------------------------------------
*| Periode site
*|
*/
class Periode extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_periode');
	}

	/**
	* show all Periodes
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('periode_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['periodes'] = $this->model_periode->get($filter, $field, $this->limit_page, $offset);
		$this->data['periode_counts'] = $this->model_periode->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/periode/index/',
			'total_rows'   => $this->model_periode->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Periode List');
		$this->render('backend/standart/administrator/periode/periode_list', $this->data);
	}
	
	/**
	* Add new periodes
	*
	*/
	public function add()
	{
		$this->is_allowed('periode_add');

		$this->template->title('Periode New');
		$this->render('backend/standart/administrator/periode/periode_add', $this->data);
	}

	/**
	* Add New Periodes
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('periode_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('periode', 'Periode', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[80]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'periode' => $this->input->post('periode'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_periode = $this->model_periode->store($save_data);

			if ($save_periode) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_periode;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/periode/edit/' . $save_periode, 'Edit Periode'),
						anchor('administrator/periode', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/periode/edit/' . $save_periode, 'Edit Periode')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/periode');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/periode');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Periodes
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('periode_update');

		$this->data['periode'] = $this->model_periode->find($id);

		$this->template->title('Periode Update');
		$this->render('backend/standart/administrator/periode/periode_update', $this->data);
	}

	/**
	* Update Periodes
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('periode_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('periode', 'Periode', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[80]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'periode' => $this->input->post('periode'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_periode = $this->model_periode->change($id, $save_data);

			if ($save_periode) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/periode', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/periode');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/periode');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Periodes
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('periode_delete');

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
            set_message(cclang('has_been_deleted', 'periode'), 'success');
        } else {
            set_message(cclang('error_delete', 'periode'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Periodes
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('periode_view');

		$this->data['periode'] = $this->model_periode->join_avaiable()->find($id);

		$this->template->title('Periode Detail');
		$this->render('backend/standart/administrator/periode/periode_view', $this->data);
	}
	
	/**
	* delete Periodes
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$periode = $this->model_periode->find($id);

		
		
		return $this->model_periode->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('periode_export');

		$this->model_periode->export('periode', 'periode');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('periode_export');

		$this->model_periode->pdf('periode', 'periode');
	}
}


/* End of file periode.php */
/* Location: ./application/controllers/administrator/Periode.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Rekap Amatan Controller
*| --------------------------------------------------------------------------
*| Rekap Amatan site
*|
*/
class Rekap_amatan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_rekap_amatan');
	}

	/**
	* show all Rekap Amatans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('rekap_amatan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['rekap_amatans'] = $this->model_rekap_amatan->get($filter, $field, $this->limit_page, $offset);
		$this->data['rekap_amatan_counts'] = $this->model_rekap_amatan->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/rekap_amatan/index/',
			'total_rows'   => $this->model_rekap_amatan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Rekap Amatan List');
		$this->render('backend/standart/administrator/rekap_amatan/rekap_amatan_list', $this->data);
	}
	
	/**
	* Add new rekap_amatans
	*
	*/
	public function add()
	{
		$this->is_allowed('rekap_amatan_add');

		$this->template->title('Rekap Amatan New');
		$this->render('backend/standart/administrator/rekap_amatan/rekap_amatan_add', $this->data);
	}

	/**
	* Add New Rekap Amatans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('rekap_amatan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('rekap_amatan', 'Rekap Amatan', 'trim|required|max_length[50]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'rekap_amatan' => $this->input->post('rekap_amatan'),
			];

			
			$save_rekap_amatan = $this->model_rekap_amatan->store($save_data);

			if ($save_rekap_amatan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_rekap_amatan;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/rekap_amatan/edit/' . $save_rekap_amatan, 'Edit Rekap Amatan'),
						anchor('administrator/rekap_amatan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/rekap_amatan/edit/' . $save_rekap_amatan, 'Edit Rekap Amatan')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/rekap_amatan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/rekap_amatan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Rekap Amatans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('rekap_amatan_update');

		$this->data['rekap_amatan'] = $this->model_rekap_amatan->find($id);

		$this->template->title('Rekap Amatan Update');
		$this->render('backend/standart/administrator/rekap_amatan/rekap_amatan_update', $this->data);
	}

	/**
	* Update Rekap Amatans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('rekap_amatan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('rekap_amatan', 'Rekap Amatan', 'trim|required|max_length[50]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'rekap_amatan' => $this->input->post('rekap_amatan'),
			];

			
			$save_rekap_amatan = $this->model_rekap_amatan->change($id, $save_data);

			if ($save_rekap_amatan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/rekap_amatan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/rekap_amatan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/rekap_amatan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Rekap Amatans
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('rekap_amatan_delete');

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
            set_message(cclang('has_been_deleted', 'rekap_amatan'), 'success');
        } else {
            set_message(cclang('error_delete', 'rekap_amatan'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Rekap Amatans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('rekap_amatan_view');

		$this->data['rekap_amatan'] = $this->model_rekap_amatan->join_avaiable()->find($id);

		$this->template->title('Rekap Amatan Detail');
		$this->render('backend/standart/administrator/rekap_amatan/rekap_amatan_view', $this->data);
	}
	
	/**
	* delete Rekap Amatans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$rekap_amatan = $this->model_rekap_amatan->find($id);

		
		
		return $this->model_rekap_amatan->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('rekap_amatan_export');

		$this->model_rekap_amatan->export('rekap_amatan', 'rekap_amatan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('rekap_amatan_export');

		$this->model_rekap_amatan->pdf('rekap_amatan', 'rekap_amatan');
	}
}


/* End of file rekap_amatan.php */
/* Location: ./application/controllers/administrator/Rekap Amatan.php */
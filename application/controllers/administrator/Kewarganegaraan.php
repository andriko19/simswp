<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Kewarganegaraan Controller
*| --------------------------------------------------------------------------
*| Kewarganegaraan site
*|
*/
class Kewarganegaraan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_kewarganegaraan');
	}

	/**
	* show all Kewarganegaraans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('kewarganegaraan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['kewarganegaraans'] = $this->model_kewarganegaraan->get($filter, $field, $this->limit_page, $offset);
		$this->data['kewarganegaraan_counts'] = $this->model_kewarganegaraan->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/kewarganegaraan/index/',
			'total_rows'   => $this->model_kewarganegaraan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Kewarganegaraan List');
		$this->render('backend/standart/administrator/kewarganegaraan/kewarganegaraan_list', $this->data);
	}
	
	/**
	* Add new kewarganegaraans
	*
	*/
	public function add()
	{
		$this->is_allowed('kewarganegaraan_add');

		$this->template->title('Kewarganegaraan New');
		$this->render('backend/standart/administrator/kewarganegaraan/kewarganegaraan_add', $this->data);
	}

	/**
	* Add New Kewarganegaraans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('kewarganegaraan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('kewarganegaraan', 'Kewarganegaraan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[80]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kewarganegaraan' => $this->input->post('kewarganegaraan'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_kewarganegaraan = $this->model_kewarganegaraan->store($save_data);

			if ($save_kewarganegaraan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_kewarganegaraan;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/kewarganegaraan/edit/' . $save_kewarganegaraan, 'Edit Kewarganegaraan'),
						anchor('administrator/kewarganegaraan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/kewarganegaraan/edit/' . $save_kewarganegaraan, 'Edit Kewarganegaraan')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/kewarganegaraan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/kewarganegaraan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Kewarganegaraans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('kewarganegaraan_update');

		$this->data['kewarganegaraan'] = $this->model_kewarganegaraan->find($id);

		$this->template->title('Kewarganegaraan Update');
		$this->render('backend/standart/administrator/kewarganegaraan/kewarganegaraan_update', $this->data);
	}

	/**
	* Update Kewarganegaraans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('kewarganegaraan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('kewarganegaraan', 'Kewarganegaraan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[80]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'kewarganegaraan' => $this->input->post('kewarganegaraan'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_kewarganegaraan = $this->model_kewarganegaraan->change($id, $save_data);

			if ($save_kewarganegaraan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/kewarganegaraan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/kewarganegaraan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/kewarganegaraan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Kewarganegaraans
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('kewarganegaraan_delete');

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
            set_message(cclang('has_been_deleted', 'kewarganegaraan'), 'success');
        } else {
            set_message(cclang('error_delete', 'kewarganegaraan'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Kewarganegaraans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('kewarganegaraan_view');

		$this->data['kewarganegaraan'] = $this->model_kewarganegaraan->join_avaiable()->find($id);

		$this->template->title('Kewarganegaraan Detail');
		$this->render('backend/standart/administrator/kewarganegaraan/kewarganegaraan_view', $this->data);
	}
	
	/**
	* delete Kewarganegaraans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$kewarganegaraan = $this->model_kewarganegaraan->find($id);

		
		
		return $this->model_kewarganegaraan->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('kewarganegaraan_export');

		$this->model_kewarganegaraan->export('kewarganegaraan', 'kewarganegaraan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('kewarganegaraan_export');

		$this->model_kewarganegaraan->pdf('kewarganegaraan', 'kewarganegaraan');
	}
}


/* End of file kewarganegaraan.php */
/* Location: ./application/controllers/administrator/Kewarganegaraan.php */
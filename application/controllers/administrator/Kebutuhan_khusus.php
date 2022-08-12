<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Kebutuhan Khusus Controller
*| --------------------------------------------------------------------------
*| Kebutuhan Khusus site
*|
*/
class Kebutuhan_khusus extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_kebutuhan_khusus');
	}

	/**
	* show all Kebutuhan Khususs
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('kebutuhan_khusus_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['kebutuhan_khususs'] = $this->model_kebutuhan_khusus->get($filter, $field, $this->limit_page, $offset);
		$this->data['kebutuhan_khusus_counts'] = $this->model_kebutuhan_khusus->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/kebutuhan_khusus/index/',
			'total_rows'   => $this->model_kebutuhan_khusus->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Kebutuhan Khusus List');
		$this->render('backend/standart/administrator/kebutuhan_khusus/kebutuhan_khusus_list', $this->data);
	}
	
	/**
	* Add new kebutuhan_khususs
	*
	*/
	public function add()
	{
		$this->is_allowed('kebutuhan_khusus_add');

		$this->template->title('Kebutuhan Khusus New');
		$this->render('backend/standart/administrator/kebutuhan_khusus/kebutuhan_khusus_add', $this->data);
	}

	/**
	* Add New Kebutuhan Khususs
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('kebutuhan_khusus_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('kebutuhan_khusus', 'Kebutuhan Khusus', 'trim|required|max_length[150]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[80]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kebutuhan_khusus' => $this->input->post('kebutuhan_khusus'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_kebutuhan_khusus = $this->model_kebutuhan_khusus->store($save_data);

			if ($save_kebutuhan_khusus) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_kebutuhan_khusus;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/kebutuhan_khusus/edit/' . $save_kebutuhan_khusus, 'Edit Kebutuhan Khusus'),
						anchor('administrator/kebutuhan_khusus', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/kebutuhan_khusus/edit/' . $save_kebutuhan_khusus, 'Edit Kebutuhan Khusus')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/kebutuhan_khusus');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/kebutuhan_khusus');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Kebutuhan Khususs
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('kebutuhan_khusus_update');

		$this->data['kebutuhan_khusus'] = $this->model_kebutuhan_khusus->find($id);

		$this->template->title('Kebutuhan Khusus Update');
		$this->render('backend/standart/administrator/kebutuhan_khusus/kebutuhan_khusus_update', $this->data);
	}

	/**
	* Update Kebutuhan Khususs
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('kebutuhan_khusus_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('kebutuhan_khusus', 'Kebutuhan Khusus', 'trim|required|max_length[150]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[80]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'kebutuhan_khusus' => $this->input->post('kebutuhan_khusus'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_kebutuhan_khusus = $this->model_kebutuhan_khusus->change($id, $save_data);

			if ($save_kebutuhan_khusus) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/kebutuhan_khusus', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/kebutuhan_khusus');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/kebutuhan_khusus');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Kebutuhan Khususs
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('kebutuhan_khusus_delete');

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
            set_message(cclang('has_been_deleted', 'kebutuhan_khusus'), 'success');
        } else {
            set_message(cclang('error_delete', 'kebutuhan_khusus'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Kebutuhan Khususs
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('kebutuhan_khusus_view');

		$this->data['kebutuhan_khusus'] = $this->model_kebutuhan_khusus->join_avaiable()->find($id);

		$this->template->title('Kebutuhan Khusus Detail');
		$this->render('backend/standart/administrator/kebutuhan_khusus/kebutuhan_khusus_view', $this->data);
	}
	
	/**
	* delete Kebutuhan Khususs
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$kebutuhan_khusus = $this->model_kebutuhan_khusus->find($id);

		
		
		return $this->model_kebutuhan_khusus->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('kebutuhan_khusus_export');

		$this->model_kebutuhan_khusus->export('kebutuhan_khusus', 'kebutuhan_khusus');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('kebutuhan_khusus_export');

		$this->model_kebutuhan_khusus->pdf('kebutuhan_khusus', 'kebutuhan_khusus');
	}
}


/* End of file kebutuhan_khusus.php */
/* Location: ./application/controllers/administrator/Kebutuhan Khusus.php */
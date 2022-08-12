<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Jenis Ptk Controller
*| --------------------------------------------------------------------------
*| Jenis Ptk site
*|
*/
class Jenis_ptk extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_jenis_ptk');
	}

	/**
	* show all Jenis Ptks
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('jenis_ptk_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['jenis_ptks'] = $this->model_jenis_ptk->get($filter, $field, $this->limit_page, $offset);
		$this->data['jenis_ptk_counts'] = $this->model_jenis_ptk->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/jenis_ptk/index/',
			'total_rows'   => $this->model_jenis_ptk->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Jenis Ptk List');
		$this->render('backend/standart/administrator/jenis_ptk/jenis_ptk_list', $this->data);
	}
	
	/**
	* Add new jenis_ptks
	*
	*/
	public function add()
	{
		$this->is_allowed('jenis_ptk_add');

		$this->template->title('Jenis Ptk New');
		$this->render('backend/standart/administrator/jenis_ptk/jenis_ptk_add', $this->data);
	}

	/**
	* Add New Jenis Ptks
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('jenis_ptk_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('jenis_ptk', 'Jenis Ptk', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[80]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'jenis_ptk' => $this->input->post('jenis_ptk'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_jenis_ptk = $this->model_jenis_ptk->store($save_data);

			if ($save_jenis_ptk) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_jenis_ptk;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/jenis_ptk/edit/' . $save_jenis_ptk, 'Edit Jenis Ptk'),
						anchor('administrator/jenis_ptk', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/jenis_ptk/edit/' . $save_jenis_ptk, 'Edit Jenis Ptk')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/jenis_ptk');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/jenis_ptk');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Jenis Ptks
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('jenis_ptk_update');

		$this->data['jenis_ptk'] = $this->model_jenis_ptk->find($id);

		$this->template->title('Jenis Ptk Update');
		$this->render('backend/standart/administrator/jenis_ptk/jenis_ptk_update', $this->data);
	}

	/**
	* Update Jenis Ptks
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('jenis_ptk_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('jenis_ptk', 'Jenis Ptk', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[80]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'jenis_ptk' => $this->input->post('jenis_ptk'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_jenis_ptk = $this->model_jenis_ptk->change($id, $save_data);

			if ($save_jenis_ptk) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/jenis_ptk', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/jenis_ptk');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/jenis_ptk');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Jenis Ptks
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('jenis_ptk_delete');

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
            set_message(cclang('has_been_deleted', 'jenis_ptk'), 'success');
        } else {
            set_message(cclang('error_delete', 'jenis_ptk'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Jenis Ptks
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('jenis_ptk_view');

		$this->data['jenis_ptk'] = $this->model_jenis_ptk->join_avaiable()->find($id);

		$this->template->title('Jenis Ptk Detail');
		$this->render('backend/standart/administrator/jenis_ptk/jenis_ptk_view', $this->data);
	}
	
	/**
	* delete Jenis Ptks
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$jenis_ptk = $this->model_jenis_ptk->find($id);

		
		
		return $this->model_jenis_ptk->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('jenis_ptk_export');

		$this->model_jenis_ptk->export('jenis_ptk', 'jenis_ptk');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('jenis_ptk_export');

		$this->model_jenis_ptk->pdf('jenis_ptk', 'jenis_ptk');
	}
}


/* End of file jenis_ptk.php */
/* Location: ./application/controllers/administrator/Jenis Ptk.php */
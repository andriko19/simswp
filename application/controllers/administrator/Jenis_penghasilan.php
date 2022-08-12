<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Jenis Penghasilan Controller
*| --------------------------------------------------------------------------
*| Jenis Penghasilan site
*|
*/
class Jenis_penghasilan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_jenis_penghasilan');
	}

	/**
	* show all Jenis Penghasilans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('jenis_penghasilan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['jenis_penghasilans'] = $this->model_jenis_penghasilan->get($filter, $field, $this->limit_page, $offset);
		$this->data['jenis_penghasilan_counts'] = $this->model_jenis_penghasilan->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/jenis_penghasilan/index/',
			'total_rows'   => $this->model_jenis_penghasilan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Jenis Penghasilan List');
		$this->render('backend/standart/administrator/jenis_penghasilan/jenis_penghasilan_list', $this->data);
	}
	
	/**
	* Add new jenis_penghasilans
	*
	*/
	public function add()
	{
		$this->is_allowed('jenis_penghasilan_add');

		$this->template->title('Jenis Penghasilan New');
		$this->render('backend/standart/administrator/jenis_penghasilan/jenis_penghasilan_add', $this->data);
	}

	/**
	* Add New Jenis Penghasilans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('jenis_penghasilan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('jenis_penghasilan', 'Jenis Penghasilan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[80]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'jenis_penghasilan' => $this->input->post('jenis_penghasilan'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_jenis_penghasilan = $this->model_jenis_penghasilan->store($save_data);

			if ($save_jenis_penghasilan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_jenis_penghasilan;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/jenis_penghasilan/edit/' . $save_jenis_penghasilan, 'Edit Jenis Penghasilan'),
						anchor('administrator/jenis_penghasilan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/jenis_penghasilan/edit/' . $save_jenis_penghasilan, 'Edit Jenis Penghasilan')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/jenis_penghasilan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/jenis_penghasilan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Jenis Penghasilans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('jenis_penghasilan_update');

		$this->data['jenis_penghasilan'] = $this->model_jenis_penghasilan->find($id);

		$this->template->title('Jenis Penghasilan Update');
		$this->render('backend/standart/administrator/jenis_penghasilan/jenis_penghasilan_update', $this->data);
	}

	/**
	* Update Jenis Penghasilans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('jenis_penghasilan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('jenis_penghasilan', 'Jenis Penghasilan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[80]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'jenis_penghasilan' => $this->input->post('jenis_penghasilan'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_jenis_penghasilan = $this->model_jenis_penghasilan->change($id, $save_data);

			if ($save_jenis_penghasilan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/jenis_penghasilan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/jenis_penghasilan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/jenis_penghasilan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Jenis Penghasilans
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('jenis_penghasilan_delete');

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
            set_message(cclang('has_been_deleted', 'jenis_penghasilan'), 'success');
        } else {
            set_message(cclang('error_delete', 'jenis_penghasilan'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Jenis Penghasilans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('jenis_penghasilan_view');

		$this->data['jenis_penghasilan'] = $this->model_jenis_penghasilan->join_avaiable()->find($id);

		$this->template->title('Jenis Penghasilan Detail');
		$this->render('backend/standart/administrator/jenis_penghasilan/jenis_penghasilan_view', $this->data);
	}
	
	/**
	* delete Jenis Penghasilans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$jenis_penghasilan = $this->model_jenis_penghasilan->find($id);

		
		
		return $this->model_jenis_penghasilan->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('jenis_penghasilan_export');

		$this->model_jenis_penghasilan->export('jenis_penghasilan', 'jenis_penghasilan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('jenis_penghasilan_export');

		$this->model_jenis_penghasilan->pdf('jenis_penghasilan', 'jenis_penghasilan');
	}
}


/* End of file jenis_penghasilan.php */
/* Location: ./application/controllers/administrator/Jenis Penghasilan.php */
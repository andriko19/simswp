<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Jenis Tinggal Controller
*| --------------------------------------------------------------------------
*| Jenis Tinggal site
*|
*/
class Jenis_tinggal extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_jenis_tinggal');
	}

	/**
	* show all Jenis Tinggals
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('jenis_tinggal_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['jenis_tinggals'] = $this->model_jenis_tinggal->get($filter, $field, $this->limit_page, $offset);
		$this->data['jenis_tinggal_counts'] = $this->model_jenis_tinggal->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/jenis_tinggal/index/',
			'total_rows'   => $this->model_jenis_tinggal->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Jenis Tinggal List');
		$this->render('backend/standart/administrator/jenis_tinggal/jenis_tinggal_list', $this->data);
	}
	
	/**
	* Add new jenis_tinggals
	*
	*/
	public function add()
	{
		$this->is_allowed('jenis_tinggal_add');

		$this->template->title('Jenis Tinggal New');
		$this->render('backend/standart/administrator/jenis_tinggal/jenis_tinggal_add', $this->data);
	}

	/**
	* Add New Jenis Tinggals
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('jenis_tinggal_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('jenis_tinggal', 'Jenis Tinggal', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[80]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'jenis_tinggal' => $this->input->post('jenis_tinggal'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_jenis_tinggal = $this->model_jenis_tinggal->store($save_data);

			if ($save_jenis_tinggal) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_jenis_tinggal;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/jenis_tinggal/edit/' . $save_jenis_tinggal, 'Edit Jenis Tinggal'),
						anchor('administrator/jenis_tinggal', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/jenis_tinggal/edit/' . $save_jenis_tinggal, 'Edit Jenis Tinggal')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/jenis_tinggal');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/jenis_tinggal');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Jenis Tinggals
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('jenis_tinggal_update');

		$this->data['jenis_tinggal'] = $this->model_jenis_tinggal->find($id);

		$this->template->title('Jenis Tinggal Update');
		$this->render('backend/standart/administrator/jenis_tinggal/jenis_tinggal_update', $this->data);
	}

	/**
	* Update Jenis Tinggals
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('jenis_tinggal_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('jenis_tinggal', 'Jenis Tinggal', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[80]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'jenis_tinggal' => $this->input->post('jenis_tinggal'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_jenis_tinggal = $this->model_jenis_tinggal->change($id, $save_data);

			if ($save_jenis_tinggal) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/jenis_tinggal', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/jenis_tinggal');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/jenis_tinggal');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Jenis Tinggals
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('jenis_tinggal_delete');

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
            set_message(cclang('has_been_deleted', 'jenis_tinggal'), 'success');
        } else {
            set_message(cclang('error_delete', 'jenis_tinggal'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Jenis Tinggals
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('jenis_tinggal_view');

		$this->data['jenis_tinggal'] = $this->model_jenis_tinggal->join_avaiable()->find($id);

		$this->template->title('Jenis Tinggal Detail');
		$this->render('backend/standart/administrator/jenis_tinggal/jenis_tinggal_view', $this->data);
	}
	
	/**
	* delete Jenis Tinggals
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$jenis_tinggal = $this->model_jenis_tinggal->find($id);

		
		
		return $this->model_jenis_tinggal->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('jenis_tinggal_export');

		$this->model_jenis_tinggal->export('jenis_tinggal', 'jenis_tinggal');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('jenis_tinggal_export');

		$this->model_jenis_tinggal->pdf('jenis_tinggal', 'jenis_tinggal');
	}
}


/* End of file jenis_tinggal.php */
/* Location: ./application/controllers/administrator/Jenis Tinggal.php */
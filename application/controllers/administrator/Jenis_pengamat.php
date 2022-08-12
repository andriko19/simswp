<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Jenis Pengamat Controller
*| --------------------------------------------------------------------------
*| Jenis Pengamat site
*|
*/
class Jenis_pengamat extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_jenis_pengamat');
	}

	/**
	* show all Jenis Pengamats
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('jenis_pengamat_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['jenis_pengamats'] = $this->model_jenis_pengamat->get($filter, $field, $this->limit_page, $offset);
		$this->data['jenis_pengamat_counts'] = $this->model_jenis_pengamat->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/jenis_pengamat/index/',
			'total_rows'   => $this->model_jenis_pengamat->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Jenis Pengamat List');
		$this->render('backend/standart/administrator/jenis_pengamat/jenis_pengamat_list', $this->data);
	}
	
	/**
	* Add new jenis_pengamats
	*
	*/
	public function add()
	{
		$this->is_allowed('jenis_pengamat_add');

		$this->template->title('Jenis Pengamat New');
		$this->render('backend/standart/administrator/jenis_pengamat/jenis_pengamat_add', $this->data);
	}

	/**
	* Add New Jenis Pengamats
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('jenis_pengamat_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('jenis_pengamat', 'Jenis Pengamat', 'trim|required|max_length[50]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'jenis_pengamat' => $this->input->post('jenis_pengamat'),
			];

			
			$save_jenis_pengamat = $this->model_jenis_pengamat->store($save_data);

			if ($save_jenis_pengamat) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_jenis_pengamat;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/jenis_pengamat/edit/' . $save_jenis_pengamat, 'Edit Jenis Pengamat'),
						anchor('administrator/jenis_pengamat', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/jenis_pengamat/edit/' . $save_jenis_pengamat, 'Edit Jenis Pengamat')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/jenis_pengamat');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/jenis_pengamat');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Jenis Pengamats
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('jenis_pengamat_update');

		$this->data['jenis_pengamat'] = $this->model_jenis_pengamat->find($id);

		$this->template->title('Jenis Pengamat Update');
		$this->render('backend/standart/administrator/jenis_pengamat/jenis_pengamat_update', $this->data);
	}

	/**
	* Update Jenis Pengamats
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('jenis_pengamat_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('jenis_pengamat', 'Jenis Pengamat', 'trim|required|max_length[50]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'jenis_pengamat' => $this->input->post('jenis_pengamat'),
			];

			
			$save_jenis_pengamat = $this->model_jenis_pengamat->change($id, $save_data);

			if ($save_jenis_pengamat) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/jenis_pengamat', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/jenis_pengamat');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/jenis_pengamat');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Jenis Pengamats
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('jenis_pengamat_delete');

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
            set_message(cclang('has_been_deleted', 'jenis_pengamat'), 'success');
        } else {
            set_message(cclang('error_delete', 'jenis_pengamat'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Jenis Pengamats
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('jenis_pengamat_view');

		$this->data['jenis_pengamat'] = $this->model_jenis_pengamat->join_avaiable()->find($id);

		$this->template->title('Jenis Pengamat Detail');
		$this->render('backend/standart/administrator/jenis_pengamat/jenis_pengamat_view', $this->data);
	}
	
	/**
	* delete Jenis Pengamats
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$jenis_pengamat = $this->model_jenis_pengamat->find($id);

		
		
		return $this->model_jenis_pengamat->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('jenis_pengamat_export');

		$this->model_jenis_pengamat->export('jenis_pengamat', 'jenis_pengamat');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('jenis_pengamat_export');

		$this->model_jenis_pengamat->pdf('jenis_pengamat', 'jenis_pengamat');
	}
}


/* End of file jenis_pengamat.php */
/* Location: ./application/controllers/administrator/Jenis Pengamat.php */
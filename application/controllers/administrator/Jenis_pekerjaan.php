<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Jenis Pekerjaan Controller
*| --------------------------------------------------------------------------
*| Jenis Pekerjaan site
*|
*/
class Jenis_pekerjaan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_jenis_pekerjaan');
	}

	/**
	* show all Jenis Pekerjaans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('jenis_pekerjaan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['jenis_pekerjaans'] = $this->model_jenis_pekerjaan->get($filter, $field, $this->limit_page, $offset);
		$this->data['jenis_pekerjaan_counts'] = $this->model_jenis_pekerjaan->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/jenis_pekerjaan/index/',
			'total_rows'   => $this->model_jenis_pekerjaan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Jenis Pekerjaan List');
		$this->render('backend/standart/administrator/jenis_pekerjaan/jenis_pekerjaan_list', $this->data);
	}
	
	/**
	* Add new jenis_pekerjaans
	*
	*/
	public function add()
	{
		$this->is_allowed('jenis_pekerjaan_add');

		$this->template->title('Jenis Pekerjaan New');
		$this->render('backend/standart/administrator/jenis_pekerjaan/jenis_pekerjaan_add', $this->data);
	}

	/**
	* Add New Jenis Pekerjaans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('jenis_pekerjaan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('jenis_pekerjaan', 'Jenis Pekerjaan', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[80]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'jenis_pekerjaan' => $this->input->post('jenis_pekerjaan'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_jenis_pekerjaan = $this->model_jenis_pekerjaan->store($save_data);

			if ($save_jenis_pekerjaan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_jenis_pekerjaan;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/jenis_pekerjaan/edit/' . $save_jenis_pekerjaan, 'Edit Jenis Pekerjaan'),
						anchor('administrator/jenis_pekerjaan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/jenis_pekerjaan/edit/' . $save_jenis_pekerjaan, 'Edit Jenis Pekerjaan')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/jenis_pekerjaan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/jenis_pekerjaan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Jenis Pekerjaans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('jenis_pekerjaan_update');

		$this->data['jenis_pekerjaan'] = $this->model_jenis_pekerjaan->find($id);

		$this->template->title('Jenis Pekerjaan Update');
		$this->render('backend/standart/administrator/jenis_pekerjaan/jenis_pekerjaan_update', $this->data);
	}

	/**
	* Update Jenis Pekerjaans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('jenis_pekerjaan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('jenis_pekerjaan', 'Jenis Pekerjaan', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[80]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'jenis_pekerjaan' => $this->input->post('jenis_pekerjaan'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_jenis_pekerjaan = $this->model_jenis_pekerjaan->change($id, $save_data);

			if ($save_jenis_pekerjaan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/jenis_pekerjaan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/jenis_pekerjaan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/jenis_pekerjaan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Jenis Pekerjaans
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('jenis_pekerjaan_delete');

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
            set_message(cclang('has_been_deleted', 'jenis_pekerjaan'), 'success');
        } else {
            set_message(cclang('error_delete', 'jenis_pekerjaan'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Jenis Pekerjaans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('jenis_pekerjaan_view');

		$this->data['jenis_pekerjaan'] = $this->model_jenis_pekerjaan->join_avaiable()->find($id);

		$this->template->title('Jenis Pekerjaan Detail');
		$this->render('backend/standart/administrator/jenis_pekerjaan/jenis_pekerjaan_view', $this->data);
	}
	
	/**
	* delete Jenis Pekerjaans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$jenis_pekerjaan = $this->model_jenis_pekerjaan->find($id);

		
		
		return $this->model_jenis_pekerjaan->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('jenis_pekerjaan_export');

		$this->model_jenis_pekerjaan->export('jenis_pekerjaan', 'jenis_pekerjaan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('jenis_pekerjaan_export');

		$this->model_jenis_pekerjaan->pdf('jenis_pekerjaan', 'jenis_pekerjaan');
	}
}


/* End of file jenis_pekerjaan.php */
/* Location: ./application/controllers/administrator/Jenis Pekerjaan.php */
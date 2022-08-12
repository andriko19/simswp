<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Golongan Controller
*| --------------------------------------------------------------------------
*| Golongan site
*|
*/
class Golongan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_golongan');
	}

	/**
	* show all Golongans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('golongan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['golongans'] = $this->model_golongan->get($filter, $field, $this->limit_page, $offset);
		$this->data['golongan_counts'] = $this->model_golongan->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/golongan/index/',
			'total_rows'   => $this->model_golongan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Golongan List');
		$this->render('backend/standart/administrator/golongan/golongan_list', $this->data);
	}
	
	/**
	* Add new golongans
	*
	*/
	public function add()
	{
		$this->is_allowed('golongan_add');

		$this->template->title('Golongan New');
		$this->render('backend/standart/administrator/golongan/golongan_add', $this->data);
	}

	/**
	* Add New Golongans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('golongan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('golongan', 'Golongan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[80]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'golongan' => $this->input->post('golongan'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_golongan = $this->model_golongan->store($save_data);

			if ($save_golongan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_golongan;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/golongan/edit/' . $save_golongan, 'Edit Golongan'),
						anchor('administrator/golongan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/golongan/edit/' . $save_golongan, 'Edit Golongan')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/golongan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/golongan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Golongans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('golongan_update');

		$this->data['golongan'] = $this->model_golongan->find($id);

		$this->template->title('Golongan Update');
		$this->render('backend/standart/administrator/golongan/golongan_update', $this->data);
	}

	/**
	* Update Golongans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('golongan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('golongan', 'Golongan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[80]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'golongan' => $this->input->post('golongan'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_golongan = $this->model_golongan->change($id, $save_data);

			if ($save_golongan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/golongan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/golongan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/golongan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Golongans
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('golongan_delete');

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
            set_message(cclang('has_been_deleted', 'golongan'), 'success');
        } else {
            set_message(cclang('error_delete', 'golongan'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Golongans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('golongan_view');

		$this->data['golongan'] = $this->model_golongan->join_avaiable()->find($id);

		$this->template->title('Golongan Detail');
		$this->render('backend/standart/administrator/golongan/golongan_view', $this->data);
	}
	
	/**
	* delete Golongans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$golongan = $this->model_golongan->find($id);

		
		
		return $this->model_golongan->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('golongan_export');

		$this->model_golongan->export('golongan', 'golongan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('golongan_export');

		$this->model_golongan->pdf('golongan', 'golongan');
	}
}


/* End of file golongan.php */
/* Location: ./application/controllers/administrator/Golongan.php */
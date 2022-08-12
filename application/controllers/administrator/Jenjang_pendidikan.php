<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Jenjang Pendidikan Controller
*| --------------------------------------------------------------------------
*| Jenjang Pendidikan site
*|
*/
class Jenjang_pendidikan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_jenjang_pendidikan');
	}

	/**
	* show all Jenjang Pendidikans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('jenjang_pendidikan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['jenjang_pendidikans'] = $this->model_jenjang_pendidikan->get($filter, $field, $this->limit_page, $offset);
		$this->data['jenjang_pendidikan_counts'] = $this->model_jenjang_pendidikan->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/jenjang_pendidikan/index/',
			'total_rows'   => $this->model_jenjang_pendidikan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Jenjang Pendidikan List');
		$this->render('backend/standart/administrator/jenjang_pendidikan/jenjang_pendidikan_list', $this->data);
	}
	
	/**
	* Add new jenjang_pendidikans
	*
	*/
	public function add()
	{
		$this->is_allowed('jenjang_pendidikan_add');

		$this->template->title('Jenjang Pendidikan New');
		$this->render('backend/standart/administrator/jenjang_pendidikan/jenjang_pendidikan_add', $this->data);
	}

	/**
	* Add New Jenjang Pendidikans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('jenjang_pendidikan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('jenjang_pendidikan', 'Jenjang Pendidikan', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[80]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'jenjang_pendidikan' => $this->input->post('jenjang_pendidikan'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_jenjang_pendidikan = $this->model_jenjang_pendidikan->store($save_data);

			if ($save_jenjang_pendidikan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_jenjang_pendidikan;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/jenjang_pendidikan/edit/' . $save_jenjang_pendidikan, 'Edit Jenjang Pendidikan'),
						anchor('administrator/jenjang_pendidikan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/jenjang_pendidikan/edit/' . $save_jenjang_pendidikan, 'Edit Jenjang Pendidikan')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/jenjang_pendidikan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/jenjang_pendidikan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Jenjang Pendidikans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('jenjang_pendidikan_update');

		$this->data['jenjang_pendidikan'] = $this->model_jenjang_pendidikan->find($id);

		$this->template->title('Jenjang Pendidikan Update');
		$this->render('backend/standart/administrator/jenjang_pendidikan/jenjang_pendidikan_update', $this->data);
	}

	/**
	* Update Jenjang Pendidikans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('jenjang_pendidikan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('jenjang_pendidikan', 'Jenjang Pendidikan', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[80]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'jenjang_pendidikan' => $this->input->post('jenjang_pendidikan'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_jenjang_pendidikan = $this->model_jenjang_pendidikan->change($id, $save_data);

			if ($save_jenjang_pendidikan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/jenjang_pendidikan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/jenjang_pendidikan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/jenjang_pendidikan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Jenjang Pendidikans
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('jenjang_pendidikan_delete');

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
            set_message(cclang('has_been_deleted', 'jenjang_pendidikan'), 'success');
        } else {
            set_message(cclang('error_delete', 'jenjang_pendidikan'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Jenjang Pendidikans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('jenjang_pendidikan_view');

		$this->data['jenjang_pendidikan'] = $this->model_jenjang_pendidikan->join_avaiable()->find($id);

		$this->template->title('Jenjang Pendidikan Detail');
		$this->render('backend/standart/administrator/jenjang_pendidikan/jenjang_pendidikan_view', $this->data);
	}
	
	/**
	* delete Jenjang Pendidikans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$jenjang_pendidikan = $this->model_jenjang_pendidikan->find($id);

		
		
		return $this->model_jenjang_pendidikan->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('jenjang_pendidikan_export');

		$this->model_jenjang_pendidikan->export('jenjang_pendidikan', 'jenjang_pendidikan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('jenjang_pendidikan_export');

		$this->model_jenjang_pendidikan->pdf('jenjang_pendidikan', 'jenjang_pendidikan');
	}
}


/* End of file jenjang_pendidikan.php */
/* Location: ./application/controllers/administrator/Jenjang Pendidikan.php */
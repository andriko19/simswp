<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Jenis Kelamin Controller
*| --------------------------------------------------------------------------
*| Jenis Kelamin site
*|
*/
class Jenis_kelamin extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_jenis_kelamin');
	}

	/**
	* show all Jenis Kelamins
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('jenis_kelamin_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['jenis_kelamins'] = $this->model_jenis_kelamin->get($filter, $field, $this->limit_page, $offset);
		$this->data['jenis_kelamin_counts'] = $this->model_jenis_kelamin->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/jenis_kelamin/index/',
			'total_rows'   => $this->model_jenis_kelamin->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Jenis Kelamin List');
		$this->render('backend/standart/administrator/jenis_kelamin/jenis_kelamin_list', $this->data);
	}
	
	/**
	* Add new jenis_kelamins
	*
	*/
	public function add()
	{
		$this->is_allowed('jenis_kelamin_add');

		$this->template->title('Jenis Kelamin New');
		$this->render('backend/standart/administrator/jenis_kelamin/jenis_kelamin_add', $this->data);
	}

	/**
	* Add New Jenis Kelamins
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('jenis_kelamin_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[80]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_jenis_kelamin = $this->model_jenis_kelamin->store($save_data);

			if ($save_jenis_kelamin) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_jenis_kelamin;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/jenis_kelamin/edit/' . $save_jenis_kelamin, 'Edit Jenis Kelamin'),
						anchor('administrator/jenis_kelamin', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/jenis_kelamin/edit/' . $save_jenis_kelamin, 'Edit Jenis Kelamin')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/jenis_kelamin');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/jenis_kelamin');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Jenis Kelamins
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('jenis_kelamin_update');

		$this->data['jenis_kelamin'] = $this->model_jenis_kelamin->find($id);

		$this->template->title('Jenis Kelamin Update');
		$this->render('backend/standart/administrator/jenis_kelamin/jenis_kelamin_update', $this->data);
	}

	/**
	* Update Jenis Kelamins
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('jenis_kelamin_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[80]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_jenis_kelamin = $this->model_jenis_kelamin->change($id, $save_data);

			if ($save_jenis_kelamin) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/jenis_kelamin', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/jenis_kelamin');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/jenis_kelamin');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Jenis Kelamins
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('jenis_kelamin_delete');

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
            set_message(cclang('has_been_deleted', 'jenis_kelamin'), 'success');
        } else {
            set_message(cclang('error_delete', 'jenis_kelamin'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Jenis Kelamins
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('jenis_kelamin_view');

		$this->data['jenis_kelamin'] = $this->model_jenis_kelamin->join_avaiable()->find($id);

		$this->template->title('Jenis Kelamin Detail');
		$this->render('backend/standart/administrator/jenis_kelamin/jenis_kelamin_view', $this->data);
	}
	
	/**
	* delete Jenis Kelamins
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$jenis_kelamin = $this->model_jenis_kelamin->find($id);

		
		
		return $this->model_jenis_kelamin->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('jenis_kelamin_export');

		$this->model_jenis_kelamin->export('jenis_kelamin', 'jenis_kelamin');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('jenis_kelamin_export');

		$this->model_jenis_kelamin->pdf('jenis_kelamin', 'jenis_kelamin');
	}
}


/* End of file jenis_kelamin.php */
/* Location: ./application/controllers/administrator/Jenis Kelamin.php */
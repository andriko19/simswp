<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Kode Kelas Controller
*| --------------------------------------------------------------------------
*| Kode Kelas site
*|
*/
class Kode_kelas extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_kode_kelas');
	}

	/**
	* show all Kode Kelass
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('kode_kelas_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['kode_kelass'] = $this->model_kode_kelas->get($filter, $field, $this->limit_page, $offset);
		$this->data['kode_kelas_counts'] = $this->model_kode_kelas->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/kode_kelas/index/',
			'total_rows'   => $this->model_kode_kelas->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Kode Kelas List');
		$this->render('backend/standart/administrator/kode_kelas/kode_kelas_list', $this->data);
	}
	
	/**
	* Add new kode_kelass
	*
	*/
	public function add()
	{
		$this->is_allowed('kode_kelas_add');

		$this->template->title('Kode Kelas New');
		$this->render('backend/standart/administrator/kode_kelas/kode_kelas_add', $this->data);
	}

	/**
	* Add New Kode Kelass
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('kode_kelas_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('kode_kelas', 'Kode Kelas', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[80]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kode_kelas' => $this->input->post('kode_kelas'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_kode_kelas = $this->model_kode_kelas->store($save_data);

			if ($save_kode_kelas) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_kode_kelas;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/kode_kelas/edit/' . $save_kode_kelas, 'Edit Kode Kelas'),
						anchor('administrator/kode_kelas', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/kode_kelas/edit/' . $save_kode_kelas, 'Edit Kode Kelas')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/kode_kelas');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/kode_kelas');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Kode Kelass
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('kode_kelas_update');

		$this->data['kode_kelas'] = $this->model_kode_kelas->find($id);

		$this->template->title('Kode Kelas Update');
		$this->render('backend/standart/administrator/kode_kelas/kode_kelas_update', $this->data);
	}

	/**
	* Update Kode Kelass
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('kode_kelas_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('kode_kelas', 'Kode Kelas', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[80]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'kode_kelas' => $this->input->post('kode_kelas'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_kode_kelas = $this->model_kode_kelas->change($id, $save_data);

			if ($save_kode_kelas) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/kode_kelas', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/kode_kelas');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/kode_kelas');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Kode Kelass
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('kode_kelas_delete');

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
            set_message(cclang('has_been_deleted', 'kode_kelas'), 'success');
        } else {
            set_message(cclang('error_delete', 'kode_kelas'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Kode Kelass
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('kode_kelas_view');

		$this->data['kode_kelas'] = $this->model_kode_kelas->join_avaiable()->find($id);

		$this->template->title('Kode Kelas Detail');
		$this->render('backend/standart/administrator/kode_kelas/kode_kelas_view', $this->data);
	}
	
	/**
	* delete Kode Kelass
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$kode_kelas = $this->model_kode_kelas->find($id);

		
		
		return $this->model_kode_kelas->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('kode_kelas_export');

		$this->model_kode_kelas->export('kode_kelas', 'kode_kelas');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('kode_kelas_export');

		$this->model_kode_kelas->pdf('kode_kelas', 'kode_kelas');
	}
}


/* End of file kode_kelas.php */
/* Location: ./application/controllers/administrator/Kode Kelas.php */
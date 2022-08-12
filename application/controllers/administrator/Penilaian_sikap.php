<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Penilaian Sikap Controller
*| --------------------------------------------------------------------------
*| Penilaian Sikap site
*|
*/
class Penilaian_sikap extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_penilaian_sikap');
	}

	/**
	* show all Penilaian Sikaps
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('penilaian_sikap_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['penilaian_sikaps'] = $this->model_penilaian_sikap->get($filter, $field, $this->limit_page, $offset);
		$this->data['penilaian_sikap_counts'] = $this->model_penilaian_sikap->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/penilaian_sikap/index/',
			'total_rows'   => $this->model_penilaian_sikap->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Penilaian Sikap List');
		$this->render('backend/standart/administrator/penilaian_sikap/penilaian_sikap_list', $this->data);
	}
	
	/**
	* Add new penilaian_sikaps
	*
	*/
	public function add()
	{
		$this->is_allowed('penilaian_sikap_add');

		$this->template->title('Penilaian Sikap New');
		$this->render('backend/standart/administrator/penilaian_sikap/penilaian_sikap_add', $this->data);
	}

	/**
	* Add New Penilaian Sikaps
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('penilaian_sikap_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('penilaian_sikap', 'Penilaian Sikap', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('id_kodesekolah', 'Id Kodesekolah', 'trim|required|max_length[11]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'penilaian_sikap' => $this->input->post('penilaian_sikap'),
				'id_kodesekolah' => $this->input->post('id_kodesekolah'),
			];

			
			$save_penilaian_sikap = $this->model_penilaian_sikap->store($save_data);

			if ($save_penilaian_sikap) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_penilaian_sikap;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/penilaian_sikap/edit/' . $save_penilaian_sikap, 'Edit Penilaian Sikap'),
						anchor('administrator/penilaian_sikap', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/penilaian_sikap/edit/' . $save_penilaian_sikap, 'Edit Penilaian Sikap')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/penilaian_sikap');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/penilaian_sikap');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Penilaian Sikaps
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('penilaian_sikap_update');

		$this->data['penilaian_sikap'] = $this->model_penilaian_sikap->find($id);

		$this->template->title('Penilaian Sikap Update');
		$this->render('backend/standart/administrator/penilaian_sikap/penilaian_sikap_update', $this->data);
	}

	/**
	* Update Penilaian Sikaps
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('penilaian_sikap_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('penilaian_sikap', 'Penilaian Sikap', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('id_kodesekolah', 'Id Kodesekolah', 'trim|required|max_length[11]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'penilaian_sikap' => $this->input->post('penilaian_sikap'),
				'id_kodesekolah' => $this->input->post('id_kodesekolah'),
			];

			
			$save_penilaian_sikap = $this->model_penilaian_sikap->change($id, $save_data);

			if ($save_penilaian_sikap) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/penilaian_sikap', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/penilaian_sikap');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/penilaian_sikap');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Penilaian Sikaps
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('penilaian_sikap_delete');

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
            set_message(cclang('has_been_deleted', 'penilaian_sikap'), 'success');
        } else {
            set_message(cclang('error_delete', 'penilaian_sikap'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Penilaian Sikaps
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('penilaian_sikap_view');

		$this->data['penilaian_sikap'] = $this->model_penilaian_sikap->join_avaiable()->find($id);

		$this->template->title('Penilaian Sikap Detail');
		$this->render('backend/standart/administrator/penilaian_sikap/penilaian_sikap_view', $this->data);
	}
	
	/**
	* delete Penilaian Sikaps
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$penilaian_sikap = $this->model_penilaian_sikap->find($id);

		
		
		return $this->model_penilaian_sikap->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('penilaian_sikap_export');

		$this->model_penilaian_sikap->export('penilaian_sikap', 'penilaian_sikap');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('penilaian_sikap_export');

		$this->model_penilaian_sikap->pdf('penilaian_sikap', 'penilaian_sikap');
	}
}


/* End of file penilaian_sikap.php */
/* Location: ./application/controllers/administrator/Penilaian Sikap.php */
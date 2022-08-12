<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Sinkronisasi Sikap Controller
*| --------------------------------------------------------------------------
*| Sinkronisasi Sikap site
*|
*/
class Sinkronisasi_sikap extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_sinkronisasi_sikap');
	}

	/**
	* show all Sinkronisasi Sikaps
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('sinkronisasi_sikap_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['sinkronisasi_sikaps'] = $this->model_sinkronisasi_sikap->get($filter, $field, $this->limit_page, $offset);
		$this->data['sinkronisasi_sikap_counts'] = $this->model_sinkronisasi_sikap->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/sinkronisasi_sikap/index/',
			'total_rows'   => $this->model_sinkronisasi_sikap->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Sinkronisasi Sikap List');
		$this->render('backend/standart/administrator/sinkronisasi_sikap/sinkronisasi_sikap_list', $this->data);
	}
	
	/**
	* Add new sinkronisasi_sikaps
	*
	*/
	public function add()
	{
		$this->is_allowed('sinkronisasi_sikap_add');

		$this->template->title('Sinkronisasi Sikap New');
		$this->render('backend/standart/administrator/sinkronisasi_sikap/sinkronisasi_sikap_add', $this->data);
	}

	/**
	* Add New Sinkronisasi Sikaps
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('sinkronisasi_sikap_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('id_indikator_pbp', 'Id Indikator Pbp', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_penilaian_sikap', 'Id Penilaian Sikap', 'trim|required|max_length[11]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'id_indikator_pbp' => $this->input->post('id_indikator_pbp'),
				'id_penilaian_sikap' => $this->input->post('id_penilaian_sikap'),
			];

			
			$save_sinkronisasi_sikap = $this->model_sinkronisasi_sikap->store($save_data);

			if ($save_sinkronisasi_sikap) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_sinkronisasi_sikap;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/sinkronisasi_sikap/edit/' . $save_sinkronisasi_sikap, 'Edit Sinkronisasi Sikap'),
						anchor('administrator/sinkronisasi_sikap', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/sinkronisasi_sikap/edit/' . $save_sinkronisasi_sikap, 'Edit Sinkronisasi Sikap')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/sinkronisasi_sikap');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/sinkronisasi_sikap');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Sinkronisasi Sikaps
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('sinkronisasi_sikap_update');

		$this->data['sinkronisasi_sikap'] = $this->model_sinkronisasi_sikap->find($id);

		$this->template->title('Sinkronisasi Sikap Update');
		$this->render('backend/standart/administrator/sinkronisasi_sikap/sinkronisasi_sikap_update', $this->data);
	}

	/**
	* Update Sinkronisasi Sikaps
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('sinkronisasi_sikap_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('id_indikator_pbp', 'Id Indikator Pbp', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_penilaian_sikap', 'Id Penilaian Sikap', 'trim|required|max_length[11]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'id_indikator_pbp' => $this->input->post('id_indikator_pbp'),
				'id_penilaian_sikap' => $this->input->post('id_penilaian_sikap'),
			];

			
			$save_sinkronisasi_sikap = $this->model_sinkronisasi_sikap->change($id, $save_data);

			if ($save_sinkronisasi_sikap) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/sinkronisasi_sikap', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/sinkronisasi_sikap');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/sinkronisasi_sikap');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Sinkronisasi Sikaps
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('sinkronisasi_sikap_delete');

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
            set_message(cclang('has_been_deleted', 'sinkronisasi_sikap'), 'success');
        } else {
            set_message(cclang('error_delete', 'sinkronisasi_sikap'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Sinkronisasi Sikaps
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('sinkronisasi_sikap_view');

		$this->data['sinkronisasi_sikap'] = $this->model_sinkronisasi_sikap->join_avaiable()->find($id);

		$this->template->title('Sinkronisasi Sikap Detail');
		$this->render('backend/standart/administrator/sinkronisasi_sikap/sinkronisasi_sikap_view', $this->data);
	}
	
	/**
	* delete Sinkronisasi Sikaps
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$sinkronisasi_sikap = $this->model_sinkronisasi_sikap->find($id);

		
		
		return $this->model_sinkronisasi_sikap->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('sinkronisasi_sikap_export');

		$this->model_sinkronisasi_sikap->export('sinkronisasi_sikap', 'sinkronisasi_sikap');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('sinkronisasi_sikap_export');

		$this->model_sinkronisasi_sikap->pdf('sinkronisasi_sikap', 'sinkronisasi_sikap');
	}
}


/* End of file sinkronisasi_sikap.php */
/* Location: ./application/controllers/administrator/Sinkronisasi Sikap.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Lokasi Amatan Controller
*| --------------------------------------------------------------------------
*| Lokasi Amatan site
*|
*/
class Lokasi_amatan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_lokasi_amatan');
	}

	/**
	* show all Lokasi Amatans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('lokasi_amatan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['lokasi_amatans'] = $this->model_lokasi_amatan->get($filter, $field, $this->limit_page, $offset);
		$this->data['lokasi_amatan_counts'] = $this->model_lokasi_amatan->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/lokasi_amatan/index/',
			'total_rows'   => $this->model_lokasi_amatan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

    log_message("ERROR",$this->db->last_query());

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Lokasi Amatan List');
		$this->render('backend/standart/administrator/lokasi_amatan/lokasi_amatan_list', $this->data);
	}
	
	/**
	* Add new lokasi_amatans
	*
	*/
	public function add()
	{
		$this->is_allowed('lokasi_amatan_add');

		$this->template->title('Lokasi Amatan New');
		$this->render('backend/standart/administrator/lokasi_amatan/lokasi_amatan_add', $this->data);
	}

	/**
	* Add New Lokasi Amatans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('lokasi_amatan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('nama_lokasi', 'Nama Lokasi', 'trim|required|max_length[50]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'nama_lokasi' => $this->input->post('nama_lokasi'),
			];

			
			$save_lokasi_amatan = $this->model_lokasi_amatan->store($save_data);

			if ($save_lokasi_amatan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_lokasi_amatan;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/lokasi_amatan/edit/' . $save_lokasi_amatan, 'Edit Lokasi Amatan'),
						anchor('administrator/lokasi_amatan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/lokasi_amatan/edit/' . $save_lokasi_amatan, 'Edit Lokasi Amatan')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/lokasi_amatan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/lokasi_amatan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Lokasi Amatans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('lokasi_amatan_update');

		$this->data['lokasi_amatan'] = $this->model_lokasi_amatan->find($id);

		$this->template->title('Lokasi Amatan Update');
		$this->render('backend/standart/administrator/lokasi_amatan/lokasi_amatan_update', $this->data);
	}

	/**
	* Update Lokasi Amatans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('lokasi_amatan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('nama_lokasi', 'Nama Lokasi', 'trim|required|max_length[50]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'nama_lokasi' => $this->input->post('nama_lokasi'),
			];

			
			$save_lokasi_amatan = $this->model_lokasi_amatan->change($id, $save_data);

			if ($save_lokasi_amatan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/lokasi_amatan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/lokasi_amatan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/lokasi_amatan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Lokasi Amatans
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('lokasi_amatan_delete');

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
            set_message(cclang('has_been_deleted', 'lokasi_amatan'), 'success');
        } else {
            set_message(cclang('error_delete', 'lokasi_amatan'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Lokasi Amatans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('lokasi_amatan_view');

		$this->data['lokasi_amatan'] = $this->model_lokasi_amatan->join_avaiable()->find($id);

		$this->template->title('Lokasi Amatan Detail');
		$this->render('backend/standart/administrator/lokasi_amatan/lokasi_amatan_view', $this->data);
	}
	
	/**
	* delete Lokasi Amatans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$lokasi_amatan = $this->model_lokasi_amatan->find($id);

		
		
		return $this->model_lokasi_amatan->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('lokasi_amatan_export');

		$this->model_lokasi_amatan->export('lokasi_amatan', 'lokasi_amatan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('lokasi_amatan_export');

		$this->model_lokasi_amatan->pdf('lokasi_amatan', 'lokasi_amatan');
	}
}


/* End of file lokasi_amatan.php */
/* Location: ./application/controllers/administrator/Lokasi Amatan.php */
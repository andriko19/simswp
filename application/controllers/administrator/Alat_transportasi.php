<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Alat Transportasi Controller
*| --------------------------------------------------------------------------
*| Alat Transportasi site
*|
*/
class Alat_transportasi extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_alat_transportasi');
	}

	/**
	* show all Alat Transportasis
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('alat_transportasi_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['alat_transportasis'] = $this->model_alat_transportasi->get($filter, $field, $this->limit_page, $offset);
		$this->data['alat_transportasi_counts'] = $this->model_alat_transportasi->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/alat_transportasi/index/',
			'total_rows'   => $this->model_alat_transportasi->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Alat Transportasi List');
		$this->render('backend/standart/administrator/alat_transportasi/alat_transportasi_list', $this->data);
	}
	
	/**
	* Add new alat_transportasis
	*
	*/
	public function add()
	{
		$this->is_allowed('alat_transportasi_add');

		$this->template->title('Alat Transportasi New');
		$this->render('backend/standart/administrator/alat_transportasi/alat_transportasi_add', $this->data);
	}

	/**
	* Add New Alat Transportasis
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('alat_transportasi_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('alat_transportasi', 'Alat Transportasi', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[80]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'alat_transportasi' => $this->input->post('alat_transportasi'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_alat_transportasi = $this->model_alat_transportasi->store($save_data);

			if ($save_alat_transportasi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_alat_transportasi;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/alat_transportasi/edit/' . $save_alat_transportasi, 'Edit Alat Transportasi'),
						anchor('administrator/alat_transportasi', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/alat_transportasi/edit/' . $save_alat_transportasi, 'Edit Alat Transportasi')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/alat_transportasi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/alat_transportasi');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Alat Transportasis
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('alat_transportasi_update');

		$this->data['alat_transportasi'] = $this->model_alat_transportasi->find($id);

		$this->template->title('Alat Transportasi Update');
		$this->render('backend/standart/administrator/alat_transportasi/alat_transportasi_update', $this->data);
	}

	/**
	* Update Alat Transportasis
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('alat_transportasi_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('alat_transportasi', 'Alat Transportasi', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[80]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'alat_transportasi' => $this->input->post('alat_transportasi'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_alat_transportasi = $this->model_alat_transportasi->change($id, $save_data);

			if ($save_alat_transportasi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/alat_transportasi', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/alat_transportasi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/alat_transportasi');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Alat Transportasis
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('alat_transportasi_delete');

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
            set_message(cclang('has_been_deleted', 'alat_transportasi'), 'success');
        } else {
            set_message(cclang('error_delete', 'alat_transportasi'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Alat Transportasis
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('alat_transportasi_view');

		$this->data['alat_transportasi'] = $this->model_alat_transportasi->join_avaiable()->find($id);

		$this->template->title('Alat Transportasi Detail');
		$this->render('backend/standart/administrator/alat_transportasi/alat_transportasi_view', $this->data);
	}
	
	/**
	* delete Alat Transportasis
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$alat_transportasi = $this->model_alat_transportasi->find($id);

		
		
		return $this->model_alat_transportasi->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('alat_transportasi_export');

		$this->model_alat_transportasi->export('alat_transportasi', 'alat_transportasi');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('alat_transportasi_export');

		$this->model_alat_transportasi->pdf('alat_transportasi', 'alat_transportasi');
	}
}


/* End of file alat_transportasi.php */
/* Location: ./application/controllers/administrator/Alat Transportasi.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Kode Sekolah Controller
*| --------------------------------------------------------------------------
*| Kode Sekolah site
*|
*/
class Kode_sekolah extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_kode_sekolah');
	}

	/**
	* show all Kode Sekolahs
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('kode_sekolah_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['kode_sekolahs'] = $this->model_kode_sekolah->get($filter, $field, $this->limit_page, $offset);
		$this->data['kode_sekolah_counts'] = $this->model_kode_sekolah->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/kode_sekolah/index/',
			'total_rows'   => $this->model_kode_sekolah->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Kode Sekolah List');
		$this->render('backend/standart/administrator/kode_sekolah/kode_sekolah_list', $this->data);
	}
	
	/**
	* Add new kode_sekolahs
	*
	*/
	public function add()
	{
		$this->is_allowed('kode_sekolah_add');

		$this->template->title('Kode Sekolah New');
		$this->render('backend/standart/administrator/kode_sekolah/kode_sekolah_add', $this->data);
	}

	/**
	* Add New Kode Sekolahs
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('kode_sekolah_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('kode_sekolah', 'Kode Sekolah', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[80]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kode_sekolah' => $this->input->post('kode_sekolah'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_kode_sekolah = $this->model_kode_sekolah->store($save_data);

			if ($save_kode_sekolah) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_kode_sekolah;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/kode_sekolah/edit/' . $save_kode_sekolah, 'Edit Kode Sekolah'),
						anchor('administrator/kode_sekolah', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/kode_sekolah/edit/' . $save_kode_sekolah, 'Edit Kode Sekolah')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/kode_sekolah');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/kode_sekolah');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Kode Sekolahs
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('kode_sekolah_update');

		$this->data['kode_sekolah'] = $this->model_kode_sekolah->find($id);

		$this->template->title('Kode Sekolah Update');
		$this->render('backend/standart/administrator/kode_sekolah/kode_sekolah_update', $this->data);
	}

	/**
	* Update Kode Sekolahs
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('kode_sekolah_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('kode_sekolah', 'Kode Sekolah', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[80]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'kode_sekolah' => $this->input->post('kode_sekolah'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_kode_sekolah = $this->model_kode_sekolah->change($id, $save_data);

			if ($save_kode_sekolah) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/kode_sekolah', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/kode_sekolah');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/kode_sekolah');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Kode Sekolahs
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('kode_sekolah_delete');

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
            set_message(cclang('has_been_deleted', 'kode_sekolah'), 'success');
        } else {
            set_message(cclang('error_delete', 'kode_sekolah'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Kode Sekolahs
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('kode_sekolah_view');

		$this->data['kode_sekolah'] = $this->model_kode_sekolah->join_avaiable()->find($id);

		$this->template->title('Kode Sekolah Detail');
		$this->render('backend/standart/administrator/kode_sekolah/kode_sekolah_view', $this->data);
	}
	
	/**
	* delete Kode Sekolahs
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$kode_sekolah = $this->model_kode_sekolah->find($id);

		
		
		return $this->model_kode_sekolah->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('kode_sekolah_export');

		$this->model_kode_sekolah->export('kode_sekolah', 'kode_sekolah');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('kode_sekolah_export');

		$this->model_kode_sekolah->pdf('kode_sekolah', 'kode_sekolah');
	}
}


/* End of file kode_sekolah.php */
/* Location: ./application/controllers/administrator/Kode Sekolah.php */
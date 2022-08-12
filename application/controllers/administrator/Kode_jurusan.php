<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Kode Jurusan Controller
*| --------------------------------------------------------------------------
*| Kode Jurusan site
*|
*/
class Kode_jurusan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_kode_jurusan');
	}

	/**
	* show all Kode Jurusans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('kode_jurusan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['kode_jurusans'] = $this->model_kode_jurusan->get($filter, $field, $this->limit_page, $offset);
		$this->data['kode_jurusan_counts'] = $this->model_kode_jurusan->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/kode_jurusan/index/',
			'total_rows'   => $this->model_kode_jurusan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Kode Jurusan List');
		$this->render('backend/standart/administrator/kode_jurusan/kode_jurusan_list', $this->data);
	}
	
	/**
	* Add new kode_jurusans
	*
	*/
	public function add()
	{
		$this->is_allowed('kode_jurusan_add');

		$this->template->title('Kode Jurusan New');
		$this->render('backend/standart/administrator/kode_jurusan/kode_jurusan_add', $this->data);
	}

	/**
	* Add New Kode Jurusans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('kode_jurusan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('kode_jurusan', 'Kode Jurusan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[80]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kode_jurusan' => $this->input->post('kode_jurusan'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_kode_jurusan = $this->model_kode_jurusan->store($save_data);

			if ($save_kode_jurusan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_kode_jurusan;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/kode_jurusan/edit/' . $save_kode_jurusan, 'Edit Kode Jurusan'),
						anchor('administrator/kode_jurusan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/kode_jurusan/edit/' . $save_kode_jurusan, 'Edit Kode Jurusan')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/kode_jurusan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/kode_jurusan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Kode Jurusans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('kode_jurusan_update');

		$this->data['kode_jurusan'] = $this->model_kode_jurusan->find($id);

		$this->template->title('Kode Jurusan Update');
		$this->render('backend/standart/administrator/kode_jurusan/kode_jurusan_update', $this->data);
	}

	/**
	* Update Kode Jurusans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('kode_jurusan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('kode_jurusan', 'Kode Jurusan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[80]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'kode_jurusan' => $this->input->post('kode_jurusan'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_kode_jurusan = $this->model_kode_jurusan->change($id, $save_data);

			if ($save_kode_jurusan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/kode_jurusan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/kode_jurusan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/kode_jurusan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Kode Jurusans
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('kode_jurusan_delete');

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
            set_message(cclang('has_been_deleted', 'kode_jurusan'), 'success');
        } else {
            set_message(cclang('error_delete', 'kode_jurusan'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Kode Jurusans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('kode_jurusan_view');

		$this->data['kode_jurusan'] = $this->model_kode_jurusan->join_avaiable()->find($id);

		$this->template->title('Kode Jurusan Detail');
		$this->render('backend/standart/administrator/kode_jurusan/kode_jurusan_view', $this->data);
	}
	
	/**
	* delete Kode Jurusans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$kode_jurusan = $this->model_kode_jurusan->find($id);

		
		
		return $this->model_kode_jurusan->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('kode_jurusan_export');

		$this->model_kode_jurusan->export('kode_jurusan', 'kode_jurusan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('kode_jurusan_export');

		$this->model_kode_jurusan->pdf('kode_jurusan', 'kode_jurusan');
	}
}


/* End of file kode_jurusan.php */
/* Location: ./application/controllers/administrator/Kode Jurusan.php */
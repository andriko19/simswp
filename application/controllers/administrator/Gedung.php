<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Gedung Controller
*| --------------------------------------------------------------------------
*| Gedung site
*|
*/
class Gedung extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_gedung');
	}

	/**
	* show all Gedungs
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('gedung_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['gedungs'] = $this->model_gedung->get($filter, $field, $this->limit_page, $offset);
		$this->data['gedung_counts'] = $this->model_gedung->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/gedung/index/',
			'total_rows'   => $this->model_gedung->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Gedung List');
		$this->render('backend/standart/administrator/gedung/gedung_list', $this->data);
	}
	
	/**
	* Add new gedungs
	*
	*/
	public function add()
	{
		$this->is_allowed('gedung_add');

		$this->template->title('Gedung New');
		$this->render('backend/standart/administrator/gedung/gedung_add', $this->data);
	}

	/**
	* Add New Gedungs
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('gedung_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('nama_gedung', 'Nama Gedung', 'trim|required');
		$this->form_validation->set_rules('aktif', 'Aktif', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'nama_gedung' => $this->input->post('nama_gedung'),
				'jumlah_lantai' => $this->input->post('jumlah_lantai'),
				'panjang' => $this->input->post('panjang'),
				'tinggi' => $this->input->post('tinggi'),
				'lebar' => $this->input->post('lebar'),
				'keterangan' => $this->input->post('keterangan'),
				'aktif' => $this->input->post('aktif'),
			];

			
			$save_gedung = $this->model_gedung->store($save_data);

			if ($save_gedung) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_gedung;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/gedung/edit/' . $save_gedung, 'Edit Gedung'),
						anchor('administrator/gedung', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/gedung/edit/' . $save_gedung, 'Edit Gedung')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/gedung');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/gedung');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Gedungs
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('gedung_update');

		$this->data['gedung'] = $this->model_gedung->find($id);

		$this->template->title('Gedung Update');
		$this->render('backend/standart/administrator/gedung/gedung_update', $this->data);
	}

	/**
	* Update Gedungs
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('gedung_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('nama_gedung', 'Nama Gedung', 'trim|required');
		$this->form_validation->set_rules('aktif', 'Aktif', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'nama_gedung' => $this->input->post('nama_gedung'),
				'jumlah_lantai' => $this->input->post('jumlah_lantai'),
				'panjang' => $this->input->post('panjang'),
				'tinggi' => $this->input->post('tinggi'),
				'lebar' => $this->input->post('lebar'),
				'keterangan' => $this->input->post('keterangan'),
				'aktif' => $this->input->post('aktif'),
			];

			
			$save_gedung = $this->model_gedung->change($id, $save_data);

			if ($save_gedung) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/gedung', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/gedung');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/gedung');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Gedungs
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('gedung_delete');

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
            set_message(cclang('has_been_deleted', 'gedung'), 'success');
        } else {
            set_message(cclang('error_delete', 'gedung'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Gedungs
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('gedung_view');

		$this->data['gedung'] = $this->model_gedung->join_avaiable()->find($id);

		$this->template->title('Gedung Detail');
		$this->render('backend/standart/administrator/gedung/gedung_view', $this->data);
	}
	
	/**
	* delete Gedungs
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$gedung = $this->model_gedung->find($id);

		
		
		return $this->model_gedung->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('gedung_export');

		$this->model_gedung->export('gedung', 'gedung');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('gedung_export');

		$this->model_gedung->pdf('gedung', 'gedung');
	}
}


/* End of file gedung.php */
/* Location: ./application/controllers/administrator/Gedung.php */
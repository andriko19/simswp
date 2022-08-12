<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Rapot Pbp Controller
*| --------------------------------------------------------------------------
*| Rapot Pbp site
*|
*/
class Rapot_pbp extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_rapot_pbp');
	}

	/**
	* show all Rapot Pbps
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('rapot_pbp_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['rapot_pbps'] = $this->model_rapot_pbp->get($filter, $field, $this->limit_page, $offset);
		$this->data['rapot_pbp_counts'] = $this->model_rapot_pbp->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/rapot_pbp/index/',
			'total_rows'   => $this->model_rapot_pbp->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Rapot Pbp List');
		$this->render('backend/standart/administrator/rapot_pbp/rapot_pbp_list', $this->data);
	}
	
	/**
	* Add new rapot_pbps
	*
	*/
	public function add()
	{
		$this->is_allowed('rapot_pbp_add');

		$this->template->title('Rapot Pbp New');
		$this->render('backend/standart/administrator/rapot_pbp/rapot_pbp_add', $this->data);
	}

	/**
	* Add New Rapot Pbps
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('rapot_pbp_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('id_siswa', 'Nama Siswa', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_semester', 'Semester', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_pilar_pbp_1', 'Pilar 1', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_pilar_pbp_2', 'Pilar 2', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_pilar_pbp_3', 'Pilar 3', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_pilar_pbp_4', 'Pilar 4', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_pilar_pbp_5', 'Pilar 5', 'trim|required');
		$this->form_validation->set_rules('id_pilar_pbp_6', 'Pilar 6', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
		$this->form_validation->set_rules('id_guru', 'Wali Kelas', 'trim|required|max_length[11]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'id_siswa' => $this->input->post('id_siswa'),
				'id_semester' => $this->input->post('id_semester'),
				'id_pilar_pbp_1' => $this->input->post('id_pilar_pbp_1'),
				'catatan_pbp_1' => $this->input->post('catatan_pbp_1'),
				'id_pilar_pbp_2' => $this->input->post('id_pilar_pbp_2'),
				'catatan_pbp_2' => $this->input->post('catatan_pbp_2'),
				'id_pilar_pbp_3' => $this->input->post('id_pilar_pbp_3'),
				'catatan_pbp_3' => $this->input->post('catatan_pbp_3'),
				'id_pilar_pbp_4' => $this->input->post('id_pilar_pbp_4'),
				'catatan_pbp_4' => $this->input->post('catatan_pbp_4'),
				'id_pilar_pbp_5' => $this->input->post('id_pilar_pbp_5'),
				'catatan_pbp_5' => $this->input->post('catatan_pbp_5'),
				'id_pilar_pbp_6' => $this->input->post('id_pilar_pbp_6'),
				'catatan_pbp_6' => $this->input->post('catatan_pbp_6'),
				'tanggal' => $this->input->post('tanggal'),
				'id_guru' => $this->input->post('id_guru'),
			];

			
			$save_rapot_pbp = $this->model_rapot_pbp->store($save_data);

			if ($save_rapot_pbp) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_rapot_pbp;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/rapot_pbp/edit/' . $save_rapot_pbp, 'Edit Rapot Pbp'),
						anchor('administrator/rapot_pbp', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/rapot_pbp/edit/' . $save_rapot_pbp, 'Edit Rapot Pbp')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/rapot_pbp');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/rapot_pbp');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Rapot Pbps
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('rapot_pbp_update');

		$this->data['rapot_pbp'] = $this->model_rapot_pbp->find($id);

		$this->template->title('Rapot Pbp Update');
		$this->render('backend/standart/administrator/rapot_pbp/rapot_pbp_update', $this->data);
	}

	/**
	* Update Rapot Pbps
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('rapot_pbp_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('id_siswa', 'Nama Siswa', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_semester', 'Semester', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_pilar_pbp_1', 'Pilar 1', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_pilar_pbp_2', 'Pilar 2', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_pilar_pbp_3', 'Pilar 3', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_pilar_pbp_4', 'Pilar 4', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_pilar_pbp_5', 'Pilar 5', 'trim|required');
		$this->form_validation->set_rules('id_pilar_pbp_6', 'Pilar 6', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
		$this->form_validation->set_rules('id_guru', 'Wali Kelas', 'trim|required|max_length[11]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'id_siswa' => $this->input->post('id_siswa'),
				'id_semester' => $this->input->post('id_semester'),
				'id_pilar_pbp_1' => $this->input->post('id_pilar_pbp_1'),
				'catatan_pbp_1' => $this->input->post('catatan_pbp_1'),
				'id_pilar_pbp_2' => $this->input->post('id_pilar_pbp_2'),
				'catatan_pbp_2' => $this->input->post('catatan_pbp_2'),
				'id_pilar_pbp_3' => $this->input->post('id_pilar_pbp_3'),
				'catatan_pbp_3' => $this->input->post('catatan_pbp_3'),
				'id_pilar_pbp_4' => $this->input->post('id_pilar_pbp_4'),
				'catatan_pbp_4' => $this->input->post('catatan_pbp_4'),
				'id_pilar_pbp_5' => $this->input->post('id_pilar_pbp_5'),
				'catatan_pbp_5' => $this->input->post('catatan_pbp_5'),
				'id_pilar_pbp_6' => $this->input->post('id_pilar_pbp_6'),
				'catatan_pbp_6' => $this->input->post('catatan_pbp_6'),
				'tanggal' => $this->input->post('tanggal'),
				'id_guru' => $this->input->post('id_guru'),
			];

			
			$save_rapot_pbp = $this->model_rapot_pbp->change($id, $save_data);

			if ($save_rapot_pbp) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/rapot_pbp', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/rapot_pbp');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/rapot_pbp');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Rapot Pbps
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('rapot_pbp_delete');

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
            set_message(cclang('has_been_deleted', 'rapot_pbp'), 'success');
        } else {
            set_message(cclang('error_delete', 'rapot_pbp'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Rapot Pbps
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('rapot_pbp_view');

		$this->data['rapot_pbp'] = $this->model_rapot_pbp->join_avaiable()->find($id);

		$this->template->title('Rapot Pbp Detail');
		$this->render('backend/standart/administrator/rapot_pbp/rapot_pbp_view', $this->data);
	}
	
	/**
	* delete Rapot Pbps
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$rapot_pbp = $this->model_rapot_pbp->find($id);

		
		
		return $this->model_rapot_pbp->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('rapot_pbp_export');

		$this->model_rapot_pbp->export('rapot_pbp', 'rapot_pbp');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('rapot_pbp_export');

		$this->model_rapot_pbp->pdf('rapot_pbp', 'rapot_pbp');
	}
}


/* End of file rapot_pbp.php */
/* Location: ./application/controllers/administrator/Rapot Pbp.php */
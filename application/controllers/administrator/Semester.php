<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Semester Controller
*| --------------------------------------------------------------------------
*| Semester site
*|
*/
class Semester extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_semester');
	}

	/**
	* show all Semesters
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('semester_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['semesters'] = $this->model_semester->get($filter, $field, $this->limit_page, $offset);
		$this->data['semester_counts'] = $this->model_semester->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/semester/index/',
			'total_rows'   => $this->model_semester->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Semester List');
		$this->render('backend/standart/administrator/semester/semester_list', $this->data);
	}
	
	/**
	* Add new semesters
	*
	*/
	public function add()
	{
		$this->is_allowed('semester_add');

		$this->template->title('Semester New');
		$this->render('backend/standart/administrator/semester/semester_add', $this->data);
	}

	/**
	* Add New Semesters
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('semester_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('id_periode', 'Id Periode', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('semester', 'Semester', 'trim|required');
		$this->form_validation->set_rules('bulan_awal', 'Bulan Awal', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('tahun_awal', 'Tahun Awal', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('bulan_akhir', 'Bulan Akhir', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('tahun_akhir', 'Tahun Akhir', 'trim|required|max_length[50]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'id_periode' => $this->input->post('id_periode'),
				'semester' => $this->input->post('semester'),
				'bulan_awal' => $this->input->post('bulan_awal'),
				'tahun_awal' => $this->input->post('tahun_awal'),
				'bulan_akhir' => $this->input->post('bulan_akhir'),
				'tahun_akhir' => $this->input->post('tahun_akhir'),
			];

			
			$save_semester = $this->model_semester->store($save_data);

			if ($save_semester) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_semester;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/semester/edit/' . $save_semester, 'Edit Semester'),
						anchor('administrator/semester', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/semester/edit/' . $save_semester, 'Edit Semester')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/semester');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/semester');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Semesters
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('semester_update');

		$this->data['semester'] = $this->model_semester->find($id);

		$this->template->title('Semester Update');
		$this->render('backend/standart/administrator/semester/semester_update', $this->data);
	}

	/**
	* Update Semesters
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('semester_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('id_periode', 'Id Periode', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('semester', 'Semester', 'trim|required');
		$this->form_validation->set_rules('bulan_awal', 'Bulan Awal', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('tahun_awal', 'Tahun Awal', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('bulan_akhir', 'Bulan Akhir', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('tahun_akhir', 'Tahun Akhir', 'trim|required|max_length[50]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'id_periode' => $this->input->post('id_periode'),
				'semester' => $this->input->post('semester'),
				'bulan_awal' => $this->input->post('bulan_awal'),
				'tahun_awal' => $this->input->post('tahun_awal'),
				'bulan_akhir' => $this->input->post('bulan_akhir'),
				'tahun_akhir' => $this->input->post('tahun_akhir'),
			];

			
			$save_semester = $this->model_semester->change($id, $save_data);

			if ($save_semester) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/semester', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/semester');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/semester');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Semesters
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('semester_delete');

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
            set_message(cclang('has_been_deleted', 'semester'), 'success');
        } else {
            set_message(cclang('error_delete', 'semester'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Semesters
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('semester_view');

		$this->data['semester'] = $this->model_semester->join_avaiable()->find($id);

		$this->template->title('Semester Detail');
		$this->render('backend/standart/administrator/semester/semester_view', $this->data);
	}
	
	/**
	* delete Semesters
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$semester = $this->model_semester->find($id);

		
		
		return $this->model_semester->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('semester_export');

		$this->model_semester->export('semester', 'semester');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('semester_export');

		$this->model_semester->pdf('semester', 'semester');
	}
}


/* End of file semester.php */
/* Location: ./application/controllers/administrator/Semester.php */
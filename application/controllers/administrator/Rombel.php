<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| Rombel Controller
 *| --------------------------------------------------------------------------
 *| Rombel site
 *|
 */
class Rombel extends Admin
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_rombel');
	}

	/**
	 * show all Rombels
	 *
	 * @var $offset String
	 */
	public function index($offset = 0)
	{
		$this->is_allowed('rombel_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');
		$a = $this->session->groups;
		if ($a == 1) {
			$this->data['rombels'] = $this->model_rombel->get($filter, $field, $this->limit_page, $offset);
			$this->data['rombel_counts'] = $this->model_rombel->count_all($filter, $field);

			$config = [
				'base_url'     => 'administrator/rombel/index/',
				'total_rows'   => $this->model_rombel->count_all($filter, $field),
				'per_page'     => $this->limit_page,
				'uri_segment'  => 4,
			];
		} //filter SMK
		else if ($a == 16) {
			$this->data['rombels'] = $this->model_rombel->get2($filter, $field, $this->limit_page, $offset);
			$this->data['rombel_counts'] = $this->model_rombel->count_all2($filter, $field);

			$config = [
				'base_url'     => 'administrator/rombel/index/',
				'total_rows'   => $this->model_rombel->count_all2($filter, $field),
				'per_page'     => $this->limit_page,
				'uri_segment'  => 4,
			];
		} //filter sma
		else if ($a == 15) {
			$this->data['rombels'] = $this->model_rombel->get3($filter, $field, $this->limit_page, $offset);
			$this->data['rombel_counts'] = $this->model_rombel->count_all3($filter, $field);

			$config = [
				'base_url'     => 'administrator/rombel/index/',
				'total_rows'   => $this->model_rombel->count_all3($filter, $field),
				'per_page'     => $this->limit_page,
				'uri_segment'  => 4,
			];
		} //filter smp
		else if ($a == 14) {
			$this->data['rombels'] = $this->model_rombel->get4($filter, $field, $this->limit_page, $offset);
			$this->data['rombel_counts'] = $this->model_rombel->count_all4($filter, $field);

			$config = [
				'base_url'     => 'administrator/rombel/index/',
				'total_rows'   => $this->model_rombel->count_all4($filter, $field),
				'per_page'     => $this->limit_page,
				'uri_segment'  => 4,
			];
		}

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Rombel List');
		$this->render('backend/standart/administrator/rombel/rombel_list', $this->data);
	}

	/**
	 * Add new rombels
	 *
	 */
	public function add()
	{
		$this->is_allowed('rombel_add');

		$this->template->title('Rombel New');
		$this->render('backend/standart/administrator/rombel/rombel_add', $this->data);
	}

	/**
	 * Add New Rombels
	 *
	 * @return JSON
	 */
	public function add_save()
	{
		if (!$this->is_allowed('rombel_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
			]);
			exit;
		}

		$this->form_validation->set_rules('kode_sekolah', 'Kode Sekolah', 'trim|required');
		$this->form_validation->set_rules('kode_jurusan', 'Kode Jurusan', 'trim|required');
		$this->form_validation->set_rules('nama_rombel', 'Nama Rombel', 'trim|required');
		$this->form_validation->set_rules('wali_kelas', 'Wali Kelas', 'trim|required');
		$this->form_validation->set_rules('kelas', 'Kelas', 'trim|required');
		$this->form_validation->set_rules('periode', 'Periode', 'trim|required');


		if ($this->form_validation->run()) {

			$save_data = [
				'kode_sekolah' => $this->input->post('kode_sekolah'),
				'kode_jurusan' => $this->input->post('kode_jurusan'),
				'nama_rombel' => $this->input->post('nama_rombel'),
				'wali_kelas' => $this->input->post('wali_kelas'),
				'kelas' => $this->input->post('kelas'),
				'periode' => $this->input->post('periode'),
			];


			$save_rombel = $this->model_rombel->store($save_data);

			if ($save_rombel) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_rombel;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/rombel/edit/' . $save_rombel, 'Edit Rombel'),
						anchor('administrator/rombel', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
							anchor('administrator/rombel/edit/' . $save_rombel, 'Edit Rombel')
						]),
						'success'
					);

					$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/rombel');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/rombel');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	 * Update view Rombels
	 *
	 * @var $id String
	 */
	public function edit($id)
	{
		$this->is_allowed('rombel_update');

		$this->data['rombel'] = $this->model_rombel->find($id);

		$this->template->title('Rombel Update');
		$this->render('backend/standart/administrator/rombel/rombel_update', $this->data);
	}

	/**
	 * Update Rombels
	 *
	 * @var $id String
	 */
	public function edit_save($id)
	{
		if (!$this->is_allowed('rombel_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
			]);
			exit;
		}

		$this->form_validation->set_rules('kode_sekolah', 'Kode Sekolah', 'trim|required');
		$this->form_validation->set_rules('kode_jurusan', 'Kode Jurusan', 'trim|required');
		$this->form_validation->set_rules('nama_rombel', 'Nama Rombel', 'trim|required');
		$this->form_validation->set_rules('wali_kelas', 'Wali Kelas', 'trim|required');
		$this->form_validation->set_rules('kelas', 'Kelas', 'trim|required');
		$this->form_validation->set_rules('periode', 'Periode', 'trim|required');

		if ($this->form_validation->run()) {

			$save_data = [
				'kode_sekolah' => $this->input->post('kode_sekolah'),
				'kode_jurusan' => $this->input->post('kode_jurusan'),
				'nama_rombel' => $this->input->post('nama_rombel'),
				'wali_kelas' => $this->input->post('wali_kelas'),
				'kelas' => $this->input->post('kelas'),
				'periode' => $this->input->post('periode'),
			];


			$save_rombel = $this->model_rombel->change($id, $save_data);

			if ($save_rombel) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/rombel', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', []),
						'success'
					);

					$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/rombel');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/rombel');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	 * delete Rombels
	 *
	 * @var $id String
	 */
	public function delete($id)
	{
		$this->is_allowed('rombel_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$remove = false;

		if (!empty($id)) {
			$remove = $this->_remove($id);
		} elseif (count($arr_id) > 0) {
			foreach ($arr_id as $id) {
				$remove = $this->_remove($id);
			}
		}

		if ($remove) {
			set_message(cclang('has_been_deleted', 'rombel'), 'success');
		} else {
			set_message(cclang('error_delete', 'rombel'), 'error');
		}

		redirect_back();
	}

	/**
	 * View view Rombels
	 *
	 * @var $id String
	 */
	public function view($id)
	{
		$this->is_allowed('rombel_view');

		$this->data['rombel'] = $this->model_rombel->join_avaiable()->find($id);

		$this->template->title('Rombel Detail');
		$this->render('backend/standart/administrator/rombel/rombel_view', $this->data);
	}

	/**
	 * delete Rombels
	 *
	 * @var $id String
	 */
	private function _remove($id)
	{
		$rombel = $this->model_rombel->find($id);



		return $this->model_rombel->remove($id);
	}


	/**
	 * Export to excel
	 *
	 * @return Files Excel .xls
	 */
	public function export()
	{
		$this->is_allowed('rombel_export');

		$this->model_rombel->export('rombel', 'rombel');
	}

	/**
	 * Export to PDF
	 *
	 * @return Files PDF .pdf
	 */
	public function export_pdf()
	{
		$this->is_allowed('rombel_export');

		$this->model_rombel->pdf('rombel', 'rombel');
	}
}


/* End of file rombel.php */
/* Location: ./application/controllers/administrator/Rombel.php */
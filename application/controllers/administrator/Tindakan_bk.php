<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Tindakan Bk Controller
*| --------------------------------------------------------------------------
*| Tindakan Bk site
*|
*/
class Tindakan_bk extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_isian_amatan');
		$this->load->model('model_tindakan_bk');
	}

	/**
	* show all Tindakan Bks
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('tindakan_bk_list');

		$filter         = $this->input->get('q');
		$field 	        = $this->input->get('f');
    $id_semester 	  = $this->input->get('id_semester');

    if ($id_semester != null ) {
      $getBulanAwal		= $this->model_tindakan_bk->getBulanAwal($id_semester);
      $getTahunAwal		= $this->model_tindakan_bk->getTahunAwal($id_semester);
      $getBulanAkhir	= $this->model_tindakan_bk->getBulanAkhir($id_semester);
      // $getTahunAkhir	= $this->model_tindakan_bk->getTahunAkhir($id_semester);
    } else {
      $getBulanAwal		= null;
      $getTahunAwal		= null;
      $getBulanAkhir	= null;
      // $getTahunAkhir	= null;
    }

		$a = $this->session->groups;
		
		if ($a == 21) {

			$this->data['tindakan_bks'] = $this->model_tindakan_bk->getKepsekSMP($filter, $field, $this->limit_page, $offset, $getBulanAwal, $getTahunAwal, $getBulanAkhir);
			$this->data['tindakan_bk_counts'] = $this->model_tindakan_bk->count_allKepsekSMP($filter, $field, $getBulanAwal, $getTahunAwal, $getBulanAkhir);
			$this->data['id_semester'] =  $id_semester;

			$config = [
				'base_url'     => 'administrator/tindakan_bk/index/',
				'total_rows'   => $this->model_tindakan_bk->count_allKepsekSMP($filter, $field, $getBulanAwal, $getTahunAwal, $getBulanAkhir),
				'per_page'     => $this->limit_page,
				'uri_segment'  => 4,
			];

		} else if ($a == 22) {

      // var_dump($getBulanAwal);
      // die;
      
			$this->data['tindakan_bks'] = $this->model_tindakan_bk->getKepsekSMA($filter, $field, $this->limit_page, $offset, $getBulanAwal, $getTahunAwal, $getBulanAkhir);
			$this->data['tindakan_bk_counts'] = $this->model_tindakan_bk->count_allKepsekSMA($filter, $field, $getBulanAwal, $getTahunAwal, $getBulanAkhir);
			$this->data['id_semester'] =  $id_semester;

			$config = [
				'base_url'     => 'administrator/tindakan_bk/index/',
				'total_rows'   => $this->model_tindakan_bk->count_allKepsekSMA($filter, $field, $getBulanAwal, $getTahunAwal, $getBulanAkhir),
				'per_page'     => $this->limit_page,
				'uri_segment'  => 4,
			];

		} else if ($a == 23) {

			$this->data['tindakan_bks'] = $this->model_tindakan_bk->getKepsekSMK($filter, $field, $this->limit_page, $offset, $getBulanAwal, $getTahunAwal, $getBulanAkhir);
			$this->data['tindakan_bk_counts'] = $this->model_tindakan_bk->count_allKepsekSMK($filter, $field, $getBulanAwal, $getTahunAwal, $getBulanAkhir);
			$this->data['id_semester'] =  $id_semester;

			$config = [
				'base_url'     => 'administrator/tindakan_bk/index/',
				'total_rows'   => $this->model_tindakan_bk->count_allKepsekSMK($filter, $field, $getBulanAwal, $getTahunAwal, $getBulanAkhir),
				'per_page'     => $this->limit_page,
				'uri_segment'  => 4,
			];

		} else if ($a == 1 || $a == 7) {

			$this->data['tindakan_bks'] = $this->model_tindakan_bk->get($filter, $field, $this->limit_page, $offset, $getBulanAwal, $getTahunAwal, $getBulanAkhir);
			$this->data['tindakan_bk_counts'] = $this->model_tindakan_bk->count_all($filter, $field, $getBulanAwal, $getTahunAwal, $getBulanAkhir);
			$this->data['id_semester'] =  $id_semester;

			$config = [
				'base_url'     => 'administrator/tindakan_bk/index/',
				'total_rows'   => $this->model_tindakan_bk->count_all($filter, $field, $getBulanAwal, $getTahunAwal, $getBulanAkhir),
				'per_page'     => $this->limit_page,
				'uri_segment'  => 4,
			];

		}

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Tindakan Bk List');
		$this->render('backend/standart/administrator/tindakan_bk/tindakan_bk_list', $this->data);
	}
	
	/**
	* Add new tindakan_bks
	*
	*/
	public function add()
	{
		$this->is_allowed('tindakan_bk_add');

		$this->template->title('Tindakan Bk New');
		$this->render('backend/standart/administrator/tindakan_bk/tindakan_bk_add', $this->data);
	}

	/**
	* Add New Tindakan Bks
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('tindakan_bk_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
		$this->form_validation->set_rules('id_siswa', 'Id Siswa', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('isi_tindakan', 'Isi Tindakan', 'trim|required');
		$this->form_validation->set_rules('id_guru_bk', 'Id Guru Bk', 'trim|max_length[11]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'tanggal' => $this->input->post('tanggal'),
				'id_siswa' => $this->input->post('id_siswa'),
				'isi_tindakan' => $this->input->post('isi_tindakan'),
				'id_guru_bk' => $this->session->id,
			];

			
			$save_tindakan_bk = $this->model_tindakan_bk->store($save_data);

			if ($save_tindakan_bk) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_tindakan_bk;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/tindakan_bk/edit/' . $save_tindakan_bk, 'Edit Tindakan Bk'),
						anchor('administrator/tindakan_bk', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/tindakan_bk/edit/' . $save_tindakan_bk, 'Edit Tindakan Bk')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/tindakan_bk');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/tindakan_bk');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Tindakan Bks
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('tindakan_bk_update');

		$this->data['tindakan_bk'] = $this->model_tindakan_bk->find($id);

		$this->template->title('Tindakan Bk Update');
		$this->render('backend/standart/administrator/tindakan_bk/tindakan_bk_update', $this->data);
	}

	/**
	* Update Tindakan Bks
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('tindakan_bk_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
		$this->form_validation->set_rules('id_siswa', 'Id Siswa', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('isi_tindakan', 'Isi Tindakan', 'trim|required');
		$this->form_validation->set_rules('id_guru_bk', 'Id Guru Bk', 'trim|required|max_length[11]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'tanggal' => $this->input->post('tanggal'),
				'id_siswa' => $this->input->post('id_siswa'),
				'isi_tindakan' => $this->input->post('isi_tindakan'),
				'id_guru_bk' => $this->input->post('id_guru_bk'),
			];

			
			$save_tindakan_bk = $this->model_tindakan_bk->change($id, $save_data);

			if ($save_tindakan_bk) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/tindakan_bk', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/tindakan_bk');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/tindakan_bk');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Tindakan Bks
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('tindakan_bk_delete');

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
            set_message(cclang('has_been_deleted', 'tindakan_bk'), 'success');
        } else {
            set_message(cclang('error_delete', 'tindakan_bk'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Tindakan Bks
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('tindakan_bk_view');

		$this->data['tindakan_bk'] = $this->model_tindakan_bk->join_avaiable()->find($id);

		$this->template->title('Tindakan Bk Detail');
		$this->render('backend/standart/administrator/tindakan_bk/tindakan_bk_view', $this->data);
	}
	
	/**
	* delete Tindakan Bks
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$tindakan_bk = $this->model_tindakan_bk->find($id);

		
		
		return $this->model_tindakan_bk->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('tindakan_bk_export');

		$this->model_tindakan_bk->export('tindakan_bk', 'tindakan_bk');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('tindakan_bk_export');

		$this->model_tindakan_bk->pdf('tindakan_bk', 'tindakan_bk');
	}

	public function view_rombel($id_kodesekolah, $id_semester = null) 
	 {

		// var_dump($id_semester);
		// die;

		if ($id_semester != null ) {
      $getBulanAwal		= $this->model_tindakan_bk->getBulanAwal($id_semester);
      $getTahunAwal		= $this->model_tindakan_bk->getTahunAwal($id_semester);
      $getBulanAkhir	= $this->model_tindakan_bk->getBulanAkhir($id_semester);
      // $getTahunAkhir	= $this->model_tindakan_bk->getTahunAkhir($id_semester);
    } else {
      $getBulanAwal		= null;
      $getTahunAwal		= null;
      $getBulanAkhir	= null;
      // $getTahunAkhir	= null;
    }

	 	$this->data['tindakan_bks'] = $this->model_tindakan_bk->getRombel($id_kodesekolah);
		$this->data['tindakan_bk_counts'] = $this->model_tindakan_bk->count_allRombel($id_kodesekolah);
		$this->data['id_semester'] =  $id_semester;
		$this->data['getBulanAwal'] =  $getBulanAwal;
		$this->data['getBulanAkhir'] =  $getBulanAkhir;
		$this->data['getTahunAwal'] =  $getTahunAwal;
		$this->data['maxIdPeriodeList'] = $this->model_tindakan_bk->maxIdPeriodeList();

			$config = [
				'base_url'     => 'administrator/tindakan_bk/view_rombel/',
				'total_rows'   => $this->model_tindakan_bk->count_allRombel($id_kodesekolah),
				'per_page'     => $this->limit_page,
				'uri_segment'  => 4,
			];

		$this->data['pagination'] = $this->pagination($config);

	 	$this->template->title('Tindakan Bk View Rombel');
		$this->render('backend/standart/administrator/tindakan_bk/tindakan_bk_view_rombel', $this->data);
	}

	public function view_amatan() 
	 {
 		$id_kodesekolah	= $this->uri->segment(4);
		$id_rombel 			= $this->uri->segment(5);
		$id_semester 		= $this->uri->segment(6);

		if ($id_semester != null ) {
      $getBulanAwal		= $this->model_tindakan_bk->getBulanAwal($id_semester);
      $getTahunAwal		= $this->model_tindakan_bk->getTahunAwal($id_semester);
      $getBulanAkhir	= $this->model_tindakan_bk->getBulanAkhir($id_semester);
      // $getTahunAkhir	= $this->model_tindakan_bk->getTahunAkhir($id_semester);
    } else {
      $getBulanAwal		= null;
      $getTahunAwal		= null;
      $getBulanAkhir	= null;
      // $getTahunAkhir	= null;
    }

		$this->data['tindakan_bks'] = $this->model_tindakan_bk->getAmatan($id_rombel, $getBulanAwal, $getTahunAwal, $getBulanAkhir);
		$this->data['tindakan_bk_counts'] = $this->model_tindakan_bk->count_allAmatan($id_rombel, $getBulanAwal, $getTahunAwal, $getBulanAkhir);
		$this->data['id_kodesekolah'] = $id_kodesekolah;
		$this->data['id_semester'] =  $id_semester;
		$this->data['getBulanAwal'] =  $getBulanAwal;
		$this->data['getBulanAkhir'] =  $getBulanAkhir;
		$this->data['getTahunAwal'] =  $getTahunAwal;

			$config = [
				'base_url'     => 'administrator/tindakan_bk/view_amatan/',
				'total_rows'   => $this->model_tindakan_bk->count_allAmatan($id_rombel, $getBulanAwal, $getTahunAwal, $getBulanAkhir),
				'per_page'     => $this->limit_page,
				'uri_segment'  => 4,
			];

		$this->data['pagination'] = $this->pagination($config);

	 	$this->template->title('Tindakan Bk View Amatan');
		$this->render('backend/standart/administrator/tindakan_bk/tindakan_bk_view_amatan', $this->data);
	}

	public function view_detail_amatan() 
	 {
 		$id_kodesekolah	= $this->uri->segment(4);
		$id_rombel 			= $this->uri->segment(5);
		$id_siswa 			= $this->uri->segment(6);
		$id_semester 		= $this->uri->segment(7);

		if ($id_semester != null ) {
      $getBulanAwal		= $this->model_tindakan_bk->getBulanAwal($id_semester);
      $getTahunAwal		= $this->model_tindakan_bk->getTahunAwal($id_semester);
      $getBulanAkhir	= $this->model_tindakan_bk->getBulanAkhir($id_semester);
      // $getTahunAkhir	= $this->model_tindakan_bk->getTahunAkhir($id_semester);
    } else {
      $getBulanAwal		= null;
      $getTahunAwal		= null;
      $getBulanAkhir	= null;
      // $getTahunAkhir	= null;
    }
		
		// var_dump($id_kodesekolah);
		// var_dump($id_siswa);
		// die;

		$this->data['id_kodesekolah'] = $id_kodesekolah;
		$this->data['id_rombel'] 			= $id_rombel;
		$this->data['id_semester'] 			= $id_semester;

		$this->data['isian_amatan_bk_details'] = $this->model_isian_amatan->isian_amatan_bk_detail($id_siswa, $id_kodesekolah, $getBulanAwal, $getTahunAwal, $getBulanAkhir);
		
		$this->data['tindakan_bks'] = $this->model_tindakan_bk->getDataBK($id_siswa, $getBulanAwal, $getTahunAwal, $getBulanAkhir);
		$this->data['tindakan_bk_counts'] = $this->model_tindakan_bk->count_allDataBK($id_siswa, $getBulanAwal, $getTahunAwal, $getBulanAkhir);

	 	$this->template->title('Tindakan Bk View Detail Amatan');
		$this->render('backend/standart/administrator/tindakan_bk/tindakan_bk_view_detail_amatan', $this->data);
	}
}


/* End of file tindakan_bk.php */
/* Location: ./application/controllers/administrator/Tindakan Bk.php */
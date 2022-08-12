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

		$a = $this->session->groups;
		if ($a == 24) {
			$filter = $this->input->get('q');
			$field 	= $this->input->get('f');

			$this->data['rapot_pbps'] = $this->model_rapot_pbp->get2($filter, $field, $this->limit_page, $offset);
			$this->data['rapot_pbp_counts'] = $this->model_rapot_pbp->count_all2($filter, $field);

			$config = [
				'base_url'     => 'administrator/rapot_pbp/index/',
				'total_rows'   => $this->model_rapot_pbp->count_all2($filter, $field),
				'per_page'     => $this->limit_page,
				'uri_segment'  => 4,
			];
		} else {
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
		}

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

		$a = $this->session->groups;
		if ($a == 24) {
			$b  = $this->session->id;
			$this->data['id_wali'] = $this->model_rapot_pbp->getWali($b);
			// var_dump($c);
			// die;
		} else {
			$this->data['id_wali'] = 0;
		}

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

		$this->form_validation->set_rules('id_siswa', 'NIPD', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_pilar_pbp_1', 'Pilar 1', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_pilar_pbp_2', 'Pilar  2', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_pilar_pbp_3', 'Pilar  3', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_pilar_pbp_4', 'Pilar  4', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_pilar_pbp_5', 'Pilar  5', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_pilar_pbp_6', 'Pilar  6', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_semester', 'Semester', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
		$this->form_validation->set_rules('id_guru', 'Wali Kelas', 'trim|required|max_length[11]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'id_siswa' => $this->input->post('id_siswa'),
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
				'id_semester' => $this->input->post('id_semester'),
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

		// $this->data['rapot_pbp'] = $this->model_rapot_pbp->find($id);
		$this->data['rapot_pbp'] = $this->model_rapot_pbp->update_rapot($id);

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
		
		$this->form_validation->set_rules('id_siswa', 'NIPD', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_pilar_pbp_1', 'Pilar 1', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_pilar_pbp_2', 'Pilar  2', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_pilar_pbp_3', 'Pilar  3', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_pilar_pbp_4', 'Pilar  4', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_pilar_pbp_5', 'Pilar  5', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_pilar_pbp_6', 'Pilar  6', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('id_semester', 'Semester', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
		$this->form_validation->set_rules('id_guru', 'Wali Kelas', 'trim|required|max_length[11]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'id_siswa' => $this->input->post('id_siswa'),
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
				'id_semester' => $this->input->post('id_semester'),
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

	public function get_semester()
	{
		$id_siswa = $this->input->post('id_siswa');

		echo $this->model_rapot_pbp->Semester();
	}

	public function rapot_1()
	{
    $id_semester 		= $this->input->post('id_semester');
    $id_siswa 			= $this->input->post('id_siswa');
    $id_pilar_pbp_1 = $this->input->post('id_pilar_pbp_1');

    $bulanAwal  = $this->model_rapot_pbp->getBulanAwal($id_semester);
    $tahunAwal  = $this->model_rapot_pbp->getTahunAwal($id_semester);
    $bulanAkhir = $this->model_rapot_pbp->getBulanAkhir($id_semester);
    $tahunAkhir = $this->model_rapot_pbp->getTahunAkhir($id_semester);

    $data = $this->model_rapot_pbp->getPilar_1($id_siswa, $id_pilar_pbp_1, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir);
		
		echo json_encode($data);
	}

	public function rapot_2()
	{
    $id_semester 		= $this->input->post('id_semester');
    $id_siswa 			= $this->input->post('id_siswa');
    $id_pilar_pbp_2 = $this->input->post('id_pilar_pbp_2');

    $bulanAwal  = $this->model_rapot_pbp->getBulanAwal($id_semester);
    $tahunAwal  = $this->model_rapot_pbp->getTahunAwal($id_semester);
    $bulanAkhir = $this->model_rapot_pbp->getBulanAkhir($id_semester);
    $tahunAkhir = $this->model_rapot_pbp->getTahunAkhir($id_semester);

    $data = $this->model_rapot_pbp->getPilar_2($id_siswa, $id_pilar_pbp_2, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir);
		
		echo json_encode($data);
	}

	public function rapot_3()
	{
    $id_semester 		= $this->input->post('id_semester');
    $id_siswa 			= $this->input->post('id_siswa');
    $id_pilar_pbp_3 = $this->input->post('id_pilar_pbp_3');

    $bulanAwal  = $this->model_rapot_pbp->getBulanAwal($id_semester);
    $tahunAwal  = $this->model_rapot_pbp->getTahunAwal($id_semester);
    $bulanAkhir = $this->model_rapot_pbp->getBulanAkhir($id_semester);
    $tahunAkhir = $this->model_rapot_pbp->getTahunAkhir($id_semester);

    $data = $this->model_rapot_pbp->getPilar_3($id_siswa, $id_pilar_pbp_3, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir);
		
		echo json_encode($data);
	}

	public function rapot_4()
	{
    $id_semester 		= $this->input->post('id_semester');
    $id_siswa 			= $this->input->post('id_siswa');
    $id_pilar_pbp_4 = $this->input->post('id_pilar_pbp_4');

    $bulanAwal  = $this->model_rapot_pbp->getBulanAwal($id_semester);
    $tahunAwal  = $this->model_rapot_pbp->getTahunAwal($id_semester);
    $bulanAkhir = $this->model_rapot_pbp->getBulanAkhir($id_semester);
    $tahunAkhir = $this->model_rapot_pbp->getTahunAkhir($id_semester);

    $data = $this->model_rapot_pbp->getPilar_4($id_siswa, $id_pilar_pbp_4, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir);
		
		echo json_encode($data);
	}

	public function rapot_5()
	{
    $id_semester 		= $this->input->post('id_semester');
    $id_siswa 			= $this->input->post('id_siswa');
    $id_pilar_pbp_5 = $this->input->post('id_pilar_pbp_5');

    $bulanAwal  = $this->model_rapot_pbp->getBulanAwal($id_semester);
    $tahunAwal  = $this->model_rapot_pbp->getTahunAwal($id_semester);
    $bulanAkhir = $this->model_rapot_pbp->getBulanAkhir($id_semester);
    $tahunAkhir = $this->model_rapot_pbp->getTahunAkhir($id_semester);

    $data = $this->model_rapot_pbp->getPilar_5($id_siswa, $id_pilar_pbp_5, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir);
		
		echo json_encode($data);
	}

	public function rapot_6()
	{
    $id_semester 		= $this->input->post('id_semester');
    $id_siswa 			= $this->input->post('id_siswa');
    $id_pilar_pbp_6 = $this->input->post('id_pilar_pbp_6');

    $bulanAwal  = $this->model_rapot_pbp->getBulanAwal($id_semester);
    $tahunAwal  = $this->model_rapot_pbp->getTahunAwal($id_semester);
    $bulanAkhir = $this->model_rapot_pbp->getBulanAkhir($id_semester);
    $tahunAkhir = $this->model_rapot_pbp->getTahunAkhir($id_semester);

    $data = $this->model_rapot_pbp->getPilar_6($id_siswa, $id_pilar_pbp_6, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir);
		
		echo json_encode($data);
	}

	public function cetak_pdf($id_rapot_pbp)
	{
		$title = 'Cetak Rapot PBP_'.date('d-m-Y');

		$nama_siswa 	= $this->model_rapot_pbp->getNamaSiswa($id_rapot_pbp);
		$id_siswa 		= $this->model_rapot_pbp->getIdSiswa($id_rapot_pbp);
		$NIPD 				= $this->model_rapot_pbp->getNIPD($id_rapot_pbp);
		$kelas 				= $this->model_rapot_pbp->getKelas($id_rapot_pbp);
		$semester 		= $this->model_rapot_pbp->getSemester($id_rapot_pbp);
		$kode_sekolah = $this->model_rapot_pbp->getKodeSekolah($id_rapot_pbp);
		$wali_kelas		= $this->model_rapot_pbp->getWaliKelas($id_rapot_pbp);
		$getTanggal  	= $this->model_rapot_pbp->getTanggal($id_rapot_pbp);

		// catatan rapot
		$Catatan_1 	= $this->model_rapot_pbp->getCatatan_1($id_rapot_pbp);
		$Catatan_2 	= $this->model_rapot_pbp->getCatatan_2($id_rapot_pbp);
		$Catatan_3 	= $this->model_rapot_pbp->getCatatan_3($id_rapot_pbp);
		$Catatan_4 	= $this->model_rapot_pbp->getCatatan_4($id_rapot_pbp);
		$Catatan_5 	= $this->model_rapot_pbp->getCatatan_5($id_rapot_pbp);
		$Catatan_6 	= $this->model_rapot_pbp->getCatatan_6($id_rapot_pbp);

		// id Pilar
		$IdPilar_1 	= $this->model_rapot_pbp->getIdPilar_1($id_rapot_pbp);
		$IdPilar_2 	= $this->model_rapot_pbp->getIdPilar_2($id_rapot_pbp);
		$IdPilar_3 	= $this->model_rapot_pbp->getIdPilar_3($id_rapot_pbp);
		$IdPilar_4 	= $this->model_rapot_pbp->getIdPilar_4($id_rapot_pbp);
		$IdPilar_5 	= $this->model_rapot_pbp->getIdPilar_5($id_rapot_pbp);
		$IdPilar_6 	= $this->model_rapot_pbp->getIdPilar_6($id_rapot_pbp);

		// Get Id Semester
		$id_semester = $this->model_rapot_pbp->getIdSemseter($id_rapot_pbp);

		// Get Data Semester
		$bulanAwal  = $this->model_rapot_pbp->getBulanAwal($id_semester);
    $tahunAwal  = $this->model_rapot_pbp->getTahunAwal($id_semester);
    $bulanAkhir = $this->model_rapot_pbp->getBulanAkhir($id_semester);
    $tahunAkhir = $this->model_rapot_pbp->getTahunAkhir($id_semester);

		// Get Jumlah Data Per Id Pilar
		$dataJumlahAmatanPilar_1 = $this->model_rapot_pbp->dataJumlahAmatanPilar_1($id_siswa, $IdPilar_1, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir);
		$dataJumlahAmatanPilar_2 = $this->model_rapot_pbp->dataJumlahAmatanPilar_2($id_siswa, $IdPilar_2, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir);
		$dataJumlahAmatanPilar_3 = $this->model_rapot_pbp->dataJumlahAmatanPilar_3($id_siswa, $IdPilar_3, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir);
		$dataJumlahAmatanPilar_4 = $this->model_rapot_pbp->dataJumlahAmatanPilar_4($id_siswa, $IdPilar_4, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir);
		$dataJumlahAmatanPilar_5 = $this->model_rapot_pbp->dataJumlahAmatanPilar_5($id_siswa, $IdPilar_5, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir);
		$dataJumlahAmatanPilar_6 = $this->model_rapot_pbp->dataJumlahAmatanPilar_6($id_siswa, $IdPilar_6, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir);

		// Get Data Per Id Pilar
		$dataAmatanPilar_1 = $this->model_rapot_pbp->dataAmatanPilar_1($id_siswa, $IdPilar_1, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir);
		$dataAmatanPilar_2 = $this->model_rapot_pbp->dataAmatanPilar_2($id_siswa, $IdPilar_2, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir);
		$dataAmatanPilar_3 = $this->model_rapot_pbp->dataAmatanPilar_3($id_siswa, $IdPilar_3, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir);
		$dataAmatanPilar_4 = $this->model_rapot_pbp->dataAmatanPilar_4($id_siswa, $IdPilar_4, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir);
		$dataAmatanPilar_5 = $this->model_rapot_pbp->dataAmatanPilar_5($id_siswa, $IdPilar_5, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir);
		$dataAmatanPilar_6 = $this->model_rapot_pbp->dataAmatanPilar_6($id_siswa, $IdPilar_6, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir);


		$html = '
					<page backimg="" backtop="40mm" backbottom="0mm" backleft="1cm" backright="1cm">
				    <page_header>
				        <div style="width:750px; text-align:center; margin-left:0mm;">';

								if ($kode_sekolah == 1) {
									$html .='<img style="width:80px; height:80px;" src="'. BASE_ASSET.'/img/SMP.png">';
								} else if ($kode_sekolah == 2) {
									$html .='<img style="width:80px; height:80px;" src="'. BASE_ASSET.'/img/SMA.png">';
								} else if ($kode_sekolah == 3) {
									$html .='<img style="width:80px; height:80px;" src="'. BASE_ASSET.'/img/SMK.png">';
								}

				$html .=' <br> <br>
					        <b style="font-size: 20px"> RAPOR PENDIDIKAN BUDI PEKERTI </b> <br>';

									if ($kode_sekolah == 1) {
											$html .='<b style="font-size: 20px"> SMP Wijaya Putra </b> <br>';
									} else if ($kode_sekolah == 2) {
										$html .='<b style="font-size: 20px"> SMA Wijaya Putra </b> <br>';
									} else if ($kode_sekolah == 3) {
										$html .='<b style="font-size: 20px"> SMK Wijaya Putra </b> <br>';
									}
					        
			$html .= '<hr>
					      </div>
					      
				    </page_header>
				    <page_footer>
				    		
				    </page_footer>

				    <div style="margin-right: 500px; margin-top: 0px;">
							<table style="border-collapse: collapse; width: 100%; margin-left:0mm;">
								<tr>
									<td>
										<div style="width: 85px;">
											Nama Siswa  <br> <br>
											Nomor Induk  
										</div>
									</td>
									<td>
										<div style="width: 7px;">
											: <br> <br>
											: 
										</div>
									</td>
									<td>
										<div style="width: 250px;">
											'.$nama_siswa.' <br> <br>
											'.$NIPD.'
										</div>
									</td>
									<td><div style="width: 190px;"></div></td>
									<td>
										<div style="width: 65px;">
											Kelas  <br> <br>
											Semester  
										</div>
									</td>
									<td>
										<div style="width: 7px;">
											: <br> <br>
											: 
										</div>
									</td>
									<td>
										<div style="width: 137px;">
											'.$kelas.' <br> <br>
											'.$semester.'
										</div>
									</td>
								</tr>
							</table>

			        <table border="1px solid black" style="border-collapse: collapse; width: 100%;">
			          <tr>
			            <th>
			              <div style="width: 752px; background-color:#ddd7d8;">
                       I. Pilar Dapat Dipercaya
			              </div>
				          </th>
				        </tr>
				        <tr>
				          <td>
				          	<div style="width: 740px; height: 50px; text-align: justify; padding-left:5px; padding-right:5px;">
                       '.$Catatan_1.'
			              </div>
				          </td>
				        </tr>
				      </table>
				      <br>

				      <table border="1px solid black" style="border-collapse: collapse; width: 100%;">
			          <tr>
			            <th>
			              <div style="width: 752px; background-color:#ddd7d8;">
                       II. Pilar Tanggung Jawab
			              </div>
				          </th>
				        </tr>
				        <tr>
				          <td>
				          	<div style="width: 740px; height: 50px; text-align: justify; padding-left:5px; padding-right:5px;">
                       '.$Catatan_2.'
			              </div>
				          </td>
				        </tr>
				      </table>
				      <br>

				      <table border="1px solid black" style="border-collapse: collapse; width: 100%;">
			          <tr>
			            <th>
			              <div style="width: 752px; background-color:#ddd7d8;">
                       III. Pilar Menghormati
			              </div>
				          </th>
				        </tr>
				        <tr>
				          <td>
				          	<div style="width: 740px; height: 50px; text-align: justify; padding-left:5px; padding-right:5px;">
                       '.$Catatan_3.'
			              </div>
				          </td>
				        </tr>
				      </table>
				      <br>

				      <table border="1px solid black" style="border-collapse: collapse; width: 100%;">
			          <tr>
			            <th>
			              <div style="width: 752px; background-color:#ddd7d8;">
                       IV. Pilar Peduli
			              </div>
				          </th>
				        </tr>
				        <tr>
				          <td>
				          	<div style="width: 740px; height: 50px; text-align: justify; padding-left:5px; padding-right:5px;">
                       '.$Catatan_4.'
			              </div>
				          </td>
				        </tr>
				      </table>
				      <br>

				      <table border="1px solid black" style="border-collapse: collapse; width: 100%;">
			          <tr>
			            <th>
			              <div style="width: 752px; background-color:#ddd7d8;">
                       V. Pilar Sportif
			              </div>
				          </th>
				        </tr>
				        <tr>
				          <td>
				          	<div style="width: 740px; height: 50px; text-align: justify; padding-left:5px; padding-right:5px;">
                      '.$Catatan_5.'
			              </div>
				          </td>
				        </tr>
				      </table>
				      <br>

				      <table border="1px solid black" style="border-collapse: collapse; width: 100%;">
			          <tr>
			            <th>
			              <div style="width: 752px; background-color:#ddd7d8;">
                       VI. Pilar Warga Negara Yang Baik
			              </div>
				          </th>
				        </tr>
				        <tr>
				          <td>
				          	<div style="width: 740px; height: 50px; text-align: justify; padding-left:5px; padding-right:5px;">
                       '.$Catatan_6.'
			              </div>
				          </td>
				        </tr>
				      </table>
				      <br>
		 					<br>
			        <table style="border-collapse: collapse; width: 100%;">
			          <tr>
			            <td>
			              <div style="width: 300px; text-align:center;">
                            Ketua, <br>
                            Pusat Pendidikan Budi Pekerti <br><br><br><br><br><br><br>
                            Drs. H. AGUS BUDI RAHAYU, SH., MM.

			              </div>
				          </td>
				          <td><div style="width: 150px;"></div></td>
				          <td>
				            <div style="width: 300px; text-align:center;">
				              Surabaya, '.$this->tgl_indo($getTanggal).'<br>
				              Wali Kelas <br><br><br><br><br><br><br>
				               '.$wali_kelas.'
				            </div>
				          </td>
				        </tr>
				      </table>
				      
				      <br>

				      <table style="border-collapse: collapse; width: 100%;">
				          <tr>
				            <td>
				              <div style="width: 200px; text-align:center;">

				              </div>
				          </td>
				          <td>
				          	<div style="width: 350px; text-align:center;">
                              Mengetahui <br>
                              Kepala Sekolah, <br><br><br><br><br><br><br><br>';

                              if ($kode_sekolah == 1) {
								                  $html .='Drs. Sukono, M.Si.';
								              } else if ($kode_sekolah == 2) {
								                $html .='ANDRI PRIYONO DJOKO SEMBODO, S.Pd., M.Si.';
								              } else if ($kode_sekolah == 3) {
								                $html .='SUGENG, S.Pd., M.Si.';
								              }
                              
				   $html .='</div>
				         	</td>
				          <td>
				            <div style="width: 200px; text-align:center;">
				              
				            </div>
				          </td>
				        </tr>
				      </table>
			    	</div>

					</page>';

	$html .='
				<page backimg="" backtop="40mm" backbottom="0mm" backleft="1cm" backright="1cm">
					<page_header>
		        <div style="width:750px; text-align:center; margin-left:0mm">';

						if ($kode_sekolah == 1) {
								$html .='<img style="width:80px; height:80px;" src="'. BASE_ASSET.'/img/SMP.png">';
						} else if ($kode_sekolah == 2) {
							$html .='<img style="width:80px; height:80px;" src="'. BASE_ASSET.'/img/SMA.png">';
						} else if ($kode_sekolah == 3) {
							$html .='<img style="width:80px; height:80px;" src="'. BASE_ASSET.'/img/SMK.png">';
						}

		$html .='	<br> <br> 
							<b style="font-size: 20px"> Laporan Pengamatan Perilaku Siswa </b> <br>';

			        if ($kode_sekolah == 1) {
                  $html .='<b style="font-size: 20px"> SMP Wijaya Putra </b> <br>';
              } else if ($kode_sekolah == 2) {
                $html .='<b style="font-size: 20px"> SMA Wijaya Putra </b> <br>';
              } else if ($kode_sekolah == 3) {
                $html .='<b style="font-size: 20px"> SMK Wijaya Putra </b> <br>';
              }
			        
	$html .=' <hr>
			      </div>
			      
			    </page_header>
			    <page_footer>
			    		
			    </page_footer>

			    <div style="margin-right: 500px; margin-top: 0px;">
						<table style="border-collapse: collapse; width: 100%; margin-left:0mm">
							<tr>
								<td>
									<div style="width: 85px;">
										Nama Siswa  <br> <br>
										Nomor Induk  
									</div>
								</td>
								<td>
									<div style="width: 7px;">
										: <br> <br>
										: 
									</div>
								</td>
								<td>
									<div style="width: 250px;">
										'.$nama_siswa.' <br> <br>
										'.$NIPD.'
									</div>
								</td>
								<td><div style="width: 190px;"></div></td>
								<td>
									<div style="width: 65px;">
										Kelas  <br> <br>
										Semester  
									</div>
								</td>
								<td>
									<div style="width: 7px;">
										: <br> <br>
										: 
									</div>
								</td>
								<td>
									<div style="width: 137px;">
										'.$kelas.' <br> <br>
										'.$semester.'
									</div>
								</td>
							</tr>
						</table>

			    	<table border="1px solid black" style="border-collapse: collapse; width: 99%;">
		          <thead>
		            <tr style="text-align:center; font-size: 14px; background-color:#ddd7d8;">
		               <th>No.</th>
		               <th>Tanggal</th>
		               <th>Jam</th>
		               <th>Perilaku</th>
		               <th>Lokasi</th>
		               <th>Pengamat</th>
		            </tr>
		          </thead>
		          <tbody>
		          	<tr style="font-size: 12px">
		          		<th colspan="6"> <div style="width:100%; height:4%;"> <p style="margin-top:7px;"> I. Pilar Dapat Dipercaya </p> </div> </th>
		          	</tr>';
		          if ($dataJumlahAmatanPilar_1 == 0) {
		          	$html .= '
			          	<tr style="font-size: 12px">

			          		<td> <div style="text-align:center; width:10px;">  </div> </td>
			          		<td> <div style="text-align:center; width:60px;">  </div> </td>
			          		<td> <div style="text-align:center; width:50px;">  </div> </td>
			          		<td> <div style="width:316px;"> - </div> </td>
			          		<td> <div style="text-align:center; width:90px;">  </div> </td>
			          		<td> <div style="width:150px;"> </div> </td>

			          	</tr> ';
		          } else {
		          	$no = 1;
			        	foreach($dataAmatanPilar_1 as $pilar_1){
			          $html .= '
			          	<tr style="font-size: 11px">

			          		<td> <div style="text-align:center; width:10px;"> '. $no++ .' </div> </td>
			          		<td> <div style="text-align:center; width:60px;"> '. date("d-m-Y", strtotime($pilar_1->tanggal)) .' </div> </td>
			          		<td> <div style="text-align:center; width:50px;"> '. $pilar_1->jam .' </div> </td>
			          		<td> <div style="width:316px;"> '. $pilar_1->isi_amatan .' </div> </td>
			          		<td> <div style="text-align:center; width:90px;"> '. $pilar_1->nama_lokasi .' </div> </td>
			          		<td> <div style="width:150px;"> '. $pilar_1->nama_guru .' </div> </td>

			          	</tr> ';
			          }
		          }

			$html .= '
		          	<tr style="font-size: 12px">
		          		<th colspan="6"> <div style="width:100%; height:2%;"> </div> </th>
		          	</tr>
		          </tbody>

		          <tbody>
		          	<tr style="font-size: 12px">
		          		<th colspan="6"> <div style="width:100%; height:4%;"> <p style="margin-top:7px;"> II. Pilar Tanggung Jawab </p> </div> </th>
		          	</tr>';
		          if ($dataJumlahAmatanPilar_2 == 0) {
		          	$html .= '
			          	<tr style="font-size: 12px">

			          		<td> <div style="text-align:center; width:10px;">  </div> </td>
			          		<td> <div style="text-align:center; width:60px;">  </div> </td>
			          		<td> <div style="text-align:center; width:50px;">  </div> </td>
			          		<td> <div style="width:316px;"> - </div> </td>
			          		<td> <div style="text-align:center; width:90px;">  </div> </td>
			          		<td> <div style="width:150px;"> </div> </td>

			          	</tr> ';
		          } else {
		          	$no = 1;
			        	foreach($dataAmatanPilar_2 as $pilar_2){
			          $html .= '
			          	<tr style="font-size: 11px">

			          		<td> <div style="text-align:center; width:10px;"> '. $no++ .' </div> </td>
			          		<td> <div style="text-align:center; width:60px;"> '. date("d-m-Y", strtotime($pilar_2->tanggal)) .' </div> </td>
			          		<td> <div style="text-align:center; width:50px;"> '. $pilar_2->jam .' </div> </td>
			          		<td> <div style="width:316px;"> '. $pilar_2->isi_amatan .' </div> </td>
			          		<td> <div style="text-align:center; width:90px;"> '. $pilar_2->nama_lokasi .' </div> </td>
			          		<td> <div style="width:150px;"> '. $pilar_2->nama_guru .' </div> </td>

			          	</tr> ';
			          }
		          }

			$html .= '
		          	<tr style="font-size: 12px">
		          		<th colspan="6"> <div style="width:100%; height:2%;"> </div> </th>
		          	</tr>
		          </tbody>

		          <tbody>
		          	<tr style="font-size: 12px">
		          		<th colspan="6"> <div style="width:100%; height:4%;"> <p style="margin-top:7px;"> III. Pilar Menghormati </p> </div> </th>
		          	</tr>';
		          if ($dataJumlahAmatanPilar_3 == 0) {
		          	$html .= '
			          	<tr style="font-size: 12px">

			          		<td> <div style="text-align:center; width:10px;">  </div> </td>
			          		<td> <div style="text-align:center; width:60px;">  </div> </td>
			          		<td> <div style="text-align:center; width:50px;">  </div> </td>
			          		<td> <div style="width:316px;"> - </div> </td>
			          		<td> <div style="text-align:center; width:90px;">  </div> </td>
			          		<td> <div style="width:150px;"> </div> </td>

			          	</tr> ';
		          } else {
		          	$no = 1;
			        	foreach($dataAmatanPilar_3 as $pilar_3){
			          $html .= '
			          	<tr style="font-size: 11px">

			          		<td> <div style="text-align:center; width:10px;"> '. $no++ .' </div> </td>
			          		<td> <div style="text-align:center; width:60px;"> '. date("d-m-Y", strtotime($pilar_3->tanggal)) .' </div> </td>
			          		<td> <div style="text-align:center; width:50px;"> '. $pilar_3->jam .' </div> </td>
			          		<td> <div style="width:316px;"> '. $pilar_3->isi_amatan .' </div> </td>
			          		<td> <div style="text-align:center; width:90px;"> '. $pilar_3->nama_lokasi .' </div> </td>
			          		<td> <div style="width:150px;"> '. $pilar_3->nama_guru .' </div> </td>

			          	</tr> ';
			          }
		          }

			$html .= '
		          	<tr style="font-size: 12px">
		          		<th colspan="6"> <div style="width:100%; height:2%;"> </div> </th>
		          	</tr>
		          </tbody>

		          <tbody>
		          	<tr style="font-size: 12px">
		          		<th colspan="6"> <div style="width:100%; height:4%;"> <p style="margin-top:7px;"> IV. Pilar Peduli </p> </div> </th>
		          	</tr>';
		          if ($dataJumlahAmatanPilar_4 == 0) {
		          	$html .= '
			          	<tr style="font-size: 12px">

			          		<td> <div style="text-align:center; width:10px;">  </div> </td>
			          		<td> <div style="text-align:center; width:60px;">  </div> </td>
			          		<td> <div style="text-align:center; width:50px;">  </div> </td>
			          		<td> <div style="width:316px;"> - </div> </td>
			          		<td> <div style="text-align:center; width:90px;">  </div> </td>
			          		<td> <div style="width:150px;"> </div> </td>

			          	</tr> ';
		          } else {
		          	$no = 1;
			        	foreach($dataAmatanPilar_4 as $pilar_4){
			          $html .= '
			          	<tr style="font-size: 11px">

			          		<td> <div style="text-align:center; width:10px;"> '. $no++ .' </div> </td>
			          		<td> <div style="text-align:center; width:60px;"> '. date("d-m-Y", strtotime($pilar_4->tanggal)) .' </div> </td>
			          		<td> <div style="text-align:center; width:50px;"> '. $pilar_4->jam .' </div> </td>
			          		<td> <div style="width:316px;"> '. $pilar_4->isi_amatan .' </div> </td>
			          		<td> <div style="text-align:center; width:90px;"> '. $pilar_4->nama_lokasi .' </div> </td>
			          		<td> <div style="width:150px;"> '. $pilar_4->nama_guru .' </div> </td>

			          	</tr> ';
			          }
		          }

			$html .= '
		          	<tr style="font-size: 12px">
		          		<th colspan="6"> <div style="width:100%; height:2%;"> </div> </th>
		          	</tr>
		          </tbody>

		          <tbody>
		          	<tr style="font-size: 12px">
		          		<th colspan="6"> <div style="width:100%; height:4%;"> <p style="margin-top:7px;"> V. Pilar Sportif </p> </div> </th>
		          	</tr>';
		          if ($dataJumlahAmatanPilar_5 == 0) {
		          	$html .= '
			          	<tr style="font-size: 12px">

			          		<td> <div style="text-align:center; width:10px;">  </div> </td>
			          		<td> <div style="text-align:center; width:60px;">  </div> </td>
			          		<td> <div style="text-align:center; width:50px;">  </div> </td>
			          		<td> <div style="width:316px;"> - </div> </td>
			          		<td> <div style="text-align:center; width:90px;">  </div> </td>
			          		<td> <div style="width:150px;"> </div> </td>

			          	</tr> ';
		          } else {
		          	$no = 1;
			        	foreach($dataAmatanPilar_5 as $pilar_5){
			          $html .= '
			          	<tr style="font-size: 11px">

			          		<td> <div style="text-align:center; width:10px;"> '. $no++ .' </div> </td>
			          		<td> <div style="text-align:center; width:60px;"> '. date("d-m-Y", strtotime($pilar_5->tanggal)) .' </div> </td>
			          		<td> <div style="text-align:center; width:50px;"> '. $pilar_5->jam .' </div> </td>
			          		<td> <div style="width:316px;"> '. $pilar_5->isi_amatan .' </div> </td>
			          		<td> <div style="text-align:center; width:90px;"> '. $pilar_5->nama_lokasi .' </div> </td>
			          		<td> <div style="width:150px;"> '. $pilar_5->nama_guru .' </div> </td>

			          	</tr> ';
			          }
		          }

			$html .= '
		          	<tr style="font-size: 12px">
		          		<th colspan="6"> <div style="width:100%; height:2%;"> </div> </th>
		          	</tr>
		          </tbody>

		          <tbody>
		          	<tr style="font-size: 12px">
		          		<th colspan="6"> <div style="width:100%; height:4%;"> <p style="margin-top:7px;"> VI. Pilar Warga Negara Yang Baik </p> </div> </th>
		          	</tr>';
		          if ($dataJumlahAmatanPilar_6 == 0) {
		          	$html .= '
			          	<tr style="font-size: 12px">

			          		<td> <div style="text-align:center; width:10px;">  </div> </td>
			          		<td> <div style="text-align:center; width:60px;">  </div> </td>
			          		<td> <div style="text-align:center; width:50px;">  </div> </td>
			          		<td> <div style="width:316px;"> - </div> </td>
			          		<td> <div style="text-align:center; width:90px;">  </div> </td>
			          		<td> <div style="width:150px;"> </div> </td>

			          	</tr> ';
		          } else {
		          	$no = 1;
			        	foreach($dataAmatanPilar_6 as $pilar_6){
			          $html .= '
			          	<tr style="font-size: 11px">

			          		<td> <div style="text-align:center; width:10px;"> '. $no++ .' </div> </td>
			          		<td> <div style="text-align:center; width:60px;"> '. date("d-m-Y", strtotime($pilar_6->tanggal)) .' </div> </td>
			          		<td> <div style="text-align:center; width:50px;"> '. $pilar_6->jam .' </div> </td>
			          		<td> <div style="width:316px;"> '. $pilar_6->isi_amatan .' </div> </td>
			          		<td> <div style="text-align:center; width:90px;"> '. $pilar_6->nama_lokasi .' </div> </td>
			          		<td> <div style="width:150px;"> '. $pilar_6->nama_guru .' </div> </td>

			          	</tr> ';
			          }
		          }

			$html .= '
		          </tbody>
		        </table>
		        <br>
		        <br>
		        <table style="border-collapse: collapse; width: 100%;">
			          <tr>
			            <td>
			              <div style="width: 300px; text-align:center;">
                            Ketua, <br>
                            Pusat Pendidikan Budi Pekerti <br><br><br><br><br><br><br>
                            Drs. H. AGUS BUDI RAHAYU, SH., MM.

			              </div>
				          </td>
				          <td><div style="width: 150px;"></div></td>
				          <td>
				            <div style="width: 300px; text-align:center;">
				              Surabaya, '.$this->tgl_indo($getTanggal).'<br>
				             	Wali Kelas <br><br><br><br><br><br><br>
				              '.$wali_kelas.'
				            </div>
				          </td>
				        </tr>
				      </table>
			    </div>
				</page>';

			    require_once(APPPATH . "libraries/htmlpdf/html2pdf.class.php");
			    $html2pdf = new HTML2PDF ('P', 'A4', 'en', false, 'UTF-8');
			    $html2pdf->writeHTML($html);
			    $html2pdf->Output($nama_siswa.'.pdf', 'H');
	}

	function tgl_indo($getTanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $getTanggal);
	
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
 
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

}


/* End of file rapot_pbp.php */
/* Location: ./application/controllers/administrator/Rapot Pbp.php */
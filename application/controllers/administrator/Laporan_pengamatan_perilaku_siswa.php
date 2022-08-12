<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Laporan Pengamatan Perilaku Siswa Controller
*| --------------------------------------------------------------------------
*| Laporan Pengamatan Perilaku Siswa site
*|
*/
class Laporan_pengamatan_perilaku_siswa extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_laporan_pengamatan_perilaku_siswa');
	}

	/**
	* show all Laporan Pengamatan Perilaku Siswas
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('laporan_pengamatan_perilaku_siswa_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['laporan_pengamatan_perilaku_siswas'] = $this->model_laporan_pengamatan_perilaku_siswa->get($filter, $field, $this->limit_page, $offset);
		$this->data['laporan_pengamatan_perilaku_siswa_counts'] = $this->model_laporan_pengamatan_perilaku_siswa->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/laporan_pengamatan_perilaku_siswa/index/',
			'total_rows'   => $this->model_laporan_pengamatan_perilaku_siswa->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Laporan Pengamatan Perilaku Siswa List');
		$this->render('backend/standart/administrator/laporan_pengamatan_perilaku_siswa/laporan_pengamatan_perilaku_siswa_list', $this->data);
	}
	
	/**
	* Add new laporan_pengamatan_perilaku_siswas
	*
	*/
	public function add()
	{
		$this->is_allowed('laporan_pengamatan_perilaku_siswa_add');

		$this->template->title('Laporan Pengamatan Perilaku Siswa New');

		$this->data['fileName'] = $this->model_laporan_pengamatan_perilaku_siswa->fileName();
		$this->data['fileNameHarian'] = $this->model_laporan_pengamatan_perilaku_siswa->fileNameHarian();
		$this->data['fileNameExcel'] = $this->model_laporan_pengamatan_perilaku_siswa->fileNameExcel();
		$this->data['fileNameHarianExcel'] = $this->model_laporan_pengamatan_perilaku_siswa->fileNameHarianExcel();

		$a = $this->session->groups;

  	if ($a == 17){
  		$hariIni	= date('Y-m-d');
  		$b 				= $this->session->username;
			// var_dump($b);
			// die();
  		$sub_b 		= $this->model_laporan_pengamatan_perilaku_siswa->getIdSiswaWali($b);
			// var_dump($sub_b);
			// die();
  		$this->data['id_siswa'] = $sub_b;
    	
		$this->data['getJumlahDataHariIni'] = $this->model_laporan_pengamatan_perilaku_siswa->getJumlahDataHariIni($sub_b, $hariIni);
    $this->data['getDataHariIni'] = $this->model_laporan_pengamatan_perilaku_siswa->getDataHariIni($sub_b, $hariIni);

		$this->render('backend/standart/administrator/laporan_pengamatan_perilaku_siswa/laporan_pengamatan_perilaku_siswa_wali_add', $this->data);
  	} else {
		$this->render('backend/standart/administrator/laporan_pengamatan_perilaku_siswa/laporan_pengamatan_perilaku_siswa_add', $this->data);
  	}
	}

	/**
	* Add New Laporan Pengamatan Perilaku Siswas
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('laporan_pengamatan_perilaku_siswa_add_d', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('laporan_pengamatan_perilaku_siswa', 'Laporan Pengamatan Perilaku Siswa', 'trim|required|max_length[250]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'laporan_pengamatan_perilaku_siswa' => $this->input->post('laporan_pengamatan_perilaku_siswa'),
			];

			
			$save_laporan_pengamatan_perilaku_siswa = $this->model_laporan_pengamatan_perilaku_siswa->store($save_data);

			if ($save_laporan_pengamatan_perilaku_siswa) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_laporan_pengamatan_perilaku_siswa;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/laporan_pengamatan_perilaku_siswa/edit/' . $save_laporan_pengamatan_perilaku_siswa, 'Edit Laporan Pengamatan Perilaku Siswa'),
						anchor('administrator/laporan_pengamatan_perilaku_siswa', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/laporan_pengamatan_perilaku_siswa/edit/' . $save_laporan_pengamatan_perilaku_siswa, 'Edit Laporan Pengamatan Perilaku Siswa')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/laporan_pengamatan_perilaku_siswa');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/laporan_pengamatan_perilaku_siswa');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Laporan Pengamatan Perilaku Siswas
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('laporan_pengamatan_perilaku_siswa_update');

		$this->data['laporan_pengamatan_perilaku_siswa'] = $this->model_laporan_pengamatan_perilaku_siswa->find($id);

		$this->template->title('Laporan Pengamatan Perilaku Siswa Update');
		$this->render('backend/standart/administrator/laporan_pengamatan_perilaku_siswa/laporan_pengamatan_perilaku_siswa_update', $this->data);
	}

	/**
	* Update Laporan Pengamatan Perilaku Siswas
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('laporan_pengamatan_perilaku_siswa_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('laporan_pengamatan_perilaku_siswa', 'Laporan Pengamatan Perilaku Siswa', 'trim|required|max_length[250]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'laporan_pengamatan_perilaku_siswa' => $this->input->post('laporan_pengamatan_perilaku_siswa'),
			];

			
			$save_laporan_pengamatan_perilaku_siswa = $this->model_laporan_pengamatan_perilaku_siswa->change($id, $save_data);

			if ($save_laporan_pengamatan_perilaku_siswa) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/laporan_pengamatan_perilaku_siswa', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/laporan_pengamatan_perilaku_siswa');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/laporan_pengamatan_perilaku_siswa');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Laporan Pengamatan Perilaku Siswas
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('laporan_pengamatan_perilaku_siswa_delete');

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
            set_message(cclang('has_been_deleted', 'laporan_pengamatan_perilaku_siswa'), 'success');
        } else {
            set_message(cclang('error_delete', 'laporan_pengamatan_perilaku_siswa'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Laporan Pengamatan Perilaku Siswas
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('laporan_pengamatan_perilaku_siswa_view');

		$this->data['laporan_pengamatan_perilaku_siswa'] = $this->model_laporan_pengamatan_perilaku_siswa->join_avaiable()->find($id);

		$this->template->title('Laporan Pengamatan Perilaku Siswa Detail');
		$this->render('backend/standart/administrator/laporan_pengamatan_perilaku_siswa/laporan_pengamatan_perilaku_siswa_view', $this->data);
	}
	
	/**
	* delete Laporan Pengamatan Perilaku Siswas
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$laporan_pengamatan_perilaku_siswa = $this->model_laporan_pengamatan_perilaku_siswa->find($id);

		
		
		return $this->model_laporan_pengamatan_perilaku_siswa->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('laporan_pengamatan_perilaku_siswa_export');

		$this->model_laporan_pengamatan_perilaku_siswa->export('laporan_pengamatan_perilaku_siswa', 'laporan_pengamatan_perilaku_siswa');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('laporan_pengamatan_perilaku_siswa_export');

		$this->model_laporan_pengamatan_perilaku_siswa->pdf('laporan_pengamatan_perilaku_siswa', 'laporan_pengamatan_perilaku_siswa');
	}

	public function data_siswa()
	{
		$id_sekolah = $this->input->post('id');
		$modul = $this->input->post('modul');
		// log_message("ERROR",'aaaaa');

		if ($modul == 'sekolah') {
			echo $this->model_laporan_pengamatan_perilaku_siswa->siswa($id_sekolah);
		} elseif ($modul == 'rombel') {
			echo $this->model_laporan_pengamatan_perilaku_siswa->rombel($id_sekolah);
		}
	}

	public function rombel()
	{
		$id_sekolah = $this->input->post('id');
		$modul = $this->input->post('modul');
		// log_message("ERROR",'aaaaa');

		if ($modul == 'semua') {
			echo $this->model_laporan_pengamatan_perilaku_siswa->semua_rombel();
		} elseif ($modul == 'terpilih') {
			echo $this->model_laporan_pengamatan_perilaku_siswa->terpilih_rombel($id_sekolah);
		}
	}

	public function wali_kelas()
	{
		$id_rombel = $this->input->post('id');
		$modul = $this->input->post('modul');
		// log_message("ERROR",'aaaaa');

		if ($modul == 'rombel') {
			echo $this->model_laporan_pengamatan_perilaku_siswa->wali_kelas($id_rombel);
		}
	}

	public function proses_laporan()
	{
		if (!$this->is_allowed('laporan_pengamatan_perilaku_siswa_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('periode', 'Priode', 'trim|required');

		$this->form_validation->set_rules('minggu', 'Minggu Ke-', 'trim');
		$this->form_validation->set_rules('tahun', 'Tahun', 'trim');
		$this->form_validation->set_rules('tanggal_awal', 'Tanggal Awal', 'trim');
		$this->form_validation->set_rules('tanggal_akhir', 'Tanggal Akhir', 'trim');

		$this->form_validation->set_rules('id_siswa', 'Siswa', 'trim');
		$this->form_validation->set_rules('id_indikator_pbp', 'Pilar', 'trim');
		$this->form_validation->set_rules('id_pengamat', 'Guru', 'trim');

		$this->form_validation->set_rules('wali_kelas', 'Wali Kelas', 'trim');
		$this->form_validation->set_rules('ppbp', 'PPBP', 'trim');
		$this->form_validation->set_rules('sekolah', 'Sekolah', 'trim|required');
		$this->form_validation->set_rules('id_rombel', 'Rombel', 'trim');
		$this->form_validation->set_rules('jenis_laporan', 'Jenis Laporan', 'trim|required');
		

		if ($this->form_validation->run() == false) {
			
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();

		} else {

			$periode 					= $this->input->post('periode');
			$minggu 					= $this->input->post('minggu');
			$semester 				= $this->input->post('tahun');
			$tanggal_awal 		= $this->input->post('tanggal_awal');
			$tanggal_akhir 		= $this->input->post('tanggal_akhir');
			$id_siswa 				= $this->input->post('id_siswa');
			$id_indikator_pbp = $this->input->post('id_indikator_pbp');
			$id_pengamat 			= $this->input->post('id_pengamat');
			$wali_kelas 			= $this->input->post('wali_kelas');
			$ppbp 						= $this->input->post('ppbp');
			$sekolah 					= $this->input->post('sekolah');
			$rombel 					= $this->input->post('id_rombel');
			$jenis_laporan 		= $this->input->post('jenis_laporan');

			if ($periode == 'mingguan') { 

				$getPeriode 			= $periode;
				$getMinggu 				= $minggu;
				$getPpbp 					= $this->model_laporan_pengamatan_perilaku_siswa->getPPBP($ppbp);
				$getSemester			= $this->model_laporan_pengamatan_perilaku_siswa->getSemester($semester);
				$getBulanAwal			= $this->model_laporan_pengamatan_perilaku_siswa->getBulanAwal($semester);
				$getTahunAwal			= $this->model_laporan_pengamatan_perilaku_siswa->getTahunAwal($semester);
				$getBulanAkhir		= $this->model_laporan_pengamatan_perilaku_siswa->getBulanAkhir($semester);
				$getTahunAkhir		= $this->model_laporan_pengamatan_perilaku_siswa->getTahunAkhir($semester);

				if ($jenis_laporan == 'pdf') {

					// $data['mingguans'] = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguanAll($minggu, $tahun);

          if (empty($minggu)) { 

            if ($sekolah == 'semua') {

            	$getWali_kelas =" ";
					    $getRombel 		 =" ";
	            $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguanAllAll($getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir);

            } else {

            	if (empty($id_siswa) && empty($rombel) && empty($id_indikator_pbp) && empty($id_pengamat) && empty($wali_kelas)) {

            		$getWali_kelas =" ";
				        $getRombel 		 =" ";
            		
            		$mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguanNoMingguNoRombel($getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah);

            	} else if (empty($id_siswa) && empty($id_pengamat) && empty($id_indikator_pbp)) {

            		$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    		$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);

                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguanNoMinggu($getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $rombel);

              } else if (empty($id_indikator_pbp) && empty($id_pengamat)) {

              	$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    		$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);
                
                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguanNoMinggu7($getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_siswa, $rombel);

              } else if (empty($id_siswa) && empty($id_pengamat)) {

              	$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    		$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);
                
                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguanNoMinggu6($getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_indikator_pbp, $rombel);

              } else if (empty($id_siswa) && empty($id_indikator_pbp)) {

              	$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    		$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);
                
                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguanNoMinggu5($getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_pengamat, $rombel);

              } else if (empty($id_indikator_pbp)) {

              	$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    		$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);
                
                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguanNoMinggu4($getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_siswa, $id_pengamat, $rombel);

              } else if (empty($id_pengamat)) {

              	$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    		$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);

                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguanNoMinggu3($getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_siswa, $id_indikator_pbp, $rombel);

              } else if (empty($id_siswa)) {

              	$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    		$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);

                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguanNoMinggu2($getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_pengamat, $id_indikator_pbp, $rombel);

              } else {

              	$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    		$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);

                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguanNoMinggu1($getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_siswa, $id_pengamat, $id_indikator_pbp, $rombel);

              }

            }
            
          } else {

            if ($sekolah == 'semua') {

              if (empty($id_siswa) && empty($rombel) && empty($id_indikator_pbp) && empty($id_pengamat) && empty($wali_kelas)) {
                
                $getWali_kelas =" ";
				        $getRombel 		 =" ";
            		
            		$mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguanAllNoRombel($getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir);

              } else 
              if (empty($id_siswa) && empty($id_pengamat) && empty($id_indikator_pbp)) {

                $getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    	  $getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);

                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguanAll($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $rombel);

              } else if (empty($id_siswa) && empty($id_indikator_pbp)) {

                $getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    	  $getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);
                
                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguanAll3($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $id_pengamat, $rombel);

              } else if (empty($id_siswa) && empty($id_pengamat)) {

                $getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    	  $getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);
                
                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguanAll2($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $id_indikator_pbp, $rombel);

              } else if (empty($id_siswa)) {

                $getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    	  $getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);

                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguanAll1($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $id_indikator_pbp, $id_pengamat, $rombel);

              }

            } else {

            	if (empty($id_siswa) && empty($rombel) && empty($id_indikator_pbp) && empty($id_pengamat) && empty($wali_kelas)) {

            		$getWali_kelas =" ";
				        $getRombel 		 =" ";
            		
            		$mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguanNoRombel($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah);

            	} else if (empty($id_siswa) && empty($id_pengamat) && empty($id_indikator_pbp)) {

            		$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    		$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);

                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguan($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $rombel);

              } else if (empty($id_indikator_pbp) && empty($id_pengamat)) {

              	$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    		$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);
                
                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguan7($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_siswa, $rombel);

              } else if (empty($id_siswa) && empty($id_pengamat)) {

              	$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    		$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);
                
                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguan6($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_indikator_pbp, $rombel);

              } else if (empty($id_siswa) && empty($id_indikator_pbp)) {

              	$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    		$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);
                
                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguan5($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_pengamat, $rombel);

              } else if (empty($id_indikator_pbp)) {

              	$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    		$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);
                
                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguan4($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_siswa, $id_pengamat, $rombel);

              } else if (empty($id_pengamat)) {

              	$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    		$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);

                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguan3($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_siswa, $id_indikator_pbp, $rombel);

              } else if (empty($id_siswa)) {

              	$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    		$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);

                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguan2($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_pengamat, $id_indikator_pbp, $rombel);

              } else {

              	$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    		$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);

                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguan1($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_siswa, $id_pengamat, $id_indikator_pbp, $rombel);

              }

            }

          }
					
					$title = 'uploads/perilaku_siswa_mingguan_'.date('d-m-Y');

					$namaFilePdf = 'perilaku_siswa_mingguan_'.date('d-m-Y');
					$jenisLaporan = 'mingguan';
					
					// ob_start();
			    //   $this->load->view('backend/standart/administrator/laporan_pengamatan_perilaku_siswa/laporan_pengamatan_perilaku_siswa_laporan', $data);
			    //   $html = ob_get_contents();
			    //   ob_end_clean();

			    $html = '
					<page backimg="" backtop="20mm" backbottom="5mm" backleft="" backright="">
					    <page_header>
					        <div style="width:1083px;">
						        <b style="font-size: 20px"> Laporan Mingguan Pengamatan Prilaku siswa </b> <br>
						        <p style="margin-top: 2px; margin-right: 2px; font-style: italic;">Periode :'. $getPeriode.' || Minggu ke- :' . $getMinggu . ' || Tahun Ajaran :' . $getSemester. '</p>
						        <hr>
						      </div>
					    </page_header>
					    <page_footer>
					    		Page [[page_cu]]/[[page_nb]]
					    </page_footer>

					    <div style="margin-right: 500px">
				        <table border="1px solid black" style="border-collapse: collapse; width: 100%;">
				          <thead>
				            <tr style="text-align:center; font-size: 14px">
				               <th>No.</th>
				               <th>Tanggal</th>
				               <th>Jam</th>
				               <th style="width: 55px;">Kelas</th>
				               <th>Siswa</th>
				               <th>Prilaku</th>
				               <th style="width: 73px;">Status</th>
				               <th style="width: 90px;">Lokasi</th>
				               <th>Pengamat</th>
				            </tr>
				          </thead>';

			            $no = 1;
			            foreach($mingguans as $mingguan){
			              $html .= '
			              <tr style="font-size: 12px">
			                <td> '. $no++ .'</td>
			                <td> '. date("d-m-Y", strtotime(_ent($mingguan->tanggal))).'</td>
			                <td> '. date("H:i:s", strtotime(_ent($mingguan->jam))).'</td>
			                <td> '. _ent($mingguan->kelas).'</td>
			                <td> <div style="width:185px;">'._ent($mingguan->nama).'</div> </td>
			                <td> <div style="width:366px;">'. _ent($mingguan->isi_amatan).'</div> </td>
			                <td> <div style="width:73px;">'. _ent($mingguan->nama_status_amatan).'</div> </td>
			                <td> <div style="width:90px;">'. _ent($mingguan->nama_lokasi).'</div> </td>
			                <td> <div style="width:156px;">'. _ent($mingguan->nama_pengamat).'</div> </td>
			              </tr> ';
			            }

			    $html .=' </table>
				        <br><br><br>
				        <table style="border-collapse: collapse; width: 100%;">
				          <tr>
				            <th>
				              <div style="width: 300px;">
                              <br><br>';

                              if ($getRombel == null) {
                                  $html .=' ';
                              } else {
                                $html .='Wali Kelas '.$getRombel.'
                                <br><br><br><br><br><br>
                                <b style="text-decoration: underline;">'.$getWali_kelas.'</b>';
                              }

				              $html .='
				              </div>
				          </th>
				          <th><div style="width: 500px;"></div></th>
				          <th>
				            <div style="width: 300px;">
				              Surabaya, '.tanggal().'<br>
				              Pusat Pendidikan Budi Pekerti<br><br><br><br><br><br><br>
				              <b style="text-decoration: underline;">'.$getPpbp.'</b>
				            </div>
				          </th>
				        </tr>
				      </table>
				    </div>

					</page>';

			    require_once(APPPATH . "libraries/htmlpdf/html2pdf.class.php");
			    $html2pdf = new HTML2PDF ('L', 'A4', 'en', false, 'UTF-8');
			    $html2pdf->writeHTML($html);
			    $html2pdf->Output($title.'.pdf', 'F');

			    $fileName = $this->model_laporan_pengamatan_perilaku_siswa->fileName();

          if ($fileName != $namaFilePdf) {
			    
			    	unlink(FCPATH . '/uploads/' . $fileName.'.pdf');
			     	
			    }

			    $data = array(
			    	'jenis_laporan'	=> $jenisLaporan,
						'laporan_pengamatan_perilaku_siswa' => $namaFilePdf
						);
					$this->model_laporan_pengamatan_perilaku_siswa->namaFilePdf($data,'laporan_pengamatan_perilaku_siswa');

				} else if ($jenis_laporan == 'excel') {
					
					require_once(APPPATH . "libraries/Excel/PHPExcel.php");

					$excel = new PHPExcel();

					$excel->getProperties()	->setCreator('ICT UWP')
																	->setLastModifiedBy('ICT UWP')
																	->setTitle('Laporan Mingguan Pengamatan Prilaku siswa')
																	->setDescription('Laporan Mingguan Pengamatan Prilaku siswa')
																	->setKeywords('Laporan Mingguan Pengamatan Prilaku siswa');
					$style_col = array(
						'font'		=> array('bold' => true),
						'alignment' => array(
							'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
						),
						'borders' => array(
							'top'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
							'right'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
							'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
							'left'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
						)
					);

					$style_row = array(
						'alignment' => array(
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
						),
						'borders' => array(
							'top'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
							'right'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
							'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
							'left'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
						)
					);

					$excel->setActiveSheetIndex(0)->setCellValue('A1', "Laporan Mingguan Pengamatan Prilaku Siswa (Periode : ".$periode." || Minggu ke- : ".$minggu." || Tahun Ajaran : ".$getSemester.")");
					$excel->getActiveSheet()->mergeCells('A1:J1');
					$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
					$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
					$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

					// baris untuk parsing data
					$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO");
					$excel->setActiveSheetIndex(0)->setCellValue('B3', "TANGGAL");
					$excel->setActiveSheetIndex(0)->setCellValue('C3', "JAM");
					$excel->setActiveSheetIndex(0)->setCellValue('D3', "MINGGU KE-");
					$excel->setActiveSheetIndex(0)->setCellValue('E3', "KELAS");
					$excel->setActiveSheetIndex(0)->setCellValue('F3', "SISWA");
					$excel->setActiveSheetIndex(0)->setCellValue('G3', "PERILAKU");
					$excel->setActiveSheetIndex(0)->setCellValue('H3', "STATUS");
					$excel->setActiveSheetIndex(0)->setCellValue('I3', "LOKASI");
					$excel->setActiveSheetIndex(0)->setCellValue('J3', "PENGAMAT");

					$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
					$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
					$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
					$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
					$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
					$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
					$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
					$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
					$excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
					$excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
          
          if (empty($minggu)) { 

            if ($sekolah == 'semua') {

            	$getWali_kelas =" ";
					    $getRombel 		 =" ";
	            $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguanAllAll($getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir);

            } else {

            	if (empty($id_siswa) && empty($rombel) && empty($id_indikator_pbp) && empty($id_pengamat) && empty($wali_kelas)) {

            		$getWali_kelas =" ";
				        $getRombel 		 =" ";
            		
            		$mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguanNoMingguNoRombel($getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah);

            	} else if (empty($id_siswa) && empty($id_pengamat) && empty($id_indikator_pbp)) {

            		$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    		$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);

                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguanNoMinggu($getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $rombel);

              } else if (empty($id_indikator_pbp) && empty($id_pengamat)) {

              	$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    		$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);
                
                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguanNoMinggu7($getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_siswa, $rombel);

              } else if (empty($id_siswa) && empty($id_pengamat)) {

              	$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    		$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);
                
                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguanNoMinggu6($getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_indikator_pbp, $rombel);

              } else if (empty($id_siswa) && empty($id_indikator_pbp)) {

              	$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    		$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);
                
                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguanNoMinggu5($getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_pengamat, $rombel);

              } else if (empty($id_indikator_pbp)) {

              	$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    		$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);
                
                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguanNoMinggu4($getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_siswa, $id_pengamat, $rombel);

              } else if (empty($id_pengamat)) {

              	$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    		$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);

                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguanNoMinggu3($getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_siswa, $id_indikator_pbp, $rombel);

              } else if (empty($id_siswa)) {

              	$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    		$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);

                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguanNoMinggu2($getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_pengamat, $id_indikator_pbp, $rombel);

              } else {

              	$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    		$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);

                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguanNoMinggu1($getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_siswa, $id_pengamat, $id_indikator_pbp, $rombel);

              }

            }
            
          } else {

            if ($sekolah == 'semua') {

            	$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    	$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);

              if (empty($id_siswa) && empty($id_pengamat) && empty($id_indikator_pbp)) {

                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguanAll($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $rombel);

              } else if (empty($id_siswa) && empty($id_indikator_pbp)) {
                
                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguanAll3($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $id_pengamat, $rombel);

              } else if (empty($id_siswa) && empty($id_pengamat)) {
                
                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguanAll2($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $id_indikator_pbp, $rombel);

              } else if (empty($id_siswa)) {

                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguanAll1($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $id_indikator_pbp, $id_pengamat, $rombel);

              }

            } else {

            	if (empty($id_siswa) && empty($rombel) && empty($id_indikator_pbp) && empty($id_pengamat) && empty($wali_kelas)) {

            		$getWali_kelas =" ";
				        $getRombel 		 =" ";
            		
            		$mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguanNoRombel($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah);

            	} else if (empty($id_siswa) && empty($id_pengamat) && empty($id_indikator_pbp)) {

            		$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    		$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);

                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguan($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $rombel);

              } else if (empty($id_indikator_pbp) && empty($id_pengamat)) {

              	$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    		$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);
                
                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguan7($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_siswa, $rombel);

              } else if (empty($id_siswa) && empty($id_pengamat)) {

              	$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    		$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);
                
                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguan6($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_indikator_pbp, $rombel);

              } else if (empty($id_siswa) && empty($id_indikator_pbp)) {

              	$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    		$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);
                
                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguan5($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_pengamat, $rombel);

              } else if (empty($id_indikator_pbp)) {

              	$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    		$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);
                
                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguan4($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_siswa, $id_pengamat, $rombel);

              } else if (empty($id_pengamat)) {

              	$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    		$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);

                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguan3($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_siswa, $id_indikator_pbp, $rombel);

              } else if (empty($id_siswa)) {

              	$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    		$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);

                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguan2($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_pengamat, $id_indikator_pbp, $rombel);

              } else {

              	$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				    		$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);

                $mingguans = $this->model_laporan_pengamatan_perilaku_siswa->getDataMingguan1($minggu, $getBulanAwal, $getTahunAwal, $getBulanAkhir, $getTahunAkhir, $sekolah, $id_siswa, $id_pengamat, $id_indikator_pbp, $rombel);

              }

            }

          }

					$no = 1;
					$numrow = 4;

					foreach ($mingguans as $mingguan) {
						$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
						$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, date("d-m-Y", strtotime(_ent($mingguan->tanggal))));
						$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, date("H:i:s", strtotime(_ent($mingguan->jam))));
						$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $mingguan->minggu_ke);
						$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $mingguan->kelas);
						$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $mingguan->nama);
						$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $mingguan->isi_amatan);
						$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $mingguan->nama_status_amatan);
						$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $mingguan->nama_lokasi);
						$excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $mingguan->nama_pengamat);

						$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
						$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
						$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
						$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
						$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
						$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
						$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
						$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
						$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
						$excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);

						$no++;
						$numrow++;
					}

					$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
					$excel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
					$excel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
					$excel->getActiveSheet()->getColumnDimension('D')->setWidth(13);
					$excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
					$excel->getActiveSheet()->getColumnDimension('F')->setWidth(40);
					$excel->getActiveSheet()->getColumnDimension('G')->setWidth(60);
					$excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
					$excel->getActiveSheet()->getColumnDimension('J')->setWidth(30);

					$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

					$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
					$excel->getActiveSheet(0)->setTitle("Laporan Prilaku siswa");
					$excel->setActiveSheetIndex(0);

					$title = 'uploads/perilaku_siswa_mingguan_excel_'.date('d-m-Y');
					$jenisLaporan = 'mingguan_excel';

					$fileName = "perilaku_siswa_mingguan_excel_".date('d-m-Y').".xls";
					$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
					ob_end_clean();
					header('Content-type: application/vnd.ms-excel');
					header('Content-Disposition: attachment; filename='.$fileName);
					// $objWriter->save('php://output');
					$objWriter->save($title.'.xls');

					$fileNameOld = $this->model_laporan_pengamatan_perilaku_siswa->fileNameExcel();

          if ($fileNameOld != $fileName) {

              unlink(FCPATH . 'uploads/' . $fileNameOld);
               
          }

					$data = array(
			    	'jenis_laporan'	=> $jenisLaporan,
						'laporan_pengamatan_perilaku_siswa' => $fileName
						);
					$this->model_laporan_pengamatan_perilaku_siswa->namaFilePdf($data,'laporan_pengamatan_perilaku_siswa');

				}

			} else if ($periode == 'harian') {

				$getPeriode 					= $periode;

				$getTanggal_awal 		= $tanggal_awal;
				$getTanggal_akhir		= $tanggal_akhir;
				$getWali_kelas			= $this->model_laporan_pengamatan_perilaku_siswa->getWaliKelas($wali_kelas);
				$getPpbp 						= $this->model_laporan_pengamatan_perilaku_siswa->getPPBP($ppbp);
				$getRombel 					= $this->model_laporan_pengamatan_perilaku_siswa->getRombel($rombel);

				if ($jenis_laporan == 'pdf') {

					if ($sekolah == 'semua') {

						if (empty($id_siswa) && empty($id_pengamat) && empty($id_indikator_pbp) && empty($rombel)) {

							$harians = $this->model_laporan_pengamatan_perilaku_siswa->getDataHarianAllAll($tanggal_awal, $tanggal_akhir);
							// var_dump("tess");
							// die;


						} else if (empty($id_siswa) && empty($id_pengamat) && empty($id_indikator_pbp)) {

							$harians = $this->model_laporan_pengamatan_perilaku_siswa->getDataHarianAll($tanggal_awal, $tanggal_akhir, $rombel);

						} else if (empty($id_siswa) && empty($id_indikator_pbp)) {
							
							$harians = $this->model_laporan_pengamatan_perilaku_siswa->getDataHarianAll3($tanggal_awal, $tanggal_akhir, $id_pengamat, $rombel);

						} else if (empty($id_siswa) && empty($id_pengamat)) {
							
							$harians = $this->model_laporan_pengamatan_perilaku_siswa->getDataHarianAll2($tanggal_awal, $tanggal_akhir, $id_indikator_pbp, $rombel);

						} else if (empty($id_siswa)) {

							$harians = $this->model_laporan_pengamatan_perilaku_siswa->getDataHarianAll1($tanggal_awal, $tanggal_akhir, $id_indikator_pbp, $id_pengamat, $rombel);

						}

					} else {

						if (empty($id_siswa) && empty($id_pengamat) && empty($id_indikator_pbp)) {

							$harians = $this->model_laporan_pengamatan_perilaku_siswa->getDataHarian($tanggal_awal, $tanggal_akhir, $sekolah, $rombel);

							// console.log('tesss');

						} else if (empty($id_indikator_pbp) && empty($id_pengamat)) {
							
							$harians = $this->model_laporan_pengamatan_perilaku_siswa->getDataHarian7($tanggal_awal, $tanggal_akhir, $sekolah, $id_siswa, $rombel);

						} else if (empty($id_siswa) && empty($id_pengamat)) {
							
							$harians = $this->model_laporan_pengamatan_perilaku_siswa->getDataHarian6($tanggal_awal, $tanggal_akhir, $sekolah, $id_indikator_pbp, $rombel);

						} else if (empty($id_siswa) && empty($id_indikator_pbp)) {
							
							$harians = $this->model_laporan_pengamatan_perilaku_siswa->getDataHarian5($tanggal_awal, $tanggal_akhir, $sekolah, $id_pengamat, $rombel);

						} else if (empty($id_indikator_pbp)) {
							
							$harians = $this->model_laporan_pengamatan_perilaku_siswa->getDataHarian4($tanggal_awal, $tanggal_akhir, $sekolah, $id_siswa, $id_pengamat, $rombel);

						} else if (empty($id_pengamat)) {

							$harians = $this->model_laporan_pengamatan_perilaku_siswa->getDataHarian3($tanggal_awal, $tanggal_akhir, $sekolah, $id_siswa, $id_indikator_pbp, $rombel);

						} else if (empty($id_siswa)) {

							$harians = $this->model_laporan_pengamatan_perilaku_siswa->getDataHarian2($tanggal_awal, $tanggal_akhir, $sekolah, $id_pengamat, $id_indikator_pbp, $rombel);

						} else {

							$harians = $this->model_laporan_pengamatan_perilaku_siswa->getDataHarian1($tanggal_awal, $tanggal_akhir, $sekolah, $id_siswa, $id_pengamat, $id_indikator_pbp, $rombel);

						}

					}
					
					$title = 'uploads/perilaku_siswa_harian_'.date('d-m-Y');

					$namaFilePdf = 'perilaku_siswa_harian_'.date('d-m-Y');
					$jenisLaporan = 'harian';
					
					// ob_start();
			  //   $this->load->view('backend/standart/administrator/laporan_pengamatan_perilaku_siswa/laporan_pengamatan_perilaku_siswa_laporan_harian', $data);
			  //   $html = ob_get_contents();
			  //   ob_end_clean();

				$html ='
					<page backtop="20mm" backbottom="5mm" backleft="" backright=""> 
				    <page_header> 
				      <div style="width:1083px;">
				        <b style="font-size: 20px"> Laporan Harian Pengamatan Prilaku siswa </b> <br>
				        <p style="margin-top: 2px; margin-right: 2px; font-style: italic;">Periode : '.$getPeriode.' || Dari Tanggal : '.$getTanggal_awal.' || Sampai Tanggal : '.$getTanggal_akhir.'</p>
				        <hr>
				      </div>
				    </page_header>

				    <page_footer> 
				        Page [[page_cu]]/[[page_nb]]
				    </page_footer> 

				    <div style="margin-right: 500px">

				      <table border="1px solid black" style="border-collapse: collapse; width: 100%;">
				        <thead>
				          <tr style="text-align:center; font-size: 14px">
				             <th>No.</th>
				             <th>Tanggal</th>
				             <th>Jam</th>
				             <th style="width: 76px;">Minggu Ke-</th>
				             <th style="width: 55px;">Kelas</th>
				             <th>Siswa</th>
				             <th>Prilaku</th>
				             <th style="width: 73px;">Status</th>
				             <th style="width: 90px;">Lokasi</th>
				             <th>Pengamat</th>
				          </tr>
				        </thead>';

				          $no = 1;
				          foreach($harians as $harian){
				     $html.= '<tr style="font-size: 12px">
				              <td> '.$no++.'</td>
				              <td> '. date("d-m-Y", strtotime(_ent($harian->tanggal))).'</td>
				              <td> '. date("H:i:s", strtotime(_ent($harian->jam))).'</td>
				              <td> '. _ent($harian->minggu_ke).'</td>
				              <td> '. _ent($harian->kelas).'</td>
				              <td> <div style="width:185px;">'. _ent($harian->nama).'</div> </td>
				              <td> <div style="width:290px;">'. _ent($harian->isi_amatan).'</div> </td>
				              <td> <div style="width:73px;">'. _ent($harian->nama_status_amatan).'</div> </td>
				              <td> <div style="width:90px;">'. _ent($harian->nama_lokasi).'</div> </td>
				              <td> <div style="width:155px;">'. _ent($harian->nama_pengamat).'</div> </td>
				            </tr>';
				          }

		    $html .=' </table>
				      <br><br><br>
				      <table style="border-collapse: collapse; width: 100%;">
				        <tr>
				          <th>
				            <div style="width: 300px;">
				              <br><br>';

											if ($getRombel == null) {
												$html .=' ';
											} else {
												$html .='Wali Kelas '.$getRombel.'
												<br><br><br><br><br><br>
												<b style="text-decoration: underline;">'.$getWali_kelas.'</b>';
											}

				           
					$html .=' </div>
				        </th>
				        <th><div style="width: 500px;"></div></th>
				        <th>
				          <div style="width: 300px;">
				            Surabaya, '.tanggal().'<br>
				            Pusat Pendidikan Budi Pekerti<br><br><br><br><br><br><br>
				            <b style="text-decoration: underline;">'.$getPpbp.'</b>
				          </div>
				        </th>
				      </tr>
				      </table>
				    </div>

				  </page>';

					// test cetak no header
				// $html = '<table border="1px solid black" style="border-collapse: collapse; width: 100%;">
				//         <thead>
				//           <tr style="text-align:center; font-size: 14px">
				//              <th>No.</th>
				//              <th>Tanggal</th>
				//              <th>Jam</th>
				//              <th style="width: 76px;">Minggu Ke-</th>
				//              <th style="width: 55px;">Kelas</th>
				//              <th>Siswa</th>
				//              <th>Prilaku</th>
				//              <th style="width: 73px;">Status</th>
				//              <th style="width: 90px;">Lokasi</th>
				//              <th>Pengamat</th>
				//           </tr>
				//         </thead>';

				//           $no = 1;
				//           foreach($harians as $harian){
				//      $html.= '<tr style="font-size: 12px">
				//               <td> '.$no++.'</td>
				//               <td> '. date("d-m-Y", strtotime(_ent($harian->tanggal))).'</td>
				//               <td> '. date("H:i:s", strtotime(_ent($harian->jam))).'</td>
				//               <td> '. _ent($harian->minggu_ke).'</td>
				//               <td> '. _ent($harian->kelas).'</td>
				//               <td> <div style="width:185px;">'. _ent($harian->nama).'</div> </td>
				//               <td> <div style="width:290px;">'. _ent($harian->isi_amatan).'</div> </td>
				//               <td> <div style="width:73px;">'. _ent($harian->nama_status_amatan).'</div> </td>
				//               <td> <div style="width:90px;">'. _ent($harian->nama_lokasi).'</div> </td>
				//               <td> <div style="width:155px;">'. _ent($harian->nama_pengamat).'</div> </td>
				//             </tr>';
				//           }

		    // $html .='</table>';

				require_once(APPPATH . "libraries/htmlpdf/html2pdf.class.php");
				$html2pdf = new HTML2PDF ('L', 'A4', 'en');
				$html2pdf->writeHTML($html);
				$html2pdf->Output($title.'.pdf', 'F');

				
				// $this->load->library('dompdf_gen');
				
				// $this->render('backend/standart/administrator/laporan_pengamatan_perilaku_siswa/laporan_pengamatan_perilaku_siswa_pdf');

				// $paper_size = 'A4';
				// $orientation = 'landscape';
				// $html = $this->output->get_output();
				// $this->dompdf->set_paper($paper_size, $orientation);

				// $this->dompdf->load_html($html);
				// $this->dompdf->render();
				// $this->dompdf->stream("tesPdf.pdf", array('Attachment' => 0));

			    $fileNameHarian = $this->model_laporan_pengamatan_perilaku_siswa->fileNameHarian();

						if ($fileNameHarian != $namaFilePdf) {
			
							unlink(FCPATH . '/uploads/' . $fileNameHarian.'.pdf');
									
						}

			    $data = array(
			    	'jenis_laporan'	=> $jenisLaporan,
						'laporan_pengamatan_perilaku_siswa' => $namaFilePdf
						);
					$this->model_laporan_pengamatan_perilaku_siswa->namaFilePdf($data,'laporan_pengamatan_perilaku_siswa');

					// log_message("ERROR",$this->db->last_query());


				} else if ($jenis_laporan == 'excel') {
					
					require_once(APPPATH . "libraries/Excel/PHPExcel.php");

					$excel = new PHPExcel();

					$excel->getProperties()	->setCreator('ICT UWP')
																	->setLastModifiedBy('ICT UWP')
																	->setTitle('Laporan Mingguan Pengamatan Prilaku siswa')
																	->setDescription('Laporan Mingguan Pengamatan Prilaku siswa')
																	->setKeywords('Laporan Mingguan Pengamatan Prilaku siswa');
					$style_col = array(
						'font'		=> array('bold' => true),
						'alignment' => array(
							'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
						),
						'borders' => array(
							'top'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
							'right'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
							'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
							'left'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
						)
					);

					$style_row = array(
						'alignment' => array(
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
						),
						'borders' => array(
							'top'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
							'right'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
							'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
							'left'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
						)
					);

					$excel->setActiveSheetIndex(0)->setCellValue('A1', "Laporan Harian Pengamatan Prilaku Siswa (Dari Tanggal : ".$tanggal_awal." Sampai Tanggal : ".$tanggal_akhir.")");
					$excel->getActiveSheet()->mergeCells('A1:L1');
					$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
					$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
					$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

					// baris untuk parsing data
					$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO");
					$excel->setActiveSheetIndex(0)->setCellValue('B3', "TANGGAL");
					$excel->setActiveSheetIndex(0)->setCellValue('C3', "JAM");
					$excel->setActiveSheetIndex(0)->setCellValue('D3', "MINGGU KE-");
					$excel->setActiveSheetIndex(0)->setCellValue('E3', "KELAS");
					$excel->setActiveSheetIndex(0)->setCellValue('F3', "SISWA");
					$excel->setActiveSheetIndex(0)->setCellValue('G3', "PERILAKU");
					$excel->setActiveSheetIndex(0)->setCellValue('H3', "STATUS");
					$excel->setActiveSheetIndex(0)->setCellValue('I3', "LOKASI");
					$excel->setActiveSheetIndex(0)->setCellValue('J3', "PENGAMAT");

					$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
					$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
					$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
					$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
					$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
					$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
					$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
					$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
					$excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
					$excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);

					if ($sekolah == 'semua') {

						if (empty($id_siswa) && empty($id_pengamat) && empty($id_indikator_pbp)) {

							$harians = $this->model_laporan_pengamatan_perilaku_siswa->getDataHarianAll($tanggal_awal, $tanggal_akhir, $rombel);

						} else if (empty($id_siswa) && empty($id_indikator_pbp)) {
							
							$harians = $this->model_laporan_pengamatan_perilaku_siswa->getDataHarianAll3($tanggal_awal, $tanggal_akhir, $id_pengamat, $rombel);

						} else if (empty($id_siswa) && empty($id_pengamat)) {
							
							$harians = $this->model_laporan_pengamatan_perilaku_siswa->getDataHarianAll2($tanggal_awal, $tanggal_akhir, $id_indikator_pbp, $rombel);

						} else if (empty($id_siswa)) {

							$harians = $this->model_laporan_pengamatan_perilaku_siswa->getDataHarianAll1($tanggal_awal, $tanggal_akhir, $id_indikator_pbp, $id_pengamat, $rombel);

						}

					} else {

						if (empty($id_siswa) && empty($id_pengamat) && empty($id_indikator_pbp)) {

							$harians = $this->model_laporan_pengamatan_perilaku_siswa->getDataHarian($tanggal_awal, $tanggal_akhir, $sekolah, $rombel);

						} else if (empty($id_indikator_pbp) && empty($id_pengamat)) {
							
							$harians = $this->model_laporan_pengamatan_perilaku_siswa->getDataHarian7($tanggal_awal, $tanggal_akhir, $sekolah, $id_siswa, $rombel);

						} else if (empty($id_siswa) && empty($id_pengamat)) {
							
							$harians = $this->model_laporan_pengamatan_perilaku_siswa->getDataHarian6($tanggal_awal, $tanggal_akhir, $sekolah, $id_indikator_pbp, $rombel);

						} else if (empty($id_siswa) && empty($id_indikator_pbp)) {
							
							$harians = $this->model_laporan_pengamatan_perilaku_siswa->getDataHarian5($tanggal_awal, $tanggal_akhir, $sekolah, $id_pengamat, $rombel);

						} else if (empty($id_indikator_pbp)) {
							
							$harians = $this->model_laporan_pengamatan_perilaku_siswa->getDataHarian4($tanggal_awal, $tanggal_akhir, $sekolah, $id_siswa, $id_pengamat, $rombel);

						} else if (empty($id_pengamat)) {

							$harians = $this->model_laporan_pengamatan_perilaku_siswa->getDataHarian3($tanggal_awal, $tanggal_akhir, $sekolah, $id_siswa, $id_indikator_pbp, $rombel);

						} else if (empty($id_siswa)) {

							$harians = $this->model_laporan_pengamatan_perilaku_siswa->getDataHarian2($tanggal_awal, $tanggal_akhir, $sekolah, $id_pengamat, $id_indikator_pbp, $rombel);

						} else {

							$harians = $this->model_laporan_pengamatan_perilaku_siswa->getDataHarian1($tanggal_awal, $tanggal_akhir, $sekolah, $id_siswa, $id_pengamat, $id_indikator_pbp, $rombel);

						}

					}
					
					$no = 1;
					$numrow = 4;

					foreach ($harians as $harian) {
						$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
						$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, date("d-m-Y", strtotime(_ent($harian->tanggal))));
						$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, date("H:i:s", strtotime(_ent($harian->jam))));
						$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $harian->minggu_ke);
						$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $harian->kelas);
						$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $harian->nama);
						$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $harian->isi_amatan);
						$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $harian->nama_status_amatan);
						$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $harian->nama_lokasi);
						$excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $harian->nama_pengamat);

						$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
						$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
						$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
						$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
						$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
						$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
						$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
						$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
						$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
						$excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);

						$no++;
						$numrow++;
					}

					$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
					$excel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
					$excel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
					$excel->getActiveSheet()->getColumnDimension('D')->setWidth(13);
					$excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
					$excel->getActiveSheet()->getColumnDimension('F')->setWidth(40);
					$excel->getActiveSheet()->getColumnDimension('G')->setWidth(60);
					$excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
					$excel->getActiveSheet()->getColumnDimension('J')->setWidth(30);

					$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

					$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
					$excel->getActiveSheet(0)->setTitle("Laporan Prilaku siswa");
					$excel->setActiveSheetIndex(0);

					$title = 'uploads/perilaku_siswa_harian_excel_'.date('d-m-Y');
					$jenisLaporan = 'harian_excel';

					$fileName = "perilaku_siswa_harian_excel_".date('d-m-Y').".xls";
					$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
					ob_end_clean();
					header('Content-type: application/vnd.ms-excel');
					header('Content-Disposition: attachment; filename='.$fileName);
					// $objWriter->save('php://output');
					$objWriter->save($title.'.xls');

					$fileNameOld = $this->model_laporan_pengamatan_perilaku_siswa->fileNameHarianExcel();

          if ($fileNameOld != $fileName) {

              unlink(FCPATH . '/uploads/' . $fileNameOld);
               
          }

					$data = array(
			    	'jenis_laporan'	=> $jenisLaporan,
						'laporan_pengamatan_perilaku_siswa' => $fileName
						);
					$this->model_laporan_pengamatan_perilaku_siswa->namaFilePdf($data,'laporan_pengamatan_perilaku_siswa');
				}

			}

			if ($this->input->post('save_type') == 'stay') {
				$this->data['success'] = true;
				// $this->data['id'] 	   = $save_sk_reviewer;
				$this->data['message'] = cclang('success_save_data_stay', [
					// anchor('administrator/sk_reviewer/edit/' . $save_sk_reviewer, 'Edit Sk Reviewer'),
					anchor('administrator/laporan_pengamatan_perilaku_siswa/add', 'KLIK DISINI UNTUK MENAMPILKAN TOMBOL DOWNLOAD')
				]);
			}
		}
		echo json_encode($this->data);
	}

	public function amatan_hari()
	{

    $id_siswa = $this->input->post('id');
		$hariIni	= date('Y-m-d');
    $data = $this->model_laporan_pengamatan_perilaku_siswa->getWaliAmatanHariIni($id_siswa, $hariIni);

		echo json_encode($data);
	}

  public function amatan_bulan()
	{
    $id_siswa = $this->input->post('id');
		$bulanSekarang	= date('m');
    $data = $this->model_laporan_pengamatan_perilaku_siswa->getWaliAmatanBulanSekarang($id_siswa, $bulanSekarang);
		
		echo json_encode($data);
	}

  public function amatan_semester()
	{
    $id_siswa = $this->input->post('id');
		$bulanSekarang	= date('m');
    $tahunSekarang	= date('Y');

    $bulanAwal  = $this->model_laporan_pengamatan_perilaku_siswa->getWaliAmatanSemesterBulanAwal($bulanSekarang, $tahunSekarang);
    $tahunAwal  = $this->model_laporan_pengamatan_perilaku_siswa->getWaliAmatanSemesterTahunAwal($bulanSekarang, $tahunSekarang);
    $bulanAkhir = $this->model_laporan_pengamatan_perilaku_siswa->getWaliAmatanSemesterBulanAkhir($bulanSekarang, $tahunSekarang);
    $tahunAkhir = $this->model_laporan_pengamatan_perilaku_siswa->getWaliAmatanSemesterTahunAkhir($bulanSekarang, $tahunSekarang);


    $data = $this->model_laporan_pengamatan_perilaku_siswa->getWaliAmatanSemesterSekarang($id_siswa, $bulanAwal, $tahunAwal, $bulanAkhir, $tahunAkhir);
		
		echo json_encode($data);
	}
}


/* End of file laporan_pengamatan_perilaku_siswa.php */
/* Location: ./application/controllers/administrator/Laporan Pengamatan Perilaku Siswa.php */
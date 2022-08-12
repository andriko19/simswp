<?php

defined('BASEPATH') OR exit('No direct script access allowed');





/**

*| --------------------------------------------------------------------------

*| Dashboard Controller

*| --------------------------------------------------------------------------

*| For see your board

*|

*/

class Role extends Admin	

{

	

	public function __construct()  

	{

		parent::__construct();

	}



	public function index()

	{

		if (!$this->aauth->is_allowed('dashboard')) {

			redirect('/','refresh');

		}

 

		$data = [];

		$this->template->build('backend/standart/role', $data);

		//$this->render('backend/standart/role', $data);

	}

}



/* End of file Dashboard.php */

/* Location: ./application/controllers/administrator/Dashboard.php */
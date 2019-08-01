<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class survei extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function survey()
	{
		$this->load->library('session');
		if (!isset($_SESSION['skm_isLogged'])) {redirect('auth/login','refresh');} else		
		{
			$_SESSION['title']='SKM UnitLayanan | Tutorial';
			$_SESSION['side']='';
			$this->load->view('title');
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->template->load('contentheader','survey_hdr');
			$this->template->load('contentjdl','survey_jdl');
			$this->template->load('content','survey');
			$this->load->view('footer');
		}
	}
}

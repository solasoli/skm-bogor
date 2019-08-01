<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
	public function index()
	{
		//$this->template->load('template','testmp');
		$this->load->library('session');
		if (!isset($_SESSION['skm_isLogged'])) {redirect('auth/login','refresh');} else		
		{
			$_SESSION['side']='ttg';			
			$_SESSION['title']='SKM | Tantang Aplikasi';
			$this->load->view('title');
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->template->load('contentheader','tentangapp_hdr');
			$this->template->load('contentjdl','tentangapp_jdl');
			$this->template->load('content','tentangapp');
			$this->load->view('footer');
		}
	}

	/**
	fungsi SKM
	*/

	// belajar template
	public function tentangapp()
	{
		//$this->template->load('template','testmp');
		$this->load->library('session');
		if (!isset($_SESSION['skm_isLogged'])) {redirect('auth/login','refresh');} else		
		{
			$_SESSION['side']='ttg';			
			$_SESSION['title']='SKM | Tentang Aplikasi';
			$this->load->view('title');
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->template->load('contentheader','tentangapp_hdr');
			$this->template->load('contentjdl','tentangapp_jdl');
			$this->template->load('content','tentangapp');
			$this->load->view('footer');
		}
	}

	public function skemaskm()
	{
		$this->load->library('session');
		if (!isset($_SESSION['skm_isLogged'])) {redirect('auth/login','refresh');} else		
		{
			$_SESSION['side']='skema';			
			$_SESSION['title']='SKM | Skema SKM';
			$this->load->view('title');
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->template->load('contentheader','skemaskm_hdr');
			$this->template->load('contentjdl','skemaskm_jdl');
			$this->template->load('content','skemaskm');
			$this->load->view('footer');
		}
	}

}

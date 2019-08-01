<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ikm extends CI_Controller {

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

	public function dataikm()
	{
		$this->load->library('session');
		if (!isset($_SESSION['skm_isLogged'])) {redirect('auth/login','refresh');} else		
		{
			$_SESSION['title']='SKM | Olah IKM';
			$_SESSION['side']='peng';
			$this->load->view('title');
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->template->load('contentheader','dataikmhdr');
			$this->template->load('contentjdl','dataikmjdl');
			$this->template->load('content','dataikm');
			$this->load->view('footer');
		}
	}

	public function grafik()
	{
		$this->load->library('session');
		if (!isset($_SESSION['skm_isLogged'])) {redirect('auth/login','refresh');} else		
		{
			$_SESSION['title']='SKM | Grafik';
			$this->load->view('title');
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->template->load('contentheader','dataikmhdr');
			$this->template->load('content','grafik');
			$this->load->view('footer');
		}
	}

	public function grafikbar()
	{
		$this->load->library('session');
		if (!isset($_SESSION['skm_isLogged'])) {redirect('auth/login','refresh');} else		
		{
			$_SESSION['title']='SKM | Grafik Baru';
			$this->load->view('title');
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->template->load('contentheader','dataikmhdr');
			$this->template->load('content','grafikbar');
			$this->load->view('footer');
		}
	}

	public function publikasiikm()
	{
		$this->load->library('session');
		if (!isset($_SESSION['skm_isLogged'])) {redirect('auth/login','refresh');} else		
		{
			$_SESSION['title']='SKM | Publikasi IKM';
			$_SESSION['side']='pub';
			$this->load->view('title');
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->template->load('contentheader','publikasiikm_hdr');
			$this->template->load('contentjdl','publikasiikm_jdl');
			$this->template->load('content','publikasiikm');
			$this->load->view('footer');
		}
	}

	public function grafikperjenislayanan()
	{
		$this->load->library('session');
		if (!isset($_SESSION['skm_isLogged'])) {redirect('auth/login','refresh');} else		
		{
			$_SESSION['title']='SKM | Grafik Per Jenis Layanan';
			$_SESSION['side']='gfjenlay';
			$this->load->view('title');
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->template->load('contentheader','grafikperjenislayanan_hdr');
			$this->template->load('contentjdl','grafikperjenislayanan_jdl');
			$this->template->load('content','grafikperjenislayanan');
			$this->load->view('footer');
		}
	}

	public function grafikperunitlayanan()
	{
		$this->load->library('session');
		if (!isset($_SESSION['skm_isLogged'])) {redirect('auth/login','refresh');} else		
		{
			$_SESSION['title']='SKM | Grafik Per Unit Layanan';
			$_SESSION['side']='gfunlay';
			$this->load->view('title');
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->template->load('contentheader','grafikperunitlayanan_hdr');
			$this->template->load('contentjdl','grafikperunitlayanan_jdl');
			$this->template->load('content','grafikperunitlayanan');
			$this->load->view('footer');
		}
	}

	public function grafiksekota()
	{
		$this->load->library('session');
		if (!isset($_SESSION['skm_isLogged'])) {redirect('auth/login','refresh');} else		
		{
			$_SESSION['title']='SKM | Grafik Tingkat Kota';
			$_SESSION['side']='gfkota';
			$this->load->view('title');
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->template->load('contentheader','grafiksekota_hdr');
			$this->template->load('contentjdl','grafiksekota_jdl');
			$this->template->load('content','grafiksekota');
			$this->load->view('footer');
		}
	}
}

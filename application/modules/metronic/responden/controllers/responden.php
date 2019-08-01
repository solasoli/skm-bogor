<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Responden extends CI_Controller {

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
	public function survey($id = NULL)
	{
		//$this->template->load('template','testmp');
		$data['id'] = $id;

			$_SESSION['title']='SKM Unit Layanan | Rencana Evaluasi';
			$this->load->view('title');
			$this->load->view('header');
			$this->template->load('contentheader','responden_hdr');
			$this->template->load('content','responden', $data);
			$this->load->view('footer');
	}
}

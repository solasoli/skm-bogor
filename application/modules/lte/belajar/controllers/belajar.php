<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class belajar extends CI_Controller {

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
		$this->load->view('belajar');
	}

	public function welcome()
	{
		$this->load->view('welcome_message');
	}

	public function tes($nilai='456', $usia='123')
	{
		echo "test 123<br>";
		echo "nama : ".$nilai."<br>";
		echo "usia : ".$usia."<br>";
	}

	public function isi($nilai='456', $usia='123')
	{
		$data['nilai']=$nilai;
		$data['usia']=$usia;
		$this->load->view('isi',$data);	
	}

}

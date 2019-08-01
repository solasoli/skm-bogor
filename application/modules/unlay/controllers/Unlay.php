<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unlay extends CI_Controller {

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

	public function unitlayanan()
	{
		$this->load->library('session');
		if (!isset($_SESSION['skm_isLogged'])) {redirect('auth/login','refresh');} else		
		{
			$_SESSION['title']='SKM | Unit Layanan';
			$_SESSION['side']='';
			$this->load->view('title');
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->template->load('contentheader','unitlayanan_hdr');
			$this->template->load('contentjdl','unitlayanan_jdl');
			$this->template->load('content','unitlayanan');
			$this->load->view('footer');
		}
	}

	//add a new items
	public function unlay_add()
	{
		$this->load->library('session');
		if (!isset($_SESSION['skm_isLogged'])) {redirect('auth/login','refresh');} else		
		{
			$_SESSION['title']='SKM | Unit Layanan -> Tambah Data';
			$_SESSION['side']='';
			$this->load->view('title');
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->template->load('contentheader','unitlayanan_hdr');
			$this->template->load('contentjdl','unitlayanan_jdl');
			$this->template->load('content','unlay_add');
			$this->load->view('footer');
		}
	}

	//update one items
	public function unlay_edit( $id = NULL )
	{
		$this->db->where('id', $id);
		$data['content'] = $this->db->get('unit_layanan');
		$this->load->library('session');
		if (!isset($_SESSION['skm_isLogged'])) {redirect('auth/login','refresh');} else		
		{
			$_SESSION['title']='SKM Unit Layanan | Unit Layanan -> Edit Data';
			$_SESSION['side']='';
			$this->load->view('title');
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->template->load('contentheader','unitlayanan_hdr');
			$this->template->load('contentjdl','unitlayanan_jdl');
			$this->template->load('content','unlay_edit', $data);
			$this->load->view('footer');
		}
	}

	//action add a new items
	public function action_unlay_add()
	{
		if ($this -> input -> post('unlay')!='')
		{
			$data = array (
				'nama_unit' => $this -> input -> post('unlay'),
   				'is_aktif' => '1',
			);
			$this->db->insert('unit_layanan', $data);
		}
		redirect('unlay/unitlayanan','refresh');
	}

	public function action_unlay_update( $id = NULL )
	{
		$data = array (
			'nama_unit' => $this -> input -> post('unlay'),
		);
		$this->db->where('id', $id);
		$this->db->update('unit_layanan', $data);
		redirect('unlay/unitlayanan','refresh');
	}

	//delete one items
	public function unlay_delete( $id = NULL )
	{
		$this->db->where('id', $id);
		$this->db->delete('unit_layanan');		
		redirect('unlay/unitlayanan','refresh');
	}
}

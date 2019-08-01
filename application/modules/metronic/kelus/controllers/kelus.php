<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelus extends CI_Controller {

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

	public function kelolauser()
	{
		$this->load->library('session');
		if (!isset($_SESSION['skm_isLogged'])) {redirect('auth/login','refresh');} else		
		{
			$_SESSION['title']='SKM KelolaUser | Tutorial';
			$_SESSION['side']='';
			$this->load->view('title');
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->template->load('contentheader','kelolauser_hdr');
			$this->template->load('contentjdl','kelolauser_jdl');
			$this->template->load('content','kelolauser');
			$this->load->view('footer');
		}
	}

	
	//add a new items
	public function kelus_add($id = NULL)
	{
		$this->load->library('session');
		$data['id'] =$id;
		if (!isset($_SESSION['skm_isLogged'])) {redirect('auth/login','refresh');} else		
		{
			$_SESSION['title']='SKM KelolaUser | Kelola User -> Tambah Data';
			$_SESSION['side']='';
			$this->load->view('title');
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->template->load('contentheader','kelolauser_hdr');
			$this->template->load('contentjdl','kelolauser_jdl');
			$this->template->load('content','kelus_add', $data);
			$this->load->view('footer');
		}
	}

	//update one items
	public function kelus_edit( $id = NULL )
	{
		$this->db->where('id', $id);
		$data['content'] = $this->db->get('users');
		$this->load->library('session');
		if (!isset($_SESSION['skm_isLogged'])) {redirect('auth/login','refresh');} else		
		{
			$_SESSION['title']='SKM KelolaUser | Kelola User -> Edit Data';
			$_SESSION['side']='';
			$this->load->view('title');
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->template->load('contentheader','kelolauser_hdr');
			$this->template->load('contentjdl','kelolauser_jdl');
			$this->template->load('content','kelus_edit', $data);
			$this->load->view('footer');
		}
	}

	//action add a new items
	public function action_kelus_add($id = NULL)
	{
		if ($this -> input -> post('userlogin')!='')
		{
			$tgl=date('Y-m-d H:i:s');
			$data = array (
				'user_login' => $this -> input -> post('userlogin'),
				'nip' => $this -> input -> post('nip'),
				'nama_lengkap' => $this -> input -> post('namalengkap'),
				'nick' => $this -> input -> post('nick'),
				'hp' => $this -> input -> post('hp'),
				'is_aktif' =>  $this -> input -> post('is_aktif'),
   				'id_unit_layanan' => $id,
   				'tgl_create' => $tgl,
			);
			$this->db->insert('users', $data);
		}
		redirect('kelus/kelolauser','refresh');
	}

	public function action_kelus_update( $id = NULL )
	{
		$data = array (
			'user_login' => $this -> input -> post('userlogin'),
			'nip' => $this -> input -> post('nip'),
			'nama_lengkap' => $this -> input -> post('namalengkap'),
			'nick' => $this -> input -> post('nick'),
			'hp' => $this -> input -> post('hp'),
			'is_aktif' =>  $this -> input -> post('is_aktif'),
		);
		$this->db->where('id', $id);
		$this->db->update('users', $data);
		
		redirect('kelus/kelolauser','refresh');
	}

	//delete one items
	public function kelus_delete( $id = NULL )
	{
		$this->db->where('id', $id);
		$this->db->delete('users');	
		redirect('kelus/kelolauser','refresh');
	}
}

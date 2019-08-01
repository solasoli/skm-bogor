<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class belajar_crud extends CI_Controller {

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

	//list all your items
	public function index() // $offset = 0 )
	{
		$data['content'] = $this->db->get('identitas');
		$this->load->view('index', $data);
	}

	//add a new items
	public function add()
	{
		$this->load->view('add');		
	}

	//action add a new items
	public function action_add()
	{
		$data = array (
			'nama' => $this -> input -> post('nama'),
			'status' => $this -> input -> post('status'),
			'jurusan' => $this -> input -> post('jurusan'),
		);
		$this->db->insert('identitas', $data);
		redirect('belajar_crud','refresh');
	}

	//update one items
	public function update( $id = NULL )
	{
		$this->db->where('id', $id);
		$data['content'] = $this->db->get('identitas');
		$this->load->view('update', $data);	
	}

	//action update one items
	public function action_update( $id = NULL )
	{
		$data = array (
			'nama' => $this -> input -> post('nama'),
			'status' => $this -> input -> post('status'),
			'jurusan' => $this -> input -> post('jurusan'),
		);
		$this->db->where('id', $id);
		$this->db->update('identitas', $data);
		redirect('belajar_crud','refresh');
	}

	//delete one items
	public function delete( $id = NULL )
	{
		$this->db->where('id', $id);
		$this->db->delete('identitas');		
		redirect('belajar_crud','refresh');
	}
}

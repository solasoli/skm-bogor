<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class jenlay extends CI_Controller {

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

	public function jenislayanan()
	{
		$this->load->library('session');
		if (!isset($_SESSION['skm_isLogged'])) {redirect('auth/login','refresh');} else		
		{
			$_SESSION['title']='SKM jenisLayanan | Tutorial';
			$this->load->view('title');
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->template->load('contentheader','jenislayanan_hdr');
			$this->template->load('content','jenislayanan');
			$this->load->view('footer');
		}
	}

	
	//add a new items
	public function jenlay_add($id = NULL)
	{
		$this->load->library('session');
		$data['id'] =$id;
		if (!isset($_SESSION['skm_isLogged'])) {redirect('auth/login','refresh');} else		
		{
			$_SESSION['title']='SKM jenis Layanan | jenis Layanan -> Tambah Data';
			$this->load->view('title');
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->template->load('contentheader','jenislayanan_hdr');
			$this->template->load('content','jenlay_add', $data);
			$this->load->view('footer');
		}
	}

	//update one items
	public function jenlay_edit( $id = NULL )
	{
		$this->db->where('id', $id);
		$data['content'] = $this->db->get('jenis_layanan');
		$this->load->library('session');
		if (!isset($_SESSION['skm_isLogged'])) {redirect('auth/login','refresh');} else		
		{
			$_SESSION['title']='SKM jenis Layanan | jenis Layanan -> Edit Data';
			$this->load->view('title');
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->template->load('contentheader','jenislayanan_hdr');
			$this->template->load('content','jenlay_edit', $data);
			$this->load->view('footer');
		}
	}

	//action add a new items
	public function action_jenlay_add($id = NULL)
	{
		if ($this -> input -> post('jenlay')!='')
		{
			$data = array (
				'jenis_layanan_diterima' => $this -> input -> post('jenlay'),
   				'id_unit_layanan' => $id,
			);
			$this->db->insert('jenis_layanan', $data);
		}
		redirect('jenlay/jenislayanan','refresh');
	}

	public function action_jenlay_update( $id = NULL )
	{
		$data = array (
			'jenis_layanan_diterima' => $this -> input -> post('jenlay'),
		);
		$this->db->where('id', $id);
		$this->db->update('jenis_layanan', $data);
		redirect('jenlay/jenislayanan','refresh');
	}

	//delete one items
	public function jenlay_delete( $id = NULL )
	{
		$this->db->where('id', $id);
		$this->db->delete('jenis_layanan');		
		redirect('jenlay/jenislayanan','refresh');
	}
}

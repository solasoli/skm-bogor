<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kues extends CI_Controller {

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

	public function kuesioner()
	{
		$this->load->library('session');
		if (!isset($_SESSION['skm_isLogged'])) {redirect('auth/login','refresh');} else		
		{
			$_SESSION['title']='SKM Unit Layanan | Kuesioner';
			$this->load->view('title');
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->template->load('contentheader','kuesioner_hdr');
			$this->template->load('content','kuesioner');
			$this->load->view('footer');
		}
	}

	public function kuesioner_add($id = NULL)
	{
		$this->load->library('session');
		$data['id'] =$id;
		if (!isset($_SESSION['skm_isLogged'])) {redirect('auth/login','refresh');} else		
		{
			$_SESSION['title']='SKM Unit Layanan | Kuesioner -> Tambah Data';
			$this->load->view('title');
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->template->load('contentheader','kuesioner_hdr');
			$this->template->load('content','kuesioner_add',$data);
			$this->load->view('footer');
		}
	}

	public function tambahsoal_add($id = NULL)
	{
		$this->load->library('session');
		$data['id'] =$id;
		if (!isset($_SESSION['skm_isLogged'])) {redirect('auth/login','refresh');} else		
		{
			$_SESSION['title']='SKM Unit Layanan | Kuesioner -> Tambah Soal';
			$this->load->view('title');
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->template->load('contentheader','kuesioner_hdr');
			$this->template->load('content','tambahsoal_add',$data);
			$this->load->view('footer');
		}
	}

	//update one items
	public function kuesioner_edit( $id = NULL )
	{
		$this->db->where('id', $id);
		$data['content'] = $this->db->get('kuesioner');
		$this->load->library('session');
		if (!isset($_SESSION['skm_isLogged'])) {redirect('auth/login','refresh');} else		
		{
			$_SESSION['title']='SKM Unit Layanan | Kuesioner -> Edit Data';
			$this->load->view('title');
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->template->load('contentheader','kuesioner_hdr');
			$this->template->load('content','kuesioner_edit', $data);
			$this->load->view('footer');
		}
	}

	//delete one items
	public function kuesioner_delete( $id = NULL )
	{
		$this->db->where('id', $id);
		$this->db->delete('kuesioner');		
		redirect('kues/kuesioner','refresh');
	}

	public function action_kues_add($id = NULL)
	{
		if ($this -> input -> post('tanya')!='')
		{
			$rnd=rand(1,10000000000);

			$data = array (
				'id_kuesioner' => $id,
				'pertanyaan' => $this -> input -> post('tanya'),
   				'id_unsur_pelayanan' => $this -> input -> post('unpel'),
				'idrnd' => $rnd,   				
			);
			$this->db->insert('pertanyaan', $data);
			$this->db->where('idrnd', $rnd);
			$kueri = $this->db->get('pertanyaan');
  			foreach ($kueri -> result_array() as $key):
  			$idtny=$key['id'];
  			endforeach;

			for ($i=1;$i<=4;$i++)
			{
				$data = array (
				'id_pertanyaan' => $idtny,
				'pilihan' => $this -> input -> post('pil'.$i),
   				'bobot' => $this -> input -> post('bobot'.$i),
				);
				$this->db->insert('pilihan', $data);
			}
		}
		redirect('kues/kuesioner','refresh');
	}

	public function action_kues_update( $id = NULL )
	{
		$data = array (
			'versi_kuesioner' => $this -> input -> post('verkue'),
		);
		$this->db->where('id', $id);
		$this->db->update('kuesioner', $data);
		redirect('kues/kuesioner','refresh');
	}

	//delete one items
	public function kues_delete( $id = NULL )
	{
		$this->db->where('id', $id);
		$this->db->delete('kuesioner');		
		redirect('kues/kuesioner','refresh');
	}
}

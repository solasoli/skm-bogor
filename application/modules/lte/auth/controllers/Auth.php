<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends CI_Controller {

	public function login()
	{
		//$this->session->set_userdata('nama_session', 'nilai_session')
		$this->load->library('session');
		if($this->session->userdata('skm_isLogged'))
		{
			redirect('dashboard','refresh');
		}
		else
		{
			//$this->load->library(array('form_validation'));
			//$data = array('_content' => 'login', 'title' => 'Login');
			//$this->load->view('v_content', $data);
			$this->load->view('login');	
		}
	}

	public function captcha()
	{
		//$this->session->set_userdata('nama_session', 'nilai_session')
		$this->load->library('session');
		$this->load->view('captcha');	
	}

	public function validate()
	{
		$this->load->library('session');
		if($this->session->userdata('skm_userloginisLogged'))
		{
			redirect('dashboard','refresh');
		}
		else
		{
			if($this->input->post('username', true) and $this->input->post('password', true))
			{
				$this->load->model('m_auth');
				$usr = $this->input->post('username');
				//$pwd = hash("sha256", md5(trim($this->input->post('password'))));
				$pwd = $this->input->post('password');
				$captcha = $this->input->post('captcha');


				if($_SESSION['random_txt']==md5($captcha))
				{
					$validate = $this->m_auth->validate($usr, $pwd);
					if($validate->num_rows() == 1)
					{
						foreach($validate->result() as $row)
						{							
							$query = $this->db->
							query("SELECT * from unit_layanan where id=?",array($row->id_unit_layanan));
							foreach($query->result() as $row1)
							{
								$unit=$row1->nama_unit;
							}

							$session_set = array
							(
							'skm_userlogin' => $row->user_login,
							'skm_namalengkap' => $row->nama_lengkap,
							'skm_isadmin' => $row->is_admin,
							'skm_membersince' => $row->tgl_create,						
							'skm_idunitlayanan' => $row->id_unit_layanan,
							'skm_unitlayanan' => $unit,
							'skm_isLogged' => true
							);

							$tgl=date('Y-m-d H:i:s');
							$data = array (
								'last_login' => $tgl,
								);
							$id=$row->id;
							$this->db->where('id', $id);
							$this->db->update('users', $data);
						}
						$this->session->set_userdata($session_set);
						redirect('dashboard','refresh');
					}
					else
					{
						$session_set =
							array(
								'skm_fail_username' => $this->input->post('username'),
								'skm_fail_password' => $this->input->post('password'),
								'skm_login_error' => 1
							);
						$this->session->set_userdata($session_set);
						redirect('auth/login','refresh');
					}
				}
				else
				{
					redirect('auth/login','refresh');					
				}
			}
			else
			{
				redirect('auth/login','refresh');
			}
		}
	}

	public function logout()
	{
		$this->load->library('session');
		$this->session->sess_destroy();
		redirect('auth/login','refresh');
	}
}

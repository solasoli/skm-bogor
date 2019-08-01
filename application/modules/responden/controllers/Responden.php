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

  public function start()
  {
    //$this->template->load('template','testmp');
    $this->load->library('session');
    $_SESSION['title']='SKM | Survey';
    $this->load->view('title');
    $this->template->load('content','start');
  }

	public function survey($id = NULL)
	{
		//$this->template->load('template','testmp');
		$data['id'] = $id;
		$this->load->library('session');
		$_SESSION['title']='SKM | Survey';
		$this->load->view('title');
		$this->template->load('content','responden', $data);
	}

	public function sukses($id = NULL)
	{
		//$this->template->load('template','testmp');
		$data['id'] = $id;
		$this->load->library('session');
		$_SESSION['title']='SKM | Survey Sukses';
		$this->load->view('title');
		$this->template->load('content','sukses', $data);
	}

	public function action_survey_add($id = NULL)
	{
		$this->load->library('session');
		if ($this -> input -> post('nama')!='')
		{
			if ($this -> input -> post('usia')!='')
			{
				$rnd='';
				if(isset($_SESSION['rnd']))
				{
					$rnd=$_SESSION['rnd'];
				}


			if ($rnd != $this -> input -> post('rnd'))
			{
				$_SESSION['rnd'] = $this -> input -> post('rnd');
				$ada=1;
				while ($ada==1)
				{
					$rnd=rand(1,10000000000);
					$ada=0;
					$this->db->where('idrnd', $rnd);
					$kueri = $this->db->get('responden');
  					foreach ($kueri -> result_array() as $key):
  					$ada=1;
  					endforeach;
  				}

				$data = array (
					'nama' => $this -> input -> post('nama'),
					'jk' => $this -> input -> post('r1'),
   					'usia' => $this -> input -> post('usia'),
   					'id_pendidikan' => $this -> input -> post('r2'),
   					'id_pekerjaan' => $this -> input -> post('r3'),   					
					'idrnd' => $rnd,   				
				);
				$this->db->insert('responden', $data);

				$this->db->where('idrnd', $rnd);
				$kueri = $this->db->get('responden');
  				foreach ($kueri -> result_array() as $key):
  				$id_res=$key['id'];
  				endforeach;
  				date_default_timezone_set('Asia/Jakarta');
				$tgl=date('Y-m-d');
				$jam=date('H:i:s');				

				$data = array (
					'tanggal_survey' => $tgl,
					'jam_survey' => $jam,
					'id_kuesioner' => $id,
					'id_responden' => $id_res,
          'kat1' => $this -> input -> post('katsar1'),
          'kat2' => $this -> input -> post('katsar2'),
          'kat3' => $this -> input -> post('katsar3'),
          'kat4' => $this -> input -> post('katsar4'),
					'saran1' => $this -> input -> post('saran1'),
          'saran2' => $this -> input -> post('saran2'),
          'saran3' => $this -> input -> post('saran3'),
          'saran4' => $this -> input -> post('saran4'),
					'idrnd' => $rnd,   				
				);
				$this->db->insert('survey', $data);

				$this->db->where('idrnd', $rnd);
				$kueri = $this->db->get('survey');
  				foreach ($kueri -> result_array() as $key):
  				$id_sur=$key['id'];
  				endforeach;

            	$this->db->select('*');
            	$this->db->where('id_kuesioner',$id);
            	$this->db->from('pertanyaan');
            	$content= $this->db->get();
            	$no=0;
  				foreach ($content -> result_array() as $key):
  					$no=$no+1;
  					if ($no==1) {$jawab = $this -> input -> post('no1');}
  					if ($no==2) {$jawab = $this -> input -> post('no2');}
  					if ($no==3) {$jawab = $this -> input -> post('no3');}
  					if ($no==4) {$jawab = $this -> input -> post('no4');}
  					if ($no==5) {$jawab = $this -> input -> post('no5');}
  					if ($no==6) {$jawab = $this -> input -> post('no6');}
  					if ($no==7) {$jawab = $this -> input -> post('no7');}
  					if ($no==8) {$jawab = $this -> input -> post('no8');}
  					if ($no==9) {$jawab = $this -> input -> post('no9');}
  					if ($no==10) {$jawab = $this -> input -> post('no10');}
  					if ($no==11) {$jawab = $this -> input -> post('no11');}
  					if ($no==12) {$jawab = $this -> input -> post('no12');}
  					if ($no==13) {$jawab = $this -> input -> post('no13');}
  					if ($no==14) {$jawab = $this -> input -> post('no14');}
  					if ($no==15) {$jawab = $this -> input -> post('no15');}
  					if ($no==16) {$jawab = $this -> input -> post('no16');}
  					if ($no==17) {$jawab = $this -> input -> post('no17');}
  					if ($no==18) {$jawab = $this -> input -> post('no18');}
  					if ($no==19) {$jawab = $this -> input -> post('no19');}
  					if ($no==20) {$jawab = $this -> input -> post('no20');}
  					if ($no==21) {$jawab = $this -> input -> post('no21');}
  					if ($no==22) {$jawab = $this -> input -> post('no22');}
  					if ($no==23) {$jawab = $this -> input -> post('no23');}
  					if ($no==24) {$jawab = $this -> input -> post('no24');}
  					if ($no==25) {$jawab = $this -> input -> post('no25');}
  					if ($no==26) {$jawab = $this -> input -> post('no26');}
  					if ($no==27) {$jawab = $this -> input -> post('no27');}
  					if ($no==28) {$jawab = $this -> input -> post('no28');}
  					if ($no==29) {$jawab = $this -> input -> post('no29');}
  					if ($no==30) {$jawab = $this -> input -> post('no30');}
  					if ($no==31) {$jawab = $this -> input -> post('no31');}
  					if ($no==32) {$jawab = $this -> input -> post('no32');}
  					if ($no==33) {$jawab = $this -> input -> post('no33');}
  					if ($no==34) {$jawab = $this -> input -> post('no34');}
  					if ($no==35) {$jawab = $this -> input -> post('no35');}
  					if ($no==36) {$jawab = $this -> input -> post('no36');}
  					if ($no==37) {$jawab = $this -> input -> post('no37');}
  					if ($no==38) {$jawab = $this -> input -> post('no38');}
  					if ($no==39) {$jawab = $this -> input -> post('no39');}
  					if ($no==40) {$jawab = $this -> input -> post('no40');}
  					if ($no==41) {$jawab = $this -> input -> post('no41');}
  					if ($no==42) {$jawab = $this -> input -> post('no42');}
  					if ($no==43) {$jawab = $this -> input -> post('no43');}
  					if ($no==44) {$jawab = $this -> input -> post('no44');}
  					if ($no==45) {$jawab = $this -> input -> post('no45');}
  					if ($no==46) {$jawab = $this -> input -> post('no46');}
  					if ($no==47) {$jawab = $this -> input -> post('no47');}
  					if ($no==48) {$jawab = $this -> input -> post('no48');}
  					if ($no==49) {$jawab = $this -> input -> post('no49');}
  					if ($no==50) {$jawab = $this -> input -> post('no50');}

  					$jwb=explode('.',$jawab);
  					$id_tny=$jwb[0];
  					$id_pil=$jwb[1];

					$data = array (
					'id_survey' => $id_sur,
					'id_pertanyaan' => $id_tny,
					'id_pilihan' => $id_pil,
					);
					$this->db->insert('jawaban_survey', $data);
  				endforeach;

              	$nilai[1]=0;
              	$nilai[2]=0;
              	$nilai[3]=0;
              	$nilai[4]=0;
              	$nilai[5]=0;
              	$nilai[6]=0;
              	$nilai[7]=0;
              	$nilai[8]=0;
              	$nilai[9]=0;
		        $this->db->select('*');
		        $this->db->from('survey');
		        $this->db->where('idrnd=',$rnd);     
		        $content= $this->db->get();
		        foreach ($content -> result_array() as $row): 
        			for ($u=1;$u<=9;$u++)
					{
                		$this->db->select('sum(bobot) as "bobots",count(*) as "byk"');
                		$this->db->from('jawaban_survey');
                		$this->db->join('pilihan','jawaban_survey.id_pilihan=pilihan.id');
                		$this->db->join('pertanyaan','jawaban_survey.id_pertanyaan=pertanyaan.id');
                		$this->db->where('id_survey',$row['id']);
                		$this->db->where('id_unsur_pelayanan',$u);
                		$this->db->group_by('id_unsur_pelayanan');
                		$content1= $this->db->get();
                		foreach ($content1 -> result_array() as $row1): 
                			$nilai[$u]=$nilai[$u]+($row1['bobots']/$row1['byk']);
              			endforeach;
            		}
    			endforeach ;
    			$nilai[1]=$nilai[1]*0.111;
    			$nilai[2]=$nilai[2]*0.111;
    			$nilai[3]=$nilai[3]*0.111;
    			$nilai[4]=$nilai[4]*0.111;
    			$nilai[5]=$nilai[5]*0.111;
    			$nilai[6]=$nilai[6]*0.111;
    			$nilai[7]=$nilai[7]*0.111;
    			$nilai[8]=$nilai[8]*0.111;
    			$nilai[9]=$nilai[9]*0.111;
    			$nilais=$nilai[1]+$nilai[2]+$nilai[3]+$nilai[4]+$nilai[5]+$nilai[6]+$nilai[7]+$nilai[8]+$nilai[9];
    			$nilais=$nilais*25;

				$data = array (
					'ikm' => $nilais,
				);
				$this->db->where('idrnd', $rnd);
				$this->db->update('survey', $data);

  				redirect('responden/sukses/'.$id,'refresh');
  			}
			else
			{
  				redirect('responden/sukses/'.$id,'refresh');
			}
			}
			else
			{
				$_SESSION['err']=1;
				$_SESSION['errnya']='usia harus diisi';
				redirect('responden/survey/'.$id,'refresh');
			}
		}
		else
		{
			$_SESSION['err']=1;
			$_SESSION['errnya']='nama harus diisi';
			redirect('responden/survey/'.$id,'refresh');
		}
	}		
}

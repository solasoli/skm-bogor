<?php 
function get_bulan($tgl)
{
   $hasil="";
   switch ($tgl)
   {
      case "1";
         $hasil='Januari';
         break;
      case "2";
         $hasil='Februari';
         break;
      case "3";
         $hasil='Maret';
         break;
      case "4";
         $hasil='April';
         break;
      case "5";
         $hasil='Mei';
         break;
      case "6";
         $hasil='Juni';
         break;
      case "7";
         $hasil='Juli';
         break;
      case "8";
         $hasil='Agustus';
         break;
      case "9";
         $hasil='September';
         break;
      case "10";
         $hasil='Oktober';
         break;
      case "11";
         $hasil='November';
         break;
      case "12";
         $hasil='Desember';
         break;
   }
   return $hasil;	   
}

function qr($direktori,$isidata)
{
   $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.$direktori.DIRECTORY_SEPARATOR;   
   if (!file_exists($PNG_TEMP_DIR)) mkdir($PNG_TEMP_DIR);
        
   $PNG_WEB_DIR = $direktori.'/';
   include "./qr/qrlib.php";        
   $errorCorrectionLevel = 'H';
   $matrixPointSize = 10;

   $filename = $PNG_TEMP_DIR.'test'.md5($isidata.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        
   QRcode::png($isidata, $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
   return $filename;   
        
}

function tabel($klm,$x,$y,$pj,$tg,$posisi,$isborder,$tgdflt,$tgauto,$israta)
{  global $pdf;
   $a=explode("\r\n",$klm);
   $y1=$pdf->GetY();
   for ($i=0;$i<=count($a)-1;$i++)
   {
      tabel1($a[$i],$x,$y+($tgdflt*$i),$pj,$tg,$posisi,$isborder,$tgdflt,$tgauto,$israta,count($a));
   }
   if (count($a)>1)
   {
      $y2=$pdf->GetY();
      $z=$y2-$y1+2;
      $pdf->SetXY($x,$y);
      $pdf->Cell($pj,$z,'',$isborder,1,$posisi);
      $pdf->SetY($y2);   
   }
}

function tabel1($klm,$x,$y,$pj,$tg,$posisi,$isborder,$tgdflt,$tgauto,$israta,$byk)
{  global $pdf;
   $pdf->SetXY($x,$y);
   if ($tgauto!=1)
   {  $pdf->Cell($pj,$tg,$klm,$isborder,1,$posisi); }
   else
   {  $a=explode(" ",$klm);
      $b=0;
      for ($i=0;$i<=Count($a);$i++)
      {  if (strlen($kl[$b])==0)
         { $kl[$b]=$a[$i];} else { $kl[$b]=$kl[$b]." ".$a[$i]; }
         if ($i!=Count($a))
         {  if ($pdf->GetStringWidth($kl[$b]." ".$a[$i+1]." ")>$pj) 
            {  if ($israta==1)
               {  $c=explode(" ",$kl[$b]);
                  $kl1="";
                  for ($j=0;$j<=Count($c);$j++)
                  {  if (strlen($kl1)==0)
                     { $kl1=$c[$j];} else { $kl1=$kl1."  ".$c[$j]; }
                     $kl2=$kl1;
                     for ($k=$j+1;$k<=Count($c);$k++)
                     {  $kl2=$kl2." ".$c[$k]; }
                     if ($pdf->GetStringWidth($kl2." ")<=$pj) { $kl[$b]=$kl2; }
                  }
               }
               $b=$b+1;
            }
         }
      }
      $z=0;    
      for ($i=0;$i<=$b;$i++)
      {  $pdf->SetXY($x,$y+$z);
         $z=$z+$tgdflt;
         $pdf->Cell($pj,$tg,$kl[$i],0,1,$posisi);
      }
      $pdf->SetXY($x,$y);
      if ($z<$tg){$z=$tg;}
      if ($byk==1)
      {      
         $pdf->Cell($pj,$z,'',$isborder,1,$posisi);      
      }
      else
      {      
         $pdf->Cell($pj,$z,'',0,1,$posisi);      
      }
   }
   return;
}

function GetY()
{  global $pdf;
   return $pdf->GetY(); }

//nocache
header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
header('Pragma: no-cache'); // HTTP 1.0.
header('Expires: 0'); // Proxies.
$kiri=10;
$atas=15;

//memanggil fpdf
require_once ("fpdf181/fpdf.php");
$pdf=new FPDF();
$pdf->AddPage('P','Legal');
 
$nopel=$_GET['nopel'];
$nopel1=explode(".",$nopel);

$con = pg_connect("host=127.0.0.1 port=5432 dbname=penyampaian_sppt user=postgres password=51mp36") or die(pg_error());
$res = pg_query("select * from ba_pendataan left join m_jenis_pelayanan_pbb on m_jenis_pelayanan_pbb.id=ba_pendataan.id_jpel where no_pelayanan='".trim($_GET['nopel'])."'");
if(pg_num_rows($res)!=0)
{
   $row=pg_fetch_array($res);
   $jpel=strtoupper($row['jenis_pelayanan']);
   $nobapdt=$row['nomor_ba_pendataan_lengkap'];
   if ($nobapdt==''||strlen($nobapdt)==0){$nobapdt='<BELUM SELESAI>';}
   $tgl=explode("-",$row['tgl_ba_pendataan']);   
   $tgl_bapdt=$tgl[2].' '.get_bulan($tgl[1]).' '.$tgl[0];
   $nobanil=$row['nomor_ba_penilaian_lengkap'];
   if ($nobanil==''||strlen($nobanil)==0){$nobanil='<BELUM SELESAI>';}
   $tgl=explode("-",$row['tgl_ba_penilaian']);   
   $tgl_banil=$tgl[2].' '.get_bulan($tgl[1]).' '.$tgl[0];
   $isrubah=$row['is_rubah_nilai'];
   $nmpetugasdata=$row['nama_petugas_pendataan'];
   $nippetugasdata=$row['nip_petugas_pendataan'];
   $nmpetugasnilai=$row['nama_petugas_penilaian'];
   $nippetugasnilai=$row['nip_petugas_penilaian'];
   $nmkasipedanil=$row['nama_kasi_pedanil'];
   $nipkasipedanil=$row['nip_kasi_pedanil'];
   $nmkabidpedanil=$row['nama_kabid_pedanil'];
   $nipkabidpedanil=$row['nip_kabid_pedanil'];
}

$nop='32.71.060.006.001-0202.0';
$nama="H. MUHAMMAD SISCO HENDRAYUWONO, S.KOM, M.Si";
$alamat="jalan nangka blok elok nop. 1 bogor barat";
$lt="250.000";
$lb="14.000";
$nik="3271021404520003";
$thnrenov='2015';
$noba='540/020/MS/V/2017';
$info="Informasi Lainnya";

//Begin with regular font
$pdf->SetFont('Arial','B',14);

$filename=qr ('temp','layanan-bapenda.kotabogor.go.id/pedanil/bapdtpdf.php?nopel='.$_GET['nopel']);
$pdf->image($filename,179,0,20,20);
if($isrubah==1)
{
   tabel ('BERITA ACARA PENDATAAN DAN PENILAIAN',$kiri,$atas,190,0,'C',0,0,0,0);
}
else
{
   tabel ('BERITA ACARA PENDATAAN',$kiri,$atas,190,0,'C',0,0,0,0);
}

$pdf->SetFont('Arial','B',9);
tabel ('DASAR',$kiri,$atas+9,190,0,'L',0,0,0,0);
tabel (':  NOPEL',$kiri+40,GetY(),190,0,'L',0,0,0,0);
tabel ($nopel1[0],$kiri+57,GetY()-2,12,4,'C',1,0,0,0);
tabel ($nopel1[1],$kiri+57+12,GetY()-2-2,12,4,'C',1,0,0,0);
tabel ($nopel1[2],$kiri+57+12+12,GetY()-2-2,10,4,'C',1,0,0,0);
tabel ('JENIS PELAYANAN',$kiri+95,GetY()-2,10,0,'L',0,0,0,0);
tabel ($jpel,$kiri+95+33,GetY()-2,60,4,'C',1,0,0,0);
$a="Berita Acara ini dibuat berdasarkan formulir isian SPOP dan/atau LSPOP yang diajukan pemohon/subjek pajak. ";
$a=$a."Apabila dikemudian hari diperoleh data/informasi yang berlainan dengan data/informasi awal yang dijadikan dasar";
$a=$a." pembuatan Berita Acara ini, maka akan dilakukan peninjauan kembali sebagaimana mestinya.";
$pdf->SetFont('Arial','',9);
tabel ($a,$kiri,GetY()+2,190-2,5,'L',0,4,1,1);

//informasi awal
$pdf->SetFont('Arial','B',9);
tabel ('A.',$kiri,GetY()+4,190,0,'L',0,0,0,0);
tabel ('Informasi Awal SPPT PBB P2 :',$kiri+4,GetY(),190,0,'L',0,0,0,0);

$res = pg_query("select * from pendataan_awal where no_pelayanan='".trim($_GET['nopel'])."' order by nop");
if(pg_num_rows($res)!=0)
{
for ($no=1;$no<=pg_num_rows($res);$no++)
{
   $row=pg_fetch_array($res);
   $tbh=(strlen($no.". ")-4)*2+1;
   $pdf->SetFont('Arial','',9);

   tabel ($no.". ",$kiri+4,GetY()+6,190,0,'L',0,0,0,0);
   tabel ("NOP",$kiri+$tbh+9,GetY(),190,0,'L',0,0,0,0);
   tabel (":",$kiri+45,GetY(),190,0,'L',0,0,0,0);
   tabel ($row['nop'],$kiri+45+4,GetY()-3,60,4,'C',1,0,0,0);

   tabel ("Nama Subjek Pajak",$kiri+$tbh+9,GetY()+4,190,0,'L',0,0,0,0);
   tabel (":",$kiri+45,GetY(),190,0,'L',0,0,0,0);
   $y1=GetY();
   tabel ($row['nama_sp'],$kiri+45+4,GetY()-3,78,5,'C',1,4,1,0);
   $y2=GetY();
   $pdf->SetY($y1);
   tabel ("NIK :",$kiri+$tbh+132,GetY(),190,0,'',0,0,0,0);
   tabel ($row['nik'],$kiri+130+11,GetY()-3,45,4,'C',1,4,1,0);
   $pdf->SetY($y2);

   tabel ("Alamat Subjek Pajak",$kiri+$tbh+9,GetY()+3,190,0,'L',0,0,0,0);
   tabel (":",$kiri+45,GetY(),190,0,'L',0,0,0,0);
   tabel ($row['alamat_sp'],$kiri+45+4,GetY()-2,137,4,'L',1,4,1,1);

   tabel ("Alamat Objek Pajak",$kiri+$tbh+9,GetY()+3,190,0,'L',0,0,0,0);
   tabel (":",$kiri+45,GetY(),190,0,'L',0,0,0,0);
   tabel ($row['alamat_op'],$kiri+45+4,GetY()-2,137,4,'L',1,4,1,1);

   tabel ("Luas Tanah/Bangunan",$kiri+$tbh+9,GetY()+3,190,0,'L',0,0,0,0);
   tabel (":  LT",$kiri+45,GetY(),190,0,'L',0,0,0,0);
   tabel ($row['luas_tanah_awal'],$kiri+45+9,GetY()-2,17,4,'C',1,4,1,1);
   tabel ("LB",$kiri+45+33,GetY()-2,190,0,'L',0,0,0,0);
   tabel ($row['luas_bangunan_awal'],$kiri+45+40,GetY()-2,17,4,'C',1,4,1,1);
}
}
//informasi verifikasi pendataan
$pdf->SetFont('Arial','B',9);
tabel ('B.',$kiri,GetY()+4,190,0,'L',0,0,0,0);
tabel ('Hasil Verifikasi Pendataan :',$kiri+4,GetY(),190,0,'L',0,0,0,0);

$a="Berdasarkan hasil verifikasi isian SPOP dan/atau LSPOP dengan data/dokumen yang dilampirkan, dapat kami";
$a=$a." sampaikan bahwa data/informasi dalam rangka proses penetapan SPPT PBB-nya adalah sebagai berikut :";
$pdf->SetFont('Arial','',9);
tabel ($a,$kiri+4,GetY()+2,190-8,4,'L',0,4,1,1);

$res = pg_query("select * from verifikasi_pendataan where no_pelayanan='".trim($_GET['nopel'])."' order by nop");
if(pg_num_rows($res)!=0)
{
for ($no=1;$no<=pg_num_rows($res);$no++)
{
   // isi verifikasi
   $row=pg_fetch_array($res);
   $tbh=(strlen($no.". ")-4)*2+1;
   $pdf->SetFont('Arial','',9);

   tabel ($no.". ",$kiri+4,GetY()+5,190,0,'L',0,0,0,0);
   tabel ("NOP",$kiri+$tbh+9,GetY(),190,0,'L',0,0,0,0);
   tabel (":",$kiri+45,GetY(),190,0,'L',0,0,0,0);
   tabel ($row['nop'],$kiri+45+4,GetY()-2,60,4,'C',1,0,0,0);

   tabel ("Nama Subjek Pajak",$kiri+$tbh+9,GetY()+3,190,0,'L',0,0,0,0);
   tabel (":",$kiri+45,GetY(),190,0,'L',0,0,0,0);
   $y1=GetY();
   tabel ($row['nama_sp'],$kiri+45+4,GetY()-2,78,4,'C',1,4,1,0);
   $y2=GetY();
   $pdf->SetY($y1);
   tabel ("NIK :",$kiri+$tbh+132,GetY(),190,0,'',0,0,0,0);
   tabel ($row['nik'],$kiri+130+11,GetY()-2,45,4,'C',1,4,1,0);
   $pdf->SetY($y2);

   tabel ("Alamat Subjek Pajak",$kiri+$tbh+9,GetY()+3,190,0,'L',0,0,0,0);
   tabel (":",$kiri+45,GetY(),190,0,'L',0,0,0,0);
   tabel ($row['alamat_sp'],$kiri+45+4,GetY()-2,137,4,'L',1,4,1,1);

   tabel ("   RT",$kiri+45,GetY()+3,190,0,'L',0,0,0,0);
   tabel ($row['rt_sp'],$kiri+45+9,GetY()-2,17,4,'C',1,4,1,1);
   tabel ("RW",$kiri+45+33,GetY()-2,190,0,'L',0,0,0,0);
   tabel ($row['rw_sp'],$kiri+45+40,GetY()-2,17,4,'C',1,4,1,1);
   tabel ("KEL",$kiri+131,GetY()-2,190,0,'L',0,0,0,0);
   tabel ($row['kel_sp'],$kiri+130+11,GetY()-2,45,4,'C',1,4,1,1);
   tabel ("KEC",$kiri+131,GetY()+3,190,0,'L',0,0,0,0);
   tabel ($row['kec_sp'],$kiri+130+11,GetY()-2,45,4,'C',1,4,1,1);

   tabel ("Alamat Objek Pajak",$kiri+$tbh+9,GetY()+3,190,0,'L',0,0,0,0);
   tabel (":",$kiri+45,GetY(),190,0,'L',0,0,0,0);
   tabel ($row['alamat_op'],$kiri+45+4,GetY()-2,137,4,'L',1,4,1,1);

   tabel ("   RT",$kiri+45,GetY()+3,190,0,'L',0,0,0,0);
   tabel ($row['rt_op'],$kiri+45+9,GetY()-2,17,4,'C',1,4,1,1);
   tabel ("RW",$kiri+45+33,GetY()-2,190,0,'L',0,0,0,0);
   tabel ($row['rw_op'],$kiri+45+40,GetY()-2,17,4,'C',1,4,1,1);
   tabel ("KEL",$kiri+131,GetY()-2,190,0,'L',0,0,0,0);
   tabel ($row['kel_op'],$kiri+130+11,GetY()-2,45,4,'C',1,4,1,1);
   tabel ("KEC",$kiri+131,GetY()+3,190,0,'L',0,0,0,0);
   tabel ($row['kec_op'],$kiri+130+11,GetY()-2,45,4,'C',1,4,1,1);

   tabel ("Luas Tanah/Bangunan",$kiri+$tbh+9,GetY()+3,190,0,'L',0,0,0,0);
   tabel (":  LT",$kiri+45,GetY(),190,0,'L',0,0,0,0);
   tabel ($row['luas_tanah'],$kiri+45+9,GetY()-2,17,4,'C',1,4,1,1);
   tabel ("LB",$kiri+45+33,GetY()-2,190,0,'L',0,0,0,0);
   tabel ($row['luas_bangunan'],$kiri+45+40,GetY()-2,17,4,'C',1,4,1,1);
   if ($row['is_renov']=='1')
   {
      tabel ("Tahun Renovasi",$kiri+$tbh+115,GetY()-2,190,0,'L',0,0,0,0);
   }
   else
   {
      tabel ("Tahun Bangun",$kiri+$tbh+117,GetY()-2,190,0,'L',0,0,0,0);
   }
   tabel ($row['tahun_renovasi'],$kiri+130+11,GetY()-2,45,4,'C',1,4,1,1);

   tabel ("Informasi Lainnya",$kiri+$tbh+9,GetY()+3,190,0,'L',0,0,0,0);
   tabel (":",$kiri+45,GetY(),190,0,'L',0,0,0,0);
   tabel ($row['info_lain'],$kiri+45+4,GetY()-2,137,5,'L',1,4,1,0);
}
}

tabel ("Nomor Berita Acara Pendataan",$kiri+93,GetY()+3,190,0,'L',0,0,0,0);
$pdf->SetFont('Arial','B',9);
tabel ($nobapdt,$kiri+130+11,GetY()-2,45,4,'C',1,4,1,0);
$pdf->SetFont('Arial','',9);
tabel ("Dibuat di Bogor pada",$kiri+107,GetY()+3,190,0,'L',0,0,0,0);
tabel ($tgl_bapdt,$kiri+130+11,GetY()-2,45,4,'C',1,4,1,0);

if($isrubah==1)
{
   tabel ("Petugas Pendata",$kiri+100+11,GetY()+6,60,5,'C',0,0,0,0);
   $pdf->SetFont('Arial','U',9);
   tabel ($nmpetugasdata,$kiri+100+11,GetY()+16,60,5,'C',0,0,0,0);
   $pdf->SetFont('Arial','',9);
   tabel ('NIP. '.$nippetugasdata,$kiri+100+11,GetY()-1,60,5,'C',0,0,0,0);
}
else
{
   $y1=GetY();
   tabel ("Petugas Pendata",$kiri+5,GetY()+6,80,5,'C',0,0,0,0);
   $pdf->SetFont('Arial','U',9);
   tabel ($nmpetugasdata,$kiri+5,GetY()+16,80,5,'C',0,0,0,0);
   $pdf->SetFont('Arial','',9);
   tabel ("NIP. ".$nippetugasdata,$kiri+5,GetY()-1,80,5,'C',0,0,0,0);

   $pdf->SetY($y1);
   tabel ("Kasubbid Pendataan, Penilaian PBB dan BPHTB",$kiri+106,GetY()+6,80,5,'C',0,0,0,0);
   $pdf->SetFont('Arial','U',9);
   tabel ($nmkasipedanil,$kiri+106,GetY()+16,80,5,'C',0,0,0,0);
   $pdf->SetFont('Arial','',9);
   tabel ("NIP. ".$nipkasipedanil,$kiri+106,GetY()-1,80,5,'C',0,0,0,0);

   tabel ("Mengetahui :",$kiri,GetY()+6,190,5,'C',0,0,0,0);
   tabel ("Kepala Bidang Pendataan dan Pelayanan",$kiri,GetY(),190,5,'C',0,0,0,0);
   $pdf->SetFont('Arial','U',9);
   tabel ($nmkabidpedanil,$kiri,GetY()+16,190,5,'C',0,0,0,0);
   $pdf->SetFont('Arial','',9);
   tabel ("NIP. ".$nipkabidpedanil,$kiri,GetY()-1,190,5,'C',0,0,0,0);
}

//informasi verifikasi penilaian
if($isrubah==1)
{
$res = pg_query("select * from verifikasi_penilaian where no_pelayanan='".trim($_GET['nopel'])."' order by nop");
if(pg_num_rows($res)!=0)
{
$pdf->AddPage('P','Legal');
$pdf->image($filename,179,0,20,20);

$pdf->SetFont('Arial','B',9);
tabel ('C.',$kiri,GetY()+6,190,0,'L',0,0,0,0);
tabel ('Hasil Verifikasi Penilaian :',$kiri+4,GetY(),190,0,'L',0,0,0,0);

$pdf->SetFont('Arial','',9);
tabel ("Berdasarkan Berita Acara Pendataan Nomor :",$kiri+4,GetY()+4,190,0,'L',0,0,0,0);
tabel ($nobapdt,$kiri+72,GetY()-2,45,4,'C',1,0,0,0);
tabel ("dapat kami sampaikan bahwa :",$kiri+118,GetY()-2,190,0,'L',0,0,0,0);

for ($no=1;$no<=pg_num_rows($res);$no++)
{
   // isi verifikasi
   $row=pg_fetch_array($res);
   $tbh=(strlen($no.". ")-4)*2+1;
   $pdf->SetFont('Arial','',9);

   tabel ($no.". ",$kiri+4,GetY()+6,190,0,'L',0,0,0,0);
   tabel ("NOP",$kiri+$tbh+9,GetY(),190,0,'L',0,0,0,0);
   tabel (":",$kiri+45,GetY(),190,0,'L',0,0,0,0);
   tabel ($row['nop'],$kiri+45+4,GetY()-2,60,4,'C',1,0,0,0);

   tabel ("Nama Subjek Pajak",$kiri+$tbh+9,GetY()+3,190,0,'L',0,0,0,0);
   tabel (":",$kiri+45,GetY(),190,0,'L',0,0,0,0);
   $y1=GetY();
   tabel ($row['nama_sp'],$kiri+45+4,GetY()-2,78,4,'C',1,4,1,0);

   $res1 = pg_query("select * from verifikasi_pendataan where no_pelayanan='".trim($_GET['nopel'])."' and nop='".$row['nop']."'");
   if(pg_num_rows($res1)!=0)
   {
      $row1=pg_fetch_array($res1);
      $y2=GetY();
     $pdf->SetY($y1);
     tabel ("NIK :",$kiri+$tbh+132,GetY(),190,0,'',0,0,0,0);
     tabel ($row1['nik'],$kiri+130+11,GetY()-2,45,4,'C',1,4,1,0);
     $pdf->SetY($y2);
   }

   tabel ("Masuk ZNT :",$kiri+$tbh+9,GetY()+3,190,0,'L',0,0,0,0);
   $pdf->SetFont('Arial','B',9);
   tabel ($row['znt'],$kiri+34,GetY()-2,10,4,'C',1,4,1,1);
   $pdf->SetFont('Arial','',9);
   tabel ("Kelas Tanah",$kiri+48,GetY()-2,190,0,'L',0,0,0,0);
   $pdf->SetFont('Arial','B',9);
   tabel ($row['kelas_tanah'],$kiri+76,GetY()-2,10,4,'C',1,4,1,1);
   $pdf->SetFont('Arial','',9);
   tabel ("NJOP",$kiri+94,GetY()-2,190,0,'L',0,0,0,0);
   $pdf->SetFont('Arial','B',9);
   tabel ($row['njop_tanah'],$kiri+106,GetY()-2,30,4,'C',1,4,1,1);
   $pdf->SetFont('Arial','',9);
   tabel ("(dalam ribuan rupiah);",$kiri+137,GetY()-2,190,0,'L',0,0,0,0);

   tabel ("Kelas Bangunan",$kiri+48,GetY()+5,190,0,'L',0,0,0,0);
   $pdf->SetFont('Arial','B',9);
   tabel ($row['kelas_bangunan'],$kiri+76,GetY()-2,10,4,'C',1,4,1,1);
   $pdf->SetFont('Arial','',9);
   tabel ("NJOP",$kiri+94,GetY()-2,190,0,'L',0,0,0,0);
   $pdf->SetFont('Arial','B',9);
   tabel ($row['njop_bangunan'],$kiri+106,GetY()-2,30,4,'C',1,4,1,1);
   $pdf->SetFont('Arial','',9);
   tabel ("(dalam ribuan rupiah);",$kiri+137,GetY()-2,190,0,'L',0,0,0,0);
}

tabel ("Nomor Berita Acara Penilaian",$kiri+95,GetY()+8,190,0,'L',0,0,0,0);
$pdf->SetFont('Arial','B',9);
tabel ($nobanil,$kiri+130+11,GetY()-2,45,4,'C',1,4,1,0);
$pdf->SetFont('Arial','',9);
tabel ("Dibuat di Bogor pada",$kiri+107,GetY()+3,190,0,'L',0,0,0,0);
tabel ($tgl_banil,$kiri+130+11,GetY()-2,45,4,'C',1,4,1,0);

$y1=GetY();
tabel ("Petugas Penilai",$kiri+5,GetY()+6,80,5,'C',0,0,0,0);
$pdf->SetFont('Arial','U',9);
tabel ($nmpetugasnilai,$kiri+5,GetY()+16,80,5,'C',0,0,0,0);
$pdf->SetFont('Arial','',9);
tabel ("NIP. ".$nippetugasnilai,$kiri+5,GetY()-1,80,5,'C',0,0,0,0);

$pdf->SetY($y1);
tabel ("Kasubbid Pendataan, Penilaian PBB dan BPHTB",$kiri+106,GetY()+6,80,5,'C',0,0,0,0);
$pdf->SetFont('Arial','U',9);
tabel ($nmkasipedanil,$kiri+106,GetY()+16,80,5,'C',0,0,0,0);
$pdf->SetFont('Arial','',9);
tabel ("NIP. ".$nipkasipedanil,$kiri+106,GetY()-1,80,5,'C',0,0,0,0);

tabel ("Mengetahui :",$kiri,GetY()+6,190,5,'C',0,0,0,0);
tabel ("Kepala Bidang Pendataan dan Pelayanan",$kiri,GetY(),190,5,'C',0,0,0,0);
$pdf->SetFont('Arial','U',9);
tabel ($nmkabidpedanil,$kiri,GetY()+16,190,5,'C',0,0,0,0);
$pdf->SetFont('Arial','',9);
tabel ("NIP. ".$nipkabidpedanil,$kiri,GetY()-1,190,5,'C',0,0,0,0);
}
}
//output file pdf
$pdf->Output();
?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Page</title>
<meta name="generator" content="WYSIWYG Web Builder 11 - http://www.wysiwygwebbuilder.com">
<link href="Untitled2.css" rel="stylesheet">
<link href="bapdtpdf.css" rel="stylesheet">
</head>
<body>
<div id="container">
</div>
</body>
</html>
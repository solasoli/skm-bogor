<?php 
session_start();

function akhir_bulan($bulan,$tahun)
{
   $hasil=0;
   switch($bulan)
   {
      case 1: $hasil= 31;
              return $hasil;
      case 2: $kabisat=$tahun%4;
              if ($kabisat==0)
              {
                 $hasil= 29;
              }
              else
              {
                 $hasil= 28;
              }
              return $hasil;
      case 3: $hasil= 31;
              return $hasil;
      case 4: $hasil= 30;
              return $hasil;
      case 5: $hasil= 31;
              return $hasil;
      case 6: $hasil= 30;
              return $hasil;
      case 7: $hasil= 31;
              return $hasil;
      case 8: $hasil= 31;
              return $hasil;
      case 9: $hasil= 30;
              return $hasil;
      case 10: $hasil= 31;
               return $hasil;
      case 11: $hasil= 30;
               return $hasil;
      case 12: $hasil= 31;
               return $hasil;
   }
}

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
$kiri=20;
$atas=15;

//memanggil fpdf
require_once ("fpdf181/fpdf.php");
$pdf=new FPDF();
$pdf->AddPage('P','Legal');

//Begin with regular font

$filename=qr ('temp','layanan-bapenda.kotabogor.go.id/sivera/lbrver.php?id='.$_GET['id']);
$pdf->image($filename,180,22,20,20);

$con = mysql_connect('localhost','root','') or die(mysql_error());
mysql_select_db('sivera') or die(mysql_error());

$res = mysql_query("select * from t_verifikasi where id='".$_GET['id']."'");
if(mysql_num_rows($res)>0)
{
   $row=mysql_fetch_array($res);
   $res1 = mysql_query("select *,day(tgl_kukuh) as 'tgl', month(tgl_kukuh) as 'bln', year(tgl_kukuh) as 'thn' from m_wajib_pajak where npwpd='".$row['npwpd']."'");
   if(mysql_num_rows($res1)>0)
   {
      $row1=mysql_fetch_array($res1);
      $nmush=$row1['nama_usaha'];
      $nokuh=$row1['kukuh_no'];
      $tglreg=$row1['tgl']." ".get_bulan($row1['bln'])." ".$row1['thn'];
      $npwpd=$row1['npwpd'];
      $nmwp=$row1['nama_wp'];
      $alm=$row1['alamat_usaha'];
      $jnspjk=$row1['jenis_pajak'];
      $cp=$row1['kontak_person'];
      $nohp=$row1['no_hp'];
   }
   $res2 = mysql_query("select *,day(tglsspd) as 'tgl', month(tglsspd) as 'bln', year(tglsspd) as 'thn' from m_pembayaran where npwpd='".$row['npwpd']."' and tahun='".$row['tahun']."' and nosspd='".$row['no_sspd']."'");
   if(mysql_num_rows($res2)>0)
   {
      $row2=mysql_fetch_array($res2);
      $tglsspd=$row2['tgl']." ".get_bulan($row2['bln'])." ".$row2['thn'];
   }
   $id1=$row['id_insert'];
   $id2=$row['id_edit'];
   if ($id2==0)
   {$idd=$id1;}
    else
   {$idd=$id2;}
}

$pdf->SetFont('Arial','B',14);
tabel ('PRINTOUT VERIFIKASI / PENELITIAN LAPORAN PAJAK DAERAH',10,$atas,190,0,'C',0,0,0,0);
tabel ('JENIS PAJAK : '.$jnspjk,10,$atas+5,190,0,'C',0,0,0,0);

$pdf->SetFont('Arial','B',9);
tabel ('NPWPD',$kiri,$atas+13,190,0,'L',0,0,0,0);
tabel (':  '.$npwpd,$kiri+40,GetY()-2,12,4,'L',0,0,0,0);

tabel ('NAMA USAHA',$kiri,GetY()+2,190,0,'L',0,0,0,0);
tabel (':  '.$nmush,$kiri+40,GetY()-2,12,4,'L',0,0,0,0);

tabel ('NO KUKUH',$kiri,GetY()+2,190,0,'L',0,0,0,0);
tabel (':  '.$nokuh,$kiri+40,GetY()-2,12,4,'L',0,0,0,0);

tabel ('TGL KUKUH',$kiri,GetY()+2,190,0,'L',0,0,0,0);
tabel (':  '.$tglreg,$kiri+40,GetY()-2,12,4,'L',0,0,0,0);

tabel ('ALAMAT USAHA',$kiri,GetY()+2,190,0,'L',0,0,0,0);
tabel (':  '.$alm,$kiri+40,GetY()-2,12,4,'L',0,0,0,0);

tabel ('NAMA WAJIB PAJAK',$kiri,GetY()+2,190,0,'L',0,0,0,0);
tabel (':  '.$nmwp,$kiri+40,GetY()-2,12,4,'L',0,0,0,0);

tabel ('KONTAK PERSON',$kiri,GetY()+2,190,0,'L',0,0,0,0);
tabel (':  '.$cp,$kiri+40,GetY()-2,12,4,'L',0,0,0,0);

tabel ('NO HP',$kiri,GetY()+2,190,0,'L',0,0,0,0);
tabel (':  '.$nohp,$kiri+40,GetY()-2,12,4,'L',0,0,0,0);

$pdf->SetFont('Arial','B',10);
tabel ('VERIFIKASI PENERIMAAN PAJAK, SSPD TANGGAL : '.$tglsspd,$kiri,GetY()+6,180,0,'C',0,0,0,0);
$pdf->SetFont('Arial','',9);
tabel ('NO',$kiri,GetY()+3,10,5,'C',1,0,0,0);
tabel ('VERIFIKASI DOKUMEN',$kiri+10,GetY()-5,40,5,'C',1,0,0,0);
tabel ('DATA VERIFIKASI',$kiri+50,GetY()-5,80,5,'C',1,0,0,0);
tabel ('HASIL VERIFIKASI',$kiri+130,GetY()-5,50,5,'C',1,0,0,0);

tabel ('1. ',$kiri,GetY(),10,5,'R',1,0,0,0);
tabel ('SPTPD',$kiri+10,GetY()-5,40,5,'C',1,0,0,0);
tabel ('NO SPTPD : '.$row2['nobayar'],$kiri+50,GetY()-5,80,5,'L',1,0,0,0);
tabel ('VALID',$kiri+130,GetY()-5,50,5,'C',1,0,0,0);

tabel ('',$kiri,GetY(),10,5,'R',1,0,0,0);
tabel ('',$kiri+10,GetY()-5,40,5,'C',1,0,0,0);
$a=explode('-',$row2['masadari']);
$md=$a[2].'-'.$a[1].'-'.$a[0];
$a=explode('-',$row2['masasd']);
$sd=$a[2].'-'.$a[1].'-'.$a[0];
tabel ('MASA PAJAK : '.$md.' s/d '.$sd,$kiri+50,GetY()-5,80,5,'L',1,0,0,0);
tabel ('VALID',$kiri+130,GetY()-5,50,5,'C',1,0,0,0);

tabel ('',$kiri,GetY(),10,5,'R',1,0,0,0);
tabel ('',$kiri+10,GetY()-5,40,5,'C',1,0,0,0);
$oms=number_format($row2['omset_spt'],0,",",".");
if ($row['isvalid_omset']==1)
{$val='VALID';}
else
{$val='TIDAK VALID';}
tabel ('OMSET : Rp. '.$oms,$kiri+50,GetY()-5,80,5,'L',1,0,0,0);
tabel ($val,$kiri+130,GetY()-5,50,5,'C',1,0,0,0);

tabel ('',$kiri,GetY(),10,5,'R',1,0,0,0);
tabel ('',$kiri+10,GetY()-5,40,5,'C',1,0,0,0);
$trf=$row2['tarif_spt']*100;
if ($row['isvalid_tarif']==1)
{$val='VALID';}
else
{$val='TIDAK VALID';}
tabel ('TARIF : '.$trf.'%',$kiri+50,GetY()-5,80,5,'L',1,0,0,0);
tabel ($val,$kiri+130,GetY()-5,50,5,'C',1,0,0,0);

tabel ('',$kiri,GetY(),10,5,'R',1,0,0,0);
tabel ('',$kiri+10,GetY()-5,40,5,'C',1,0,0,0);
$pjk=number_format($row2['tagihan'],0,",",".");
if ($row['isvalid_pok_pajak']==1)
{$val='VALID';}
else
{$val='TIDAK VALID';}
tabel ('PAJAK TERUTANG : Rp. '.$pjk,$kiri+50,GetY()-5,80,5,'L',1,0,0,0);
tabel ($val,$kiri+130,GetY()-5,50,5,'C',1,0,0,0);

tabel ('',$kiri,GetY(),10,5,'R',1,0,0,0);
tabel ('',$kiri+10,GetY()-5,40,5,'C',1,0,0,0);
$a=explode('-',$row2['jatuhtempo']);
$tmp=$a[2].' '.get_bulan($a[1]).' '.$a[0];
tabel ('JATUH TEMPO : '.$tmp,$kiri+50,GetY()-5,80,5,'L',1,0,0,0);
tabel ('VALID',$kiri+130,GetY()-5,50,5,'C',1,0,0,0);

tabel ('',$kiri,GetY(),10,5,'R',1,0,0,0);
tabel ('',$kiri+10,GetY()-5,40,5,'C',1,0,0,0);
tabel ('',$kiri+50,GetY()-5,80,5,'L',1,0,0,0);
tabel ('',$kiri+130,GetY()-5,50,5,'C',1,0,0,0);

tabel ('2. ',$kiri,GetY(),10,5,'R',1,0,0,0);
tabel ('SSPD',$kiri+10,GetY()-5,40,5,'C',1,0,0,0);
tabel ('NO BAYAR : '.$row2['nobayar'],$kiri+50,GetY()-5,80,5,'L',1,0,0,0);
tabel ('SESUAI SPTPD',$kiri+130,GetY()-5,50,5,'C',1,0,0,0);

tabel ('',$kiri,GetY(),10,5,'R',1,0,0,0);
tabel ('',$kiri+10,GetY()-5,40,5,'C',1,0,0,0);
$a=explode(' ',$row2['tglsspd']);
$a=explode('-',$a[0]);
$tgl=$a[2].' '.get_bulan($a[1]).' '.$a[0];
tabel ('TANGGAL SSPD : '.$tgl,$kiri+50,GetY()-5,80,5,'L',1,0,0,0);
tabel ('SESUAI SPTPD',$kiri+130,GetY()-5,50,5,'C',1,0,0,0);

tabel ('',$kiri,GetY(),10,5,'R',1,0,0,0);
tabel ('',$kiri+10,GetY()-5,40,5,'C',1,0,0,0);
$pok=number_format($row2['tagihan'],0,",",".");
tabel ('BAYAR POKOK : Rp. '.$pok,$kiri+50,GetY()-5,80,5,'L',1,0,0,0);
tabel ('SESUAI SPTPD',$kiri+130,GetY()-5,50,5,'C',1,0,0,0);

tabel ('',$kiri,GetY(),10,5,'R',1,0,0,0);
tabel ('',$kiri+10,GetY()-5,40,5,'C',1,0,0,0);
if ($row2['tagihan']==0)
{$bln=0;}
else
{$bln=(($row2['denda']/2)*100)/$row2['tagihan'];}
tabel ('PNDPTN DENDA : 2% X '.$bln.' BULAN X '.$pok,$kiri+50,GetY()-5,80,5,'L',1,0,0,0);
tabel ('SESUAI SPTPD',$kiri+130,GetY()-5,50,5,'C',1,0,0,0);

tabel ('',$kiri,GetY(),10,5,'R',1,0,0,0);
tabel ('',$kiri+10,GetY()-5,40,5,'C',1,0,0,0);
$dnd=number_format($row2['denda'],0,",",".");
tabel ('BAYAR DENDA : Rp. '.$dnd,$kiri+50,GetY()-5,80,5,'L',1,0,0,0);
tabel ('SESUAI SPTPD',$kiri+130,GetY()-5,50,5,'C',1,0,0,0);

tabel ('',$kiri,GetY(),10,5,'R',1,0,0,0);
tabel ('',$kiri+10,GetY()-5,40,5,'C',1,0,0,0);
tabel ('',$kiri+50,GetY()-5,80,5,'L',1,0,0,0);
tabel ('',$kiri+130,GetY()-5,50,5,'C',1,0,0,0);

tabel ('3. ',$kiri,GetY(),10,5,'R',1,0,0,0);
if ($row['verif_bukti_byr']==1)
{
   $ada='MELAMPIRKAN BUKTI BAYAR';
   $val='SESUAI SPTPD';
}
else
{
   if ($row['verif_bukti_byr']==2)
   {
      $ada='MELAMPIRKAN BUKTI BAYAR';
      $val='TIDAK SESUAI SPTPD';
   }
   else
   {
      $ada='TIDAK MELAMPIRKAN BUKTI BAYAR';
      $val='-';
   }
}
tabel ('BUKTI BAYAR BJB',$kiri+10,GetY()-5,40,5,'C',1,0,0,0);
tabel ($ada,$kiri+50,GetY()-5,80,5,'L',1,0,0,0);
tabel ($val,$kiri+130,GetY()-5,50,5,'C',1,0,0,0);

tabel ('',$kiri,GetY(),10,5,'R',1,0,0,0);
tabel ('',$kiri+10,GetY()-5,40,5,'C',1,0,0,0);
tabel ('',$kiri+50,GetY()-5,80,5,'L',1,0,0,0);
tabel ('',$kiri+130,GetY()-5,50,5,'C',1,0,0,0);

tabel ('4. ',$kiri,GetY(),10,5,'R',1,0,0,0);
tabel ('KARTU DATA',$kiri+10,GetY()-5,40,5,'C',1,0,0,0);

$a=explode(' ',$row2['tglsspd']);
$a=explode('-',$a[0]);
$th3=$a[0]; //tgl sspd
$bl3=$a[1];

$a=explode(' ',$row2['masasd']);
$a=explode('-',$a[0]);
$th4=$a[0]; //masasd

//penentuan masa kartu data sd (th3bl3)
if ($th4!=$th3) //kalau tahun masa pajak berbeda dengan tahun sspd ambil tahun masa pajak, kalau tidak tahun sspd
{
   $th3=$th4; //pakai masa pajak sd
   $bl3=12; // bulan masasd = des 
}
else //kalau sama
{
   $bl3=$bl3-1; // bulan masasd = bulan sebelum bulan sspd 
}

//penentuan masa dari (th2bl2) bulan 12 tahun sebelumnya
$bl2=12;
$th2=$th3-1;

$th1=$th2; //ambil data tanggal kukuh

$a=explode(' ',$row1['tgl_kukuh']);
$a=explode('-',$a[0]);
$th0=$a[0];
$bl0=$a[1];

if($th0==$th3) //kalau tahun sama maka masadari ambil bulan tanggal kukuh
{
   $th1=$th0;
   $bl1=$bl0;
}
else
{
   $bl1=$bl2;
}

$res4 = mysql_query("select * from m_pembayaran where npwpd='".$row['npwpd']."' and masadari >='".$th1."/".$bl1."/1' and masasd<='".$th3."/".$bl3."/".akhir_bulan($bl3,$th3)."' order by masadari");
if(mysql_num_rows($res4)>0)
{
   $no=0;
   $tot=0;
   $tr=0;
   $sm=0; //flat
   $sm1=0; //semi flat
   $semi=1; //semi flat
   $deviasi=0;
   $maxdev=0;
   $pjk1=0;
   $pjk2=0;
   $devtot=0;
   $devbyk=0;
   For ($i=1;$i<=mysql_num_rows($res4);$i++)
   {
      $row4=mysql_fetch_array($res4);
      $pjk=$row4['tagihan'];

      $bulan1=0;
      if ($pjk!=0)
      {
         $a=explode('-',$row4['masadari']);
         $bulan=$a[1];

         if ($bulan1!=$bulan) // kalau transaksi sama bulan berarti di hitung 1 transaksi
         {
            $tr=$tr+1;
            if ($pjk1==$pjk)
            {
               $sm=$sm+1;
               $sm1=$sm1+1;
            }
            else
            {
               $sm=0;
               if ($pjk2==$pjk)
               {
                  $sm1=$sm1+1;
               }
            }
            if ($i>1)
            {
               $dev=($pjk-$pjk1)/$pjk1*100;
               $devbyk=$devbyk+1;
               if ($dev<0)
               {
                  $dev=$dev*(-1);
               }
               if ($dev>2) //jika deviasi lebih dari 2% berarti tidak flat
               {
                  $semi=0;
               }
               if ($maxdev<$dev)
               {
                  $maxdev=$dev;
               }
               $devtot=$devtot+$dev;
               $deviasi=$devtot/$devbyk;
            }
         }
         else
         {
            if ($pjk2==$pjk+$pjk1)
            {
               $sm=$sm+1;
               $sm1=$sm1+1;
            }
            else
            {
               $sm=0;
               if ($pjk2==$pjk)
               {
                  $sm1=$sm1+1;
               }
            }
            if ($i>1)
            {
               if ($pjk2>0)
               {
                  $deviasi=$deviasi-$dev;
                  $pjk3=$pjk+$pjk1;
                  $dev=($pjk3-$pjk2)/$pjk2*100;
                  $devbyk=$devbyk+1;
                  if ($dev<0)
                  {
                     $dev=$dev*(-1);
                  }
                  if ($dev>2) //jika deviasi lebih dari 2% berarti tidak flat
                  {
                     $semi=0;
                  }
                  if ($maxdev<$dev)
                  {
                     $maxdev=$dev;
                  }
                  $devtot=$devtot+$dev;
                  $deviasi=$devtot/$devbyk;
               }
            }
         }

         $pjk2=$pjk1;
         $pjk1=$pjk;
         $tot=$tot+$pjk;
         $rat=$tot/$tr;
         $ratmin=$rat-($rat*1/100);
         $ratmax=$rat+($rat*1/100);
         if ($rat==$pjk)
         {
            $his='FLAT';
            $rekom1='USULKAN PEMBINAAN DAN UJI POTENSI';
         }
         else
         {        
            if (($semi==1)||(($sm1>=1)&&($sm<5)))
            {
               $his='SEMI FLAT';
               $rekom1='USULKAN PEMBINAAN DAN UJI POTENSI';
            }
            else
            {
               $his='TIDAK (FLAT/SEMI FLAT)';
               $rekom1='';
               $sm=0;
            }
         }
         if ($sm>=5)
         {
            $his='FLAT';
            $rekom1='USULKAN PEMBINAAN DAN UJI POTENSI';
         }
         $bulan1=$bulan;
      }

      if ($i==1)
      {
         $a=explode('-',$row4['masadari']);
         $thn1=$a[0];
         $bln1=$a[1];
         $thn2=$thn1;
         $bln2=$bln1;
         if (($thn1!=$th1)||($bln1!=$bl1)) //belum dibayar thn sblmnya atau bulan sebelumnya
         {
            if ($bln1==1)
            {
               $bl=12;
               $th=$thn1-1;
            }
            else
            {
               $bl=$bln1-1;
               $th=$thn1;
            }
            $no=$no+1;
            tabel ('MASA PAJAK '.get_bulan($bl1).' '.$th1.' S/D '.get_bulan($bl).' '.$th,$kiri+50,GetY()-5,80,5,'L',1,0,0,0);
            tabel ('BELUM DIBAYAR',$kiri+130,GetY()-5,50,5,'C',1,0,0,0);
         }

         if ($i==mysql_num_rows($res4)) //selesai
         {
            $a=explode('-',$row4['masasd']);
            $thn2=$a[0];
            $bln2=$a[1];

            $no=$no+1;
            if ($no!=1)
            {
               tabel ('',$kiri,GetY(),10,5,'R',1,0,0,0);
               tabel ('',$kiri+10,GetY()-5,40,5,'C',1,0,0,0);
            }
            tabel ('MASA PAJAK '.get_bulan($bln1).' '.$thn1.' S/D '.get_bulan($bln2).' '.$thn2,$kiri+50,GetY()-5,80,5,'L',1,0,0,0);
            tabel ('DIBAYAR',$kiri+130,GetY()-5,50,5,'C',1,0,0,0);
         }
      }
      else
      {
         $a=explode('-',$row4['masadari']);
         $th=$a[0];
         $bl=$a[1];
         if (($bl==$bln2+1)||($bl==1)||($bl==$bln2))
         {
            $thn2=$th;
            $bln2=$bl;
            if ($i==mysql_num_rows($res4)) //selesai
            {
               $no=$no+1;
               if ($no!=1)
               {
                  tabel ('',$kiri,GetY(),10,5,'R',1,0,0,0);
                  tabel ('',$kiri+10,GetY()-5,40,5,'C',1,0,0,0);
               }
               tabel ('MASA PAJAK '.get_bulan($bln1).' '.$thn1.' S/D '.get_bulan($bln2).' '.$thn2,$kiri+50,GetY()-5,80,5,'L',1,0,0,0);
               tabel ('DIBAYAR',$kiri+130,GetY()-5,50,5,'C',1,0,0,0);
            }
         }
         else
         {
            $no=$no+1;
            if ($no!=1)
            {
               tabel ('',$kiri,GetY(),10,5,'R',1,0,0,0);
               tabel ('',$kiri+10,GetY()-5,40,5,'C',1,0,0,0);
            }
            tabel ('MASA PAJAK '.get_bulan($bln1).' '.$thn1.' S/D '.get_bulan($bln2).' '.$thn2,$kiri+50,GetY()-5,80,5,'L',1,0,0,0);
            tabel ('DIBAYAR',$kiri+130,GetY()-5,50,5,'C',1,0,0,0);

            tabel ('',$kiri,GetY(),10,5,'R',1,0,0,0);
            tabel ('',$kiri+10,GetY()-5,40,5,'C',1,0,0,0);

            tabel ('MASA PAJAK '.get_bulan($bln2+1).' '.$thn2.' S/D '.get_bulan($bl-1).' '.$th,$kiri+50,GetY()-5,80,5,'L',1,0,0,0);
            tabel ('BELUM DIBAYAR',$kiri+130,GetY()-5,50,5,'C',1,0,0,0);

            $thn1=$th;
            $bln1=$bl;
            $thn2=$th;
            $bln2=$bl;
         }
      }
   }
}

tabel ('',$kiri,GetY(),10,5,'R',1,0,0,0);
tabel ('',$kiri+10,GetY()-5,40,5,'C',1,0,0,0);
tabel ('HISTORI PAJAK',$kiri+50,GetY()-5,80,5,'L',1,0,0,0);
tabel ($his,$kiri+130,GetY()-5,50,5,'C',1,0,0,0);

tabel ('',$kiri,GetY(),10,5,'R',1,0,0,0);
tabel ('',$kiri+10,GetY()-5,40,5,'C',1,0,0,0);
tabel ('',$kiri+50,GetY()-5,80,5,'L',1,0,0,0);
tabel ('',$kiri+130,GetY()-5,50,5,'C',1,0,0,0);

tabel ('5. ',$kiri,GetY(),10,5,'R',1,0,0,0);
if ($row['verif_rekap_penj']==1)
{
   $ada='MELAMPIRKAN REKAP PENJUALAN';
   $val='DATA SESUAI SPTPD';
}
else
{
   if ($row['verif_rekap_penj']==2)
   {
      $ada='MELAMPIRKAN REKAP PENJUALAN';
      $val='DATA TIDAK SESUAI SPTPD';
   }
   else
   {
      $ada='TIDAK MELAMPIRKAN REKAP PENJUALAN';
      $val='-';
   }
}
tabel ('REKAP PENJUALAN',$kiri+10,GetY()-5,40,5,'C',1,0,0,0);
tabel ($ada,$kiri+50,GetY()-5,80,5,'L',1,0,0,0);
tabel ($val,$kiri+130,GetY()-5,50,5,'C',1,0,0,0);

tabel ('',$kiri,GetY(),10,5,'R',1,0,0,0);
tabel ('',$kiri+10,GetY()-5,40,5,'C',1,0,0,0);
tabel ('',$kiri+50,GetY()-5,80,5,'L',1,0,0,0);
tabel ('',$kiri+130,GetY()-5,50,5,'C',1,0,0,0);

tabel ('6. ',$kiri,GetY(),10,5,'R',1,0,0,0);
if ($row['verif_bill']==1)
{
   $ada='MELAMPIRKAN BILL/NOTA/CR';
   $val='DATA SESUAI SPTPD';
}
else
{
   if ($row['verif_bill']==2)
   {
      $ada='MELAMPIRKAN BILL/NOTA/CR';
      $val='DATA TIDAK SESUAI SPTPD';
   }
   else
   {
      $ada='TIDAK MELAMPIRKAN BILL/NOTA/CR';
      $val='-';
   }
}
tabel ('BILL/NOTA/CR',$kiri+10,GetY()-5,40,5,'C',1,0,0,0);
tabel ($ada,$kiri+50,GetY()-5,80,5,'L',1,0,0,0);
tabel ($val,$kiri+130,GetY()-5,50,5,'C',1,0,0,0);

$tgl5=$th3.'/'.$bl3.'/'.akhir_bulan($bl3,$th3);
$res5 = mysql_query("update m_wajib_pajak set verif_kartudat='".$his."',tgl_verif_kartudat='".$tgl5."' where npwpd='".$row1['npwpd']."' and tgl_verif_kartudat<='".$tgl5."'");

$pdf->SetFont('Arial','B',11);
tabel ('CATATAN VERIFIKASI',10,GetY()+8,190,0,'C',0,0,0,0);

$pdf->SetFont('Arial','',9);
tabel ('',$kiri,GetY()+4,10,5,'R',1,0,0,0);
tabel ('',$kiri+10,GetY()-5,170,5,'L',1,0,0,0);
tabel ('',$kiri,GetY(),10,5,'R',1,0,0,0);
tabel ('',$kiri+10,GetY()-5,170,5,'l',1,0,0,0);

$pdf->SetFont('Arial','B',11);
tabel ('REKOMENDASI VERIFIKASI',10,GetY()+8,190,0,'C',0,0,0,0);

$pdf->SetFont('Arial','',9);
if ($rekom1!='')
{
   tabel ('1.',$kiri,GetY()+4,10,5,'R',1,0,0,0);
   tabel ($rekom1,$kiri+10,GetY()-5,170,5,'L',1,0,0,0);
}
else
{
   tabel ('',$kiri,GetY()+4,10,5,'R',1,0,0,0);
   tabel ('',$kiri+10,GetY()-5,170,5,'L',1,0,0,0);
}
tabel ('',$kiri,GetY(),10,5,'R',1,0,0,0);
tabel ('',$kiri+10,GetY()-5,170,5,'l',1,0,0,0);

$pdf->SetFont('Arial','',10);
tabel ('',$kiri,GetY()+4,120,5,'C',0,0,0,0);
$a=explode('-',$row['tgl_verifikasi']);
$tgl=$a[2].' '.get_bulan($a[1]).' '.$a[0];
tabel ('Bogor, '.$tgl,$kiri+120,GetY()-5,60,5,'L',0,0,0,0);

tabel ('Mengetahui :',$kiri,GetY(),120,4,'C',0,0,0,0);
tabel ('',$kiri+120,GetY()-4,60,4,'L',0,0,0,0);

tabel ('Kepala Sub Bidang',$kiri,GetY(),120,4,'C',0,0,0,0);
tabel ('Dibuat Oleh ',$kiri+120,GetY()-4,60,4,'L',0,0,0,0);

tabel ('Penetapan dan Verifikasi',$kiri,GetY(),120,4,'C',0,0,0,0);
tabel ('Verifikator Pajak Daerah',$kiri+120,GetY()-4,60,4,'L',0,0,0,0);

tabel ('',$kiri,GetY(),120,5,'C',0,0,0,0);
tabel ('',$kiri+120,GetY()-5,60,5,'L',0,0,0,0);
tabel ('',$kiri,GetY(),120,5,'C',0,0,0,0);
tabel ('',$kiri+120,GetY()-5,60,5,'L',0,0,0,0);
tabel ('',$kiri,GetY(),120,5,'C',0,0,0,0);
tabel ('',$kiri+120,GetY()-5,60,5,'L',0,0,0,0);

$res3 = mysql_query("select * from m_users where id=".$idd);
if(mysql_num_rows($res3)>0)
{
   $row3=mysql_fetch_array($res3);
   $nm=$row3['nama'];
   $nip=$row3['nip'];
}

tabel ('SLAMET YANUAR, S.Kom, M.Si',$kiri,GetY(),120,4,'C',0,0,0,0);
tabel (strtoupper($nm),$kiri+120,GetY()-4,60,4,'L',0,0,0,0);

tabel ('NIP. 19820108 200501 1 003',$kiri,GetY(),120,4,'C',0,0,0,0);
tabel ('NIP. '.$nip,$kiri+120,GetY()-4,60,4,'L',0,0,0,0);

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
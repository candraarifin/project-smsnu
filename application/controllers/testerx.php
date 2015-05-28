<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of anggota
 *
 * @author candra
 */
class Tester extends Controller {
    
     public function __construct()
       {
            parent::__construct();
            // Your own constructor code
            
            $this->load->helper('form');
       }
       
       function excel() {
           //load our new PHPExcel library
$this->load->library('excel');
//activate worksheet number 1
$this->excel->setActiveSheetIndex(0);
//name the worksheet
$this->excel->getActiveSheet()->setTitle('test worksheet');
//set cell A1 content with some text
$this->excel->getActiveSheet()->setCellValue('A1', 'This is just some text value');
//change the font size
$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
//make the font become bold
$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
//merge cell A1 until D1
$this->excel->getActiveSheet()->mergeCells('A1:D1');
//set aligment to center for that merged cell (A1 to D1)
$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$filename='just_some_random_name.xls'; //save our workbook as this file name
header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
             
//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
//if you want to save it as .XLSX Excel 2007 format
$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
//force user to download the Excel file without writing it to server's HD
$objWriter->save('php://output');
       }
       

       
       
       function ordered_menu($array,$parent_id = 0)
{
  $temp_array = array();
  foreach($array as $element)
  {
    if($element['parent_id']==$parent_id)
    {
      $element['subs'] = ordered_menu($array,$element['id']);
      $temp_array[] = $element;
    }
  }
  return $temp_array;
}
       
       
       
       
       function menunu(){
           echo "menunu";
           $kecamatan=$this->db->get('data_kecamatan')->result();
           $kelurahan=$this->db->get('data_kelurahan')->result();
           $countkel=$this->db->get('data_kelurahan')->num_rows();
           
           echo "<ul>";
           
           foreach ($kecamatan as $kec) {
               echo "<li>".$kec->kecamatan."</li>";
               
               if($countkel > 0){
                   echo "<ul>";
               foreach ($kelurahan as $kel){
                   if($kec->id_kec==$kel->id_kec)
                   echo "<li>".$kel->kelurahan."</li>";
               }
                   echo "</ul>";
               }
               
           }
           
           echo "</ul>";
       }
       
       
       function jedit() {
           $this->load->view('jedit');
       }
       
       function menu() {
           $this->load->view('main/anggota/anggota_head');

           $this->load->view('flataccordion');
       }
       
       function popup() {
           //$this->load->view('main/anggota/anggota_head');
           $this->load->view('main/testpopup');
       }
       
       function pagination(){
           echo "pagination";
           
       }
       
    function insert_pbk() {
        echo "insert pbk";
        $data = array( 
            'uid'=> '458765',
            'Name' => 'Evi Nur Akhidhah',
            'Number'=>'081904202722',
            'identitas' => 'ktp',
            'no_identitas' => '3471050101010001',
            'gender'=>  'P',
            'pendidikan'=>'Sarjana',
            'pekerjaan'=>'Pegawai Swasta',
            'tmp_lahir' => 'Sleman',
            'tgl_lahir' => '871216',
            'alamat' => 'Buyutan RT7 RW8',
            'kelurahan' => 'Banyurejo',
            'kecamatan' => 'Minggir',
            'email' => 'nur_akhi@yahoo.co.id');
          
        

            $this->db->insert('pbk', $data);
    }
 
            
    function index() {
echo base_url();
        $getinbox = $this->db->get_where('inbox', array('Processed' => "false"));
         
        // untuk setiap inbox jalankan 
        foreach ($getinbox->result() as $inbox) {
            
                 
                 $pecah=  explode('*', $inbox->TextDecoded);
                 
                 $katakunciinbox=  strtoupper($pecah[0]);

                 $getkatakunci=$this->db->get('kata_kunci'); 
            foreach ($getkatakunci->result() as $kata_kunci) {
                
            if($kata_kunci->kata_kunci==$katakunciinbox) {
                $fungsi=$kata_kunci->fungsi;
                
                $this->$fungsi($inbox,$kata_kunci->delimiter);
                
            }
            else {
                $this->kalkun_default();
            }

                 }
             
            
             
        }  

        
    }
    
    function pendaftaran_anggota($inbox,$delimiter) {
       // generate unique random string    
    $this->load->helper('string');
    $unique=random_string('numeric', 6);    
    
    $checkuid=$this->db->get_where('pbk', array('uid' => ".$unique."));
    
    if ($checkuid->num_rows > 0 ) {
        $this->pendaftaran_anggota($inbox,$delimiter);
    }
    else {
        
        //ambil data pendaftaran dari kolom TextDecoded di tabel inbox
        $pecah=  explode($delimiter, strtolower($inbox->TextDecoded));
        
       
        

        $pecahtgl=  str_split($pecah[8],2);
        
        $tgl=$pecahtgl[0];
        $bln=$pecahtgl[1];
        $thn=$pecahtgl[2];
        
        //tanggal untuk format mysql
        $tgl_lahir=$thn.$bln.$tgl;
        
       
        
        
                        
       $data = array( 
            'uid'=> $unique,
            'Name' => ucwords($pecah[1]),
            'Number'=>$inbox->SenderNumber,
            'identitas' => strtoupper($pecah[2]),
             'no_identitas' => $pecah[3],
             'gender'=>  strtoupper($pecah[4]),
            'pendidikan'=> ucwords($pecah[5]),
            'pekerjaan'=> ucwords($pecah[6]),
            'tmp_lahir' => ucwords($pecah[7]),
            'tgl_lahir' => $tgl_lahir,
            'alamat' => ucwords($pecah[9]),
            'kelurahan' => ucwords($pecah[10]),
            'kecamatan' => ucwords($pecah[11]),
            'email' => ucwords($pecah[12]));
          
        

               
        

    if($this->db->insert('pbk', $data)) {
    //ambil data terdaftar
        $registered=$this->db->get_where('pbk', array('uid' => $unique));

        
        foreach ($registered->result() as $anggota)
        {
        $nama=$anggota->Name;
        $nopokok=$anggota->uid."".$anggota->ID;

        $pesanbalasan="Selamat. ".$nama." Anda telah terdaftar di PCNU Bantul, No Pokok anda adalah ".$nopokok."Terima Kasih";
    
        $databalasan=array(
        'DestinationNumber'=> $anggota->Number,
        'TextDecoded'=> $pesanbalasan);
        /*
        $dataphonebook=array(
            'GroupID'=>'-1',
            'Name'=>$anggota->nama,
            'Number'=>$anggota->phone,
            'id_user'=>'1',
            'is_public'=>'false');
        */
        $this->db->insert('outbox', $databalasan); 
        //$this->db->insert('pbk', $dataphonebook); 

        $this->db->delete('inbox', array('ID' => $inbox->ID));

        }

    }
        

    
    
    
        }
    }
    
    function check_number() {
         $number="081804089914";
         
         $pecah=  explode($inbox->TextDecoded);
         $checkuid=$this->db->get_where('pbk', array('uid' => ".$unique."));
        
    }
    
    
    function stopgammu() {
        if ($_POST['submit']) {
              ini_set('max_execution_time', 300);
        echo shell_exec('/etc/init.d/gammu-smsd stop');
        }
        echo "<form method='post' action=".$_SERVER['PHP_SELF'].">";
echo "<input type='submit' name='submit' value='Hentikan Service Gammu'>";
echo "</form>";
    }
    
    function rungammu() {
         if ($_POST['submit']) {
        echo shell_exec('/etc/init.d/gammu-smsd start');
        //passthru('gammu-smsd -c smsdrc -s');
         }
        echo "<form method='post' action=".$_SERVER['PHP_SELF'].">";
echo "<input type='submit' name='submit' value='Jalankan Service Gammu'>";
echo "</form>";
    }
    
    
    function cekpulsa() {
        $this->load->view('form_cek_pulsa');
if ($_POST['submit1']) 
{
    
         $kode= $this->input->post('kode');
         
         
        
        $this->stopgammu();
         ini_set('max_execution_time', 300);
         $hasil = shell_exec('gammu -c /etc/gammu-smsdrc getussd *123*1*1#');
           echo $hasil;
        $this->rungammu();
            $databalasan=array(
  'DestinationNumber'=> '081804089914',
    'TextDecoded'=> $hasil);

       $this->db->insert('outbox', $databalasan); 
}}
        
         
    
         
    
    function gammu() {
        echo "<h1>Gammu Service</h1>";

if ($_POST['submit'])
{
      ini_set('max_execution_time', 300);
   // menjalankan command menghentikan service Gammu
   //shell_exec('/etc/init.d/gammu-smsd stop');
   $output = shell_exec('/etc/init.d/gammu-smsd stop');
echo "<pre>$output</pre>";
}
else
{
// form berisi tombol untuk menghentikan service Gammu
echo "<form method='post' action=".$_SERVER['PHP_SELF'].">";
echo "<input type='submit' name='submit' value='Hentikan Service Gammu'>";
echo "</form>";
}
    }
    
        
        
       
        
    

        
    
    
   
    


function testjquery() {
    $this->load->view('main/anggota/anggota_head');
}    

function cekoperator(){
    echo "cek operator";
     $str = "+628838484848";
     
     //$number=str_split($str);     
    
     //echo $number[0];
     //echo $number[1];

     echo str_ireplace("+62","0",$str);
     //echo str_ireplace("WORLD","Peter","Hello world!");
    
}

function pecahstring(){
    echo "sms multipart <br/>";

    $pesanbalasan="cara pendaftaran : ketik reg*nama*identitas*no identitas*gender(l/p)*pendidikan*pekerjaan*tmp_lhr*tgl_lhr(ddmmyy)*alamat*kelurahan*kecamatan*kabupaten*email kirim ke 089635356147 terima kasih";
    echo "pesan asli : ".$pesanbalasan."<br/>";
    
    echo "panjang pesan yang akan di kirim :".strlen($pesanbalasan)."<br/>";
    
    $jmlSMS = ceil(strlen($pesanbalasan)/160);
    echo "jumlah pecahan sms yang akan di kirim : ".$jumsms."<br/>";
    
    // memecah pesan asli
    $pecah = str_split($pesanbalasan, 153); 
    
    echo "isi sms yang pertama : ".$pecah[0]."<br/>";
    echo "isi sms yang kedua : ".$pecah[1]."<br/>";
    
    // membuat nilai ID untuk di insert di outbox
$query = "SHOW TABLE STATUS LIKE 'outbox'";
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);
$newID = $data['Auto_increment']; 
    
echo "new ID : ".$newID;
$hitpecah = ceil(strlen($pesanbalasan)/153);

for ($i=1; $i<=$jmlSMS; $i++)
{ 
    
// membuat UDH untuk setiap pecahan, sesuai urutannya
$udh = "050003A7".sprintf("%02s", $hitpecah).sprintf("%02s", $i);
 // membaca text setiap pecahan
$msg = $pecah[$i-1]; 
    
	if ($i == 1) {
// jika merupakan pecahan pertama, maka masukkan ke tabel OUTBOX
     $databalasan=array(
        'DestinationNumber'=> '081804089914',
        'UDH'=> $udh,
        'TextDecoded'=> $msg,
         'ID' => $newID,
        'MultiPart'=> 'true',
         'Class' => '0'
             );
        
        $this->db->insert('outbox', $databalasan);
        }
        	else
{
// jika bukan merupakan pecahan pertama, simpan ke tabel OUTBOX_MULTIPART

$databalasan=array(
        'UDH'=> $udh,
        'TextDecoded'=> $msg,
         'ID' => $newID,
        'SequencePosition'=> $i
             );
        
        $this->db->insert('outbox_multipart', $databalasan);

} 
}
    

    

    
    
    

   
}


function checksms(){
    $inbox="Reg*Lilik Budihartanto*KTP*3402090911860001*L*Dosen*Bantul*071186*Cangkring*Sumberagung*Jetis*Bantul*masbudiii@gmail.com";
    
    $pecah=explode('*',$inbox);
    echo $pecah[0];
    echo count($pecah);
    
    
}

function pagination(){
    echo "pagination";

//$this->load->library('table');

//$this->load->library('pagination');

//$this->load->helper('form');

//$this->load->helper('url');

$config['base_url'] = base_url().'index.php/tester/pagination';

$config['total_rows'] = 5;

$config['per_page'] = 2;

$config['num_links'] = 5;

$config['use_page_numbers'] = TRUE;

$this->pagination->initialize($config);

//$data['records']=$this->db->get('pbk', $config['per_page'],$offset);// take record of the table
$header = array('Id', 'Name','Email','Mobile','Address'); // create table header

$this->table->set_heading($header);// apply a heading with a header that was created

$this->load->view('flataccordion',$data); // load content view with data taken from the users table




}

function paging(){
    echo "paging";
}

}


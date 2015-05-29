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
                        $this->load->model('anggota_model');

       }
       
    function paging() {


        
    }
    
    function getid(){
$query = "SHOW TABLE STATUS LIKE 'pbk_groups'";
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);
$newID = $data['Auto_increment']; 

echo $newID;

    }
            function index($offset=0){
    echo "paging";
     $this->load->library('table');

$this->load->library('pagination');


$this->load->helper('url');

//$this->load->database(); //load library database
 	$num_rows=$this->db->count_all('pbk');

$config['base_url'] = base_url().'index.php/tester/index';

$config['total_rows'] = $num_rows;

$config['per_page'] = 5;

$config['num_links'] = 5;

$config['use_page_numbers'] = TRUE;
$config['uri_segment'] = 3;


$this->pagination->initialize($config);
//$data['records']=$this->db->get('pbk', $config['per_page'],$offset);// take record of the table
$data['records']=$this->anggota_model->getanggota('','',$config['per_page'],$offset);// take record of the table

//$header = array('Id', 'Name','Email','Mobile','Address'); // create table header
//$this->table->set_heading($header);// apply a heading with a header that was created
$this->load->view('flataccordion',$data); // load content view with data taken from the users table




  
}

function pecah(){
    $pecah=  explode('*', 'reg*nama*ktp*w68w6882387*l*diploma');

        //hitung jumlah segment data
        $jmlsegment=  count($pecah);
        echo "jumlah pecahan ". $jmlsegment;
        if($jmlsegment < 13) {
         echo $pesanbalasan="Data pendafataran anda belum lengkap";
        }
}
        function outboxdel() {
             $this->db->where('Class','-1');
             $this->db->delete('outbox');
        }
        
        
        function checknomor($nomortelepon) {
        // melakukan pemerikasaan nomor telepon pendaftar apakah sudah terdaftar atau belum
        // jika sudah terdaftar maka pendaftaran ditolak
        
        $Number="+628121558382";
 
        
        $nomortelepon=str_replace('+62','0',$Number);
              
        
              
        $this->db->where('Number',$nomortelepon);
        $jml=$this->db->get('pbk')->num_rows();
        
        if($jml > 3) {
        
            echo "Nomor anda sudah terdaftar sebanyak 3 kali. Gunakan nomor lain untuk pendaftaran";
            
        }
        
          }
          
          
          function quickresponse($tujuan,$isi){
              
        //periksa panjang sms
        $jmlSMS = ceil(strlen($isi)/160);
        
        if($jmlSMS > 1 ) {
        
        //jika isi sms lebih dari 160 karakter
        $pecah = str_split($isi, 153); 
        
$query = "SHOW TABLE STATUS LIKE 'outbox'";
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);
$newID = $data['Auto_increment']; 

$hitpecah = ceil(strlen($isi)/153);

for ($i=1; $i<=$jmlSMS; $i++) { 

    // membuat UDH untuk setiap pecahan, sesuai urutannya
$udh = "050003A7".sprintf("%02s", $hitpecah).sprintf("%02s", $i);
 // membaca text setiap pecahan
$msg = $pecah[$i-1]; 

if ($i == 1) {
    // jika merupakan pecahan pertama, maka masukkan ke tabel OUTBOX
     $databalasan=array(
        'DestinationNumber'=> $tujuan,
        'UDH'=> $udh,
        'TextDecoded'=> $msg,
         'ID' => $newID,
        'MultiPart'=> 'true',
         'Class' => '0'
             );
        

     $this->db->insert('outbox', $databalasan);
    
}
else {
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
        else {
        // jika sms kurang dari 160 karakter
        $databalasan=array(
        'DestinationNumber'=> $tujuan,
        'TextDecoded'=> $isi,
             );
        
        $this->db->insert('outbox', $databalasan);    
            
        }
    }
    
    
    
     
     

   
    
     
     
  
    
    
    
    
            
   
    
        
    }
}
}


    
    
    
    
    
    
    







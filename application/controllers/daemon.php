<?php
/**
 * Kalkun
 * An open source web based SMS Management
 *
 * @package		Kalkun
 * @author		Kalkun Dev Team
 * @license		http://kalkun.sourceforge.net/license.php
 * @link		http://kalkun.sourceforge.net
 */

// ------------------------------------------------------------------------

/**
 * Daemon Class
 *
 * @package		Kalkun
 * @subpackage	Daemon
 * @category	Controllers
 */
class Daemon extends Controller {

	/**
	 * Constructor
	 *
	 * @access	public
	 */				
	function __construct()
	{	
		// Commented this for allow access from other machine
		// if($_SERVER['REMOTE_ADDR']!='127.0.0.1') exit("Access Denied.");	
		parent::__construct();
		$this->load->library('Plugins');
	}

	// --------------------------------------------------------------------
	
	/**
	 * Message routine
	 *
	 * Process the new/unprocessed incoming sms
	 * Called by shell/batch script on Gammu RunOnReceive directive
	 *
	 * @access	public   		 
	 */
        

 	function message_routine()
        {
          
       //echo "periksa kata kunci";
        $getinbox = $this->db->get_where('inbox', array('Processed' => "false",'pending' => "false" ));
        $getkatakunci=$this->db->get('kata_kunci');
        $delimiter='*'; 
        // untuk setiap inbox jalankan 
        foreach ($getinbox->result() as $inbox) {
                
            // untuk setiap kata kunci jalankan    
      //foreach ($getkatakunci->result() as $kunci) {
                 $pecah=  explode($delimiter, $inbox->TextDecoded);
                 $katakunciinbox=  strtoupper($pecah[0]);
                 //$katakunci=  strtoupper($kunci->kata_kunci);
                 //$fungsi=$kunci->fungsi;
                 
                 switch ($katakunciinbox) {
    case "REG":
        $this->pendaftaran_anggota($inbox,$delimiter);
        //$this->$fungsi($inbox,$kunci->delimiter);
        break;
    case "HELP":
        $this->bantuan($inbox);
        //$this->$fungsi($inbox,$kunci->delimiter);
        break;
    case "CHECKSERVER":
        $this->checkserver($inbox,$delimiter);
        //$this->$fungsi($inbox,$kunci->delimiter);
        break;

    default:
        $this->kalkun_default();
        
    }
      }
        }
             
        
	
        
            
        

	// --------------------------------------------------------------------
	
	/**
	 * Set Ownership
	 *
	 * Set ownership for incoming message
	 *
	 * @access	private	 
	 */
    function _set_ownership($tmp_message)
    {
    	$this->load->model(array('Message_model', 'User_model', 'Phonebook_model'));
    	
		// check @username tag
		$users = $this->User_model->getUsers(array('option' => 'all'));
		foreach ($users->result() as $tmp_user)
		{
			$tag = "@".$tmp_user->username;
			$msg_word = array();
			$msg_word = explode(" ", $tmp_message->TextDecoded);
			$check = in_array($tag, $msg_word);
						
			// update ownership
			if($check!==false)
			{
				$this->Message_model->update_owner($tmp_message->ID, $tmp_user->id_user); 
				$msg_user =  $tmp_user->id_user;
				break;
			}
		}
		
		// If inbox_routing_use_phonebook is enabled
		if($this->config->item('inbox_routing_use_phonebook'))
		{
			foreach ($users->result() as $tmp_user)
			{
				$param['id_user'] = $tmp_user->id_user;
				$param['number'] = $tmp_message->SenderNumber;
				$param['option'] = 'bynumber';
				$check = $this->Phonebook_model->get_phonebook($param);
				
				if($check->num_rows() != 0)
				{
					$msg_user[] =  $tmp_user->id_user;
				}
			}
			
			if(isset($msg_user))
			{
				$this->Message_model->update_owner($tmp_message->ID, $msg_user); 
			}
		}
		
		// if no matched username, set owner to Inbox Master
		if($check===false OR !isset($msg_user))
		{
			$this->Message_model->update_owner($tmp_message->ID, $this->config->item('inbox_owner_id'));
			$msg_user =  $this->config->item('inbox_owner_id');
		}
		
		return $msg_user;
    }	

    // --------------------------------------------------------------------

    /**
     * Run user filters
     *
     * @access	public	 
     */		
    function _run_user_filters($msg, $users)
    {
        foreach($users as $user)
        {
            $filters = $this->Kalkun_model->get_filters($user);
            foreach($filters->result() as $filter)
            {
                if(!empty($filter->from) AND ($msg->SenderNumber != $filter->from)) continue;
                if(!empty($filter->has_the_words) AND (strstr($msg->TextDecoded, $filter->has_the_words) === FALSE)) continue;
                $this->Message_model->move_messages(array('type' => 'single', 'folder' => 'inbox', 'id_message' => array($msg->ID), 'id_folder' => $filter->id_folder));
            }
        }
    }

	// --------------------------------------------------------------------
	
	/**
	 * Server alert engine
	 *
	 * Scan host port and send SMS alert if the host is down
	 *
	 * @access	public	 
	 */		
	function server_alert_daemon()
	{
		$this->load->model(array('Kalkun_model', 'Message_model'));
	    $this->load->model('server_alert/server_alert_model', 'plugin_model');
	    
		$tmp_data = $this->plugin_model->get('active');
		foreach($tmp_data->result() as $tmp)
		{
			$fp = fsockopen($tmp->ip_address, $tmp->port_number, $errno, $errstr, 60);
			if(!$fp)
			{
				$data['coding'] = 'default';	
				$data['message'] = $tmp->respond_message."\n\nKalkun Server Alert";
				$data['date'] = date('Y-m-d H:i:s');
				$data['dest'] = $tmp->phone_number;
				$data['delivery_report'] = 'default';
				$data['class'] = '1';
				$data['uid'] = '1';
				$this->Message_model->send_messages($data);
				$this->plugin_model->change_state($tmp->id_server_alert, 'false');
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
        $pecah=  explode('*', $inbox->TextDecoded);

        //hitung jumlah segment data
        $jmlsegment=  count($pecah);
        
        if($jmlsegment < 13) {
         $pesanbalasan="Data pendaftaran anda belum lengkap";
         
         $this->quickresponse($inbox->SenderNumber,$pesanbalasan);
         
         
         //jalankan fungsi update data pada tabel inbox
         
        


         //update tabel inbox
        $updateinbox=array(
 			'Processed'=>'true',       
            'pending'=>'true');
        
        $this->db->where('ID',$inbox->ID);
        $this->db->update('inbox',$updateinbox);
        }
        
        elseif($this->checknomor($inbox->SenderNumber) >= 3 ) {
        	$pesanbalasan="Nomor anda sudah terdaftar sebanyak 3 kali. Gunakan nomor lain untuk pendaftaran";
            $this->quickresponse($inbox->SenderNumber,$pesanbalasan);
            
            $updateinbox=array(
 			'Processed'=>'true');
        
        $this->db->where('ID',$inbox->ID);
        $this->db->update('inbox',$updateinbox);
			
		}
		elseif($this->checkktp($pecah[3]) > 0) {
			$pesanbalasan="No KTP anda sudah terdaftar di dalam sistem kami";
			
            $this->quickresponse($inbox->SenderNumber,$pesanbalasan);
            
             $updateinbox=array(
 			'Processed'=>'true');
        
        $this->db->where('ID',$inbox->ID);
        $this->db->update('inbox',$updateinbox);
		}

        else {
        	
        	

        $pecahtgl=  str_split($pecah[8],2);
        
        $tgl=$pecahtgl[0];
        $bln=$pecahtgl[1];
        $thn=$pecahtgl[2];
        
        //tanggal untuk format mysql
        $tgl_lahir=$thn.$bln.$tgl;
        
        
               
        
        $data = array( 
            
            'uid'=> $unique,
            'Name' => ucwords($pecah[1]),
            'Number'=>  str_replace('+62','0',$inbox->SenderNumber),
            'identitas' => strtoupper($pecah[2]),
            'no_identitas' => $pecah[3],
            'gender'=>  strtoupper($pecah[4]),
            'pendidikan'=>ucwords($pecah[5]),
            'pekerjaan'=>ucwords($pecah[6]),
            'tmp_lahir' => ucwords($pecah[7]),
            'tgl_lahir' => $tgl_lahir,
            'alamat' => ucwords($pecah[9]),
            'namakelurahan' => ucwords($pecah[10]),
            'namakecamatan' => ucwords($pecah[11]),
            'kabupaten' => ucwords($pecah[12]),
            'email' => $pecah[13]);
          
        

    if($this->db->insert('pbk', $data)) {
    //ambil data terdaftar
        $registered=$this->db->get_where('pbk', array('uid' => $unique));

        
        foreach ($registered->result() as $anggota)
        {
        $nama=$anggota->Name;
        $nopokok=$anggota->uid."".$anggota->ID;

    
        // data untuk tabel user_group
        // akan ditampilkan sebagai grup pada daftar kontak
    
        $grupkontak=array(
          
            'id_pbk'=>$anggota->ID,
            'id_pbk_groups'=>'2',
            'id_user'=>'1');
        
        $this->db->insert('user_group', $grupkontak); 
        
        $pesanbalasan="Terimakasih. Anda telah terdaftar di PCNU Bantul, No Pokok anda adalah ".$nopokok." Nama ".$nama;
        
        $this->quickresponse($anggota->Number,$pesanbalasan);
    
        //$databalasan=array(
        //'DestinationNumber'=> $anggota->Number,
        //'TextDecoded'=> $pesanbalasan);
        
        //$this->db->insert('outbox', $databalasan); 
        //$this->db->insert('pbk', $dataphonebook); 

        $this->db->delete('inbox', array('ID' => $inbox->ID));
        }

        }

    }
        

    
    
    }
        }
    
    
       
    function bantuan($inbox) {
        $pesanbalasan="cara pendaftaran : ketik reg*nama*identitas*no identitas*gender(l/p)*pendidikan*pekerjaan*tmp_lhr*tgl_lhr(ddmmyy)*alamat*kelurahan*kecamatan*kabupaten*email kirim ke 0822 4281 7000.";
        
        $this->quickresponse($inbox->SenderNumber,$pesanbalasan);
        
$update= array(
        'Processed' => 'true'
);

$this->db->where('ID', $inbox->ID);
$this->db->update('inbox', $update);  
        

    }
    
    
    
    function kalkun_default() {
        $this->load->model(array('Kalkun_model', 'Message_model', 'Spam_model'));
		
		// get unProcessed message
		$message = $this->Message_model->get_messages(array('processed' => FALSE));

		foreach($message->result() as $tmp_message)
		{			
			// check for spam
            if($this->Spam_model->apply_spam_filter($tmp_message->ID,$tmp_message->TextDecoded))
            {
                continue; ////is spam do not process later part
            }
            
			// hook for incoming message (before ownership)
			$status = do_action("message.incoming.before", $tmp_message);

            // message deleted, do not process later part
            if(isset($status) AND $status=='break')
            {
            	continue;
            }

            // set message's ownership
			$msg_user = $this->_set_ownership($tmp_message);
			$this->Kalkun_model->add_sms_used($msg_user,'in');
			
            // hook for incoming message (after ownership)
            $tmp_message->msg_user = $msg_user;
			$status = do_action("message.incoming.after", $tmp_message);
			
			// message deleted, do not process later part
			if(isset($status) AND $status=='break')
			{
				continue;
			}

            // run user filters
            $this->_run_user_filters($tmp_message, $msg_user);
			
			// update Processed
			$id_message[0] = $tmp_message->ID;
			$multipart = array('type' => 'inbox', 'option' => 'check', 'id_message' => $id_message[0]);
			$tmp_check = $this->Message_model->get_multipart($multipart);
			
			if($tmp_check->row('UDH')!='')
			{
				$multipart = array('option' => 'all', 'udh' => substr($tmp_check->row('UDH'),0,8));	
				$multipart['phone_number'] = $tmp_check->row('SenderNumber');
				$multipart['type'] = 'inbox';				
				foreach($this->Message_model->get_multipart($multipart)->result() as $part):
				$id_message[] = $part->ID;
				endforeach;	
			}
			$this->Message_model->update_processed($id_message);
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

//mysql_query($kirimpesan);




    }
        }
        else {
        // jika sms kurang dari 160 karakter
        $databalasan=array(
        'DestinationNumber'=> $tujuan,
        'TextDecoded'=> $isi
             );
        
        $this->db->insert('outbox', $databalasan);    
            
        }
    }
    
    function checknomor($nomortelepon) {
        // melakukan pemerikasaan nomor telepon pendaftar apakah sudah terdaftar atau belum
        // jika sudah terdaftar maka pendaftaran ditolak
       
        $newnomortelepon=str_replace('+62','0',$nomortelepon);
              
        
              
        $this->db->where('Number',$newnomortelepon);
        $jml=$this->db->get('pbk')->num_rows();
        
        return $jml;
        
          }
    
    function checkktp($noktp) {
        // melakukan pemerikasaan nomor ktp pendaftar apakah sudah terdaftar atau belum
        // jika sudah terdaftar maka pendaftaran ditolak
       
        //$newnomortelepon=str_replace('+62','0',$nomortelepon);
              
        
              
        $this->db->where('no_identitas',$noktp);
        $jml=$this->db->get('pbk')->num_rows();
        
        return $jml;
        
          }
          
    function checkserver($inbox,$delimiter){
        

        
        //$phonenumber=$inbox->SenderNumber;
     $phonenumber=$inbox->SenderNumber;
     
     $newphonenumber=str_replace('+62','0',$phonenumber);
     
     $this->db->where('phone_number',$newphonenumber);
     $admin=$this->db->get('user')->row();
     
     if($admin) {
         $jmlanggota=$this->db->get('pbk')->num_rows();
         $pesanbalasan="Hai ".$admin->username.". Server dalam keadaan baik. Jumlah Anggota terdaftar saat ini ". $jmlanggota;
         $tujuan=$newphonenumber;
        
         $this->quickresponse($tujuan,$pesanbalasan);

         $updateinbox=array(
         'Processed' => 'true');
         $this->db->where('ID',$inbox->ID);
         $this->db->update('inbox', $updateinbox);
     }
     else {
         $pesanbalasan="Anda tidak berhak melakukan pengecekan server";
         $tujuan=$newphonenumber;
         $this->quickresponse($tujuan,$pesanbalasan);
         $updateinbox=array(
         'Processed' => 'true');
         $this->db->where('ID',$inbox->ID);
         $this->db->update('inbox', $updateinbox);

     } 
        
    }        
    
    
    
    

    
    

}

/* End of file daemon.php */
/* Location: ./application/controllers/daemon.php */ 

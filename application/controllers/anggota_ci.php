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
class Anggota_ci extends Controller {
    
     public function __construct()
       {
            parent::__construct();
            // Your own constructor code
            
            $this->load->helper('form');
            $this->load->helper('string');
            $this->load->library('session');
            $this->load->library('pagination');
            $this->load->model('anggota_model');
            $this->load->library('table');
            $this->load->helper('url');

            
            

            
           
       
            
            if($this->session->userdata('username',TRUE));
             else redirect('login');
            
       
       }
    
            
    function index() {
     echo "anggota_ci";
    }
    
    function edit_inbox($id_inbox) {
          
         $getinbox = $this->db->get_where('inbox', array(
              'ID' => $id_inbox));
          
          $inbox=$getinbox->row();
          $data['id']=$inbox->ID;
          $data['sms']=$inbox->TextDecoded;
          
          $this->load->view('main/anggota/form_edit_inbox',$data);
    }
    
    function update_inbox(){
               
        $data=array(
            'TextDecoded'=>$this->input->post('isisms'),
            'Processed'=>'false',
            'Readed'=>'false'     
        );
        
        $this->db->where('ID',$this->input->post('id_inbox'));
        $this->db->update('inbox',$data);
        
          redirect('anggota/pending');
        
    }
    
    function hapus_inbox($id_inbox) {
         $this->db->delete('inbox', array('ID' => $id_inbox));
         redirect('anggota/pending');
        
    }
    
    function kirim_pesan($id_inbox) {
     $getinbox = $this->db->get_where('inbox', array(
              'ID' => $id_inbox));
     
     $data['parameter']=$getinbox->row();
     $this->load->view('main/anggota/form_sms',$data);
     
     redirect('anggota');
    }
    
    function proses_sms() {
        $data=array(
            'DestinationNumber' => $this->input->post('tujuan'),
            'TextDecoded' => $this->input->post('isisms'),
        );
        
        $this->db->insert('outbox',$data);
        
        redirect('anggota/pending');
        
    }
    
    function buat_pendaftaran($id_inbox){
     $getinbox = $this->db->get_where('inbox', array(
              'ID' => $id_inbox));
     
     $data['kecamatan']=$this->db->get('data_kecamatan')->result();
     $data['kelurahan']=$this->db->get('data_kelurahan')->result();
     $data['parameter']=$getinbox->row();

     
     $this->load->view('main/anggota/form_pendaftaran',$data);
    }
    
    function proses_pendaftaran() {
        echo "proses pendafataran";
        $this->load->helper('string');
    $unique=random_string('numeric', 6);    
    
    $checkuid=$this->db->get_where('pbk', array('uid' => ".$unique."));
    
    if ($checkuid->num_rows > 0 ) {
        $this->pendaftaran_anggota();
    }
    else {
        
        $pecahtgl=  str_split($this->input->post('tgl_lahir'));
        
        $tgl=$pecahtgl[0];
        $bln=$pecahtgl[1];
        $thn=$pecahtgl[2];
        
        //tanggal untuk format mysql
        $tgl_lahir=$thn.$bln.$tgl;
        
        $data = array( 
            
            'uid'=> $unique,
            'Name' => ucwords($this->input->post('nama')),
            'Number'=>  str_replace('+62','0',$this->input->post('telp')),
            'identitas' => strtoupper($this->input->post('identitas')),
            'no_identitas' => $this->input->post('no_identitas'),
            'gender'=>  strtoupper($this->input->post('gender')),
            'pendidikan'=>ucwords($this->input->post('pendidikan')),
            'pekerjaan'=>ucwords($this->input->post('pekerjaan')),
            'tmp_lahir' => ucwords($this->input->post('tmp_lahir')),
            'tgl_lahir' => $tgl_lahir,
            'alamat' => ucwords($this->input->post('alamat')),
            'kabupaten' => ucwords('Bantul'),
            'id_kec' => $this->input->post('kecamatan') ,
            'id_kel'=> $this->input->post('kelurahan'),
            'email' => $this->input->post('email')
                );

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
        
        $pesanbalasan="Terimakasih. ".$nama." Anda telah terdaftar di PCNU Bantul, No Pokok anda adalah ".$nopokok."";
    
        $databalasan=array(
        'DestinationNumber'=> $anggota->Number,
        'TextDecoded'=> $pesanbalasan);
        
        $this->db->insert('outbox', $databalasan); 
        //$this->db->insert('pbk', $dataphonebook); 

        $this->db->delete('inbox', array('ID' => $this->input->post('id_inbox')));
        
        redirect('anggota');

        }

    }
             
             
             
    }
    
    
        
    
    
    
  
   
   

   
   
   }
}

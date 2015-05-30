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
class Search extends Controller {
    
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
        $data['title'] = "Pencarian Anggota PCNU Bantul";
       
       $data['kecamatan']=$this->anggota_model->getkecamatan();
       $data['kelurahan']=$this->anggota_model->getkelurahan();
       $data['jml_kel']=$this->anggota_model->kelnumrows();
       
         $keywords= $this->input->get('keywords');    
         
         $nama=$this->input->get('nama');
         $alamat=$this->input->get('alamat');
         $pendidikan=$this->input->get('pendidikan');
         $pekerjaan=$this->input->get('pekerjaan');
         $kelurahan=$this->input->get('kelurahan');
         $kecamatan=$this->input->get('kecamatan');
         $telepon=$this->input->get('telepon');
         $email=$this->input->get('email');
         
         
       
         

         
         
         
         
         
         $id_kec=$this->input->get('tampilkecamatan');    
         $id_kel=$this->input->get('tampilkelurahan');    
         
         
        $data['anggotas']=$this->anggota_model->search($keywords,$nama,$alamat,$pendidikan,$pekerjaan,$kelurahan,$kecamatan,$telepon,$email,$id_kel,$id_kec);
        $data['count']=count($data['anggotas']);
      
        
     $this->load->view('main/anggota/anggota_head',$data);
        $this->load->view('main/anggota/anggota_top_menu',$data);
        
        $this->load->view('main/anggota/anggota_search_container',$data);
        $this->load->view('main/anggota/anggota_menu_left',$data);
        
        
        
	$this->load->view('main/anggota/anggota', $data);
        $this->load->view('main/anggota/anggota_footer', $data);
     
     
    }
    
  
   }

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
class Tools extends Controller {
    
     public function __construct()
       {
            parent::__construct();
            // Your own constructor code
            
            $this->load->helper('form');
            $this->load->helper('string');
            $this->load->library('session');
            $this->load->library('pagination');
            
            if($this->session->userdata('username',TRUE));
             else redirect('login');
            
       
       }
            
    function index() {
        echo "tools";
       
    
        
        
	$data['title'] = "Data Anggota PCNU Bantul";
	$data['heading'] = "Data Anggota PCNU Bantul";


        
 
       
       
        
        
        
        $this->load->view('main/anggota/anggota_head',$data);
        $this->load->view('main/anggota/anggota_top_menu',$data);
        
        $this->load->view('main/anggota/anggota_search_container',$data);
        $this->load->view('main/anggota/anggota_menu_left',$data);
        
        
        
        $this->load->view('main/anggota/anggota_footer', $data);
        
        
     
    }

        
       
        
}
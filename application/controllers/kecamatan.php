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
class Kecamatan extends Controller {
    
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
           
       }
       
       function edit_kecamatan($id_kec) {
           
           $data['kecamatan']=$this->db->get_where('data_kecamatan',array('id_kec' => $id_kec))->row();
           

           $this->load->view('main/kecamatan/form_edit_data_kecamatan',$data);
       }
       function update_data_kecamatan(){
           $update_kecamatan=array(
               'kecamatan' => $this->input->post('namakecamatan')
           );

           $this->db->where('id_kec',$this->input->post('idkecamatan'));
           $this->db->update('data_kecamatan',$update_kecamatan);
           redirect('anggota/kecamatan/'.$this->input->post('idkecamatan'));
           
           
       }
       
       
       function edit_kelurahan($id_kel) {
           
           $data['kelurahan']=$this->db->get_where('data_kelurahan',array('id_kel' => $id_kel))->row();
           

           $this->load->view('main/kecamatan/form_edit_data_kelurahan',$data);
       }
       function update_data_kelurahan() {
           $update_kelurahan=array(
               'kelurahan' => $this->input->post('namakelurahan')
           );

           $this->db->where('id_kel',$this->input->post('idkelurahan'));
           $this->db->update('data_kelurahan',$update_kelurahan);
           redirect('anggota/kecamatan/'.$this->input->post('idkecamatan'));
           
       }
       
       
}
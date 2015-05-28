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
class Anggota extends Controller {
    
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
    function perkecamatan($id_kec) {
       $data['kecamatan']=$this->anggota_model->getkecamatan();
       $data['kelurahan']=$this->anggota_model->getkelurahan();
       $data['jml_kel']=$this->anggota_model->kelnumrows();
       
       $data['title'] = "Data Anggota PCNU Bantul";
	$data['heading'] = "Data Anggota PCNU Bantul";
       
       
         $data['anggotas']=$this->anggota_model->getanggota($id_kec,'');
       $data['count']=count($data['anggotas']);
       
       
        $this->load->view('main/anggota/anggota_head',$data);
        $this->load->view('main/anggota/anggota_top_menu');
         $this->load->view('main/anggota/anggota_search_container',$data);
        $this->load->view('main/anggota/anggota_menu_left',$data);
        $this->load->view('main/anggota/anggota');
        $this->load->view('main/anggota/anggota_footer');
        
        
        
    }   
    
    function perkelurahan($id_kel) {
     $data['kecamatan']=$this->anggota_model->getkecamatan();
       $data['kelurahan']=$this->anggota_model->getkelurahan();
       $data['jml_kel']=$this->anggota_model->kelnumrows();
       
        $data['anggotas']=$this->anggota_model->getanggota('',$id_kel);
        $data['count']=count($data['anggotas']);
       
        $data['title'] = "Data Anggota PCNU Bantul";
	$data['heading'] = "Data Anggota PCNU Bantul";
        
        
        $this->load->view('main/anggota/anggota_head',$data);
        $this->load->view('main/anggota/anggota_top_menu');
         $this->load->view('main/anggota/anggota_search_container',$data);
        $this->load->view('main/anggota/anggota_menu_left',$data);
        $this->load->view('main/anggota/anggota');
        $this->load->view('main/anggota/anggota_footer');
            
    }
            
    function index($offset=0) {
        
        //ambil data anggota dari database 
        //$data['anggotas']=$this->anggota_model->getanggota();

        //hitung jumlah anggota
   
        
       $data['kecamatan']=$this->anggota_model->getkecamatan();
       $data['kelurahan']=$this->anggota_model->getkelurahan();
       $data['jml_kel']=$this->anggota_model->kelnumrows();
       
        
	$data['title'] = "Data Anggota PCNU Bantul";
	$data['heading'] = "Data Anggota PCNU Bantul";
        
        
  
       	$num_rows=$this->db->count_all('pbk');

  $config['base_url'] = base_url().'index.php/anggota/index';

$config['total_rows'] = $num_rows;

//$config['per_page'] = 20;

//$config['num_links'] = $num_rows;
$config['uri_segment'] = 3;
$config['use_page_numbers'] = TRUE;

//$this->pagination->initialize($config);

 $data['anggotas']=$this->anggota_model->getanggota('','',$config['per_page'],$offset);
     $data['count']=$num_rows;
  
 
        
        $this->load->view('main/anggota/anggota_head',$data);
        $this->load->view('main/anggota/anggota_top_menu');
        
        $this->load->view('main/anggota/anggota_search_container');
        $this->load->view('main/anggota/anggota_menu_left',$data);
        
        
        
	$this->load->view('main/anggota/anggota', $data);
        $this->load->view('main/anggota/anggota_footer');
       
     
    }

    function pending(){
        $this->db->select('*');
        $this->db->from('inbox');
        $this->db->where('pending','true');
        $this->db->like('TextDecoded', 'reg');
        $getinbox=$this->db->get();
        
        //$getinbox = $this->db->get_where('inbox', array('Processed' => "false"));

        $data['pendings']=$getinbox->result();
        $data['title'] = "Data Anggota PCNU Bantul";
	$data['heading'] = "Data Anggota PCNU Bantul";
        
        
        $this->load->view('main/anggota/anggota_head',$data);
        $this->load->view('main/anggota/anggota_top_menu');
        $this->load->view('main/anggota/anggota_search');
        $this->load->view('main/anggota/anggota_pending',$data);
        $this->load->view('main/anggota/anggota_footer');
        
        
       
        
        
    }    
       
        
    function detail($ID) {
        
        
        
        $registered=$this->db->get_where('pbk',array('ID'=>$ID))->row();
            
        $data[anggota]=$registered;
       
        
        $this->load->view('main/anggota/anggota_head');
        $this->load->view('main/anggota/anggota_top_menu');
        $this->load->view('main/anggota/anggota_menu');
        $this->load->view('main/anggota/anggota_detail',$data);
        $this->load->view('main/anggota/anggota_footer');
        
        
        
        
                
        
        
    }

        
    
    
    function delete($id) {
        

        $this->db->delete('pbk', array('ID' => $id));
        redirect('/anggota/');
        
        
        
        
    }
    


    
    
    
    function search() {
        $data['title'] = "Pencarian Anggota PCNU Bantul";
       
       $getkecamatan=$this->db->get('data_kecamatan');
       $getkelurahan=$this->db->get('data_kelurahan');
       $data[kecamatan]=$getkecamatan->result();
       $data[kelurahan]=$getkelurahan->result();
       
       
         $keywords= $this->input->get('keywords');    
         
         $id_kec=$this->input->get('tampilkecamatan');    
         $id_kel=$this->input->get('tampilkelurahan');    
         
         
         //cari nama saja   
         if($this->input->get('searchwhat')==1){  
        $this->db->select('*');
        $this->db->from('pbk');
        
        
        $this->db->select('data_kecamatan.id_kec','data_kecamatan.kecamatan');
        $this->db->select('data_kelurahan.id_kel','data_kelurahan.kelurahan');
        
        if($id_kec){
        $this->db->where('pbk.id_kec', $id_kec);
        }
        $this->db->join('data_kecamatan', 'data_kecamatan.id_kec = pbk.id_kec ','left');
        $this->db->join('data_kelurahan', 'data_kelurahan.id_kel = pbk.id_kel ','left');
        
        
        $this->db->where('data_kecamatan.id_kec = pbk.id_kec');
        $this->db->where('data_kelurahan.id_kel = pbk.id_kel');
         

        $this->db->order_by("Name", "asc");
        if($keywords){
        $this->db->like('Name', $keywords);
        }
        $data[anggotas]=$this->db->get()->result();
         
         
         }
         
         //cari alamat saja
         elseif ($this->input->get('searchwhat')==2) {
          $this->db->select('*');
        $this->db->from('pbk');
        if($id_kec){
        $this->db->where('pbk.id_kec', $id_kec);
        }
        
        $this->db->join('data_kecamatan', 'data_kecamatan.id_kec = pbk.id_kec ','left');
         
        $this->db->where('data_kecamatan.id_kec = pbk.id_kec');
         

        $this->db->order_by("alamat", "asc");
        if($keywords){
        $this->db->like('alamat', $keywords);
        }
        $data[anggotas]=$this->db->get()->result();
        
         }
         //cari kelurahan saja
         elseif ($this->input->get('searchwhat')==3) {
          $this->db->select('*');
        $this->db->from('pbk');
        if($id_kec){
        $this->db->where('pbk.id_kec', $id_kec);
        }
        
        $this->db->join('data_kecamatan', 'data_kecamatan.id_kec = pbk.id_kec ','left');
         $this->db->where('data_kecamatan.id_kec = pbk.id_kec');

        $this->db->order_by("namakelurahan", "asc");
        if($keywords){
        $this->db->like('namakelurahan', $keywords);
        }
        $data[anggotas]=$this->db->get()->result();
             }
         //cari kecamatan saja
         elseif ($this->input->get('searchwhat')==4) {
                   $this->db->select('*');
        $this->db->from('pbk');
        if($id_kec){
        $this->db->where('pbk.id_kec', $id_kec);
        }
        
        $this->db->join('data_kecamatan', 'data_kecamatan.id_kec = pbk.id_kec ','left');
         $this->db->where('data_kecamatan.id_kec = pbk.id_kec');

        $this->db->order_by("namakecamatan", "asc");
        if($keywords){
        $this->db->like('namakecamatan', $keywords);
        }
        $data[anggotas]=$this->db->get()->result();
             }
         //cari nomor telepon saja
         elseif ($this->input->get('searchwhat')==5) {
                   $this->db->select('*');
        $this->db->from('pbk');
        if($id_kec){
        $this->db->where('pbk.id_kec', $id_kec);
        }
        $this->db->join('data_kecamatan', 'data_kecamatan.id_kec = pbk.id_kec ','left');
         $this->db->where('data_kecamatan.id_kec = pbk.id_kec');

        $this->db->order_by("Number", "asc");
        if($keywords){
        $this->db->like('number', $keywords);
        }
         
        $data[anggotas]=$this->db->get()->result();
        
         }
         //cari semua
         else {
        
        $where=('Name LIKE "%'.$keywords.'%" OR alamat LIKE "%'.$keywords.'%" OR namakelurahan LIKE "%'.$keywords.'%" OR namakecamatan LIKE "%'.$keywords.'%" OR Number LIKE "+62%'.$keywords.'%" OR Number LIKE "%'.$keywords.'%"');
        $this->db->select('*');
        $this->db->from('pbk');
        if($id_kec){
$this->db->where('pbk.id_kec', $id_kec);
        }
        if($keywords){
        $this->db->where($where);
        }
        
        $this->db->join('data_kecamatan', 'data_kecamatan.id_kec = pbk.id_kec ','left');
        $this->db->where('data_kecamatan.id_kec = pbk.id_kec');
        

        $this->db->order_by("Name", "asc");
        

         
        $data[anggotas]=$this->db->get()->result();
        //$data[anggotas]=$this->db->query('SELECT * FROM pbk WHERE Name LIKE "%'.$keywords.'%" OR alamat LIKE "%'.$keywords.'%" OR namakelurahan LIKE "%'.$keywords.'%" OR namakecamatan LIKE "%'.$keywords.'%" OR Number LIKE "+62%'.$keywords.'%" OR Number LIKE "%'.$keywords.'%" ')->result();

         }
      
        
     $this->load->view('main/anggota/anggota_head',$data);
        $this->load->view('main/anggota/anggota_top_menu',$data);
        
        $this->load->view('main/anggota/anggota_search_container',$data);
        $this->load->view('main/anggota/anggota_menu',$data);
        
        
        
	$this->load->view('main/anggota/anggota', $data);
        $this->load->view('main/anggota/anggota_footer', $data);
     
     
    }
    
    function check() {
        echo "check status";
        //echo "gammu getussd *123*1*1#";
        $output = shell_exec('gammu getussd *123*1*1#');
//echo "<pre>$output</pre>";



//$output = shell_exec('ls -lart');
//$output = exec('gammu --identify');

echo "<pre>$output</pre>";



    }
   function kecamatan($id_kec) {
       
       $this->db->where('id_kec !=', '99');
       $getkecamatan=$this->db->get_where('data_kecamatan');
       $data[kecamatan]=$getkecamatan->result();
       $data[jml_kec]=$getkecamatan->num_rows();
       
       
       if($id_kec) {
           
        $this->db->select('*');
        $this->db->join('data_kecamatan', 'data_kelurahan.id_kec = data_kecamatan.id_kec');
        $this->db->where('data_kelurahan.id_kec', $id_kec);
        $query=$this->db->get('data_kelurahan');
       
       $data[kelurahan]=$query->result();
       
       $this->db->where('id_kec =', $id_kec);
       $data[nama_kec]=$this->db->get_where('data_kecamatan')->row();
       $data[id_kec]=$id_kec;
       $data[jml_kel]=$query->num_rows();

       }
       $data[title]="Data Kecamatan dan Kelurahan";
       $this->load->view('main/anggota/anggota_head',$data);
       $this->load->view('main/anggota/anggota_top_menu',$data);
       //$this->load->view('main/anggota/anggota_menu',$data);
       
       
       
       $this->load->view('main/anggota/kecamatan',$data);
       $this->load->view('main/anggota/anggota_footer',$data);
       
       
   }
   
   function add_kecamatan() {
       $unique=random_string('numeric', 4);
               
       $kecamatan= $this->input->post('kecamatan'); 
       
       $checkuid=$this->db->get_where('pbk_groups', array('uid' => ".$unique."));
       if ($checkuid->num_rows > 0 ) {
           $this->add_kecamatan();
       }
       else
           
      
       $data_groups=array(
              'uid' => $unique,
              'Name' => ucwords($kecamatan),
              'id_user' => '1');
       
       if($this->db->insert('pbk_groups',$data_groups)) {
       
       $this->db->where('uid =', $unique);
       $pbk_groups=$this->db->get('pbk_groups')->row();
       
      
       
       $data_kecamatan=array(
           'kecamatan'=>ucwords($kecamatan),
           'id_kec'=>$pbk_groups->ID);
               
            $this->db->insert('data_kecamatan',$data_kecamatan);
            redirect('/anggota/kecamatan');
       }
   }
    
   function delete_kecamatan($id_kec) {
       $this->db->delete('data_kelurahan', array('id_kec' => $id_kec));
       $this->db->delete('pbk_groups', array('ID' => $id_kec));
       
         
       $this->db->delete('data_kecamatan', array('id_kec' => $id_kec));
        
       redirect('/anggota/kecamatan');
   }
   
   
   function add_kelurahan() {
       $query = "SHOW TABLE STATUS LIKE 'pbk_groups'";
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);
$newID = $data['Auto_increment']; 

       //$unique=random_string('numeric', 4);
       
       $checkuid=$this->db->get_where('data_kelurahan', array('id_kel' => ".$newID."));
       if ($checkuid->num_rows > 0 ) {
           $this->add_kelurahan();
       }
       else {
       $kelurahan= $this->input->post('kelurahan');
       $id_kec= $this->input->post('id_kec');
       
       $data_groups=array(
              //'uid' => $unique,
              'Name' => ucwords($kelurahan));
       
       if($this->db->insert('pbk_groups',$data_groups)) {
        
       //$this->db->where('uid =', $unique);
       //$pbk_groups=$this->db->get('pbk_groups')->row();
       
        
       
       $data=array(
           'id_kec'=> $id_kec,
           'id_kel'=>$newID,
           'kelurahan'=> ucwords($kelurahan));
       
       $this->db->insert('data_kelurahan',$data);
       redirect('/anggota/kecamatan/'.$id_kec);
       }
       
       
       }
   }
   
   function delete_kelurahan($id_kel,$id_kec) {
       $this->db->delete('data_kelurahan', array('id_kel' => $id_kel));
       redirect('/anggota/kecamatan/'.$id_kec);
   }
   
   function set_kecamatan() {
       echo "set kecamatan";
       echo $this->input->post('listkecamatan');
   }

   function edit_kec($id_anggota) {
      
       $data[id_anggota]=$id_anggota;
       //$this->db->where('id_kec !=','99');
       $getkecamatan=$this->db->get('data_kecamatan');
       
       $data[kecamatan]=$getkecamatan->result();
       $this->load->view('main/anggota/form_edit_kec',$data);
   }
   
   function update_kec() {
       $data = array(
        'id_kec' => $this->input->post('kecamatan')
);
$this->db->where('ID', $this->input->post('idanggota'));
$this->db->update('pbk', $data);

       $data_user_group = array(
        'id_pbk_groups' => $this->input->post('kecamatan')
);
$this->db->where('id_pbk', $this->input->post('idanggota'));
$this->db->update('user_group', $data_user_group);

       
redirect('/anggota');
   }
   
   function edit_kel() {
      
       $data[id_anggota]=$this->uri->segment(3);
       $data[id_kec]=$this->uri->segment(4);
       
       
       
       $this->db->where('id_kec = ',$data[id_kec]);
       $getkelurahan=$this->db->get('data_kelurahan');
       
       $data[kelurahan]=$getkelurahan->result();
       $this->load->view('main/anggota/form_edit_kel',$data);
   }
   
   function update_kel() {


       $this->db->select('*');
       $this->db->from('user_group');
       $this->db->where('id_pbk',$this->input->post('idanggota'));
       $this->db->where('id_pbk_groups',$this->input->post('kelurahan'));
       $query=$this->db->get();
       
       $num_rows=$query->num_rows();
       
       if($num_rows > 0 ){
           //update tabel user_group
           $data=$query->row();
          
           
           $data_user_group= array(
        'id_pbk_groups' => $this->input->post('kelurahan'),
        'id_pbk' => $data->id_pbk,
         'id_user' => 1);
           
            //$this->db->where('id_pbk', $data->id_pbk);
            $this->db->where('id_group', $data->id_group);
            $this->db->update('user_group', $data_user_group);
            
            
            $data = array(
        'id_kel' => $this->input->post('kelurahan')
);
            $this->db->where('ID', $this->input->post('idanggota'));
            $this->db->update('pbk', $data);
            
              redirect('/anggota');
           
       }
       else {
           //masukkan data di tabel user_group
            $data = array(
        'id_kel' => $this->input->post('kelurahan')
);
           $this->db->where('ID', $this->input->post('idanggota'));
           $this->db->update('pbk', $data);
           
            $data_user_group= array(
        'id_pbk_groups' => $this->input->post('kelurahan'),
        'id_pbk' => $this->input->post('idanggota'),
         'id_user' => 1         
                
);
            $this->db->insert('user_group',$data_user_group);
           
           redirect('/anggota');
       }
       
       
       
       


       }
   
          function export()
{
    $this->load->plugin('to_excel');

    
   $this->db->select('Name,Number,gender,identitas,no_identitas,pendidikan,pekerjaan,alamat,tmp_lahir,tgl_lahir');
        $this->db->from('pbk');
        $this->db->select('data_kelurahan.kelurahan');
        $this->db->select('data_kecamatan.kecamatan');
       
        
        
        $this->db->join('data_kecamatan', 'data_kecamatan.id_kec = pbk.id_kec ','left');
        $this->db->join('data_kelurahan', 'data_kelurahan.id_kel = pbk.id_kel ','left');
        
        
        $this->db->where('data_kecamatan.id_kec = pbk.id_kec');
        $this->db->where('data_kelurahan.id_kel = pbk.id_kel');
        
       
        $query=$this->db->get();
        
    $nama = "data_anggota_pcnu_bantul";
    to_excel($query, $nama);
}
   

    
   }

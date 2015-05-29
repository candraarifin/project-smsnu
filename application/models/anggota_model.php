<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Anggota_model extends Model {

        public function __construct()
        {
                parent::__construct();
        }
        
        
        function getkecamatan() {
              $this->db->where('id_kec !=', '99');
              $getkecamatan= $this->db->get('data_kecamatan');
              return $getkecamatan->result();
        }
        function getkelurahan() {
              $getkelurahan= $this->db->get('data_kelurahan');
              return $getkelurahan->result();
        }
        function kelnumrows() {
              $getkelurahan= $this->db->get('data_kelurahan');
              return $getkelurahan->num_rows();
        }
        
        function getanggota($id_kec,$id_kel,$limit,$offset){
        $this->db->select('*');
        $this->db->from('pbk');
        $this->db->select('data_kecamatan.id_kec','data_kecamatan.kecamatan');
        $this->db->select('data_kelurahan.id_kel','data_kelurahan.kelurahan');
       
        
        
        $this->db->join('data_kecamatan', 'data_kecamatan.id_kec = pbk.id_kec ','left');
        $this->db->join('data_kelurahan', 'data_kelurahan.id_kel = pbk.id_kel ','left');
        
        
        $this->db->where('data_kecamatan.id_kec = pbk.id_kec');
        $this->db->where('data_kelurahan.id_kel = pbk.id_kel');
        if($id_kec){
        $this->db->where('pbk.id_kec',$id_kec);
        }
        if($id_kel){
        $this->db->where('pbk.id_kel',$id_kel);
        }
        $this->db->limit($limit);
        $this->db->order_by("Name", "asc");
        
        $query=$this->db->get();
        return $query->result();
        
        }

        
        function export($id_kec,$id_kel){
        $this->db->select('*');
        $this->db->from('pbk');
        $this->db->select('data_kecamatan.id_kec','data_kecamatan.kecamatan');
        $this->db->select('data_kelurahan.id_kel','data_kelurahan.kelurahan');
       
        
        
        $this->db->join('data_kecamatan', 'data_kecamatan.id_kec = pbk.id_kec ','left');
        $this->db->join('data_kelurahan', 'data_kelurahan.id_kel = pbk.id_kel ','left');
        
        
        $this->db->where('data_kecamatan.id_kec = pbk.id_kec');
        $this->db->where('data_kelurahan.id_kel = pbk.id_kel');
         $this->db->order_by("ID", "desc");
        if($id_kec){
        $this->db->where('pbk.id_kec',$id_kec);
        }
        if($id_kel){
        $this->db->where('pbk.id_kel',$id_kel);
        }
        
        $query=$this->db->get();
        }
        
        // cari berdasarkan keywords
        // cari berdasarkan kolom yang dipilih
        function search($keywords,$nama,$alamat,$pendidikan,$pekerjaan,$kelurahan,$kecamatan,$telepon,$email,$id_kel,$id_kec){
        $this->db->select('*');
        $this->db->from('pbk');
        $this->db->select('data_kecamatan.id_kec','data_kecamatan.kecamatan');
        $this->db->select('data_kelurahan.id_kel','data_kelurahan.kelurahan');
       
        
        
        $this->db->join('data_kecamatan', 'data_kecamatan.id_kec = pbk.id_kec ','left');
        $this->db->join('data_kelurahan', 'data_kelurahan.id_kel = pbk.id_kel ','left');
        
        
        $this->db->where('data_kecamatan.id_kec = pbk.id_kec');
        $this->db->where('data_kelurahan.id_kel = pbk.id_kel');
        if($id_kec){
        $this->db->where('pbk.id_kec',$id_kec);
        }
        if($id_kel){
        $this->db->where('pbk.id_kel',$id_kel);
        }
        
        if($nama){
        if($keywords){
        $this->db->or_like('Name', $keywords);
        }
        }
        
        if($alamat){
        if($keywords){
        $this->db->or_like('alamat', $keywords);
        }
        }

        if($pendidikan){
        if($keywords){
        $this->db->or_like('pendidikan', $keywords);
        }
        }

        if($pekerjaan){
        if($keywords){
        $this->db->or_like('pekerjaan', $keywords);
        }
        }

        if($kelurahan){
        if($keywords){
        $this->db->or_like('namakelurahan', $keywords);
        }
        }



        
        
        //$this->db->limit($limit);
        //$this->db->order_by("Name", "asc");
        
        $query=$this->db->get();
        return $query->result();
        
        }

        
        
}

<section id="contentleft">
            Data Kecamatan di Kabupaten Bantul
<?php $this->load->view('main/anggota/form_add_kecamatan'); ?>
            <h3>Jumlah : <?php echo $jml_kec; ?> Kecamatan </h3>
  <div class="table">

    <div class="row header">
      <div class="cell number">
        No
      </div>
        
      <div class="cell">
        Kecamatan
      </div>
      <div class="cell">
      </div>
 
    </div>
      
      <?php
      //pembuatan nomor urut
      $count = 1;
      ?>

    <?php foreach ($kecamatan as $datakecamatan) { ?>
<?php
      $urldetail=anchor('anggota/kecamatan/'.$datakecamatan->id_kec,$datakecamatan->kecamatan);
      $delete=anchor('anggota/delete_kecamatan/'.$datakecamatan->id_kec,'Delete');
?>      
    <div class="row">
      <div class="cell">
        <?php echo $count; ?>
      </div>        

        
      <div class="cell">
        <?php echo $urldetail; ?>
      </div>
      
         <div class="cell">
             <a class="fancybox fancybox.ajax" href="<?php echo base_url();?>index.php/kecamatan/edit_kecamatan/<?php echo $datakecamatan->id_kec;?>"><span>edit</span></a>
         </div>
 
        
    </div>
     
<?php 
$count++;
} 
?>      

  </div>
            

        
        
        </section>
	
<section id="contentmiddle">
<?php
if(isset($id_kec)) {
    echo "Data Kelurahan di Kecamatan ".$nama_kec->kecamatan;
?>    
    <?php $this->load->view('main/anggota/form_add_kelurahan'); ?>
    <?php

if($jml_kel>0) {
?>

    <h3>Jumlah : <?php echo $jml_kel; ?> Kelurahan </h3>
<div class="table">
    <div class="row header">
        <style>.number {
            width:5px;
            </style>
            
      <div class="cell number">
        No
      </div>
      <div class="cell">
        Kecamatan
      </div>
        
      <div class="cell">
        Kelurahan
      </div>
      <div class="cell">
        Kelurahan
      </div>

            
    </div>

    <?php
      $nokel= 1;
?>
    
    <?php foreach ($kelurahan as $datakelurahan) { ?>
    <?php
      $urldetail=$datakelurahan->kelurahan;
      $delete=anchor('anggota/delete_kelurahan/'.$datakelurahan->id_kel.'/'.$datakelurahan->id_kec,'Delete');
    ?>
    <div class="row">
        
      <div class="cell">
        <?php echo $nokel; ?>
      </div>        

      <div class="cell">
        <?php echo $datakelurahan->kecamatan; ?>
      </div>

        
      <div class="cell">
        <?php echo $urldetail; ?>
      </div>
      <div class="cell">
               <a class="fancybox fancybox.ajax" href="<?php echo base_url();?>index.php/kecamatan/edit_kelurahan/<?php echo $datakelurahan->id_kel;?>"><span>edit</span></a>
      
      </div>

        
    </div>
    <?php 
    $nokel++;  
    }; 
  
            ?>
    

<?php }; ?>



<?php }; ?>
  </section>



	



 


<section id="contentanggota">
	

<h3><?php echo "Jumlah Anggota Terdaftar : ".$count; ?></h3>    
<div class="table">
<?php 
if($count > 0 ){
   ?> 
    <div class="row header">
      <div class="cell">
        No
      </div>
      
        
      <div class="cell">
        Pilih
      </div>
        
      <div class="cell">
        Nama
      </div>
      <div class="cell">
        Alamat
      </div>
    
      <div class="cell">
        Kecamatan 
       
        
      </div>
      <div class="cell">
        Kelurahan
        
      </div>
    
  
      <div class="cell">
        Telepon
      </div>
      
  
  
  


    </div>
<?php } ?>
      
      <?php
      $count = 1;
?>

    <?php foreach ($anggotas as $anggota) { ?>
<?php
      $urldetail=anchor('anggota/detail/'.$anggota->ID,$anggota->Name);
      $actionedit=anchor('anggota/edit/'.$anggota->ID,'Edit');
      $delete=anchor('anggota/delete/'.$anggota->ID,'Delete');
?>      
    <div class="row">
      <div class="cell">
        <?php echo $count; ?>
      </div>        
      
        

     <div class="cell">
         <?php form_open(); ?>
         <?php echo form_checkbox('select',$anggota->ID); ?>
         <?php form_close(); ?>
     </div> 
        
      <div class="cell">
        <?php echo $urldetail; ?> <br/>
          <?php echo $anggota->pendidikan; ?> <br/>
          <?php echo $anggota->pekerjaan; ?> <br/>
          
      </div>
        
      <div class="cell">
        <?php echo $anggota->alamat; ?>
      </div>
        
        <div class="cell" id="listkecamatan">
        <?php
        if($anggota->id_kec=='99'){
        echo $anggota->namakecamatan."<br/>";    
        echo "<a class=\"fancybox fancybox.ajax\" href=\"".base_url()."index.php/anggota/edit_kec/".$anggota->ID."\">".$anggota->kecamatan."</a>";
        }
        else {
        echo "<a class=\"fancybox fancybox.ajax\" href=\"".base_url()."index.php/anggota/edit_kec/".$anggota->ID."\">".$anggota->kecamatan."</a>";

        }
        ?>
        
      </div>
 
        <div class="cell">
        <?php
        if($anggota->id_kel=='99') {
        echo $anggota->namakelurahan."<br/>"; 
        echo "<a class=\"fancybox fancybox.ajax\" href=\"".base_url()."index.php/anggota/edit_kel/".$anggota->ID."/".$anggota->id_kec."\">".$anggota->kelurahan."</a>";
        }
        else {
        echo "<a class=\"fancybox fancybox.ajax\" href=\"".base_url()."index.php/anggota/edit_kel/".$anggota->ID."/".$anggota->id_kec."\">".$anggota->kelurahan."</a>";
        }
        ?>
        
          
      </div>

  
      
      <div class="cell">
        <?php echo $anggota->Number; ?>
      </div>
      
  
  
  
  

    </div>
<?php 
$count++;
      

} ?>      
  </div>


 <?php echo $this->pagination->create_links(); ?>





<style type="text/css">


.editable input[type=submit] {
  color: #F00;
  font-weight: bold;
}
.editable input[type=button] {
  color: #0F0;
  font-weight: bold;
}

</style>


    
</section>    

  

  


 


	
	<section id="middle">
            <h2 style="padding: 10px;">Pendaftaran Tertunda</h2>
       <?php if(count($pendings) > 0 ) {;?>
                <div class="table" style="padding: 10px;">

    <div class="row header">
      <div class="cell">
        No
      </div>
      
        
      <div class="cell">
        Pengirim
      </div>
        
      <div class="cell">
        Pesan Pendaftaran
      </div>
      <div class="cell">
      </div>


    </div>

      
      <?php
      $count = 1;
?>

    <?php
       // untuk setiap inbox jalankan 
        foreach ($pendings as $pending) {
            $pecah=explode('*',$pending->TextDecoded);
            if(strtoupper($pecah[0])=="REG"){
                $isipesan=$pending->TextDecoded;
            }
        ?>
     
    <div class="row">
      <div class="cell">
        <?php echo $count; ?>
      </div>        
      
        

           <div class="cell">
        <?php echo $pending->SenderNumber; ?>
      </div>
        
        
            
        
        <div class="cell" style="width:700px;">
            <a class="fancybox fancybox.ajax" href="<?php echo base_url();?>index.php/anggota_ci/edit_inbox/<?php echo $pending->ID;?>"><span>Perbaiki</span></a> <br/>
        <?php echo $isipesan; ?>
      </div>
        <div class="cell" style="width: 150px;">
            <a class="fancybox fancybox.ajax" href="<?php echo base_url();?>index.php/anggota_ci/kirim_pesan/<?php echo $pending->ID;?>"><span>SMS</span></a> | 
            <a class="fancybox fancybox.ajax" href="<?php echo base_url();?>index.php/anggota_ci/buat_pendaftaran/<?php echo $pending->ID;?>"><span>Proses</span></a> | 
            <a class="fancybox" href="<?php echo base_url();?>index.php/anggota_ci/hapus_inbox/<?php echo $pending->ID;?>"><span>Hapus</span></a> | 
      </div>
        
  
 
   

  
      
      
  
  
  
  

    </div>
<?php 
$count++;
      

} ?>      
  </div>
       <?php } ?>
                
                
	</section>

	
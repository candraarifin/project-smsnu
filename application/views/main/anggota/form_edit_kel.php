<form name="editkec" action="<?php echo base_url();?>index.php/anggota/update_kel" method="post">
    <?php if($kelurahan) { ?>
    <input type="hidden" name="idanggota" value="<?php echo $id_anggota;?>">
 

    <select name="kelurahan">
        <?php 
        foreach ($kelurahan as $list) {
            if($id_kec=='99'){
        ?>    
        <option value="<?php echo $id_kec;?>">Pilih Kecamatan Dahulu</option>
        <?php 
            }
            else {
        ?>            
        
        <option value="<?php echo $list->id_kel;?>"><?php echo $list->kelurahan;?></option>
        <?php
            }
        }
        
        ?>
        
    </select>
    <?php
    if($id_kec!='99'){ ?>
    <input type="submit" value="simpan">
    <?php
    }
    ?>
 <?php 
 }
 else {
 echo "<p></span>Data Kelurahan Belum ada</span></p>";
     
 }
 ?>   
 
    
</form>
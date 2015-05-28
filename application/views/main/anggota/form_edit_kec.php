<form name="editkec" action="<?php echo base_url();?>index.php/anggota/update_kec" method="post">
    <input type="hidden" name="idanggota" value="<?php echo $id_anggota;?>">
    <select name="kecamatan">
        <?php 
        foreach ($kecamatan as $list) {
        ?>    
            
        
        <option value="<?php echo $list->id_kec;?>"><?php echo $list->kecamatan;?></option>
        <?php
        }
        ?>
        
    </select>
    <input type="submit" value="simpan">
</form>
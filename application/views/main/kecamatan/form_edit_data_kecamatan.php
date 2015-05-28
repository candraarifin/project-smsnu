<form name="editkecamatan" method="post" action="<?php echo base_url();?>index.php/kecamatan/update_data_kecamatan">
    <h3> Ganti Nama Kecamatan </h3>
    
    <input type="text" name="namakecamatan" value="<?php echo $kecamatan->kecamatan;?>">
    <input type="hidden" name="idkecamatan" value="<?php echo $kecamatan->id_kec;?>">
    
    <input type="submit" value="Ubah">
    
</form>
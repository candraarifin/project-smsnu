<form name="editkelurahan" method="post" action="<?php echo base_url();?>index.php/kecamatan/update_data_kelurahan">
        <h3> Ganti Nama Kelurahan</h3>
    
    <input type="text" name="namakelurahan" value="<?php echo $kelurahan->kelurahan;?>">
    <input type="hidden" name="idkecamatan" value="<?php echo $kelurahan->id_kec;?>">
    <input type="hidden" name="idkelurahan" value="<?php echo $kelurahan->id_kel;?>">
    
    
    <input type="submit" value="Ubah">
    
</form>
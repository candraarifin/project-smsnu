
<form name="pendafataran" method="post" action="<?php echo base_url();?>index.php/anggota_ci/proses_pendaftaran">
    <table>
        <tr>

            <td colspan="2">
                <h3> Pendaftaran Manual berdasarkan SMS yang masuk</h3>
            </td>

            
        </tr>
        <tr>
            <td colspan="2" style="border:solid 1px; padding: 5px; margin: 2px;">
                <?php echo $parameter->TextDecoded;?>
            </td>
        </tr>
        <tr>
            <td>Nama</td>
            <td><input type="text" name="nama"></td>
            
        </tr>
        <tr>
            <td>Identitas</td>
            <td>
                <select name="identitas">
                    <option value="KTP" selected="selected">KTP</option>
                    <option value="SIM">SIM</option>
                    <option value="KTM">KTM</option>
                    <option value="KTS">Kartu Siswa</option>
                    
                </select>
            </td>
        <tr>
            <td>No Identitas</td>
            <td><input type="text" name="no_identitas"></td>
        </tr>
            
            
        <tr>
            <td>Gender</td>
            <td>
                <select name="gender">
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                    
                </select>
            </td>
            
        </tr>

        
        <tr>
            <td>Pendidikan</td>
            <td><input type="text" name="pendidikan"></td>
            
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td><input type="text" name="pekerjaan"></td>
            
        </tr>
        <tr>
            <td>Tempat Lahir</td>
            <td><input type="text" name="tmp_lahir"></td>
            
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td><input type="text" name="tgl_lahir"></td>
            
        </tr>
        
        <tr>
            <td>Alamat</td>
            <td><input type="text" name="alamat"></td>

        </tr>
        <tr>
            <td>Kecamatan</td>
            <td>
                <select name="kecamatan">
                    <option value="99">-- Pilih Kecamatan --</option>
                    <?php
                    foreach ($kecamatan as $kecamatan) {
                        if($kecamatan->id_kec!=99){
                    ?>
                    <option value="<?php echo $kecamatan->id_kec;?>">-- <?php echo $kecamatan->kecamatan;?> --</option>
                    <?php } } ;?>
                    
                </select>
            </td>
            
        </tr>
        <tr>
            <td>Kelurahan</td>
            <td>
                <select name="kelurahan">
                    <option value="99">-- Pilih Kelurahan --</option>
                                        <?php
                    foreach ($kelurahan as $kelurahan) {
                        if($kelurahan->id_kel!=99){
                    ?>
                    <option value="<?php echo $kelurahan->id_kel;?>">-- <?php echo $kelurahan->kelurahan;?> --</option>
                    <?php } } ;?>

                </select>
            </td>    
            
        </tr>
        <tr>
            <td>No Telp</td>
            <td><input type="text" name="telp" value="<?php echo $parameter->SenderNumber;?>"></td>
            
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" name="email"></td>
            
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <input type="hidden" name="id_inbox" value="<?php echo $parameter->ID;?>">
                <input type="submit" name="daftar" value="Proses Pendafataran">
            </td>
            
            
        </tr>

    </table>    
</form>

<div id="search">
        	<div id="search-inner">
<?php


$formattributes=array(
    'name'=>'searchform',
    'method'=>'get'
);
echo form_open('/search/', $formattributes);
?>
Cari apa : 
<!-- <input type="checkbox" name="cariapa[]" value="semua" checked="checked"> Cari Semua -->
<input type="checkbox" name="nama" value="nama"> Nama
<input type="checkbox" name="alamat" value="alamat"> Alamat
<input type="checkbox" name="pendidikan" value="pendidikan"> Pendidikan
<input type="checkbox" name="pekerjaan" value="pekerjaan"> Pekerjaan
<input type="checkbox" name="kelurahan" value="kelurahan"> Kelurahan
<input type="checkbox" name="kecamatan" value="kecamatan"> Kecamatan
<input type="checkbox" name="telepon" value="telepon"> Nomor Telepon

<input type="checkbox" name="email" value="email"> Email
<br/>
<input type="text" name="keywords" width="300" size="50"/>

<select name="tampilkecamatan"> 
            <option value="" selected="selected"> -- Semua Kecamatan -- </option>;

            <?php
        
         foreach ($kecamatan as $list) {

            if($list->id_kec!='99') {
            echo "<option value=\"".$list->id_kec."\">".$list->kecamatan."</option>";
            }
            }
        ?>
        </select>
        <select name="tampilkelurahan"> 
        <option value="" selected="selected"> -- Pilih Kelurahan -- </option>;

        <?php
         foreach ($kelurahan as $listkelurahan) {
            if($listkelurahan->id_kel!='99') {
            echo "<option value=\"".$listkelurahan->id_kel."\">".$listkelurahan->kelurahan."</option>";
            }
            }
        echo form_close();   
        ?>
        </select>
<?php                    
echo form_submit('cari', 'cari');
echo form_close(); 
?>
                </div>
</div>
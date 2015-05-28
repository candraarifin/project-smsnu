
<div id="search">
        	<div id="search-inner">
<?php


$formattributes=array(
    'name'=>'searchform',
    'method'=>'get'
);
echo form_open('/anggota/search', $formattributes);
$data = array(
              'name'        => 'keywords',
              'id'          => 'searchfield',
              'width' =>'style:width:100'
    
              
            );
$options = array(
        '1'         => 'Nama',
        '2'         => 'Alamat',
    
        '3'           => 'Kelurahan',
        '4'         => 'Kecamatan',
        '5'        => 'Nomor Telepon',
        '6'        => 'Cari Semua');

echo form_dropdown('searchwhat', $options, '6');


echo form_input($data);
?>
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
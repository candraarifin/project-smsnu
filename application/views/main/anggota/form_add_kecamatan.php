
<div id="addkecamatan">
        	<div id="search-inner">
<?php
$data = array(
              'name'        => 'kecamatan',
              'id'          => 'kecamatan',
              'maxlength'   => '100',
              'size'        => '100',
              
              'style'       => 'width:198px',
            );



echo form_open('/anggota/add_kecamatan', '');



echo form_input($data);


echo form_submit('submit_button', 'Tambahkan');
echo form_close();
?>
                </div>
</div>
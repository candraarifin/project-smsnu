
<div id="addkelurahan">
        	<div id="search-inner">
<?php
$data = array(
              'name'        => 'kelurahan',
              'id'          => 'kelurahan',
              'maxlength'   => '100',
              'size'        => '50',
              'style'       => 'width:250px',
            );



echo form_open('/anggota/add_kelurahan', '');




echo form_input($data);
echo form_hidden('id_kec', $id_kec);

echo form_submit('submit_button', 'Tambahkan');
echo form_close();
?>
                </div>
</div>
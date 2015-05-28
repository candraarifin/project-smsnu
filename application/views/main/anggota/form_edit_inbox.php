<?php

echo form_open('anggota_ci/update_inbox', $attributes);
$textarea=array(
    'name'=>'isisms',
    'size'=>'100'
);

echo form_textarea($textarea, $sms);

echo form_hidden('id_inbox', $id);
echo "<br/>";
echo form_submit($data, 'Simpan');
echo form_close();
?>
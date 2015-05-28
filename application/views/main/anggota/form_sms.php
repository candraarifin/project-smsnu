<?php
echo form_open('anggota_ci/proses_sms', $attributes);
$textarea=array(
    'name'=>'isisms',
    'size'=>'100',
    'max-size'=>150
    
);

echo form_textarea($textarea, $sms);

echo form_hidden('tujuan', $parameter->SenderNumber);
echo "<br/>";
echo form_submit($data, 'Kirim SMS');
echo form_close();
?>
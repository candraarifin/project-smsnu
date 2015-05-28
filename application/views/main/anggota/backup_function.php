<script type="text/javascript" charset="utf-8">
<?php
foreach ($kecamatan as $list) {
 $array[''.$list->id_kec.''] =  ''.$list->kecamatan.'';
}    
?>
$(function() {
        
  $(".editable_select").editable("<?php echo base_url().'anggota/update_pbk';?>", { 
    indicator : '<img src="<?php echo  $this->config->item('img_path');?>/processing.gif">',
    data   : '<?php print  json_encode($array); ?>',        
    type   : "select",
    id   : "<?php echo $anggota->ID;?>",
    
    submit : "update",
    style  : "inherit",
    submitdata : function() {
      return {id :<?php echo $anggota->ID;?>
      
      };
    }
  });
  


});
</script> 


<b class="editable_select" id="<?php echo $anggota->ID;?>" style="display: inline"> <?php echo $anggota->kecamatan; ?></b> 
        <!--
            <select name="listkecamatan<?php echo $anggota->ID;?>" style="width:150px;"> 
        
        <?php
        foreach ($kecamatan as $list) {
            
            if($list->id_kec==$anggota->id_kec) {
            $selected="selected=\"selected\"";
            echo "<option value=\"".$list->id_kec."\" ".$selected.">".$list->kecamatan."</option>";
                
            }
            else {
            
            echo "<option value=\"".$list->id_kec."\">".$list->kecamatan."</option>";
            }
           
        }
        ?>
         </select>
        -->
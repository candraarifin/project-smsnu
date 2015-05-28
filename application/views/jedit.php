
<script language="javascript" src="<?php echo $this->config->item('js_path');?>jquery-1.6.2.min.js"></script>
<script language="javascript" src="<?php echo $this->config->item('js_path');?>jquery.jeditable.mini.js"></script>

<script type="text/javascript" charset="utf-8">

$(function() {
        
  $(".editable_select").editable("http://www.appelsiini.net/projects/jeditable/php/save.php", { 
    indicator : '<img src="img/indicator.gif">',
    data   : "{'Lorem ipsum':'Lorem ipsum','Ipsum dolor':'Ipsum dolor','Dolor sit':'Dolor sit'}",
    type   : "select",
    submit : "OK",
    style  : "inherit",
    submitdata : function() {
      return {id : 2};
    }
  });
  


  



  


});
</script>

<style type="text/css">


.editable input[type=submit] {
  color: #F00;
  font-weight: bold;
}
.editable input[type=button] {
  color: #0F0;
  font-weight: bold;
}

</style>

    
    <b class="editable_select" id="select_1" style="display: inline"> Ipsum dolor</b> 




 




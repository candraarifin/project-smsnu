
   <script type="text/javascript">
   (function($){
$(document).ready(function(){

$('#cssmenu li.active').addClass('open').children('ul').show();
	$('#cssmenu li.has-sub>a').on('click', function(){
		//$(this).removeAttr('href');
		var element = $(this).parent('li');
		if (element.hasClass('open')) {
			element.removeClass('open');
			element.find('li').removeClass('open');
			element.find('ul').slideUp(200);
		}
		else {
			element.addClass('open');
			element.children('ul').slideDown(200);
			element.siblings('li').children('ul').slideUp(200);
			element.siblings('li').removeClass('open');
			element.siblings('li').find('li').removeClass('open');
			element.siblings('li').find('ul').slideUp(200);
		}
	});

});
})(jQuery);

   
   </script>

<section id="contentleftmenu">
<div id='cssmenu'>
<ul>
    <li><a href="<?php echo base_url();?>index.php/anggota"><span>Anggota</span></a></li>
                   
    <?php
           foreach ($kecamatan as $kec) {
               echo "<li class=\"has-sub active\"><a href=\"".base_url()."index.php/anggota/perkecamatan/".$kec->id_kec."\"><span>".$kec->kecamatan."</span></a>";
               
               if($jml_kel > 0){
                   echo "<ul>";
               foreach ($kelurahan as $kel){
                   if($kec->id_kec==$kel->id_kec)
                   echo "<li><a href=\"".base_url()."index.php/anggota/perkelurahan/".$kel->id_kel."\"><span>".$kel->kelurahan."</span></a></li>";
               }
                   echo "</ul>";
                   echo "</li>";
               }
               
           }
           
           echo "</ul>";

?>    
</div>
</section>



<section id="contentleftmenu">
<div id='cssmenuleft'>
<ul>
    
   <li><a href='<?php echo base_url().'index.php/anggota';?>'><span>Home</span></a></li>
   <?php foreach ($kecamatan as $daftarkecamatan) { ?>
   <li><a href='<?php echo base_url().'index.php/anggota/kecamatan/'.$daftarkecamatan->id_kec.''; ?>'><span><?php echo $daftarkecamatan->kecamatan; ?></span></a></li>
   <?php
   }
   ?>
  
   <li class='active has-sub'><a href='#'><span>Products</span></a>
      <ul>
         <li class='has-sub'><a href='#'><span>Product 1</span></a>
            <ul>
               <li><a href='#'><span>Sub Product</span></a></li>
               <li class='last'><a href='#'><span>Sub Product</span></a></li>
            </ul>
         </li>
         <li class='has-sub'><a href='#'><span>Product 2</span></a>
            <ul>
               <li><a href='#'><span>Sub Product</span></a></li>
               <li class='last'><a href='#'><span>Sub Product</span></a></li>
            </ul>
         </li>
      </ul>
   </li>
  
   
</ul>
</div>
</section>
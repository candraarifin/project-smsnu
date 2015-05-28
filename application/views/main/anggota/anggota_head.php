<html>
    <head>
        <title><?php echo $title;?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'media/css/base.css';?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'media/css/blue.css';?>">
        
        
        
        <link type="text/css" rel="stylesheet" href="<?php echo $this->config->item('css_path');?>magnific-popup.css" />
        
        
        
        <script language="javascript" src="<?php echo $this->config->item('js_path');?>jquery-1.11.3.min.js"></script>
        <script language="javascript" src="<?php echo $this->config->item('js_path');?>jquery-1.11.1.js"></script>
        <script language="javascript" src="<?php echo $this->config->item('js_path');?>menutop.js"></script>
        
        
        

        <script language="javascript" src="<?php echo $this->config->item('js_path');?>jquery.magnific-popup.js"></script>
        <script language="javascript" src="<?php echo $this->config->item('js_path');?>jquery.bpopup.min.js"></script>
        
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        
        
        <script language="javascript" src="<?php echo $this->config->item('js_path');?>jquery-1.6.2.min.js"></script>
<script language="javascript" src="<?php echo $this->config->item('js_path');?>jquery.jeditable.mini.js"></script>
<link rel="stylesheet" href="<?php echo $this->config->item('js_path');?>/fancyapps/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo $this->config->item('js_path');?>/fancyapps/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.fancybox').fancybox();

			/*
			 *  Different effects
			 */

			// Change title type, overlay closing speed
			$(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedOut : 0
					}
				}
			});

			// Disable opening and closing animations, change title type
			$(".fancybox-effects-b").fancybox({
				openEffect  : 'none',
				closeEffect	: 'none',

				helpers : {
					title : {
						type : 'over'
					}
				}
			});

			// Set custom style, close if clicked, change title type and overlay color
			$(".fancybox-effects-c").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});

			// Remove padding, set opening and closing animations, close if clicked and disable overlay
			$(".fancybox-effects-d").fancybox({
				padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true,

				helpers : {
					overlay : null
				}
			});

			/*
			 *  Button helper. Disable animations, hide close button, change title type and content
			 */

			$('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',

				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});


			/*
			 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
			 */

			$('.fancybox-thumbs').fancybox({
				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,
				arrows    : false,
				nextClick : true,

				helpers : {
					thumbs : {
						width  : 50,
						height : 50
					}
				}
			});

			/*
			 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
			*/
			$('.fancybox-media')
				.attr('rel', 'media-gallery')
				.fancybox({
					openEffect : 'none',
					closeEffect : 'none',
					prevEffect : 'none',
					nextEffect : 'none',

					arrows : false,
					helpers : {
						media : {},
						buttons : {}
					}
				});

			/*
			 *  Open manually
			 */

			$("#fancybox-manual-a").click(function() {
				$.fancybox.open('1_b.jpg');
			});

			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					href : 'iframe.html',
					type : 'iframe',
					padding : 5
				});
			});

			$("#fancybox-manual-c").click(function() {
				$.fancybox.open([
					{
						href : '1_b.jpg',
						title : 'My title'
					}, {
						href : '2_b.jpg',
						title : '2nd title'
					}, {
						href : '3_b.jpg'
					}
				], {
					helpers : {
						thumbs : {
							width: 75,
							height: 50
						}
					}
				});
			});


		});
	</script>
        
        
        
        
        
        
        
        
        
        
        
        
        
        <link type="text/css" rel="stylesheet" href="<?php echo $this->config->item('css_path');?>menuflataccordion.css" /> 
        <link type="text/css" rel="stylesheet" href="<?php echo $this->config->item('css_path');?>menutop.css" /> 
        

        
<style type="text/css">
//@import url(http://fonts.googleapis.com/css?family=Open+Sans);
//@import url(<?php echo base_url().'media/css/base.css';?>);
//@import url(<?php echo base_url('media/css/blue.css');?>);

//body { 
  //font-family: 'Open Sans', sans-serif;
  //color: #666;
//}

/* STRUCTURE */

#pagewrap {
  padding: 5px;
  width: 90%;
  margin: 20px auto;
  border-color:#27ae60;
}

header {
  height: 100px;
  padding: 0 15px;
}
#topmenu{
  height: 50px;
  padding: 0 15px;
  border-style: solid;
  border-width: thin;
  border-color: #ccc;
  margin: 10px 0px 10px 0px;
  
}

#content {
  width: 200px;
  float: left;
  padding: 5px 15px;
}
#contentleft {
  width: 300px;
  float: left;
  padding: 5px 15px;
  border: 1px;
}
#contentleftmenu {
  width: 200px;
  float: left;
  padding: 5px 15px;
  border: 1px;
}
#contentmiddle {
  width: 60%;
  /* Account for margins + border values */
  
  float: left;
  padding: 5px 15px;
  margin: 0px 5px 5px 5px;
}

#contentanggota {
  width: 80%;
  /* Account for margins + border values */
  
  float: left;
  //padding: 5px 15px;
  //margin: 0px 5px 5px 5px;
}

#centercontent {
  width: 80%;
  /* Account for margins + border values */
  
  float: left;
  padding: 5px 15px;
  margin: 0px 5px 5px 5px;
}

#sidebar {
  width: 270px;
  padding: 5px 15px;
  float: left;
}

footer {
  clear: both;
  padding: 0 15px;
}
/************************************************************************************
MEDIA QUERIES
*************************************************************************************/
/* for 980px or less */

@media screen and (max-width: 980px) {
  #pagewrap {
    width: 94%;
  }
  #content {
    width: 41%;
    padding: 1% 2%;
  }
  #middle {
    width: 41%;
    padding: 1% 4%;
    margin: 0px 0px 5px 5px;
    float: right;
  }
  #sidebar {
    clear: both;
    padding: 1% 4%;
    width: auto;
    float: none;
  }
  header,
  footer {
    padding: 1% 4%;
  }
}
/* for 700px or less */

@media screen and (max-width: 600px) {
  #content {
    width: auto;
    float: none;
  }
  #middle {
    width: auto;
    float: none;
    margin-left: 0px;
  }
  #sidebar {
    width: auto;
    float: none;
  }
}
/* for 480px or less */

@media screen and (max-width: 480px) {
  header {
    height: auto;
  }
  h1 {
    font-size: 2em;
  }
  #sidebar {
    display: none;
  }
}

#content {
 // background: #f8f8f8;
}

#sidebar {
  background: #f0efef;
}

header,
#content,
#middle,
#sidebar {
  margin-bottom: 5px;
}

#pagewrap,
header,
#content,
#middle,
#sidebar,
footer {
  border: solid 1px #ccc;
}
.table {
  margin: 0 0 40px 0;
  width: auto;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
  display: table;
}
@media screen and (max-width: 580px) {
  .table {
    display: block;
  }
}

.row {
  display: table-row;
  background: #f6f6f6;
}
.row:nth-of-type(odd) {
  background: #e9e9e9;
}
.row.header {
  font-weight: 900;
  color: #ffffff;
  background: #ea6153;
}
.row.green {
  background: #27ae60;
}
.row.blue {
  background: #2980b9;
}
@media screen and (max-width: 580px) {
  .row {
    padding: 8px 0;
    display: block;
  }
}

.cell {
  padding: 6px 12px;
  display: table-cell;
}
@media screen and (max-width: 580px) {
  .cell {
    padding: 2px 12px;
    display: block;
  }
}
.data_header {
    color:#ffffff;
    
}

.box-link {
    color:#f6f6f6;
}
</style>
<style type="text/css">
.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}
   
    

.table {
  //margin: 0 0 40px 0;
  width: 100%;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
  display: table;
  font-size: 9pt;
}
@media screen and (max-width: 580px) {
  .table {
    display: block;
  }
}

.row {
  display: table-row;
  background: #f6f6f6;
}
.row:nth-of-type(odd) {
  background: #e9e9e9;
}
.row.header {
  font-weight: 900;
  color: #ffffff;
  background: #ea6153;
}
.row.green {
  background: #27ae60;
}
.row.blue {
  background: #2980b9;
}
@media screen and (max-width: 580px) {
  .row {
    padding: 8px 0;
    display: block;
  }
}

.cell {
  padding: 6px 12px;
  display: table-cell;
}
@media screen and (max-width: 580px) {
  .cell {
    padding: 2px 12px;
    display: block;
  }
}
.data_header {
    //color:#ffffff;
    
    
}

.box-link {
    color:#f6f6f6;
}
  
</style>
    </head>
    <body>
        
<div id="pagewrap">

  <header>
    <h1>Pengelolaan Anggota PCNU Bantul</h1>
  </header>
    

    


  


   
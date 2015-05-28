( function( $ ) {
$( document ).ready(function() {
$('#cssmenutop').prepend('<div id="menu-button">Menu</div>');
	$('#cssmenutop #menu-button').on('click', function(){
		var menu = $(this).next('ul');
		if (menu.hasClass('open')) {
			menu.removeClass('open');
		}
		else {
			menu.addClass('open');
		}
	});
});
} )( jQuery );

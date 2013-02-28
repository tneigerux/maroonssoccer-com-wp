// JavaScript Document
var $j = jQuery.noConflict();

$j(document).ready(function() {
	
	// table row hovers
	var $wysTable = $j('.wysiwyg-content table');
	$wysTable.find('tbody tr:odd').addClass('altrow');
	if ( ($wysTable.find('tbody tr').length % 2) === 0 ) {
		$wysTable.addClass('test');
	}
	$wysTable.on({
		mouseenter:function() {
			$j(this).toggleClass('hover');
		},
		mouseleave:function() {
			$j(this).toggleClass('hover');
		}
	}, 'tbody tr');

	// fix display:runin for FF
	var div = document.createElement('div');
	div.style.cssText = 'display:run-in';
	if ( div.style.display !== 'run-in') {
		var runin = $j('.runin, .wysiwyg-content h6');
		runin.each(function(){
			var text = $j(this).text();
			$j(this).hide().next().prepend('<b>' + text + ' </b>');
		});
	}
	
	/* Items to add
	 * Drop Down Menus
	 * Make height of site min screen height
	  - + Space somewhere
	* Smooth scroll to top
	* Tab to buttons as "hover"
	* Some sort of Error checking that first checks browser support for input fields
	--------------------------------- */
	
	
});

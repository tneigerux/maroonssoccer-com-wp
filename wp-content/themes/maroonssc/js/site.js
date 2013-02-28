// JavaScript Document
var $j = jQuery.noConflict();

$j(document).ready(function() {
  
	/**
	 * Declare Vars
	*/
	
	// site min-height
	// smooth scroll
  var $win = $j(window),
      $sw = $j('.site-wrapper'),
			$is = $j('.site-wrapper').find('.home-excerpts-wrapper, .stretch-wrapper'),
  // search field
      $search = $j('#search-field'),
	    searchVal = $search.val(),
	// primary nav
	    $psn = $j('.primary-site-nav');

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

	/**
	 * min-height the content to make the bottom content always touch 
	 * the bottom of the browser
	*/
	$win.on('load resize', function() {
    if ( $sw.height() < $win.height()  ) {
      var diff = $is.height() + ( $win.height() - $sw.height() );
      $is.css({'min-height':diff});
    }
  });

  // search focus / blur
  $search.on({
	  focus : function() {
		  if ( $j(this).val() === searchVal ) {
				$j(this).val('');
			}
		},
		focusout : function() {
			if ( $j(this).val() === "" ) {
			  $j(this).val( searchVal );
			}
		}
	});

  //smooth scroll
	$j('.backtotop').on('click', function(e) {
		e.preventDefault();
    $j('body, html').animate({'scrollTop':0}, 300, 'swing');
	});
  
  // Drop Down Menus
  $psn.find('.sub-menu').hide();
	
	$psn.find('ul:first-child').children('li').on({
	  mouseenter : function() {
			var $subM = $j(this).children('.sub-menu');
			if ( $subM.length > 0 ) {
				$j(this).toggleClass('over');
  		  $subM.slideDown(200);
				$subM.children(':last').css({'border':'none'});
			}
		},
		mouseleave : function() {
			var $subM = $j(this).children('.sub-menu');
			if ( $subM.length > 0 ) {
				$j(this).toggleClass('over');
  			$subM.slideUp(200);
			}
		}	
	});
  
});

$(document).ready(function() {
	var $win = $(window),
	//$con = $('#container'),
	$grid = $('.grid'),
	$imgs = $("img.lazy");
	
	$grid.isotope({
		itemSelector: '.grid-item',
  	  	layoutMode: 'fitRows',
		onLayout: function() {
			$win.trigger("scroll");
		},
		getSortData: {
			year: '.year parseInt'
		}
	});
	
	$imgs.lazyload({
		failure_limit: Math.max($imgs.length - 1, 0)
	});
	
	// hash of functions that match data-filter values
	var filterFns = {
	  // show if number is greater than 50
	  numberGreaterThan50: function() {
	    var number = $(this).find('.number').text();
	    return parseInt( number, 10 ) > 50;
	  },
	  // show if name ends with -ium
	  ium: function() {
	    var name = $(this).find('.name').text();
	    return name.match( /ium$/ );
	  },
	  postersFromThe1900s: function() {
		  return $(this).hasClass('1900');
	  },
	  postersFromThe10s: function() {
		  return $(this).hasClass('1910');
	  },
	  postersFromThe20s: function() {
		  return $(this).hasClass('1920');
	  },
	  postersFromThe30s: function() {
		  return $(this).hasClass('1930');
	  },
	  postersFromThe40s: function() {
		  return $(this).hasClass('1940');
	  },
	  postersFromThe50s: function() {
		  return $(this).hasClass('1950');
	  },
	  postersFromThe60s: function() {
		  return $(this).hasClass('1960');
	  },
	  postersFromThe70s: function() {
		  return $(this).hasClass('1970');
	  },
	  postersFromThe80s: function() {
		  return $(this).hasClass('1980');
	  },
	  postersFromThe90s: function() {
		  return $(this).hasClass('1990');
	  },
	  postersFromThe2000s: function() {
		  return $(this).hasClass('2000');
	  },
	  postersFromThe2010s: function() {
		  return $(this).hasClass('2010');
	  },
	  postersFromUS: function() {
		  return $(this).hasClass('US');
	  },
	  postersFromMexico: function() {
		  return $(this).hasClass('Mexico');
	  },
	  postersFromUK: function() {
		  return $(this).hasClass('UK');
	  },
	  postersFromFrance: function() {
		  return $(this).hasClass('France');
	  },
	  postersFromSpain: function() {
		  return $(this).hasClass('Spain');
	  },
	  postersFromGermany: function() {
		  return $(this).hasClass('Germany');
	  },
	  postersFromItaly: function() {
		  return $(this).hasClass('Italy');
	  },
	  postersFromSwitzerland: function() {
		  return $(this).hasClass('Switzerland');
	  },
	  postersFromAustria: function() {
		  return $(this).hasClass('Austria');
	  },
	  postersFromEstonia: function() {
		  return $(this).hasClass('Estonia');
	  },
	  postersFromNetherlands: function() {
		  return $(this).hasClass('Netherlands');
	  },
	  postersFromSweden: function() {
		  return $(this).hasClass('Sweden');
	  },
	  postersFromNewZealand: function() {
		  return $(this).hasClass('NZ');
	  },
	  postersFromCanada: function() {
		  return $(this).hasClass('Canada');
	  },
	  postersFromRussia: function() {
		  return $(this).hasClass('Russia');
	  },
	  postersFromChina: function() {
		  return $(this).hasClass('China');
	  },
	  postersFromJapan: function() {
		  return $(this).hasClass('Japan');
	  },
	  postersFromCuba: function() {
		  return $(this).hasClass('Cuba');
	  },
	  postersFromPuertoRico: function() {
		  return $(this).hasClass('PR');
	  },
	  postersFromOtherCountries: function() {
		  return !$(this).hasClass('US') && !$(this).hasClass('UK') && !$(this).hasClass('France') && !$(this).hasClass('Spain');
	  },
	  allPosters: function() {
		  return true;
	  }
	};
	
	// filter items on button click
	$('.filter-button-group').on( 'click', 'button', function() {
	  var filterValue = $(this).attr('data-filter');
	  // use filter function if value matches
	  filterValue = filterFns[ filterValue ] || filterValue;
	  console.log(filterValue);
	  $grid.isotope({ filter: filterValue });
	});
	
	// change is-checked class on buttons
	$('.button-group').each( function( i, buttonGroup ) {
	  var $buttonGroup = $( buttonGroup );
	  $buttonGroup.on( 'click', 'button', function() {
	    $buttonGroup.find('.is-checked').removeClass('is-checked');
	    $( this ).addClass('is-checked');
	  });
	});
	
	// sort items on button click
	$('.sort-by-button-group').on( 'click', 'button', function() {
	  var sortByValue = $(this).attr('data-sort-by');
	  console.log(sortByValue);
	  if (sortByValue == "asc") {
	  	$grid.isotope({ sortBy: sortByValue, sortAscending: true });
	  }
	  if (sortByValue == "des") {
	  	$grid.isotope({ sortBy: sortByValue, sortAscending: false });
	  }
	  //$grid.isotope({ sortBy: sortByValue });
	});
});
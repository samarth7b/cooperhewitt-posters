<!doctype html>

<style>
* { box-sizing: border-box; }

/* force scrollbar */
html { overflow-y: scroll; }

body { font-family: sans-serif; }

/* ---- grid ---- */

.grid {
  background: #DDD;
}

/* clear fix */
.grid:after {
  content: '';
  display: block;
  clear: both;
}

/* ---- .grid-item ---- */

.grid-sizer,
.grid-item {
  width: 20%;
}

.grid-item--width2 {
	width: 40%;
}

.grid-item {
  float: left;
  margin-bottom: 10px;
}

.grid-item img {
  display: block;
  width: 100%;
}

.button:active,
.button.is-checked {
  background-color: #28F;
}

.button.is-checked {
  color: white;
  text-shadow: 0 -1px hsla(0, 0%, 0%, 0.8);
}

.button:active {
  box-shadow: inset 0 1px 10px hsla(0, 0%, 0%, 0.8);
}
</style>

<script src="/Scripts/jquery-2.2.3.min.js"></script>
<script src="/Scripts/custom.js"></script>
<script src="/Scripts/jquery.lazyload.js"></script>
<script src="/Scripts/masonry.pkgd.min.js"></script>
<script src="/Scripts/isotope.pkgd.min.js"></script>
<script src="/Scripts/list.min.js"></script>
<script src="https://npmcdn.com/imagesloaded@4.1/imagesloaded.pkgd.min.js"></script>

<link rel="stylesheet" href="/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

<!--script>
/*$('.grid').masonry({
  // options
  itemSelector: '.grid-item',
  columnWidth: 200
});*/

// external js: masonry.pkgd.js, imagesloaded.pkgd.js

// init Masonry after all images have loaded
var $grid = $('.grid').imagesLoaded( function() {
  $grid.masonry({
    itemSelector: '.grid-item',
    percentPosition: true,
    columnWidth: '.grid-sizer'
  }); 
});
</script-->

<!--button class="sort" data-sort="name">
    Sort
</button-->

<h1><font face="cooper hewitt">Posters from the Cooper Hewitt</font></h1>

<div class="button-group filter-button-group">
	<span><font size="3px">Year of origin: </font></span>
	<button class="button" data-filter="postersFromThe1900s">1900s</button>
	<button class="button" data-filter="postersFromThe10s">1910s</button>
	<button class="button" data-filter="postersFromThe20s">1920s</button>
	<button class="button" data-filter="postersFromThe30s">1930s</button>
	<button class="button" data-filter="postersFromThe40s">1940s</button>
	<button class="button" data-filter="postersFromThe50s">1950s</button>
	<button class="button" data-filter="postersFromThe60s">1960s</button>
	<button class="button" data-filter="postersFromThe70s">1970s</button>
	<button class="button" data-filter="postersFromThe80s">1980s</button>
	<button class="button" data-filter="postersFromThe90s">1990s</button>
	<button class="button" data-filter="postersFromThe2000s">2000s</button>
	<button class="button" data-filter="postersFromThe2010s">2010s</button><br/><br/>
	
	<span><font size="3px">Country of origin: </font></span>
	<button class="button" data-filter="postersFromUS">US</button>
	<button class="button" data-filter="postersFromCanada">Canada</button>
	<!--button data-filter="postersFromMexico">Mexico</button-->
	<button class="button" data-filter="postersFromUK">UK</button>
	<button class="button" data-filter="postersFromFrance">France</button>
	<button class="button" data-filter="postersFromSpain">Spain</button>
	<button class="button" data-filter="postersFromGermany">Germany</button>
	<button class="button" data-filter="postersFromItaly">Italy</button>
	<button class="button" data-filter="postersFromSwitzerland">Switzerland</button>
	<!--button data-filter="postersFromAustria">Austria</button-->
	<!--button data-filter="postersFromEstonia">Estonia</button-->
	<button class="button" data-filter="postersFromNetherlands">Netherlands</button>
	<button class="button" data-filter="postersFromSweden">Sweden</button>
	<button class="button" data-filter="postersFromRussia">Russia</button>
	<button class="button" data-filter="postersFromJapan">Japan</button>
	<!--button data-filter="postersFromChina">China</button-->
	<!--button data-filter="postersFromNewZealand">New Zealand</button-->
	<button class="button" data-filter="postersFromCuba">Cuba</button>
	<!--button data-filter="postersFromPuertoRico">Puerto Rico</button-->
	<!--button data-filter="postersFromOtherCountries">Others</button><br/-->
	<button class="button" data-filter="allPosters">Reset filters</button><br/><br/>
</div>

<div class="button-group sort-by-button-group">
	<span><font size="3px">Sort by year: </font></span>
	<button data-sort-by="asc">Sort ascending</button>
	<button data-sort-by="des">Sort descending</button>
</div>
<br/>
<div class="grid">
<?php

error_reporting(E_ERROR | E_PARSE);

$directory = 'Data/Posters';

$allowed_types=array('jpg');
$file_parts=array();
$ext='';
$title='';
$i=0;
$class='test';

$dir_handle = @opendir($directory) or die("Accidentally the entire directory.");

//$string = file_get_contents("100_poster_info.json");
//$json_a = json_decode($string, true);
//echo $json_a[0][object][title];

while ($file = readdir($dir_handle)) 
{
	#$string = file_get_contents("100_poster_info.json");
	#$json_a = json_decode($string, true);
	//echo print_r($json_a);
	
	$object_id = substr($file, 0, -4);
	$string = file_get_contents("Data/Metadata/$object_id.json");
	$json_a = json_decode($string, true);
	
	#$class = 'test';
	#foreach($json_a as $poster) {
	#	if (strcmp($poster[object][images][0][b][url], "https://images.collection.cooperhewitt.org/$file") == 0) {
	#		$class = strval(floor($poster[object][year_acquired]/10)*10);
	#	}
	#}
	
	$year = $json_a[object][date];
	$class = strval(floor($year/10)*10);
	$country = $json_a[object]["woe:country_name"];
	$pos = $json_a[object][title];
	if ($pos == "Poster") {
		$pos = "";
	}
	
	if ($country == "United States") {
		$country = "US";
	}
	if ($country == "United Kingdom") {
		$country = "UK";
	}
	if ($country == "New Zealand") {
		$country = "NZ";
	}
	if ($country == "Puerto Rico") {
		$country = "PR";
	}
	
	if($file=='.' || $file == '..') continue;
	
	$file_parts = explode('.',$file);
	$ext = strtolower(array_pop($file_parts));

	$title = implode('.',$file_parts);
	$title = htmlspecialchars($title);
	//echo $file;
	
	if(strval($year) != 0) {
	if(in_array($ext,$allowed_types))
	{
		echo '
		<div class="pic grid-item '.$class.' '.$country.'">
		<img class="lazy" src="'.$directory.'/'.$file.'" />
		<p><font size="2">'.$pos.'</font></p>
		<p class="year" style="display:none">'.strval($year).'</p>
		</div>';
		
		$i++;
	}
	}
}
closedir($dir_handle);

?>
</div>

<!--script>
$grid = $('.grid').isotope({
  // options
  itemSelector: '.grid-item',
  layoutMode: 'fitRows'
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
  postersFromThe50s: function() {
	  console.log('reached here');
	  return $(this).hasClass('1950');
  },
  postersFromThe60s: function() {
	  console.log('reached here');
	  return $(this).hasClass('1960');
  },
  postersFromThe70s: function() {
	  console.log('reached here');
	  return $(this).hasClass('1970');
  },
  postersFromThe80s: function() {
	  console.log('reached here');
	  return $(this).hasClass('1980');
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

/*$(function() {
    $("img.lazy").lazyload();
});*/
</script-->

<!--script>
var $grid = $('#gallery').imagesLoaded( function() {
  $grid.masonry({
    itemSelector: '.grid-item',
    percentPosition: true,
	columnWidth: '.grid-sizer',
	gutter: 10
	//columnWidth: 200
  });
});
</script>

<script type="text/javascript">
		$(document).ready(function() {
			$('.fancybox').fancybox({
				openEffect  : 'elastic',
				opacity     : 'true',
				overloayOpacity: '0.6'
			})
					});
</script-->

<!--<body>
	<h3>Masonry Test</h3>
	
	<div class="grid" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": 200 }'>
	  <div class="grid-sizer"></div>
	    <div class="grid-item">
	      <img src="/Data/Images/1.jpg" />
	    </div>
	    <div class="grid-item">
	      <img src="/Data/Images/2.jpg" />
	    </div>
	    <div class="grid-item">
	      <img src="/Data/Images/3.jpg" />
	    </div>
	    <div class="grid-item">
	      <img src="/Data/Images/4.jpg" />
	    </div>
	    <div class="grid-item">
	      <img src="/Data/Images/5.jpg" />
	    </div>
	    <div class="grid-item">
	      <img src="/Data/Images/6.jpg" />
	    </div>
	    <div class="grid-item">
	      <img src="/Data/Images/7.jpg" />
	    </div>
	    <div class="grid-item">
	      <img src="/Data/Images/8.jpg" />
	    </div>
	    <div class="grid-item">
	      <img src="/Data/Images/9.jpg" />
	    </div>
	    <div class="grid-item">
	      <img src="/Data/Images/10.jpg" />
	    </div>
		
		<div class="grid-item">
		  <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/orange-tree.jpg" />
		</div>
		<div class="grid-item">
		  <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/submerged.jpg" />
		</div>
		<div class="grid-item grid-item--width2">
		  <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/look-out.jpg" />
		</div>
		<div class="grid-item">
		  <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/one-world-trade.jpg" />
		</div>
		<div class="grid-item">
		  <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/drizzle.jpg" />
		</div>
		<div class="grid-item">
		  <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/cat-nose.jpg" />
		</div>
		<div class="grid-item">
		  <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/contrail.jpg" />
		</div>
		<div class="grid-item">
		  <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/golden-hour.jpg" />
		</div>
		<div class="grid-item">
		  <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/flight-formation.jpg" />
		</div>
	</div>
<a class="fancybox" title="'.$title.'" href="'.$directory.'/'.$file.'">
</body>-->
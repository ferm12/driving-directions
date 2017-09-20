<?php
    // This page needs to get the server time so I made it a PHP file instead of creating an AJAX call
    header("content-type: application/javascript");
    require_once("../../../../../wp-load.php");

    date_default_timezone_set('America/Los_Angeles');
    $date = new DateTime(null, new DateTimeZone('America/Los_Angeles'));
    $dst = gettimeofday();
    $dst = $dst['dsttime'];
    $pdt = $date->format('h:i:s A');
    $pt = $date->format('H:i:s');
?>

//JavaScript Document

(function () {
    "use strict";
    var californiaTime = new Date("<?php echo $date->format("m/d/Y h:i:s A"); ?>"),
        dst = <?php echo $dst; ?>,
        c = clock.createClock(californiaTime, dst),
		container = document.getElementById("dynamicClock");

	window.californiaTime = californiaTime;
	window.dst = dst;

    c.wind();
    container.appendChild(c.el);
    
	//loads google maps
	var map;
	var marker;
    var geocoder;
	var infoWindow;
	var gdir;
	var fromWhere;
	var tvLat;
	var tvLng;
	var fromLat;
	var fromLng;
	var dirResponse;

	function initialize() {
		geocoder = new google.maps.Geocoder();
		geocoder.geocode({'address' : '990 Villa Street, Mountain View, CA'}, function( results ){
			tvLat = results[0].geometry.location.lat();
			tvLng = results[0].geometry.location.lng();

			var mapOptions = {
        		center : new google.maps.LatLng( tvLat, tvLng ),
				zoom : 15,
				disableDefaultUI: true,
				zoomControl: true
				//mapTypeControl: true
			};

			map = new google.maps.Map( document.getElementById( "map-canvas" ), mapOptions );

			var markerOptions = {
				position: new google.maps.LatLng( tvLat, tvLng ),  
				visible: true,
				map: map
			} 
			marker = new google.maps.Marker( markerOptions );


			//check to see if an InfoWindow already exists
			if (!infoWindow){
				infoWindow = new google.maps.InfoWindow();
			}

			//infoWindow content
			var content = '<div id="info">' +
			'<a target="_blank" href="https://www.google.com/maps/preview?q=Transvideo+Studios&hl=en&sll=37.39488,-122.080819&sspn=0.014951,0.019097&hq=Transvideo+Studios&t=m&z=16&iwloc=A">' +
			'<img src="/wp-content/themes/transvideo/library/images/logos/tv_logo_small.png" title="Open on Google maps"/></a>' +
			'<div>990 Villa Street,<br/>Mountain View, CA</div>' +
			'</div>';

			infoWindow.setContent(content);
			infoWindow.setOptions({pixelOffset: new google.maps.Size(-1,40)});

			infoWindow.open(map, marker);
		});
	}

	function calculateRoute(tvLat, tvLng, fromLat, fromLng){
		var directionsService = new google.maps.DirectionsService();
        var directionsRequest = {
        		origin: new google.maps.LatLng( fromLat, fromLng ),
        		destination: new google.maps.LatLng( tvLat, tvLng ), 
        		travelMode: google.maps.DirectionsTravelMode.DRIVING,
         		unitSystem: google.maps.UnitSystem.METRIC
        };

        directionsService.route( directionsRequest, function(response, status){
			if (status == google.maps.DirectionsStatus.OK){
       			new google.maps.DirectionsRenderer({
           			map: map,
					directions: response,
					panel: document.getElementById('directions')
       			});
				
				
            } else {
              	$("#error").append("Unable to retrieve your route<br />");
			}
		});

		printDirections();

	}

	function printDirections(){
		$('#print-directions').show();
		var $printIcon = $("#print-icon");
		var $openGoogleMaps = $("#open-google-maps");
		$printIcon.on('click', function(){
			var mapCanvas = document.getElementById('map-canvas');
			var directions = document.getElementById('directions');
			var content = "<div style='position:relative;width:40%;height:30%;overflow:hidden;'>"+mapCanvas.innerHTML + "</div>" + "<div style='position:relative'>"+directions.innerHTML + "</div>";
//			var content = "<iframe id='printf' name='printf' width='30%' height='50%' frameborder='0' scrolling='yes' marginheight='0' marginwidth='0' src='http://maps.google.com/?saddr=" + tvLat + "," + tvLng + "&daddr=" + fromLat + "," + fromLng + "&output=embed'></iframe>" +
//			var content = "<div id='map-canvas' style='position:relative;width:50%;height:50%'></div>" +
//							"<br/><a id='print' href='javascript:void()'>Print</a>&nbsp;<a href='http://maps.google.com/?saddr=" + tvLat + "," + tvLng + "&daddr=" + fromLat + "," + fromLng + "'>View directions in Google Maps</a>" +
//							"<div style='position:relative'>"+directions.innerHTML + "</div><script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'></script><script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyBcRRaU9CAsTgE5h5_u1iArySQuO9FNExk&amp;sensor=false'></script><script src='http://tvtvitdev6.transvideo.com/wp-content/themes/transvideo/library/js/print.js'></script>";
	
//	<script> (function(){$(document).ready(function (){var mapOptions = {" +
//        					"center : new google.maps.LatLng(" + tvLat + "," + tvLng + ")," +
//							"zoom : 15," +
//							"disableDefaultUI: true," +
//							"zoomControl: true };" +
//							"map = new google.maps.Map( document.getElementById( 'map-canvas' ), mapOptions );" +
//							"})})(); </script>";

			var win = window.open();
			win.document.write(content);
			win.print();
			win.close();
		});

		$openGoogleMaps.on('click', function(){
			window.open("http://maps.google.com/?saddr=" + tvLat + "," + tvLng + "&daddr=" + fromLat + "," + fromLng);		
		});

		
	}

	function geocodeFromAddress (fromAddress) {
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({'address': fromAddress }, function(results, status) {
        	if (status == google.maps.GeocoderStatus.OK){
            	//document.getElementById("address").innerHTML = results[0].formatted_address;
				fromLat = results[0].geometry.location.lat();
				fromLng = results[0].geometry.location.lng();
			} else {
				document.getElementById("error").innerHTML += "Unable to retrieve your address" + "<br />";
			}
        });
	}


	var setVal = function() {
			var deferred = $.Deferred();

			google.maps.event.addDomListener(window, 'load', initialize);
				
			setTimeout(function(){
				deferred.resolve();
			},1000);

			return deferred.promise();
		};


	setVal().then(
		function(){
			//console.log(lat,lng);
   		},
    	function(){
   			console.log('fail to get transvideo lat and lng');
	});

	
	$("#calculate-route").submit(function(event) {
        $('#directions').empty();
/*
		if ($('.innerDirections').length != 0){
			console.log('innerDirectons exist');
			$('.innerDirections').remove();
		}
		console.log($('.innerDirections').length);
*/
  		event.preventDefault();
		
		var setVal = function() {
			var deferred = $.Deferred();
			geocodeFromAddress($('#fromAddress').val());
				
			setTimeout(function(){
				deferred.resolve();
			},1000);

			return deferred.promise();
		};

		setVal().then(
			function(){
				console.log(fromLat,fromLng);
				console.log(tvLat, tvLng);
				calculateRoute(tvLat, tvLng, fromLat, fromLng);
   			},
    		function(){
   				console.log('fail to get fromAddress lat and lng');
			});

	});


}());

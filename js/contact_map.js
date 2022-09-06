$(document).ready(function(){
	codeAddress();
})
var geocoder;
var map;
var infowindow;
var marker;
function codeAddress() { 

geocoder = new google.maps.Geocoder();
var myOptions = {
  zoom: 8,
  mapTypeId: google.maps.MapTypeId.ROADMAP
}
map = new google.maps.Map(document.getElementById("map_canvas1"), myOptions);
var alladdress = document.getElementById('haddress1').value;
var image = 'images/marker.png';

	geocoder.geocode({'address':alladdress}, function(results, status) {			
	  if (status == google.maps.GeocoderStatus.OK) {
		map.setCenter(results[0].geometry.location);
		var marker = new google.maps.Marker({
		map: map,
		icon: image, 
		position: results[0].geometry.location,
		draggable: false
		});
		var pos=results[0].geometry.location;
		attachMessage(marker, pos);
	  } else {
		//alert("Geocoder failed due to: " + status);
	  }
	});

} 

function attachMessage(marker, latLng) {
geocoder.geocode({'latLng': latLng}, function(results, status) {
  if (status == google.maps.GeocoderStatus.OK) {
		if (results[1]) {
		  var addr = results[1].formatted_address;
		  infowindow = new google.maps.InfoWindow({
				content: addr,
				size: new google.maps.Size(50,50)
		  });
		google.maps.event.addListener(marker, 'click', function() {
			map.setZoom(11);
			map.setCenter();  
			infowindow.open(map,marker);
		});
	} else {
	  //alert("No results found");
	}
  } else {
	//alert("Geocoder failed due to: " + status);
  }
});
}
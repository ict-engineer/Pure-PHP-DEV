<?php
ob_start();
session_start();
include_once 'includes/class.Main.php';

//Object initialization
$dbf = new User();

$val_trackinfo=$dbf->fetchSingle("tracking_system","tracking_no='$_REQUEST[trackingnumber]'");

//For Current Location of the route MAP===========
$cur_location=$val_trackinfo[route_location]; 

//For Starting Location of the route MAP==========
$start_city=$val_trackinfo[from_city];
$start_country=$val_trackinfo[from_country];
$start_location=$start_city."/".$start_country; 

//For Eding Location of the route MAP=============
$end_city=$val_trackinfo[to_city];
$end_country=$val_trackinfo[to_country];
$end_location=$end_city."/".$end_country; 
?>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<div id="map_canvas" style="width: 100%; height: 100%; border: 1px solid #999;";></div>
<body onLoad="initialize();";>	
<script type="text/javascript">
  var directionDisplay;
  var directionsService = new google.maps.DirectionsService();
  var map;

  function initialize() {
    directionsDisplay = new google.maps.DirectionsRenderer({suppressMarkers: true});
    var defaultview = new google.maps.LatLng(0,0);
    var myOptions = {
      zoom: 6,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      suppressMarkers: true,
      disableDefaultUI: true,
      draggableCursor: 'crosshair'
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    directionsDisplay.setMap(map);


    var waypts = [];
    var currentlocation = "<?php echo $cur_location;?>";
 
	if (currentlocation != "") {
	waypts.push({
		location:currentlocation,
		stopover:true});
	}

    var request = {
        origin: "<?php echo $start_location;?>", 
        destination: "<?php echo $end_location;?>",
        waypoints: waypts,
        optimizeWaypoints: true,
        travelMode: google.maps.DirectionsTravelMode.DRIVING
    };
    
    directionsService.route(request, function(response, status) {
      if (status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);
        var route = response.routes[0];
        
        if(route.legs.length == 1){
        
			makeMarker( route.legs[0].start_location, icons.start);
			makeMarker( route.legs[0].end_location, icons.end);
			
        } else {
			
			makeMarker( route.legs[0].start_location, icons.start);
			makeMarkerBounce( route.legs[0].end_location, icons.middle);
			makeMarker( route.legs[1].end_location, icons.end);
        }
      }
    });
    
    
 var icons = {
  start: new google.maps.MarkerImage(
   'img/start.png',
   new google.maps.Size( 44, 32 ),
   new google.maps.Point( 0, 0 ),
   new google.maps.Point( 10, 32 )
  ),
  middle: new google.maps.MarkerImage(
   'img/pause.png',
   new google.maps.Size( 44, 32 ),
   new google.maps.Point( 0, 0 ),
   new google.maps.Point( 10, 32 )
  ),
  end: new google.maps.MarkerImage(
   'img/stop.png',
   new google.maps.Size( 44, 32 ),
   new google.maps.Point( 0, 0 ),
   new google.maps.Point( 10, 32 )
  )
 };

 function makeMarker( position, icon) {
 new google.maps.Marker({
 position: position,
 animation: google.maps.Animation.DROP,
 map: map,
 icon: icon
 });  
 }
    

 function makeMarkerBounce( position, icon) {
 new google.maps.Marker({
 position: position,
 animation: google.maps.Animation.BOUNCE,
 map: map,
 icon: icon
 });  
 }
 
 }
</script>
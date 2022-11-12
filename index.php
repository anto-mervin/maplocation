<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="mapview.css">

<style type="text/css">
  html { height: 100% }
  body { height: 100%; margin: 0; padding: 0 }
  #map_canvas { height: 100% }
</style>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=">
</script>
 </head>

 <body onload="initialize()">
 <?php
// Include the database configuration file
require_once 'db_conn.php';

// Fetch the marker info from the database
$result = $conn->query("SELECT * FROM maploc");

// Fetch the info-window data from the database
$result2 = $conn->query("SELECT * FROM maploc");
?>
 <script type="text/javascript">

var locations = [
    <?php if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo '["'.$row['name'].'", '.$row['lat'].', '.$row['lon'].','.'"'.$row['desp'].'"'.',"'.$row['g_id'].'"'.'],';
            }
        }
        ?>
//   ['loan 1', 33.890542, 151.274856, 'address 1'],
//   ['loan 2', 33.923036, 151.259052, 'address 2'],
//   ['loan 3', 34.028249, 151.157507, 'address 3'],
//   ['loan 4', 33.80010128657071, 151.28747820854187, 'address 4'],
//   ['loan 5', 33.950198, 151.259302, 'address 5']
  ];

  function initialize() {
    var myOptions = {
      center: new google.maps.LatLng(33.890542, 151.274856),
      zoom: 8,
      mapTypeId: google.maps.MapTypeId.ROADMAP

    };
    var map = new google.maps.Map(document.getElementById("default"),
        myOptions);

    setMarkers(map,locations)

  }



  function setMarkers(map,locations){

      var marker, i

for (i = 0; i < locations.length; i++)
 {  

 var loan = locations[i][0]
 var lat = locations[i][1]
 var long = locations[i][2]
 var add =  locations[i][3]
 var id = locations[i][4]


 latlngset = new google.maps.LatLng(lat, long);
 

  var marker = new google.maps.Marker({  
          map: map, title: loan , position: latlngset  
        });
        map.setCenter(marker.getPosition())

		var content =  '<div class="map-info-window">';
        content += "<div class='p-1 text-center'><h3 class='h3text'>" + loan +  '</h3>' + "<p class='ptext'> " + add +"</p>"+"<a href='gallery.php?g_id="+id+"'  class='btn btn-primary'  > Explore </a>" ;  
		content +='</div>';
  var infowindow = new google.maps.InfoWindow()
//   infoWindow.setOptions({maxWidth:400});

google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
        return function() {
    
           infowindow.setContent(content);
           infowindow.open(map,marker);

           
        };
    })(marker,content,infowindow)); 

  }
  }



  </script>

  <div id="default" style="width:100%; height:100%"></div>
  
 </body>
  </html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- location-api -->

    <script type="text/javascript"
          src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5Jrp9PtHe0WapppUzxbIpMDWMAcV3qE4"></script>
  <script src="https://unpkg.com/location-picker/dist/location-picker.min.js"></script>
  <style type="text/css">
    #map {
      width: 80%;
      height: 480px;
    }
  </style>
</head>


</head>
<body>
<nav class="navbar navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="https://blogs.techsnapie.com/wp-content/uploads/2021/10/Untitled-50-x-50-px.png" alt="" width="30" height="24">
    </a>
  </div>
</nav>


<div class="container">
    <div class="row">
        <div class="col col-12 col-md-8 px-3 py-5">
        <div id="map"></div>
        </div>
        <div class="col col-12 col-md-4 py-5">
        <form action="adminpanel.php" method="POST"
            enctype="multipart/form-data">

            <div class="form-floating mb-3">
  <input type="name" class="form-control" id="floatingInput" name="name" placeholder="name@example.com">
  <label for="floatingInput">Name</label>
</div>
<div class="form-floating">
  <textarea class="form-control" placeholder="Enter the Description" id="floatingTextarea2" style="height: 200px" name="desp"></textarea>
  <label for="floatingTextarea2">Description</label>
</div>
            <input type="file" name="files[]" multiple class=" btn btn-primary mt-4">
            <br>
            <input type="submit" name="submit" value="Save" class="btn btn-success mt-2" >
    </form> 
        </div>
    </div>
</div>

<script>

function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/; domain=.example.com";
}


  // Get element references
  var onIdlePositionView = document.getElementById('onIdlePositionView');
  var map = document.getElementById('map');

  // Initialize LocationPicker plugin
  var lp = new locationPicker(map, {
    setCurrentPosition: true, // You can omit this, defaults to true
    lat: 8.18,
    lng: 77.4
  }, {
    zoom: 15 // You can set any google map options here, zoom defaults to 15
  });

  // Listen to map idle event, listening to idle event more accurate than listening to ondrag event
  google.maps.event.addListener(lp.map, 'idle', function (event) {
    // Get current location and show it in HTML
    var location = lp.getMarkerPosition();
    document.cookie = "lat="+location.lat;
    document.cookie = "lan="+location.lng;
    onIdlePositionView.innerHTML = 'The chosen location is ' + location.lat + ',' + location.lng;
  });
</script>

<?php
include 'db_conn.php';

if(isset($_POST['submit'])){
$lat=$_COOKIE["lat"];
$lng=$_COOKIE["lan"];
$name=$_POST['name'];
$desp=$_POST['desp'];
$uniqid=uniqid();
 // Count total files
 $countfiles = count($_FILES['files']['name']);

 // Looping all files
 for($i=0;$i<$countfiles;$i++){
   $filename = $_FILES['files']['name'][$i];
   
   // Upload file
   move_uploaded_file($_FILES['files']['tmp_name'][$i],'uploads/'.$filename);
   $sql = "INSERT INTO files (file_name,uploaded_on,g_id) VALUES ('$filename',NOW(),'$uniqid')";
    
   // Execute query
   mysqli_query($conn, $sql);

 


 }
 $sql = "INSERT INTO maploc (name,desp,g_id,lat,lon) VALUES ('$name','$desp','$uniqid','$lat','$lng')";

 $sqlcomment=mysqli_query($conn, $sql);
 if(!$sqlcomment)
 {
  echo '<script>alert("Something Goes Wrong!!!!")</script>';
  
 }
 else{
  echo '<script>alert("Data Inserted Successfully")</script>';
 }
}
?>









</body>
</html>
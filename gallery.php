<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>

     <!-- bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
  <span class="navbar-brand mx-auto my-3 h1" style="font-size:30px;"></span>
  </nav>
  <div class="container-fluid p-5">
   
  <?php
// Include the database configuration file
include 'db_conn.php';
$gid = $_GET['g_id'];
// Get images from the database
$query = $conn->query("SELECT file_name FROM files where g_id = '$gid'");
?>

<div class="d-flex align-items-center justify-content-center  flex-wrap">
<div class="row">


<?php
if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $imageURL = 'uploads/'.$row["file_name"];
?>
    <img src="<?php echo $imageURL; ?>" alt="" class='col col-xs-12 col-md-6 col-lg-4 shadow-lg bg-white rounded my-4 mx-1' data-aos="fade-up" data-aos-delay="300"  />
<?php }
}else{ ?>
    <p>No image(s) found...</p>
<?php } ?> 




</div>

<!-- As a heading -->

<script>
  AOS.init();
</script>

</div>
</div>
</body>
</html>
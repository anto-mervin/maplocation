<?php
include 'db_conn.php';

if(isset($_POST['submit'])){

$name=$_POST['name'];
$desp=$_POST['desp'];
 // Count total files
 $countfiles = count($_FILES['files']['name']);
 $uniqid=uniqid();
 // Looping all files
 for($i=0;$i<$countfiles;$i++){
   $filename = $_FILES['files']['name'][$i];
   
   // Upload file
   move_uploaded_file($_FILES['files']['tmp_name'][$i],'uploads/'.$filename);
   $sql = "INSERT INTO files (file_name,uploaded_on,g_id) VALUES ('$filename',NOW(),'$uniqid')";
    
   // Execute query
   mysqli_query($conn, $sql);
 }
} 
?>



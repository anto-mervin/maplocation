<?php 
include 'header.php';
include 'db_conn.php';
?>
<div>
    <h1>Overview</h1>
    <p>Here is some overview text.</p>
    
            <table class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Map</th>
            </tr>
        </thead>
        <tbody>
        <?php
    $data = "SELECT * FROM `maploc`";
    $result = mysqli_query($conn, $data);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck = 0) {
        echo "<script>alert('No Data Available'); </script>";
    }
  
    else {
        $count = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $title= $row['name'];
            $desc= $row['desp'];
            $lat= $row['lat'];
            $long = $row['lon'];
            $count = $count + 1;
            ?>
            <tr>
            <th scope="row"><?php echo $count; ?></th>
            <td><?php echo $title; ?></td>
            <td><?php echo $desc; ?></td>
            <td></td>
            </tr>
            <?php }} ?>
        </tbody>
        </table>
         
    </div>
    <?php
    include 'footer.php';
    ?>
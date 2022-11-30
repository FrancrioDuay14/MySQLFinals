<?php
    $con = mysqli_connect("localhost", "root", "", "shopdb");

    if($con === false )
        die("ERROR: Could not connect" . mysqli_connect_error());
?>  
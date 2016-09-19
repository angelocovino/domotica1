<?php
    include("include/dbmanagement.php");
    $color = $_GET['color'];
    $db= new dbmanagment();
    $db->opendatabase();
    $db->createDB();
    $db->insertColor("#" . $color);
?>
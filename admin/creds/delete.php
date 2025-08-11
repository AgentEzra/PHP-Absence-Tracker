<?php
include '../config/connect.php';

$id = $_GET['id'];

$query = "DELETE FROM absence_table_creds WHERE id = '$id'";
$result = mysqli_query($connect, $query);

header('location: ./read.php');
?>
<?php 
 
$koneksi = mysqli_connect("localhost", "dbadmin", "AditFerrySani1+", "db_pusatkebugaran"); 
 
if (!$koneksi) { 
    die("Koneksi gagal: " . mysqli_connect_error()); 
} 
 
?>

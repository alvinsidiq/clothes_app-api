<?php
$serverHost = "localhost";
$user ="root";
$password = "";
$database = "cloth_app";

$connectNow = new mysqli($serverHost, $user, $password, $database);


if($connectNow->connect_error){
  die("koneksi gagal " . $connectNow->connect_error);

};

echo "koneksi berhasil";
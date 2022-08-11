<?php
session_start();
if(!isset($_SESSION["login"])) {
  echo "<script>window.location.replace('http://localhost:8080/sarana_mandiri/login_admin.php'); </script>";
  exit;
  }

  $conn = mysqli_connect("localhost","root","","db_sarana_mandiri");
  $id = $_GET["id"];
  if (isset($_POST['ubah'])) {
    //ambil data input
    $asal = stripslashes($_POST['kota_asal']);
    $tujuan = stripslashes($_POST['kota_tujuan']);
    $cara = stripslashes($_POST['cara_kirim']);
    $harga = stripslashes($_POST['harga']);
    //ubah data
    $query = "UPDATE t_harga SET kota_asal='$asal',kota_tujuan='$tujuan',cara_kirim='$cara',harga=$harga WHERE id_harga= $id)";
    $result = mysqli_query($conn,$query);
    if (!$result) 
    echo "<script>alert('Ada Kesalahan Teknis !')
    window.location.replace('http://localhost:8080/sarana_mandiri/dashboard/informasi_harga_admin.php');
    </script>";
    else 
    echo "<script>alert('Data berhasil dimasukan !')
    window.location.replace('http://localhost:8080/sarana_mandiri/dashboard/informasi_harga_admin.php');
    </script>";
    }
    

  ?>

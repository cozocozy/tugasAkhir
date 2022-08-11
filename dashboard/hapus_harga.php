<?php
session_start();
if(!isset($_SESSION["login"])) {
  echo "<script>window.location.replace('http://localhost:8080/sarana_mandiri/login_admin.php'); </script>";
  exit;
  }

  $conn = mysqli_connect("localhost","root","","db_sarana_mandiri");
  $id = $_GET["id"];
  $delete =mysqli_query($conn, "DELETE FROM t_harga WHERE id_harga = $id");

   //cek berhasil atau tidak
  if (mysqli_affected_rows($conn) > 0 ) {
      echo " <script> alert ('data berhasil dihapus');
      window.location.replace('http://localhost:8080/sarana_mandiri/dashboard/informasi_harga_admin.php');
      </script>";
      
   } else
   echo "<script>
   alert('data gagal dihapus!');
   window.location.replace('http://localhost:8080/sarana_mandiri/dashboard/informasi_harga_admin.php');
   </script>";
  ?>

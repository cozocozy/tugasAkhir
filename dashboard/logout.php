<?php

session_start();
$_SESSION = [];
session_unset();
session_destroy();

echo "<script>window.location.replace('http://localhost:8080/sarana_mandiri'); </script>";
exit;
?>
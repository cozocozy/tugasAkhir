
<?php
session_start();
if(!isset($_SESSION["login"])) {
  echo "<script>alert('Harap login terlebih dahulu !')
  window.location.replace('http://localhost:8080/sarana_mandiri); </script>";
  exit;
}


$conn = mysqli_connect("localhost","root","","db_sarana_mandiri");
error_reporting(0);


  $sql =("SELECT * FROM t_pembayaran JOIN t_pemesanan ON t_pembayaran.id_pemesanan = t_pemesanan.id_pemesanan");
  $resulttgl = mysqli_query($conn,$sql);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" href="img/truck.svg" type="image/gif" sizes="50x50" />
    <title>Sarana Hasil Mandiri - User Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet" />
  </head>

    <div class="text-center text-lg mt-5 mb-5"><b>LAPORAN HASIL PEMBAYARAN SARANA HASIL MANDIRI</b></div>

                    <!-- DataTales Example -->
                    
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                            <div>
                                </div>
                                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                  <tr>
                                    <thead>
                                        <tr>
                                          <th>Tanggal Pembayaran</th>
                                          <th>Tanggal Pengiriman</th>
                                          <th>Status Pembayaran</th> 
                                          <th>Nomor Pemesanan</th>
                                          <th>Paket</th>
                                          <th>Harga</th>   
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    <tbody>
                                    <?php 
                                    $total= 0;
                                    while ($row = mysqli_fetch_assoc($resulttgl)) : ?>
                                      <tr>
                                        <td class="align-middle"><?= $row["tgl_pembayaran"]; ?></td>
                                        <td class="align-middle"><?= $row["tgl_pengiriman"]; ?></td>
                                        <td class="align-middle"><?= $row["status_pembayaran"]; ?></td>
                                        <?php
                                          $sql1 = ("SELECT * FROM t_pemesanan JOIN t_harga ON t_pemesanan.id_harga = t_harga.id_harga WHERE id_pemesanan = '$row[id_pemesanan]'");
                                          $data2 = mysqli_query($conn,$sql1);
                                          while ($datas = mysqli_fetch_assoc($data2)) :?>
                                          <td class="align-middle"><?= $datas["no_pemesanan"]; ?></td>
                                          <td class="align-middle"><?= $datas["paket"]; ?></td>
                                          <td class="align-middle"><?= $datas["harga"]; ?></td>
                                          <?php $total +=$datas["harga"]; ?> 
                                          <?php endwhile; ?>
                                         <?php endwhile; ?>
                                    </tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                       <th>TOTAL</th>
                                       <td><?php
                                        echo 'Rp. ' . $total;?> </td>
                                   </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
    <!-- main -->
    <script>
 window.print();
 </script>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
  </body>
</html>

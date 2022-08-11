
<?php
session_start();
if(!isset($_SESSION["login"])) {
  echo "<script>alert('Harap login terlebih dahulu !')
  window.location.replace('http://localhost:8080/sarana_mandiri); </script>";
  exit;
}


$conn = mysqli_connect("localhost","root","","db_sarana_mandiri");
error_reporting(0);

if(isset($_POST['filter'])){
  $tglawal = $_POST['date1'];
  $tglakhir = $_POST['date2'];
  // $sql =("SELECT * FROM t_pembayaran JOIN t_pemesanan ON t_pembayaran.id_pemesanan = t_pemesanan.id_pemesanan WHERE tgl_pembayaran = '$tgl'");
  $sql =("SELECT * FROM t_pembayaran JOIN t_pemesanan ON t_pembayaran.id_pemesanan = t_pemesanan.id_pemesanan WHERE tgl_pembayaran BETWEEN'" . $tglawal ."' AND'" . $tglakhir."'");
  $resulttgl = mysqli_query($conn,$sql);
}

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

  <body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard_user.php">
          <div class="sidebar-brand-icon">
            <i class="fas fa-car"></i>
          </div>
          <div class="sidebar-brand-text">Sarana Hasil Mandiri</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0" />

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
          <a class="nav-link" href="dashboard_admin.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Home</span></a
          >
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider" />
        <div class="sidebar-heading">Transaksi</div>

        <!--Nav informasi harga-->
        <li class="nav-item">
          <a class="nav-link" href="informasi_harga_admin.php">
            <i class="fas fa-clipboard-list"></i>
            <span>Daftar Paket</span>
          </a>
        </li>
         <!-- nav pemesanan -->
          <li class="nav-item">
          <a class="nav-link" href="pemesanan_admin.php">
          <i class="fas fa-calendar"></i>
            <span>Pemesanan</span>
          </a>
        </li> 
         <!-- Nav Pembayaran -->
        <li class="nav-item">
          <a class="nav-link" href="pembayaran_admin.php ">
          <i class="fas fa-dollar-sign"></i>
            <span>Pembayaran</span>
          </a>
        </li>
        <!-- nav surat -->
        <li class="nav-item">
          <a class="nav-link" href="laporan_admin.php">
          <i class="fas fa-file"></i>
            <span>Surat-Surat</span>
          </a>
        </li> 
                <!-- nav laporan -->
        <li class="nav-item">
          <a class="nav-link" href="laporan.php">
          <i class="fas fa-file"></i>
            <span>Laporan</span>
          </a>
        </li> 
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block" />

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
      </ul>
      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
          <!-- Topbar -->
          <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
              <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

              </li>

              <!-- Nav Item - User Information -->
              <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 large">adminshm
                  </span>
                  <img class="img-profile rounded-circle" src="img/undraw_profile.svg" />
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                  </a>
                </div>
              </li>
            </ul>
          </nav>
          <!-- End of Topbar -->

    <!-- main -->
    <div class="text-center text-lg mt-5 mb-5"><b>LAPORAN HASIL PEMBAYARAN SARANA HASIL MANDIRI</b></div>

                    <!-- DataTales Example -->
                    
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                            <div>
                                </div>
                                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                  <tr>
                                  
                                  <!-- form date -->
                                    <form action="" method="POST">
                                    <div class="form-group text-left">
                                      <label>Pilih Tanggal</label>
                                    <div class="form-group text-left">
                                      <input type="date" name="date1">
                                      <label class="text-lg mr-2 ml-1">sampai</label>
                                      <input type="date" name="date2">
                                      <button class="btn btn-secondary ml-1 mr-1" name="filter">Filter</button>
                                    </div>
                                    </form>
                                  </tr>
                                      <!-- form date -->
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
                                <a class="btn btn-success btn-md ml-1 mr-1" href="cetak.php">Cetak</a>
                            </div>
                        </div>
                    </div>

                </div>
    <!-- main -->

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Apakah anda ingin logout?</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-success" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>

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

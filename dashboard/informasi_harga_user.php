<?php
session_start();
if(!isset($_SESSION["login"])) {
  echo "<script>alert('Harap login terlebih dahulu !')
  window.location.replace('http://localhost:8080/sarana_mandiri/'); </script>";
  exit;
}

$conn = mysqli_connect("localhost","root","","db_sarana_mandiri");
error_reporting(0);

//ambil data tabel
$query =("SELECT * FROM t_harga");
$result = mysqli_query($conn,$query);


if (isset($_POST['pilih'])) {
  //ambil data input
  $pengirim = htmlspecialchars($_POST['nama_pengirim']);
  $penerima = htmlspecialchars($_POST['nama_penerima']);
  $almtpengirim = htmlspecialchars($_POST['alamat_pengirim']);
  $almtpenerima = htmlspecialchars($_POST['alamat_penerima']);
  $telppengirim = htmlspecialchars($_POST['telp_pengirim']);
  $telppenerima = htmlspecialchars($_POST['telp_penerima']);
  $plat = htmlspecialchars($_POST['no_plat']);
  $jenis = htmlspecialchars($_POST['jenis_mobil']);
  $mesin = htmlspecialchars($_POST['nomor_mesin']);
  $user = htmlspecialchars($_POST['nomor_mesin']);
  $id = htmlspecialchars($_POST['id']);
  $iduser = $_SESSION['id_user'];
  $date = date('ymdhis');
  $no_pemesanan = 'SHM-' . $date;
//input data
$query = "INSERT INTO t_pemesanan (no_pemesanan,id_harga,nama_pengirim,nama_penerima,alamat_pengirim,alamat_penerima,telp_pengirim,telp_penerima,no_plat,jenis_mobil,nomor_mesin,tgl_pemesanan,id_user)  VALUES ('$no_pemesanan',$id,'$pengirim','$penerima','$almtpengirim','$almtpenerima','$telppengirim','$telppenerima','$plat','$jenis','$mesin',now(),'$iduser')" ;
$result = mysqli_query($conn,$query); 
 if (!$result) 
echo "<script>alert('Ada Kesalahan Teknis !')
window.location.replace('http://localhost:8080/sarana_mandiri/dashboard/pemesanan_user.php');
</script>";
else 
echo "<script>alert('Paket berhasil dipilih, Silahkan lanjutkan tahap pembayaran dengan bukti pembayaran !')
window.location.replace('http://localhost:8080/sarana_mandiri/dashboard/pemesanan_user.php');
</script>";
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
        <!-- Custom styles for this page -->
        <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
          <a class="nav-link" href="dashboard_user.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Home</span></a
          >
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider" />
        <div class="sidebar-heading">Transaksi</div>

        <!--Nav informasi harga-->
        <li class="nav-item">
          <a class="nav-link" href="informasi_harga_user.php">
            <i class="fas fa-clipboard-list"></i>
            <span>Daftar Paket</span>
          </a>
        </li>

        <!-- Nav Pemesanan -->
        <li class="nav-item">
          <a class="nav-link" href="pemesanan_user.php">
          <i class="fas fa-calendar"></i>
            <span>Pemesanan</span>
          </a>
        </li> 
         <!-- Nav Pembayaran -->
        <li class="nav-item">
          <a class="nav-link" href="pembayaran_user.php">
          <i class="fas fa-dollar-sign"></i>
            <span>Pembayaran</span>
          </a>
        </li>
        <!-- nav laporan -->
        <li class="nav-item">
          <a class="nav-link" href="laporan_user.php">
          <i class="fas fa-file"></i>
            <span>Riwayat</span>
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
                <span class="mr-2 d-none d-lg-inline text-gray-600 large">
                   <?php
                   $query =("SELECT * FROM t_user WHERE id_user = ". $_SESSION['id_user']);
                  $resultid = mysqli_query($conn,$query);
                  ?>
                  <?php while ($row = mysqli_fetch_assoc($resultid)) : ?>
                  <?= $row["username"]; ?>
                  <?php endwhile; ?>
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
    <div class="text-center text-lg mt-5 mb-5"><b>DAFTAR PAKET JASA EKSPEDISI CV.SARANA HASIL MANDIRI</b></div>

                    <!-- DataTales Example -->
                    
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th >Paket</th>
                                            <th>Kota Asal</th>
                                            <th>Kota Tujuan</th>
                                            <th>Perkiraan Waktu</th>
                                            <th>Cara Kirim</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                      <tr>
                                        <td><?= $row["paket"]; ?></td>
                                        <td><?= $row["kota_asal"]; ?></td>
                                        <td><?= $row["kota_tujuan"]; ?></td>
                                        <td><?= $row["perkiraan_waktu"]; ?></td>
                                        <td><?= $row["cara_kirim"]; ?></td>
                                        <td><?= $row["harga"]; ?></td>
                                        <td><a href="" class="btn btn-info" data-toggle="modal" data-target="#pilihModal<?= $row["id_harga"]; ?>">Pilih Paket</a>
                                        
                                        <!-- ubah data form -->
                                        <div class="modal fade" id="pilihModal<?= $row["id_harga"]; ?>" role="dialog" aria-labelledby="modal" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered " role="document">
                                          <div class="modal-content">
                                            <div class="modal-header border-bottom-0">
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                                              <div aria-hidden="true"><i class="fas fa-times fa-lg"></i></div>
                                              </button>
                                                  </div>
                                                  <div class="form-title text-center">
                                                    <h2>Tambah Pemesanan</h2>
                                                  </div>
                                                  <div class="modal-body font-weight-bold">
                                                  <form action="" method="post">
                                                          <input type="hidden" name="id" value="<?= $row['id_harga']; ?>">
                                                          <div class="form-group text-left">
                                                                <label>Paket</label>
                                                                <input type="text" class="form-control" name="paket" value="<?= $row["paket"]; ?>" readonly>
                                                            </div>
                                                            <div class="form-group text-left">
                                                                <label>Kota Asal</label>
                                                                <input type="text" class="form-control" name="kota_asal" value="<?= $row['kota_asal']; ?>" readonly>
                                                            </div>
                                                            <div class="form-group text-left">
                                                                <label>Kota Tujuan</label>
                                                                <input type="text" class="form-control" name="kota_tujuan" value="<?= $row['kota_tujuan']; ?>" readonly>
                                                            </div>
                                                            <div class="form-group text-left">
                                                              <label>Perkiraan Waktu</label>
                                                              <input type="text" name="perkiraan_waktu" class="form-control" value="<?= $row['perkiraan_waktu']; ?>" readonly>
                                                          </div>
                                                            <div class="form-group text-left">
                                                                <label>Cara Kirim</label>
                                                                <input type="text" class="form-control" name="cara_kirim" value="<?= $row['cara_kirim']; ?>" readonly>
                                                            </div>
                                                            <div class="form-group text-left">
                                                                <label>Harga</label>
                                                                <input type="text" class="form-control" name="harga" value="<?= $row['harga']; ?>" readonly>
                                                            </div>
                                                            <div class="form-group text-left">
                                                              <label>Nama Pengirim</label>
                                                              <input type="text" name="nama_pengirim" class="form-control" required>
                                                          </div>
                                                          <div class="form-group text-left">
                                                              <label >Nama Penerima</label>
                                                              <input type="text" class="form-control" name="nama_penerima" required>
                                                          </div>
                                                          <div class="form-group text-left">
                                                          <label>Alamat Pengirim</label>
                                                              <input type="text" name="alamat_pengirim" class="form-control" required>
                                                          </div>
                                                          <div class="form-group text-left">
                                                              <label >Alamat Penerima</label>
                                                              <input type="text" class="form-control" name="alamat_penerima" required>
                                                          </div>
                                                          <div class="form-group text-left">
                                                          <label>Nomor Telepon Pengirim</label>
                                                              <input type="text" name="telp_pengirim" class="form-control" required>
                                                          </div>
                                                          <div class="form-group text-left">
                                                              <label >Nomor Telepon Penerima</label>
                                                              <input type="text" class="form-control" name="telp_penerima" required>
                                                          </div>
                                                          <div class="form-group text-left">
                                                              <label >Plat Nomor</label>
                                                              <input type="text" class="form-control" name="no_plat" required>
                                                          </div>
                                                          <div class="form-group text-left">
                                                              <label>Jenis mobil</label>
                                                              <input type="text" class="form-control" name="jenis_mobil" required>
                                                          </div>
                                                          <div class="form-group text-left">
                                                              <label>Nomor mesin</label>
                                                              <input type="text" class="form-control" name="nomor_mesin" required>
                                                          </div>
                                                          <button type="submit" value="pilih" name="pilih" class="btn btn-info btn-block btn-round btn-login">Pilih Paket</button>
                                                    </form>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <!-- akhir ubah data form -->
                                      </tr>
                                        <?php endwhile; ?>

                                    </tbody>
                                </table>
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
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <script src="js/demo/datatables-demo.js"></script>
  </body>
</html>

<?php
session_start();
if(!isset($_SESSION["login"])) {
  echo "<script>window.location.replace('http://localhost:8080/sarana_mandiri/login_admin.php'); </script>";
  exit;
}

$conn = mysqli_connect("localhost","root","","db_sarana_mandiri");
error_reporting(0);

//ambil data tabel
$query =("SELECT * FROM t_harga");
$result = mysqli_query($conn,$query);


if (isset($_POST['tambah'])) {
  //ambil data input
$paket = htmlspecialchars($_POST['paket']);
$asal = htmlspecialchars($_POST['kota_asal']);
$tujuan = htmlspecialchars($_POST['kota_tujuan']);
$waktu= htmlspecialchars($_POST['perkiraan_waktu']);
$cara = htmlspecialchars($_POST['cara_kirim']);
$harga = htmlspecialchars($_POST['harga']);
//input data
$query = "INSERT INTO t_harga (paket,kota_asal,kota_tujuan,perkiraan_waktu,cara_kirim,harga) VALUES ('$paket','$asal','$tujuan','$waktu','$cara',$harga)";
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

if (isset($_POST['ubah'])) {
  //ambil data input
  $id = $_POST['id'];
  $paket = htmlspecialchars($_POST['paket']);
  $asal = htmlspecialchars($_POST['kota_asal']);
  $tujuan = htmlspecialchars($_POST['kota_tujuan']);
  $waktu= htmlspecialchars($_POST['perkiraan_waktu']);
  $cara = htmlspecialchars($_POST['cara_kirim']);
  $harga = htmlspecialchars($_POST['harga']);
  //ubah data
  $query = "UPDATE t_harga SET paket='$paket',kota_asal='$asal',kota_tujuan='$tujuan',perkiraan_waktu='$waktu',cara_kirim='$cara',harga=$harga WHERE id_harga= $id";
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
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard_admin.php">
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
          <a class="nav-link" href="pembayaran_admin.php">
          <i class="fas fa-dollar-sign"></i>
            <span>Pembayaran</span>
          </a>
        </li> 
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

        <!-- Tambah data form -->
        <div class="modal fade" id="tambahModal" role="dialog" aria-labelledby="modal" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
              <div class="modal-header border-bottom-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                <div aria-hidden="true"><i class="fas fa-times fa-lg"></i></div>
                </button>
              </div>
              <div class="form-title text-center">
                <h2>Tambah Paket</h2>
              </div>
              <div class="modal-body font-weight-bold"">
                <!-- form -->
                <form action="" method="post">

                <div class="form-group">
                    <label>Paket</label>
                    <input type="text" name="paket"  class="form-control"required>
                  </div>
                  <div class="form-group">
                    <label>Kota Asal</label>
                    <input type="text" name="kota_asal"  class="form-control"  minlength="3" required>
                  </div>

                  <div class="form-group">
                    <label>Kota Tujuan</label>
                    <input type="text" name="kota_tujuan"  class="form-control"  minlength="3" required>
                  </div>
                  
                  <div class="form-group">
                    <label>Perkiraan waktu</label>
                    <input type="text" name="perkiraan_waktu"  class="form-control" minlength="3"  required>
                  </div>
                  <div class="form-group">
                    <label>Cara Kirim</label>
                    <select name="cara_kirim" class="form-control" required>
                      <option value="Driving">Driving</option>
                      <option value="Towing">Towing</option>
                      <option value="Car-carrier">Car-Carrier</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Harga</label>
                    <input type="text" name="harga"  class="form-control" minlength="3"  required>
                  </div>
                  <button type="submit" value="tambah" name="tambah" class="btn btn-success btn-block btn-round btn-login">Simpan</button>

                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- akhir tambah data form -->


    <!-- main -->
    <div class="text-center text-lg mt-5 mb-5"><b>DAFTAR PAKET JASA EKSPEDISI CV.SARANA HASIL MANDIRI</b></div>

                    <!-- DataTales Example -->
                    
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                            <div>
                                <a href="" class="btn btn-success mt-3 mb-3" data-toggle="modal" data-target="#tambahModal">Tambah</a>
                                </div>
                                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Paket</th>
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
                                        <td><a href="?id=<?= $row['id_harga']; ?>" class="btn btn-warning ml-1 mr-1"" data-toggle="modal" data-target="#editModal<?= $row["id_harga"]; ?>">Ubah</a>
                                        
                                        <!-- ubah data form -->
                                        <div class="modal fade" id="editModal<?= $row["id_harga"]; ?>" role="dialog" aria-labelledby="modal" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered " role="document">
                                          <div class="modal-content">
                                            <div class="modal-header border-bottom-0">
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                                              <div aria-hidden="true"><i class="fas fa-times fa-lg"></i></div>
                                              </button>
                                                  </div>
                                                  <div class="form-title text-center">
                                                    <h2>Ubah Paket</h2>
                                                  </div>
                                                  <div class="modal-body font-weight-bold">
                                                    <form action="" method="post">
                                                          <input type="hidden" name="id" value="<?= $row['id_harga']; ?>">
                                                          <div class="form-group text-left">
                                                              <label>Paket</label>
                                                              <input type="text" name="paket" class="form-control" value="<?= $row['paket']; ?>" required>
                                                          </div>
                                                          <div class="form-group text-left">
                                                              <label>Kota Asal</label>
                                                              <input type="text" name="kota_asal" class="form-control" value="<?= $row['kota_asal']; ?>" required>
                                                          </div>
                                                          <div class="form-group text-left">
                                                              <label >Kota Tujuan</label>
                                                              <input type="text" class="form-control" name="kota_tujuan" value="<?= $row['kota_tujuan']; ?>" required>
                                                          </div>
                                                          <div class="form-group text-left">
                                                              <label>Perkiraan Waktu</label>
                                                              <input type="text" name="perkiraan_waktu" class="form-control" value="<?= $row['perkiraan_waktu']; ?>" required>
                                                          </div>
                                                          <div class="form-group text-left">
                                                              <div class="form-group">
                                                              <label>Cara Kirim</label>
                                                              <select name="cara_kirim" class="form-control" required>
                                                                <option value="Driving">Driving</option>
                                                                <option value="Towing">Towing</option>
                                                              </select>
                                                            </div>
                                                          </div>
                                                          <div class="form-group text-left">
                                                              <label>Harga</label>
                                                              <input type="text" class="form-control" name="harga" value="<?= $row['harga']; ?>" required>
                                                          </div>
                                                          <button type="submit" value="ubah" name="ubah" class="btn btn-warning btn-block btn-round btn-login">Ubah</button>
                                                    </form>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <!-- akhir ubah data form -->

                                      <a href="hapus_harga.php?id=<?= $row['id_harga']; ?>" class="btn btn-danger ml-1 mr-1" name="hapus" onclick="return confirm('anda yakin?');">Hapus</a></td>
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
            <a class="btn btn-success" href="logout_admin.php">Logout</a>
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

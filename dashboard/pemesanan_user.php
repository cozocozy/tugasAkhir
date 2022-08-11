
<?php
session_start();
if(!isset($_SESSION["login"])) {
  echo "<script>alert('Harap login terlebih dahulu !')
  window.location.replace('http://localhost:8080/sarana_mandiri); </script>";
  exit;

}


$conn = mysqli_connect("localhost","root","","db_sarana_mandiri");
error_reporting(0);

//ambil data tabel
$query =("SELECT * FROM t_pemesanan JOIN t_harga ON t_pemesanan.id_harga = t_harga.id_harga WHERE id_user = " . $_SESSION['id_user']);
$result = mysqli_query($conn,$query);


if (isset($_POST['ubah'])) {
  //ambil data input
  $id = $_POST['id'];
  $pengirim = htmlspecialchars($_POST['nama_pengirim']);
  $penerima = htmlspecialchars($_POST['nama_penerima']);
  $almtpengirim = htmlspecialchars($_POST['alamat_pengirim']);
  $almtpenerima = htmlspecialchars($_POST['alamat_penerima']);
  $telppengirim = htmlspecialchars($_POST['telp_pengirim']);
  $telppenerima = htmlspecialchars($_POST['telp_penerima']);
  $jenis = htmlspecialchars($_POST['jenis_mobil']);
  $mesin = htmlspecialchars($_POST['nomor_mesin']);
  $plat= htmlspecialchars($_POST['no_plat']);
  //ubah data
  $query = "UPDATE t_pemesanan SET nama_pengirim='$pengirim',nama_penerima='$penerima',alamat_pengirim='$almtpengirim',alamat_penerima='$almtpenerima',telp_pengirim='$telppengirim',telp_penerima='$telppenerima',no_plat='$plat',jenis_mobil='$jenis',nomor_mesin='$mesin' WHERE id_pemesanan= $id";
  $result = mysqli_query($conn,$query);
  if (!$result) 
  echo "<script>alert('Ada Kesalahan Teknis !')
  window.location.replace('http://localhost:8080/sarana_mandiri/dashboard/pemesanan_user.php');
  </script>";
  else 
  echo "<script>alert('Data berhasil diubah !')
  window.location.replace('http://localhost:8080/sarana_mandiri/dashboard/pemesanan_user.php');
  </script>";
  
}

if (isset($_POST['bayar'])) {
  //ambil data input
$tgl = htmlspecialchars($_POST['tgl_pengiriman']);
$iduser = $_SESSION['id_user'];
$ids = $_POST['ids'];
$namaFile = $_FILES['bukti']['name'];
$temp = $_FILES['bukti']['tmp_name'];
$dir = "bukti/pembayaran/";
$newFile = date("dmy").time().$namaFile;

//pindah file 
move_uploaded_file($temp, $dir.$newFile);

//input data
$file = "INSERT INTO t_pembayaran (id_pemesanan,bukti_pembayaran,tgl_pembayaran,tgl_pengiriman,status_pembayaran,id_user) VALUES ('$ids','$newFile',now(),'$tgl','Belum terkonfirmasi','$iduser')" ;
$hasil = mysqli_query($conn,$file);
if (!$result) 
echo "<script>alert('Ada Kesalahan Teknis !')
window.location.replace('http://localhost:8080/sarana_mandiri/dashboard/pembayaran_user.php');
</script>";
else 
echo "<script>alert('Upload berhasil !')
window.location.replace('http://localhost:8080/sarana_mandiri/dashboard/pembayaran_user.php');
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
          <a class="nav-link" href="http://localhost:8080/sarana_mandiri/dashboard/pembayaran_user.php">
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
                  <div class="dropdown-divider"></div>
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
    <div class="text-center text-lg mt-5 mb-5"><b>TABEL PEMESANAN SARANA HASIL MANDIRI</b></div>

                    <!-- DataTales Example -->
                    <div class="text-center text-uppercase font-weight-bold mb-2">Silahkan Upload bukti pembayaran melalui bank<br>kirim ke Bank BCA a/n CV.Sarana Hasil Mandiri dengan no.rekening 1234567890</div>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                            <div>
                                <a href="http://localhost:8080/sarana_mandiri/dashboard/informasi_harga_user.php" class="btn btn-success mt-3 mb-3">Tambah</a>
                                </div>
                                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th th class="align-middle">Nomor Pemesanan</th>
                                            <th class="align-middle">Paket</th>
                                            <th class="align-middle">Tanggal Pemesanan</th>
                                            <th class="align-middle">Nama Pengirim</th>
                                            <th class="align-middle">Nama Penerima</th>
                                            <th class="align-middle">Kota Asal</th>
                                            <th class="align-middle">Kota Tujuan</th>
                                            <th class="align-middle">Cara Kirim</th>
                                            <th class="align-middle">Harga</th>
                                            <th class="align-middle">Rincian</th>
                                            <th class="align-middle">Aksi</th>  
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                      <tr >
                                      <td class="align-middle"><?= $row["no_pemesanan"]; ?></td>
                                       <td class="align-middle"><?= $row["paket"]; ?></td>
                                         <td class="align-middle"><?= $row["tgl_pemesanan"]; ?></td>
                                        <td class="align-middle"><?= $row["nama_pengirim"]; ?></td>
                                        <td class="align-middle"><?= $row["nama_penerima"]; ?></td>
                                        <td class="align-middle"><?= $row["kota_asal"]; ?></td>
                                        <td class="align-middle"><?= $row["kota_tujuan"]; ?></td>
                                        <td class="align-middle"><?= $row["cara_kirim"]; ?></td>
                                        <td class="align-middle"><?= $row["harga"]; ?></td>
                                        <td class="align-middle">
                                        <a href="?id=<?= $row['id_pemesanan']; ?>" class="btn btn-info ml-1 mr-1" data-toggle="modal" data-target="#rinciModal<?= $row["id_pemesanan"]; ?>">Rincian</a>
                                       
                                        <!-- rincian data form -->
                                        <div class="modal fade" id="rinciModal<?= $row["id_pemesanan"]; ?>" role="dialog" aria-labelledby="modal" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered " role="document">
                                          <div class="modal-content">
                                            <div class="modal-header border-bottom-0">
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                                              <div aria-hidden="true"><i class="fas fa-times fa-lg"></i></div>
                                              </button>
                                                  </div>
                                                  <div class="form-title text-center">
                                                    <h2>Rincian Pesanan</h2>
                                                  </div>
                                                  <div class="modal-body font-weight-bold">
                                                    <form action="" method="post">
                                                          <input type="hidden" name="id" value="<?= $data['id_pemesanan']; ?>">
                                                          <div class="form-group text-left">
                                                          <label>Paket</label>
                                                              <input type="text" name="no_pemesanan" class="form-control" value="<?= $row['no_pemesanan']; ?>" readonly>
                                                          </div>
                                                          <div class="form-group text-left">
                                                          <label>Paket</label>
                                                              <input type="text" name="paket" class="form-control" value="<?= $row['paket']; ?>" readonly>
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
                                                              <input type="text" class="form-control" name="perkiraan_waktu" value="<?= $row['perkiraan_waktu']; ?>" readonly>
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
                                                              <input type="text" name="nama_pengirim" class="form-control" value="<?= $row['nama_pengirim']; ?>" readonly>
                                                            </div>
                                                          <div class="form-group text-left">
                                                              <label >Nama Penerima</label>
                                                              <input type="text" class="form-control" name="nama_penerima" value="<?= $row['nama_penerima']; ?>" readonly>
                                                          </div>
                                                          <div class="form-group text-left">
                                                              <label>Alamat Pengirim</label>
                                                              <input type="text" name="alamat_pengirim" class="form-control" value="<?= $row['alamat_pengirim']; ?>" readonly>
                                                            </div>
                                                          <div class="form-group text-left">
                                                              <label >Alamat Penerima</label>
                                                              <input type="text" class="form-control" name="alamat_penerima" value="<?= $row['alamat_penerima']; ?>" readonly>
                                                          </div>
                                                          <div class="form-group text-left">
                                                              <label>Nomor Telepon Pengirim</label>
                                                              <input type="text" name="telp_pengirim" class="form-control" value="<?= $row['telp_pengirim']; ?>" readonly>
                                                            </div>
                                                          <div class="form-group text-left">
                                                              <label >Nomor Telepon Penerima</label>
                                                              <input type="text" class="form-control" name="telp_penerima" value="<?= $row['telp_penerima']; ?>" readonly>
                                                          </div>
                                                          <div class="form-group text-left">
                                                              <label>Plat Nomor</label>
                                                              <input type="text" class="form-control" name="no_plat" value="<?= $row['no_plat']; ?>" readonly>
                                                          </div>
                                                          <div class="form-group text-left">
                                                              <label>Jenis mobil</label>
                                                              <input type="text" class="form-control" name="jenis_mobil" value="<?= $row['jenis_mobil']; ?>" readonly>
                                                          </div>
                                                          <div class="form-group text-left">
                                                              <label>Nomor mesin</label>
                                                              <input type="text" class="form-control" name="nomor_mesin" value="<?= $row['nomor_mesin']; ?>" readonly>
                                                          </div>
                                                    </form>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <!-- akhir rincian data form -->
                                    </td>
                                        <td class="align-middle">
                                          <a href="?id=<?= $row['id_pemesanan']; ?>" class="btn btn-secondary mt-2 ml-1 mr-1" data-toggle="modal" data-target="#bayarModal<?= $row["id_pemesanan"]; ?>">Bayar</a>

                                        <!-- bayar form -->
                                        <div class="modal fade" id="bayarModal<?= $row["id_pemesanan"]; ?>" role="dialog" aria-labelledby="modal" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered " role="document">
                                          <div class="modal-content">
                                            <div class="modal-header border-bottom-0">
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                                              <div aria-hidden="true"><i class="fas fa-times fa-lg"></i></div>
                                              </button>
                                                  </div>
                                                  <div class="form-title text-center">
                                                    <h2>Bukti Pembayaran</h2>
                                                  </div>
                                                  <div class="modal-body font-weight-bold">       
                                                    <form action="" method="post" enctype="multipart/form-data">
                                                          <input type="hidden" name="ids" value="<?= $row['id_pemesanan']; ?>">
                                                          <div class="form-group text-left">
                                                              <input type="hidden" name="tanggal" class="form-control">
                                                          </div>
                                                          <div class="form-group text-left">
                                                             <label>Tanggal Pengiriman</label>
                                                              <input type="date" name="tgl_pengiriman" value="2022-01-01" class="form-control">
                                                          </div>
                                                          <div class="form-group text-left">
                                                              <label>Upload Bukti</label>
                                                              <input type="file" name="bukti" class="form-control" required>
                                                          </div>
                                                          <button type="submit" value="bayar" name="bayar" class="btn btn-info btn-block btn-round btn-login">Upload</button>
                                                    </form>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <!-- akhir bayar form -->
                                      <a href="?id=<?= $row['id_pemesanan']; ?>" class="btn btn-warning ml-1 mr-1 mt-2"" data-toggle="modal" data-target="#editModal<?= $row["id_pemesanan"]; ?>">Ubah</a>
                                       
                                        <!-- ubah data form -->
                                        <div class="modal fade" id="editModal<?= $row["id_pemesanan"]; ?>" role="dialog" aria-labelledby="modal" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered " role="document">
                                          <div class="modal-content">
                                            <div class="modal-header border-bottom-0">
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                                              <div aria-hidden="true"><i class="fas fa-times fa-lg"></i></div>
                                              </button>
                                                  </div>
                                                  <div class="form-title text-center">
                                                    <h2>Ubah Pesanan</h2>
                                                  </div>
                                                  <div class="modal-body font-weight-bold">
                                                    <form action="" method="post">
                                                          <input type="hidden" name="id" value="<?= $row['id_pemesanan']; ?>">
                                                          <div class="form-group text-left">
                                                              <label>Paket</label>
                                                              <input type="text" name="paket" class="form-control" value="<?= $row['paket']; ?>" readonly>
                                                          </div>
                                                          <div class="form-group text-left">
                                                              <label>Tanggal Pemesanan</label>
                                                              <input type="text" name="paket" class="form-control" value="<?= $row['tgl_pemesanan']; ?>" readonly>
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
                                                            <input type="text" class="form-control" name="perkiraan_waktu" value="<?= $row['perkiraan_waktu']; ?>" readonly>
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
                                                              <input type="text" name="nama_pengirim" class="form-control" value="<?= $row['nama_pengirim']; ?>" required>
                                                            </div>
                                                          <div class="form-group text-left">
                                                              <label >Nama Penerima</label>
                                                              <input type="text" class="form-control" name="nama_penerima" value="<?= $row['nama_penerima']; ?>" required>
                                                          </div>
                                                          <div class="form-group text-left">
                                                              <label>Alamat Pengirim</label>
                                                              <input type="text" name="alamat_pengirim" class="form-control" value="<?= $row['alamat_pengirim']; ?>" required>
                                                            </div>
                                                          <div class="form-group text-left">
                                                              <label >Alamat Penerima</label>
                                                              <input type="text" class="form-control" name="alamat_penerima" value="<?= $row['alamat_penerima']; ?>" required>
                                                          </div>
                                                          <div class="form-group text-left">
                                                              <label>Nomor Telepon Pengirim</label>
                                                              <input type="text" name="telp_pengirim" class="form-control" value="<?= $row['telp_pengirim']; ?>" required>
                                                            </div>
                                                          <div class="form-group text-left">
                                                              <label >Nomor Telepon Penerima</label>
                                                              <input type="text" class="form-control" name="telp_penerima" value="<?= $row['telp_penerima']; ?>" required>
                                                          </div>
                                                          <div class="form-group text-left">
                                                              <label>Plat Nomor</label>
                                                              <input type="text" class="form-control" name="no_plat" value="<?= $row['no_plat']; ?>" required>
                                                          </div>
                                                          <div class="form-group text-left">
                                                              <label>Jenis mobil</label>
                                                              <input type="text" class="form-control" name="jenis_mobil" value="<?= $row['jenis_mobil']; ?>" required>
                                                          </div>
                                                          <div class="form-group text-left">
                                                              <label>Nomor mesin</label>
                                                              <input type="text" class="form-control" name="nomor_mesin" value="<?= $row['nomor_mesin']; ?>" required>
                                                          </div>
                                                          <button type="submit" value="ubah" name="ubah" class="btn btn-warning btn-block btn-round btn-login">Ubah</button>
                                                    </form>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <!-- akhir ubah data form -->
                                      <br>
                                      <a href="hapus_pemesanan.php?id=<?= $row['id_pemesanan']; ?>" class="btn btn-danger mt-2 ml-1 mr-1" name="hapus" onclick="return confirm('anda yakin?');">Hapus</a></td>
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

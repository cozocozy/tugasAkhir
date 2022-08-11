
      <?php
      
        $conn = mysqli_connect("localhost","root","","db_sarana_mandiri");
        error_reporting(0);

        // daftar 
        if (isset($_POST['daftar'])) {
            //ambil data dari registrasi
          $nama = htmlspecialchars($_POST['nama_user']);
          $username = htmlspecialchars($_POST['username']);
          $password1 = mysqli_real_escape_string($conn ,$_POST['password1']);
          $password2 = mysqli_real_escape_string($conn ,$_POST['password2']);
          $no_telp = htmlspecialchars($_POST['no_telp']);
          
          $user = "SELECT username FROM t_user WHERE username='$username'";
          $cekuser = mysqli_query($conn,$user); 
          
          //cek username
            if (mysqli_fetch_assoc($cekuser)) {
                echo "<script>alert('Username Telah Terpakai !');
                window.location.replace('http://localhost:8080/sarana_mandiri'); </script>";
                exit;
            }
            //cek konfirmasi password
          if( $password1 !== $password2 ) {
            echo "<script>alert('Password Tidak Sesuai !');
            window.location.replace('http://localhost:8080/sarana_mandiri'); </script>";
                exit;
            } 
            //enkripsi password
            $password =password_hash($password1, PASSWORD_DEFAULT);

            //input data
            $query = "INSERT INTO t_user (nama_user,username,password,no_telp) VALUES ('$nama','$username','$password','$no_telp')";
            $result = mysqli_query($conn,$query); 
            if (!$result) 
            echo "<script>alert('Ada Kesalahan Teknis !');
            window.location.replace('http://localhost:8080/sarana_mandiri'); </script>";
            else 
            echo "<script>alert('Pendaftaran Berhasil !');
            window.location.replace('http://localhost:8080/sarana_mandiri'); </script>";
          }

          // login
          session_start();
          if (isset($_POST['login'])) {
            //ambil data dari registrasi
            $username = $_POST["username"];
            $password = $_POST["password"];

            if($username === 'adminshm' && $password === 'shm123456789') {
              // set session
              $_SESSION["login"] = true;
             echo "<script>window.location.replace('http://localhost:8080/sarana_mandiri/dashboard/dashboard_admin.php'); </script>";
            exit;
          }
            $user = "SELECT * FROM t_user WHERE username='$username'"; 
            $cekuser = mysqli_query($conn,$user);

            //cek user
            if(mysqli_num_rows($cekuser) == 1) {
                //cek password
                $row = mysqli_fetch_assoc($cekuser);
                if (password_verify($password,$row["password"])) {
                    // set session
                     $_SESSION["login"] = true;
                     $_SESSION['id_user'] = $row['id_user'];
                    echo "<script>window.location.replace('http://localhost:8080/sarana_mandiri/dashboard/dashboard_user.php'); </script>";
                    exit;
                   
            }
          }  echo "<script>alert('Username atau Password anda salah !');</script>";
        }
        ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
    <!-- Myfonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Source+Sans+Pro:wght@200&family=Viga&display=swap" rel="stylesheet" />
    <!-- My CSS -->
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="img/truck.svg" type="image/gif" sizes="50x50" />
    <title>CV Sarana Hasil Mandiri</title>
  </head>
  <body>

    <!-- scroll -->
    <button onclick="topFunction()" id="myBtn" title="Balik ke atas"><i class="fa-regular fa-circle-up fa-2x scroll-up"></i></button>
    <!-- akhir scroll -->

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navigation">
      <div class="container">
        <a class="navbar-brand" href="#"><i class="fas fa-car"></i></a>
        <a class="logo" href="#">Sarana Hasil Mandiri</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ml-auto">
            <a class="nav-item nav-link active" href="#home">Home <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="#layanan">Layanan</a>
            <a class="nav-item nav-link" href="#about">Tentang Kami</a>
            <a class="nav-item nav-link" href="#kontak">Kontak Kami</a>
          </div>
        </div>
      </div>
    </nav>
    <!-- akhir navbar -->


    <!-- home -->
    <div class="jumbotron jumbotron-fluid home">
      <div class="container">
        <div class="row">
          <div class="col-7 text">
            Jasa <span>Ekspedisi</span> Sarana Hasil <span>Mandiri</span><br />
            <h5>
              Jasa pengiriman kendaraan ke seluruh Indonesia.<br />
              Dengan mengedepankan pelayanan dan kepuasan terhadap konsumen.
            </h5>
            <button class="btn button" data-toggle="modal" data-target="#loginModal">Daftar atau Login disini&ensp; <i class="fa-solid fa-angles-right"></i></button>
          </div>
          <div class="col-4"><img src="img/destination.svg" alt="heading" />
          </div>
        </div>

        <!-- login form -->
        <div class="modal fade" id="loginModal" role="dialog" aria-labelledby="modal" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
              <div class="modal-header border-bottom-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                <div aria-hidden="true"><i class="fas fa-times fa-lg"></i></div>
                </button>
              </div>
              <div class="form-title text-center">
                <h2>Login</h2>
              </div>
              <div class="modal-body">
                <!-- form -->
                <form action="" method="post">

                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan username anda.." required>
                  </div>

                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password anda.." required>
                  </div>

                  <button type="submit" name="login" value="login" class="btn btn-info btn-block btn-round btn-login">Login</button>

                  <div class="modal-footer footer-text">
                    <div class="modal-footer d-flex justify-content-center">
                      <div class="text-login">belum terdaftar ?</div>
                    </div>
                   <button type="submit" class="btn btn-info btn-switch" data-toggle="modal" data-target="#daftarModal" data-dismiss="modal">
                   Daftar
                   </button>
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- akhir login form -->

        <!-- daftar form -->

        <div class="modal fade" id="daftarModal" role="dialog" aria-labelledby="modal" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header border-bottom-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                <div aria-hidden="true"><i class="fas fa-times fa-lg"></i></div>
                </button>
              </div>
              <div class="form-title text-center">
                <h2>Daftar</h2>
              </div>
              <div class="modal-body">

                <!-- form -->
                <form action="" method="post">

                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama_user"  class="form-control"  minlength="3" required>
                  </div>

                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username"  class="form-control"  minlength="3" required>
                  </div>

                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password1"  class="form-control" minlength="3"  required>
                  </div>

                  <div class="form-group">
                    <label>Ulangi Password</label>
                    <input type="password" name="password2"  class="form-control" minlength="3"  required>
                  </div>

                  <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="number" name="no_telp"  class="form-control"  minlength="10" required>
                  </div>

                  <button type="submit" value="daftar" name="daftar" class="btn btn-info btn-block btn-round btn-login">Daftar</button>

                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- daftar form -->
      </div>
    </div>
    <!-- akhir home -->
    


    <!-- layanan -->
    <div class="jumbotron jumbotron-fluid layanan" id="layanan">
      <div class="container">
        <h1>Layanan</h1>
        <div class="row justify-content-center">
          <div class="col-lg content-layanan">
            <img src="img/door.svg" alt="door" class="float-left" />
            <h4>Door to door</h4>
            <p>Tim kami siap menjemput ke rumah, kendaraan yang anda akan kirimkan. Jadi anda tidak perlu repot-repot keluar rumah</p>
          </div>
          <div class="col-lg content-layanan">
            <img src="img/truck.svg" alt="truck" class="float-left" />
            <h4>Pool to pool</h4>
            <p>Siap menerima unit di pool kami, untuk di kirimkan ke daerah lain dan pengambilan akan dilakukan di pool daerah tersebut.</p>
          </div>
          <div class="col-lg-10 content-layanan">
            <img src="img/ship.svg" alt="ship" class="float-left" />
            <h4>Door to port</h4>
            <p>Tim kami siap akan mengantarkan kendaraan anda menuju pelabuhan atau sebaliknya.</p>
          </div>
        </div>
      </div>
    </div>
    <!-- akhir Layanan -->


    <!-- about  -->
    <div class="jumbotron jumbotron-fluid about" id="about">
      <div class="container">
        <h1>Tentang Kami</h1>
        <div class="row">
          <div class="col"><img src="img/about.svg" alt="about" class="image-about" /></div>
          <div class="col">
            <h5>
              &ensp;&ensp;  <span style="font-size: larger;"><i><b>CV. Sarana Hasil Mandiri</i></b></span> adalah perusahaan yang bergerak di bidang jasa ekspedisi kendaraan. Berdirinya perusahaan ini di awali pada saat kami berorientasi ke pabrik – pabrik besar maupun dealer mobil di sekitar daerah Jabodetabek ataupun yang berada di luar Jabodetabek. Maka kami mendirikan jasa transportasi ini untuk mendukung sarana dan prasarana bagi mereka, untuk memudahkan pengangkutan dari pabrik sampai ke dealer mobil yang di tuju.
          </div>
        </div>
      </div>
    </div>


    <!--contact us -->
    <div class="jumbotron jumbotron-fluid kontak" id="kontak">
      <div class="container">
        <h1>Kontak Kami</h1>
        <div class="row">
          <div class="col-lg lokasi">
            <i class="fa-solid fa-location-dot fa-2x"></i>  
            <h5>
              Perum Bulak Kapal permai, Blok EE no 44, Bekasi, Jawa Barat
            </h5>
          </div>
          <div class="col-lg whatsapp">
            <i class="fa-brands fa-whatsapp whatsapp fa-2x"></i>
            <h5>
              081333440008
            </h5>
          </div>
          <div class="col-lg email">
            <i class="fa-regular fa-envelope email fa-2x"></i>
            <h5>
              saranahasilmandiri@gmail.com
            </h5>
          </div>
        </div>
      </div>
    </div>
    <!-- akhir contact us -->

    <!-- footer -->
    <div class="jumbotron jumbotron-fluid footer">
      <div class="container">
        <h3>
          CV. Sarana Hasil Mandiri
        </h3>
        <h4>
          Copyright <i class="far fa-copyright"></i> 2021 All rights reserved | Designed by Septian Hadi P
        </h4>
      </div>
    </div>



    <!-- akhir footer -->

    <!-- scroll javascript -->
    <script>
      //go top function 
      //Get the button
      var mybutton = document.getElementById("myBtn");
      
      // When the user scrolls down 20px from the top of the document, show the button
      window.onscroll = function() {scrollFunction()};
      
      function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
          mybutton.style.display = "block";
        } else {
          mybutton.style.display = "none";
        }
      }
      
      // When the user clicks on the button, scroll to the top of the document
      function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
      }

     </script>
    <!-- akhir scroll -->


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>

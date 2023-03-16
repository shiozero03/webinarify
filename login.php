<?php 
  include('php/session-login.php');
  include('header.php');
?>

<?php
  if (isset($_POST['masuk'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $token = base64_encode(random_bytes(32));
    $queryUsername = mysqli_query($conn, "SELECT * FROM user WHERE username = '".$user."'");
    $queryEmail = mysqli_query($conn, "SELECT * FROM user WHERE email_user = '".$user."'");
    if(mysqli_num_rows($queryUsername) > 0){
      $resUser = mysqli_fetch_assoc($queryUsername);
      if(password_verify($pass, $resUser['password'])){
        $_SESSION['id_user'] = $resUser['id_user'];
        echo '
          <script>
            iziToast.success({
              title: "Berhasil Masuk !",
              message: "Tunggu sebentar, anda akan diarahkan ke halaman user !",
              position: "topCenter",
              onClosing: function(instance, toast, closedBy){
                window.location.href="'.$base_url.'user";
              }
            });
          </script>
        ';
      } else {
        echo '
          <script>
            iziToast.error({
              title: "Gagal Masuk !",
              message: "Username atau Password Salah !",
              position: "topCenter"
            });
          </script>
        ';
      }
    //   $resUser = mysqli_fetch_assoc($queryUsername);
    //   if ($resUser['password'] != md5($pass)) {
    //     echo('        
    //       <script>
    //           swal({
    //             title: "Gagal Login",
    //             text: "Password anda salah !",
    //             icon: "error"
    //           }).then(function(){
    //             window.location.href="../login.php";
    //           });
    //       </script>
    //     ');
      // } else{
    //     if ($resUser['level'] == 'user') {
    //       $_SESSION['id_user'] = $resUser['id_user'];
    //       echo('        
    //         <script>
    //             swal({
    //               title: "Login Berhasil",
    //               text: "Berhasil Login Sebagai User!",
    //               icon: "success"
    //             }).then(function(){
    //               window.location.href="../user/index.php?'.$token.'";
    //             });
    //         </script>
    //       ');
    //     }else {
    //       // code...
    //     }
    //   }
    } elseif (mysqli_num_rows($queryEmail) > 0) {

      $resEmail = mysqli_fetch_assoc($queryEmail);
      if(password_verify($pass, $resEmail['password'])){
        echo 'oke';
      } else {
        echo '
          <script>
            iziToast.error({
              title: "Gagal Masuk !",
              message: "Email atau Password Salah !",
              position: "topCenter"
            });
          </script>
        ';
      }
    //   if ($resEmail['password'] != md5($pass)) {
    //     echo('        
    //       <script>
    //           swal({
    //             title: "Gagal Login",
    //             text: "Password anda salah !",
    //             icon: "error"
    //           }).then(function(){
    //             window.location.href="../login.php";
    //           });
    //       </script>
    //     ');
    //   } else{
    //     if ($resEmail['level'] == 'user') {
    //       $_SESSION['id_user'] = $resEmail['id_user'];
    //       echo('        
    //         <script>
    //             swal({
    //               title: "Login Berhasil",
    //               text: "Berhasil Login Sebagai User!",
    //               icon: "success"
    //             }).then(function(){
    //               window.location.href="../user/index.php?'.$token.'";
    //             });
    //         </script>
    //       ');
    //     }else {
    //       // code...
    //     }
    //   }
    } else {
      echo '
        <script>
          iziToast.error({
            title: "Gagal Masuk !",
            message: "Username/Email atau Password Salah !",
            position: "topCenter"
          });
        </script>
      ';
    }
  }
?>
<div class="container">
  <?php if($queryCari != 0) { ?>
    <?php
      while($resultEvent = mysqli_fetch_assoc($queryFormSearch)){
        $tanggal = date('d M y', strtotime($resultEvent['tanggal_event']));
    ?>
    <div class="event-webinar text-dark bg-white p-3 p-lg-5">
      <div class="position-relative">
        <div class="row">
          <a href="javascript:void(0)" class="col-md-4 col-12" onclick="haruslogin()">
            <img src="<?= $base_url ?>assets/img/<?=$resultEvent['gambar_event']?>" alt="<?= $resultEvent['gambar_event'] ?>" class="w-100">
          </a>
          <div class="col-md-8 d-md-block d-none">
            <button onclick="haruslogin()" class="tag-webinar">
              <h5 class="pt-2 ps-2 pe-2 text-white">Webinar</h5>
            </button>
            <a class="text-primary mt-4" href="javascript:void(0)" onclick="haruslogin()" style="text-decoration: none;">
              <h3>
                <?= $resultEvent['judul_event'] ?>
              </h3>
            </a>
            <div class="d-lg-block d-none">
              <p>
                <?php if($resultEvent['deskripsi'] == ''){ ?>
                  <b>Lorem Ipsum</b> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic ...
                <?php 
                  } else {
                    echo substr($resultEvent['deskripsi'], 0, 350).' ...';
                  }
                ?>
              </p>
            </div>
            <div class="position-absolute d-md-block d-none" style="bottom: 15px">
              <div class="d-flex align-items-center mb-1">
                <h6 class="bg-success rounded py-2 px-4 text-white">
                  <i class="fas fa-calendar-check me-3"></i>
                  Jadwal Event <b class="ms-5">: <?= $tanggal ?></b>
                </h6> 
              </div>
              <a style="background-color: #52A6BE;" onclick="haruslogin()" class="text-white px-3 py-1 text-decoration-none rounded-pill" href="javascript:void(0)">
                Detail Lainnya <i class="fas fa-arrow-right ms-3"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
  <?php } else { ?>
    <div class="text-center mx-lg-5 px-lg-5">
      <div class="masuk-form bg-white p-lg-3 mt-lg-3 rounded">
        <h3 class="text-center pt-4 pb-md-4">
          <strong>Masuk</strong>
        </h3>
        <form method="post" class="px-md-3 mx-md-5 px-2 mx-2">
          <div class="form-cover mb-2">
            <i class="icon-login fas fa-user"></i>
            <input type="text" class="form-control ps-md-5 ps-5 form-login" placeholder="Email/Username" required="" name="user">
          </div>
          <div class="form-cover mb-2">
            <i class="icon-login fas fa-lock"></i>
            <input type="password" class="form-control ps-md-5 ps-5 form-login" placeholder="Kata Sandi" required="" name="pass">
          </div>
          <div class="form-group">
            <button name="masuk" style="background-color:  #52A6BE; color: white; border: none; width: 100%; border-radius: 10px; font-size: 120%" class="pt-2 pb-2">Masuk</button>
          </div>
        </form>
        <div class="text-center mt-3 pb-md-5 pb-4">
          Belum punya akun? <a style="text-decoration: none; color: #52A6BE" href="<?= $base_url ?>register.php">Daftar disini</a>
        </div>
      </div>
    </div>
  <?php } ?>
</div>
<?php include('footer.php'); ?>
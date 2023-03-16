<?php 
  include('php/session-login.php');
  include('header.php');
?>

<?php
  if (isset($_POST['daftar'])) {
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $cekUsername = mysqli_query($conn, "SELECT * FROM user WHERE username = '".$username."' ");
    $cekEmail = mysqli_query($conn, "SELECT * FROM user WHERE email_user = '".$email."' ");

    if(mysqli_num_rows($cekUsername) != 0){
      echo '
        <script>
          iziToast.error({
            title: "Gagal Daftar !",
            message: "Username telah digunakan !",
            position: "topCenter"
          });
        </script>
      ';
    } else {
      if(mysqli_num_rows($cekEmail) != 0){
        echo '
          <script>
            iziToast.error({
              title: "Gagal Daftar !",
              message: "Email telah digunakan !",
              position: "topCenter"
            });
          </script>
        ';
      } else {
        $query = mysqli_query($conn, "INSERT INTO user(username, email_user, nama_user, telepon, password, level) VALUES('".$username."', '".$email."', '".$nama."', '".$telepon."', '".$password."', 'user')");
        if($query){
          echo '
            <script>
              iziToast.success({
                title: "Berhasil Daftar !",
                message: "Data anda berhasil didaftarkan, silahkan masuk untuk melanjutkan !",
                position: "topCenter"
              });
            </script>
          ';
        } else {
          echo '
            <script>
              iziToast.error({
                title: "Gagal Daftar !",
                message: "Data anda gagal didaftarkan !",
                position: "topCenter"
              });
            </script>
          ';
        }
      }
    }
  }

?>
<style>
</style>
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
            <img src="assets/img/<?=$resultEvent['gambar_event']?>" alt="<?= $resultEvent['gambar_event'] ?>" class="w-100">
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
    <div class="mx-lg-5 px-lg-5">
      <div class="masuk-form bg-white p-lg-3 mt-lg-3 rounded">
        <h3 class="text-center pt-4 pb-md-4">
          <strong>Daftar</strong>
        </h3>
        <form method="post" class="px-md-3 mx-md-5 px-2 mx-2">
          <div class="form-cover">
            <i class="icon-login fas fa-user"></i>
            <input onkeyup="user();" id="username" name="username" type="text" class="ps-5 form-login form-control" placeholder="Username" required="">
          </div>
          <span id='pesan'></span>
          <div class="form-cover mb-2 mt-2">
            <i class="icon-login fas fa-envelope"></i>
            <input name="email" type="email" class="ps-5 form-login form-control" placeholder="Email" required="">
          </div>
          <div class="form-cover mb-2">
            <i class="icon-login fas fa-id-card"></i>
            <input name="nama" type="text" class="ps-5 form-login form-control" placeholder="Nama" required="">
          </div>
          <div class="form-cover mb-2">
            <i class="icon-login fas fa-phone-alt"></i>
            <input name="telepon" min="0" type="number" class="ps-5 form-login form-control" placeholder="No. Hp" required="">
          </div>
          <div class="form-cover mb-2">
            <i class="icon-login fas fa-lock"></i>
            <input name="password" onkeyup="check();" type="password" class="ps-5 form-login form-control" placeholder="Kata Sandi" id="password" required="">
          </div>
          <div class="form-cover">
            <i class="icon-login fas fa-lock"></i>
            <input name="passwordcheck" onkeyup="check();" type="password" class="ps-5 form-login form-control" placeholder="Ulangi Kata Sandi" id="confirm_password" required="">
          </div>
          <span id='message'></span>
          <div class="form-group mt-2 mt-3">
            <button name="daftar" style="background-color:  #52A6BE; color: white; border: none; width: 100%; border-radius: 10px; font-size: 120%" id="buttondaftar" disabled="">Daftar</button>
          </div>
        </form>
        <div class="text-center mt-3 pb-5">
          Sudah punya akun? <a style="text-decoration: none; color: #52A6BE" href="login.php">Masuk disini</a>
        </div>
      </div>
    </div>
  <?php } ?>
</div>
<?php include('footer.php'); ?>
<script>
var check = function() {
  if (document.getElementById('password').value ==
    document.getElementById('confirm_password').value) {
    document.getElementById('message').style.display = 'none';
    document.getElementById('buttondaftar').disabled = false;
  } else {
    document.getElementById('message').style.display = 'block';
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'Kata Sandi tidak sama';
    document.getElementById('buttondaftar').disabled = true;
  }
}

var user = function(){
  var name = document.getElementById('username').value;
  
  if(!(/^\S{0,}$/.test(name))){
    document.getElementById('pesan').innerHTML = "Username Tidak Boleh Mengandung Spasi";
    document.getElementById('pesan').style.color = 'red';
    document.getElementById('pesan').style.display = 'block';
  } else{
    document.getElementById('pesan').style.display = 'none';
  }
  
}
</script>

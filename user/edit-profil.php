<?php

  include('../php/session-user.php'); 
  if(isset($_SESSION['id_user'])){
  include('header.php');
?>
<style>
  .circle-1{
    background-color: #D4D4D4;
    width: 200px;
    height: 200px;
    border-radius: 50%;
    z-index: 1;
    margin-top: -100px;
    position: absolute;
  }
  .box-1{
    background-color: #CFC2FF;
    margin-top: 100px;
    width: 150px;
    height: 150px;
    margin-left: 100px;
    z-index: -1;
  }
  .top-content{
    margin-left: calc(50% - 125px);
  }
  .username{
    background-color: #D4D4D4;
    border-radius: 10px;
  }
  .content{
    background-color: white;
    opacity: 0.5;
    border: none;
    border-radius: 15px;
    font-size: 120%;
    width: 100%;
  }
</style>
<?php

  if(isset($_POST['gantipassword'])){
    $last = $_POST['password-lama'];
    $new = $_POST['password-baru'];
    $confirm = $_POST['konfirmasi-password-baru'];

    $userQuery = mysqli_query($conn, "SELECT * FROM user WHERE id_user = '".$_SESSION['id_user']."'");
    $resUs = mysqli_fetch_assoc($userQuery);
    if($new == $confirm){
      if(password_verify($last, $resUs['password'])){
        if(password_verify($new, $resUs['password'])){
          echo '
            <script>
                 iziToast.error({
                    title : "Error",
                    message: "Password sudah pernah digunakan",
                    position: "center",
                    onClosing: function(instance, toast, closedBy){
                      window.location.href="'.$base_url.'user/edit-profil.php"
                    },
                  })
            </script>
          ';
        } else {
          echo('
            <script>
              iziToast.question({
                timeout: 20000,
                close: false,
                overlay: true,
                displayMode: "once",
                id: "question",
                zindex: 999,
                title: "Halo Webiners",
                message: "Apakah anda sudah yakin untuk mengganti password?",
                position: "center",
                buttons: [
                    ["<button><b>Ya</b></button>", function (instance, toast) {
                      '.mysqli_query($conn, "UPDATE user SET password = '".password_hash($new, PASSWORD_DEFAULT)."' WHERE id_user = '".$_SESSION['id_user']."'").'
                        instance.hide({ transitionOut: "fadeOut" }, toast, "button");
                        iziToast.success({
                          title : "Sukses",
                          message: "Password berhasil diganti",
                          position: "center",
                          onClosing: function(instance, toast, closedBy){
                            window.location.href="'.$base_url.'user/edit-profil.php";
                          },
                        })
                    }, true],
                    ["<button>Tidak</button>", function (instance, toast) {
                      instance.hide({ transitionOut: "fadeOut" }, toast, "button");
                    }],
                ]
              });
            </script>
          '); 
        }
      } else {
        echo '
          <script>
               iziToast.error({
                  title : "Error",
                  message: "Password Lama Anda Salah",
                  position: "center",
                  onClosing: function(instance, toast, closedBy){
                    window.location.href="'.$base_url.'user/edit-profil.php"
                  },
                })
          </script>
        ';
      }
    } else {
      echo '
        <script>
             iziToast.error({
                title : "Error",
                message: "Konfirmasi Password Anda Salah",
                position: "center",
                onClosing: function(instance, toast, closedBy){
                  window.location.href="'.$base_url.'user/edit-profil.php"
                },
              })
        </script>
      ';
    }
  } elseif(isset($_POST['save'])){
    $username = $_POST['username'];
    $nama_user = $_POST['nama'];
    $telepon = $_POST['telepon'];
    $email_user = $_POST['email'];
    $pekerjaan_user = $_POST['pekerjaan'];
    $jeniskelamin_user = $_POST['jenis'];

    $gambar = $_FILES['foto_profil']['name'];
    $tmp = $_FILES['foto_profil']['tmp_name'];
    $type = $_FILES['foto_profil']['type'];
    $path = '../assets/img/profil/'.date('YmdHis').$gambar;
    
    if($gambar == ''){
      $data = "username = '".$username."', nama_user = '".$nama_user."', telepon = '".$telepon."', email_user = '".$email_user."', pekerjaan_user = '".$pekerjaan_user."', jeniskelamin_user = '".$jeniskelamin_user."' ";

      echo '
        <script>
              iziToast.question({
                timeout: 20000,
                close: false,
                overlay: true,
                displayMode: "once",
                id: "question",
                zindex: 999,
                title: "Halo Webiners",
                message: "Apakah anda sudah yakin untuk mengganti data profil anda ?",
                position: "center",
                buttons: [
                    ["<button><b>Ya</b></button>", function (instance, toast) {
                      '.mysqli_query($conn, "UPDATE user SET ".$data." WHERE id_user = '".$_SESSION['id_user']."'").'
                        instance.hide({ transitionOut: "fadeOut" }, toast, "button");
                        iziToast.success({
                          title : "Sukses",
                          message: "Data berhasil diganti",
                          position: "center",
                          onClosing: function(instance, toast, closedBy){
                            window.location.href="'.$base_url.'user/edit-profil.php";
                          },
                        })
                    }, true],
                    ["<button>Tidak</button>", function (instance, toast) {
                      instance.hide({ transitionOut: "fadeOut" }, toast, "button");
                    }],
                ]
              });
            </script>
      ';
    } else {
      if(move_uploaded_file($tmp, $path)){
        $data = "foto_profil = '".date('YmdHis').$gambar."', username = '".$username."', nama_user = '".$nama_user."', telepon = '".$telepon."', email_user = '".$email_user."', pekerjaan_user = '".$pekerjaan_user."', jeniskelamin_user = '".$jeniskelamin_user."' ";
        echo '
          <script>
                iziToast.question({
                  timeout: 20000,
                  close: false,
                  overlay: true,
                  displayMode: "once",
                  id: "question",
                  zindex: 999,
                  title: "Halo Webiners",
                  message: "Apakah anda sudah yakin untuk mengganti data profil anda ?",
                  position: "center",
                  buttons: [
                      ["<button><b>Ya</b></button>", function (instance, toast) {
                        '.mysqli_query($conn, "UPDATE user SET ".$data." WHERE id_user = '".$_SESSION['id_user']."'").'
                          instance.hide({ transitionOut: "fadeOut" }, toast, "button");
                          iziToast.success({
                            title : "Sukses",
                            message: "Data berhasil diganti",
                            position: "center",
                            onClosing: function(instance, toast, closedBy){
                              window.location.href="'.$base_url.'user/edit-profil.php";
                            },
                          })
                      }, true],
                      ["<button>Tidak</button>", function (instance, toast) {
                        instance.hide({ transitionOut: "fadeOut" }, toast, "button");
                      }],
                  ]
                });
              </script>
        ';
      } else {
        echo '
            <script>
                 iziToast.error({
                    title : "Error",
                    message: "Data gagal diganti",
                    position: "center",
                    onClosing: function(instance, toast, closedBy){
                      window.location.href="'.$base_url.'user/edit-profil.php"
                    },
                  })
            </script>
          ';
      }
    }

  }

?>
<div class="container position-relative">
  <div class="top-search text-end mt-4">
    <div class="text-end me-4">
      <h2>
        <img src="<?= $base_url ?>assets/img/tangan.svg" class="me-2">
        <b>Hi, <?= $resUser['nama_user'] ?> !</b>
      </h2>
    </div>
  </div>
  <?php if($queryCari != 0) { ?>
    <?php
      while($resultEvent = mysqli_fetch_assoc($queryFormSearch)){
        $tanggal = date('d M y', strtotime($resultEvent['tanggal_event']));
    ?>
    <div class="event-webinar text-dark bg-white p-3 p-lg-5">
      <div class="position-relative">
        <div class="row">
          <a href="<?= $base_url ?>user/detail-event.php?id=<?=$resultEvent['id_event']?>" class="col-md-4 col-12">
            <img src="<?= $base_url ?>assets/img/<?=$resultEvent['gambar_event']?>" alt="<?= $resultEvent['gambar_event'] ?>" class="w-100">
          </a>
          <div class="col-md-8 d-md-block d-none">
            <button disabled class="tag-webinar">
              <h5 class="pt-2 ps-2 pe-2 text-white">Webinar</h5>
            </button>
            <a class="text-primary mt-4" href="<?= $base_url ?>user/detail-event.php?id=<?=$resultEvent['id_event']?>" style="text-decoration: none;">
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
              <a href="<?= $base_url ?>user/detail-event.php?id=<?=$resultEvent['id_event']?>" style="background-color: #52A6BE;" class="text-white px-3 py-1 text-decoration-none rounded-pill" >
                Detail Lainnya <i class="fas fa-arrow-right ms-3"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
  <?php } else { ?>
    <section class="text-center">
      <div class="top-content">
        <div class="circle-1 overflow-hidden border border-4">
          <?php if($resUser['foto_profil'] != null){ ?>
            <img src="<?= $base_url ?>assets/img/profil/<?= $resUser['foto_profil'] ?>" width="100%" height="100%" id="imagefet">
          <?php } else { ?>
            <img width="100%" height="100%" id="imagefet">
          <?php } ?>
        </div>
        <div class="box-1"></div>
        <br>
      </div>
      <br>
    </section>
    <form method="post" enctype="multipart/form-data">
      <div class="p-md-5 p-3 mx-lg-5 mx-md-4" style="background-color:#CFC2FF; border-radius: 35px;">
        <div class="username text-center p-2 mb-3">
          <b style="color: blue">
              @<?= $resUser['username'] ?>
            </b>
        </div>
        <div class="content mb-2 p-3 d-md-flex align-items-center">
          <label for="sisipkanGambar">Foto Profil</label>
          <input type="file" name="foto_profil" class="ms-md-3" id="sisipkanGambar" style="cursor: pointer;" accept="image/jpg, image/jpeg, image/png, image.svg">
        </div>
        <input required type="text" class="content mb-2 p-3" name="username" value="<?= $resUser['username'] ?>" placeholder="Username">
        <input required type="text" class="content mb-2 p-3" name="nama" value="<?= $resUser['nama_user'] ?>" placeholder="Nama">
        <input required type="number" class="content mb-2 p-3" name="telepon" value="<?= $resUser['telepon'] ?>" placeholder="No. Handphone">
        <input required type="email" class="content mb-2 p-3" name="email" value="<?= $resUser['email_user'] ?>" placeholder="Email">
        <input type="text" class="content mb-2 p-3" name="pekerjaan" value="<?= $resUser['pekerjaan_user'] ?>" placeholder="Pekerjaan">
        <select type="text" class="content mb-2 p-3" name="jenis" value="<?= $resUser['jeniskelamin_user'] ?>">
          <?php if($resUser['jeniskelamin_user'] == '') { ?>
          <option disabled selected>Jenis Kelamin</option>
          <?php } else { ?>
            <option disabled>Jenis Kelamin</option>
          <?php } ?>
          <option value="Laki - Laki">Laki - Laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
        <div class="text-center">
          <button id="ganti" type="button" name="ganti" style="border: none; border-radius: 15px; opacity: 0.8" class="pt-2 mt-2 pb-2 ps-4 pe-4 bg-primary text-white" data-bs-toggle="modal" data-bs-target="#pembayaranmodel">Ganti Password</button>
          <button type="submit" name="save" style="border: none; border-radius: 15px; background-color: white; opacity: 0.8" class="pt-2 mt-2 pb-2 ps-4 pe-4">Simpan Perubahan</button>
        </div>
      </div>
    </form>
  <?php } ?>
</div>
<div class="modal fade" id="pembayaranmodel" tabindex="-1" aria-labelledby="pembayaranmodelLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pembayaranmodelLabel">Ganti Password Anda</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post">
        <div class="modal-body">
          <input type="hidden" name="id_user" value="<?= $_SESSION['id_user'] ?>">
          <label for="last-pass">Password Lama</label>
          <input required type="password" name="password-lama" class="form-control mb-2">
          <label for="last-pass">Password Baru</label>
          <input required type="password" name="password-baru" class="form-control mb-2">
          <label for="last-pass">Konfirmasi Password Baru</label>
          <input required type="password" name="konfirmasi-password-baru" class="form-control mb-2">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button name="gantipassword" type="submit" class="btn btn-primary">Ganti</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  let icon = document.getElementById('sisipkanGambar');
  let imagefet = document.getElementById('imagefet');
  icon.addEventListener('change', function () {
    gambar(this);
  })
  function gambar(a) {
    if (a.files && a.files[0]) {     
      var reader = new FileReader();    
      reader.onload = function (e) {
          imagefet.src=e.target.result;
      }    
      reader.readAsDataURL(a.files[0]);
    }
  }
</script>
<?php include('footer.php'); ?>
<?php } ?>
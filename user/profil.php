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
    z-index: 100000;
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
  .username{
    background-color: #D4D4D4;
    border-radius: 10px;
  }
  .mid-content{
    border-radius: 10px;
    border: 2px solid #52A6BE;
  }
</style>
<?php

  if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    echo '
      <script>
           iziToast.success({
              title : "Sukses",
              message: "Anda berhasil logout",
              position: "center",
              onClosing: function(instance, toast, closedBy){
                window.location.href="'.$base_url.'";
              },
            })
      </script>
    ';
  }

?>
<div class="container">
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
    <section class="container">
      <div class="row">
        <div class="left-top col-lg-4 col-md-5">
          <div class="circle-1 overflow-hidden border border-4">
            <?php if($resUser['foto_profil'] != null){ ?>
              <img src="<?= $base_url ?>assets/img/profil/<?= $resUser['foto_profil'] ?>" width="100%" height="100%">
            <?php } ?>
          </div>
          <div class="box-1"></div>
          <br>
          <div class="username text-center p-2">
            <b style="color: blue">
              @<?= $resUser['username'] ?>
            </b>
          </div>
          <div class="text-center mt-2">
            <h5 class="mb-1">
              <a class="text-warning" style="text-decoration: none" href="<?= $base_url ?>user/edit-profil.php">Edit Profil</a>
            </h5>
            <h5>
              <form method="post">
                <button name="logout" style="color: blue; text-decoration: none; background: none; border: none;" href="<?= $base_url ?>/php/session-logout.php">
                  Keluar dari akun mu
                </button>
              </form>
            </h5>
          </div>
        </div>
        <div class="right-top mt-3 col-lg-8 col-md-7">
          <div class="ms-lg-5 ps-lg-5">
            <input style="background-color: #D4D4D4;border: none; border-radius:10px; box-shadow: 5px 5px 10px gray" type="text" readonly="" value="<?= $resUser['nama_user'] ?>" class="mb-2 py-lg-2 py-1 px-3 w-100" placeholder="Nama">
            <input style="background-color: #D4D4D4;border: none; border-radius:10px; box-shadow: 5px 5px 10px gray" type="text" readonly="" value="<?= $resUser['jeniskelamin_user'] ?>" class="mb-2 py-lg-2 py-1 px-3 w-100" placeholder="Jenis Kelamin">
            <input style="background-color: #D4D4D4;border: none; border-radius:10px; box-shadow: 5px 5px 10px gray" type="text" readonly="" value="<?= $resUser['telepon'] ?>" class="mb-2 py-lg-2 py-1 px-3 w-100" placeholder="Nomor Telepon">
            <input style="background-color: #D4D4D4;border: none; border-radius:10px; box-shadow: 5px 5px 10px gray" type="text" readonly="" value="<?= $resUser['email_user'] ?>" class="mb-2 py-lg-2 py-1 px-3 w-100" placeholder="Email">
            <input style="background-color: #D4D4D4;border: none; border-radius:10px; box-shadow: 5px 5px 10px gray" type="text" readonly="" value="<?= $resUser['pekerjaan_user'] ?>" class="mb-2 py-lg-2 py-1 px-3 w-100" placeholder="Pekerjaan">
          </div>
        </div>
      </div>
    </section>
    <section class="mid-content py-3 mt-3">
      <div class="row">
        <div class="col-md-6 text-md-start">
          <div class=" py-md-4 py-3 my-md-1 my-2 ms-md-3 ms-2 me-md-1 me-2 ms-lg-5 ms-lg-1 text-dark text-center py-lg-5 rounded" style="background-color:#D4D4D4">
            <?php if ($resUser['status_account'] == null) { ?>
            <a href="javascript:void(0)" onclick="iziToast.error({ title : 'Gagal memuat halaman', message: 'Upgrade akun anda ke premium untuk mengakses halaman admin', position: 'center'})" class="text-decoration-none text-dark w-100">
              <h5>Halaman Admin</h5>
              <h1><i class="fas fa-home"></i></h1>
            </a>
            <?php } else{ ?>
            <a href="javascript:void(0)" onclick="this.href='<?= $base_url ?>user/admin-panel'" class="text-decoration-none text-dark w-100">
              <h5>Halaman Admin</h5>
              <h1><i class="fas fa-home"></i></h1>
            </a>
            <?php } ?>
          </div>
        </div>
        <div class="col-md-6 text-md-start">
          <div class=" py-md-4 py-3 my-md-1 my-2 me-md-3 ms-2 ms-md-1 me-2 me-lg-5 ms-lg-1 text-dark text-center py-lg-5 rounded" style="background-color:#CFC2FF">
            <?php if ($resUser['status_account'] == null) { ?>
            <a href="javascript:void(0)" onclick="iziToast.error({ title : 'Gagal memuat halaman', message: 'Upgrade akun anda ke premium untuk mengakses halaman admin', position: 'center'})" class="text-decoration-none text-dark w-100">
              <h5>Sertifikat</h5>
              <h1><i class="fas fa-medal"></i></h1>
            </a>
            <?php } else{ ?>
            <a href="javascript:void(0)"> onclick="this.href='<?= $base_url ?>user/admin-panel/sertifikatku.php'" class="text-decoration-none text-dark w-100">
              <h5>Sertifikat</h5>
              <h1><i class="fas fa-medal"></i></h1>
            </a>
            <?php } ?>
          </div>
        </div>
      </div>
    </section>
  <?php } ?>
</div>
    
    <?php include('footer.php'); ?>
<?php } ?>
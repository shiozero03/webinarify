<?php

  include('../php/session-user.php'); 
  if(isset($_SESSION['id_user'])){
  include('header.php');
  if(!$_GET['id']){
    header('Location: '.$base_url.'user');
  }
  $query = mysqli_query($conn, "SELECT * FROM event_webinar WHERE id_kategoriwebinar = '".$_GET['id']."' ORDER BY tanggal_event DESC" );
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
    <?php
      if(mysqli_num_rows($query) == 0){
    ?>
      <div class="event-webinar text-dark bg-white p-3 p-lg-5">
        <div class="position-relative">
          <div class="row">
            <a href="javascript:void(0)" class="col-md-4 col-12">
              <img src="<?= $base_url ?>assets/img/Beranda-picture1.png" alt="" class="w-100">
            </a>
            <div class="col-md-8 d-md-block d-none">
              <button disabled class="tag-webinar">
                <h5 class="pt-2 ps-2 pe-2 text-white">Webinar</h5>
              </button>
              <a class="text-primary mt-4" href="javascript:void(0)" style="text-decoration: none;">
                <h3>
                  <em>No DATA</em>
                </h3>
              </a>
              <div class="position-absolute d-md-block d-none" style="bottom: 15px">
                <div class="d-flex align-items-center mb-1">
                  <h6 class="bg-success rounded py-2 px-4 text-white">
                    <i class="fas fa-calendar-check me-3"></i>
                    Jadwal Event <b class="ms-5">: 00 00 0000</b>
                  </h6> 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php
      } else{
        while($result = mysqli_fetch_assoc($query)){
          $tanggal = date('d M y', strtotime($result['tanggal_event']));
          $daftar = date('d M y', strtotime($result['akhir_pendaftaran']));
    ?>
      <div class="event-webinar text-dark bg-white p-3 p-lg-5">
        <div class="position-relative">
          <div class="row">
            <a href="<?= $base_url ?>user/detail-event.php?id=<?=$result['id_event']?>" class="col-md-4 col-12">
              <img src="<?= $base_url ?>assets/img/<?=$result['gambar_event']?>" alt="<?= $result['gambar_event'] ?>" class="w-100">
            </a>
            <div class="col-md-8 d-md-block d-none">
              <button disabled class="tag-webinar">
                <h5 class="pt-2 ps-2 pe-2 text-white">Webinar</h5>
              </button>
              <a class="text-primary mt-4" href="<?= $base_url ?>user/detail-event.php?id=<?=$result['id_event']?>" style="text-decoration: none;">
                <h3>
                  <?= $result['judul_event'] ?>
                </h3>
              </a>
              <div class="d-lg-block d-none">
                <p>
                  <?php if($result['deskripsi'] == ''){ ?>
                    <b>Lorem Ipsum</b> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic ...
                  <?php 
                    } else {
                      echo substr($result['deskripsi'], 0, 350).' ...';
                    }
                  ?>
                </p>
              </div>
              <div class="position-absolute d-md-block d-none" style="bottom: 15px">
                <div class="d-flex align-items-center mb-1">
                  <h6 class="bg-success rounded py-2 px-4 text-white">
                    <i class="fas fa-calendar-check me-3"></i>
                    Jadwal Event <b class="ms-2">: <?= $tanggal ?></b>
                  </h6> 
                  <h6 class="bg-success rounded py-2 px-4 text-white ms-2">
                    <i class="fas fa-calendar-check me-3"></i>
                    Akhir Pendaftaran <b class="ms-2">: <?= $daftar ?></b>
                  </h6> 
                </div>
                <a href="<?= $base_url ?>user/detail-event.php?id=<?=$result['id_event']?>" style="background-color: #52A6BE;" class="text-white px-3 py-1 text-decoration-none rounded-pill" >
                  Detail Lainnya <i class="fas fa-arrow-right ms-3"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php
        }
      }
    ?>
  <?php } ?>
</div>
<?php include('footer.php'); ?>
<?php } ?>
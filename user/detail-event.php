<?php

  include('../php/session-user.php'); 
  if(isset($_SESSION['id_user'])){
  include('header.php');
  
  $query = mysqli_query($conn, "SELECT * FROM event_webinar WHERE id_event = '".$_GET['id']."'");
  $result = mysqli_fetch_assoc($query);
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
    <section>
      <div class="row">
        <div class="col-lg-6 col-md-4 col-12 mt-2">
          <img src="<?= $base_url ?>assets/img/<?=$result['gambar_event']?>" alt="" width="100%">
        </div>
        <div class="col-lg-6 col-md-8 col-12 mt-2">
          <div style="border-radius: 10px; box-shadow: 5px 5px 5px black" class="px-md-3 pt-md-3 pb-5 px-2 pt-2 bg-white">
            <h4><strong>Tentang Event</strong></h4>
            <small><?= $result['deskripsi'] ?></small>
            <h4><strong>Manfaat</strong></h4>
            <small><?= $result['manfaat'] ?></small>
            <h4><strong>Prasyarat</strong></h4>
            <small><?= $result['prasyarat'] ?></small>
          </div>
        </div>
      </div>
    </section>
    <section class="mt-4">
      <div style=" border-radius: 10px; box-shadow: 5px 5px 5px black" class="p-lg-5 p-md-3 p-2 bg-white mb-4">
        <button disabled="" style="background-color: #CFC2FF; border: none;" class="mb-3 btn">
          <h5 class="pt-2 ps-2 pe-2 text-dark">Webinar</h5>
        </button>
        <a class="text-primary mt-3" href="javascript:void(0)" style="text-decoration: none;">
          <h3 style="border-bottom: 1px solid gray" class="pb-3 mb-2">
            <b><?= $result['judul_event'] ?></b>
          </h3>
        </a>
        <div class="d-flex align-items-center mb-2 pb-2" style="border-bottom: 1px solid gray">
          <div class="col-md-1 col-2">
            <img src="../assets/img/kalender.png" alt="" width="75%">
          </div>
          <div class="col-md-5 col-5">
            <b><?= date('d M Y', strtotime($result['tanggal_event'])) ?></b>
          </div>
          <div class="text-end col-md-6 col-5">
            <b><?= date('H:i', strtotime($result['waktu'])) ?> WIB</b>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="d-flex align-items-center mb-2 pb-2" style="border-bottom: 1px solid gray">
          <div class="col-md-1 col-2">
            <img src="../assets/img/lokasi.png" alt="" width="75%">
          </div>
          <div class="col-md-11 col-10">
            <b><?= $result['pelaksanaan']?></b>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="d-flex align-items-center mb-2 pb-2" style="border-bottom: 1px solid gray">
          <div class="col-md-1 col-2">
            <img src="../assets/img/profil (1).png" alt="" width="75%">
          </div>
          <div class="col-md-11 col-10">
            <b><?= $result['email']?></b>
          </div>
        </div>
        <div class="d-flex align-items-center mb-2 pb-2" style="border-bottom: 1px solid gray">
          <div class="col-6">
            <a style="background-color: #52A6BE; text-decoration:none; " href="<?= $base_url ?>user/detail-pendaftar.php?id=<?= $result['id_event'] ?>" class="text-white btn">
                Lihat Webinar
              </a>
          </div>
          <div class="col-6 text-end">
            <b>
              <a href="https://www.instagram.com/<?= $result['instagram'] ?>" target="__blank" class="text-danger"><i style="font-size: 200%" class="me-1 fab fa-instagram"></i></a>
              <a href="https://wa.me/62<?= $result['whatsapp'] ?>" target="__blank" class="text-success"><i style="font-size: 200%" class="fab fa-whatsapp"></i></a>
            </b>
          </div>
        </div>
      </div>
    </section>
  <?php } ?>
</div>
<?php include('footer.php'); ?>
<?php } ?>
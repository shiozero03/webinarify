<?php

  include('../php/session-user.php'); 
  if(isset($_SESSION['id_user'])){
  include('header.php');
  if(!$_GET['id']){
    header('Location: '.$base_url.'user');
  }
  $query = mysqli_query($conn, "SELECT * FROM event_webinar WHERE id_event = '".$_GET['id']."'" );
  
  $query2 = mysqli_query($conn, "SELECT * FROM daftar_webinar WHERE id_peserta = '".$_SESSION['id_user']."' AND id_event = '".$_GET['id']."'" );

  $countQue = mysqli_num_rows($query2);
  $result = mysqli_fetch_assoc($query);

  if(mysqli_num_rows($query) == 0){
    header('Location: '.$base_url.'user');
  }

  if(isset($_POST['simpan'])){
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telp = $_POST['telepon'];
    $wa = $_POST['wa'];
    $pend = $_POST['pendidikan'];
    $idpes = $_SESSION['id_user'];
    $idev = $_POST['id_event'];
    $harga = $result['harga'];
    
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
          message: "Apakah anda ingin menyimpan data?",
          position: "center",
          buttons: [
              ["<button><b>Ya</b></button>", function (instance, toast) {
                '.$query = mysqli_query($conn, "INSERT INTO daftar_webinar(id_peserta, id_event, nama, email, telepon, whatsapp, pendidikan, harga, status) VALUES ('".$idpes."', '".$idev."', '".$nama."', '".$email."', '".$telp."', '".$wa."', '".$pend."', '".$harga."', 'Belum Bayar')").'
                  instance.hide({ transitionOut: "fadeOut" }, toast, "button");
                  iziToast.success({
                    title : "Sukses",
                    message: "Data anda berhasil ditambahkan",
                    position: "center",
                    onClosing: function(instance, toast, closedBy){
                      window.location.href="'.$base_url.'user/detail-pendaftar.php?id='.$_GET['id'].'";
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
  } elseif(isset($_POST['update-data'])){
    $id_pendaftaran = $_POST['id_pendaftaran'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telp = $_POST['telepon'];
    $wa = $_POST['wa'];
    $pend = $_POST['pendidikan'];
    $idpes = $_SESSION['id_user'];

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
          message: "Apakah anda ingin mengupdate data?",
          position: "center",
          buttons: [
              ["<button><b>Ya</b></button>", function (instance, toast) {
                '.$query = mysqli_query($conn, "UPDATE daftar_webinar SET id_peserta = '".$idpes."', nama = '".$nama."', email = '".$email."', telepon = '".$telp."', whatsapp = '".$wa."', pendidikan = '".$pend."' WHERE id_pendaftaran = '".$id_pendaftaran."' ").'
                  instance.hide({ transitionOut: "fadeOut" }, toast, "button");
                  iziToast.success({
                    title : "Sukses",
                    message: "Data anda berhasil diupdate",
                    position: "center",
                    onClosing: function(instance, toast, closedBy){
                      window.location.href="'.$base_url.'user/detail-pendaftar.php?id='.$_GET['id'].'";
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
    <?php if(date($result['tanggal_event']) < date('Y-m-d')){ ?>
      <section>
        <?php if ($countQue > 0) { 
          while($resultQue = mysqli_fetch_assoc($query2)){ ?>
          <div class="mb-3"><strong><h3>Detail Partisipan</h3></strong></div>
          <div class="row">
            <div class="col-lg-3">
              <img src="<?= $base_url ?>assets/img/<?=$result['gambar_event']?>" alt="" width="100%">
              <?php if($resultQue['sertifikat'] != ''){ ?>
                <a target="__blank" href="<?= $base_url ?>assets/sertifikat/<?=$resultQue['sertifikat']?>" style="background-color: #52A6BE;" class="text-white btn w-100 mt-3"><i class="fas fa-download me-2"></i>Download Sertifikat</a>
              <?php } ?>
            </div>
            <div class="col-lg-9">
              <div>
                <a class="text-primary mt-4 text-decoration-none" href="javascript:void(0)">
                  <h2 class="pb-1">
                    <b><?= $result['judul_event'] ?></b>
                  </h2>
                </a>
                <h5>Jadwal Webinar : <b class="ms-5"><?= date('d M Y', strtotime($result['tanggal_event']))?></b></h5>
              </div>
              <hr>
              <section class="form">
                <h1><strong><em>Event Telah Berakhir</em></strong></h1>
              </section>
            </div>
          </div>
        <?php }} else { ?>
          <div class="mb-3"><strong><h3>Detail Partisipan</h3></strong></div>
          <div class="row">
            <div class="col-lg-3">
              <img src="<?= $base_url ?>assets/img/<?=$result['gambar_event']?>" alt="" width="100%">
            </div>
            <div class="col-lg-9">
              <div>
                <a class="text-primary mt-4 text-decoration-none" href="javascript:void(0)">
                  <h2 class="pb-1">
                    <b><?= $result['judul_event'] ?></b>
                  </h2>
                </a>
                <h5>Jadwal Webinar : <b class="ms-5"><?= date('d M Y', strtotime($result['tanggal_event']))?></b></h5>
              </div>
              <hr>
              <section class="form">
                <h1><strong><em>Event Telah Berakhir</em></strong></h1>
              </section>
            </div>
          </div>
        <?php } ?>
      </section>
    <?php }else{ ?>
      <section>
        <div class="mb-3"><strong><h3>Detail Partisipan</h3></strong></div>
        <?php if($countQue > 0){ 
          while($resultQue = mysqli_fetch_assoc($query2)){ ?>
          <div class="row">
            <div class="col-lg-3">
              <img src="<?= $base_url ?>assets/img/<?=$result['gambar_event']?>" alt="" width="100%">
              <div class="mt-3 p-2 bg-white rounded border border-dark">
                <div class="text-center">
                  <h4>TIKET EVENT</h4>
                  <h6> 1 x Rp <?= number_format($result['harga'],2, ',','.') ?></h6>
                  <hr>
                  <h2>Rp <?= number_format($result['harga'],2, ',','.') ?></h2>
                </div>
                <?php if($resultQue['status'] == 'Belum Bayar'){ ?>
                  <a href="<?= $base_url ?>user/pembayaran.php?id=<?=$result['id_event']?>&&daftar=<?= $resultQue['id_pendaftaran'] ?>" style="background-color: #52A6BE;" class="text-white btn w-100 mt-3">Bayar</a>
                <?php } elseif($resultQue['status'] == 'Diproses'){ ?>
                  <a href="javascript:void(0)" style="background-color: #52A6BE;" class="text-white btn w-100 mt-3"><em>Sedang Diproses</em></a>
                <?php } elseif($resultQue['status'] == 'Ditolak'){ ?>
                  <a href="<?= $base_url ?>user/pembayaran.php?id=<?=$result['id_event']?>" style="background-color: #52A6BE;" class="text-white btn w-100 mt-3">Bayar Ulang</a>
                <?php } else{ ?>
                  <a href="<?= $base_url ?>user/download-tiket.php?id=<?=$resultQue['id_pendaftaran']?>" style="background-color: #52A6BE;" class="text-white btn w-100 mt-3">Download Tiket</a>
                <?php } ?>
              </div>
            </div>
            <div class="col-lg-9">
              <div>
                <a class="text-primary mt-4 text-decoration-none" href="javascript:void(0)">
                  <h2 class="pb-1">
                    <b><?= $result['judul_event'] ?></b>
                  </h2>
                </a>
                <h5>Jadwal Webinar : <b class="ms-5"><?= date('d M Y', strtotime($result['tanggal_event']))?></b></h5>
              </div>
              <hr>
              <section class="form">
                <form method="post">
                  <h4><label for="">Nama <b class="text-danger">*</b></label></h4>
                  <input type="hidden" class="form-control input-check" name="id_pendaftaran" value="<?= $resultQue['id_pendaftaran'] ?>">
                  <input type="text" class="form-control input-check" name="nama" value="<?= $resultQue['nama'] ?>">
                  
                  <h4 class="mt-3"><label for="">Email <b class="text-danger">*</b></label></h4>
                  <input type="email" class="form-control input-check" name="email" value="<?= $resultQue['email'] ?>">
                  
                  <h4 class="mt-3"><label for="">Nomor Telepon <b class="text-danger">*</b></label></h4>
                  <input type="number" min="0"class="form-control input-check" name="telepon" value="<?= $resultQue['telepon'] ?>">
                  
                  <h4 class="mt-3"><label for="">Nomor Whatsapp <b class="text-danger">*</b></label></h4>
                  <input type="number" min="0" class="form-control input-check" name="wa" value="<?= $resultQue['whatsapp'] ?>">
                  
                  <h4 class="mt-3"><label for="">Pendidikan Saat Ini <b class="text-danger">*</b></label></h4>
                  <input type="text" class="form-control input-check mb-3" name="pendidikan" value="<?= $resultQue['pendidikan'] ?>">
                  
                  <span>
                    Semua pemberitahuan akan dikirimkan melalui email yang kamu daftarkan dalam pembelian tiket
                  </span>
                  
                  <div class="text-end mt-5" id="change">
                    <a onclick="ubahData()" class="text-dark btn btn-warning">
                        Ubah Data
                    </a>
                  </div>
                  <div class="text-end mt-5 d-none" id="save-close">
                    <button type="submit" name="update-data" class="text-white btn btn-success">
                        Simpan
                    </button>
                    <a onclick="closeData()" class="text-white btn btn-danger">
                        Close
                    </a>
                  </div>
                </form>
              </section>
            </div>
          </div>
          <?php }
        } else{ ?>
          <div class="row">
            <div class="col-lg-3">
              <img src="<?= $base_url ?>assets/img/<?=$result['gambar_event']?>" alt="" width="100%">
              <div class="mt-3 p-2 bg-white rounded border border-dark">
                <div class="text-center">
                  <h4>TIKET EVENT</h4>
                  <h6> 1 x Rp <?= number_format($result['harga'],2, ',','.') ?></h6>
                  <hr>
                  <h2>Rp <?= number_format($result['harga'],2, ',','.') ?></h2>
                </div>
              </div>
            </div>
            <div class="col-lg-9">
              <div>
                <a class="text-primary mt-4 text-decoration-none" href="javascript:void(0)">
                  <h2 class="pb-1">
                    <b><?= $result['judul_event'] ?></b>
                  </h2>
                </a>
                <h5>Jadwal Webinar : <b class="ms-5"><?= date('d M Y', strtotime($result['tanggal_event']))?></b></h5>
              </div>
              <hr>
              <section class="form">
                <?php if(date($result['akhir_pendaftaran']) > date('Y-m-d')){ ?>
                <form method="post">
                  <h4><label for="">Nama <b class="text-danger">*</b></label></h4>
                  <input type="text" class="form-control" name="nama" required="">
                  
                  <h4 class="mt-3"><label for="">Email <b class="text-danger">*</b></label></h4>
                  <input type="email" class="form-control" name="email" required="">
                  
                  <h4 class="mt-3"><label for="">Nomor Telepon <b class="text-danger">*</b></label></h4>
                  <input type="number" min="0"class="form-control" name="telepon" required="">
                  
                  <h4 class="mt-3"><label for="">Nomor Whatsapp <b class="text-danger">*</b></label></h4>
                  <input type="number" min="0" class="form-control" name="wa" required="">
                  
                  <h4 class="mt-3"><label for="">Pendidikan Saat Ini <b class="text-danger">*</b></label></h4>
                  <input type="text" class="form-control mb-3" name="pendidikan" required="">
                  <input type="hidden" name="harga" value="<?=$result['harga']?>">
                  <input type="hidden" name="id_event" value="<?=$result['id_event']?>">
                  <span>
                    Semua pemberitahuan akan dikirimkan melalui email yang kamu daftarkan dalam pembelian tiket
                  </span>
                  
                  <div class="text-end mt-2">
                    <button name="simpan" style="background-color: #52A6BE; text-decoration:none; " class="text-white btn">
                        Simpan
                    </button>
                  </div>
                </form>
              <?php } else{ ?>
                <h1><em>Pendaftaran Ditutup</em></h1>
              <?php } ?>
              </section>
            </div>
          </div>
        <?php } ?>
      </section>
    <?php } ?>
  <?php } ?>
</div>
<script>

  $('.input-check').attr('readonly', 'true');
  function belumselesai(){
    swal({
      title: "Gagal Memuat Halaman",
      text: "Simpan Data Anda Terlebih Dahulu!",
      icon: "error"
    });
  }
  function ubahData(){
    iziToast.question({
      timeout: 20000,
      close: false,
      overlay: true,
      displayMode: 'once',
      id: 'question',
      zindex: 999,
      title: 'Halo Webiners',
      message: 'Apakah anda ingin merubah data?',
      position: 'center',
      buttons: [
          ['<button><b>Ya</b></button>', function (instance, toast) {
            $('.input-check').removeAttr('readonly');
            $('#change').addClass('d-none');
            $('#save-close').removeClass('d-none');
            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
          }, true],
          ['<button>Tidak</button>', function (instance, toast) {
            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
          }],
      ]
    });
  }
  function closeData(){
    $('.input-check').attr('readonly', 'true');
    $('#change').removeClass('d-none');
    $('#save-close').addClass('d-none');
  }
</script>
<?php include('footer.php'); ?>
<?php } ?>
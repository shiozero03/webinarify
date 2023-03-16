<?php

  include('../php/session-user.php'); 
  if(isset($_SESSION['id_user'])){
  include('header.php');
  if(!$_GET['id'] || !$_GET['daftar']){
    header('Location: '.$base_url.'user');
  }
  $query = mysqli_query($conn, "SELECT * FROM event_webinar WHERE id_event = '".$_GET['id']."'" );
  
  $query2 = mysqli_query($conn, "SELECT * FROM daftar_webinar WHERE id_peserta = '".$_SESSION['id_user']."' AND id_event = '".$_GET['id']."'" );
  $query3 = mysqli_query($conn, "SELECT * FROM metode_pembayaran");
  
  $result = mysqli_fetch_assoc($query);
  $result2 = mysqli_fetch_assoc($query2);
  if(mysqli_num_rows($query2) == 0){
    header('Location: '.$base_url.'user/detail-pendaftar.php?id='.$_GET['id']);
  }
  if($result2['status'] == 'Diproses' || $result2['status'] == 'Success'){
    header('Location: '.$base_url.'user/detail-pendaftar.php?id='.$_GET['id']);
  }
  if(date($result['tanggal_event']) < date('Y-m-d')){
    header('Location: '.$base_url.'user/detail-pendaftar.php?id='.$_GET['id']);
  }


  if(isset($_POST['buktibayar'])){
    $idev = $_GET['id'];
    $idpen = $_GET['daftar'];
    
    $gambar = $_FILES['bukti']['name'];
    $tmp = $_FILES['bukti']['tmp_name'];
    $type = $_FILES['bukti']['type'];
    $path = '../assets/img/bukti-bayar/'.$gambar;
    
    if(move_uploaded_file($tmp, $path)){
      $queryupload = "UPDATE daftar_webinar SET bukti = '".$gambar."', status = 'Diproses' WHERE id_pendaftaran = '".$idpen."'";
      $finish = mysqli_query($conn, $queryupload);
      if ($finish == true) {
        echo('
          <script>
               iziToast.success({
                  title : "Sukses",
                  message: "Data pembayaran berhasil ditambahkan",
                  position: "center",
                  onClosing: function(instance, toast, closedBy){
                    window.location.href="'.$base_url.'user/detail-pendaftar.php?id='.$_GET['id'].'";
                  },
                })
          </script>
        ');
      } else{
        echo('
          <script>
               iziToast.error({
                  title : "Error",
                  message: "Data pembayaran gagal ditambahkan",
                  position: "center",
                  onClosing: function(instance, toast, closedBy){
                    window.location.href="'.$base_url.'user/pembayaran.php?id='.$_GET['id'].'";
                  },
                })
          </script>
        ');
      }
    } else{
      echo('
        <script>
             iziToast.error({
                title : "Error",
                message: "Data pembayaran gagal ditambahkan",
                position: "center",
                onClosing: function(instance, toast, closedBy){
                  window.location.href="'.$base_url.'user/pembayaran.php?id='.$_GET['id'].'";
                },
              })
        </script>
      ');
    }
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
  <?php echo $_SESSION['id_user']; if($queryCari != 0) { ?>
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
      <div class="mb-3"><strong><h3>Detail Partisipan</h3></strong></div>
      <div class="row">
        <div class="col-lg-3 mt-3">
          <img src="<?= $base_url ?>assets/img/<?=$result['gambar_event']?>" alt="" width="100%">
        </div>
        <div class="col-lg-9 mt-3">
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
            <table>
              <tr>
                <th><strong>Nama</strong></th>
                <td>:</td>
                <td><?= $result2['nama'] ?></td>
              </tr>
              <tr>
                <th><strong>Email</strong></th>
                <td>:</td>
                <td><?= $result2['email'] ?></td>
              </tr>
              <tr>
                <th><strong>Telepon</strong></th>
                <td>:</td>
                <td><?= $result2['telepon'] ?></td>
              </tr>
            </table>
          </section>
        </div>
      </div>
    </section>
    <hr>
    <?php if($result2['status'] == 'Belum Bayar') { ?>
      <section>
        <div style="box-shadow: 5px 5px 5px black" class="mb-4 px-md-5 py-md-4 px-3 py-2 bg-white rounded">
          <h3 class=""><strong>Pembayaran</strong></h3>
          <div class="row">
            <hr>
            <div class="col-md-6">
              <h4>Harga</h4>
            </div>
            <div class="text-end col-md-6">
              <h4><strong>Rp <?=number_format($result2['harga'],2,',','.')?></strong></h4>
            </div>
            <hr>
            <div class="col-md-6">
              <h4>Diskon</h4>
            </div>
            <div class="text-end col-md-6">
              <h4><strong>Rp 0</strong></h4>
            </div>
            <hr>
            <div class="col-md-6">
              <h4>Jumlah yang harus dibayar</h4>
            </div>
            <div class="text-end col-md-6">
              <h4><strong>Rp <?=number_format($result2['harga'],2,',','.')?></strong></h4>
            </div>
          </div>
        </div>
      </section>
      <section>
        <div style="box-shadow: 5px 5px 5px black" class="mb-4 px-md-5 py-md-4 px-3 py-2 bg-white rounded">
          <h3 class=""><strong>Pembayaran Online</strong></h3>
        <?php while($bayar = mysqli_fetch_assoc($query3)){ ?>
          <div>
            <label for="bank<?= $bayar['id_pembayaran'] ?>">
            <h3><input name="bank" id="bank<?= $bayar['id_pembayaran'] ?>" type="radio" onclick="cekpembayaran(<?= $bayar['id_pembayaran'] ?>)"> <img src="<?= $base_url ?>assets/img/<?= $bayar['icon'] ?>" width="75%" alt=""></h3>
            </label>
            <br>
            <h3 class="pembayaran-online" id="pembayaran<?= $bayar['id_pembayaran'] ?>"><?= $bayar['nomor_pembayaran'] ?></h3>
          </div>
        <?php } ?>
        </div>
        <div class="w-100 text-end">
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pembayaranmodel">Konfirmasi</button>
        </div>
      </section>
    <?php } ?>
  <?php } ?>
</div>
<div class="modal fade" id="pembayaranmodel" tabindex="-1" aria-labelledby="pembayaranmodelLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pembayaranmodelLabel">Modal Konfirmasi Pembayaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <input name="idpen" type="hidden" value="<?=$result2['id_pendaftaran']?>">
          <input type="hidden" name="idev" value="<?=$result2['id_event']?>">
          Upload Bukti Pembayaran Anda
          <br><br>
          <img id="imagefet" width="100%">
          <input type="file" name="bukti" class="form-control" required="" id="sisipkanGambar" accept="image/jpg, image/jpeg, image/png, image/svg, application/pdf">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button name="buktibayar" type="submit" class="btn btn-primary">Upload</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  $('.pembayaran-online').slideUp()
  function cekpembayaran(id){
    for (var i = 0; i < id; i++) {
      $('#pembayaran'+i).slideUp()
    }
    for (var i = 100; i > id; i--) {
      $('#pembayaran'+i).slideUp()
    }
    $('#pembayaran'+id).slideDown()
  }

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
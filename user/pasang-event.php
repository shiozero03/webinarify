<?php 
  include('../php/session-user.php');
  include('header.php');
  
  $query = mysqli_query($conn, "SELECT * FROM kategori_webinar");
  //$result = mysqli_fetch_assoc($query);
?>
<style>
  .top-search{
    float: right;
    width: 60%;
    margin-right: 5%;
    text-align: right;
  }
  input.image-upload{
    display: none;
  }
  textarea{
    font-size: 75%;
  }
</style>
<script src="../assets/ckeditor/ckeditor.js"></script>
<div class="top-search text-right">
  <i class="search text-white fas fa-search"></i>
  <input type="search" class="text-dark pencarian" placeholder="Cari Event Webinar" >
  <br><br>
  <div class="text-right me-4">
    <h2>
      <img src="../assets/img/tangan.svg" class="me-2">
      <b>Hi, <?= $resUser['nama_user'] ?> !</b>
    </h2>
  </div>
</div>
<div class="clearfix"></div>
<div class="content container">
  <h3><strong>Pasang Event</strong></h3>
  <br>
  <div>
    <form action="../php/api-insert.php" method="post" enctype="multipart/form-data">
      <h5><strong>Unggah Foto</strong></h5>
      <p class="image_upload" style="border: 1px solid black; width:10%; border-radius: 15px" class="p-2">
        <label for="userImage">
        <a class="p-2">
          <img src="../assets/img/add.ico" alt="" width="80%" class="p-2">
        </a>
        </label>
        <input class="image-upload" type="file" name="userImage" id="userImage">
        </p>
        
        <h5 class="mt-2"><strong>JUDUL <b class="text-danger">*</b></strong></h5>
        <input name="judul" type="text" class="form-control" style="width: 100%">
        
        <div style="">
          <h5 class="mt-3"><strong>DESKRIPSI <span class="text-danger">*</span></strong></h5>
          <textarea name="deskripsi" class="ckeditor" id="ckeditor"></textarea>
        </div>
        
        <div style="">
        <h5 class="mt-3"><strong>MANFAAT <span class="text-danger">*</span></strong></h5>
        <textarea name="manfaat" class="ckeditor" id="ckeditor"></textarea>
        </div>
        
        <h5 class="mt-3"><strong>PRASYARAT <b class="text-danger">*</b></strong></h5>
        <input name="prasyarat" type="text" class="form-control" style="width: 100%">
        
        <div class="float-start col-5">
          <h5 class="mt-3"><strong>TANGGAL PELAKSANAAN <b class="text-danger">*</b></strong></h5>
          <input name="tanggal_event" type="date" class="form-control" style="width: 100%">
        </div>
        <div class="float-end col-6">
          <h5 class="mt-3"><strong>WAKTU <b class="text-danger">*</b></strong></h5>
          <input name="waktu_event" type="time" class="form-control" style="width: 100%">
        </div>
        <div class="clearfix"></div>
        
        <div class="float-start col-5">
          <h5 class="mt-3"><strong>AKHIR PENDAFTARAN <b class="text-danger">*</b></strong></h5>
          <input name="tanggal_daftar" type="date" class="form-control" style="width: 100%">
        </div>
        <div class="float-end col-6">
          <h5 class="mt-3"><strong>WAKTU <b class="text-danger">*</b></strong></h5>
          <input name="waktu_daftar" type="time" class="form-control" style="width: 100%">
        </div>
        <div class="clearfix"></div>
        
        <h5 class="mt-3"><strong>PELAKSANAAN <b class="text-danger">*</b></strong></h5>
        <label for="online">
          <input value="Online" type="radio" name="pelaksanaan" id="online"> Online
        </label>
        <br>
        <label for="offline">
          <input value="Offline" type="radio" name="pelaksanaan" id="offline"> Offline
        </label>
        
        <h5 class="mt-3"><strong>KATEGORI <b class="text-danger">*</b></strong></h5>
        <select style="width: 100%" name="kategori" class="form-control" id="">
          <?php while($result = mysqli_fetch_assoc($query)){ ?>
          <option value="<?= $result['id_kategoriwebinar'] ?>"><?= $result['nama_kategoriwebinar'] ?></option>
          <?php } ?>
        </select>
        <h5 class="mt-3"><strong>HARGA <b class="text-danger">*</b></strong></h5>
        <input name="harga" type="number" min="0" class="form-control" style="width: 100%">
        
        <h5 class="mt-3"><strong>EMAIL <b class="text-danger">*</b></strong></h5>
        <input name="email" type=email class="form-control" style="width: 100%">
        
        <h5 class="mt-3"><strong>INSTAGRAM <b class="text-danger">*</b></strong></h5>
        <input name="instagram" type="text" class="form-control" style="width: 100%">
        
        <h5 class="mt-3"><strong>NOMOR WHATSAPP <b class="text-danger">*</b></strong></h5>
        <input name="no_wa" type="number" class="form-control" style="width: 100%">
        <div class="float-end mt-3">
          <button name="simpan" style="border: none; background-color: #52A6BE; border-radius: 25px" class="pt-2 pb-2 ps-5 pe-5 text-white">Simpan</button>
        </div>
        <div class="clearfix"></div>
    </form>
    <br>
  </div>
</div>


<?php include('footer.php'); ?>
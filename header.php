<?php

  include 'php/config.php';
  
  $queryCategory = "SELECT * FROM kategori_webinar ORDER BY id_kategoriwebinar";
  $queryForm = mysqli_query($conn, $queryCategory);
  
  $queryTrending = mysqli_query($conn, "SELECT * FROM event_webinar WHERE trending = 1 ORDER BY tanggal_event DESC");

  $queryEvent = "SELECT * FROM event_webinar ORDER BY tanggal_event DESC LIMIT 3";
  $queryForm2 = mysqli_query($conn, $queryEvent);

  
  $queryTesti = "SELECT * FROM testimoni_event ORDER BY id_testimoni ASC LIMIT 3";
  $queryForm3 = mysqli_query($conn, $queryTesti);

  $queryCari = 0;  
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Webinarify</title>
    <link rel="shortcut icon" href="<?= $base_url ?>assets/img/logo.png">
    <link rel="stylesheet" type="text/css" href="<?= $base_url ?>assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $base_url ?>assets/assets-css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $base_url ?>assets/assets-css/style.css">
    <link rel="stylesheet" type="text/css" href="<?= $base_url ?>assets/assets-css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $base_url ?>assets/assets-css/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="<?= $base_url ?>assets/assets-css/iziToast.min.css">
    <script type="text/javascript" src="<?= $base_url ?>assets/assets-js/jquery.min.js"></script>
    <script type="text/javascript" src="<?= $base_url ?>assets/assets-js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="<?= $base_url ?>assets/assets-js/iziToast.min.js"></script>
    <style type="text/css">
      body{
        background-image: url('assets/img/latar2.png');
        background-attachment: fixed;
        background-repeat: no-repeat;
        background-size: 100% auto;
        font-family: 'Playfair Display', serif;
      }
    </style>
  </head>
<?php
  if(isset($_POST['submit-search'])){
    $querySearch = 'SELECT * FROM event_webinar WHERE judul_event LIKE "%'.$_POST['search'].'%" ORDER BY tanggal_event DESC';
    $queryFormSearch = mysqli_query($conn, $querySearch);
    if(mysqli_num_rows($queryFormSearch) == 0){
      ?>
        <script type="text/javascript">
          iziToast.error({
            title: "Gagal Memuat Halaman !",
            message: 'Data yang anda cari tidak ada !',
            position: 'topCenter'
          });
        </script>
      <?php
      $queryCari = 0;
    } else {
      $queryCari = 1;
    }
  }
?>
  <body class="w-100">
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="<?= $base_url ?>assets/img/logo.png" alt="logo" height="50" class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler border-white border" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars text-white"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link transition-5s mx-lg-2 text-lg-start text-center" href="<?= $base_url ?>">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link transition-5s mx-lg-2 text-lg-start text-center" href="javascript:void(0)" onclick="haruslogin()">Kontak Kami</a>
            </li>
            <li class="nav-item">
              <a class="nav-link transition-5s bg-secondary rounded px-lg-3 mx-lg-2 text-lg-start text-center" href="<?= $base_url ?>login.php" >Masuk</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="float-md-end col-lg-7 col-md-6 me-md-5 ms-3">
      <form class="position-relative" method="post">
        <button class="search" name="submit-search"><i class="text-white fas fa-search"></i></button>
        <input type="text" class="pencarian ps-5" name="search" placeholder="Cari Event Webinar">
      </form>
    </div>
    <div class="clearfix"></div>
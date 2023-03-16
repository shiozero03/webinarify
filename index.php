<?php 
  include('php/session-login.php');
  include('header.php');
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
    <section>
      <div class="d-md-flex align-items-center">
        <div class="col-lg-7 col-md-6 d-md-none">
          <img src="<?= $base_url ?>assets/img/beranda-picture1.png" alt="" width="100%">
        </div>
        <div class="col-lg-5 col-md-6">
          <b>
            <h1 class="opening text-md-start text-center">
                Hallo, <br>Generasi Muda Indonesia
            </h1>
          </b>
        </div>
        <div class="col-lg-7 col-md-6 d-md-block d-none">
          <img src="<?= $base_url ?>assets/img/beranda-picture1.png" alt="" width="100%">
        </div>
      </div>
    </section>
    <section class="mt-4">
      <h3 class="ms-2">Kategori</h3>
      <div class="owl-carousel owl-theme category">
        <?php
          while($resultKategori = mysqli_fetch_assoc($queryForm)){
        ?>
          <div class="item">
            <div class="kategori-item text-dark bg-white w-100 m-2 transition-5s">
              <a href="javascript:void(0)" onclick="haruslogin()" class="text-dark text-decoration-none">
                <div class="d-flex align-items-center">
                  <div class="col-3 me-2">
                    <img src="<?= $base_url ?>assets/img/<?= $resultKategori['icon_kategoriwebinar'] ?>" height="45px" alt="">
                  </div>
                  <h5>
                    <?= $resultKategori['nama_kategoriwebinar'] ?>
                  </h5>
                  <div class="clearfix"></div>
                </div>
              </a>
            </div>
          </div>
        <?php } ?>
      </div>
    </section>
    <section class="mt-4">
      <div class="row">
        <div class="event-trending text-dark">
          <h3 class="ms-2 mb-2">Event Trending <i class="text-warning fa-solid fa-fire-flame-curved"></i></h3>
          <div class="trending">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
              <div class="carousel-inner">
                <?php
                  while($queryTrend = mysqli_fetch_assoc($queryTrending)){
                ?>
                <div class="carousel-item trending-banner">
                  <div class="d-flex align-items-center justify-content-center p-3 border trend-banner m-3">
                    <div class="col-md-3 col-12">
                      <img src="<?= $base_url ?>assets/img/<?=$queryTrend['gambar_event']?>" class="d-block w-100" alt="...">
                    </div>
                    <div class="ms-3 d-md-block d-none">
                      <h2 class="d-lg-block d-none">
                        <?= $queryTrend['judul_event'] ?>
                      </h2>
                      <h5 class="d-lg-none">
                        <?= $queryTrend['judul_event'] ?>
                      </h5>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="mt-4">
      <div class="event-terdekat text-dark">
          <h3 class="ms-2 mb-2 mt-5">Event Terdekat</h3>
          <?php
            while($resultEvent = mysqli_fetch_assoc($queryForm2)){
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
      </div>
    </section>
    <section class="mt-4">
      <div>
        <h3 class="ms-2 mb-2 mt-5">Testimonial</h3>
        <div>
          <div id="testimoni" class=" carousel slide py-4 px-md-5 px-3" style="border: 1px solid gray; border-radius: 25px" data-bs-ride="true">
            <div class="carousel-inner">
              <?php
                while($resultTesti = mysqli_fetch_assoc($queryForm3)){
              ?>
              <div class="carousel-item testimoni-content">
                <div class="d-flex justify-content-center align-items-center">
                  <div class="col-md-1 col-3 bg-dark rounded-circle overflow-hidden me-lg-5 me-md-4 me-3">
                    <img src="<?= $base_url ?>assets/img/user.png" width="100%">
                  </div>
                  <div>
                    <?php for($i = 1; $i <= $resultTesti['bintang']; $i++) { ?>
                      <i class="fas fa-star text-warning"></i>
                    <?php } ?>
                    <?php for($i = 5; $i > $resultTesti['bintang']; $i--) { ?>
                    <i class="far fa-star text-warning"></i>
                    <?php } ?>
                    <h3 class="text-dark"><?= $resultTesti['nama_pentestimoni'] ?></h3>
                  </div>
                </div>
                <div class="text-center mx-md-5 mt-4">
                  <?= $resultTesti['isi_testimoni'] ?>
                </div>
              </div>
              <?php } ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#testimoni" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#testimoni" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </section>
  <?php } ?>
</div>
<script type="text/javascript">
  document.getElementsByClassName('trending-banner')[0].classList.add('active');
  document.getElementsByClassName('testimoni-content')[0].classList.add('active');
  $('.category').owlCarousel({
    loop:true,
    margin:17.5,
    nav:true,
    navText: ["<div class='bg-dark nav-owl-button owl-prev'>‹</div>", "<div class='bg-dark nav-owl-button owl-next'>›</div>"],
    autoplay:true,
    autoplayTimeout:4000,
    responsive:{
      0:{
        items:1
      },
      600:{
        items:2
      },
      1000:{
        items:4
      }
    }
  })
</script>
<?php include('footer.php'); ?>
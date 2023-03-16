    <footer class="mt-4">
      <div class="mt-4 pt-4" style="border-top: 1px solid black; width: 100%">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-md-6 me-lg-5 mx-2 mb-2">
              <img src="<?= $base_url ?>assets/img/logofooter.png" width="75%" alt="">
              <p class="ms-4" style="font-size: 120%; line-height: 110%; font-weight: 100px">
                Layanan penyedia kegiatan webinar yang mudah dan luas yang ada di nusantara
              </p>
            </div>
            <div class="col-lg-3 ms-lg-5 mb-2 col-md-6">
              <h5>Hubungi Kami</h5>
              <ul class="hubungi-kami">
                <li class="d-block">
                  <b><i class="fab fa-instagram"></i></b> @webinarify.id
                </li>
                <li class="d-block">
                  <b></b><i class="fab fa-whatsapp"></i></b> 08155146001
                </li>
                <li class="d-block">
                  <b><i class="far fa-envelope"></i></b> webinarify@gmail.com
                </li>
              </ul>
             </div>
            <div class="col-lg-3 col-md-6 ms-lg-5 mb-2">
              <h5>Lainnya</h5>
              <ul class="hubungi-kami">
                <li class="d-block">
                  <a href="javascript:void(0)" onclick="haruslogin()" style="text-decoration: none; color: black">Kebijakan Privasi</a>
                </li>
                <li class="d-block">
                  <a href="javascript:void(0)" onclick="haruslogin()" style="text-decoration:none; color: black">Syarat dan Ketentuan Umum</a>
                </li>
              </ul>
            </div>
        </div>
      </div>
      <br>
      <div class="bg-dark text-white text-center py-1">
        <small>
          <script>
            var tahun = new Date
            document.write(tahun.getFullYear())
          </script> 
          &copy; WEBINARIFY, All right reserved
        </small>
      </div>
    </footer>
    <script type="text/javascript" src="<?= $base_url ?>assets/assets-js/bootstrap/bootstrap.bundle.min.js"></script>
    <script>
      function haruslogin(){
        iziToast.error({
          title: "Gagal Memuat Halaman !",
          message: 'Anda Harus Login Terlebih Dahulu !',
          position: 'topCenter'
        });
      }
    </script>
  </body>
</html>
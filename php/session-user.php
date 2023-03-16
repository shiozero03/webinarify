<?php

  session_start();
  
  include('config.php');

?>
<body>
  <link rel="stylesheet" type="text/css" href="<?= $base_url ?>assets/assets-css/iziToast.min.css">
  <script type="text/javascript" src="<?= $base_url ?>assets/assets-js/jquery.min.js"></script>
  <script type="text/javascript" src="<?= $base_url ?>assets/assets-js/iziToast.min.js"></script>
<?php
  if (!isset($_SESSION['id_user'])) {
    echo('        
      <script>
          iziToast.error({
            title: "Gagal Memuat Halaman !",
            message: "Silahkan login terlebih dahulu !",
            position: "topCenter",
            onClosing: function(instance, toast, closedBy){
              window.location.href="'.$base_url.'";
            },
          });
      </script>
    ');
  }
?>
</body>
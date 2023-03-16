<?php

  session_start();
  
  include('config.php');

?>
<body>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php

  if (isset($_POST['ganti'])) {
    $user = $_POST['username'];
    $nama = $_POST['nama'];
    $telp = $_POST['telepon'];
    $email = $_POST['email'];
    $pekerjaan = $_POST['pekerjaan'];
    $jenis = $_POST['jenis'];
    $pass = $_POST['newpassword'];
    
    if($pass == ''){
      $query = "UPDATE user SET username = '".$user."', nama_user = '".$nama."', telepon = '".$telp."', email_user = '".$email."', pekerjaan_user = '".$pekerjaan."', jeniskelamin_user = '".$jenis."' WHERE id_user = '".$_SESSION['id_user']."'";
    } else{
      $query = "UPDATE user SET username = '".$user."', nama_user = '".$nama."', telepon = '".$telp."', email_user = '".$email."', pekerjaan_user = '".$pekerjaan."', jeniskelamin_user = '".$jenis."', password = '".md5($pass)."' WHERE id_user = '".$_SESSION['id_user']."'";
    }
    
    if(mysqli_query($conn, $query) == true){
      echo('
        <script>
            swal({
              title: "Success",
              text: "Data Anda Berhasil Diupdate !",
              icon: "success"
            }).then(function(){
              window.location.href="../user/edit-profil.php?'.base64_encode(random_bytes(32)).'";
            });
        </script>
      ');
    } else {
      echo(mysqli_error(mysqli_query($conn, $query)));
    }
  } elseif(isset($_POST['buktibayar'])){
    $idev = $_POST['idev'];
    $idpen = $_POST['idpen'];
    
    $gambar = $_FILES['bukti']['name'];
    $tmp = $_FILES['bukti']['tmp_name'];
    $type = $_FILES['bukti']['type'];
    $path = '../assets/img/'.$gambar;
    
    if(move_uploaded_file($tmp, $path)){
      $query = "UPDATE daftar_webinar SET bukti = '".$gambar."', status = 'Menunggu Konfirmasi' WHERE id_pendaftaran = '".$idpen."'";
      $finish = mysqli_query($conn, $query);
      if ($finish == true) {
        echo('
          <script>
              swal({
                title: "Success",
                text: "Berhasil Melakukan Upload Pembayaran !",
                icon: "success"
              }).then(function(){
                window.location.href="../user/pembayaran.php?id='.$idev.'&&'.base64_encode(random_bytes(32)).'";
              });
          </script>
        ');
      } else{
      echo('
        <script>
            swal({
              title: "Gagal",
              text: "Gagal Melakukan Upload Pembayaran !",
              icon: "error"
            }).then(function(){
              window.location.href="../user/pembayaran.php?id='.$idev.'&&'.base64_encode(random_bytes(32)).'";
            });
        </script>
      ');
      }
    } else{
      
    }
  }

?>
</body>
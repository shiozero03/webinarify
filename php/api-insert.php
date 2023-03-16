<?php

  session_start();
  
  include('config.php');

?>
<body>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
  if(isset($_POST['simpan'])){
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $manfaat = $_POST['manfaat'];
    $prasyarat = $_POST['prasyarat'];
    $tanggalE = $_POST['tanggal_event'];
    $waktuE = $_POST['waktu_event'];
    $tanggalD = $_POST['tanggal_daftar'];
    $pelaksanaan = $_POST['pelaksanaan'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $email = $_POST['email'];
    $instagram = $_POST['instagram'];
    $wa = $_POST['no_wa'];
    
    $gambar = $_FILES['userImage']['name'];
    $tmp = $_FILES['userImage']['tmp_name'];
    $type = $_FILES['userImage']['type'];
    $path = '../assets/img/'.$gambar;
    
    if(move_uploaded_file($tmp, $path)){
      $query = "INSERT INTO event_webinar(judul_event, tanggal_event, id_kategoriwebinar, gambar_event, deskripsi, manfaat, prasyarat, waktu, akhir_pendaftaran, pelaksanaan, harga, email, instagram, whatsapp) VALUES('".$judul."', '".$tanggalE."', '".$kategori."', '".$gambar."', '".$deskripsi."', '".$manfaat."', '".$prasyarat."', '".$waktuE."', '".$tanggalD."', '".$pelaksanaan."', '".$harga."', '".$email."', '".$instagram."', '".$wa."')";
      $finish = mysqli_query($conn, $query);
      if ($finish == true) {
        echo('
          <script>
              swal({
                title: "Success",
                text: "Berhasil Menambahkan Event !",
                icon: "success"
              }).then(function(){
                window.location.href="../user/profil.php?'.base64_encode(random_bytes(32)).'";
              });
          </script>
        ');
      } else{
      echo('
        <script>
            swal({
              title: "Gagal",
              text: "Gagal Menambahkan Event!",
              icon: "error"
            }).then(function(){
              window.location.href="../user/pasang-event.php?'.base64_encode(random_bytes(32)).'";
            });
        </script>
      ');
      }
    } else{
      
    }
 
  } elseif(isset($_POST['detail'])){
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telp = $_POST['telepon'];
    $wa = $_POST['wa'];
    $pend = $_POST['pendidikan'];
    $harga = $_POST['harga'];
    $idpes = $_SESSION['id_user'];
    $idev = $_POST['id_event'];
    
    $query = mysqli_query($conn, "INSERT INTO daftar_webinar(id_peserta, id_event, nama, email, telepon, whatsapp, pendidikan, harga, status) VALUES ('".$idpes."', '".$idev."', '".$nama."', '".$email."', '".$telp."', '".$wa."', '".$pend."', '".$harga."', 'Belum Bayar')");
    
    if ($query == true) {
      echo('
        <script>
            swal({
              title: "Berhasil Daftar",
              text: "Berhasil daftar pada event !",
              icon: "success"
            }).then(function(){
              window.location.href="../user/detail-pendaftar.php?id='.$idev.'&&'.base64_encode(random_bytes(32)).'";
            });
        </script>
      ');
    } else {
      echo('
        <script>
            swal({
              title: "Gagal",
              text: "Gagal Daftar ! ",
              icon: "error"
            }).then(function(){
              window.location.href="../user/detail-pendaftar.php?id='.$idev.'&&'.base64_encode(random_bytes(32)).'";
            });
        </script>
      ');
    }
    
  }
?>
</body>
<?php

  include('config.php');
?>
<body>
  <script type="text/javascript" src="assets/assets-js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/assets-js/iziToast.min.js"></script>
<?php
  if (isset($_POST['daftar'])) {
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $password = $_POST['password'];
    
    $query = mysqli_query($conn, "INSERT INTO user(username, email_user, nama_user, telepon, password, level) VALUES('".$username."', '".$email."', '".$nama."', '".$telepon."', '".md5($password)."', 'user')");
    if($query){
      echo('
        <script>
            swal({
              title: "Success",
              text: "Data Anda Berhasil Didaftarkan !",
              icon: "success"
            }).then(function(){
              window.location.href="../login.php";
            });
        </script>
      ');
    } else {
      echo('
        <script>
            swal({
              title: "Failed",
              text: "Data Anda Gagal Didaftarkan !",
              icon: "Error"
            }).then(function(){
              window.location.href="../register.php";
            });
        </script>
      ');
    }
  }

?>
</body>
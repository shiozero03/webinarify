<?php
  session_start();
  include('config.php');
?>
<body>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
  if (isset($_POST['masuk'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $token = base64_encode(random_bytes(32));
    $queryUsername = mysqli_query($conn, "SELECT * FROM user WHERE username = '".$user."'");
    $queryEmail = mysqli_query($conn, "SELECT * FROM user WHERE email_user = '".$user."'");
    
    if(mysqli_num_rows($queryUsername) > 0){
      $resUser = mysqli_fetch_assoc($queryUsername);
      if ($resUser['password'] != md5($pass)) {
        echo('        
          <script>
              swal({
                title: "Gagal Login",
                text: "Password anda salah !",
                icon: "error"
              }).then(function(){
                window.location.href="../login.php";
              });
          </script>
        ');
      } else{
        if ($resUser['level'] == 'user') {
          $_SESSION['id_user'] = $resUser['id_user'];
          echo('        
            <script>
                swal({
                  title: "Login Berhasil",
                  text: "Berhasil Login Sebagai User!",
                  icon: "success"
                }).then(function(){
                  window.location.href="../user/index.php?'.$token.'";
                });
            </script>
          ');
        }else {
          // code...
        }
      }
    } elseif (mysqli_num_rows($queryEmail) > 0) {
      $resEmail = mysqli_fetch_assoc($queryEmail);
      if ($resEmail['password'] != md5($pass)) {
        echo('        
          <script>
              swal({
                title: "Gagal Login",
                text: "Password anda salah !",
                icon: "error"
              }).then(function(){
                window.location.href="../login.php";
              });
          </script>
        ');
      } else{
        if ($resEmail['level'] == 'user') {
          $_SESSION['id_user'] = $resEmail['id_user'];
          echo('        
            <script>
                swal({
                  title: "Login Berhasil",
                  text: "Berhasil Login Sebagai User!",
                  icon: "success"
                }).then(function(){
                  window.location.href="../user/index.php?'.$token.'";
                });
            </script>
          ');
        }else {
          // code...
        }
      }
    } else {
      echo('        
        <script>
            swal({
              title: "Gagal Login",
              text: "Username/Email tidak ditemukan !",
              icon: "error"
            }).then(function(){
              window.location.href="../login.php";
            });
        </script>
      ');
    }
  }
?>
</body>
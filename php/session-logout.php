<?php

  session_start();
  
  session_unset();
  session_destroy();

?>
<body>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  swal({
    title: "Berhasil Logout!",
    text: "Anda Berhasil Logout !",
    icon: "success"
  }).then(function(){
    window.location.href="../index.php";
  });
</script>
</body>
    
    
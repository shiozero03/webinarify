<?php

  session_start();
  
  include('config.php');

?>
<body>
<?php
  if (isset($_SESSION['id_user'])) {
    echo('
      <script>
        window.location.href = "'.$base_url.'user"
      </script>
    ');
  }
?>
</body>
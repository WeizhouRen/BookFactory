<?php

setcookie('userid','',time()-3600);
session_start();
session_destroy();
unset($_SESSION);
echo "<script>location='index.php'</script>";

?>
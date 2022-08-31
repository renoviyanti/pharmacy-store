<?php
session_start();
//menghancurkankan $_SESSION["pelanggan"]
session_destroy();

echo "<script>alert('anda telah logout');</script>";
echo "<script>location='index.php';</script>";

?>
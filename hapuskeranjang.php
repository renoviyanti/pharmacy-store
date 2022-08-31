<?php
session_start();
$id_obat=$_GET["id_obat"];
unset($_SESSION["keranjang"][$id_obat]);

echo "<script>alert('Produk dihapus dari keranjang');</script>";
echo "<script>location='keranjang.php';</script>";
?>
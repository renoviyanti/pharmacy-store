<?php
session_start();
//mendapatkan id_obat dari url
$id_obat = $_GET['id_obat'];

//jika sdh ada obat di keranjang, maka jmlh obat di +1
if(isset($_SESSION['keranjang'][$id_obat]))
{
    $_SESSION['keranjang'][$id_obat]+=1;
}
//jika blm ada di keranjang, maka produk dianggap dibeli 1
else{
    $_SESSION['keranjang'][$id_obat] = 1;
}

//echo "<pre>";
//print_r($_SESSION);
//echo "</pre";

//larikan ke halaman keranjang
echo "<script>alert('obat telah masuk ke keranjang belanja');</script>";
echo "<script>location='keranjang.php';</script>";
    ?>
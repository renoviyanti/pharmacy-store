<?php

$ambil = $link->query("SELECT * FROM obat WHERE id_obat = '$_GET[id]'");
$pecah = $ambil->fetch_assoc();
$fotoobat = $pecah['foto_obat'];
if (file_exists("../foto_obat/$fotoobat"))
{
	unlink("../foto_obat/$fotoobat");
}

$link->query("DELETE FROM obat WHERE id_obat = '$_GET[id]'");

echo "<script>alert('produk terhapus');</script>";
echo "<script>location='index.php?halaman=obat';</script>";

?>
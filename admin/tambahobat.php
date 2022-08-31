<?php
$link = new mysqli("localhost", "root", "", "farmasinaviha");
?>

<h2>Tambah Produk</h2>
<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="nama">
	</div>
	<div class="form-group">
		<label>Harga (Rp)</label>
		<input type="number" class="form-control" name="harga">
	</div>
	<div class="form-group">
		<label>Deskripsi</label>
		<textarea class="form-control" name="deskripsi" rows="3 "></textarea>
	</div> 
	<div class="form-group">
		<label>Jenis Obat</label>
		<input type="text" class="form-control" name="jenis">
	</div>
	<div class="form-group">
		<label>Stok</label>
		<input type="text" class="form-control" name="stok">
	</div>
	<div class="form-group">
		<label>Foto</label>
		<input type="file" class="form-control" name="foto">
	</div>
	<button class="btn btn-primary" name="save">Simpan</button>
</form>

<?php 
if (isset($_POST['save']))
{
	$nama = $_FILES['foto']['name'];
	$lokasi = $_FILES['foto']['tmp_name'];
	move_uploaded_file($lokasi, "../foto_obat/".$nama);
	
	$link->query("INSERT INTO obat (nama_obat, harga_obat, deskripsi_obat, jenis_obat, foto_obat, stok_obat) VALUES ('$_POST[nama]', '$_POST[harga]', '$_POST[deskripsi]', '$_POST[jenis]', '$nama', '$_POST[stok]')");

	echo "<div class='alert alert-info'>Data Tersimpan</div>";
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=obat'>";
}
?>


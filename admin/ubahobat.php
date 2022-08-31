<h2>Ubah Obat</h2>
<?php

$ambil = $link->query("SELECT * FROM obat WHERE id_obat = '$_GET[id]'");
$pecah = $ambil->fetch_assoc();

//echo "<pre>";
//print_r ($pecah);
//echo "</pre>";

?>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama Obat</label>
		<input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_obat']; ?>">
	</div>
	<div class="form-group">
		<label>Harga Rp</label>
		<input type="number" class="form-control" name="harga" value="<?php echo $pecah['harga_obat']; ?>">
	</div>
	<div class="form-group">
		<label>Deskripsi</label>
		<textarea name="deskripsi" class="form-control" rows="5">
			<?php echo $pecah['deskripsi_obat']; ?>
		</textarea>
	</div>
	<div class="form-group">
		<label>Jenis Obat</label>
		<input type="text" name="jenis" class="form-control" value="<?php echo $pecah['jenis_obat']; ?>">
	</div>
	<div class="form-group">
		<label>Stok</label>
		<input type="number" name="stok" class="form-control" value="<?php echo $pecah['stok_obat']; ?>">
	</div>
	<div class="form-group">
		<img src="../foto_obat/<?php echo $pecah['foto_obat'] ?>" width="200">		
	</div>
	<div class="form-group">
		<label>Ganti Foto</label>
		<input type="file" name="foto" class="form-control">
	</div>
	<button class="btn btn-primary" name="ubah">Ubah</button>
</form>

<?php

if (isset($_POST['ubah']))
{
	$namafoto = $_FILES['foto']['name'];
	$lokasifoto = $_FILES['foto']['tmp_name'];
	//jika foto dirubah
	if (!empty($lokasifoto))
	{
		move_uploaded_file($lokasifoto, "../foto_obat/$namafoto");

		$link->query("UPDATE obat SET nama_obat='$_POST[nama]', harga_obat='$_POST[harga]', deskripsi_obat='$_POST[deskripsi]', jenis_obat='$_POST[jenis]', stok_obat='$_POST[stok]', foto_obat='$namafoto' WHERE id_obat='$_GET[id]'");
	}
	else
	{
		$link->query("UPDATE obat SET nama_obat='$_POST[nama]', harga_obat='$_POST[harga]', deskripsi_obat='$_POST[deskripsi]', jenis_obat='$_POST[jenis]', stok_obat='$_POST[stok]' WHERE id_obat='$_GET[id]'");
	}
	echo "<script>alert('data obat telah diubah');</script>";
	echo "<script>location='index.php?halaman=obat';</script>";
}

?>
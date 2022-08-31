<h2>Data Obat</h2>

<table class="table table-bordered">
	<thead>
		<tr>
			<th><center>No</center></th>
			<th><center>Nama Obat</center></th>
			<th><center>Harga Satuan</center></th>
			<th><center>Deskripsi</center></th>
    		<th><center>Jenis</center></th>
    		<th><center>Stok</center></th>
			<th><center>Gambar</center></th>
			<th><center>Opsi</center></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$nomor=1;
		$ambil= $link->query("SELECT * FROM obat");
		while ($pecah = $ambil->fetch_assoc()){
		?>
		<tr>
			<td><center><?php echo $nomor; ?></center></center></td>
			<td><center><?php echo $pecah['nama_obat'] ?></center></td>
			<td><center><?php echo number_format($pecah['harga_obat']) ?></center></td>
			<td><center><?php echo $pecah['deskripsi_obat'] ?></center></td>
			<td><center><?php echo $pecah['jenis_obat'] ?></center></td>
			<td><center><?php echo $pecah['stok_obat'] ?></center></td>
			<td><center><img src="../foto_obat/<?php echo $pecah['foto_obat'];?>" height="100" width="100"></center></td>

			<td><center>
				<a href="index.php?halaman=hapusobat&id=<?php echo $pecah['id_obat']; ?>" class="btn-danger btn">Hapus</a>
				<a href="index.php?halaman=ubahobat&id=<?php echo $pecah['id_obat']; ?>" class="btn btn-warning">Ubah</a></center>
			</td>
		</tr>
		<?php $nomor++ ?>
		<?php } ?>
	</tbody>
</table>
<a href="index.php?halaman=tambahobat" class="btn btn-primary">Tambah Data</a>
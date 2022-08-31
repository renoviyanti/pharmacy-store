<h2>Data Pelanggan</h2>
<table class="table table-bordered">
	<thead>
		<th><center>No</center></th>
		<th><center>Email</center></th>
		<th><center>Nama</center></th>
		<th><center>Alamat</center></th>
		<th><center>Kota</center></th>
		<th><center>Provinsi</center></th>
		<th><center>Kode Pos</center></th>
		<th><center>Telephone</center></th>
		<th><center>Aksi</center></th>
	</thead>
	<tbody>
		<?php
		$nomor=1;
		$ambil = $link->query("SELECT * FROM pelanggan"); ?>
		<?php while($pecah = $ambil->fetch_assoc()){ ?>	
		<tr>
			<td><center><?php echo $nomor; ?></center></td>
			<td><center><?php echo $pecah['email_plg']; ?></center></td>
			<td><center><?php echo $pecah['nama_plg']; ?></center></td>
			<td><center><?php echo $pecah['alamat_plg']; ?></center></td>
			<td><center><?php echo $pecah['kota_plg']; ?></center></td>
			<td><center><?php echo $pecah['provinsi_plg']; ?></center></td>
			<td><center><?php echo $pecah['kodepos_plg']; ?></center></td>
			<td><center><?php echo $pecah['telp_plg']; ?></center></td>
			<td><center>
				<a href="" class="btn btn-danger">Hapus</a>
			</td></center>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>
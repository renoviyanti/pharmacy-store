<h2>Data Pembelian</h2>

<table class="table table-bordered">
	<thead>
		<tr>
			<th><center>No</center></th>
			<th><center>Nama Pelanggan</center></th>
			<th><center>Tanggal</center></th>
			<th><center>Status Pembelian</center></th>
			<th><center>Total</center></th>
			<th><center>Aksi</center></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$nomor=1;
		$ambil=$link->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_plg=pelanggan.id_plg"); ?>
			<?php while($pecah = $ambil->fetch_assoc()){ ?>
			<tr>
				<td><center><?php echo $nomor; ?></center></td>
				<td><center><?php echo $pecah['nama_plg']; ?></center></td>
				<td><center><?php echo $pecah['tanggal_pembelian']; ?></center></td>
				<td><center><?php echo $pecah['status_pengiriman']; ?></center></td>
				<td><center><?php echo $pecah['total_pembelian']; ?></center></td>
				<td>
					<center><a href="index.php?halaman=detail&id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-info">detail</a>

					<?php if ($pecah['status_pengiriman']!=="pending"): ?>
					<a href="index.php?halaman=pembayaran&id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-success">Lihat Pembayaran</a>
					<?php endif ?>					
				</td>
			</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>
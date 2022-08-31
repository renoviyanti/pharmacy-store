<h2>Detail Pembelian</h2>
<?php
$link = new mysqli("localhost", "root", "", "farmasinaviha"); 
$ambil = $link->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_plg=pelanggan.id_plg WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>

<!-- <pre><?php //print_r($detail); ?></pre> -->

<div class="row">
	<div class="col-md-4">
		<h3>Pembelian</h3>
		<p>
			Tanggal : <?php echo $detail['tanggal_pembelian']; ?>
			<br>
			Total 	: Rp. <?php echo number_format($detail['total_pembelian']); ?><br>
			Status	: <?php echo $detail["status_pengiriman"]; ?>
		</p>
	</div>
	<div class="col-md-4">
		<h3>Pelanggan</h3>
		<strong><?php echo $detail['nama_plg']; ?></strong>
		<p>
			<?php echo $detail['email_plg']; ?>
			<br>
			<?php echo $detail['alamat_plg']; ?>
			<br>
			<?php echo $detail['kota_plg']; ?>
			<br>
			<?php echo $detail['provinsi_plg']; ?>
			<br>
			<?php echo $detail['telp_plg']; ?>
		</p>
	</div>
	<div class="col-md-4">
		<h3>Pengiriman</h3>
		<strong><?php echo $detail["nama_kota"]; ?></strong><br>
		<p>
			Tarif	: Rp. <?php echo number_format($detail["tarif"]); ?><br>
			Alamat 	: <?php echo $detail["alamat_pengiriman"]; ?>
		</p>
	</div>
</div>

<table class="table table-bordered">
	<thead>
		<tr>
			<th><center>No</center></th>
			<th><center>Nama Obat</center></th>
			<th><center>Harga</center></th>
			<th><center>Jumlah</center></th>
			<th><center>Sub Total</center></th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$nomor=1; ?>
		<?php $ambil=$link->query("SELECT * FROM pembelian_obat JOIN obat ON pembelian_obat.id_obat=obat.id_obat WHERE pembelian_obat.id_pembelian='$_GET[id]'"); ?>
		<?php while ($pecah=$ambil->fetch_assoc()) { ?>
			<tr>
				<td><center><?php echo $nomor; ?></center></td>
				<td><center><?php echo $pecah['nama_obat']; ?></center></td>
				<td><center>Rp. <?php echo number_format($pecah['harga_obat']); ?></center></td>
				<td><center><?php echo $pecah['jumlah']; ?></center></td>
				<td><center>Rp. <?php echo number_format($pecah['harga_obat']*$pecah['jumlah']); ?></center></td>
			</tr>
			<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>
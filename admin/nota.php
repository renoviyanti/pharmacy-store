<?php
$link = new mysqli("localhost", "root", "", "farmasinaviha"); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Nota Pembelian</title>
</head>
<body>
	<!-- navbar -->
	<nav class="navbar navbar-default">
		<div class="container">
			<ul class="nav navbar-nav">
				<li><a href="index.php">Home</a></li>
				<li><a href="keranjang.php">Keranjang</a></li>

				<!-- jk sudah login (ada session pelanggan) -->
				<?php if (isset($_SESSION["pelanggan"])): ?>
					<li><a href="logout.php">Logout</a></li>

					<!-- selain itu (blm login) -->
					<?php else: ?>
						<li><a href="login.php">Login</a></li>
					<?php endif ?>
					<li><a href="checkout.php">Checkout</a></li>
				</ul>
			</div>
		</nav>

		<section class="konten">
			<div class="container">
				
				<h2>Detail Pembelian</h2>
				<?php
				$link = mysqli_connect("localhost", "root", "", "farmasinaviha");
				$ambil = $link->query("SELECT * FROM pembelian join pelanggan ON pembelian.id_plg=pelanggan.id_plg WHERE pembelian.id_pembelian='$_GET[id]'");
				$detail = $ambil->fetch_assoc();
				?>

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
				<p>
					Tanggal : <?php echo $detail['tanggal_pembelian']; ?>
					<br>
					Total : <?php echo $detail['total_pembelian']; ?>
				</p>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Obat</th>
							<th>Harga</th>
							<th>Jumlah</th>
							<th>Sub Total</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$nomor=1;
						$ambil=$link->query("SELECT * FROM pembelian_obat JOIN obat ON pembelian_obat.id_obat=obat.id_obat WHERE pembelian_obat.id_pembelian='$_GET[id]'");
						while ($pecah=$ambil->fetch_assoc()) { ?>
							<tr>
								<td><?php echo $nomor; ?></td>
								<td><?php echo $pecah['nama_obat']; ?></td>
								<td><?php echo $pecah['harga_obat']; ?></td>
								<td><?php echo $pecah['jumlah']; ?></td>
								<td><?php echo $pecah['harga_obat']*$pecah['jumlah']; ?></td>
							</tr>
							<?php $nomor++; ?>
						<?php } ?>
					</tbody>
				</table>
				
			</div>
		</section>

	</body>
	</html>
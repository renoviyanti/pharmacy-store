<?php
session_start();
$link = new mysqli("localhost", "root", "", "farmasinaviha");

//jika tidak ada session pelanggan (blm login) 
if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"])) 
{
	echo "<script>alert('silahkan login');</script>";
	echo "<script>location='login.php';</script>";
	exit();
}
?>

<html>
<head>
	<title>Farmasi</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

	<!-- navbar -->
	<nav class="navbar navbar-default">
		<div class="container">
			<ul class="nav navbar-nav">
				<li><a href="index.php">Home</a></li>
				<li><a href="keranjang.php">Keranjang</a></li>
				<li><a href="checkout.php">Checkout</a></li>

				<!-- jk sudah login (ada session pelanggan) -->
				<?php if (isset($_SESSION["pelanggan"])): ?>
					<li><a href="riwayat.php">Riwayat Belanja</a></li>
					<li><a href="logout.php">Logout</a></li>

					<!-- selain itu (blm login) -->
					<?php else: ?>
						<li><a href="login.php">Login</a></li>
						<li><a href="daftar.php">Daftar</a></li>
					<?php endif ?>
					<li><a href="tentangkami.php">Tentang Kami</a></li>
				</ul>
			</div>
		</nav>

		<!--<pre><?php print_r($_SESSION)?></pre> -->
		<section class="riwayat">
			<div class="container">
				<h3>Riwayat Belanja <?php echo $_SESSION["pelanggan"]["nama_plg"] ?></h3>

				<table class="table table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal</th>
							<th>Status</th>
							<th>Total</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$nomor=1;
					// mendapatkan id pelanggan yang login dari session
						$id_plg = $_SESSION["pelanggan"]['id_plg'];

						$ambil = $link->query("SELECT * FROM pembelian WHERE id_plg='$id_plg' ");
						while($pecah = $ambil->fetch_assoc()){
							?>
							<tr>
								<td><?php echo $nomor; ?></td>
								<td><?php echo $pecah["tanggal_pembelian"] ?></td>
								<td><?php echo $pecah["status_pengiriman"] ?>
								<br><?php if(!empty($pecah['resi_pengiriman'])): ?>
									Resi : <?php echo $pecah['resi_pengiriman']; ?>	
								<?php endif ?>
								</td>
								<td>Rp. <?php echo number_format($pecah["total_pembelian"]) ?></td>
								<td>
									<a href="nota.php?id=<?php echo $pecah["id_pembelian"] ?>" class="btn btn-info">Nota</a>

									<?php if ($pecah['status_pengiriman']=="pending") :?>	

									<a href="pembayaran.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-success">Input Pembayaran</a>
									<?php else: ?>
										<a href="lihat_pembayaran.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-warning">
											Lihat Pembayaran
										</a>
								<?php endif ?>
								</td>
							</tr>
							<?php $nomor++; ?>
						<?php } ?>
					</tbody>
				</table>

			</div>

		</section> 
	</body>
	</html>
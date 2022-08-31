<?php
session_start();
$link = new mysqli("localhost", "root", "", "farmasinaviha"); 

if (empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
	echo "<script>alert('Keranjang kosong, silahkan belanja dulu');</script>";
	echo "<script>location='index.php';</script>";
}
?>
<html>
<head>
	<title>Keranjang Belanja</title>
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

	<section class="konten">
		<div class="container">
			<h1>Keranjang Belanja<h1>
				<hr>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Obat</th>
							<th>Harga</th>
							<th>Jumlah</th>
							<th>Sub Harga</th>
							<th>Aksi</th>
						</tr>
					</thead>

					<tbody>
						<?php $nomor=1; ?>
						<?php foreach ($_SESSION["keranjang"] as $id_obat => $jumlah): ?>
							<!--menampilkan obat yg sedang diperulangkan berdasarkan id_obat -->
							<?php
							$ambilobat = $link->query("SELECT * FROM obat
								WHERE id_obat = '$id_obat'");
							$pecah = $ambilobat->fetch_assoc();
							$subharga = $pecah["harga_obat"]*$jumlah;
//echo "<pre>";
//print_r($pecah);
//echo "</pre>";
							?>

							<tr>
								<td><?php echo $nomor; ?></td>
								<td><?php echo $pecah["nama_obat"];?></td>
								<td>Rp <?php echo number_format($pecah["harga_obat"]); ?></td>
								<td><?php echo $jumlah; ?></td>
								<td>Rp <?php echo number_format($subharga); ?></td>
								<td>
									<a href="hapuskeranjang.php?id_obat=<?php echo $id_obat ?>" class="btn btn-danger btn-xs">Hapus</a>
								</td>
							</tr>
							<?php $nomor++ ?>
						<?php endforeach ?>
					</tbody>
				</table>
				<a href="index.php" class="btn btn-default">Lanjutkan belanja</a>
				<a href="checkout.php" class="btn btn-primary">Check Out</a>
			</div>
		</section>
	</body>
	</html>
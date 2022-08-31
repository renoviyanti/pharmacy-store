<?php
session_start();
$link = new mysqli("localhost", "root", "", "farmasinaviha"); ?>

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

					<form action="pencarian.php" method="get" class="navbar-form navbar-right">
					<input type="text" class="form-control" name="keyword">
					<button class="btn btn-primary">Cari</button>
					</form>

				</div>
			</nav>



			<!-- konten -->
			<section class="konten">
				<div class="container">
					<h1>Daftar Obat</h1>
					<div class="row">
						<?php $ambil = $link->query("SELECT * FROM obat");
						while ($perobat = $ambil->fetch_assoc()){?>
							<div class="col-md-3">
								<div class="thumbnail">
									<img src="foto_obat/<?php echo $perobat['foto_obat']; ?>" alt="">
									<div class="caption">
										<h3><?php echo $perobat['nama_obat']; ?></h3>
										<h5>Rp. <?php echo number_format($perobat['harga_obat']); ?></h5>
										<a href="beli.php?id_obat=<?php echo $perobat['id_obat'] ?>" class="btn btn-primary">Beli</a>
										<a href="detail.php?id=<?php echo $perobat["id_obat"]; ?>" class="btn btn-default">Detail</a>

									</div> 
								</div>
							</div>
						<?php } ?>


					</div>
				</div>
			</section>
		</body>
		</html>
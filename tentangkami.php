<?php
session_start();
$link = new mysqli("localhost", "root", "", "farmasinaviha"); ?>

<html>
<head>
	<title>Tentang Kami</title>
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

			<!-- konten -->
			<section class="konten">
				<div class="container">
					<h1>Tentang Kami</h1>
					<div class="row">
						<?php $ambil = $link->query("SELECT * FROM pembuat");
						while ($pembuat = $ambil->fetch_assoc()){?>
							<div class="col-md-3">
								<div class="thumbnail">
									<img src="foto_pembuat/<?php echo $pembuat['foto_pembuat']; ?>" alt="" height="100" width="100">
									<div class="caption">
										<h3><?php echo $pembuat['nama_pembuat']; ?></h3>
										<h5><?php echo $pembuat['nim_pembuat']; ?></h5>

									</div> 
								</div>
							</div>
						<?php } ?>


					</div>
				</div>
			</section>

</body>
</html>
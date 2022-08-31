<?php
session_start();
$link = new mysqli("localhost", "root", "", "farmasinaviha");

// mendapatkan id obat dari url
$id_obat = $_GET['id'];

// query ambil data
$ambil = $link->query("SELECT * FROM obat WHERE id_obat='$id_obat'");
$detail = $ambil->fetch_assoc();

//echo "<pre>";
//print_r($detail);
//
?>

<html>
<head>
	<title>detail obat</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

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
					
				</ul>
			</div>
		</nav>

		<section class="kontent">
			<div class="container">
				<div class="col-md-6">
					<img src="foto_obat/<?php echo $detail["foto_obat"]; ?>" alt="" class="img-responsive">
				</div>
				<div class="col-md-6">
					<h2><?php echo $detail["nama_obat"] ?></h2>
					<h4>Rp. <?php echo number_format($detail["harga_obat"]); ?> </h4>

					<h5>Stok : <?php echo number_format($detail["stok_obat"]); ?></h5>

					<form method="post">
						<div class="form-group">
							<div class="input-group">
								<input type="number" min="1" class="form-control" name="jumlah" max="<?php echo $detail['stok_obat'] ?>">
								<div class="input-group-btn">
									<button class="btn btn-primary" name="beli">Beli</button>

								</div>
							</div>

						</div>
					</form>

					<?php

				// jika ada tombol beli
					if (isset($_POST["beli"]))
					{
						$jumlah = $_POST["jumlah"];
						$_SESSION["keranjang"][$id_obat] = $jumlah;

						echo "<script>alert('produk telah masuk kedalam keranjang');</script>";
						echo "<script>location='keranjang.php';</script>";
					} 

					?>
					<p><?php echo $detail["deskripsi_obat"]; ?></p>
				</div>

			</div>

		</section>

	</body>
	</html>

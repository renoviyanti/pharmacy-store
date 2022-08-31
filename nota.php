<?php
session_start();
$link = new mysqli("localhost", "root", "", "farmasinaviha"); ?>

<html>
<head>
	<title>Nota Pembelian</title>
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
				<!-- nota copaste dari nota yang ada di admin-->
				<h2>Detail Pembelian</h2>
				<?php
				$link = mysqli_connect("localhost", "root", "", "farmasinaviha");
				$ambil = $link->query("SELECT * FROM pembelian join pelanggan ON pembelian.id_plg=pelanggan.id_plg WHERE pembelian.id_pembelian='$_GET[id]'");
				$detail = $ambil->fetch_assoc();
				?>
				<!-- <h1>Data Orang yang Beli $detail</h1> -->
				<!-- <pre><?php print_r($detail); ?></pre> -->
				<!-- <h1>Data Orang yang Login di Session</h1> -->
				<!-- <pre><?php print_r($_SESSION); ?></pre>-->

				<!-- jika pelanggan yang beli tidak sama dengan pelanggan yang login, maka dilarikan ke riwayat.php karena dia tidak berhak melihat nota orang lain -->
				<!--pelanggan yang beli harus pelanggan yang login -->
				<?php
				// mendapatkan id_plg yang beli
				$idpelangganyangbeli = $detail["id_plg"];

				// mendapatkan id_plg yang login
				$idpelangganyanglogin = $_SESSION["pelanggan"]["id_plg"];

				if ($idpelangganyangbeli!==$idpelangganyanglogin) 
				{
					echo "<script>alert('pelanggan yang login harus sama dengan pelanggan yang beli')</script>"	;
					echo "<script>location='riwayat.php'</script>";
					exit();
				}
				?>

				<div class="row">
					<div class="col-md-4">
						<h3>Pembelian</h3>
						<strong>No. Pembelian <?php echo $detail['id_pembelian']; ?></strong><br>
						<p>
							Tanggal: <?php echo $detail['tanggal_pembelian']; ?> <br>
							Total: <?php echo $detail['total_pembelian']; ?>
						</p>
					</div>
					<div class="col-md-4">
						<h3>Pelanggan</h3>
						<strong>Nama Pelanggan <?php echo $detail['nama_plg']; ?></strong><br>
						<p>
							Telp: <?php echo $detail['telp_plg']; ?> <br>
							Email: <?php echo $detail['email_plg']; ?>
						</p>
					</div>
					<div class="col-md-4">
						<h3>Pengiriman</h3>
						<strong>Nama Kota: <?php echo $detail['nama_kota']; ?></strong><br>
						Ongkos kirim: Rp. <?php echo number_format($detail['tarif']); ?><br>
						Alamat Pengiriman: <?php echo $detail['alamat_pengiriman']; ?>
					</div>
				</div>
				<br> 

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
						
						<?php $nomor=1; ?>
						<?php $ambil=$link->query("SELECT * FROM pembelian_obat WHERE id_pembelian='$_GET[id]'"); ?>
						<?php while ($pecah=$ambil->fetch_assoc()) { ?>
							<tr>
								<td><?php echo $nomor; ?></td>
								<td><?php echo $pecah['nama']; ?></td>
								<td>Rp <?php echo number_format($pecah['harga']); ?></td>
								<td><?php echo $pecah['jumlah']; ?></td>
								<td>Rp <?php echo number_format($pecah['subharga']); ?></td>
							</tr>
							<?php $nomor++; ?>
						<?php } ?>
					</tbody>
				</table>
				<div class="row">
					<div class="col-md-7">
						<div class="alert alert-info">
							<p>
								Silahkan melakukan pembayaran sebesar Rp. <?php echo number_format($detail['total_pembelian']); ?> ke <br>
								<strong>BANK MUAMALAH 121-45666-756-6 AN. SUKSES PEMROGRAMAN BASDAT</strong>

								
							</div>
							
						</div> 
						
					</div>
				</div>
			</section>

		</body>
		</html>
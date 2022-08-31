<?php
session_start();
$link = new mysqli("localhost", "root", "", "farmasinaviha");

$id_pembelian = $_GET["id"];

$ambil = $link->query("SELECT * FROM pembayaran 
		LEFT JOIN pembelian ON pembayaran.id_pembelian 
		WHERE pembelian.id_pembelian='$id_pembelian'");
$detbay = $ambil->fetch_assoc();

//echo "<pre>";
//print_r ($detbay);
//echo "</pre>";

//jika belum ada data pembayaran
if (empty($detbay)) 
{
	echo "<script>alert('Belum ada data pembayaran')</script>";
	echo "<script>location='riwayat.php'</script>";
	exit();
}

//jika data pelanggan pembayaran tidak sesuai dengan yang login
//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";

if ($_SESSION["pelanggan"]["id_plg"]!==$detbay["id_plg"]) 
{
	echo "<script>alert('anda tidak berhak melihat pembayaran orang lain')</script>";
	echo "<script>location='riwayat.php'</script>";
	exit();
}
?>

<html>
<head>
	<title>Lihat Pembayaran</title>
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

	<div class="container">
		<h3>Lihat Pembayaran</h3>
		<div class="row">
			<div class="col-md-6">
				<table class="table">
					<tr>
						<th>Nama</th>
						<td><?php echo $detbay["nama"] ?></td>
					</tr>
					<tr>
						<th>Bank</th>
						<td><?php echo $detbay["bank"] ?></td>
					</tr>
					<tr>
						<th>Tanggal</th>
						<td><?php echo $detbay["nama"] ?></td>
					</tr>
					<tr>
						<th>Jumlah</th>
						<td>Rp. <?php echo number_format($detbay["jumlah"]) ?></td>
					</tr>
				</table>			
		</div>
		<div class="col-md-6">
			<img src="bukti_pembayaran/<?php echo $detbay["bukti"] ?>" alt="" class="img-responsive">
		</div>
	</div>

</body>
</html>
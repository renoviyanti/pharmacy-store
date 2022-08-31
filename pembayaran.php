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

// mendapatkan id pembelian dari url
$idpem = $_GET["id"];
$ambil = $link->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$detpem = $ambil->fetch_assoc();

//echo "<pre>";
//print_r($detpem);
//print_r($_SESSION);
//echo "</pre>";

//mendapatkan id_pelanggan yang beli
$id_pelanggan_beli = $detpem["id_plg"];
//mendapatkan id_pelanggan yang login
$id_pelanggan_login = $_SESSION["pelanggan"]["id_plg"];

if ($id_pelanggan_login !== $id_pelanggan_beli) 
{
	echo "<script>alert('jangan nakal');</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}
?>
<html>
<head>
	<title>Pembayaran</title>
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
				<h2>Konfirmasi Pembayaran</h2>
				<p>Kirim Bukti Pembayaran Anda Disini</p>

				<div class="alert alert-info">Total Tagihan Anda<strong>Rp. <?php echo number_format($detpem["total_pembelian"]) ?></strong></div>

				<form method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Nama Penyetor</label>
						<input type="text" class="form-control" name="nama">
					</div>
					<div class="form-group">
						<label>Bank</label>
						<input type="text" class="form-control" name="bank">
					</div>
					<div class="form-group">
						<label>Jumlah</label>
						<input type="number" class="form-control" name="jumlah" min="1">
					</div>
					<div class="form-group">
						<label>Foto Bukti</label>
						<input type="file" class="form-control" name="bukti">
						<p class="text-danger">foto bukti harus JPG maksimal 2MB</p>
					</div>
					<button class="btn btn-primary" name="kirim">Kirim</button>
				</form>
			</div>

<?php
//jika terdapat tombol kirim
if (isset($_POST["kirim"])) 
{
	//upload dulu foto bukti
	$namabukti = $_FILES["bukti"]["name"];
	$lokasibukti = $_FILES["bukti"]["tmp_name"];
	$namafix = date("YmdHis").$namabukti;
	move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafix");

	$nama = $_POST["nama"];
	$bank = $_POST["bank"];
	$jumlah = $_POST["jumlah"];
	$tanggal = date("y-m-d");

	//simpan pembayaran
	$link->query("INSERT INTO pembayaran (id_pembelian, nama, bank, jumlah, tanggal, bukti) VALUES ('$idpem', '$nama', '$bank', '$jumlah', '$tanggal', '$namafix' )");

	//update data pembelian dari pending menjadi sudah kirim pembayaran
	$link->query("UPDATE pembelian SET status_pengiriman='sudah kirim pembayaran' WHERE id_pembelian='$idpem'");

	echo "<script>alert('terimakasih telah mengirim bukti pembayaran');</script>";
	echo "<script>location='riwayat.php';</script>";
	
}

?>

		</body>
		</html>